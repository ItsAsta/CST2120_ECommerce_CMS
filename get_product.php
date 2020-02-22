<?php
require __DIR__ . '/vendor/autoload.php';
$mongoClient = (new MongoDB\Client);
$db = $mongoClient->ecommerce;
$collection = $db->products;

include_once('inc/phpFunc.php');
headerOutput('Edit Product', array("assets/styles/stylesheet.css", "assets/styles/bootstrap.css", "assets/slick/slick.css", "assets/slick/slick-theme.css"));
navigationOutput('Edit Product');
if (!isset($_SESSION['userId'])) {
    header('Location: staff_login.php');
}
?>

<div style="margin: 0 auto; text-align: center">
    <form action="fetched_product.php" method="post">

        <div class="col-lg">
            <div class="row">
                <label style="margin-left: 25px">Product Name<br> <input class="col-5" type="text"
                                                                         placeholder="Product Name"
                                                                         style="min-width: 200px"
                                                                         name="name"
                </label>
            </div>
            <button class="dark-btn" type="submit" name="getProduct">GET PRODUCT</button>
        </div>
    </form>
</div>
