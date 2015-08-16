<?php
//session_start();

	require_once "Mail.php";
	//Get entries from form
	$field_name = $_POST['name'];
	$field_email = $_POST['mail'];
	$field_message = $_POST['comment'];
//	$field_version = $_POST['version'];

//Get IP Address
$ip = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');

//Create Message Headers
$mail_to = 'isaac@isaacscomputertips.com';
$subject = 'New Form Entry from '.$field_name;

//Create email
$body_message = 'You received a new form entry on your nOS contact form. The details are as follows:'."\n"."\n";
$body_message .= 'From: '.$field_name."\n";
$body_message .= 'E-mail: '.$field_email."\n";
$body_message .= 'Message: '.$field_message."\n";
//$body_message .= 'Do they use nOS: '.$field_version. "\n";
$body_message .= "IP Address: ".$ip. "\n";

//Create autoresponse
$auto_subject = "Thank you for your form entry";
$auto_response = "You should receive a response shortly";
$auto_response .= "Thank you for your entry, your details are as follows";
$auto_response .= $body_message. "\n";

//Generate Additional Headers
$headers = "From: ".$field_email."\r\n";
$headers .= "Reply-To: ".$field_email."\r\n";

//Check if user is legit

include('legitcheck.php');

//Get SQL stuff ready
$con=mysqli_connect("localhost","root","is@@c801","safedriver");
$sqlname = mysqli_real_escape_string($con, $field_name);
$sqlmail = mysqli_real_escape_string($con, $field_email);
$sqlmessage = mysqli_real_escape_string($con, $field_message);
//$sqlversion = mysqli_real_escape_string($con, $field_version);

$sql="INSERT INTO contact_form (name, email, version, comment, ip) 
VALUES ('$sqlname', '$sqlmail', 'drivesafe', '$sqlmessage', '$ip')";

// Test SQL
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//Go for it

if (!mysqli_query($con,$sql)) {
  die('Error: ' . mysqli_error($con));
}
mysqli_close($con);

if(mail($mail_to, $subject, $body_message, $headers)) {
	echo 	"<script language=\"javascript\" type=\"text/javascript\">";
	echo	"window.location = \"sent.html\";";
	echo	"</script>";
}
else 
{		
	echo 	"<script language=\"javascript\" type=\"text/javascript\">";
	echo	"window.location = \"fail.html\";";
	echo	"</script>";
}
echo "Script Finished";
?>
