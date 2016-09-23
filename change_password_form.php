<?php
session_start();
require_once('all_fns.php');
do_header("New Password");
if(!valid_user()){
    if(isset($_SESSION['change_user'])){
        $_SESSION['change_user_pass']=$_SESSION['change_user'];
        unset($_SESSION['change_user']);
        change_pass_form();
        
    }else{
        header("Location:index.php");
    }
}else{
    header("Location: world.php");
}
do_footer();
?>