<?php
	$name = $_POST["name"];
	$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
	$getStockInfo = "select date, close from stock where name = '$name'";
	$result = $db->query($getStockInfo);
	$i = 0;
	echo "[['day','price'],";
	$first = True;
	while($row = $result->fetch_assoc()):
		if(!$first) echo ",";
		echo "[";
		echo "'$i',"."'".$row["close"]."'";
		echo "]";
		$first = False;
	$i++;
	endwhile;
	echo "]";

?>