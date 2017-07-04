<?php
	include("include/connect.php");
	session_start();
	
	$vsrslts = "";
	$vfrslts = "";
	
	$id = $_SESSION["VoterID"];
	
	$sel_query = "SELECT * FROM voting_stats WHERE(voterId = '$id')";
	
	$ran_query = mysql_query($sel_query) or die(mysql_error());
	$conv_to_array = mysql_fetch_array($ran_query);
	
	if(isset($_POST["vote"]))
	{
		$party = "";
		
		if(isset($_POST["pol_parties"]))
		{
			$party = $_POST["pol_parties"];
		}
		
		if($party != "" && $conv_to_array["parties"] == "")
		{
		
			$vote_query = "UPDATE voting_stats SET parties = '$party' WHERE(voterId = '$id')";
			$vran_query = mysql_query($vote_query) or die(mysql_error());
			$vsrslts = "You have successfully voted for the " . $_POST["pol_parties"] . " party.";
			
		}
		
		else
		{
			$vfrslts = "Failed,click one party and click the 'Vote Now' button to vote.";
		}
		
		if($party != "" && $conv_to_array["parties"] != "")
		{
			$vfrslts = "Failed,you cannot vote twice.";
		}
	}
?>
<html>
	<head>
		<title>Vote for your desired party.</title>
		
		<link rel = "stylesheet" type = "text/css" href = "styles/style.css"/>
	</head>
	
	<body>
		<div id = "wrapper">
			<?php include("include/header.php"); ?>
			<?php include("include/lmenus.php"); ?>
			
			<div id = "content">
				
			</div>
			<?php include("include/footer.php"); ?>
		</div>
	</body>
</html>