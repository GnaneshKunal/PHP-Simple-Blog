<?php
session_start();
require_once('all_fns.php');
if(valid_user()){
  if(isset($_SESSION['search_pass'])){
    unset($_SESSION['search_pass']);
        try{
        $search=$_POST['search'];
        if(trim($search)=='' || strlen(trim($search))<4 || empty($search)){
          throw new Exception("Please Enter a Valid name");
        }
        if($result1=$db->query("select username from users where username like '%$search%'")){
              if($result1->num_rows >0){
                  if($result2=$db->query("select * from blogs where author like '%$search%'")){
                  if($result2->num_rows>0){
                    do_header('Search Results');
                    ?><div id="block_featured" class="block">
            <span class="block_inside">
               <div class="image_block">
                  
               </div>
               <div class="text_block">
                    <?php
                    if($hed=$result2->fetch_object()){
                        while($row=$result2->fetch_assoc()){
                        ?><h2><?php echo $row['title']; ?></h2>
                           <small>posted by <a href=""><?php echo $row['author']; ?></a> at <a href=""><?php $row['bdate']; ?></a></small>
                            <p><?php echo $row['content']; ?></p>
                        <?php
                      }
                    }else{
                      throw knownexception("Can't fetch object");
                    }?>
                    </div>
            </span>
         </div>
                    <?php
                    do_footer();
                  }else{
                    throw new knownexception("No Posts to show");
                  }
                }else{
                  throw new Exception("Something went wrong");
                }
              }else{
                throw new knownexception("Sorry, No user's found");
              }
        }else{
          throw new exception("Something went wrong");
        }
      }catch(knownexception $k){
        do_header('search');
        do_content($k->getMessage());
        do_footer();
      }catch(Exception $e){
        do_header('Problem');
        do_content($e->getMessage());
        do_footer();
      }
  }else{
    header("Location:search.php");
  }
}else{
  header("Location:index.php");
}


?>