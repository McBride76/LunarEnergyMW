<?php

$long_date = date('F jS', strtotime($d));

?>

<div class="date-time-heading txt-orange">
    <?php 
        if (!empty($error_t)) {
            echo '<h2>Select a time for <span class="txt-green">'. $long_date .'</span><span class="error"> - '. $error_t .'</span></h2>';
        } else {
            echo '<h2>Select a time for <span class="txt-green">'. $long_date .'</span></h2>';
        }
    ?>
</div>
<form action="confirm.php?d=<?php echo $d; ?>&s=<?php echo $sid ?>" method="POST" id="timeForm">
    <div>
        <p class="txt-orange">Morning</p>
        <div class="time-row time-row-am">
            <?php echo create_time_row($dbc, $d, 'am'); ?>
        </div>
        <p class="txt-orange">Afternoon</p>
        <div class="time-row time-row-pm">
            <?php echo create_time_row($dbc, $d, 'pm'); ?>
        </div>
    </div>
    <div class="flex-center-xy">
        <input type="submit" value="Confirm">
    </div>
</form>