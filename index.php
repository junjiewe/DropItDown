<?php
session_start();
include('connection.php');

//logout
include('logout.php');

//remember me
include('remember.php');
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
    <title>Drop It Down!</title>
  </head>
  <body>
<!--Navigation Bar-->
        <nav class="navbar navbar-expand-lg navbar-light navbar-no-bg">
          <a class="navbar-brand" href="#">Drop It Down!</a>
          <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbartoggle" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbartoggle">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a id="loginspc" class="nav-link" href="#loginmodal" data-toggle="modal">Login</a>
              </li>   
            </ul>
            
          </div>
      </nav>
<!--End of navigation bar-->
      
<!--Jumbotron-->
      <div class="jumbotron" id="myConatiner">
        <h1>A Convenience Notes App</h1>
        <p>No more of wandering around on your computer to find notes.</p>
        <p>Ease to use, time saving, organized and secure!</p>  
        <button type="button" class="btn btn-lg btncolor signup" data-toggle="modal" data-target="#signupmodal">Sign Up-It's free</button>  
      </div>
<!--Jumbotron-->
      
<!--Sign up form-->
      <form method="post" id="signupform">
        <div class="modal fade" id="signupmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Sign Up</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  
                <!--Sign Up alert from PHP-->
                <div id="signupmessage"></div>  
                  
                <div class="form-group">
                    <label for="username" class="sr-only">Username:</label>
                    <input id="username" class="form-control" type="text" name="username" placeholder="Username" maxlength="30">
                </div>
                <div class="form-group">
                    <label for="email" class="sr-only">Email:</label>
                    <input id="email" class="form-control" type="text" name="email" placeholder="Email" maxlength="50">
                </div>
                <div class="form-group">   
                    <label for="password" class="sr-only">Password:</label>
                    <input id="password" class="form-control" type="password" name="password" placeholder="Password" maxlength="30">
                </div>    
                <div class="form-group">
                    <label for="password2" class="sr-only">Password:</label>
                    <input id="password2" class="form-control" type="password" name="password2" placeholder="Confirm password" maxlength="30">
                </div>    
              </div>
              <div class="modal-footer">
                <input class="btn btncolor" name="signup" type="submit" value="Sign Up">  
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </form>
<!--End of Sign up form-->
      
<!--Login form-->      
      <form method="post" id="loginform">
        <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  
                <!--Loginalert from PHP-->
                <div id="loginmessage">
                
                </div>  
                  
                <div class="form-group">
                    <label for="loginemail" class="sr-only">Email:</label>
                    <input id="loginemail" class="form-control" type="text" name="loginemail" placeholder="Email" maxlength="50">
                </div>
                
                <div class="form-group">   
                    <label for="loginpassword" class="sr-only">Password:</label>
                    <input id="loginpassword" class="form-control" type="password" name="loginpassword" placeholder="Password" maxlength="30">
                </div> 
                  
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="rememberme" id="rememberme">
                        Remember me
                    </label>
                    <a href="#" class="float-right" style="cursor:pointer" data-dismiss="modal" data-target="#forgotpasswordmodal" data-toggle="modal">
                    Forgot Password  
                    </a> 
                </div> 
                   
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" data-target="#signupmodal" data-toggle="modal">Register</button>  
                <input class="btn btncolor" name="login" type="submit" value="Login">  
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </form>
<!--End of Login form-->

<!--Forgot password form-->
      <form method="post" id="forgotpasswordform">
        <div class="modal fade" id="forgotpasswordmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Forgot Password? Enter your email address:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  
                <!--forgot password alert from PHP-->
                <div id="forgotpasswordmessage">
                
                </div>  
                  
                <div class="form-group">
                    <label for="forgotemail" class="sr-only">Email:</label>
                    <input id="forgotemail" class="form-control" type="text" name="forgotemail" placeholder="Email" maxlength="50">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" data-target="#signupmodal" data-toggle="modal">Register</button>  
                <input name="forgotpassword" class="btn btncolor" name="login" type="submit" value="Submit">  
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </form>
<!--End of Forgot password form-->
      
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
    <script src="index.js"></script>   
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>