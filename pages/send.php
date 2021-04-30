<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>

<!doctype html>
<html>
<head>
    <title>LUPKOIN | Send</title>
    <link rel="shortcut icon" type="image/jpg" href="../static/cropped_logo.png"/>

</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="index.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
    body {
        font-family: "Lato", sans-serif
    }
</style>

<body>
<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-light-grey w3-card">
        <a href="../index.php" class="w3-bar-item w3-button w3-padding-large">HOME</a>
        <a class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-opacity">SEND</a>
        <a href="receive.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">RECEIVE</a>
        <a class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-right"
           onclick="document.getElementById('id02').style.display = 'block'"><b><?php echo $_SESSION['wallet_address']; ?></b></a>
    </div>
</div>

<!-- Navbar on small screens (remove the onclick attribute if you want the navbar to always show on top of the content when clicking on the links) -->
<div id="navDemo" class="w3-bar-block w3-light-grey w3-hide w3-hide-large w3-hide-medium w3-top"
     style="margin-top:46px">
    <a href="../index.php" class="w3-bar-item w3-button w3-padding-large" onclick="dropdownClick()">SEND</a>
    <a href="receive.php" class="w3-bar-item w3-button w3-padding-large" onclick="dropdownClick()">RECEIVE</a>
</div>

<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:64px">
    <div class="w3-row">
        <div class="w3-center">
            <a href="/">
                <img class="w3-center" src="../static/cropped_logo.png" alt="lk_logo" height="100" width="100"/>
            </a></div>
        <h4 class="w3-wide w3-center">SEND</h4>
    </div>
    <hr>

    <!-- The Contact Section -->
    <div class="w3-container w3-content w3-padding-32" style="max-width:400px" id="send_coin">
        <div class="w3-card-4 w3-light-grey">
            <div class="w3-container w3-center w3-hover-shadow">
                <form id="form-transaction" method="post">
                    <div class="w3-row">
                        <p class="w3-left">Address</p>
                        <input class="w3-input w3-middle" id="user-input" type="text" placeholder="Tap to paste"
                               required name="Message">
                    </div>
                    <div class="w3-row">
                        <p class="w3-left">Network</p>
                        <div class="w3-row">
                            <select style="padding: 8px 4px" class="w3-white w3-block w3-left-align w3-text-grey" id="network" name="network">
                                <option value="LK Network">LK Network</option>
                                <option value="ERC20">ERC20</option>
                                <option value="BEP20">BEP20 (BSC)</option>
                            </select>
                        </div>
                    </div>
                    <div class="w3-row">
                        <p class="w3-left">Amount</p>
                        <input id=send-amt class="w3-input w3-middle" type="text" placeholder="0" required
                               name="amount">
                    </div>
                </form>

                <div class="w3-row">
                    <p class="w3-left"></p>
                    <div class="w3-col s6">
                        <p class="w3-left w3-small w3-text-grey">You are sending: </p>
                        <div class="w3-row">
                            <div class="w3-left" id="displayText">0ĸ</div>
                        </div>
                        <div class="w3-row">
                            <p class="w3-left w3-tiny w3-text-grey">Transaction fee: 0.01ĸ</p>
                        </div>
                    </div>
                    <div class="w3-col s6">
                        <br>
                        <button class="w3-button w3-section w3-right w3-round" style="background-color: #4184f4;
    color: #ffffff" id="send-form" type="submit"
                                onclick="send_amt()">
                            SEND
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="id01" class="w3-modal w3-animate-opacity" style="background-color: rgba(0, 0, 0, 0.4)">
        <div class="w3-modal-content" style="max-width:500px">
            <div class="w3-container">
                <h3 class="w3-center w3-block w3-padding-16 w3-text-white" style="background-color: #4184f4;
    color: #ffffff">Verify Transaction</h3>
                <hr>
                <br>
                <p class="w3-center w3-text-black" id="user-send">Send the following amount to: </p>
                <div class="w3 row">
                    <div class="w3-center w3-padding-16" id="verification_amt">0ĸ</div>
                </div>
                <div class="w3-row">
                    <p class="w3-center w3-tiny w3-text-grey" id="tfee">Transaction fee: 0.01ĸ</p>
                </div>
                <div class="w3-row w3-padding-64">
                    <div class="w3-center" id="submit-button">
                        <button class="w3-button w3-light-grey w3-center w3-round" type="submit" id="final-submit"
                                onclick="sendTransaction()">
                            SEND
                        </button>
                    </div>

                    <div class="w3-center" id="close-button">
                        <button class="w3-button w3-light-grey w3-center w3-round" type="submit"
                                onclick="closeModal()">
                            CLOSE
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        // dropdown menu
        function dropdownClick() {
            var x = document.getElementById("dropdown");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }

        // Update amount
        const input = document.getElementById('send-amt');
        const textElement = document.getElementById('displayText');

        function updateValue(e) {
            textElement.textContent = e.target.value + "ĸ";
        }

        input.addEventListener('input', updateValue);

        //Update verification amount
        function send_amt() {
            document.getElementById('id01').style.display = 'block'
            document.getElementById('user-send').innerHTML = "Send the following amount to: " + document.getElementById('user-input').value;
            document.getElementById('verification_amt').innerHTML = document.getElementById('displayText').innerHTML;
            document.getElementById('close-button').style.display = 'none';
            document.getElementById('submit-button').style.display = 'block';
            document.getElementById('tfee').innerHTML = "Transaction fee: 0.01ĸ";

        }

        function sendTransaction() {
            // send flask app transaction info
            let sender = "0x465mng4495nn"
            let recipient = document.getElementById('user-input').value;
            let amt = document.getElementById('verification_amt').innerHTML;

            $.ajax({
                type: 'post',
                url: 'transaction',
                data: {sender, recipient, amt},
                // contentType: "application/json; charset=utf-8",
                success: function (data) {
                    console.log(data);
                }
            });

            document.getElementById('verification_amt').innerHTML = "Transaction Complete!";
            document.getElementById('user-send').innerHTML = "";
            document.getElementById('tfee').innerHTML = "";
            document.getElementById('submit-button').style.display = 'none';
            document.getElementById('close-button').style.display = 'block';

        }

        function closeModal() {
            document.getElementById('id01').style.display = 'none';
        }

        // {#click outside of modal to close#}
        var modal = document.getElementById('id01');
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

    </script>

</body>
</html>

