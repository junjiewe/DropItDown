<?php
//<!--Start session-->
session_start();
//<!--Connect to the database-->
include("connection.php");
//<!--check user inputs-->
//    <!--Define error message-->

$missingEmail = '<p><strong>Please enter your email address</strong></p>';
$missingPassword = '<p><strong>Please enter your password</strong></p>';
//    <!--Get email and password-->
//get email
    if(empty($_POST["loginemail"])){
        $errors .= $missingEmail;
    }else {
        $email = filter_var($_POST["loginemail"],FILTER_SANITIZE_EMAIL);
    }

//get password
//    <!--Store errors in errors variable-->
 if(empty($_POST["loginpassword"])){
        $errors .= $missingPassword;
    }else{
        $password = filter_var($_POST["loginpassword"],FILTER_SANITIZE_STRING);
    }

//    <!--If there are any errors variable-->
if($errors){
     $resultMessage = '<div class="alert alert-danger">'.$errors.'</div>';
     echo $resultMessage;
}else{
    $email = mysqli_real_escape_string($link,$email);
    $password = mysqli_real_escape_string($link,$password);
//hashing function
//$password = md5($password); //128bits long -> 32 characters
    $password = hash('sha256',$password); //64 characters

//        <!--Prepare variables for the query-->
//        <!--Run query: check combination of email & password exists-->
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password' AND activation='activated'";
$result = mysqli_query($link,$sql);
if(!$result){
    echo '<div class="alert alert-danger">Error running the query!</div>';
    exit;
}
//        <!--If email & password don't match print error-->
$count = mysqli_num_rows($result);
if($count !== 1){
    echo '<div class="alert alert-danger">Wrong user name or password</div>';
}else{
    //log user in: set session variables
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $_SESSION['user_id']=$row['user_id'];
    $_SESSION['username']=$row['username'];
    $_SESSION['email']=$row['email'];
    
    if(empty($_POST['rememberme'])){
        //if remember me box is not checked
        echo "success";
    }else{
        //else if is check
        //            <!--Create two variables $authentificator1 and $authenficator2-->
        $authentificator1 = bin2hex(openssl_random_pseudo_bytes(10));
        $authentificator2 = openssl_random_pseudo_bytes(20);
        //            <!--Store them in a cooki-->
        
        function f1($a, $b){
            $c = $a . "," . bin2hex($b);
            return $c;
        }
        $cookieValue = f1($authentificator1,$authentificator2);
        setcookie(
            "rememberme",
            $cookieValue,
            time() + 2592054      //30days expiration
        );
//            <!--Run query to store them in remember table-->
        function f2($a){
            $b = hash('sha256', $a);
            return $b;
        }
        $f2authentificator2 = f2($authentificator2);
        $user_id = $_SESSION['user_id'];
        $expiration = date('Y-m-d H:i:s', time() + 2592054);
        $sql = "INSERT INTO rememberme
        (`authentificator1`, `f2authentificator2`, `user_id`, `expires`)
        VALUES
        ('$authentificator1', '$f2authentificator2', '$user_id', '$expiration')";
        $result = mysqli_query($link, $sql);
        if(!$result){
            echo '<div class="alert alert-danger">There was an error storing data to remember you next time!</div>';
            exit;    
        }else{
            echo "success";
        }
    }
  }
}

?>
