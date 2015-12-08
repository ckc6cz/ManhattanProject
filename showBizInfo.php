<?php
$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
$fundName = $_POST["name"];

$getBizInfo = "select * from Company_info where name = '".$_POST["name"]."';";
$bizObj = $db->query($getBizInfo);
$bizInfo = $bizObj->fetch_assoc();
echo "<table><th>Company</th><th>Symbol</th><th>CEO</th><th>Year Founded</th><th>Revenue (in millions)</th><th>Wiki URL</th>";
echo "<tr>";
echo "<td>".$bizInfo["Company"]."</td><td>".$bizInfo["name"]."</td><td>".$bizInfo["CEO"]."</td><td>".$bizInfo["Founded"]."</td><td>$".$bizInfo["revenue"]."</td><td>".$bizInfo["wiki"];
echo "</tr>";
echo "</table>";
?>