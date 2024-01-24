<?php 

include("includes/login_functions.inc.php");
include("php-functions/book-functions.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_GET['d']) && !empty($_GET['d'])) {
        $d = $_GET['d'];
    } else {
        redirect_user('book.php');
    }

    if (isset($_GET['s'])) {
        $sid = $_GET['s'];
    }

    if (isset($_POST['time']) && !empty($_POST['time'])) {
        $t = $_POST['time'];
    } else {
        redirect_user('book.php?te=true&d='. $d .'&sid=' . $sid . '');
    }

    require('mysqli_connect.php');

    $t = to_sql_time($t);

    $q = "SELECT date_id, time_id, service_id FROM dates JOIN times JOIN services WHERE date = '$d' AND time = '$t' AND service_id = '$sid'";
    $r = mysqli_query($dbc, $q);

    $row = mysqli_fetch_row($r);

    if (mysqli_num_rows($r) > 0) {
        redirect_user('confirm-final.php?d='. $row[0] .'&t='. $row[1] .'&s='. $row[2] .'');
    } else {
        redirect_user();
    }

}

?>