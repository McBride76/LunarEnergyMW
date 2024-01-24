
 <div id="body">
        <main id="register" class="main">
            <div class="heading img-bg-black">
                <h1 class="txt-green">REGISTER</h1>
            </div>
            <section class="main-wrapper">
                <div class="img-wrapper"></div>
                <div class="form-wrapper img-bg-white">
                    <h2>Welcome</h2>
                    <form action="register.php" method="post" id="registerForm" novalidate>
                        <div class="form-item-container form-item-name">
                            <div>
                                <label for="fname">First Name</label>
                                <input type="text" name="fname" id="fname" maxlength="32"
                                <?php if($_SERVER['REQUEST_METHOD'] == "POST") {echo 'value="'. $_POST['fname'] . '"';} ?>>
                                <?php if($_SERVER['REQUEST_METHOD'] == "POST") {echo $error_first;} ?>
                            </div>
                            <div>
                                <label for="lname">Last Name</label>
                                <input type="text" name="lname" id="lname" maxlength="32"
                                <?php if($_SERVER['REQUEST_METHOD'] == "POST") {echo 'value="'. $_POST['lname'] . '"';} ?>>
                                <?php if($_SERVER['REQUEST_METHOD'] == "POST") {echo $error_last;} ?>
                            </div>
                        </div>
                        <div class="form-item-container form-item-dob">
                            <div class="dob-select-div">

                            <?php # This script makes three pull-down menus for an HTML form: months, days, years

                            // Make the months array:
                            $months = [1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July',
                            'August', 'September', 'October', 'November', 'December'];

                            // Make the months pull-down menu:
                            echo '<div><label for="month">Date of Birth</label><select name="month" id="month">';
                            foreach ($months as $key => $value) {
                                echo "<option value=\"$key\"" ;
		                        // make sticky
		                        if (isset($_POST['month']) && $_POST['month'] == $key) echo ' selected="selected"'; echo ">$value</option>\n";
                            }
                            echo '</select></div>';

                            // Make the days pull-down menu:
                            echo '<div><label for="day">&nbsp;</label><select name="day" id="day">';
                            for ($day = 1; $day <= 31; $day++) {
                                echo "<option value=\"$day\"";
		                        // make sticky
		                        if (isset($_POST['day']) && $_POST['day'] == $day) echo ' selected="selected"'; echo ">$day</option>\n";
                            }
                            echo '</select></div>';

                            // Make the years pull-down menu:
                            echo '<div><label for="year">&nbsp;</label><select name="year" id="year">';
                            for ($year = 2012; $year >= 1930; $year--) {
                                echo "<option value=\"$year\"";
                                // make sticky
		                        if (isset($_POST['year']) && $_POST['year'] == $year) echo ' selected="selected"'; echo ">$year</option>\n";
                            }
                            echo '</select></div>';

                            ?>
                            </div>
                            <div class="dob-error-div">
                            <?php if($_SERVER['REQUEST_METHOD'] == "POST") {echo $error_dob;} ?>
                            </div>
                        </div>
                        <div class="form-item-container form-item-email">
                            <div>
                                <label for="email">Email</label>
                                <p>(you will need to verify)</p>
                            </div>
                            <input type="email" name="email" placeholder="somebody@example.com"
                                <?php if (isset($_POST["email"])) {echo 'value="' . $_POST["email"] .'"';}?>
                            id="email" maxlength="64">
                            <?php if($_SERVER['REQUEST_METHOD'] == "POST") {echo $error_email;} ?>
                        </div>
                        <div class="form-item-container form-item-password">
                            <div>
                                <label for="pass">Password</label>
                                <input type="password" name="pass" id="pass">
                                <?php if($_SERVER['REQUEST_METHOD'] == "POST") {echo $error_pass1;} ?>
                            </div>
                            <div>
                                <label for="pass2">Confirm Password</label>
                                <input type="password" name="pass2" id="pass2">
                                <?php if($_SERVER['REQUEST_METHOD'] == "POST") {echo $error_pass2;} ?>
                            </div>
                        </div>
                        <div class="btn-container">
                            <input type="submit" value="Register">
                        </div>
                    </form>
                    <div class="switch-container semi-bold">
                        <p>Already have an account?</p>
                        <a href="login.php" class="txt-black">Login Instead</a>
                    </div>
                </div>
            </section>
            <?php include("includes/footer.html"); ?>
        </main>
    </div>
</body>