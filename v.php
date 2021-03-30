<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<body>
<?php
require_once "shortner.php";
require_once "connection.php";

if(isset($_GET["key"])) {
    global $linkConn;
    $key = $_GET["key"];
    $infos = getInfoFromKey($key, $linkConn);
    if ($infos != NULL && $infos["active"] != 0) {
        header("Location: " . $infos["link"]);
        $sql = ("UPDATE links.links SET uses=uses + 1 WHERE link_key='" . $key . "'");
        $linkConn->query($sql);
    }else{
        http_response_code(404);
        include "404.php";
        header('Location: /404.php');
        die();
    }
}
?>
</body>
</html>
