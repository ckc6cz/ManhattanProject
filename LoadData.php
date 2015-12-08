<?php
	//NOV13 through June 12
/*
	$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
	
	#############################
	#######  Read in the CSV and load it into the stocks table
	#############################
	$file = fopen("CSVList.txt","r+");
	while($curLine = fgetss($file ,512)):   ###list of csvs
		$csv = fopen("CSV/".rtrim($curLine),"r+");
		$first = True;
		
		$stockName = explode(".",$curLine)[0];
		//echo $stockName;
		while($csvLine = fgetss($csv,512)):  ###actual csv parsing
			if(!$first):
				$split = explode(",",$csvLine);
				$date = $split[0];
				#####################
				##### Format the date
				#####################
				$date = date_parse($date);
				
				//YYYY-MM-DD
				if($date['month'] < 10):
					$date['month'] = "0".$date['month'];

				endif;
				if($date['day'] < 10):
					$date['day'] = "0".$date['day'];
				endif;
				$date = $date['year']."-".$date['month']."-".$date['day'];
				
				//echo $date;
				



				$open = $split[1];
				$high = $split[2];
				$low = $split[3];
				$close = $split[4];
				$volume = $split[5];

				#####################
				#####Add to the Database
				#####################
				$insertData = "insert into stock values('$stockName','$date',$open,$close);";
				$db->query($insertData);
				
			endif;
			$first = False;
		endwhile;
		fclose($csv);
	endwhile; 
*/





	


?>