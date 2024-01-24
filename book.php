<?php

$page_title = "Lunar Energy : Book";
include("includes/head.php");
include("php-functions/book-functions.php");
include("includes/login_functions.inc.php");

if (!isset($_SESSION['user_id'])) {
    redirect_user('unauthorized.php?a=book');
}

$error_d = '';
$d = '';

$today = date('Y-m-d');

// For demonstrating +28 days
// $today = '2024-01-20';

// populate_database($dbc, '2024-01-22', '2024-02-24');

$next_28 = date('Y-m-d', strtotime($today . "+ 27 days"));

$q = "SELECT date_id FROM dates WHERE date = '$next_28'";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) < 1) {
    repopulate_database($dbc, $next_28);
}

if (isset($_GET['sid'])) {
    $sid = $_GET['sid'];
} else {
    $sid = 1;
}

$now = date('Y-m-d H:i:s');

if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['d'])) {

    // Check if a date has been selected
    if (isset($_POST['date'])) {
        $d = $_POST['date'];  
    } else if (isset($_GET['d'])) {
        $d = $_GET['d'];
    } else {
        $error_d = 'Please select a date';
    }

    // Get service id if exists
    if (isset($_POST['services'])) {
        $sid = $_POST['services'];
    } 

}

?>

    <div id="body">
        <main id="book" class="main img-bg-black">
            <div class="heading">
                <h1 class="txt-green">BOOK MASSAGE</h1>
            </div>
            <section id="booking">
                <form action="book.php" method="POST">
                    <div class="date-time-heading">
                        <?php 
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($error_s)) {
                            echo '<h2 class="txt-orange">Select Service<span class="error"> - Please select a service</span></h2>';
                        } else {
                            echo '<h2 class="txt-orange">Select Service</h2>';
                        }
                        ?>
                    </div>
                    <div class="select-service-container">
                        <?php
                            create_services_dropdown($sid, $dbc);
                        ?>
                    </div>
                    <div class="date-time-heading txt-orange">
                        <?php  
                        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($error_d)) {
                            echo '<h2>Select Date<span class="error"> - '. $error_d .'</span></h2>';
                        } else {
                            echo '<h2>Select Date<h2>';
                        }
                        ?>
                    </div>
                    <div class="date-slides-container">
                        <div class="slide-btn-container left-chevron"><i class="fa-solid fa-circle-chevron-left txt-green nonvisible" id="scrollLeftBtn"></i></div>
                        <div class="slide" id="slideOne">
                            <div class="slide-flex-container">
                                <?php create_slide(0, 6, $d); ?>
                            </div>
                        </div>
                        <div class="slide hidden" id="slideTwo">
                            <div class="slide-flex-container">
                                <?php create_slide(7, 13, $d); ?>
                            </div>
                        </div>
                        <div class="slide hidden" id="slideThree">
                            <div class="slide-flex-container">
                                <?php create_slide(14, 20, $d); ?>
                            </div>
                        </div>
                        <div class="slide hidden" id="slideFour">
                            <div class="slide-flex-container">
                                <?php create_slide(21, 27, $d); ?>
                            </div>
                        </div>
                        <div class="slide-btn-container right-chevron"><i class="fa-solid fa-circle-chevron-right txt-green" id="scrollRightBtn"></i></div>
                    </div>
                    <div class="flex-center-xy">
                        <input type="submit" value="Search">
                    </div>
                </form>
                    <div class="time-slides-container">
                        <?php 
                        
                        if ((empty($error_d) && !empty($d)) || isset($_GET['te'])) {
                            if (isset($_GET['te']) && $_GET['te']) {
                                $error_t = "Please select a time";
                            } else {
                                $error_t = '';
                            }
                            include("includes/book-time.php");
                        }

                        ?>
                    </div> 
            </section>
            <script src="book.js"></script>
            <?php include("includes/footer.html") ?>
        </main>
    </div>
</body>