<?php
session_start();
if(!isset($_SESSION['user_id'])){ //prevent from going back when log out
    header("location: index.php");
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
      
    <title>My Notes</title>
    <style>
        body {
            background-image: linear-gradient(rgba(0,0,0,0.2),rgba(0,0,0,0.2)),url('photo/loggedin.jpg');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        
        #container {
            margin-top: 120px;
        }
        
        #notepad, #allnotes, #done , .delete{
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
        
        
        .noteheader{
            border: 1px solid grey;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            padding: 0 10px;
            background: linear-gradient(rgb(253,245,230), rgb(224,255,255));
        }
        
        
        
        .text{
            font-size: 20px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        
        .timetext {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
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
              <li class="nav-item">
                <a class="nav-link" href="profile.php">Profile <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="#">My Notes</a>
              </li>  
            </ul>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                  <a class="nav-link" href="#">Logged in as 
                      <b>
                        <?php
                            echo $_SESSION['username'];  
                        ?>
                      </b></a>
              </li>
                
              <li class="nav-item">
                <a class="nav-link" href="index.php?logout=1">Log out</a>
              </li> 
            </ul>
          </div>
      </nav>
<!--End of navigation bar-->
      
<!--container-->
      <div class="container" id="container">
          <!--Alert msg-->
          <div id="alert" class="alert alert-danger collapse">
            <a class="close" data-dismiss="alert"> &times; </a>
            <p id="alertContent"></p>  
          </div>
          <div class="row justify-content-lg-center justify-content-md-center">
              <div class="col-md-offset-4 col-md-7 col-lg-8">
                  <div class="buttons">
                      <button id="addnote" type="button" class="btn btn-info btn-lg"> Add Note
                      </button>
                      
                      <button id="edit" type="button" class="btn btn-info btn-lg float-right"> Edit
                      </button>
                      
                      <button id="done" type="button" class="btn btncolor btn-lg float-right"> Done
                      </button>
                      
                      <button id="allnotes" type="button" class="btn btn-info btn-lg"> All Notes
                      </button>
                  </div>
                  <div id="notepad">
                      <textarea rows="10">
                          
                      </textarea>
                  </div>
                  <div id="notes" class="notes">
<!-- Ajax call to php file -->
                  </div>
              </div>
          </div>
      </div>  
      
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
    <script src="mynotes.js"></script>  
  </body>
</html>