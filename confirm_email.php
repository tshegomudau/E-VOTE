<?Php
    include("include/functions.php");
    
    if(isset($_POST['send']))
    {
        $name = clean_data($_POST['fullname']);
        $email = clean_data($_POST['email']);
        $subject = clean_data($_POST['subject']);
        $message = clean_data($_POST['message']);
		
		
         $to = "tshego@tut.ac.za";
         $subject = $subject;
         $header =  $email."\r\n";
         $header .= "Cc:admin@evote.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
      
        
        
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
            <?Php include("include/menus.php"); ?>
            <div id="contact">
                <h2 style="border-bottom: #32a455 thin solid;">Email Confirmation</h2>
                <div id="contactdetails">
                    <table width="390" border="0" cellspacing="0">
                        <tr>
                            <td width="188"><strong>Full name</strong></td>
                        </tr>
                        <tr>
                            <td width="186"><?Php echo $name;?></td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                        </tr>
                        <tr>
                            <td><?Php echo $email;?></td>
                        </tr>
                        <tr>
                            <td><strong>Subject</strong></td>
                        </tr>
                        <tr>
                            <td><?Php echo $subject;?></td>
                        </tr>
                        <tr>
                            <td><strong>Message</strong></td>
                        </tr>
                        <tr>
                            <td><?Php echo $message;?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <?Php include("include/footer.php"); ?>
        </div>
    </body>
</html>