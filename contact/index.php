<?php
session_start();
echo "
<head>
<link rel=\"stylesheet\" href=\"http://new.nos.net.nz/css/style.css\">
<link rel=\"stylesheet\" href=\"//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css\">
  <script src=\"//code.jquery.com/jquery-1.10.2.js\"></script>
  <link href=\"http://fonts.googleapis.com/css?family=Ubuntu\" rel=\"stylesheet\" type=\"text/css\">
  <script src=\"//code.jquery.com/ui/1.11.1/jquery-ui.js\"></script>
<style type=\"text/css\">
 <!-- BODY {background:none transparent;}-->
 </style>
</head>
<body>
<br>
        <form action=\"contact.php\" method=\"post\">
                <h3>Name:</h3><p>
            <input type=\"text\" name=\"name\" required><p>
            <h3>E-mail:</h3><p>
            <input type=\"email\" name=\"mail\" required><p>
            <h3>Comment:</h3>
            <p><textarea name=\"comment\" required style=\"width: 120%; height: 30%\"></textarea>
	    <p><br>
";
require('scaptcha.php'); 
echo $_SESSION['sentence']." ".$_SESSION['num1']." ".$_SESSION['operand']." ".$_SESSION['num2']." ? ";
echo "	    <input type=\"text\" name=\"answer\" id=\"answer\" size=\"5\" />
	    <p>
            <input type=\"submit\" value=\"Submit\">
            <br>
        </form>
</body>";
