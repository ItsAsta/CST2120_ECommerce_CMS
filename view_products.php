<?php
require __DIR__ . '/vendor/autoload.php';
$mongoClient = (new MongoDB\Client);
$db = $mongoClient->ecommerce;
$collection = $db->products;

include_once('inc/phpFunc.php');
headerOutput('View Products', array("assets/styles/stylesheet.css", "assets/styles/bootstrap.css", "assets/slick/slick.css", "assets/slick/slick-theme.css"));
navigationOutput('View Products');
if (!isset($_SESSION['userId'])) {
    header('Location: staff_login.php');
}
?>

<div class="cart-product-container">
    <table style="width: 100%">
        <thead class="table-header">
        <tr>
            <th class="col-12" scope="col"><span>Item</span></th>
            <th class="col-11" scope="col"><span>Price</span></th>
            <th class="col-10" scope="col"><span>Stock Count</span></th>
            <th class="col" scope="col"><span>Color</span></th>
        </tr>
        </thead>
        <tbody>
        <?php
        //        Query over our whole collection
        $trainers = $collection->find();
        //        Loop over the whole collection
        foreach ($trainers as $trainer) {
            echo '<tr>
            <td class="col">
                <div class="product-photo">
                    <img src="upload/' . $trainer['fileName'] . '" width="150px" height="auto">
                </div>
                <div class="product-details">
                    <p><strong>' . $trainer['name'] . '</strong></p>
                    <strong>Description: </strong><p>' . $trainer['description'] . '</p>
                </div>
            <td class="price-qty-total col">
                <span><strong>£' . $trainer['price'] . '</strong></span>
            </td>
            <td class="price-qty-total col">
                <span><strong>' . $trainer['stock'] . '</strong></span>
            </td>
            <td class="price-qty-total col">
                <span><strong>' . $trainer['color'] . '</strong></span>
            </td>
        </tr>';
        }
        ?>
        </tbody>
    </table>
</div>
