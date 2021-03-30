<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<body>
<?php
require_once "shortner.php";




//echo $url;


if(isset($_GET["key"])) {
    global $linkConn;
    $key = $_GET["key"];
    $infos = getInfoFromKey($key, $linkConn);
    if ($infos != NULL && $infos["active"] != 0) {
        header("Location: " . $infos["link"]);
        $sql = ("UPDATE links.links SET uses=uses + 1 WHERE link_key='" . $key . "'");
        $linkConn->query($sql);
        return;
    }else{
        http_response_code(404);
        include "404.php";
        die();
    }
}else {
    $key = ltrim($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_URI'][0]);
    if (strtolower($key) == 'index.php' || strlen($key) == 0) {
        session_start();
        if (empty($_SESSION) || $_SESSION == NULL) {
            header("Location: /login_page.php");
        } else {
            header("Location: /links_page.php");
        }
        return;
    }
}

$key = ltrim($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_URI'][0]);
if (strlen($key) > 0) {
    $infos = getInfoFromKey($key, $linkConn);
    if ($infos != NULL && $infos["active"] != 0) {
        header("Location: " . $infos["link"]);
        $sql = ("UPDATE links.links SET uses=uses + 1 WHERE link_key='" . $key . "'");
        $linkConn->query($sql);
    } else {
        http_response_code(404);
        include "404.php";
        die();
    }
}

?>

</body>
</html>
