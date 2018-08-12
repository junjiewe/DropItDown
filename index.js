//Ajax call for the sign up form
    
//once the form is submitted
$("#signupform").submit(function(event){
    //prevent default php processing
    event.preventDefault();
    //collect users inputs
    var datatopost = $(this).serializeArray(); //get the array of object
    //send them to signup.php processing 
    $.ajax({
        url: "signup.php",
        type: "POST",
        data: datatopost,
        //ajax call successful: show error or success message
        success: function(data){
            if(data){ //if data is not empty
                 $("#signupmessage").html(data);
            }
        },
        //ajax call fails: show ajax call error
        error: function(){
             $("#signupmessage").html("<div class='alert alert-danger'>There was an error with Ajax Call. Please try again later</div>");
        }
    });  
});
    


//ajax call for the login form
$("#loginform").submit(function(event){
    //prevent default php processing
    event.preventDefault();
    //collect users inputs
    var datatopost = $(this).serializeArray(); //get the array of object
    //send them to signup.php processing 
    $.ajax({
        url: "login.php",
        type: "POST",
        data: datatopost,
        //ajax call successful: show error or success message
        success: function(data){
            //if php files returns "success": redirect the user to notes page
            if(data == "success"){ //if data is not empty
                window.location = "mainlogged.php";
            }else {
                $('#loginmessage').html(data);
            }
        },
        //ajax call fails: show ajax call error
        error: function(){
             $("#loginmessage").html("<div class='alert alert-danger'>There was an error with Ajax Call. Please try again later</div>");
        }
    });  
});
        
//ajax call for the forgot password form
$("#forgotpasswordform").submit(function(event){
    //prevent default php processing
    event.preventDefault();
    //collect users inputs
    var datatopost = $(this).serializeArray(); //get the array of object
    //send them to signup.php processing 
    $.ajax({
        url: "forgot-password.php",
        type: "POST",
        data: datatopost,
        //ajax call successful: show error or success message
        success: function(data){
            //if php files returns "success": redirect the user to notes page
            if(data == "success"){ //if data is not empty
               $("#forgotpasswordmessage").html(data);
            }else {
                $('#forgotpasswordmessage').html(data);
            }
        },
        //ajax call fails: show ajax call error
        error: function(){
             $("#forgotpasswordmessage").html("<div class='alert alert-danger'>There was an error with Ajax Call. Please try again later</div>");
        }
    });  
});