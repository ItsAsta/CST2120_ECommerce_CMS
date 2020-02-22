<?php
include_once('inc/phpFunc.php');
headerOutput('Home', array("assets/styles/stylesheet.css", "assets/styles/bootstrap.css", "assets/slick/slick.css", "assets/slick/slick-theme.css"));
navigationOutput('Home');

if (isset($_SESSION['userId'])) {
    echo '<div style="margin: 0 auto; text-align: center"><h1>Content Management System</h1></div>';
} else {
//    Redirect to login page
    header('Location: staff_login.php');
}
