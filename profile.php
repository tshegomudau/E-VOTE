<?Php
    session_start();
    include("include/connection.php");
    include("include/functions.php");

    page_auth();
    $idno = $_SESSION['idno'];
    
    $message = "";
    
    if(isset($_POST['update-profile']))
    {
        $email = clean_data($_POST['email-address']); 
        $contactno = clean_data($_POST['contact-no']);
        
        $sql_update_profile = "UPDATE users SET Email='$email', ContactNo='$contactno' WHERE(IDNumber='$idno')";
        $query_update_profile = mysql_query($sql_update_profile) or die(mysql_error());
        
        if($query_update_profile)
        {
            $message = "Updated succesfully";
        }
        else
        {
            $message = ";Error occured";
        }
    }

    $passw_status = "";
    
    if(isset($_POST['change-passw']))
    {
        $password = clean_data($_POST['passw']); 
        $password = md5($password);
        $sql_update_profile = "UPDATE users SET Password='$password' WHERE(IDNumber='$idno')";
        $query_update_profile = mysql_query($sql_update_profile) or die(mysql_error());

        if($query_update_profile)
        {
            $passw_status = "Password changed";
        }
        else
        {
            $passw_status = "Error occured";
        }
    }
    
    $sql_select_profile = "SELECT * FROM home_affairs, users 
                              WHERE(home_affairs.IDNumber=users.IDNumber 
                              AND home_affairs.IDNumber='$idno')";
    $query_profile = mysql_query($sql_select_profile) or die(mysql_error());
    $rlt_profile = mysql_fetch_assoc($query_profile);
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
            <?Php include("include/_menus.php"); ?>
            <div id="profile-summary">
                <h2>Profile</h2>
                <table cellspacing="0" border="1">
                    <tr>
                        <td>First Name</td>
                        <td><?Php echo $rlt_profile['FirstName']; ?></td>
                    </tr>
                    <tr>
                        <td>Surname</td>
                        <td><?Php echo $rlt_profile['Surname']; ?></td>
                    </tr>
                    <tr>
                        <td>ID Number</td>
                        <td><?Php echo $rlt_profile['IDNumber']; ?></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td><?Php echo $rlt_profile['Gender']; ?></td>
                    </tr>
                    <tr>
                        <td>Contact Number</td>
                        <td><?Php echo $rlt_profile['ContactNo']; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?Php echo $rlt_profile['Email']; ?></td>
                    </tr>
                </table>
            </div>
            <div id="profile">
                <h2 style="border-bottom: #32a455 thin solid;">Edit your profile</h2>
                <form id="update-contact" action="<?Php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <p>
                        <label>
                            Email Address <br>
                            <input type="text" name="email-address" id="email-address" class="reginp" value="<?Php echo $rlt_profile['Email']; ?>"/>
                        </label>
                        <br><span id="erremail" class="error">Email address is required</span>
                    </p>
                    
                    <p>
                        <label>
                            Contact Number <br>
                            <input type="text" name="contact-no" id="contact-no" class="reginp" value="<?Php echo $rlt_profile['ContactNo']; ?>"/>
                        </label>
                        <br><span id="errcontactno" class="error">Contact number is required</span>
                    </p>
                    
                    <p>
                        <input type="submit" value="Update" name="update-profile" >
                        <span style="color: #13b75d;">
                            <?Php
                                if(isset($message))
                                    echo $message;
                            ;?>
                        </span>
                    </p>
                </form>
                <form id="change-passw" action="<?Php echo $_SERVER['PHP_SELF']?>" method="POST">
                    <h2>Change password</h2>
                    <p>
                        <label>
                            Password <br>
                            <input type="password" name="passw" id="passw" class="reginp"/>
                        </label>
                        <br><span id="errpassw" class="error">Password is required</span>
                    </p>
                    <p>
                        <label>
                            Confirm Password <br>
                            <input type="password" name="conpassw" id="conpassw" class="reginp"/>
                        </label>
                        <br><span id="errpassw2" class="error">Confirm password didn't math</span>
                    </p>
                    
                    <p>
                        <input type="submit" value="Change password" name="change-passw">
                        <span style="color: #13b75d;">
                            <?Php
                            if(isset($passw_status))
                                echo $passw_status;
                            ;?>
                        </span>
                    </p>
                </form>
            </div>
            <?Php include("include/footer.php"); ?>
        </div>
    </body>
</html>