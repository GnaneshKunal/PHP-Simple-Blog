<?php
require_once('all_fns.php');
session_start();
if(valid_user()){
    do_header('menu');
    show_posts_div_world($_SESSION['valid_user']);
    do_footer();
}
?>
