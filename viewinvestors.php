<?php
session_start();

$m_id = $_SESSION["manager_id"];
$m_name = $_SESSION["Full_name"];
echo "<head> Welcome, $m_name! </head><br></br>";

echo "<table><th>Investor ID</th><th>Investor Name</th><th>Portfolio Name</th><th>Portfolio Value</th><th>View Portfolio</th>";
$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');

//$getInfo = "select * from Investor, Portfolio, Users where Investor.manager_id = $m_id AND Portfolio.customer_ID = Investor.customer_id AND Users.email = Investor.email group by Portfolio.customer_id;";
$getInfo = "select * FROM Users natural join Investor natural join Portfolio where manager_id = $m_id;";

$result = $db->query($getInfo) or die ("Invalid: " . $db->error);
while($row = $result->fetch_assoc()):
	echo "<tr>";
	echo "<td>".$row["customer_id"]."</td><td>".$row["Full_name"]."</td>";
	echo "<td>".$row["portfolio_name"]."</td><td>".$row["net_worth"]."</td>";
	echo '<td><input type="button" value="View" name="'.$row["portfolio_name"].'" onclick="ViewPortfolio(this)"></td>';
	echo "</tr>";
endwhile;
echo "</table>";


?>