<?Php
    include("include/connection.php");
    include("include/functions.php");

    $id_number = "";
    $new_password = "";
    $confirm_new_password = "";
    $message = "";
    $color = "";

    if(isset($_POST['btn_change_passw']))
    {
        $id_number = clean_data($_POST['idno']);
        $new_password = clean_data($_POST['passw']);
        $confirm_new_password = clean_data($_POST['confirm-passw']);
        
        $sql_select_id = "SELECT IDNumber FROM users WHERE(IDNumber='$id_number')";
        $query_select_id = mysql_query($sql_select_id) or die(mysql_error());
        $row_count = mysql_num_rows($query_select_id);
        
        if($row_count == 1)
        {
            $new_password = md5($new_password);
            $sql_update_passw = "UPDATE users SET Password='$new_password' WHERE IDNumber='$id_number'";
            $query_update_password = mysql_query($sql_update_passw) or die(mysql_error());

            if($query_update_password)
            {
                $message = "Password changed, continue to login";
                $color = "669933";
            }
        }
        else
        {
            $message = "ID number not found";
            $color = "d64b1a";
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
                    <h3>Change password below</h3>
                    <form id="forgot-passw" action="<?Php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                        <p>
                            <label>ID Number: <br><input type="text" name="idno" id="idno" class="logininput" value="<?Php echo $id_number; ?>" maxlength="13"></label><br>
                            <span class="error" id="err-idnumber">Username is required</span>
                        </p>
                        
                        <p>
                            <label>New Password: <br><input type="password" name="passw" id="passw" class="logininput"></label><br>
                            <span class="error" id="err-newpassw">Password is required</span>
                        </p>
                        <p>
                            <label>Confirm New Password: <br><input type="password" name="confirm-passw" id="confirm-passw" class="logininput"></label><br>
                            <span class="error" id="err-con-newpassw">Password didn't match</span>
                        </p>
                        
                        <p>
                            <input type="submit" value="Change password" name="btn_change_passw" id="btnlogin">
                        </p>
                        <?Php echo "<span style='color:#$color'>" . $message . "</span>"; ?>
                        <p>
                            <a href="login.php">Login</a> | <a href="register.php">Create account</a>
                        </p>
                        <span></span>
                    </form>
                </div>
            </div>
            <?Php include("include/footer.php"); ?>
        </div>
    </body>
</html>