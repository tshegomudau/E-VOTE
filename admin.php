<?Php
    session_start();

    include("include/connection.php");
    include("include/functions.php");

    page_auth();
    
    $sql_select_image = "SELECT * FROM leaders JOIN parties ON leaders.LeaderID=parties.LeaderID";
    $query_image = mysql_query($sql_select_image)  or die(mysql_error());
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
            <div id="admin_data">
                <div id="partylist">
                    <table width="550" border="1" cellspacing="0">
                        <tr>
                            <td width="33" align="center"><strong>No.</strong></td>
                            <td width="75" align="center"><strong>Party ID</strong></td>
                            <td width="105" align="center"><strong>Party Name</strong></td>
                            <td width="58" align="center"><strong>Leader</strong></td>
                            <td width="58" align="center"><strong>Leader Picture</strong></td>
                            <td width="74" align="center"><strong>Party Logo</strong></td>
                            <td colspan="2" align="center"><strong>Options</strong></td>
                        </tr>
                        <?Php
                            $count = 1;
                            while($rlt = mysql_fetch_array($query_image))
                            {   
                                $partyid = $rlt['PartyID'];
                                $leader_id = $rlt['LeaderID'];
                                $partyname = $rlt['PartyName'];
                                $fname = $rlt['FirstName'] . " " . $rlt['Surname'];
                                $leaderimage = $rlt['Image'];
                                $logo = $rlt['PartyLogo'];

                                ?>
                                    <tr>
                                        <td align="center"><?Php echo $count; ?></td>
                                        <td align="center"><?Php echo $partyid; ?></td>
                                        <td align="center"><?Php echo $partyname; ?></td>
                                        <td align="center"><?Php echo $fname; ?></td>
                                        <td align="center">
                                            <img src = "data:image;base64,<?Php echo $leaderimage; ?>" height="50" width="50" 
                                                 alt="<?Php echo $fname; ?>" title="<?Php echo $fname; ?>"/>
                                        </td>
                                        <td align="center">
                                            <img src = "data:image;base64,<?Php echo $logo; ?>" height="50" width="50" 
                                                 alt="<?Php echo $fname; ?>"/>
                                        </td>
                                        <td width="52" align="center">
                                            <a href="confirm-party-delete.php?leaderid=<?Php echo $leader_id; ?>&partyid=<?Php echo $partyid;?>">Delete</a>
                                        </td>
                                        <td width="52" align="center">
                                            <a href="update-party.php?leaderid=<?Php echo $leader_id; ?>&partyid=<?Php echo $partyid;?>">Update</a>
                                        </td>
                                    </tr>
                                <?Php
                                $count++;
                            }
                        ?>
                    </table>
                </div>
            </div>
            <?Php include("include/footer.php"); ?>
        </div>
    </body>
</html>