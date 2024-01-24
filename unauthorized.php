<?php 

$page_title = 'Please Login';
include('includes/head.php');

if (isset($_GET['a'])) {
    switch ($_GET['a']) {
        case 'book':
            $action = 'book an appointment';
            break;
        case 'review':
            $action = 'write a review';
            break;
        default:
            $action = 'perform that action';
            break;
    }
}

?>

<div id="body">
    <main class="main img-bg-black unauthorized-main">
        <h1 class="txt-green txt-center">Sorry... <br><br>You must be logged in to <?php echo $action; ?></h1>
        <div class="btns-container">
            <a href="index.php" class="btn-link btn-cancel">Cancel</a>
            <a href="login.php" class="btn-link btn-login">Login</a>
        </div>
        <?php include("includes/footer.html"); ?>
    </main>
</div>