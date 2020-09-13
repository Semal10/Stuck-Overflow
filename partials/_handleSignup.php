<?php

if($_SERVER['REQUEST_METHOD']=="POST"){
    include '_dbconnect.php';
    $user_email = $_POST['signupEmail'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];


    // Check whether this email exists or not
    $existSql = "select * from `users` where user_eamil = '$user_email' ";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    $showError = "false";
    if($numRows>0){
        $showError = "Email already in use ";
    }
    else{
        if($pass == $cpass){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn,$sql);
            if($result){
                $showAlert = true;
                header("Location: /stuck%20overflow/index.php?signupsuccess=true");
                exit();
            }

        }
        else{
            $showError = "Passwords do not match";
            //header("Location: /stuck%20overflow/index.php?signupsuccess=false&error=$showError");
        }
    }
    header("Location: /stuck%20overflow/index.php?signupsuccess=false&error=$showError");



}

?>