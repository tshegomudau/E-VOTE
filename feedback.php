<?Php
    session_start();
    include("include/connection.php");

    $sql_select_image = "SELECT * FROM leaders JOIN parties ON leaders.LeaderID=parties.LeaderID";
    $query_image = mysql_query($sql_select_image)  or die(mysql_error());

    $user_id = $_SESSION['user_id'];

    $sql_select_status = "SELECT VotingStatus FROM users WHERE(UserID=$user_id)";
    $query_select_status = mysql_query($sql_select_status) or die(mysql_error());
    $rlt_status = mysql_fetch_assoc($query_select_status);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>E-Vote</title>
        <link rel="stylesheet" type="text/css" href="styles/styles.css" />
    </head>
    <body>
        <div id="wrapper">
            <?Php include("include/logo.php"); ?>
            <?Php include("include/_menus.php"); ?>
            <div>
                <h1>Voting feedback:</h1>
                <h2 style="color: #0a0;">
                    <?Php
                        $message = "";
                        if(isset($_GET['feedback']))
                        {
                            $message = $_GET['feedback'];
                        }
                        
                        echo $message;
                    ?>
                        
                </h2>
            </div>
            <?Php include("include/footer.php"); ?>
        </div>
    </body>
</html>