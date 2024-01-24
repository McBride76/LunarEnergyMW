<?php

    require_once("mysqli_connect.php");

    $stars = 1;
    $body = '';

    // Check if user has an existing review
    $user_id = $_SESSION['user_id'];
    $q = "SELECT fk_user_id, star_rating, body FROM reviews WHERE fk_user_id = '$user_id'";
    $r = mysqli_query($dbc, $q);

    if (mysqli_num_rows($r) == 1) {

        // Store existing review data in variables
        $row = mysqli_fetch_assoc($r);
        $stars = $row['star_rating'];
        $body = $row['body'];

        echo '<form action="index.php?e=true" method="post" id="reviewForm">';

    } else {
        echo '<form action="index.php" method="post" id="reviewForm">';
    }

?>
    
        <h2 class="txt-center">Write a Review</h2>

    <div class="rating-section">
        <div class="stars-container">
            <i class="fa-regular fa-star r-m-star" id="1star"></i>
            <i class="fa-regular fa-star r-m-star" id="2star"></i>
            <i class="fa-regular fa-star r-m-star" id="3star"></i>
            <i class="fa-regular fa-star r-m-star" id="4star"></i>
            <i class="fa-regular fa-star r-m-star" id="5star"></i>
        </div>
        <input type="hidden" name="star-count" id="hiddenStarCount" value="<?php echo $stars; ?>">
    </div>
    <div class="body-section">
        <textarea name="body" id="reviewBody" value="<?php echo $body; ?>"></textarea>
    </div>
    <div class="btns">
        <div class="btn-container cancel-btn btn-link semi-bold txt-center" id="cancelReview">Cancel</div>
        <div class="btn-container"><input type="submit" value="Submit"></div>
    </div>
</form>