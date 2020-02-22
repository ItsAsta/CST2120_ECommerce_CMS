<?php
require __DIR__ . '/../vendor/autoload.php';
$mongoClient = (new MongoDB\Client);
$db = $mongoClient->ecommerce;
$collection = $db->products;
$staffCollection = $db->staff;

include_once('../inc/phpFunc.php');
headerOutput('Home', array("../assets/styles/stylesheet.css", "../assets/styles/bootstrap.css", "../assets/slick/slick.css", "../assets/slick/slick-theme.css"));

// Check if we got a post request with the name 'addProduct'
if (isset($_POST['addProduct'])) {

    $trainer = $collection->insertOne([
        'name' => $_POST['name'],
        'sizes' => explode(",", $_POST['sizes']),
        'stock' => intval($_POST['stock']),
        'type' => $_POST['type'],
        'color' => $_POST['color'],
        'price' => doubleval($_POST['price']),
        'fileName' => $_POST['fileName'],
        'description' => $_POST['description']
    ]);

    if ($trainer->getInsertedCount() > 0) {
        echo '<div style="margin: 0 auto; text-align: center"><h4>Added <i>' . $_POST['name'] . '</i> To The Database</h4></div>';
    } else {
        echo '<div style="margin: 0 auto; text-align: center"><h4>Failed To Add <i>' . $_POST['name'] . '</i> To The Database</h4></div>';
    }
}

// Check if we got a post request with the name 'editProduct'
if (isset($_POST['editProduct'])) {

    $trainer = $collection->updateOne(
        ['name' => $_POST['name']],
        array('$set' => array(
            'sizes' => explode(",", $_POST['sizes']),
            'stock' => intval($_POST['stock']),
            'type' => $_POST['type'],
            'color' => $_POST['color'],
            'price' => doubleval($_POST['price']),
            'fileName' => $_POST['fileName'],
            'description' => $_POST['description']
        ))
    );

    if ($trainer->getModifiedCount() > 0) {
        echo '<div style="margin: 0 auto; text-align: center"><h4>Updated <i>' . $_POST['name'] . '</i> In The Database</h4></div>';
    } else {
        echo '<div style="margin: 0 auto; text-align: center"><h4>Failed To Update <i>' . $_POST['name'] . '</i> In The Database</h4></div>';
    }
}

// Check if we got a post request with the name 'removeProduct'
if (isset($_POST['removeProduct'])) {
    $trainer = $collection->deleteOne(
        ['name' => $_POST['name']]
    );

    if ($trainer->getDeletedCount() > 0) {
        echo '<div style="margin: 0 auto; text-align: center"><h4>Deleted <i>' . $_POST['name'] . '</i> From The Database</h4></div>';
    } else {
        echo '<div style="margin: 0 auto; text-align: center"><h4>Failed To Delete <i>' . $_POST['name'] . '</i> From The Database</h4></div>';
    }
}

// Check if we got a post request with the name 'register'
if (isset($_POST['register'])) {

    $id = $staffCollection->count();
    $registerData = [
        'staffId' => ++$id,
        'username' => filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING),
        'password' => filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)
    ];

    $checkDupl = $staffCollection->findOne(array('username' => $registerData['username']));

    if (count($checkDupl, COUNT_NORMAL) > 0) {
        echo '<div style="margin: 0 auto; text-align: center"><h4>Username has already been used!</h4></div>';
    } else {
        $registerResult = $staffCollection->insertOne($registerData);
        if ($registerResult->getInsertedCount() > 0) {
            header('Location: ../staff_login.php');
        } else {
            echo '<div style="margin: 0 auto; text-align: center"><h4>Failed to register account!</h4></div>';
        }
    }
}

// Check if we got a post request with the name 'login'
if (isset($_POST['login'])) {
//    Store username and password in variables
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
//    Query the database and find a document matching same username and password
    $staff = $staffCollection->findOne(array('username' => $username, 'password' => $password));
//    Check if the user input matches what we got in the database
    if ($username == $staff['username'] && $password == $staff['password']) {
//        Start a session for the user with their unique staff id
        session_start();
        $_SESSION["userId"] = $staff['staffId'];
//        Return the user back to the main page
        header('Location: ../index.php');
    } else {
        echo '<div style="margin: 0 auto; text-align: center"><h4>Username or Password is incorrect!</h4></div>';
    }
}
