<?Php
    include("include/connection.php");
    include("include/functions.php");
    session_start();
    
    page_auth();
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
            <div id="reg">
                <h2>Update personal Information</h2>
                <form name="registration" id ="registration" method="POST" action="<?Php echo $_SERVER['PHP_SELF']; ?>">
                    <p>
                        <label>
                            Email(Optional) <br>
                            <input type="text" name="email" id="email" class="reginp" placeholder = "example@gmail.com"/>
                        </label>
                        <span class="error" id="erremail">Email address is required</span>
                    </p>

                    <p>
                        <label>
                            Contact No <br>
                            <input type="text" name="contactno" id="contactno" class="reginp"/>
                        </label>
                        <span class="error" id="errcontactno">Contact number is required</span>
                    </p>

                    <p>
                        <label>
                            Password <br>
                            <input type="password" name="passw" id="passw" class="reginp"/>
                        </label>
                        <span class="error" id="errpassw">Password is required</span>
                    </p>
                    <p>
                        <label>
                            Confirm Password <br>
                            <input type="password" name="conpassw" id="conpassw" class="reginp"/>
                        </label>
                        <span class="error" id="errpassw2">Password dont match</span>
                    </p>
                    <p>
                        <input type="submit" value="Update" name="create" ><?Php
                        echo $message;?>
                    </p>
                </form>
            </div>
            <?Php include("include/footer.php"); ?>
        </div>
    </body>
</html>