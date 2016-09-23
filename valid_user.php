<?php
function valid_user(){
    if(isset($_SESSION['valid_user'])){
        return true;
    }else{
        return false;
    }
}   
?>