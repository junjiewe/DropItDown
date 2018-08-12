<?php
session_start();
include('connection.php');

//get th id of the note sent though ajax
$id = $_POST['id'];
//get the content of the note
$note = $_POST['note'];
//get the time
$time = time();
//run the query and update the note

$sql = "UPDATE notes SET note='$note', time = '$time' WHERE id='$id'";
$result = mysqli_query($link, $sql);
if(!$result){
    echo 'error';
}
?>