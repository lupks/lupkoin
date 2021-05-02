<?php include('../server.php') ?>

<!doctype html>
<html>
<head>
    <title>LUPKOIN | LOGIN</title>
    <link rel="shortcut icon" type="image/jpg" href="../static/cropped_logo.png"/>

</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    body {
        font-family: "Lato", sans-serif
    }

    input:hover {
        background-color: rgb(65, 132, 244, 0.2);
    }

    input:focus::placeholder {
        color: black;
    }
</style>

<body>
<div class="w3-content" style="max-width:2000px;margin-top:64px">
    <div class="w3-row">
        <div class="w3-center">
            <img class="w3-center" src="../static/cropped_logo.png" alt="lk_logo" height="100" width="100"/>
        </div>
        <h1 class="w3-wide w3-center">LUPKOIN</h1>
        <h4 class="w3-wide w3-opacity w3-center">A Safe & Secure P2P Coin</h4>
    </div>
    <hr>
    <div class="w3-row w3-center w3-block w3-padding-32">
        <button class="w3-button w3-round-xlarge" style="background-color: #4184f4;
    color: #ffffff" onclick="modal_open()">LOGIN
        </button>
    </div>
    <div class="w3-center"><?php include('errors.php'); ?>
    </div>
</div>

<div class="w3-container w3-round-xlarge">
    <!--login modal-->
    <div id="id01" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-round-xlarge w3-animate-zoom" style="max-width:400px">
            <div id="login-page" class="w3-center w3-round-xlarge w3-hover-shadow"><br>
                <span onclick="document.getElementById('id01').style.display='none'"
                      class="w3-button w3-xlarge w3-round-xlarge w3-display-topright" title="Close Modal">&times;</span>
                <div class="w3-container w3-padding-large w3-center">
                    <img class="w3-center" src="../static/cropped_logo.png" alt="lk_logo" height="60" width="60"/>
                    <h6 class="w3-bar-item w3-center">LOGIN</h6>
                    <form method="post" action="login.php">
                        <div class="input-group w3-section">
                            <label class="w3-left w3-padding"><b>Username</b></label>
                            <input class="w3-input w3-middle w3-round-xlarge w3-border w3-text-black" type="text"
                                   name="username" placeholder="Enter username" required>
                        </div>
                        <div class="input-group w3-section">
                            <label class="w3-left w3-padding"><b>Password</b></label>
                            <input class="w3-input w3-middle w3-round-xlarge w3-border w3-text-black" type="password"
                                   name="password" placeholder="Enter password" required>
                        </div>

                        <div class="w3-row" style="color: #4184f4; font-size:small;">
                            <button class="w3-col s6 w3-button w3-section w3-center w3-round-xlarge" type="submit"
                                    class="btn"
                                    style="background-color: #4184f4;
    color: #ffffff" name="login_user">Login
                            </button>
                            <span class="w3-col s6 w3-button w3-section w3-center w3-round-xlarge"
                                  onclick="to_register()">Create
                                new wallet
                            </span>
                        </div>
                    </form>
                </div>
            </div>

            <div id="register-page" class="w3-center w3-hover-shadow"><br>
                <span onclick="document.getElementById('id02').style.display='none'"
                      class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                <div class="w3-container w3-padding-large w3-center">
                    <img class="w3-center" src="../static/cropped_logo.png" alt="lk_logo" height="60" width="60"/>

                    <form method="post" action="login.php">
                        <div class="input-group w3-section">
                            <label class="w3-left w3-padding"><b>Username</b></label>
                            <input class="w3-input w3-middle w3-round-xlarge w3-border w3-text-black" type="text"
                                   placeholder="Enter username" name="username" required>
                        </div>
                        <div class="input-group w3-section">
                            <label class="w3-left w3-padding"><b>Email</b></label>
                            <input class="w3-input w3-middle w3-round-xlarge w3-border w3-text-black" type="email"
                                   placeholder="Enter email" name="email" required>
                        </div>
                        <div class="input-group w3-section">
                            <label class="w3-left w3-padding"><b>Password</b></label>
                            <input class="w3-input w3-middle w3-round-xlarge w3-border w3-text-black" type="password"
                                   pattern="^\S{6,}$"
                                   onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.password_2.pattern = this.value;"
                                   placeholder="Enter password" name="password_1" required>
                        </div>
                        <div class="input-group">
                            <label class="w3-left w3-padding"><b>Confirm Password</b></label>
                            <input class="w3-input w3-middle w3-round-xlarge w3-border w3-text-black" type="password"
                                   pattern="^\S{6,}$"
                                   onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');"
                                   placeholder="Verify password" name="password_2" required>
                        </div>

                        <div class="w3-row w3-padding">
                            <button class="w3-col s6 w3-button w3-section w3-center w3-round-xlarge" type="submit"
                                    class="btn"
                                    style="background-color: #4184f4;
    color: #ffffff" name="reg_user">Create Wallet
                            </button>
                            <span class="w3-col s6 w3-button w3-section w3-center w3-round-xlarge" onclick="to_login()"
                                  style="color: #4184f4; font-size:small;">
                                    Sign in</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // dropdown menu
    function myFunction() {
        var x = document.getElementById("Demo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }

    function modal_open() {
        document.getElementById('id01').style.display = 'block';
        document.getElementById('register-page').style.display = 'none';
    };

    function to_register() {
        document.getElementById('register-page').style.display = 'block';
        document.getElementById('login-page').style.display = 'none';
    };

    function to_login() {
        document.getElementById('register-page').style.display = 'none';
        document.getElementById('login-page').style.display = 'block';
    };

</script>
</body>
</html>

