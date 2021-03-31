<?php
require_once "connection.php";
require_once "utils.php";
if(!isset($_SESSION))
{
    session_start();
}
function checkIfUserExits($username, $connection){
    $query = $connection->query("SELECT username FROM users.Users WHERE username LIKE '".$username."'");
    return mysqli_num_rows($query) > 0;
}

function loginUser($username, $password, $connection){
    // echo "SELECT username FROM users.Users WHERE username LIKE '".$username."' AND password='".$password."'";
    $query = $connection->query("SELECT * FROM users.Users WHERE username LIKE '".$username."'");
    //Content
    $infos = mysqli_fetch_array($query);
    if (!password_verify($password, $infos["password"])){
        return false;
    }

    $_SESSION["username"] = $infos["username"];
    $_SESSION["uuid"] = $infos["uuid"];
    $_SESSION["reg_date"] = $infos["reg_date"];
    return mysqli_num_rows($query) > 0;
}

function getUserUuid($username, $connection){
    $query = $connection->query("SELECT uuid FROM users.Users WHERE username LIKE '".$username."'");
    return mysqli_fetch_array($query)["uuid"];
}

function getUserRegisterDate($username, $connection){
    $query = $connection->query("SELECT reg_date FROM users.Users WHERE username LIKE '".$username."'");
    return mysqli_fetch_array($query)["reg_date"];
}

function logoutUser(){
    session_destroy();
}

function updateUsername($uuid, $conn, $username){
    $sql = ("UPDATE users.Users SET username='".$username."' WHERE uuid='" . $uuid . "'");
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $_SESSION['username'] = $username;

}

function updatePassword($uuid, $password, $conn){
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $sql = ("UPDATE users.Users SET password='".$hashed."' WHERE uuid='" . $uuid . "'");
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function addUser($username, $password, $connection){
    if (checkIfUserExits($username, $connection)){
        return "Username is already taken, please choose another one.";
    }elseif (!isUsernameValid($username)){
        return "Your username is not valid, it must be 3 to 20 characters long, can only contain letters, numbers and underscores.";
    }elseif (!isPasswordValid($password)){
        return "Your password is not valid, it must be at least 6 characters long, can only contain letters, numbers and these special characters '_ ! @ # $ % *'.";
    }
    $hashedPw = password_hash($password, PASSWORD_DEFAULT);
    $sql = ("INSERT INTO users.Users (username, password, uuid) VALUES ('".$username."', '".$hashedPw."', UUID())");

    $connection->query($sql);
    $_SESSION["username"] = $username;
    $_SESSION["uuid"] = getUserUuid($username, $connection);
    $_SESSION["reg_date"] = getUserRegisterDate($username, $connection);
    header("Location: /links_page.php");

}

function isUsernameValid($input){
    /*
        "/^[
        A-Z # any uppercase letters
        a-z # any lowercase letters
        0-9 # any digits
        _ # underscore
        ]{3,20} # minimum 3 and maximum 20 characters
        $/x"
     */
    return preg_match("/^[A-Za-z0-9_]{3,20}$/", $input);
}

function isPasswordValid($input){
    /*
        "/^[
        A-Z # any uppercase letters
        a-z # any lowercase letters
        0-9 # any digits
        _!@#$%* # special characters allowed
        ]{6,50} # minimum 6 and maximum 50 characters
        $/x"
     */
    return preg_match("/^[A-Za-z0-9_!@#$%*]{6,50}$/", $input);
}

if(isset($_POST)){
    if (isset($_POST['disconnect'])) {
        logoutUser();
        header("Location: /index.php");
    }
}

?>
