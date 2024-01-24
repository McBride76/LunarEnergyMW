<?php

include("includes/login_functions.inc.php");
include('php-functions/book-functions.php');

$page_title = "Appointment Confirmation";
include("includes/head.php");

$has_been_confirmed = false;
$confirm_error = '';

if ((isset($_GET['d']) && isset($_GET['t']) && isset($_GET['s'])) && isset($_SESSION['user_id'])) {
    
    $date = $_GET['d'];
    $time = $_GET['t'];
    $service = $_GET['s'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (can_book_again($dbc, $user_id)) {

            // Add to appointments
            $q = "INSERT INTO appointments (fk_user_id, fk_service_id, fk_appt_date_id, fk_appt_time_id) VALUES ('$user_id', '$service', '$date', '$time') LIMIT 1";
            $r = mysqli_query($dbc, $q);

            if ($r) {

                $length = getServiceFromID($dbc, $service, 'length', false);
                $length = (int)$length + 15;

                update_availability($dbc, $time, $date, $length);

                $now_t = date('H:i:s');
                $now_d = date('Y-m-d');

                $q = "UPDATE last_book SET time = '$now_t', date = '$now_d' WHERE fk_user_id = '$user_id'";
                $r = mysqli_query($dbc, $q);

                if ($r) {
                    $has_been_confirmed = true;
                } else {
                    $confirm_error = 'We ran into an issue confirming your appointment... <br>Please <a href="contact.php">contact</a> us for assistance.';
                }

            } else {
                $confirm_error = 'We ran into an issue confirming your appointment... <br>Please <a href="contact.php">contact</a> us for assistance.';
            }

        } else {
            $cant_book = true;
        }
    }

} else {
    redirect_user();
}
   
?>
<div id="body">
    <main id="bookConfirm" class="main img-bg-black">
        <div class="heading">
            <h1 class="txt-green">BOOK MASSAGE</h1>
        </div>
        <?php 

        if ($has_been_confirmed) {
            redirect_user('appointment-confirmed.php');
            
        } else {
            include("includes/confirmation-form.php");
        }
        
        ?>
        <?php include('includes/footer.html'); ?>
    </main>
</div>
