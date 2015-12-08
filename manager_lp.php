<?php
	session_start();
	if (!isset($_SESSION["logged_in"])) {
		header("Location:logout.php");
	}

	$m_id = $_SESSION["manager_id"];
	$m_name = $_SESSION["Full_name"];
?>

<html>
<head align = "center">
	<title>Manager Launchpad</title>
	<h3 align = "center"> <?php echo "Welcome, $m_name!"; ?> </h3>
	<link rel="stylesheet" type="text/css" href="dbstyles.css">
	<link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<script src="http://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">
//for later--might not need it
function deleteOldInfo(){
	$("#theInfo").empty();
}

function stockPerformanceGraphing(button){
	
		//data is what is returned...pretty straightforward example
		//$("#theInfo").append(data);
		deleteOldInfo();
		//alert(button.name);
		//$("#theInfo").append('It works!');
		//var arr = new Array(data);
		$("#theInfo").append('<iframe frameborder="0" scrolling="no" width="1000" height="653" src="graphs.php?name='+button.name+'" />');

	
}
function ViewStocks(){
	$.post("viewstocks.php",function(data){
		deleteOldInfo();
		$("#theInfo").append(data);

	});
}

function ViewInvestors(){
	$.post("viewinvestors.php",function(data){
		deleteOldInfo();
		$("#theInfo").append(data);
	});
}

function ViewPortfolio(port){
	$.post("viewportfolio.php", {portName:port.name}, function(data){
		deleteOldInfo();
		$("#theInfo").append(data);
	});
}

function ViewAllFunds() {
	$.post("viewallfunds.php", function(data){
		deleteOldInfo();
		$("#theInfo").append(data);
	});
}

function ViewFund(name) {
	$.post("viewfund.php", {name:name.name}, function(data){
		deleteOldInfo();
		$("#theInfo").append(data);
	});
}

function sellFundShares(name, quantity, fund, price){
	alert ("You're going to sell " + quantity + " shares of " + name.name + " from " + fund + " for $" + price);

	$.post("sellFundShares.php",{ name:name.name, quantity:quantity, fund:fund, price:price},function(data){
		deleteOldInfo();
		$("#theInfo").append(data);
	});

}
function actuallyBuy(name,button){
	//alert(name);
	//alert(button.name);
	var quant = prompt("Number of Shares you Would Like to Add?");

	$.post("buy_for_fund.php",{ name:name,quant:quant,port:button.name},function(data){
		//data is what is returned...pretty straightforward example
		deleteOldInfo();
		$("#theInfo").append(data);
		//alert(data);
	});
}



function buyStocks(name){
	$("#theInfo").empty();
	
	
	//alert(data);
	$.post("buy_fund_option.php",{ name:name.name},function(data){
		//data is what is returned...pretty straightforward example
		deleteOldInfo();
		//$("#theInfo").append(data);
		//alert(data);
		$("#theInfo").append(data);
	});

}

function CreateFund(){

	var newName = prompt("Name of the New Fund: ");
	$.post("NewFund.php",{ name:newName},function(data){
		//data is what is returned...pretty straightforward example
		deleteOldInfo();
		//$("#theInfo").append(data);
		//alert(data);
		alert(data);
	});
	ViewAllFunds(); 
}

function showBizInfo(name) {
	$.post("showBizInfo.php",{name:name.name},function(data){
		deleteOldInfo();
		$("#theInfo").append(data);
	});	
}

</script>
</head>
<body>
	<ul>
	<li><input type="button" value= "View Stocks" onclick="ViewStocks()"></li>
	<li><input type="button" value= "View Your Investors" onclick= "ViewInvestors()"></li>
	<li><input type="button" value= "View Funds" onclick= "ViewAllFunds()"></li>
	<li><form action = "logout.php">
	<input type = "submit" value="Logout">
	</form></li>
	</ul>
	
<div id="theInfo" class="box">
	<!-- This is where either the table or the graph will go-->
</div>
</body>
</html>