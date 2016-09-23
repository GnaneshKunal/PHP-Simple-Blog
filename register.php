<?php
session_start();
require_once('all_fns.php');
if(valid_user())
    header("Location:main.php");
else{
    try{
    $username=$_POST['username'];
    $pass=$_POST['password'];
    $email=$_POST['email'];
    if(trim($username)=='' || trim($username)=='' || empty($username)|| empty($pass) ||  trim($email)=='' || empty($email)){
        throw new Exception("Please Fill out the form");
    }
    if(valid_email($email))
        throw new exception("The Email is not valid");
    if(trim($username)<6 && trim($username) >16){
        throw new exception("The username should be less than 10 and greater than 6 letters");
    }
    if(trim($pass)<6 && trim($pass)>16){
        throw new exception("The password should be less than 10 and greater than 6 letters");
    }
    $forgot=rand(100000,999999);
    if($db->query("insert into users values('$username',sha1('$pass'),'$email',$forgot)")){
        $_SESSION['valid_user']=$username;
        header('Location:main.php');
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