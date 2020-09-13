<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    include '_dbconnect.php';
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];
    $sql = "select * from `users` where user_email = '$email'";
   
    $result = mysqli_query($conn,$sql);
    $numRows = mysqli_num_rows($result);
    $showError = "false";
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass,$row['user_pass'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['useremail'] = $email;
            header("Location: /stuck%20overflow/index.php?loginsuccess=true");
            exit();
        }
        else{
            // Change this echo into Warning of Bootstrap displaying the error message
            $showError =  "Password does not match. Try Again!";
            header("Location: /stuck%20overflow/index.php?loginsuccess=false&error=$showError");
        }
    }
    else{
        $showError = "Username is invalid. Try to signup first!";
        header("Location: /stuck%20overflow/index.php?loginsuccess=false&error=$showError");
    }

}


?>