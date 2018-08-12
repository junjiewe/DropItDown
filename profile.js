//ajax call to update username.php
$("#updateusernameform").submit(function(event){
    //prevent default php processing
    event.preventDefault();
    //collect users inputs
    var datatopost = $(this).serializeArray(); //get the array of object
    //send them to updateusername.php processing 
    $.ajax({
        url: "updateusername.php",
        type: "POST",
        data: datatopost,
        //ajax call successful: show error or success message
        success: function(data){
            if(data){ //if data is not empty
                 $("#updateusernamemessage").html(data);
            }else {
                location.reload();
            }
        },
        //ajax call fails: show ajax call error
        error: function(){
             $("#updateusernamemessage").html("<div class='alert alert-danger'>There was an error with Ajax Call. Please try again later</div>");
        }
    });  
});
//ajax call to updatepassword.php
$("#updatepasswordform").submit(function(event){
    //prevent default php processing
    event.preventDefault();
    //collect users inputs
    var datatopost = $(this).serializeArray(); //get the array of object
    //send them to updateusername.php processing 
    $.ajax({
        url: "updatepassword.php",
        type: "POST",
        data: datatopost,
        //ajax call successful: show error or success message
        success: function(data){
            if(data){ //if data is not empty
                 $("#updatepasswordmessage").html(data);
            }
        },
        //ajax call fails: show ajax call error
        error: function(){
             $("#updatepasswordmessage").html("<div class='alert alert-danger'>There was an error with Ajax Call. Please try again later</div>");
        }
    });  
});
//ajax call to updateemail.php
$("#updateemailform").submit(function(event){
    //prevent default php processing
    event.preventDefault();
    //collect users inputs
    var datatopost = $(this).serializeArray(); //get the array of object
    //send them to updateusername.php processing 
    $.ajax({
        url: "updateemail.php",
        type: "POST",
        data: datatopost,
        //ajax call successful: show error or success message
        success: function(data){
            if(data){ //if data is not empty
                 $("#updateemailmessage").html(data);
            }
        },
        //ajax call fails: show ajax call error
        error: function(){
             $("#updateemailmessage").html("<div class='alert alert-danger'>There was an error with Ajax Call. Please try again later</div>");
        }
    });  
});