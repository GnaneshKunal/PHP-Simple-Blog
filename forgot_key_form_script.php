<?php
session_start();
require_once('all_fns.php');
if(valid_user())
    header("Location:main.php");
else{
    try{
    $key=(int)$_POST['key'];
    if(trim($key)=='' || empty($key)){
        throw new Exception("Please Fill out the form");
    }
    if($key <100000 || $key > 999999)
        throw new Exception("Please enter a Valid Key");
    if($result=$db->query("select username from users where forgot_key='$key'")){
        if($result->num_rows > 0){
            while($row=$result->fetch_assoc()){
            $_SESSION['change_user']=$row['username'];
            header("Location:change_password_form.php");
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