<?php
session_start();
require_once('all_fns.php');
try{
    if(valid_user()){
        $old_user=$_SESSION['valid_user'];
        unset($_SESSION['valid_user']);
        session_destroy();
        if($old_user){
            do_content("Logged out");
            header('Location:index.php');
        }
    
}else{
    throw new exception("You are not loggged in yet"); 
        
}
}catch(Exception $e){
    do_header('Problem');
    do_content($e->getMessage());
    do_footer();
}

?>