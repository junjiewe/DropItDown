//jquery load function
$(function(){
    //define variables
    var activeNote = 0;
    var editMode = false;
    //load notes on page load: Ajax call to loadnotes.php
    $.ajax({
       url: "loadnotes.php",
       success: function(data){
           $("#notes").html(data);
           clickonNote();
           clickonDelete();
       },
       error: function(){
           $("#alertContent").text("There was an error with Ajax call please try again");
                 $("#alert").fadeIn(); 
       }    
    });
    
    //add a new notes: ajax call to createnote.php
    $("#addnote").click(function(){
       $.ajax({
          url: "createnote.php",
          success: function(data){
              if(data == 'error'){
                 $("#alertContent").text("There was an issue insert new note into the database");
                 $("#alert").fadeIn();  
              }else {
                 //update activeNote to the id of the new note
                 activeNote = data;
                 $("textarea").val("");
                 //show hide element  
                 showHide(["#notepad", "#allnotes"], ["#notes","#addnote","#edit", "#done"]);
                 $("textarea").focus();  
              }
          },
        error: function() {
           $("#alertContent").text("There was an error with Ajax call please try again");
           $("#alert").fadeIn(); 
       }    
       }); 
    });
    
    //type note: ajax call to updatenote.php
    $("textarea").keyup(function(){
        //ajax call to update the task id activenote
        $.ajax({
           url: "updatenote.php",
           type: "POST",
           //send the current note content with its id to the php file    
           data: {note:$(this).val(), id:activeNote},    
           success: function (data){
              if(data == 'error'){ //if the data from the database (php file)returns error
                  $("#alertContent").text("There was an issue updating the note in the database!");
                  $("#alert").fadeIn(); 
              }
           },
           error: function(){
               $("#alertContent").text("There was an error with Ajax call please try again");
               $("#alert").fadeIn(); 
           }    
        });  
    });
    
    
    //click on all notes button
    $("#allnotes").click(function(){
        $.ajax({
           url: "loadnotes.php",
           success: function(data){
               $("#notes").html(data);
               showHide(["#addnote","#edit","#notes"],["#allnotes", "#notepad"]);
               clickonNote();
               clickonDelete();
           },
           error: function(){
               $("#alertContent").text("There was an error with Ajax call please try again");
               $("#alert").fadeIn(); 
           }    
        });
    });
    
    //click on done after editing: load notes again
    $("#done").click(function(){
       editMode = false;
       $(".noteheader").removeClass("col-xs-7 col-sm-9");
       $(".noteheader").css('margin-left', '0');
       //show hide element
       showHide(["#edit"],[this,".delete"]);    
    });
    
    //click on edit: go to edit mode (show delete buttons, ...)
    $("#edit").click(function(){
        //swithch to edit mode
       editMode = true; 
       //reduce the width of the notes
       $(".noteheader").addClass("col-xs-7 col-sm-9");
       $(".noteheader").css('margin-left', '30%');
       showHide(['#done', '.delete'],[this]);    
    });
    //functions
        //click on a note
    function clickonNote(){
        $(".noteheader").click(function(){
        if(!editMode){
            //update activiNote variable to id of the note
            activeNote = $(this).attr("id");
            //fill text area
            $("textarea").val($(this).find('.text').text());
            showHide(["#notepad", "#allnotes"], ["#notes","#addnote","#edit", "#done"]);
            $("textarea").focus();  
        }
    });    
    }
    
    //click on delete
    function clickonDelete(){
        $(".delete").click(function(){  
           var deletebtn = $(this);
           $.ajax({
           url: "deletenote.php",
           type: "POST",
           //send the its id to the php file    
           data: {id:deletebtn.next().attr("id")},    
           success: function (data){
              if(data == 'error'){ //if the data from the database (php file)returns error
                  $("#alertContent").text("There was an issue deleting the note from the database!");
                  $("#alert").fadeIn(); 
              }else {
                  //remove contatining div
                  deletebtn.parent().remove();
              }
           },
           error: function(){
               $("#alertContent").text("There was an error with Ajax call please try again");
               $("#alert").fadeIn(); 
           }    
        });         
        });
    }    
    
    //show hide function
    function showHide(array1, array2){
        for(var i = 0; i<array1.length; i++){
            $(array1[i]).show();
        }
        for(var i = 0; i<array2.length; i++){
            $(array2[i]).hide();
        }
    }
});