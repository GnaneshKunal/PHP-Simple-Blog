<?php
require_once('all_fns.php');
session_start();
do_header('Hompage');
if(valid_user()){
    header("Location:main.php");
}else{    
    if(!isset($_POST['submit'])){
        ?>
        <fieldset>
            <legend>
                Login
            </legend>
            <form method="post">
                <table>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" />
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
                            <input type="submit" name="submit" value="Login" />
                        </td>
                    </tr>
                </table>
            </form>
        </fieldset><br />
        <a href="register-form.php">Not a Member?</a>   
        <a href="forgot_pass_form.php">Having problems in Signing in?</a>
        <?php
    }else{
        try{
        $username=$_POST['username'];
        $pass=$_POST['password'];
        if(trim($username)=='' || trim($pass)=='' || empty($username) || empty($pass)){
            throw new exception("Fill out");
        }
            $sql="select * from users where username='$username' and password = sha1('$pass')";
            if(!$result=$db->query($sql)){
                throw new exception("Can't run query");
            }else{
                $row=$result->fetch_assoc();
                
                if($row){
                    $_SESSION['valid_user']=$_POST['username'];
                    header('Location:world.php');
                }else
                    throw new exception("User Not available");
            }
        }catch(Exception $e){
            do_content($e->getMessage());
        }
    }
}
do_footer();
?>