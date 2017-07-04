<?Php
	include("include/connection.php");
    include("include/functions.php");

    page_auth();

	if(isset($_GET['leaderid']))
	{
        $id = (int) clean_data($_GET['leaderid']);
		$sql_delete = "DELETE FROM leaders WHERE(LeaderID=$id)";
		$query_delete = mysql_query($sql_delete) or die(mysql_error());
        
        $message = "";
		if($query_delete)
        {
            $message = "Successfully deleted. <a href='admin.php'>Return to parties</a>";
        }
        else
        {
            $message = "Error occured. <a href='admin.php'>Return to parties</a>";
        }
	}
?>
<?Php
session_start();
include('include/connection.php');
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
            <div id="admin_data">
                <?Php if(isset($message)) echo "<h2>" . $message . "</h2>"?>
            </div>
            <?Php include("include/footer.php"); ?>
        </div>
    </body>
</html>