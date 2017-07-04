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
            <div id="reg">
                <h2>Register To Vote</h2>
                <?Php
                    session_start();
                    include("include/connection.php");
                    include("include/functions.php");
                    $message = "";
                    
                    if(account_exists($_SESSION['idno']))
                    {
                        ?>
                            <div>
                                <?Php echo $_SESSION['idno'] . " already registered. "?>Click to <a href="login.php">Login</a>
                            </div>
                        <?Php
                    }
                    else
                    {
                        if(isset($_SESSION['idno']))
                        {
                            $idnum = $_SESSION['idno'];
                        }

                        if(isset($_POST['create']))
                        {
                            $contact = clean_data($_POST['contactno']);
                            $email = clean_data($_POST['email']);
                            $password = md5(clean_data($_POST['passw']));

                            $sql = "INSERT INTO users(IDNumber, Password, Email, ContactNo, VotingStatus)
                                        values('$idnum', '$password', '$email', '$contact', 'No')";
                            $query = mysql_query($sql) or die(mysql_error());

                            if($query)
                            {
                                header("Location: login.php");
                            }
                        }
                        require("include/reg_form.php");
                    }
                ?>
                
            </div>
            <?Php include("include/footer.php"); ?>
        </div>
    </body>
</html>