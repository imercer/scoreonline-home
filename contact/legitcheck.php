<?php
session_start();

if ($_POST['answer']!=$_SESSION['result']) {
	header('Location: http://downloads.nos.net.nz/drivesafe/legitfail.html');
//	echo "Your answer is wrong! Are you human?";
	exit();
} else {
	echo "Your answer is correct!";
}
?>
