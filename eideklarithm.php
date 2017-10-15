<?php

header('Content-type: application/json');
header('Cache-Control: no-cache, must-revalidate');
require("lib/lib.php");

$errcode = 0;
$errdescr = '';


$FName = trim($_POST['FName']);
$LName = trim($_POST['LName']);
$PName = trim($_POST['PName']);
$MName = trim($_POST['MName']);
$BirthYear = $_POST['BirthYear'];




$con = openDemeterDB();	
$sql = "CALL Find_Voter_Data_Strict('$FName','$LName','$PName', '$MName', $BirthYear)";
$result = mysqli_query($con, $sql);	
$data = mysqli_fetch_array($result);


$num_rows = mysqli_num_rows($result);


if($num_rows==0){
	$data['Error'] = 100;
	$data['ErrorDescr'] = 'Not Found';
	die(json_encode($data));
}


$data['NumRows'] = $num_rows;
$data['Error'] = $errcode;
$data['ErrorDescr'] = $errdescr;
echo json_encode($data);




?>