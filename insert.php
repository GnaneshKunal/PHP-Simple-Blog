<?php
require_once('all_fns.php');
session_start();
if(valid_user()){
    do_header('Insert Post');
    do_post();
}

?>