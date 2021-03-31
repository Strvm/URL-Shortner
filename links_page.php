<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>URL Shortner</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/fonts.css">
    <link rel="stylesheet" href="styles/shortner.css">
</head>
<body>


<header>
    <div class="menu">
<!--        --><?php
//            session_start();
//            //If user isn't logged in, redirect them to login page.
//            if($_SESSION['username']==NULL){
//                header("Location: /index.php");
//            }
//            $username = $_SESSION['username'];
//            echo "<h5 class='username'>".$username."</h5>";
//        ?>
        <a href="/account_page.php">
            <i class="fa fa-user-circle-o" style="font-size:24px"></i>
        </a>
        <form action="loginUtils.php" method="post">
            <input type="submit" class="linkSubmit" name="disconnect" value="Disconnect" />
        </form>
    </div>
</header>
<div class="createContainer">
    <h1 data-aos="fade-down">Shorten your URLs !</h1>
    <form action="" method="post" class="linkForm" action="shortner.php" data-aos="fade-right">
        <label class="invalidUrl" for="link">Invalid URL</label>
            <input type="text" size='96' name="link" id="link" class="linkInput" placeholder="Enter your URL" data-aos="zoom-in" required>
        <input type="submit" class="urlSubmit" value="Submit Link" name="submit" data-aos="fade-left">
    </form>
    <div class="infoText" data-aos="fade-right">
        <p >Hello! Here you will be able to give us a URL and we will take care to make it smaller!
        Upon submitting a URL we will return you a URL that will redirect you to the source upon pointing to it.</p>
        <p>Below is the history of all your links, <strong>you can click the custom URL</strong> to copy it into your clipboard.
        You can also set to Activate/De-activate your links or delete them.</p>
    </div>
</div>
<table class="linksContainer">
    <thead>
        <tr>
            <th></th>
            <th>Shortned URL</th>
            <th>Source</th>
            <th>Uses</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            require_once "shortner.php";
            require_once "connection.php";
            if(!isset($_SESSION))
            {
                session_start();
            }
            global $linkConn;
            $result = getAllUserLinks($_SESSION["uuid"], $linkConn);
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = $protocol .$_SERVER['HTTP_HOST'] ."/";
            while ($row = mysqli_fetch_array($result)) { // <-- overwritten here with item 2
                $active = 'Inactive';
                $class = '';
                if ($row['active']){
                    $active = 'Active';
                }else{
                    $class = 'inactiveLink';
                }
                echo "<tr class='linkContainer'>
                        <td>
                            <i class='fa fa-info-circle info-box' style='font-size:20px;'>
                              <span class='info-box-text'>Link created: " . $row['reg_date'] . " </span>
                            </i>
                        </td>
                        <td>
                            <form action='' method='post' method='post' action='shortner.php'>
                                <input type='text' class='linkUrl $class' name='linkUrl' id='linkUrl' size='25' value=" . $url . $row['link_key'] . " readonly>
                        </td>
                        <td>
                            <input type='text' class='$class' size='60' name='uses' value=" . $row['link'] . " readonly>
                        </td>
                        <td>
                            <input type='text' class='uses $class' size='3' name='uses' value=" . $row['uses'] . " readonly required>
                        </td>
                        <td>
                            <input type='submit' class='activeButton $class' value='$active' name='activate'>
                            <input type='submit' class='deleteButton' value='Delete' name='delete'>
                        </td>
                            </form>

                      </tr>";
        //        foreach ($row as $r){
        //            echo $r;
        //            echo "</br> ";
        //        }
            }
        //    foreach (getAllUserLinks($_SESSION["uuid"], $linkConn) as $link){
        //        echo $link;
        //        echo "</br> ";
        //    }

        ?>
    </tbody>
</table>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    AOS.init({
        once: true,
        duration: 1000,
    });
</script>
<script type="text/javascript" src= "scripts/links.js"></script>

</body>
</html>





<?php

?>
