<?php
$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
$fundName = $_POST["fundName"];

$getStocks = "select distinct symbol from Fund_Shares where fund_name = '$fundName';";
$result = $db->query($getStocks);
$ret = "";
while ($row = $result->fetch_assoc()):
	$coSymbol = $row["symbol"];
	$getCoName = "select Company from Company_info where name = '$coSymbol';";
	$coNameObj = $db->query($getCoName);
	$coNameAry = $coNameObj->fetch_assoc();
	$coName = $coNameAry["Company"];
	$ret = $ret . $coName. "; ";
endwhile;	
print_r($ret);
?>