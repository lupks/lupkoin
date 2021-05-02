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
        <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-left"
           href="javascript:void(0)" onclick="dropdownClick()" title="Toggle Navigation Menu"><i
                    class="fa fa-bars"></i></a>
        <a class="w3-bar-item w3-button w3-opacity w3-padding-large w3-hide-small">HOME</a>
        <a href="pages/send.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">SEND</a>
        <a href="pages/receive.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">RECEIVE</a>

        <!-- logged in user information -->
        <a class="w3-bar-item w3-button w3-padding-large w3-right"
           onclick="document.getElementById('id01').style.display = 'block'"><b><?php echo $_SESSION['wallet_address'] ?></b></a>
    </div>
</div>

<!-- Navbar on small screens (remove the onclick attribute if you want the navbar to always show on top of the content when clicking on the links) -->
<div id="navDemo" class="w3-bar-block w3-light-grey w3-hide w3-hide-large w3-hide-medium w3-top"
     style="margin-top:46px">
    <a class="w3-bar-item w3-button w3-opacity w3-padding-large ">HOME</a>
    <a href="pages/send.php" class="w3-bar-item w3-button w3-padding-large" onclick="dropdownClick()">SEND</a>
    <a href="pages/receive.php" class="w3-bar-item w3-button w3-padding-large" onclick="dropdownClick()">RECEIVE</a>

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

<!-- The Contact Section -->
<div class="w3-container w3-content w3-padding-32" style="max-width:300px" id="send_coin">
    <div class="w3-card-4 w3-round-xlarge">
        <div class="w3-container w3-center w3-hover-shadow">
            <div class="w3-row w3-padding">
                <h5 class="w3-center">Total Balance</h5>
                <h5 class="w3-center w3-text-grey"
                   id="wallet-address"><?php echo $_SESSION['total_balance']; ?>ĸ</h5>
            </div>
        </div>
    </div>
</div>

<!--logout modal-->
<div class="w3-container w3-round-xlarge">
    <div id="id01" class="w3-modal w3-hover-shadow">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-round-xlarge" style="max-width:400px">
            <div class="w3-center"><br>
                <span onclick="document.getElementById('id01').style.display='none'"
                      class="w3-button w3-round-xlarge  w3-xlarge w3-display-topright"
                      title="Close Modal">&times;</span>
            </div>
            <div class="w3-section w3-padding w3-center w3-opacity">
                <label><b>Total Balance</b></label>
            </div>
            <div class="w3-row w3-center" style="color: #4184f4">
                <?php echo $_SESSION['total_balance']; ?>ĸ
            </div>
            <div class="w3-center w3-padding-large">
                <a class="w3-button w3-section w3-padding w3-round-xlarge" style="background-color: #4184f4;
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

    var modal_logout = document.getElementById('id01');
    window.onclick = function (event) {
        if (event.target == modal_logout) {
            modal_logout.style.display = "none";
        }
    }


</script>

</body>
</html>

