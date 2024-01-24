<?php # Script 12.2 - login_functions.inc.php 
# This page defines two functions used by the login/logout process.

// This function determines an absolute URL and redirects the user there.
// --> The function takes 1 argument: the page to be redirected to.
// --> The argument defaults to index.php
function redirect_user($page = 'index.php') {

    // Start defining the URL...
    // URL is http:// + hostname + current directory:
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

    // Remove any trailing slashes:
    $url = rtrim($url, '/\\');

    // Add the page:
    $url .= '/' . $page;

    // Redirect the user:
    header("Location: $url");

    // Quit the script
    exit();

} // End of redirect_user() function

// This function validates the form data (email and password)
// --> If both are present, the database is queried.
// --> The function requires a database connection
// --> The function returns an array of information, including:
// -----> a TRUE/FALSE variable indicating success
// -----> an array of either errors or the database result
function check_login($dbc, $email = '', $pass = '') {

    $email_pattern = '/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/';

    // Initialize error array
    $errors = [];

    // Validate the email address:
    if (empty($email)) {
        $errors[] = 'You forgot to enter your email address.';
    } else if (!preg_match($email_pattern, $email)) {
        $errors[] = 'Email is not correctly formatted';
    } else {
        $e = mysqli_real_escape_string($dbc, trim($email));
    }

    // Validate the password:
    if (empty($pass)) {
        $errors[] = 'You forgot to enter your password.';
    } else {
        $p = trim($pass);
    }

    // If there are no errors...
    if (empty($errors)) {

        // Retrieve the user_id, first_name, and pass for that email:
        $q = "SELECT user_id, first_name, last_name, pass, active, is_admin FROM users_cred INNER JOIN users_personal ON users_cred.user_id = users_personal.fk_user_id WHERE email='$e' AND pass=SHA2('$p', 512) AND active is NULL";

        // Run the query
        $r = @mysqli_query($dbc, $q);

        // Check the result:
        if (mysqli_num_rows($r) == 1) {

            // Fetch the record:
            $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

            // Return the record:
            return [true, $row];

        } else { // Not a match
            $errors[] = 'The email address and password entered do not match those on file, or your account is not activated.';
        }

    } // End of empty($errors) IF

    // Return false and the errors:
    return [false, $errors];

} // End of check_login() function