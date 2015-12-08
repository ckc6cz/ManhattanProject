<?php 

session_start();
$dir = dirname(__FILE__);
include($dir.'/jpgraph//src/jpgraph.php');
include($dir.'/jpgraph/src/jpgraph_line.php');

class View{

	static function graphs($name, $close){

		// Setup the graph
		$graph = new Graph(1000,653,'auto');
		$graph->SetScale("textlin");
		$theme_class=new UniversalTheme;

		$graph->SetTheme($theme_class);
		$graph->img->SetAntiAliasing(false);
		$graph->title->SetFont(FF_FONT2, FS_BOLD, 20);
		$graph->title->Set("Stock Performance History for " . $name);
		$graph->SetBox(false);

		$graph->yaxis->HideZeroLabel();
		$graph->yaxis->HideLine(false);
		$graph->yaxis->HideTicks(false,false);
		$graph->yaxis->title->SetFont(FF_FONT2, FS_BOLD, 20);
		$graph->yaxis->title->Set('Close Price');

		$graph->xgrid->Show();
		$graph->xgrid->SetLineStyle("solid");
		$graph->xaxis->SetTickPositions(array(0,20,40,61,82,103,124,143));
		$graph->xaxis->SetTickLabels(array('Nov 2014','Dec 2014','Jan 2015','Feb 2015','March 2015','April 2015','May 2015','June 2015'));
		$graph->xaxis->title->SetFont(FF_FONT2, FS_BOLD, 20);
		$graph->xaxis->title->Set('Dates');
		$graph->xgrid->SetColor('#E3E3E3');

		// Create the first line
		$p1 = new LinePlot($close);
		$graph->Add($p1);
		$p1->SetColor("#6495ED");

		$graph->legend->SetFrameWeight(2);

		// Output line
		$graph->Stroke();
	}
}

function getClose($name){

	$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
	$getCloseInfo = "select close from stock where name = '$name'";
	$resultClose = $db->query($getCloseInfo);
	$close = array();
	while ($row = $resultClose->fetch_assoc()) {
		array_push($close, $row['close']);
	}
	$db->close();
	return $close;
}

$name = $_GET["name"];
$close = getClose($name);
View::graphs($name, $close);

?>

