<?php

$page_title = "Appointments";
include("includes/head.php");

$q = "SELECT first_name, last_name, dob, services.name, services.length AS minutes, services.price, dates.date, times.time FROM appointments INNER JOIN users_personal ON appointments.fk_user_id = users_personal.fk_user_id INNER JOIN services ON appointments.fk_service_id = services.service_id INNER JOIN dates ON appointments.fk_appt_date_id = dates.date_id INNER JOIN times ON appointments.fk_appt_time_id = times.time_id";
$r = mysqli_query($dbc, $q);

if ($r) {
    while ($row = mysqli_fetch_array($r)) {
        // TODO - create appointment cards
    }
}

?>

<div id="body">
    <main id="appointments" class="main img-bg-black">
        <div class="heading">
            <h1 class="txt-green">APPOINTMENTS</h1>
        </div>
    <?php include("includes/footer.html"); ?>
    </main>
</div>