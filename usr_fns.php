<?php
function do_header($title){
    ?>
  <!DOCTYPE html>
  <html>

  <head>
    <title>
      <?php echo $title; ?>
    </title>
    <style type="text/css">
      body {
         margin: 0px;
         padding: 0px;
         background-color: #131211;
         font-family: Arial, Helvetica, sans-serif;
         color: #7f7d78;
         font-size: 13px;
         line-height: 19px;
         height: 1000px;
      }
      
      #main {
         background: #c4c0be url(back.png) repeat-x;
      }
      
      small {
         color: #595856;
         font-weight: bold;
         font-size: 11px;
         display: block;
         margin-bottom: 15px;
      }
      
      #main.container {
         background-color: #f5f7f8;
         min-height: 400px;
      }
      
      #footer {
         color: white;
         background: url(back.png) repeat-x;
         padding: 40px;
      }
      
      .container {
         width: 950px;
         margin-left: 200px;
         margin-right: 200px;
         position: relative;
      }
      
      #header {
         padding-top: 20px;
      }
      
      #logo h1,
      #logo small {
         margin: 0px;
         display: block;
         text-indent: -9999px;
      }
      
      ul#menu {
         margin: 0px;
         padding: 0px;
         position: absolute;
         right: 0px;
      }
      
      ul#menu li {
         display: inline;
         margin-left: 12px;
      }
      
      ul#menu li a {
         text-decoration: none;
         color: #716d6a;
         font-family: Verdana, Arial, Helvetica, sans-serif;
         font-size: 15px;
         font-weight: bold;
         text-transform: uppercase;
      }
      
      ul#menu li a.active,
      ul#menu li a:hover {
         color: #211e1e;
      }
      
      .block {
         border: 1px solid #a3a09e;
         background-color: #ffffff;
         margin-bottom: 20px;
      }
      
      .block_inside {
         display: block;
         border: 1px solid #fff;
         background: #fff;
         padding: 30px;
         overflow: auto;
      }
      
      .image_block {
         border: 1px solid #b5b5b5;
         background-color: #d2d2d2;
         padding: 5px;
         float: left;
      }
      
      .image_block img {
         border: 1px solid #b5b5b5;
      }
      
      .text_block {
         /* position: absolute;
         right: 0;
         height: 430px; */
         float: left;
         width: 430px;
         margin-left: 30px;
      }
      
      h2 {
         margin: 0px 0px 10px 0px;
         font-size: 20px;
         font-family: Helvetica, Arial, sans-serif;
         color: #000000;
      }
      
      a {
         color: #007de2;
         text-decoration: none;
      }
      
      a:hover {
         text-decoration: none;
      }
      
      a.button {
         border: 1px solid #32312f;
         border-radius: 9;
         padding: 5px 10px 5px 10px;
         color: #000;
         text-decoration: none;
         text-transform: uppercase;
         font-size: 9px;
         line-height: 25px;
      }
      
      a.button:hover {
         background: #007de2;
         border-color: #007de2;
      }
      
      #footer {
         font-family: verdana, Arial, Helvetica, sans-serif;
         font-size: 10px;
      }
      
      .footer_column {
         float: left;
         width: 120px;
         margin-right: 30px;
      }
      
      #footer .long {
         width: 610px;
      }
      
      #footer h3 {
         color: #e2dddc;
         text-transform: uppercase;
         font-size: 10px;
      }
      
      .footer column ul li,
      .footer_column ul {
         list-style: none;
         margin: 0px;
         padding: 0px;
      }
    </style>
  </head>

  <body>
   
      <div class="container">
         <div id="header">
    <?php
    if(valid_user()){
        do_menu();
    }
    echo "<br />";
    ?>
      <?php
    echo "<br/ >";
}
class knownexception extends Exception{
  
}
function do_content($content){
    ?>
                           <div id="block_featured" class="block">
            <span class="block_inside">
               <div class="image_block">
                  
               </div>
               <div class="text_block">
                           <div style="border:2px solid red;text-align:center;font-size:20px;"><?php echo $content; ?></div>
                           </div>
            </span>
         </div>
        
        <?php
}
function do_footer(){
    ?><div id="footer">
      <div class="container">
         <div class="footer_column long">
            <h3>Website is currently in an Upgrade</h3>
            <p>If you have any problems with the website then please <a href="">Mail me</a>.</p>
         </div>
         <div class="footer_column">
            <h3>Catch me at</h3>
            <ul>
               <li><a href="">Google</a></li>
               <li><a href="">Facebook</a></li>
               <li><a href="">Twitter</a></li>
               <li><a href="">Github</a></li>
            </ul>
         </div>
         <div class="footer_column">
            <h3>MVC</h3>
            <ul>
               <li><a href="">MVC Strategy</a></li>
               <li><a href="">What is MVC?</a></li>
            </ul>
         </div>
      </div>
   </div>
  </body>

  </html>
  <?php
}
function register_form(){
    if(!valid_user()){
    ?>
    <fieldset>
      <legend>Registration</legend>
      <form method="post" action="register.php">
        <table>
          <tr>
            <td>
              Email:
            </td>
            <td>
              <input type="text" name="email" />
            </td>
          </tr>
          <tr>
            <td>Username:</td>
            <td>
              <input type="text" name="username" />
            </td>
          </tr>
          <tr>
            <td>Password:</td>
            <td>
              <input type="password" name="password" />
            </td>
          </tr>
          <tr>
            <td align="center">
              <input type="submit" name="submit" value="Submit" />
            </td>
          </tr>
        </table>
      </form>
    </fieldset>

    <?php
}else{
        header('Location:main.php');
    }
}
function show_posts($user){
    global $db;
    try{
        if(!valid_user())
            header('Location:index.php');
        if(!empty($user)){
        $sql="select title,content,bdate,author from blogs where author='$user'";
            if($result=$db->query($sql)){
                echo "<div style='border:2px solid black'>";
                if($row=$result->num_rows >0){
                    while($row=$result->fetch_assoc()){
                    ?>
      <div class="post-content">
        <div>
          <?php echo $row['title']; ?>
        </div>
        <div>
          <?php echo $row['content']; ?>
        </div>
        <div>
          <?php echo $row['bdate']; ?>
        </div>
        <div>
          <?php echo $row['author']; ?>
        </div>
        <div>
          <a href="delete_post.php?post_id=<?php echo $row['blogid'] ?>"><span style="color:red; font-size:big;font-weight:bold;">X</span></a>
        </div>
      </div>

      <?php
                    }
                        echo "
                                </div>";
    }else{
        throw new exception("Not logged in");
    }}else{
                throw new exception("Can't run the query");
            }
    }
}catch(Exception $e){
            do_header('Problem');
            do_content($e->getMessage());
            do_footer();
        }
}
function valid_email($email){
    if(ereg('^[a-zA-Z0-9\._\-]+@([a-zA-Z0-9][a-zA-Z0-9\-]*\.)+[a-zA-Z]$',$email)){
        return true;
    }else{
        return false;
    }
}
function forgot_pass_form(){
    if(!valid_user()){
        ?>
        <fieldset>
          <legend>Forgot Password</legend>
          <table>
            <tr>
              <td><a href="forgot_form.php">Forgot Password?</a></td>
            </tr>
            <tr>
              <td>
                <a href="forgot_key_form.php">Have Code?</a>
              </td>
            </tr>
          </table>
        </fieldset>
        <?php
    }else{
        header("Location:main.php");
    }
}

