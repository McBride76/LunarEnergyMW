<?php 

$page_title = "Lunar Energy : Login";
include("includes/head.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = "";
    
    // For processing the login:
    require('includes/login_functions.inc.php');

    // Need the database connection:
    require_once('mysqli_connect.php');

        // Check the login:
        list($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);

        // If login is successful...
        if ($check) {
    
            // Set the session data:
            session_start();
            $_SESSION['user_id'] = $data['user_id'];
            $_SESSION['first_name'] = $data['first_name'];
            $_SESSION['last_name'] = $data['last_name'];
            $_SESSION['email'] = $data['email'];
            $_SESSION['is_admin'] = $data['is_admin'];
    
            // Store the HTTP_USER_AGENT:
            $_SESSION['agent'] = sha1($_SERVER['HTTP_USER_AGENT']);
    
            // Redirect:
            if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
                redirect_user('appointments.php');
            } else {
                redirect_user('services.php');
            }
            
        } else { // Login was not successful
    
            // Assign $data to $errors for error reporting
            $errors = $data;
        }
    
        // Close the database connection:
        mysqli_close($dbc);
}

?>

    <div id="body">
        <main id="login" class="main">
            <div class="heading img-bg-black">
                <h1 class="txt-green">LOGIN</h1>
            </div>
            <section class="main-wrapper">
                <div class="img-wrapper"></div>
                <div class="form-wrapper img-bg-white">
                    <h2>Welcome Back</h2>
                    <form action="login.php" method="post" id="loginForm" novalidate>
                        <div class="form-item-container form-item-email">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="somebody@example.com"
                                <?php if (isset($_POST["email"])) {echo 'value="' . $_POST["email"] .'"';}?>
                            id="email">
                        </div>
                        <div class="form-item-container form-item-password">
                            <label for="pass">Password</label>
                            <input type="password" name="pass" id="pass">
                        </div>
                        <div class="btn-container">
                            <input type="submit" value="Login">
                        </div>
                    </form>
                    <div class="switch-container semi-bold">
                        <p>Don't have an account?</p>
                        <a href="register.php" class="txt-black">Register Instead</a>
                    </div>
                    <!-- Report Errors -->
                    <div>
                        <?php if(!empty($errors)) {
                            foreach ($errors as $error) {echo '<p class="error">'. $error .'</p>'; }
                        } ?>
                    </div>
                </div>
            </section>
            <?php include("includes/footer.html"); ?>
        </main>
    </div>
</body>