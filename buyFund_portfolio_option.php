<?php

session_start();
$email = $_SESSION['email'];
$fund_name = $_POST["name"];

echo "<center><h1>Choose Which Portfolio to Buy For!</h1></center><table><th>Portfolio Name</th><th>Choose</th>";
$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
$getFundTable = "select portfolio_name, net_worth from Investor natural join Portfolio where email = '$email'";
$result = $db->query($getFundTable);
while($row = $result->fetch_assoc()):
	echo "<tr>";
	echo "<td>".$row["portfolio_name"]."</td>";
	echo '<td><input type="button" value="This One!" name="'.$row["portfolio_name"].'" onclick="actuallyBuyFund(\''.$fund_name.'\',this)"></td>';
	echo "</tr>";
endwhile;

echo "</table>";
?>