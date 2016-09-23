<?php
session_start();
require_once('all_fns.php');
if(!valid_user()){
    if(isset($_SESSION['change_user_pass'])){
        try{
          $pass1=$_POST['pass1'];
          $pass2=$_POST['pass2'];
          if(trim($pass1)==''||trim($pass2)==''||empty($pass1) || empty($pass2)){
            throw new exception("Please Fill out the form");
          }
          if(strcmp($pass1,$pass2)!==0){
            throw new exception("The password's Doesn't match");
          }
          if(trim($pass1)<6 && trim($pass1)>16){
            throw new exception("The password must be in between 6 and 16");
          }
          $user=$_SESSION['change_user_pass'];
          unset($_SESSION['change_user_pass']);
            $forgot=rand(100000,999999);
          $pass_sql="update users set password=sha1('$pass1') where username ='$user'";
          if($result=$db->query($pass_sql)){
            $sql="update users set forgot_key=$forgot where username='$user'";
            if($db->query($sql)){
                do_header("Success");
                do_content("Changed Password");
                do_footer();
              }
              }else{
              throw new exception("Can't run the query");
              }
          }catch(Exception $e){
          do_header("Success");
          do_content($e->getMessage());
          do_footer();
        }
        }else{
        header("Location:index.php");
    }
}else{
    header("Location: world.php");
}


?>