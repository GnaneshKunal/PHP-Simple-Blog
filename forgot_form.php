<?php
session_start();
require_once('all_fns.php');
do_header("Forgot Password");
if(valid_user()){
    header('Location:main.php');
}else{
    forgot_form();
}
do_footer();
?>