function change_pass_form(){
    if(!valid_user()){
        ?>
          <fieldset>
            <legend>Change Password</legend>
            <form method="post" action="change_password_script.php">
              <table>
                <tr>
                  <td>Enter Password:</td>
                  <td><input type="password" name="pass1"></td>
                </tr>
                <tr>
                  <td>
                    Re-Enter Password:
                  </td>
                  <td>
                    <input type="password" name="pass2" />
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type="submit" name="sumbit" />
                  </td>
                </tr>
              </table>
            </form>
          </fieldset>
          <?php
    }else{
        header("Location:main.php");
    }
}
function do_post(){
    if(valid_user()){
    ?>
            <fieldset>
              <legend>Add Post</legend>
              <form method="post" action="insert_post.php">
                <div id="b-container">
                  <div id="cont-title">
                    <span id="b-text">Title:</span><br /><br />
                    <textarea id="b-title" name="btitle" rows="3" cols="50"></textarea>
                  </div><br />
                  <div id="cont-content">
                    <span id="b-text">Content:</span><br /><br />
                    <textarea rows="9" cols="100" type="text" name="bcontent" id="b-content">
                                    
                                </textarea>
                  </div><br />
                  <div id="b-submit">
                    <button type="submit">
                                    <img id="b-sub-img" name="submit" src="pin.png" id="b-sub-img" value="Post" />
                                </button>
                  </div>
                </div>
              </form>
            </fieldset>
            <?php
}
}
function do_menu(){
    if(valid_user()){
?>
              <ul id="menu">
               <li><a href="world.php">World</a></li>
               <li><a href="search.php">Search</a></li>
               <li><a href="insert.php">Add Post</a></li>
               <li><a href="main.php">My Posts</a></li>
               <li><a href="logout.php">Log out</a></li>
            </ul>
            <div id="logo">
               <img src="gun.png" height="75" widith="75" />
               <h1>PHP-Blog</h1>
               <small>Simple is always powerful</small>
            </div>
              <?php
    }
}?>
                <?php
