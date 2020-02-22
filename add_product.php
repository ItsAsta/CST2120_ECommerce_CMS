<?php
require __DIR__ . '/vendor/autoload.php';
$mongoClient = (new MongoDB\Client);
$db = $mongoClient->ecommerce;
$collection = $db->products;

include_once('inc/phpFunc.php');
headerOutput('Add Product', array("assets/styles/stylesheet.css", "assets/styles/bootstrap.css", "assets/slick/slick.css", "assets/slick/slick-theme.css"));
navigationOutput('Add Product');
if (!isset($_SESSION['userId'])) {
    header('Location: staff_login.php');
}
?>
<div style="margin: 0 auto; text-align: center">
    <form action="handlers/CMS_Handler.php" method="post">

        <div class="col-lg">
            <div class="row">
                <label style="margin-left: 25px">Product Name<br> <input class="col-5" type="text"
                                                                         placeholder="Product Name"
                                                                         style="min-width: 200px"
                                                                         name="name" required></label>

                <label style="margin-left: 25px">Product Sizes<br> <input class="col-3"
                                                                          placeholder="Sizes available separate by (,)"
                                                                          style="min-width: 200px"
                                                                          name="sizes" required></label>
                <label style="margin-left: 25px">Product Stock<br> <input class="col-3" type="number"
                                                                          placeholder="Amount in stock"
                                                                          style="min-width: 200px"
                                                                          name="stock" required></label>
            </div>

            <div class="row">
                <label style="margin-left: 25px">Product Type<br> <input class="col-5" type="text"
                                                                         placeholder="Product Type"
                                                                         style="min-width: 200px"
                                                                         name="type" required></label>

                <label style="margin-left: 25px">Product Color<br> <input class="col-3" placeholder="Product Color"
                                                                          style="min-width: 200px"
                                                                          name="color"></label>
                <label style="margin-left: 25px">Product Price<br> <input class="col-3" type="text"
                                                                          placeholder="Product Price"
                                                                          style="min-width: 200px"
                                                                          name="price"
                                                                          required></label>
            </div>

            <div class="row">
                <label style="margin-left: 25px">File Name<br> <input class="col-5" type="text" placeholder="File Name"
                                                                      style="min-width: 200px"
                                                                      name="fileName" required></label>

            </div>
            <div class="row">
                <label style="width: 100%">Description <br><textarea style="height: 100px; width: 100%"
                                                                     placeholder="Product description"
                                                                     name="description" required></textarea></label>
            </div>
            <button class="dark-btn" type="submit" name="addProduct">ADD PRODUCT</button>
        </div>
    </form>
</div>
