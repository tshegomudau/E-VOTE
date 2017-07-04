<?Php
    session_start();
    include("include/connection.php"); 
    include("include/functions.php");
    
    $message = "";
    $idnum = "";
    $display = false;
    $vcodeError = "";

    if(isset($_POST['check']))
    {
        $idnum = clean_data($_POST['idnum']);
        
        if(check_citizen($idnum))
        {
            if(account_exists($idnum))
            {
                $_SESSION['found'] = false;
                $message = "You have register already. <a href='login'>Login</a>";
            }
            else
            {
                $_SESSION['found'] = true;
            }
        }
        else
        {
            $message = "ID not found. Check if you entered correct 	ID";
            $_SESSION['found'] = false;
        }
    }

    if(isset($_POST['Verify']))
    {
        $verify_code = $_POST['code'];
        $id = $_SESSION['idno'];
        
        if(code_verification($verify_code, $id))
        {
            $display = true;
        }
        else
        {
           $vcodeError = "Code didn't Match"; 
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
            <div id="reg">
                <h2>Provide your ID number</h2>
                <form id="chek-id" action="<?Php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <p>
                        <label>
                            ID No <br>
                            <input type="text" name="idnum" id="idnum" class="reginp" value="<?Php echo $idnum; ?>"
                                 maxlength="13" placeholder="1718253610256"/>
                        </label><br>
                        <span class="error" id="err-idno">Please enter you ID number</span>
                    </p>
                    <p>
                        <input type="submit" value="Continue" name="check" /> <span style="color: #c00;"><br><?Php echo $message; ?></span>
                    </p>
                </form>
                <?Php
                    if(isset($_SESSION['found']) && $_SESSION['found'] == true)
                    {
                        unset($_SESSION['found']);
                        ?>
                            <div>
                                <?Php
                                    $idno = $_SESSION['idno'];
                                    $sql = "SELECT * FROM home_affairs WHERE(IDNumber='$idno')";
                                    $query = mysql_query($sql) or die(mysql_error());
                                    $rlt = mysql_fetch_assoc($query);
                                    ?>
                                        <table>
                                            <tr>
                                                <th colspan="999" align="center">Your Personal Details</th>
                                            </tr>
                                            <tr>
                                                <td width="100">First Name</td>
                                                <td><?Php echo $rlt['FirstName']; ?></td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Surname</td>
                                                <td><?Php echo $rlt['Surname']; ?></td>
                                            </tr>

                                            <tr>
                                                <td>Gender</td>
                                                <td><?Php echo $rlt['Gender']; ?></td>
                                            </tr>

                                            <tr>
                                                <td>ID Number</td>
                                                <td><?Php echo $rlt['IDNumber']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td><?Php echo $rlt['Address']; ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <a href="step2.php">Continue</a>
                                                </td>
                                            </tr>
                                        </table>
                                    <?Php
                                ?>
                            </div>
                        <?Php
                    }
                ?>
            </div>
            <?Php include("include/footer.php"); ?>
        </div>
    </body>
</html>