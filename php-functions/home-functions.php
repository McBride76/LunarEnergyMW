<?php

function delete_review($dbc, $user_id) {
    $q = "DELETE FROM reviews WHERE fk_user_id = '$user_id'";
    $r = mysqli_query($dbc, $q);
    if ($r) {
        return "<div>
            <h3>Your review has successfully been deleted</h3>
            <div><p>Close</p></div>
        </div>";
    } else {
        return '<div>
            <h3>There has been a system error. Please <a href="contact.php">contact us</a>for assistance.</h3>
            <div><p>Close</p></div>
        </div>';
    }
}

function create_bh_div($day, $open, $close) {
    return '<div class="hours-div">
        <p>' . $day . '</p>
        <p>' . $open . ':00 AM - ' . $close . ':00 PM</p>
    </div>';
}

function create_stars_div($stars) {
    switch($stars) {
        case 1:
            return '
            <i class="fa-solid txt-orange fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>';
        case 2:
            return '
            <i class="fa-solid txt-orange fa-star"></i>
            <i class="fa-solid txt-orange fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
            ';
        case 3:
            return '
            <i class="fa-solid txt-orange fa-star"></i>
            <i class="fa-solid txt-orange fa-star"></i>
            <i class="fa-solid txt-orange fa-star"></i>
            <i class="fa-regular fa-star"></i>
            <i class="fa-regular fa-star"></i>
            ';
        case 4:
            return '
            <i class="fa-solid txt-orange fa-star"></i>
            <i class="fa-solid txt-orange fa-star"></i>
            <i class="fa-solid txt-orange fa-star"></i>
            <i class="fa-solid txt-orange fa-star"></i>
            <i class="fa-regular fa-star"></i>
            ';
        case 5:
            return '
            <i class="fa-solid txt-orange fa-star"></i>
            <i class="fa-solid txt-orange fa-star"></i>
            <i class="fa-solid txt-orange fa-star"></i>
            <i class="fa-solid txt-orange fa-star"></i>
            <i class="fa-solid txt-orange fa-star"></i>
            ';
        default:
        return '<p>Unable to retrieve rating</p>';
    }
}

function create_review_div($userImg, $fname, $lname, $date, $stars, $body, $id) {

    $stars_div = create_stars_div($stars);

    if ($id == 0) {

        return '<div class="review img-bg-white semi-bold">
        <div class="review-user-date">
            <img src="' . $userImg . '">
            <div>
                <p>' . $fname . ' ' . $lname[0] . '.</p>
                <p>' . $date . '</p>
                <div class="review-stars">
                    ' . $stars_div . '
                </div>
            </div>
        </div>
        <div class="review-body">
            <p>' . $body . '</p>
        </div>
    </div>';

    } else {

        return '<div class="review your-review img-bg-white semi-bold">
        <div class="review-user-date">
            <img src="' . $userImg . '">
            <div>
                <p>' . $fname . ' ' . $lname[0] . '.</p>
                <p>' . $date . '</p>
                <div class="review-stars">
                    ' . $stars_div . '
                </div>
            </div>
        </div>
        <div class="review-body">
            <p>' . $body . '</p>
        </div>
        <div class="actions">
            <div class="edit-review" id="editReview"><i class="fa-solid fa-pen-to-square"></i></div>
            <div class="delete-review"><a href="index.php?action=d&id=' . $id . '"><i class="fa-solid fa-trash-can"></i></a></div>
        </div>
    </div>';

    }

}

function get_review_query($value, $id) {
    switch($value) {
        case "1": 
            return "SELECT first_name, last_name, star_rating, body, post_date FROM reviews INNER JOIN users_personal ON reviews.fk_user_id = users_personal.fk_user_id WHERE reviews.fk_user_id != '$id' ORDER BY post_date DESC";
        case "2":
            return "SELECT first_name, last_name, star_rating, body, post_date FROM reviews INNER JOIN users_personal ON reviews.fk_user_id = users_personal.fk_user_id WHERE reviews.fk_user_id != '$id' ORDER BY post_date ASC";
        case "3":
            return "SELECT first_name, last_name, star_rating, body, post_date FROM reviews INNER JOIN users_personal ON reviews.fk_user_id = users_personal.fk_user_id WHERE reviews.fk_user_id != '$id' ORDER BY star_rating DESC";
        case "4":
            return "SELECT first_name, last_name, star_rating, body, post_date FROM reviews INNER JOIN users_personal ON reviews.fk_user_id = users_personal.fk_user_id WHERE reviews.fk_user_id != '$id' ORDER BY star_rating ASC";
        default:
            return "SELECT first_name, last_name, star_rating, body, post_date FROM reviews INNER JOIN users_personal ON reviews.fk_user_id = users_personal.fk_user_id WHERE reviews.fk_user_id != '$id' ORDER BY post_date DESC";
    }
}

?>