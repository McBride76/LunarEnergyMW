<section id="confirmSection">
    <?php 
        if (!empty($confirm_error)) {
            echo '<p class="error">' . $confirm_error . '</p>';
        } else {
            echo '<h3 class="txt-orange">Confirm this appointment?</h3>';
        }
    ?>
    <div class="appt-info-card img-bg-white">
        <div class="confirm-service">
            <h4>SERVICE</h4>
            <?php echo '<p>' . getServiceFromID($dbc, $service, 'name', false) . getServiceFromID($dbc, $service, 'length', true) . '</p>'; ?>
            <?php echo '<p>' . getServiceFromID($dbc, $service, 'service_desc', false) . '</p>'; ?>
        </div>
        <div class="confirm-cost">
            <h4>COST</h4>
            <?php 

            if (!is_null(getServiceFromID($dbc, $service, 'earned_pts', false))) {
                echo '<div class="earns-points">
                <p>$' . getServiceFromID($dbc, $service, 'price', false) . '.00</p>
                <p class="earned-points">earns ' . getServiceFromID($dbc, $service, 'earned_pts', false) . ' points</p>
                </div>';
            } else {
                echo '<p>$' . getServiceFromID($dbc, $service, 'price', false) . '.00</p>'; 
            }

            if (!is_null(getServiceFromID($dbc, $service, 'price_pts', false))) {
                echo '<p class="cost-points"> or ' . getServiceFromID($dbc, $service, 'price_pts', false) . ' points</p>';
            }

            ?>
        </div>
        <div class="confirm-date">
            <h4>DATE AND TIME</h4>
            <?php echo '<p>' . date('l, F jS', strtotime(getDateFromID($dbc, $date))) . '</p>'; ?>
            <?php echo '<p>' . getTimeFromID($dbc, $time, 12) . '</p>'; ?>
        </div>
    </div>
    <?php $action_link = "confirm-final.php?d=$date&t=$time&s=$service"; ?>
    <form action="<?php echo $action_link;  ?>" method="POST">
        <input type="hidden" name="date" value="<?php echo $date; ?>">
        <input type="hidden" name="time" value="<?php echo $time; ?>">
        <input type="hidden" name="service" value="<?php echo $service; ?>">
        <div>
            <input type="submit" value="Confirm">
        </div>
        <?php   
            if (isset($cant_book) && $cant_book) {
                echo '<div class="cant-book"><p class="error txt-center">Please wait at least 1 hour to before booking another appointment.</p></div>';
            }
        ?>
        <div>
            <a href="book.php" class="txt-orange">Cancel</a>
        </div>
    </form>
</section>