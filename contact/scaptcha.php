<?php //session_start();

$sentences=array(
	"If you're human, what is",
	"Solve this math problem",
	"To prove you're human, please solve this",
	"What's the result of",
	"Prove that you are human! Solve this"
);

$operands=array(
	"+",
	"-"
);

$sentences_idx=mt_rand(0, count($sentences)-1);  //choose which sentence to show
$_SESSION['sentence']=$sentences[$sentences_idx];  //save it to session
$operands_idx=mt_rand(0, count($operands)-1);  //choose which math operand
$_SESSION['operand']=$operands[$operands_idx];  //save it to session

$num1=mt_rand(1, 10);
$_SESSION['num1']=$num1;
$num2=mt_rand(1, 10);
$_SESSION['num2']=$num2;

switch ($_SESSION['operand']) {
	case "+":
		$_SESSION['result']=$num1+$num2;
	break;

	case "-":
                //check which one is smaller
                if ($num1<$num2) {
                        //swicth value
                        $num3=$num1;
                        $num1=$num2;
                        $num2=$num3;
                };
                $_SESSION['result']=$num1-$num2;
                $_SESSION['num1']=$num1;
                $_SESSION['num2']=$num2;
        break;
}
?>
