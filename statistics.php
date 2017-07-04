<?Php
	session_start();
    include("include/connection.php");
    include("include/functions.php");

    page_auth();
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
            <div id="contact">
                <h2 style="border-bottom: #32a455 thin solid;">Votes Statistics</h2>
                <div id="contactdetails">
                    <?Php
						$sql_select_stat = "SELECT COUNT(votes.PartyID) AS NumberOfVotes, votes.PartyID,
											PartyName, PartyAcronym FROM votes
											JOIN parties
											ON votes.PartyID = parties.PartyID
											GROUP BY votes.PartyID";
						
						$query_select_stat = mysql_query($sql_select_stat) or die(mysql_error());
                        
                        $sql_num_users = "SELECT COUNT(*) AS num_users FROM users";
                        $query_num_users = mysql_query($sql_num_users) or die(mysql_error());
                        $rlt_num_users = mysql_fetch_assoc($query_num_users);
                        $num_users = $rlt_num_users['num_users'];
						?>
							<table cellspacing="0" border="1" width="450">
								<tr>
									<td><strong>Acronym</strong></td>
									<td><strong>Party name</strong></td>
									<td><strong>Number of votes</strong></td>
									<td><strong>Percentage (%)</strong></td>
								</tr>
								<?Php
									while($rlt_stat = mysql_fetch_assoc($query_select_stat))
									{
                                        $num_votes = (int) $rlt_stat['NumberOfVotes'];
                                        $percentage = round(($num_votes / $num_users) * 100, 0);
										?>
											<tr>
												<td><?Php echo $rlt_stat['PartyAcronym']; ?></td>
												<td><?Php echo $rlt_stat['PartyName']; ?></td>
												<td><?Php echo $num_votes; ?></td>
                                                <td><?Php echo $percentage . "%"; ?></td>
											</tr>
										<?Php
									}
								?>
							</table>
						<?Php
					?>
                </div>
            </div>
            <?Php include("include/footer.php"); ?>
        </div>
    </body>
</html>