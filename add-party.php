<?Php
    session_start();
    include("include/connection.php");
    include("include/functions.php");

    page_auth();

    if(isset($_POST['save']))
    {
        $partyname = $_POST['partyname'];
        $acronym = $_POST['partyacronym'];
        $fname = $_POST['fname'];
        $surname = $_POST['surname'];

        $leaderimg = addslashes($_FILES['leaderimage']['tmp_name']);
        $leaderimg = file_get_contents($leaderimg);
        $leaderimg = base64_encode($leaderimg);

        $image = addslashes($_FILES['partylogo']['tmp_name']);
        $image = file_get_contents($image);
        $image = base64_encode($image);

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
                    <form id="add-party" action="<?Php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                        <p>
                            <label>
                                First Name<br>
                                <input type="text" name="fname" id="partyleader" class="partydetails">
                            </label><br>
                            <span class="error" id="errpartyleader">First name is required</span>
                        </p>

                        <p>
                            <label>
                                Surname<br>
                                <input type="text" name="surname" id="surname" class="partydetails">
                            </label><br>
                            <span class="error" id="errsurname">Surname is required</span>
                        </p>

                        <p>
                            <label>
                                Party Name<br>
                                <input type="text" name="partyname" id="partyname" class="partydetails">
                            </label><br>
                            <span class="error" id="errpartyname">Party name is required</span>
                        </p>
                        <p>
                            <label>
                                Party Acronym<br>
                                <input type="text" name="partyacronym" id="partyacronym" class="partydetails">
                            </label><br>
                            <span class="error" id="errpartyacronym">Party acronym is required</span>
                        </p>
                        <p>
                            <label>
                                Leader Image<br>
                                <input type="file" name="leaderimage" id="leaderimage">
                            </label><br>
                            <span class="error" id="errimage">Leader image is required</span>
                        </p>
                        <p>
                            <label>
                                Party Logo<br>
                                <input type="file" name="partylogo" id="partylogo">
                            </label><br>
                            <span class="error" id="errlogo">Party logo is required</span>
                        </p>
                        <p>
                            <input type="submit" name="save" value="Save" />
                        </p>
                    </form> 
                </div>
            </div>
            <?Php include("include/footer.php"); ?>
        </div>
    </body>
</html>