<?php

//Start session
session_start();
//Connect to th database
include('connection.php');
//Check user inputs
//   Define error messages
$missingEmail='<p><strong>Please enter a email!</strong></p>';
$invalidEmail='<p><strong>Please enter a valid email address!</strong></p>';

//    Get email
 if(empty($_POST["forgotemail"])){
        $errors .= $missingEmail;
    }else {
        $email = filter_var($_POST["forgotemail"],FILTER_SANITIZE_EMAIL);
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors .= $invalidEmail;
    }
 }
//    Store errors in errors variable
if($errors){
        $resultMessage = '<div class="alert alert-danger">'.$errors.'</div>';
        echo $resultMessage;
    }else{   //No error
    
        //Prepare variables for the queries
        $email = mysqli_real_escape_string($link,$email);
    
        //Run query to check if the email exists in the users table
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($link,$sql);
        if(!$result){
            echo '<div class="alert alert-danger">Error running the query!</div>';
            exit;
        }
        
        //If the email does not exist
        //print error message
        $count = mysqli_num_rows($result);
        if(!$count){
            echo '<div class="alert alert-danger">That email does not exist in our database!</div>';
            exit;
        }
        
        //else
        //get the user_id
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $user_id = $row['user_id'];
    
        //Create a unique activation code
        $Key = bin2hex(openssl_random_pseudo_bytes(16)); 
    
        //Insert user details and activation code in the forgotpassword table-->
        $time = time();
        $status = 'pending';
        $sql = "INSERT INTO forgotpassword (`user_id`,`keey`,`time`,`status`) VALUES ('$user_id','$Key','$time','$status')";
        $result = mysqli_query($link,$sql);
        if(!$result){
            echo '<div class="alert alert-danger">There was an error inserting user details in the database</div>';
            exit;
        }    
        
        //send email with link to resetpassword.php with user id and activation code
        $message = "Please click on this link to reset your password:\n\n";
        $message .= "http://junjiewe.thecompletewebhosting.com/DropSomethingDown/resetpassword.php?user_id=".urldecode($user_id)."&key=$Key";
        
        //if email sent successfully
        //print success message
        if(mail($email,'Rest your password', $message, 'From:'.'junjiewe@buffalo.edu')){
            echo "<div class='alert alert-success'>An email has been sent to $email. Please click on the link to reset your password.</div>";
        }

    }    
?>
