<?php include('server.php') ?>

<!doctype html>
<html>
<head>
    <title>LUPKOIN | REGISTER</title>
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
<div class="w3-content" style="max-width:2000px;margin-top:64px">
    <div class="w3-row">
        <div class="w3-center">
<!--            <a href="index.php">-->
                <img class="w3-center" src="../static/cropped_logo.png" alt="lk_logo" height="100" width="100"/>
<!--            </a>-->
        </div>
        <h1 class="w3-wide w3-center">LUPKOIN</h1>
        <h4 class="w3-wide w3-opacity w3-center">A Safe & Secure P2P Coin</h4>
    </div>
    <hr>
    <div class="w3-row w3-center w3-block w3-padding-32">
        <button class="w3-button" style="background-color: #4184f4;
    color: #ffffff" onclick="document.getElementById('id02').style.display='block'">CREATE NEW WALLET
        </button>
    </div>
    <?php include('errors.php'); ?>
</div>

<!--login modal-->
<div class="w3-container">
    <div id="id02" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-light-grey w3-animate-zoom" style="max-width:400px">
            <div class="w3-center w3-hover-shadow"><br>
                <span onclick="document.getElementById('id02').style.display='none'"
                      class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                <div class="w3-container w3-padding-large w3-center">
                    <img class="w3-center" src="../static/cropped_logo.png" alt="lk_logo" height="60" width="60"/>

                    <form method="post" action="login.php">
                        <div class="input-group w3-section">
                            <label><b>Username</b></label>
                            <input class="w3-input w3-border w3-margin-bottom" type="text" name="username">
                        </div>
                        <div class="input-group w3-section">
                            <label><b>Email</b></label>
                            <input class="w3-input w3-border w3-margin-bottom" type="email" name="email">
                        </div>
                        <div class="input-group w3-section">
                            <label><b>Password</b></label>
                            <input class="w3-input w3-border w3-margin-bottom" type="password" name="password_1">
                        </div>
                        <div class="input-group">
                            <label><b>Confirm Password</b></label>
                            <input class="w3-input w3-border w3-margin-bottom" type="password" name="password_2">
                        </div>
                        <div class="input-group">
                            <button class="w3-button w3-block w3-section w3-padding" type="submit" class="btn"
                                    style="background-color: #4184f4;
    color: #ffffff" name="reg_user">Create Wallet
                            </button>
                        </div>
                        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                            <p class="w3-right" style="color: #4184f4; font-size:small;">Already have a wallet?<a href="login.php">
                                    Sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

