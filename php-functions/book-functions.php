<?php

    function to_sql_time($time) {
        $time = $time[0] . $time[1] . ':' . $time[2] . $time[3] . ':00';
        return $time;
    }

    function create_services_dropdown($id, $db) {
        echo '<select name="services" id="servicesDD">';
        $q = "SELECT service_id, name, length FROM services";
        $r = mysqli_query($db, $q);

        while ($row = mysqli_fetch_assoc($r)) {
            if ($row['length'] == null) {
                $service_length = '';
            } else {
                $service_length = ' - ' . $row['length'] . ' minutes';
            }
            if ($row['service_id'] == $id) {
                echo '<option value="'. $row['service_id'] .'" selected>'. $row['name'] . $service_length . '</option>';
            } else {
                echo '<option value="'. $row['service_id'] .'">'. $row['name'] . $service_length . '</option>';
            }
        }

        echo '</select>';
    }

    function create_date_radio($month, $dayName, $dayNum, $value, $selected_date) {
        $checked = '';
        if (!empty($selected_date) && $selected_date == $value) {
            $checked = 'checked';
        }
        return '<input type="radio" name="date" value="'. $value .'" id="d'. $dayNum .'"'. $checked .'>
                <label for="d'. $dayNum .'" class="img-bg-white lbl-date"><p>'. $month .'</p><p>'. $dayName .'</p><p>'. $dayNum .'</p></label>';
    }

    function create_time_radio($time) {
        $time_display = date('g:i a', strtotime($time));
        $id = date('Hi', strtotime($time));
        return '<input type="radio" name="time" id="t'. $id .'" value="'. $id .'">
        <label for="t'. $id .'" class="img-bg-white lbl-time flex-center-xy">'. $time_display .'</label>';
    }

    function create_time_row($db, $date, $meridiem) {

        if ($meridiem == 'am') {
            if ($date == date('Y-m-d')) {
                $time = date('H:i', strtotime("+8 hours")) . ':00';
                $q = "SELECT time FROM times INNER JOIN availability ON times.time_id = availability.time_id INNER JOIN dates ON availability.date_id = dates.date_id WHERE date = '$date' AND time < '12:00:00' AND time > '$time' AND available != 0";
            } else {
                $q = "SELECT time FROM times INNER JOIN availability ON times.time_id = availability.time_id INNER JOIN dates ON availability.date_id = dates.date_id WHERE date = '$date' AND time < '12:00:00' AND available != 0";
            }
        } else {
            if ($date == date('Y-m-d')) {
                $time = date('H:i', strtotime("+8 hours")) . ':00';
                $q = "SELECT time FROM times INNER JOIN availability ON times.time_id = availability.time_id INNER JOIN dates ON availability.date_id = dates.date_id WHERE date = '$date' AND time >= '12:00:00' AND time > '$time' AND available != 0";
            } else {
                $q = "SELECT time FROM times INNER JOIN availability ON times.time_id = availability.time_id INNER JOIN dates ON availability.date_id = dates.date_id WHERE date = '$date' AND time >= '12:00:00' AND available != 0";
            }
        }
        
        $r = mysqli_query($db, $q);
        if (mysqli_num_rows($r) > 0) {
            while ($row = mysqli_fetch_row($r)) {
                echo create_time_radio($row[0]);
            }
        } else {
            echo '<h2 class="txt-white">Sorry, we\'re booked...</h2>';
        }
    }



    function create_slide($start, $end, $selected_date) {
        $Date = date('Y-m-d');

        // For demonstrating +28 days
        // $Date = '2024-01-20'; // if today is 2024-01-16, add 1 day

        for ($i = $start; $i <= $end; $i++) {
            $value = date('Y-m-d', strtotime($Date . "+ $i days"));
            $dayName = strtoupper(date('D', strtotime($Date . "+ $i days")));
            $monthName = date('M', strtotime($Date . "+ $i days"));
            $dayNum = date('d', strtotime($Date . "+ $i days"));

            echo create_date_radio($monthName, $dayName, $dayNum, $value, $selected_date);
        }
    }

    function populate_database($db, $start_date, $end_date) {
        while ($start_date <= $end_date) {
            $last_insert_id = 0;
            $time_id = 1;
            $q3 = "INSERT INTO dates (date) VALUE ('$start_date')";
            $r3 = mysqli_query($db, $q3);

            $q = "SELECT LAST_INSERT_ID() FROM dates";
            $r = mysqli_query($db, $q);

            if ($r) {
                $row = mysqli_fetch_array($r);
                $last_insert_id = $row[0];
            }

            while ($time_id <= 30) {
                $q4 = "INSERT INTO availability (date_id, time_id, available) VALUES ('$last_insert_id', '$time_id', '1')";
                $r4 = mysqli_query($db, $q4);
                $time_id += 1;
            }

            $start_date = date('Y-m-d', strtotime($start_date . "+ 1 days"));
        }
    }

    function repopulate_database($db, $start_date) {
        $end_date = date('Y-m-d', strtotime($start_date . "+ 27 days"));
        while ($start_date <= $end_date) {

            $last_insert_id = 0;
            $time_id = 1;

            $q = "INSERT INTO dates (date) VALUE ('$start_date')";
            $r = mysqli_query($db, $q);

            if ($r) {

                $q = "SELECT LAST_INSERT_ID() FROM dates";
                $r = mysqli_query($db, $q);

                if ($r) {
                    $row = mysqli_fetch_array($r);
                    $last_insert_id = $row[0];
                }

                while ($time_id <= 30) {
                    $q4 = "INSERT INTO availability (date_id, time_id, available) VALUES ('$last_insert_id', '$time_id', '1')";
                    $r4 = mysqli_query($db, $q4);
                    $time_id += 1;
                }

                $start_date = date('Y-m-d', strtotime($start_date . "+ 1 days"));
            }
       
        }
    }

    function getDateFromID($db, $id) {
        $q = "SELECT date from dates WHERE date_id = '$id'";
        $r = mysqli_query($db, $q);
        if ($r) {
            $row = mysqli_fetch_array($r);
            return $row[0];
        } else {
            return '0000-00-00';
        }
    }

    function getTimeFromID($db, $id, $format) {
        $q = "SELECT time FROM times WHERE time_id = '$id'";
        $r = mysqli_query($db, $q);
        if ($r) {
            $row = mysqli_fetch_array($r);
            if ($format == 24) {
                return date('H:i a', strtotime($row[0]));
            } else {
                return date('g:i a', strtotime($row[0]));
            }
        } else {
            return '00:00 am';
        }
    }

    function getServiceFromID($db, $id, $col, $display) {

        $q = "SELECT name, type_desc, service_desc, price, price_pts, earned_pts, length FROM services INNER JOIN service_descriptions ON services.fk_desc_id = service_descriptions.desc_id INNER JOIN service_types ON services.fk_type_id = service_types.type_id WHERE service_id = $id";
        $r = mysqli_query($db, $q);
        
        if ($r) {
            $row = mysqli_fetch_assoc($r);
            if ($col == 'length' && is_null($row['length'])) {
                return;
            } else if ($col == 'length' && $display) {
                return ' - ' . $row[$col] . ' minutes';
            } else {
                return $row[$col];
            }
        } else {
            return 'Could not fetch service';
        }
    }

    function can_book_again($db, $user_id) {
        $now = strtotime(date('Y-m-d H:i:s'));
        $q = "SELECT date, time FROM last_book WHERE fk_user_id = '$user_id'";
        $r = mysqli_query($db, $q);

        if ($r) {
            $row = mysqli_fetch_array($r);
            $last_booked = strtotime($row[0] . ' ' . $row[1]);
            $timeDiff = $now - $last_booked;
            if ($timeDiff < 3600) {
                return false;
            } else {
                return true;
            }
        }
    }

    function update_availability($db, $time_id, $date_id, $length) {
        if ($length <= 45) {
            $loops = $time_id + 3;
        } else if ($length <= 75) {
            $loops = $time_id + 5;
        } else {
            $loops = $time_id + 7;
        }

        $time_id = $time_id - 2;

        for ($i = $time_id; $i < $loops; $i++) {
            $q = "UPDATE availability SET available = 0 WHERE time_id = '$i' AND date_id = '$date_id'";
            $r = mysqli_query($db, $q);
        }
    }
    

?>