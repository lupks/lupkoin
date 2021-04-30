<?php include('server.php') ?>

<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login/login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login/login.php");
}
?>

<!doctype html>
<html>
<head>
    <title>LUPKOIN</title>
    <link rel="shortcut icon" type="image/jpg" href="static/cropped_logo.png"/>
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
<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-light-grey w3-card">
        <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right"
           href="javascript:void(0)" onclick="dropdownClick()" title="Toggle Navigation Menu"><i
                    class="fa fa-bars"></i></a>
        <a class="w3-bar-item w3-button w3-opacity w3-padding-large w3-hide-small">HOME</a>
        <a href="pages/send.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">SEND</a>
        <a href="pages/receive.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">RECEIVE</a>

        <!-- logged in user information -->
        <a class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-right"
           onclick="document.getElementById('id01').style.display = 'block'"><b><?php echo $_SESSION['wallet_address'] ?></b></a>
    </div>
</div>

<!-- Navbar on small screens (remove the onclick attribute if you want the navbar to always show on top of the content when clicking on the links) -->
<div id="navDemo" class="w3-bar-block w3-light-grey w3-hide w3-hide-large w3-hide-medium w3-top"
     style="margin-top:46px">
    <a class="w3-bar-item w3-button w3-opacity w3-padding-large ">HOME</a>
    <a href="pages/send.php" class="w3-bar-item w3-button w3-padding-large" onclick="dropdownClick()">SEND</a>
    <a href="pages/receive.php" class="w3-bar-item w3-button w3-padding-large" onclick="dropdownClick()">RECEIVE</a>
    <a class="w3-bar-item w3-button w3-padding-large w3-center"
       onclick="document.getElementById('id01').style.display = 'block'"><b><?php echo $_SESSION['wallet_address'] ?></b></a>
</div>

<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px">
    <br>
    <div class="w3-center">
        <a href="index.php">
            <img class="w3-center" src="static/cropped_logo.png" alt="lk_logo" height="100" width="100"/>
        </a></div>
    <h1 class="w3-wide w3-center">LUPKOIN</h1>
    <h4 class="w3-wide w3-opacity w3-center">A Safe & Secure P2P Coin</h4>
    <hr>
</div>

<!--logout modal-->
<div class="w3-container">
    <div id="id01" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
            <div class="w3-center"><br>
                <span onclick="document.getElementById('id01').style.display='none'"
                      class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                <label><b>Logout</b></label>
            </div>
            <div class="w3-section">
                <label><b>Total Amount:</b></label>
            </div>
            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                <a class="w3-button w3-block w3-section w3-padding" style="background-color: #4184f4;
    color: #ffffff" href="index.php?logout='1'">Logout</a>
            </div>
        </div>
    </div>
</div>

<script>
    function dropdownClick() {
        var x = document.getElementById("navDemo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }


</script>

</body>
</html>