echo date('Y-m-j');

function do_search(){
  if(valid_user()){
    ?><fieldset>
      <legend>Search</legend>
      <form method="post" action="search_form_script.php">
          <table>
            <tr>
              <td>
                Enter Username:
              </td>
              <td>
                <input type="text" name="search" />
              </td>
            </tr>
            <tr>
              <td>
                <input type="submit" name="submit" value='Search' />
              </td>
            </tr>
          </table>
      </form>
    </fieldset>
    <?php
  }else{
    header("Location:index.php");
  }
}


function show_posts_div($user){
    global $db;
    try{
        if(!valid_user())
            header('Location:index.php');
        $sql="select title,content,bdate,author,blogid from blogs where author='$user' order by blogid desc";
            if($result=$db->query($sql)){
               ?><div id="block_featured" class="block">
            <span class="block_inside">
               <div class="image_block">
                  
               </div>
               <div class="text_block">
               <?php
                if($row=$result->num_rows >0){
                    while($row=$result->fetch_assoc()){
                    ?><h2><?php echo $row['title']; ?></h2>
                           <small>posted by <a href=""><?php echo $row['author']; ?></a> at <a href=""><?php $row['bdate']; ?></a></small>
                  <p><?php echo $row['content']; ?></p>
                      <a href="delete_post.php?post_id=<?php echo $row['blogid'] ?>"><span class="button" >X</span></a>

                  <?php
                    }
                }else{
        ?>
                    <div id="block_featured" class="block">
            <span class="block_inside">
               <div class="image_block">
                  
               </div>
               <div class="text_block">
                           <div style="border:2px solid red;text-align:center;font-size:20px;">Empty, Please Come back later</div>
                           </div>
            </span>
         </div>
                    <?php
                }
        }?>
        </div>
            </span>
         </div>
        <?php
        }
catch(Exception $e){
            do_header('Problem');
            do_content($e->getMessage());
            do_footer();
            }
}
function forgot_form(){
    if(!valid_user()){
    ?>
                      <fieldset>
                        <legend>Forgot Password</legend>
                        <form method="post" action="forgot_pass.php">
                          <table>
                            <tr>
                              <td>
                                Email:
                              </td>
                              <td>
                                <input type="text" name="email" />
                              </td>
                            </tr>
                            <tr>
                              <td align="center">
                                <input type="submit" name="submit" value="Submit" />
                              </td>
                            </tr>
                          </table>
                        </form>
                      </fieldset>

                      <?php
}else{
        header('Location:main.php');
    }
}
function forgot_key_form(){
    if(!valid_user()){
    ?>
                        <fieldset>
                          <legend>Forgot Password</legend>
                          <form method="post" action="forgot_key_form_script.php">
                            <table>
                             <tr>
                               <td>
                                 Enter email:
                               </td>
                               <td>
                                 <input type="text" name="email" />
                               </td>
                             </tr>
                              <tr>
                                <td>
                                  Enter Key:
                                </td>

                                <td>
                                  <input type="text" name="key" />
                                </td>
                              </tr>
                              <tr>
                                <td align="center">
                                  <input type="submit" name="submit" value="Submit" />
                                </td>
                              </tr>
                            </table>
                          </form>
                        </fieldset>

                        <?php
}else{
        header('Location:main.php');
    }
}
function show_posts_div_world(){
    global $db;
    try{
        if(!valid_user())
            header('Location:index.php');
        $sql="select * from blogs order by blogid DESC";
            if($result=$db->query($sql)){
               ?><div id="block_featured" class="block">
            <span class="block_inside">
               <div class="image_block">
                  
               </div>
               <div class="text_block">
               <?php
                if($row=$result->num_rows >0){
                    while($row=$result->fetch_assoc()){
                    ?>
                          <h2><?php echo $row['title']; ?></h2>
                           <small>posted by <a href=""><?php echo $row['author']; ?></a> at <a href=""><?php $row['bdate']; ?></a></small>
                            <p><?php echo $row['content']; ?></p>

                          <?php
                    }
                }else{
        ?>
                           <div id="block_featured" class="block">
            <span class="block_inside">
               <div class="image_block">
                  
               </div>
               <div class="text_block">
                           <div style="border:2px solid red;text-align:center;font-size:20px;">Empty, Please Come back later</div>
                           </div>
            </span>
         </div>
                            <?php
                }
        }
       ?></div>
            </span>
         </div>
       <?php
        }
catch(Exception $e){
            do_header('Problem');
            do_content($e->getMessage());
            do_footer();
            }
}

