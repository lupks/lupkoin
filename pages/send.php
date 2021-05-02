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

    input:hover {
        background-color: rgb(65, 132, 244, 0.2);
    }

    input:focus::placeholder {
        color: black;
    }

</style>

<body>
<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-light-grey w3-card">
        <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-left"
           href="javascript:void(0)" onclick="dropdownClick()" title="Toggle Navigation Menu"><i
                    class="fa fa-bars"></i></a>
        <a href="../index.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">HOME</a>
        <a class="w3-bar-item w3-button w3-padding-large w3-hide-small w3-opacity">SEND</a>
        <a href="receive.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">RECEIVE</a>
        <a class="w3-bar-item w3-button w3-padding-large w3-right"
           onclick="document.getElementById('id02').style.display = 'block'"><b><?php echo $_SESSION['wallet_address']; ?></b></a>
    </div>
</div>

<!-- Navbar on small screens (remove the onclick attribute if you want the navbar to always show on top of the content when clicking on the links) -->
<div id="navDemo" class="w3-bar-block w3-light-grey w3-hide w3-hide-large w3-hide-medium w3-top"
     style="margin-top:46px">
    <a href="../index.php" class="w3-bar-item w3-button w3-padding-large ">HOME</a>
    <a class="w3-bar-item w3-button w3-padding-large w3-opacity " onclick="dropdownClick()">SEND</a>
    <a href="receive.php" class="w3-bar-item w3-button w3-padding-large" onclick="dropdownClick()">RECEIVE</a>

</div>

<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:64px">
    <div class="w3-row">
        <div class="w3-center">
            <a href="../index.php">
                <img class="w3-center" src="../static/cropped_logo.png" alt="lk_logo" height="100" width="100"/>
            </a></div>
        <h4 class="w3-wide w3-center">SEND</h4>
    </div>
    <hr>
    <!-- The Contact Section -->
    <div class="w3-container w3-content w3-padding-16" style="max-width:400px" id="send_coin">
        <div class="w3-card-4 w3-round-xlarge">
            <div class="w3-container w3-center w3-round-xlarge w3-hover-shadow">
                <form id="form-transaction" method="post">
                    <div class="w3-row w3-padding">
                        <label class="w3-left w3-padding">Address</label>
                        <input class="w3-input w3-middle w3-round-xlarge w3-border w3-text-black"
                               id="user-input" type="text" placeholder="Tap to paste"
                               required name="Message">
                    </div>
                    <div class="w3-row w3-padding">
                        <label class="w3-left w3-padding">Network</label>
                        <input class="w3-input w3-middle w3-round-xlarge w3-border w3-text-black"
                               type="text" placeholder="LK Network"
                               required name="Message">
                    </div>
                    <div class="w3-row w3-padding">
                        <label class="w3-left w3-padding">Amount</label>
                        <input id=send-amt class="w3-input w3-middle w3-round-xlarge w3-border w3-text-black"
                               type="number" placeholder="0"
                               required
                               name="amount">
                    </div>
                </form>

                <div id="card-bottom" class="w3-center w3-panel w3-round-xlarge">
                    <p class="w3-left"></p>
                    <div class="w3-col s6">
                        <p class="w3-left w3-small w3-text-grey">Sending to: <div id="send-to"></div></p>
                        <div class="w3-row">
                            <div class="w3-left" id="displayText">0ĸ</div>
                        </div>
                        <div class="w3-row">
                            <p class="w3-left w3-tiny w3-text-grey">Your
                                balance: <?php echo $_SESSION['total_balance']; ?>ĸ</p>
                        </div>
                    </div>
                    <div class="w3-col s6">
                        <br>
                        <button class="w3-button w3-section w3-right w3-round-xlarge" style="background-color: #4184f4;
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
    <div id="id01" class="w3-modal w3-animate-opacity " style="background-color: rgba(0, 0, 0, 0.4)">
        <div class="w3-modal-content w3-round-xlarge" style="max-width:500px">
            <div class="w3-container ">
                <h3 class="w3-center w3-panel w3-card-4 w3-round-xlarge w3-text-white w3-padding-16"
                    style="background-color: #4184f4;">Verify Transaction</h3>
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

    <!--logout modal-->
    <div class="w3-container w3-round-xlarge">
        <div id="id02" class="w3-modal w3-hover-shadow">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom w3-round-xlarge" style="max-width:400px">
                <div class="w3-center"><br>
                    <span onclick="document.getElementById('id02').style.display='none'"
                          class="w3-button w3-xlarge w3-round-xlarge w3-display-topright"
                          title="Close Modal">&times;</span>
                </div>
                <h5 class="w3-section w3-padding w3-center w3-opacity">
                    Total Balance
                </h5>
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
        // dropdown menu
        function dropdownClick() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }

        // Update amount
        const input = document.getElementById('send-amt');
        const textElement = document.getElementById('displayText');

        const send = document.getElementById('user-input');
        const sendElement = document.getElementById('send-to');

        function updateValue(e) {
            textElement.textContent = e.target.value + "ĸ";
        }
        function updateUser(e) {
            sendElement.textContent = e.target.value;
        }

        input.addEventListener('input', updateValue);
        input.addEventListener('send', updateUser);


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
        var modal_transaction = document.getElementById('id01');
        var modal_logout = document.getElementById('id02');
        window.onclick = function (event) {
            if (event.target == modal_transaction) {
                modal_transaction.style.display = "none";
            }
            if (event.target == modal_logout) {
                modal_logout.style.display = "none";
            }
        }

    </script>

</body>
</html>

