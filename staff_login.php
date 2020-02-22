<?php

include_once('inc/phpFunc.php');
headerOutput('Login', array("assets/styles/stylesheet.css", "assets/styles/bootstrap.css", "assets/slick/slick.css", "assets/slick/slick-theme.css"));
navigationOutput('Login');
?>
<!-- STAFF LOGIN -->
<div class="container-sm">
    <div class="form-wrapper">
        <div id="customerLoginForm" style="display: inline-block">
            <form method="post" action="handlers/CMS_Handler.php">
                <h4>STAFF LOGIN</h4>
                <hr>
                <input type="text" name="username" class="col" placeholder="Email">
                <input type="password" name="password" class="col" placeholder="Password">
                <a id="showRegisterForm" style="display: block" class="aHover">Not registered? <b>Register!</b></a>
                <button name="login" type="submit" class="dark-btn" style="width: 150px">LOGIN</button>
            </form>
        </div>

        <div id="customerRegisterForm" style="display: inline-block">
            <form method="post" action="handlers/CMS_Handler.php">
                <h4>STAFF REGISTER</h4>
                <hr>
                <div class="col" style="display: block">
                    <input type="text" id="username" name="username" class="col"
                           placeholder="Username">
                </div>
                <div class="col" style="display: block">
                    <input type="password" id="registerPasswod" name="password" class="col"
                           placeholder="Password">
                    <input type="password" id="registerConfirmPassword" name="password" class="col"
                           placeholder="Confirm Password">
                </div>
                <a id="showLoginForm" style="display: block" class="aHover">Already registered? <b>Login!</b></a>
                <button name="register" type="submit" class="dark-btn" style="width: 150px">Register</button>
            </form>
        </div>
    </div>
</div>