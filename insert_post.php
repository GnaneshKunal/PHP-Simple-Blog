<?php
session_start();
require_once('all_fns.php');
try{
    if(valid_user()){
    $title=htmlspecialchars($_POST['btitle']);
    $content=$db->escape_string(htmlspecialchars($_POST['bcontent']));
    if(empty($title) || empty($content) || trim($title)=='' || trim($content)=='')
        throw new exception("Something's missing");
        else{
            $date=date('Y-m-j');
            $sql="insert into blogs(title,content,bdate,author) values('$title','$content','$date','".$_SESSION['valid_user']."')";
            if($db->query($sql)){
                do_header('Success');
                do_content('Post has been added');
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