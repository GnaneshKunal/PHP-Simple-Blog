<?php
$db=mysqli_connect('localhost','root','mysql','blog');
if(!$db)
    throw new exception("Can't connect to database");

?>