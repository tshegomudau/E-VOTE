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
                <h2 style="border-bottom: #32a455 thin solid;">Contact information</h2>
                <div id="contactdetails">
                    <table width="390" border="0" cellspacing="0">
                        <tr>
                            <td width="188">Contact Department</td>
                            <td width="186">International Election Commission</td>
                        </tr>
                        <tr>
                            <td>Contact Number</td>
                            <td>(062) 250 1250</td>
                        </tr>
                        <tr>
                            <td>Email-Address</td>
                            <td><a href="mailto:e-ballot.co.za">e-ballot.co.za</a></td>
                        </tr>
                    </table>
                    <h3>Contact Form</h3>
                    <div id="contactform">
                        <form id="frm-contact" action="confirm_email.php" method="POST">
                            <p>
                                <label>
                                    Full name<br>
                                    <input type="text" id="fullname" name="fullname" class="inp_contact" />
                                </label>
                                <br><span id="errfullname" class="error">Please enter full name</span>
                            </p>
                            <p>
                                <label>
                                    Email<br>
                                    <input type="text" id="email" name="email" class="inp_contact" />
                                </label>
                                <br><span id="erremail" class="error">Please enter email address</span>
                            </p>
                            <p>
                                <label>
                                    Subject<br>
                                    <input type="text" id="subject" name="subject" class="inp_contact" />
                                </label>
                                <br><span id="errsubject" class="error">Please enter subject</span>
                            </p>
                            <p>
                                <label>
                                    Message<br>
                                    <textarea id="message" name="message"></textarea>
                                </label>
                                <br><span id="errmessage" class="error">Please enter message</span>
                            </p>
                            <p>
                                <input type="submit" name="send" value="Send" />
                            </p>
                        </form>
                    </div>
                </div>
            </div>
            <?Php include("include/footer.php"); ?>
        </div>
    </body>
</html>