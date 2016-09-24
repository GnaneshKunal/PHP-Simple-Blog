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
      textarea {
        resize: none;
        font-size: 15px;
        font-family: "Times New Roman";
        font-weight: bolder;
      }
      
      #b-container {
        margin: 0px;
        padding: 10px;
        padding: 0;
      }
      
      #b-text {
        font-size: 20px;
        font-weight: bold;
      }
      
      #cont-title {
        padding-left: 15px;
      }
      
      #cont-content {
        padding-left: 15px;
      }
      
      #b-submit {
        padding-left: 15px;
      }
      
      #b-sub-img {
        height: 50px;
      }
      
      #nav-menu-nav {
        position: absolute;
        right: 30px;
        
      }
      
      #nav-menu-ins {
        float: left;
      }
      
      li {
        list-style-type: none;
        padding-left: 50px;
      }
      
      #nav-menu-logout {
        float: left;
      }
      
      .clear {
        clear: both;
      }
      
      .post-content {
        padding-top: 25px;
      }
    </style>
  </head>

  <body>
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
    ?><div style="border:2px solid red;text-align:center;font-size:20px;"><?php echo $content; ?></div>
        
        <?php
}
function do_footer(){
    ?>
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
              <div id="nav-menu">
                <nav id="nav-menu-nav">
                  <li id="nav-menu-ins">
                    <a href="world.php">World</a>
                  </li>
                  <li id="nav-menu-ins">
                    <a href="search.php">Search</a>
                  </li>
                  <li id="nav-menu-logout">
                    <a href="insert.php">Add post</a>
                  </li>
                  <li id="nav-menu-logout">
                    <a href="main.php">My Posts</a>
                  </li>
                  <li id="nav-menu-logout">
                    <a href="logout.php">Log out</a>
                  </li>
                </nav>
              </div>
              <div></div>
              <div class="clear">
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
                }else{
        ?>
                    <div style="border:2px solid red;text-align:center;font-size:20px;">You haven't posted anything till now </div>
                    <?php
                }
        }
        echo "</div>";
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
                          </div>

                          <?php
                    }
                }else{
        ?>
                            <div style="border:2px solid red;text-align:center;font-size:20px;">Empty, Please Come back later</div>
                            <?php
                }
        }
        echo "</div>";
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
                }else{
        ?>
                    <div style="border:2px solid red;text-align:center;font-size:20px;">You haven't posted anything till now </div>
                    <?php
                }
        }
        echo "</div>";
        }
catch(Exception $e){
            do_header('Problem');
            do_content($e->getMessage());
            do_footer();
            }
}
?>
