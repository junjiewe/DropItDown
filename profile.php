<?php
session_start();
if(!isset($_SESSION['user_id'])){ //prevent from going back when log out
    header("location: index.php");
}
include('connection.php');
$user_id = $_SESSION['user_id'];

//get username and email
$sql = "SELECT * FROM users WHERE user_id='$user_id'";
$result = mysqli_query($link,$sql);
$count = mysqli_num_rows($result);

if($count == 1){
    $row = mysqli_fetch_array($result,MYSQL_ASSOC);
    $username = $row['username'];
    $email = $row['email'];
}else {
    echo "There was an error retriving the username and email from database";
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      
    <link href="style.css" rel="stylesheet">  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">  
    <link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">
    <title>Profile</title>
    <style>
         body {
            background-image: linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url('photo/profile.jpg');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        
        #container {
            margin-top: 120px;
        }
        
        #notepad, #allnotes, #done {
            display: none;
        }
        
        .buttons{
            margin-bottom: 20px;
        }
        
        textarea {
            width: 100%;
            max-width: 100%;
            font-size: 16px;
            line-height: 1.5em;
            border-left-width: 20px;
            border-color: lightskyblue;
            color: black;
            background-color: aliceblue;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 2px 2px 5px black;
        }
        
        tr {
            cursor: pointer;
        }
        
        h2,td {
            color: white;
        }
        
        tr:hover {
            background: aliceblue;
        }
        
        .hightlight {
            color: aquamarine !important;
        }
        
    </style>  
  </head>
  <body>
<!--Navigation Bar-->
        <nav class="navbar navbar-expand-lg navbar-light navbar-no-bg">
          <a class="navbar-brand" href="#">Drop It Down!</a>
          <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbartoggle" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbartoggle">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Profile <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="mainlogged.php">My Notes</a>
              </li>  
            </ul>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                  <a class="nav-link" href="#">Logged in as 
                      <b>
                           <?php
                            echo $username;  
                        ?>
                      </b>
                  </a>
              </li>
                
              <li class="nav-item">
                <a class="nav-link" href="#">Log out</a>
              </li> 
            </ul>
          </div>
      </nav>
<!--End of navigation bar-->
      
<!--container-->
      <div class="container" id="container">
          <div class="row justify-content-md-center justify-content-lg-center">
              <div class="col-md-offset-3 col-md-6 col-lg-7">
                  <h2>Account Settings:</h2>
                  <div class="table-responsive">
                      <table class="table table-hover table-condensed table-bordered">
                          <tr data-target="#updateusername" data-toggle="modal">
                            <td>Username</td>
                            <td><?php echo $username;?></td>
                          </tr>
                          <tr data-target="#updateemail" data-toggle="modal">
                            <td>Email</td>
                            <td><?php echo $email ?></td>
                          </tr>
                          <tr data-target="#updatepassword" data-toggle="modal">
                            <td>Password</td>
                            <td>hidden</td>
                          </tr>
                      </table>
                  </div>
              </div>
          </div>
      </div>  
      
      
<!--update username-->      
      <form method="post" id="updateusernameform">
        <div class="modal fade" id="updateusername" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit username</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  
                <!--updateusernamealert from PHP-->
                <div id="updateusernamemessage">
                
                </div>  
                  
                <div class="form-group">
                    <label for="username" > New Username:</label>
                    <input id="username" class="form-control" type="text" name="username" maxlength="30" value="<?php echo $username;?>">
                </div>
                   
              </div>
              <div class="modal-footer">  
                <input class="btn btncolor" name="updateusername" type="submit" value="Submit">  
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </form>
<!--End of Login form-->
      
<!--Update email-->
      <form method="post" id="updateemailform">
        <div class="modal fade" id="updateemail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  
                <!--update email alert from PHP-->
                <div id="updateemailmessage">
                
                </div>  
                  
                <div class="form-group">
                    <label for="loginemail" > New Email:</label>
                    <input id="email" class="form-control" type="email" name="email" maxlength="50" value="<?php echo $email;?>">
                </div>
                   
              </div>
              <div class="modal-footer">  
                <input class="btn btncolor" name="updateusername" type="submit" value="Submit">  
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </form>
<!--End of Update email-->     
 
<!--Update password-->
 <form method="post" id="updatepasswordform">
        <div class="modal fade" id="updatepassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Enter current and new password:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  
                <!--update password alert from PHP-->
                <div id="updatepasswordmessage">
                
                </div>  
                  
                <div class="form-group">
                    <label for="currentpassword" class="sr-only"> Old Password:</label>
                    <input id="currentpassword" class="form-control" type="text" name="currentpassword" maxlength="30" placeholder="Your current password">
                </div>
                
                <div class="form-group">
                    <label for="password" class="sr-only"> New Password:</label>
                    <input id="password" class="form-control" type="text" name="password" maxlength="30" placeholder="New password">
                </div>  
                
                <div class="form-group">
                    <label for="password2" class="sr-only"> Confirm New Password:</label>
                    <input id="password2" class="form-control" type="text" name="password2" maxlength="30" placeholder="Confirm password">
                </div>  
                   
              </div>
              <div class="modal-footer">  
                <input class="btn btncolor" name="updateusername" type="submit" value="Submit">  
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </form>     
<!--End Update Password-->
      
      
<!--footer-->
      <div class="footer">
        <div class="container-fluid">
            <p>Junjie Wei &ensp; Copyright &copy; 2017-
                <?php
                    $today = date("Y");
                    echo $today;
                ?>.
            </p>
        </div>
      </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
  <script src="profile.js"></script>      
  </body>
</html>