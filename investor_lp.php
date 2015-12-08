<?php
session_start();

if (!isset($_SESSION["logged_in"])) {
	header("Location:logout.php");
}
	
?>

<html>
<head>
	<title>Investor Launchpad</title>
	<link rel="stylesheet" type="text/css" href="dbstyles.css">
	<link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<script src="http://code.jquery.com/jquery-latest.js"></script>
 <script type="text/javascript"
          src="https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }"></script>

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


function actuallyBuy(name,button){
	//alert(name);
	//alert(button.name);
	var quant = prompt("Number of Shares you Would Like to Add?");

	$.post("buy.php",{ name:name,quant:quant,port:button.name},function(data){
		//data is what is returned...pretty straightforward example
		deleteOldInfo();
		$("#theInfo").append(data);
		//alert(data);
	});
}



function buyStocks(name){
	$("#theInfo").empty();
	
	
	//alert(data);
	$.post("buy_portfolio_option.php",{ name:name.name},function(data){
		//data is what is returned...pretty straightforward example
		deleteOldInfo();
		//$("#theInfo").append(data);
		//alert(data);
		$("#theInfo").append(data);
	});

}

function ViewStocks(){
	///Can add something here to send POST data...but
	///not necessary for this table
	$.post("viewstocks.php",function(data){
		deleteOldInfo();
		$("#theInfo").append(data);
	});
}

function ViewAllPortfolios(){
	$.post("viewallportfolios.php", function(data){
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

function CreatePortfolio(button){
	var newName = prompt("Name of New Portfolio:");
	$.post("newPortfolio.php", {portName:newName}, function(data){
		deleteOldInfo();
		alert(data);

	});

	ViewAllPortfolios();
}

function sellStocks(name, quantity, port, price){
	alert ("You're going to sell " + quantity + " shares of " + name.name + " from " + port + " for $" + price);

	$.post("sell.php",{ name:name.name, quantity:quantity, port:port, price:price},function(data){
		deleteOldInfo();
		$("#theInfo").append(data);
	});

}

function ViewAllTransactions(){
	$.post("viewTransactions.php", function(data){
		deleteOldInfo();
		$("#theInfo").append(data);

	});

}

function sellFunds(name, quantity, port, price){
	alert ("You're going to sell " + quantity + " shares of " + name.name + " from " + port + " for $" + price);

	$.post("sellFund.php",{ name:name.name, quantity:quantity, port:port, price:price},function(data){
		deleteOldInfo();
		$("#theInfo").append(data);
	});
}

function showFundInfo(fundName) {
	$.post("showFundInfo.php", {fundName:fundName.name}, function(data){
	alert(data);
	});
}

function ViewFunds() {
	$.post("viewfundsinv.php",function(data){
		deleteOldInfo();
		$("#theInfo").append(data);
	});
}

function buyFunds(name) {
	$("#theInfo").empty();
	
	$.post("buyFund_portfolio_option.php",{ name:name.name},function(data){
		deleteOldInfo();
		$("#theInfo").append(data);
	});
}

function actuallyBuyFund(name, button) {
	var quant = prompt("Number of Shares you Would Like to Purchase?");

	$.post("buy_fund_for_inv.php",{ name:name,quant:quant,port:button.name},function(data){
		deleteOldInfo();
		$("#theInfo").append(data);
	});
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
	<div class="intro">
		<h1>Investor Launchpad</h1>
	</div>
	
	<ul>
		
	<li><input type="button" value= "View Stocks" onclick="ViewStocks()"></li>
	<li><input type="button" value= "View Portfolios" onclick="ViewAllPortfolios()"></li>
	<li><input type="button" value= "View Transaction History" onclick="ViewAllTransactions()"></li>
	<li><input type="button" value= "View Funds" onclick="ViewFunds()"></li>
	<li><form action = "logout.php">
	<input type = "submit" value="Logout">
	</form></li>

	</ul>	
	
	

	


<div id="theInfo" class="box">
	<!-- This is where either the table or the graph will go-->
</div>

</body>
</html>