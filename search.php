<?php
session_start();
require_once('all_fns.php');
if(valid_user()){
  do_header('Search');
  $_SESSION['search_pass']=true;
  do_search();
  do_footer();
}else
  header("Location:index.php");



?>