<?php
session_start();

// initializing variables
$wallet_address = "";
$username = "";
$email = "";
$errors = array();

//enter mysql connection here

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists! Please try again.");
        }

        if ($user['email'] === $email) {
            array_push($errors, "Email address already exists! Please try again.");
        }
    }
//    If no errors - send to verify table first
//    if (count($errors) == 0) {
////        $code = md5(mt_rand(), 0, 6);
//        $code = bin2hex(openssl_random_pseudo_bytes(3));
//        $hashed_code = md5($code);
//        $password = md5($password_1);//encrypt the password before saving in the database
////        $wallet_address = md5("LK-" . bin2hex(openssl_random_pseudo_bytes(8)));
//
//        $query = "INSERT INTO verify (username, email, password, code)
//  			  VALUES('$username', '$email', '$password', $hashed_code)";
//        mysqli_query($db, $query);
//
//        $message = "Your Activation Code is " . $code . "";
//        $to = $email;
//        $subject = "Verify your email address";
//        $from = 'jeffreylupker@gmail.com';
//        $body = "Your Activation Code is " . $code;
////        Please click the link: <a href="verification.php">verfication.php?id=' . $db . '&code=' . $code . '</a>to activate your account.
//        $headers = "From:" . $from;
//        mail($to, $subject,  $body, $headers);
//
////        $_SESSION['verify'] = "Please verify your account to continue.";
//        header('location: verification.php');
//
//        echo "An Activation Code has been sent to your email. Please follow the instructions to verify your account!";
//    }


// Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database
        $wallet_address = "LK-" . bin2hex(openssl_random_pseudo_bytes(8));

//        and user account to sql
        $query = "INSERT INTO users (wallet_address, username, email, password)
  			  VALUES('$wallet_address', '$username', '$email', '$password')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['wallet_address'] = $wallet_address;
        $_SESSION['success'] = "You are now logged in";

//        add wallet and balance to account
        $starting_balance = 1000.00;
        $query = "INSERT INTO total_balance (wallet_address, balance)
  			  VALUES('$wallet_address', '$starting_balance')";
        mysqli_query($db, $query);
        $_SESSION['total_balance'] = $starting_balance;

        header('location: ../index.php');
    }
}

//this grabs from the form 'login_user'
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

//    if successful now look at mysql table
    if (count($errors) == 0) {
        $password = md5($password);
//        query looks up row from mysql table using login form information matching
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;

//            Get wallet address from table
            $wallet_addr_q = mysqli_query($db, "SELECT wallet_address FROM users WHERE username='$username' AND password='$password'");
            $wallet_address = mysqli_fetch_row($wallet_addr_q);
            $_SESSION['wallet_address'] = $wallet_address[0];
            $_SESSION['success'] = "You are now logged in";

//            get balance from other sql
            $total_balance = mysqli_query($db, "SELECT balance FROM total_balance WHERE wallet_address='$wallet_address[0]'");
            $total_balance = mysqli_fetch_row($total_balance);
            $_SESSION['total_balance'] = $total_balance[0];

            header('location: ../index.php');
        } else {
            array_push($errors, "Wrong username/password combination!");
        }
    }
}

if (isset($_POST['form-transaction'])) {
    $send_address = mysqli_real_escape_string($db, $_POST['user-input']);
    $from_address = $_SESSION['wallet_address'];
    $send_amount = mysqli_real_escape_string($db, $_POST['send-amt']);

//    if successful now look at mysql table
    if (count($errors) == 0) {
        $total_balance = mysqli_query($db, "SELECT balance FROM total_balance WHERE wallet_address='$from_address'");
        $total_balance = mysqli_fetch_row($total_balance)[0];

//        verify not sending more than user has
        if ($total_balance >= $send_amount) {
//            figure out how to make transactions

        }
    }
}

?>

