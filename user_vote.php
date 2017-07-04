<?Php
    session_start();
    
    include("include/connection.php");
    include("include/functions.php");\
    
    page_auth();

    $sql_select_image = "SELECT * FROM leaders JOIN parties ON leaders.LeaderID=parties.LeaderID";
    $query_image = mysql_query($sql_select_image)  or die(mysql_error());

    $id_no = $_SESSION['idno'];
    $user_id = $_SESSION['user_id'];

    $sql_select_status = "SELECT VotingStatus FROM users WHERE(UserID='$user_id')";
    $query_select_status = mysql_query($sql_select_status) or die(mysql_error());
    $rlt_status = mysql_fetch_assoc($query_select_status);

    $message = "";

    if(isset($_POST['vote']))
    {
        if(isset($_POST['selectedparty']))
        {
            $sql_update = "UPDATE users SET VotingStatus = 'Yes' WHERE(UserID=$user_id)";
            $query_update = mysql_query($sql_update) or die(mysql_error());
            
            $party_selected = $_POST['selectedparty'];
            
            $sql_insert_vote = "INSERT INTO votes(PartyID)
                                VALUES($party_selected)";
            $query_insert_vote = mysql_query($sql_insert_vote) or die(mysql_error());
            
            if($query_update)
            {
                $message = "Thank you for completing the voting process. Your vote has been captured";
                header("Location: feedback.php?feedback=$message");
            }
        }
        else
        {
            $message = "Select a party to vote for";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>E-Vote</title>
        <link rel="stylesheet" type="text/css" href="styles/styles.css" />
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    </head>
    <body>
        <div id="wrapper">
            <?Php include("include/logo.php"); ?>
            <?Php include("include/_menus.php"); ?>
            <h2 style="color: #c00;"><?Php echo $message; ?></h2>
            <div style="padding: 0px 10px;" id="user_data">
                <?Php
                    if($rlt_status['VotingStatus'] == "No")
                    {
                        ?>
                            <h4>Select a party of your choice below and click vote</h4>
                            <form action="<?Php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th width="30" align="center">No.</th>
                                            <th width="30" align="center">Party Acronym</th>
                                            <th width="68" align="center">Party Name</th>
                                            <th width="55" align="center">Leader Name</th>
                                            <th width="50" align="center">Leader Picture</th>
                                            <th width="50" align="center">Party Logo</th>
                                            <th width="120" align="center">Select your party</th>
                                        </tr>
                                    </tbody>
                                    <?Php
                                    $count = 1;
                                    while($rlt = mysql_fetch_array($query_image))
                                    {   
                                        $partyid = $rlt['PartyID'];
                                        $partyname = $rlt['PartyName'];
                                        $partyacronym = $rlt['PartyAcronym'];
                                        $partyleader = $rlt['FirstName'] . " " . $rlt['Surname'];
                                        $leaderimage = $rlt['Image'];
                                        $logo = $rlt['PartyLogo'];

                                    ?>
                                    <tr>
                                        <td align="center"><?Php echo $count; ?></td>
                                        <td align="center"><?Php echo $partyacronym; ?></td>
                                        <td align="center"><?Php echo $partyname; ?></td>
                                        <td align="center"><?Php echo $partyleader; ?></td>
                                        <td align="center">
                                            <img src = "data:image;base64,<?Php echo $leaderimage; ?>" height="50" width="50" />
                                        </td>
                                        <td width="50" align="center">
                                            <img src = "data:image;base64,<?Php echo $logo; ?>" height="50" width="50" />
                                        </td>
                                        <td width="135" align="center">
                                            <input style="width: 20px; height: 20px;" type="radio" name="selectedparty" value="<?Php echo $partyid; ?>" />
                                        </td>
                                    </tr>
                                    <?Php
                                        $count++;
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="7">
                                            <input class="btn btn-large btn-success" type="submit" name="vote" value="Vote" />
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        <?Php
                    }
                    else
                    {
                        ?>
                            <h2>You already placed a vote</h2>
                        <?Php
                    }
                ?>
            </div>
            <?Php include("include/footer.php"); ?>
        </div>
    </body>
</html>