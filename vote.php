<?php
	include("include/connection.php");
    include("include/functions.php");

    page_auth();

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
				<div id = "voting">
					<form action = "" method = "POST">
						
						<p>
							Please click on the following radio buttons to vote for your the political party of your choice and make your vote
							count as a good citizen you are.
						</p>
						
						<p>
							<label>
								Parties to vote for below : </br> 
								<table border = "1px">
									<tr>
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "ANC"/>African National Congress
										</td>
										
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "DA"/>Democratic Alliance
										</td>
									</tr>
									
									
									<tr>
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "COPE"/>Congress of the People
										</td>
										
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "IFP"/>Inkatha Freedom Party
										</td>
									</tr>
									
									
									<tr>
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "ID"/>Independent Democrats
										</td>
										
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "UDM"/>United Democratic Movement
										</td>
									</tr>
									
									
									<tr>
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "FF+"/>Freedom Front Plus
										</td>
										
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "ADCP"/>African Christian Democratic Party
										</td>
									</tr>
									
									
									<tr>
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "UDCP"/>United Christian Democratic Party
										</td>
										
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "PAC"/>Pan Africanist Congress
										</td>
									</tr>
									
									
									<tr>
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "MF"/>Minority Front
										</td>
										
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "Azapo"/>Azanian People's Organisation
										</td>
									</tr>
									
									
									<tr>
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "APC"/>African People's Convention
										</td>
										
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "SACP"/>South African Communist Party
										</td>
									</tr>
									
									
									<tr>
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "NNP"/>New National Party
										</td>
										
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "NA"/>National Alliance
										</td>
									</tr>
									
									
									<tr>
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "NDC"/>National Democratic Convention
										</td>
										
										<td>
											<input type = "radio" name = "pol_parties" id = "pol_parties" value = "FOD"/>Federation of Democrats
										</td>
									</tr>
									
								</table>
							</label></br>
							<div id = "f_status">
								<?php echo $vfrslts; ?>
							</div>
						</p>
						
						<p>
							<label>
								<input type = "submit" name = "vote" value = "Vote Now" />
							</label></br>
							<div id = "s_status">
								<?php echo $vsrslts; ?>
							</div>
						</p>
					</form>
				</div>
			</div>
			
			<?php include("include/footer.php"); ?>
		</div>
	</body>
</html>