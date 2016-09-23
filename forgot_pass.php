<?php
session_start();
require_once('all_fns.php');
if(valid_user())
    header("Location:main.php");
else{
    try{
    $email=$_POST['email'];
    if(trim($email)=='' || empty($email)){
        throw new Exception("Please Fill out the form");
    }
    if(valid_email($email))
        throw new exception("The Email is not valid");
    if($result=$db->query("select forgot_key from users where email='$email'")){
        if($row=$result->fetch_object()){
            $subject="Password Reset key";
            $content="Your Password Reset code is ".$row->forgot_key." . \n \r Please Don't give the code to anyone";
            if(mail($email,$subject,$content,"From: noreply@phpblog.com\r\n")){
                do_content("We have mailed you the code");
            }else{
                throw new Exception("Can't Mail you");
            }
        }else{
            throw new Exception("Can't fetch the object");
        }
    }else{
        throw new exception("Can't run query");
    }
}catch(Exception $e){
    do_header('Problem');
    do_content($e->getMessage());
    do_footer();
}
}
?>