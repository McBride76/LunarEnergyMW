<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&amp;family=Raleway:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/9cf76b20d4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/general-styles.css">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/services.css">
    <link rel="stylesheet" href="styles/book.css">
    <link rel="stylesheet" href="styles/faq.css">
    <link rel="stylesheet" href="styles/login-register.css">
    <link rel="stylesheet" href="styles/contact.css">
    <link rel="stylesheet" href="responsive-styles/responsive-styles.css">
    <script defer>

        // Maps API
        var map;
            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 41.32909, lng: -111.82509},
                zoom: 17
            });

            new google.maps.Marker({
                position: {lat: 41.32909, lng: -111.82509},
                map
            })
        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3wi5R9F6KaOZrVSXNLPvmIe4ROLoZM6g&callback=initMap" async defer></script>
    <title><?php echo $page_title; ?></title>
</head>
<body>
    <nav>
        <?php 

        session_start();
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
        $is_admin = (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) ? true : false;

        if (empty($user_id)) {
            echo '<input type="hidden" id="jsLoginIndicator" value="0">';
        } else if ($is_admin) {
            echo '<input type="hidden" id="jsLoginIndicator" value="2">';
        } else {
            echo '<input type="hidden" id="jsLoginIndicator" value="1">';
        }

        date_default_timezone_set('America/Phoenix');

        ?>
        
        <div class="nav-item nav-item-index">
            <a href="index.php" class="btn-link nav-link semi-bold center">Lunar Energy</a>
        </div>
        <div class="nav-item nav-item-home">
            <a href="./index.php" class="btn-link nav-link semi-bold center" id="linkHome">Home</a>
        </div>
        <?php 
            if ($is_admin) {
                echo 
                '<div class="nav-item nav-item-users">
                    <a href="users.php" class="btn-link nav-link semi-bold center" id="linkUsers">Users</a>
                </div>
                    
                <div class="nav-item nav-item-admin">
                    <a href="appointments.php" class="btn-link nav-link semi-bold" id="linkAppointments">Appointments</a>
                </div>';
            } else {
                echo 
                '<div class="nav-item nav-item-services">
                    <a href="services.php" class="btn-link nav-link semi-bold center" id="linkServices">Services</a>
                </div>

                <div class="nav-item nav-item-book">
                    <a href="book.php" class="btn-link nav-link semi-bold center" id="linkBook">Book Now</a>
                </div>';
            }
        ?>
        
        <div class="nav-item nav-item-login-logout">
            <?php 
            if (empty($user_id)) {
                echo '<a href="login.php" class="btn-link nav-link semi-bold center" id="linkLoginRegister">Login</a>';
            } else {
                echo '<a href="logout.php" class="btn-link nav-link semi-bold center" id="linkLogout">Logout</a>';
            }
            ?>
        </div>
            <?php 

            require("mysqli_connect.php");

            if (!$is_admin) {
                echo '<div class="nav-item nav-item-points">';

                $q = "SELECT points FROM users_points WHERE fk_user_id = '$user_id'";
                $r = mysqli_query($dbc, $q);
    
                if (mysqli_num_rows($r) != 0) {
                    $row = mysqli_fetch_array($r, MYSQLI_NUM);
                    $points = $row[0];
                    echo '<img src="images/coin.webp" id="ptsImg"><p>' . $points . '</p>';
                }

                echo '</div>';
            }

            ?>
    </nav>