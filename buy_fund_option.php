<?php








session_start();
$email = $_SESSION['email'];
$stock_name = $_POST["name"];

echo "<center><h1>Choose Which Fund to Buy For!</h1></center><table><th>Fund Name</th><th>Choose</th>";
$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
$getStockTable = "select * from Fund where manager_id = ".$_SESSION['manager_id'].";";
$result = $db->query($getStockTable);
while($row = $result->fetch_assoc()):
	echo "<tr>";
	echo "<td>".$row["name"]."</td>";
	echo '<td><input type="button" value="This One!" name="'.$row["name"].'" onclick="actuallyBuy(\''.$stock_name.'\',this)"></td>';
	echo "</tr>";
endwhile;

echo "</table>";


?>