<?php
session_start();
require_once('all_fns.php');
do_header("Registration Form");
if(valid_user()){
    header('Location:main.php');
}else{
    register_form();
}
do_footer();
?>