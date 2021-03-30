<?php
if(!isset($_SESSION)) {
    session_start();
}
require_once "utils.php";
require_once "connection.php";


function generateKey()
{
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_';
    $randomString = '';
    for ($i = 0; $i < 8; $i++) {
        $randomString .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $randomString;
}

function isValidUrl($url)
{
    return filter_var($url, FILTER_VALIDATE_URL);
}

function saveLink($url, $owner, $conn)
{
    $sql = ("INSERT INTO links.links (owner, link_key, link, uses, active) VALUES ('" . $owner . "', '" . generateKey() . "', '" . $url . "', 0, 1)");


    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } else {
        echo "DONE";
    }
}

function getUrlFromKey($key, $conn)
{
    $sql = ("SELECT link FROM links.links WHERE link_key='" . $key . "'");
    return mysqli_fetch_array($conn->query($sql))["link"];
}

function getInfoFromKey($key, $conn)
{
    $sql = ("SELECT * FROM links.links WHERE link_key='" . $key . "'");
    return mysqli_fetch_array($conn->query($sql));
}

function getAllUserLinks($uuid, $conn)
{
    $sql = ("SELECT * FROM links.links WHERE owner='" . $uuid . "' ORDER BY reg_date DESC");
    return $conn->query($sql);
}

function deleteKey($key, $conn){
    $sql = ("DELETE FROM links.links WHERE link_key= '" . $key . "'");
    $conn->query($sql);
}

function changeActivity($key, $conn){
    $currentActivity = mysqli_fetch_array($conn->query("SELECT active FROM links.links WHERE link_key='" . $key . "'"))['active'];
    $new = null;
    if ($currentActivity != 0)
        $new = 0;
    else
        $new = 1;

    $conn->query("UPDATE links.links SET active=$new  WHERE link_key='" . $key . "'");
}

if (isset($_POST)) {
    global $linkConn;
    if (isset($_POST['link']) && isset($_SESSION["uuid"])) {
        consoleLog("2");
        $link = $_POST['link'];
        $uuid = $_SESSION["uuid"];
        if (!isValidUrl($link)) {
            alert('Invalid Link. The following link is not valid/not the correct format: ' . $link);
        } else {
            saveLink($_POST['link'], $uuid, $linkConn);
        }
    } elseif (isset($_POST['delete'])) {
        $key = substr($_POST['linkUrl'], strrpos($_POST['linkUrl'], '/') + 1);
        deleteKey($key, $linkConn);

    }elseif (isset($_POST['activate'])) {
        $key = substr($_POST['linkUrl'], strrpos($_POST['linkUrl'], '/') + 1);
        changeActivity($key, $linkConn);

    }
}
?>

