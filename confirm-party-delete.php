<?Php
    session_start();
    include('include/connection.php');
    include('include/functions.php');
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
            <div id="admin_data">
                <div style="width:600px; background: #fff; padding: 5px; margin: 5px 0px 5px 150px;">
                    <?Php
                        if(isset($_GET['partyid']))
                        {
                                $leader_id = (int) clean_data($_GET['leaderid']);
                                $party_id = (int) clean_data($_GET['partyid']);
                            $sql_check_party_id = "SELECT COUNT(*) AS party_exists FROM parties
                                                   WHERE(PartyID=$party_id)";
                            $query_check_party_id = mysql_query($sql_check_party_id) or die(mysql_error());
                            $rlt_party_id = mysql_fetch_assoc($query_check_party_id);
                            
                            if($rlt_party_id['party_exists'] == 1)
                            {
                                $sql_select_party_name = "SELECT PartyName FROM parties WHERE(PartyID=$party_id)";
                                $query_party_name = mysql_query($sql_select_party_name) or die(mysql_error());
                                $rlt_party_name = mysql_fetch_assoc($query_party_name);
                                
                                ?>
                                    <h2>Are you sure u want to delete <?Php echo $rlt_party_name['PartyName']; ?></h2>
                                    <p>
                                        <button><a href="admin.php">No</a></button>  
                                        <button><a href="delete.php?leaderid=<?Php echo $leader_id; ?>">Yes</a></button> 
                                    </p>
                                <?Php
                            }
                            else
                            {
                                ?>
                                    <h2>Party Don't exists</h2>
                                <?Php
                            }
                        }
                        else
                        {
                            ?>
                                <h2>Party is not available</h2>
                            <?Php
                        }
                    ?>
                </div>
            </div>
            <?Php include("include/footer.php"); ?>
        </div>
    </body>
</html>