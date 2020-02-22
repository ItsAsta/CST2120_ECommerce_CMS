<?php
require __DIR__ . '/vendor/autoload.php';
$mongoClient = (new MongoDB\Client);
$db = $mongoClient->ecommerce;
$collection = $db->products;

$trainer = $collection->findOne([
    'name' => $_POST['name']
]);

include_once('inc/phpFunc.php');
headerOutput('Edit Product', array("assets/styles/stylesheet.css", "assets/styles/bootstrap.css", "assets/slick/slick.css", "assets/slick/slick-theme.css"));
navigationOutput('Edit Product');

$sizeConc = "";
// A for loop to concatenate the shoe sizes for display
for ($i = 0; $i < count($trainer['sizes']); $i++) {
//    We want to avoid putting a ',' before the first element, so we need to check if that's our first iteration
    if ($i == 0) {
        $sizeConc .= $trainer['sizes'][$i];
    } else {
        $sizeConc .= ',' . $trainer['sizes'][$i] . '';
    }
}

// Check if our database query returned any results
if (count($trainer) > 0) {

    echo '<div style="margin: 0 auto; text-align: center">
    <form action="handlers/CMS_Handler.php" method="post">

        <div class="col-lg">
            <div class="row">
                <label style="margin-left: 25px">Product Name<br> <input class="col-5" type="text"
                                                                         placeholder="Product Name"
                                                                         style="min-width: 200px"
                                                                         name="name"
                                                                         value="' . $trainer['name'] . '"
                                                                         readonly
                    ></label>

                <label style="margin-left: 25px">Product Sizes<br> <input class="col-3"
                                                                                               placeholder="Sizes available separate by (,)"
                                                                                               style="min-width: 200px"
                                                                                               value="' . $sizeConc . '"
                                                                                               name="sizes" required></label>
                <label style="margin-left: 25px">Product Stock<br> <input class="col-3" type="number"
                                                                          placeholder="Amount in stock"
                                                                          style="min-width: 200px"
                                                                          value="' . $trainer['stock'] . '"
                                                                          name="stock" required></label>
            </div>

            <div class="row">
                <label style="margin-left: 25px">Product Type<br> <input class="col-5" type="text"
                                                                         placeholder="Product Type"
                                                                         style="min-width: 200px"
                                                                         value="' . $trainer['type'] . '"
                                                                         name="type" required></label>

                <label style="margin-left: 25px">Product Color<br> <input class="col-3" placeholder="Product Color"
                                                                             style="min-width: 200px"
                                                                             value="' . $trainer['color'] . '"
                                                                             name="color" required></label>
                <label style="margin-left: 25px">Product Price<br> <input class="col-3" type="text"
                                                                          placeholder="Product Price"
                                                                          style="min-width: 200px"
                                                                          value="' . $trainer['price'] . '"
                                                                          name="price" required></label>
            </div>

            <div class="row">
                <label style="margin-left: 25px">File Name<br> <input class="col-5" type="text" placeholder="File Name"
                                                                      style="min-width: 200px"
                                                                      value="' . $trainer['fileName'] . '"
                                                                      name="fileName" required></label>

            </div>
            <div class="row">
                <label style="width: 100%">Description <br><textarea style="height: 100px; width: 100%"
                                                                     placeholder="Product description"
                                                                     name="description" required>' . $trainer['description'] . '</textarea></label>
            </div>
            <button class="dark-btn" type="submit" name="editProduct">EDIT</button>
            <button class="dark-btn" type="submit" name="removeProduct">REMOVE</button>
        </div>
    </form>
</div>';
} else {
    echo '<div style="margin: 0 auto; text-align: center"><h4>Failed To Find <i>' . $_POST['name'] . '</i> In The Database</h4></div>';
}
?>
