<?php
session_start();

// initializing variables
$wallet_address = "";
$username = "";
$email = "";
$errors = array();

//Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$db = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);


// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "Email address already exists");
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

        $query = "INSERT INTO users (wallet_address, username, email, password)
  			  VALUES('$wallet_address', '$username', '$email', '$password')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['wallet_address'] = $wallet_address;
        $_SESSION['success'] = "You are now logged in";
        header('location: ../index.php');
    }
}

//this grabs from the form 'login_user'
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }


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
            header('location: ../index.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
?>