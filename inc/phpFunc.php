<?php

//This php function will output our html inside the html. It has 2 parameter, title and the stylesheet paths.
//The styleSheetPath is an array so we can use multiple stylesheets.
function headerOutput($title, $styleSheetPath)
{
    echo '<!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">';
    //We iterate over the length of the passed array so we can echo out every stylesheet that is passed as an argument.
    for ($i = 0; $i < count($styleSheetPath); $i++) {
        echo '<link rel="stylesheet" type="text/css" href="' . $styleSheetPath[$i] . '">';
    }

    echo '<title>' . $title . '</title>';

    //This function echo's out our java scripts.
    outputScripts();
    echo '</head>
          <body>';
}

//Simple function to output our scripts to our html.
function outputScripts()
{
    echo '<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="assets/scripts/indexJS.js"></script>
        <script type="text/javascript" src="assets/scripts/bootstrap.js"></script>
        <script type="text/javascript" src="assets/slick/slick.js"></script>
        <script type="text/javascript" src="https://kit.fontawesome.com/a054ec7c89.js" crossorigin="anonymous"></script>';
}

function navigationOutput($currentPage)
{

    // Using PHP, we'll add the first part of our navigation, which will be our class inside a div. It acts as a container.
    echo '<div class="nav-bar">
        <ul>';

    loopNavigation($currentPage);

    // At the end, we'll just close our element tags.
    echo '</ul>';
    outputPromotionNav();
    echo '</div>';
}

//This function will print out our navigation.
function loopNavigation($currentPage)
{
    session_start();
    // An array variable with our page names, which we'll match using the index with our second array.
    $pageTitle = array("Home", "View Products", "Add Product", "Edit Product", "Manage Orders", "Login");

    // An array variable with our file names which we'll redirect to using the HREF attribute.
    $fileNames = array("index.php", "view_products.php", "add_product.php", "get_product.php", "index.php", "staff_login.php");

    // We iterating over the length of $names array using a for loop.
    for ($i = 0; $i < count($pageTitle); $i++) {
        echo '<li ';
        /*
            In this if statement, we are checking if the name we currently iterated on is the same as the page we
            passed as an arguement inside our $currentPage parameter.
            If it matches, we'll add an id attribute into our element, and the string `active` which we use in our css.
        */
        if ($pageTitle[$i] == $currentPage) {
            echo 'id="active" ';
        }

        // We checking if the user is logged in by checking if there is any session set.
        if (array_key_exists("userId", $_SESSION)) {
            // If the if statement returns true, we'll get the 4th index in our array and change the string to logout.
            // Since the user is logged in, we want to display logout instead of login/register.
            $pageTitle[5] = "Logout";
        }

        if ($pageTitle[$i] == "Logout") {
            echo 'id="account-status" ';
            echo '><a href="handlers/end_session.php">' . $pageTitle[$i] . '</a></li>';
            break;
        }

        // We then echo out our html code.
        echo '><a id="' . $pageTitle[$i] . '" href="' . $fileNames[$i] . '">' . $pageTitle[$i] . '</a></li>';
    }
}

function outputPromotionNav()
{
    echo '<div class="promotion-banner-container">
        <div class="row">
            <div class="promotion-col">
                <span>SALE ON FEATURED TRAINERS</span>
                <p>20% off on all featured trainers</p>
            </div>
            <div class="promotion-col">
                <span>FREE DELIVERY</span>
                <p>Free delivery on orders over £30</p>
            </div>
            <div class="promotion-col">
                <span>FREE RETURNS</span>
                <p>Return unwanted trainers within 30 days</p>
            </div>
        </div>
    </div>';
}

function navigationFunctionality()
{
    echo '<div class="nav-cart">
            <li><a href="basket.php"><i class="fas fa-shopping-cart">1</i></a></li>
            <li><a href="customer_login.php">LOGOUT</a></li>
        </div>';
}

//Outputs all the contents for the footer.
function footerOutput($currentPage)
{
    openFooter();
    leftFooterOutput($currentPage);
    centerFooterOutput();
    rightFooterOutput();
    closeFooter();
    copyrightFooterOutput();
}

function leftFooterOutput($currentPage)
{
    // Using PHP, we'll add the first part of our navigation, which will be our class inside a div. It acts as a container.
    echo '<div class="footer-container-left">
        <h2>NAVIGATE</h2>
        <hr>
        <div class="footer-nav">
            <ul>';

    loopNavigation($currentPage);

    // At the end, we'll just close our elements tags.
    echo '</ul></div></div>';
}

//A very simple php function to just output html.
function centerFooterOutput()
{
    echo '<div class="footer-container-center">
            <h2>CONTACT</h2>
            <hr>
            
            <i class="fab fa-snapchat"></i>
            <span>@AzuzAlDosari</span>
            
            <a href="https://www.instagram.com/azuzaldosari/">
            <i class="fab fa-instagram"></i>
            <span>@AzuzAlDosari</span>
            </a>
            
            <a href="https://github.com/ItsAsta">
            <i class="fab fa-github"></i>
            <span>@ItsAsta</span>
            </a>
            
            <a href="https://rspeer.org/">
            <i class="fas fa-globe"></i>
            <span>WWW.RSPeer.org</span>
            </a>
          </div>';
}

//This php function will output our right side footer.
function rightFooterOutput()
{
    echo '<div class="footer-container-right">
        <h2>TOP 5 USERS</h2>
        <hr>
        <ol class="footer-top-list">';

    echo '<script  type="text/JavaScript">
            //A for loop iterating over the return value of our getTopFive function.
            // We use the length of the array so we know when the for loop should break out of the loop. 
            for (let i = 0; i < getTopFive().length; i++) {
                //Stores a li html element into a variable.
                let li = document.createElement("li");
                
                //Since our return value has 2 arrays within 1 array. The array is the username
                //The second array is the points. We`ll use the incremented integer to get the username
                //Then get the respective points and display it via html.
                li.innerHTML = getTopFive()[i][0].toUpperCase();
                
                //Get the parent element of the html of which we want to display our li element under, then store it into a variable.
                let footerParent = document.getElementsByClassName("footer-top-list");
                
                //We then use that parent variable, using the first index, then inserting our li element before our parent`s last child.
                footerParent[0].insertBefore(li, footerParent.lastChild);
            }
        </script>';

    //Close our tags appropriately.
    echo '</ol>
    </div>';
}

//Put a copyright banner at the end of our footer
function copyrightFooterOutput()
{
    echo '<div class="copyright-footer">
        <span>© Middlesex University - AbdulAziz Al-Khafaji</span>
    </div>';
}

//A function to open our footer element.
function openFooter()
{
    echo '<div class="footer">';
}

//A function to close our footer element.
function closeFooter()
{
    echo '</div></body></html>';
}

//A simple function that aids in sending information to the console debugger via php.
function debug_to_console($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}