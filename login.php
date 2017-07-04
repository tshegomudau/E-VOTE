<?Php
    include("include/connection.php");
    include("include/functions.php");

    $username = "";
    $password = "";
    $message = "";

    if(isset($_POST['btnlogin']))
    {
        $username = clean_data($_POST['uname']);
        $password = md5(clean_data($_POST['passw']));

        $sql = "SELECT UserID, Email, Level, Password FROM users WHERE(Username='$username' AND
                Password='$password')";

        $query = mysql_query($sql) or die(mysql_error());
        $rlt = mysql_fetch_array($query);
        $rows = mysql_num_rows($query);

        $id = (int)$rlt['UserID'];
        
        if($rows == 1)
        {
            session_start();
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $rlt['email'];
			
			$level = 0;
			
			if($rlt['Level'] == 1)
			{
				$level = $rlt['Level'];
				$_SESSION['admin_level'] = $level;
				header("Location: admin.php");
			}
			else
			{
				$_SESSION['admin_level'] = $level;
				header("Location: Introduction.php");
			}
        }
        else
        {
            $message = "Login failed. Incorrect username or password.";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="styles/styles.css" type="text/css" />
        <script src="scripts/libs/jquery-1.9.1.min.js"></script>
        <script src="scripts/handler.js"></script>
    </head>
    <body>
        <div id = "wrapper">
            <?Php include("include/menus.php"); ?>
            <div id = "main">
                <div id="logindetails">
                    <h3>Provide login credentials below</h3>
                    <form id="login-details" action="<?Php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <p>
                            <label>Username (ID Number): <br><input type="text" name="uname" id="uname" class="logininput" value="<?Php echo $username; ?>" maxlength="13"></label><br>
                            <span class="error" id="err-uname">Username is required</span>
                        </p>

                        <p>
                            <label>Password: <br><input type="password" name="passw" id="passw" class="logininput"></label><br>
                            <span class="error" id="err-passw">Password is required</span>
                        </p>
                        <span style="color: #d00;"><?Php echo $message; ?></span>
                        <p>
                            <input type="submit" value="Login" name="btnlogin" id="btnlogin">
                        </p>
                        <p>
                            <a href="forgot-password.php">Forgot password</a> | <a href="register.php">Create account</a>
                        </p>
                    </form>
                    <img id="accessimg" src="images/access.png" alt="access control" width="120" height="120"/>
                </div>
            </div>
            <?Php include("include/footer.php"); ?>
        </div>
    </body>
</html>