<?php 

// Set page title and include head
$page_title = "Lunar Energy";
include("includes/head.php");

// Include functions
include("php-functions/home-functions.php");
include("php-functions/spam-scrubber.php");
include("includes/login_functions.inc.php");


if (isset($_GET['action']) && $_GET['action'] == 'd') {
    require_once("mysqli_connect.php");
    delete_review($dbc, $_GET['id']);
}

// For posting a review
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['star-count'])) {

    require_once("mysqli_connect.php");

    $user_id = $_SESSION['user_id'];
    $stars = $_POST['star-count'];
    $body = spam_scrubber($_POST['body']);

    if (isset($_GET['e']) && $_GET['e']) {
        $q = "UPDATE reviews SET star_rating = '$stars', body = '$body', post_date = NOW() WHERE fk_user_id = '$user_id'";
    } else {
        $q = "INSERT INTO reviews (fk_user_id, star_rating, body, post_date) VALUES ('$user_id', '$stars', '$body', NOW())";
    }

    $r = mysqli_query($dbc, $q);

    if ($r) {
        mysqli_close($dbc);
        redirect_user();
    } else {
        mysqli_close($dbc);
        echo '<p class="error">Sorry, your review could not be posted due to a system error</p>';
    }

}

?>

<!-- Start HTML Content -->
    <div class="hidden review-modal" id="reviewModal">
        <?php
        
        if (isset($_SESSION['user_id'])) {
            include("includes/review.php");
        } else {
            echo '
            <div class="not-logged-in">
                <h2 class="txt-center">You must be logged in to write a review</h2>
                <div class="btns">
                    <div class="btn-container cancel-btn btn-link semi-bold txt-center" id="cancelReview">Cancel</div>
                    <div class="btn-container login-btn txt-center"><a href="login.php" class="btn-link semi-bold">Login</a></div>
                </div>
            </div>
            ';
        }
        ?>
    </div>

    <div id="body">

        <!-- Start Main Content -->
        <main id="home" class="main">
            <section id="landing">
                <a href="book.php" class="btn-link landing-btn bold">Book Now</a>
            </section>

            <!-- Start THE MASSEUSE Section -->
            <section id="aboutMasseuse" class="img-bg-black">
                <h1>OUR MASSEUSE</h1>
                <div>
                    <div class="masseuse-img-container">
                        <img src="images/1x1masseuse.jpg" alt="Marina Schiers">
                    </div>
                    <div class="text-container">
                        <div>
                            <h2 class="txt-orange">Marina Schiers</h2>
                            <p>Marina Schiers, LMT, is the owner and practicing massage therapist at Lunar Energy Massage & Wellness. She has been practicing as a LMT since graduating Healing Mountain Massage School in 2019 where she completed an advanced holistic health program with a total of 1200 hours.</p>
                        </div>
                        <div>
                            <a href="contact.php" class="btn-link bold"><i class="fa-solid fa-envelope"></i> Message</a>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End of THE MASSEUSE Section -->

            <!-- Start LOCATION Section -->
            <section id="aboutLocation" class="bg-white">
                <h1>LOCATION</h1>
                <div>
                    <div class="maps-container">

                        <!-- Display map using Google Maps API -->
                        <div id="map"><p class="txt-center bold">Loading Map...</p></div>

                        <div>
                            <a 
                            href="https://www.google.com/maps/place/Lunar+Energy+Massage+%26+Wellness/@41.3289833,-111.8254151,19.5z/data=!4m6!3m5!1s0x8753a163c853fcb3:0xc831fdfc8c9dc286!8m2!3d41.3290739!4d-111.8251465!16s%2Fg%2F11spywyc7n?entry=ttu"  
                            target="_blank"
                            class="btn-link">
                                <i class="fa-solid fa-location-dot"></i><span class="semi-bold"> 3873 North Wolf Creek Drive, Eden, UT 84310</span>
                            </a>
                        </div>
                    </div>
                    <div class="location-info-wrapper">
                        <div class="hours-container">
                            <h2 class="txt-center">Business Hours</h2>
                            <?php 
                                echo create_bh_div('Sunday', '10', '4');
                                echo create_bh_div('Monday', '9', '7');
                                echo create_bh_div('Tuesday', '9', '7');
                                echo create_bh_div('Wednesday', '9', '7');
                                echo create_bh_div('Thursday', '9', '7');
                                echo create_bh_div('Friday', '9', '7');
                                echo create_bh_div('Saturday', '10', '4');
                            ?>
                        </div>
                        <div class="location-info-section phone-wrapper">
                            <h2>Phone</h2>
                            <p class="semi-bold">(801) 624-9990</p>
                        </div>
                        <div class="location-info-section questions-wrapper">
                            <h2>Questions?</h2>
                            <div>
                                <a href="faq.php" class="btn-link bold"><i class="fa-solid fa-circle-question"></i> FAQ</a>
                                <a href="contact.php" class="btn-link bold"><i class="fa-solid fa-envelope"></i> Message</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End LOCATION Section -->

            <!-- Start REVIEWS Section -->
            <section id="reviewSection" class="img-bg-black">
            
                <div class="review-container-heading">
                    <h1 class="txt-green">REVIEWS</h1>
                    <form action="index.php" method="POST">
                        <div class="custom-select">
                            <input type="submit" value="Apply" id="applyReviewFilter">
                            <select name="review_filter">
                                <option value="1">Newest</option>
                                <option value="2">Oldest</option>
                                <option value="3">Highest Rated</option>
                                <option value="4">Lowest Rated</option>
                            </select>
                        </div>
                        <div class="review-btn btn-link semi-bold" id="writeReviewBtn">
                            <p>Write a Review</p>
                        </div>
                    </form>
                </div>

                <div class="reviews">
                    <div class="individual-reviews">
                    <?php 


                    $q_all = "SELECT first_name, last_name, star_rating, body, post_date FROM reviews INNER JOIN users_personal ON reviews.fk_user_id = users_personal.fk_user_id";
                    $r_all = mysqli_query($dbc, $q_all);

                    if (mysqli_num_rows($r_all) != 0) {

                        $user_img = "images/1x1userimage.jpg";
                        if (isset($_SESSION['user_id'])) {
                            $user_id = $_SESSION['user_id'];

                            require_once("mysqli_connect.php");

                            $q_single = "SELECT first_name, last_name, star_rating, body, post_date FROM reviews INNER JOIN users_personal ON reviews.fk_user_id = users_personal.fk_user_id WHERE reviews.fk_user_id = '$user_id'";
                            $r_single = mysqli_query($dbc, $q_single);

                            if (mysqli_num_rows($r_single) == 1) {
                                $row = mysqli_fetch_assoc($r_single);
                                echo create_review_div($user_img, $row['first_name'], $row['last_name'], $row['post_date'], $row['star_rating'], $row['body'], $user_id);
                            }
                        }

                        echo '<div class="all-reviews img-bg-white">';

                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['review_filter'])) {
                            $q_others = get_review_query($_POST['review_filter'], $user_id);
                        } else {
                            $q_others = "SELECT first_name, last_name, star_rating, body, post_date FROM reviews INNER JOIN users_personal ON reviews.fk_user_id = users_personal.fk_user_id WHERE reviews.fk_user_id != '$user_id'";
                        }

                        $r_others = mysqli_query($dbc, $q_others);

                        if (mysqli_num_rows($r_others) != 0) {
                            while ($row2 = mysqli_fetch_array($r_others, MYSQLI_ASSOC)) {
                                echo create_review_div($user_img, $row2['first_name'], $row2['last_name'], $row2['post_date'], $row2['star_rating'], $row2['body'], 0);
                            }
                        }

                        echo '</div>';

                    } else {
                        echo '<div class="no-reviews"><h2 class="txt-green">Be the first to review!</h2></div>';
                    }
                    
                    ?>
                </div>
            </div>
           </section>
           <?php include("includes/footer.html"); ?>
        </main>
    </div>
    <script src="home.js"></script>
</body>