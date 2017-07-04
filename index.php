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

        $sql = "SELECT UserID, IDNumber, Level, Password FROM users WHERE(IDNumber='$username' AND
                    Password='$password')";

        $query = mysql_query($sql) or die(mysql_error());
        $rlt = mysql_fetch_array($query);
        $rows = mysql_num_rows($query);

        $id = (int)$rlt['UserID'];

        if($rows == 1)
        {
            session_start();
            $_SESSION['user_id'] = $id;
            $_SESSION['idno'] = $rlt['IDNumber'];

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
				header("Location: user_vote.php");
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
        <title>E-Vote</title>
        <link rel="stylesheet" type="text/css" href="styles/styles.css" />
        <script src="scripts/libs/jquery-1.9.1.min.js"></script>
        <script src="scripts/handler.js"></script>
    </head>
    <body>
        <div id="wrapper">
            <?Php include("include/logo.php"); ?>
            <?Php include("include/menus.php"); ?>
            <div id="header">
                <img src="images/banner.jpeg" alt="South African voteing crowd" 
                    title="South African voting crowd" height="200" width="900" />
            </div>
            <div id="content">
                <h2 style="border-bottom: #32a455 thin solid; padding-bottom: 5px;">
                   Welcome to South African e-ballot online voting application
                </h2>
                <p>
                    E-ballot is a South African online application developed to 
                    handle polical votes online. It provides a convenient way of voting for citizens and as well as avoiding standing on long queues to vote.
                </p>
                <div id="steps">
                    <h3 style="font-weight: normal;">
                        Follow this simple steps to vote
                    </h3>
                    <ul id="liststeps">
                        <li>Login using your username and secret password</li>
                        <li>Browse through to locate a party of your choice</li>
                        <li>Select your party and press vote</li>
                        <li>Finally, logout</li>
                    </ul>
                    <div id="info">
                        <table border="0" cellspacing="0">
                            <tr>
                                <td width="32">
                                    <img src="images/Information.png" width="30" height="30">
                                </td>
                                <td width="248">
                                    Please after completing your voting operations from
                                    your account, make sure you logout
                                </td>
                            </tr>
                        </table>      
                    </div>
                </div>
            </div>
            <div id="login">
                <h2 style="border-bottom: #32a455 thin solid; padding-bottom: 5px;">Use the form below to login</h2>
                <form id="login-details" action="<?Php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <p>
                        <label>
                            Username: <br>
                            <input type="text" name="uname" id="uname" class="credentials" maxlength="13"/>
                        </label>
                        <br><span id="err-uname" class="error">Username is missing</span>
                    </p>
                    <p>
                        <label>
                            Password: <br>
                            <input type="password" name="passw" id="passw" class="credentials" />
                        </label>
                        <br><span id="err-passw" class="error">Password is missing</span>
                    </p>
                    <p>
                        <input type="submit" name="btnlogin" id="submit" value="Login"/>
                    </p>
                    <span style="color: #d00;"><?Php echo $message; ?></span>
                    <p>
                        <a href="forgot-password.php">Forgot password</a> | <a href="register.php">Create account</a>
                    </p>
                </form>
            </div>
            <?Php include("include/footer.php"); ?>
        </div>
    </body>
</html>