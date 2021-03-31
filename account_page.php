<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles/fonts.css">
    <link rel="stylesheet" href="styles/accounts.css">
</head>
<body>
<div class="container">
    <h1>Account</h1>

<?php
require_once "connection.php";
require_once "loginUtils.php";
echo "<form method='post' class='accountForm' action='account_page.php'>
            <input type='text' size='30' value='" . $_SESSION['username'] . "' name='account' class='accountName'>
            <input type='submit' class='accountSubmit' name='accountNameUpdate' value='Update Username' />
      </form>
      <form method='post' class='accountForm' action='account_page.php'>
            <input size='30' type='password' name='password' class='inputForm' placeholder='Enter New Password'
                       pattern='^[A-Za-z0-9_!@#$%*]{6,50}$' required>
            <input type='submit' class='passwordSubmit' name='accountPasswordUpdate' value='Update Password' />
      </form>
      <input type='text' size='30' value='" . $_SESSION['reg_date'] . "' name='reg_date' class='registerInput' readonly>
            ";

if (isset($_POST)) {
    global $linkConn;
    if (isset($_POST['accountNameUpdate'])) {
        updateUsername($_SESSION['uuid'], $linkConn, $_POST['account']);
        //Used to refresh Session variable.
        header('Location: /account_page.php');
    }elseif (isset($_POST['accountPasswordUpdate'])) {
        updatePassword($_SESSION['uuid'], $_POST['password'], $linkConn);
    }

}

?>
    <a href="/index.php" data-aos="flip-left">
        <div>Return to Home</div>
    </a>
</div>
<script>
    AOS.init({
        once: true,
        duration: 1000,
    });
</script>
</body>
</html>
