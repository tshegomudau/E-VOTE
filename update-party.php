<?Php
    session_start();
    include("include/connection.php");
    include("include/functions.php");

    page_auth();

    $lid = (int) clean_data($_GET['leaderid']);
    $pid = (int) clean_data($_GET['partyid']);

    $errors = array();
    
    if(isset($_POST['update']))
    {
        $partyname = clean_data($_POST['partyname']);
        $acronym = clean_data($_POST['partyacronym']);
        $fname = clean_data($_POST['fname']);
        $surname = clean_data($_POST['surname']);
        
        //update leader
        $sql_update_leader = "UPDATE leaders SET FirstName='$fname', Surname='$surname'
                              WHERE(LeaderID=$lid)";
        $query_update_leader = mysql_query($sql_update_leader) or die(mysql_error());
        
        //update party
        $sql_update_party = "UPDATE parties SET PartyName='$partyname', PartyAcronym='$acronym'
                             WHERE(PartyID=$pid)";
        $query_update_party = mysql_query($sql_update_party) or die(mysql_error());
    }

    if(isset($_POST['update-img']))
    {
        $mime_type = $_FILES['leaderimage']['type'];
        
        $type = substr($mime_type, 6, strlen($mime_type));
        $type = strtolower($type);
        
        if($type == "jpeg" || $type == "jpg" || $type == "png")
        {
            $leaderimg = addslashes($_FILES['leaderimage']['tmp_name']);
            $leaderimg = file_get_contents($leaderimg);
            $leaderimg = base64_encode($leaderimg);
            
            $sql_update_leader_img = "UPDATE leaders SET Image='$leaderimg' WHERE(LeaderID=$lid)";
            $query_update_leader_img = mysql_query($sql_update_leader_img) or die(mysql_error());
        }
        else
        {
            $errors['err_leader_img'] = "Only images are allowed";
        }
        
    }

    if(isset($_POST['update-logo']))
    {
        $mime_type = $_FILES['partylogo']['type'];

        $type = substr($mime_type, 6, strlen($mime_type));
        $type = strtolower($type);

        if($type == "jpeg" || $type == "jpg" || $type == "png")
        {
            $logoimg = addslashes($_FILES['partylogo']['tmp_name']);
            $logoimg = file_get_contents($logoimg);
            $logoimg = base64_encode($logoimg);

            $sql_update_logo_img = "UPDATE parties SET PartyLogo='$logoimg' WHERE(PartyID=$pid)";
            $query_update_logo_img = mysql_query($sql_update_logo_img) or die(mysql_error());
        }
        else
        {
            $errors['err_logo_img'] = "Only images are allowed";
        }

    }
    
    $sql_select_data = "SELECT * FROM leaders JOIN parties
                        ON leaders.leaderID=parties.leaderID
                        WHERE(leaders.leaderID=$lid)";

    $query_profile = mysql_query($sql_select_data) or die(mysql_error());
    $rlt_profile = mysql_fetch_assoc($query_profile);
    
    if(isset($_POST['save']))
    {
        $partyname = clean_data($_POST['partyname']);
        $acronym = clean_data($_POST['partyacronym']);
        $fname =clean_data( $_POST['fname']);
        $surname = clean_data($_POST['surname']);

        /*

        $image = addslashes($_FILES['partylogo']['tmp_name']);
        $image = file_get_contents($image);
        $image = base64_encode($image);*/

        $sql_insert = "INSERT INTO leaders(FirstName, Surname, Image)
                               VALUES('$fname', '$surname', '$leaderimg')";

        $query_insert = mysql_query($sql_insert) or die(mysql_error());

        $sql_select_id = "SELECT LeaderID FROM leaders ORDER BY LeaderID DESC LIMIT 0,1";
        $query_select_id = mysql_query($sql_select_id) or die(mysql_error());
        $rlt_id = mysql_fetch_assoc($query_select_id);
        $leader_id = $rlt_id['LeaderID'];

        $sql = "INSERT INTO parties(PartyAcronym, PartyName, PartyLogo, LeaderID)
                        VALUES('$acronym', '$partyname', '$image', $leader_id)";
        $query = mysql_query($sql) or die(mysql_error());

        header("Location: admin.php");
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
            <?Php include("include/_menus.php"); ?>
            <div id="admin_data">
                <div id = "add_party">
                    <form id="update-party" action="<?Php echo $_SERVER['PHP_SELF']; ?>?leaderid=<?Php echo $lid; ?>&partyid=<?Php echo $pid; ?>" method="POST">
                        <p>
                            <label>
                                Leader First Name<br>
                                <input value="<?Php echo $rlt_profile['FirstName'];?>" type="text" name="fname" id="partyleader" class="partydetails">
                            </label><br>
                            <span class="error" id="errpartyleader">First name is required</span>
                        </p>

                        <p>
                            <label>
                                Leader Surname<br>
                                <input value="<?Php echo $rlt_profile['Surname'];?>" type="text" name="surname" id="surname" class="partydetails">
                            </label><br>
                            <span class="error" id="errsurname">Surname is required</span>
                        </p>

                        <p>
                            <label>
                                Party Name<br>
                                <input value="<?Php echo $rlt_profile['PartyName'];?>" type="text" name="partyname" id="partyname" class="partydetails">
                            </label><br>
                            <span class="error" id="errpartyname">Party name is required</span>
                        </p>
                        <p>
                            <label>
                                Party Acronym<br>
                                <input value="<?Php echo $rlt_profile['PartyAcronym'];?>" type="text" name="partyacronym" id="partyacronym" class="partydetails">
                            </label><br>
                            <span class="error" id="errpartyacronym">Party acronym is required</span>
                        </p>
                        
                        <p>
                            <input type="submit" name="update" value="Update" />
                        </p>
                    </form> 
                </div>
                <div style="margin: 20px 0px 0px 300px; width: 300px;">
                    <form id="update-image" action="<?Php echo $_SERVER['PHP_SELF']; ?>?leaderid=<?Php echo $lid; ?>&partyid=<?Php echo $pid; ?>" method="POST" enctype="multipart/form-data">
                        <table class="table">
                            <tr>
                                <td>
                                    <label>
                                        Leader Image<br>
                                        <input type="file" name="leaderimage" id="leaderimage">
                                    </label><br>
                                    <span class="error" id="errimage">Select image file</span>
                                </td>
                                <td>
                                    <input type="submit" name="update-img" value="Save">
                                </td>
                            </tr>
                        </table>
                    </form>
                    <hr>
                    <form id="update-logo" action="<?Php echo $_SERVER['PHP_SELF']; ?>?leaderid=<?Php echo $lid; ?>&partyid=<?Php echo $pid; ?>" method="POST" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td>
                                    <label>
                                        Party Logo<br>
                                        <input type="file" name="partylogo" id="partylogo">
                                    </label><br>
                                    <span class="error" id="errlogo">Select image file</span>
                                </td>
                                <td>
                                    <input type="submit" name="update-logo" value="Save">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <?Php include("include/footer.php"); ?>
        </div>
    </body>
</html>