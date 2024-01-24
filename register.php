<?php 

$page_title = "Lunar Energy : Login";
include("includes/head.php");
include("includes/login_functions.inc.php");
include("php-functions/register-functions.php");

$email_pattern = '/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/';

// Check form input
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    // Initialize empty error messages
    $error_first = "";
    $error_last = "";
    $error_email = "";
    $error_pass1 = "";
    $error_pass2 = "";
    $error_dob = "";

    // Message to display if all valid
    $activate_msg = "";

    require_once('mysqli_connect.php'); // Connect to the db

    // Check for a first name:
	if (empty($_POST['fname'])) {
		$error_first = '<p class="error">Please enter a first name</p>';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['fname']));
	}

    // Check for a last name:
	if (empty($_POST['lname'])) {
		$error_last = '<p class="error">Please enter a last name</p>';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['lname']));
	}

    // Check for an email address:
	if (empty($_POST['email'])) {
		$error_email = '<p class="error">Please enter an email address</p>';
	} else if (!preg_match($email_pattern, trim($_POST['email']))) {
		$error_email = '<p class="error">Email is not correctly formatted</p>';
	} else {
        // Check if email exists
        $e = mysqli_real_escape_string($dbc, trim($_POST['email']));
        $q = "SELECT user_id FROM users_cred WHERE email = '$e'";
        $r = mysqli_query($dbc, $q);
        if (mysqli_num_rows($r) != 0) {
			$error_email = '<p class="error">This email already exists.</p>';
		}
    }

    // Check for valid date of birth:
    if (!validate_dob($_POST['month'], $_POST['day'], $_POST['year'])) {
        $error_dob = '<p class="error">This date is invalid, please check and try again</p>';
    } else {
        if ($_POST['day'] < 10) {
			$day = '0' . $_POST['day'];
		} else {
			$day = $_POST['day'];
		}
		if ($_POST['month'] < 10) {
			$month = '0' . $_POST['month'];
		} else {
			$month = $_POST['month'];
		}
        $dob = mysqli_real_escape_string($dbc, trim($_POST['year'] . '-' . $month . '-' . $day));
    }

    // Check for a password and match against the confirmed password:
    if (empty($_POST['pass'])) {
        $error_pass1 = '<p class="error">Please enter a password</p>';
    } else if (empty($_POST['pass2'])) {
        $error_pass2 = '<p class="error">Please confirm your password</p>';
    } else if (trim($_POST['pass'] != trim($_POST['pass2']))) {
        $error_pass2 = '<p class="error">Passwords do not match</p>';
    } else {
        $p = mysqli_real_escape_string($dbc, trim($_POST['pass'])) ;
    }

    $all_valid = empty($error_first) && empty($error_last) && empty($error_dob) && empty($error_email)
        && empty($error_pass1) && empty($error_pass2); // helper variable

    if ($all_valid) {

        // Register the user in the database...
		$a = md5(uniqid(rand(), true));

        // Make the first query:
		$q1 = "INSERT INTO users_cred (email, pass, active, registration_date, is_admin) VALUES ('$e', SHA2('$p', 512), '$a', NOW(), 0)";
        $r = mysqli_query($dbc, $q1); // Run the query.
        $q2 = "INSERT INTO users_personal (fk_user_id, first_name, last_name, dob) VALUES (LAST_INSERT_ID(), '$fn', '$ln', '$dob')";
        $r2 = mysqli_query($dbc, $q2);
        $q3 = "INSERT INTO users_points (fk_user_id, points) VALUES (LAST_INSERT_ID(), 0)";
        $r3 = mysqli_query($dbc, $q3);
        $q4 = "INSERT INTO last_book (fk_user_id, date, time) VALUES (LAST_INSERT_ID(), '0000-00-00', '00:00:00')";
        $r4 = mysqli_query($dbc, $q4);

        if ($r && $r2 && $r3 && $r4) { // If it ran OK.

			// Set up base of URL:
			$url = 'http://localhost/LunarEnergy/';

			// Send email to activate registration:
			$body = "Thank you for creating an account with Lunar Energy. To activate your account, please click on this link:\n\n";
			$body .= $url . 'activate.php?x=' . urlencode($e) . '&y=' . $a;
			mail($e, 'Registration Confirmation', $body, 'From: admin@LunarEnergy.com');

			// Print a message:
			$activate_msg = '<p class="txt-center">Thank you for registering, ' . $fn . '!</p>
			<p class="txt-center">A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account</p>';

		} else { // If it did not run OK.

			// Public message:
			$activate_msg = '<p class="error txt-center">You could not be registered due to a system error. We apologize for any inconvenience.</p>';

			// Email admin with error:
            $non_public_err = mysqli_error($dbc);
            mail('ianmcbride777@gmail.com', 'Failed Registration', $non_public_err, 'From: admin@LunarEnergy.com');

        }
    }
}


// Display either the form or activation message
if (empty($activate_msg)) {
    include("includes/register-form.php");
} else {
    echo '
    <div class="activate-msg-container img-bg-black">' . $activate_msg . '</div>';
}

?>