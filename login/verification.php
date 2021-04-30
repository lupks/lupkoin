<?php include('server.php') ?>

<?php


//if (!isset($_SESSION['username'])) {
//    $_SESSION['msg'] = "You must log in first";
//    header('location: login.php');
//}
//if (isset($_GET['logout'])) {
//    session_destroy();
//    unset($_SESSION['username']);
//    header("location: login.php");
//}
?>

<!doctype html>
<html>
<head>
    <title>LUPKOIN | Verify</title>
    <link rel="shortcut icon" type="image/jpg" href="../static/cropped_logo.png"/>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    body {
        font-family: "Lato", sans-serif
    }
</style>

<body>


<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">
    <br>
    <div class="w3-center">
        <a href="index.php">
            <img class="w3-center" src="../static/cropped_logo.png" alt="lk_logo" height="100" width="100"/>
        </a></div>
    <h1 class="w3-wide w3-center">VERIFY</h1>
    <hr>

    <div class="w3-center w3-row">
        Please verify your account to continue.
    </div>
    <br>
    <div class="w3-center w3-row w3-opacity"><i><a href="">Resend verification</a></i>
    </div>
</div>


</body>
</html>





