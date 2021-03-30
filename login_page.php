<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connection</title>
    <link rel="stylesheet" href="styles/fonts.css">
    <link rel="stylesheet" href="styles/connection.css">
</head>
<body>

<div class="container">
    <div class="formOption">
        <div class="loginOption option optionSelected">Login</div>
        <div class="createOption option">Create</div>
    </div>
    <div class="formsContainer">

        <div class="createContainer">
            <form action="" method="post" class="form" action="loginUtils.php">
                <input type="text" name="usernameCreate" class="inputForm" id="usernameCreate" placeholder="Username"
                       pattern="^[A-Za-z0-9_]{3,20}$" autofocus required>
                <input type="password" name="password" class="inputForm" id="passwordCreate" placeholder="Password"
                       pattern="^[A-Za-z0-9_!@#$%*]{6,50}$" autocomplete="on" required>
                <input type="submit" value="Create Account" name="submit" class="inputSubmit">
            </form>
        </div>
        <div class="loginContainer">
            <form action="" method="post" class="form" action="loginUtils.php">
                <input type="text" name="usernameLogin" class="inputForm" id="usernameLogin" placeholder="Username"
                       required>
                <input type="password" name="password" id="password" class="inputForm" placeholder="Password"
                       autocomplete="on" required>
                <input type="submit" value="Login" name="submit" class="inputSubmit">
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src= "scripts/login.js"></script>

</body>
</html>

<?php
require_once "loginUtils.php";
require_once "utils.php";
if (!isset($_SESSION)) {
    session_start();
}


if (isset($_POST)) {
    $userConn = getUserConnection();
    if (isset($_POST['usernameCreate'])) {

        $result = addUser($_POST['usernameCreate'], $_POST['password'], $userConn);
        if (strpos($result, 'successfully') !== false) {

            return;
        }
        //echo $result;
        echo "$result";
    } elseif (isset($_POST['usernameLogin'])) {
        if (loginUser($_POST['usernameLogin'], $_POST['password'], $userConn) > 0) {
            alert("Successfully logged in!");
            header("Location: /links_page.php");
        } else {
            alert("Wrong username or password.");
        }
    }
}
?>