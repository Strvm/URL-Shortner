<?php
require_once "utils.php";
$userConn = openConnection("users");
$linkConn = openConnection("links");
function openConnection($db){
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "$db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($db == 'users') {
        $sql = "CREATE TABLE $db (
    username VARCHAR(30) NOT NULL PRIMARY KEY,
    password VARCHAR(30) NOT NULL,
    uuid VARCHAR(36) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
        $conn->query($sql);
    }
    if ($db == 'links') {
        $sql = "CREATE TABLE $db (
    owner VARCHAR(36) NOT NULL,
    link_key VARCHAR(10) NOT NULL PRIMARY KEY,
    link VARCHAR(2083) NOT NULL,
    uses INT(255) NOT NULL,
    active TINYINT(1) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";


    if ($conn->query($sql)=== FALSE) {
       // echo "Error: " . $sql . "<br>" . $conn->error;
    }
    }


    return $conn;
}
function getUserConnection(){
    global $userConn;
    return $userConn;
}

function getLinksonnection(){
    global $linkConn;
    return $linkConn;
}

function closeConnection($conn){
    $conn->close();
}

function __destruct(){
    global $userConn;
    $userConn->close();
}
?>
