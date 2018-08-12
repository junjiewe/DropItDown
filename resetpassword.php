<?php
//<!--The user is redirected to this file after clicking the activation link-->
//<!--Signup link contains two GET parameters: email and activation key-->
session_start(); //resume the previos session
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Password Reset</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
        <style>
            h1{
                color:purple;   
            }
            .contactForm{
                border:1px solid #7c73f6;
                margin-top: 50px;
                border-radius: 15px;
            }   
            a {
                padding-bottom: 10px;
            }
        </style> 

    </head>
        <body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-offset-1 col-sm-10 contactForm">
            <h1>Reset Password</h1>
            <div id="resultmessage"></div>
<?php
//<!--If user_id or key is missing show an error-->
if(!isset($_GET['user_id']) || !isset($_GET['key'])){
    echo '<div class="alert alert-danger">There was an error. Please click on the link you received by email.</div>';
    exit;
}
//<!--else-->
//    <!--store them in two variables-->
$user_id = $_GET['user_id'];
$key = $_GET['key'];
$time = time() - 86400;            
//    <!--prepare variables for the query-->
$user_id = mysqli_real_escape_string($link,$user_id);
$key = mysqli_real_escape_string($link, $key);
//    <!--Run query: check the combination of user_id & key exists and less than 24hrs 
$sql = "SELECT user_id FROM forgotpassword WHERE keey='$key' AND user_id='$user_id' AND time > '$time' AND status='pending'";
$result = mysqli_query($link,$sql); //run the query
if(!$result){
            echo '<div class="alert alert-danger">Error running the query!</div>';
            exit;
        }
            
//if the combination does not exits show error msg
$count = mysqli_num_rows($result);
    if($count !== 1){
        echo '<div class="alert alert-danger">Please try again</div>';
        exit;
    }   
        
//print reset password form with hidden user_id and key fields
echo "
    <form method=post id='passwordreset'>
    <input type=hidden name=key value=$key>
    <input type=hidden name=user_id value=$user_id>
        <div class='form-group'>
            <label for='password'>Enter your new password</label>
            <input type='password' name='password' id='password' placeholder='Enter password' class='form-control'>
        </div>
        <div class='form-group'>
            <label for='password2'>Re-enter your password</label>
            <input type='password' name='password2' id='password2' placeholder='Re-enter password' class='form-control'>
        </div>
        <input type='submit' name='resetpassword' class='btn btn-success btn-lg' value='Reset Password'>
    </form>
";            
            
?>
            
        </div>
    </div>
</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
<!--Script for ajax call to storeresetpassword.php which processes form data-->
        <script>
            $("#passwordreset").submit(function(event){
                //prevent default php processing
                event.preventDefault();
                //collect users inputs
                var datatopost = $(this).serializeArray(); //get the array of object
                //send them to signup.php processing 
                $.ajax({
                    url: "storeresetpassword.php",
                    type: "POST",
                    data: datatopost,
                    //ajax call successful: show error or success message
                    success: function(data){
                        //if php files returns "success": redirect the user to notes page
                        if(data == "success"){ //if data is not empty
                           $("#resultmessage").html(data);
                        }else {
                            $('#resultmessage').html(data);
                        }
                    },
                    //ajax call fails: show ajax call error
                    error: function(){
                         $("#resultmessage").html("<div class='alert alert-danger'>There was an error with Ajax Call. Please try again later</div>");
                    }
                });  
            });
        </script>    
    </body>
</html>