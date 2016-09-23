<?php
session_start();
require_once('all_fns.php');
try{
    if(valid_user()){
    $post_id=(int)$_GET['post_id'];
    if(empty($post_id))
        throw new exception("Something's missing");
        else{
            $sql="delete from blogs where blogid=$post_id";
            if($db->query($sql)){
                do_header('Success');
                do_content('Post has been deleted');
                do_content("<a href='main.php'>Go back</a>");
                do_footer();
            }else{
                throw new exception("Can't run the query");
            }
        }
    }else
        throw new exception("You haven't logged in yet");
}
catch(Exception $e){
    do_header('Problem');
    do_content($e->getMessage());
    do_footer();
}
?>