function show_search_posts_div($user){
    global $db;
    try{
        if(!valid_user())
            header('Location:index.php');
        $sql="select title,content,bdate,author,blogid from blogs where author='$user' order by blogid desc";
            if($result=$db->query($sql)){
                #echo "<div style='border:2px solid black'>";
               ?><div id="block_featured" class="block">
            <span class="block_inside">
               <div class="image_block">
                  
               </div>
               <div class="text_block">
               <?php
                if($row=$result->num_rows >0){
                    while($row=$result->fetch_assoc()){
                    ?>
                      <h2><?php echo $row['title']; ?></h2>
                    <div>
                      <?php echo $row['content']; ?>
                    </div>
                    <div>
                      <?php echo $row['bdate']; ?>
                    </div>
                    <div>
                      <?php echo $row['author']; ?>
                    </div>
                    <div>
                      <a href="delete_post.php?post_id=<?php echo $row['blogid'] ?>"><span style="color:red; font-size:big;font-weight:bold;">X</span></a>
                    </div>
                  </div>
                  <?php
                    }
                }else{
        ?>
                    <div id="block_featured" class="block">
            <span class="block_inside">
               <div class="image_block">
                  
               </div>
               <div class="text_block">
                           <div style="border:2px solid red;text-align:center;font-size:20px;">Empty, Please Come back later</div>
                           </div>
            </span>
         </div>
                    <?php
                }
        }
        ?></div>
            </span>
         </div>
        <?php
        }
catch(Exception $e){
            do_header('Problem');
            do_content($e->getMessage());
            do_footer();
            }
}
?>
