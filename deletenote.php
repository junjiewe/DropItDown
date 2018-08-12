<?php
session_start();
include('connection.php');

//get th id of the note sent though ajax
$note_id = $_POST['id'];
//run the query to delete the note
$sql = "DELETE FROM notes WHERE id=$note_id";
$result = mysqli_query($link,$sql);
if(!$result){
    echo 'error';
}

?>