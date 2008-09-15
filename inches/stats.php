<?php
	// Set the date and the table we will use for statistics retrieval
	$now = date("Y/m/d");
	$dbsql = "stats";
	// Populate our Total Distinct Hits variable $total
	$sql = "SELECT DISTINCT(ip) FROM $dbsql ORDER BY ip";
	$results  =  mysql_query($sql);
	$total  =  mysql_num_rows($results);
	while($myrow  =  mysql_fetch_array($results)) {
		$ip  =  $myrow["ip"];
	}
	// Send header information for time span of statistics gathering
	echo  "<table><tr><td colspan=\"3\"align=\"center\">Statistics from:<br /> " ;
	// Retrieve the beginning date value from the database
	$sql =  "SELECT received FROM $dbsql ORDER BY id LIMIT 1" ;
	$results  =  mysql_query($sql);
	while($myrow  =  mysql_fetch_array($results)) {
		$date  = $myrow["received"];
		echo  $date ;
	}
	echo  " until $now </td></tr><tr><td colspan=\"3\"><hr /></td></tr>" ;
	// Analyze data from the database
	$sql  =  "SELECT DISTINCT(ip) FROM $dbsql WHERE ip NOT LIKE 
			('129.93.%') AND ip 
			 NOT LIKE('199.240.%')" ;
	 $results  =  mysql_query($sql);
	 $offsite  =  mysql_num_rows($results);
	 $onsite  =($total  -  $offsite);
	 $sql  =  "SELECT DISTINCT(ip) FROM $dbsql WHERE browser LIKE('%MSIE%')" ;
	 $results  =  mysql_query($sql);
	 $ms  =  mysql_num_rows($results);
	 $netscape  =($total  -  $ms);
	 $sql  =  "SELECT DISTINCT(ip) FROM $dbsql WHERE browser LIKE('%WIN%')" ;
	 $results  =  mysql_query($sql);
	 $windows  =  mysql_num_rows($results);
	 $mac  =($total  -  $windows);
	 // Display Data
	 echo  "<tr><td align=\"center\">" ;
	 echo  "Onsite Hits: <br /><b>$onsite</b></td><td align=\"center\">";
	 echo  "Windows Hits: <br /><b>$windows</b></td><td align=\"center\">" ;
	 echo  "MS Explorer Hits: <br /><b>$ms</b></td></tr>";
	 echo  "<tr><td align=\"center\">" ;
	 echo  "Offsite Hits: <br /><b>$offsite</b></td><td align=\"center\">" ;
	 echo  "Other Hits: <br /><b>$mac</b></td><td align=\"center\">" ;
	 echo  "Other Hits: <b><br />$netscape</b></td></td></tr>" ;
	 // Create Percentage Data from our values 
	 $macval  =($windows /($mac + $windows));
	 $winval  =($mac /($mac + $windows));
	 $offsiteval  =($onsite /($onsite + $offsite));
	 $onsiteval  =($offsite /($onsite + $offsite));
	 $msval  =($netscape /($netscape +$ms));
	 $nsval  =($ms /($netscape + $ms));
	 // Create a function to call our graphics generation page gd.php
	 function  graphic($blueval , $redval){ 
	 	$pctrd  =  round($blueval*100,1);
		$pctbl  =  round($redval*100,1);
		$blueval  =($blueval * 200);
		$redval  =($redval * 200); 
		echo  " 
			<table><tr><td align=\"center\">$pctbl%</td><td> 
			<img src=\"".INCLUDES."gd.php?bluehg=".$blueval."&amp;redhg=".$redval."\"height=\"100\"alt=\"Statistics\"title=\"Statistics\"/> 
			</td><td align=\"center\">$pctrd%</td></tr></table>" ;
	}
	// Create our layout for graphic display and repeatedly call the graphic() function
	echo  " 
		<tr><td colspan=\"3\"align=\"center\"> 
		<table cellpadding=\"5\"border=\"1\"bgcolor=\"#cccccc\"> 
		<tr><td align=\"center\"valign=\"bottom\">" ;
	graphic($onsiteval , $offsiteval);
	echo  "</td><td align=\"center\"valign=\"bottom\">" ;
	graphic($winval ,$macval);
	echo  "</td><td align=\"center\"valign=\"bottom\">";
	graphic($msval , $nsval);
	echo  "</td></tr><tr><td align=\"center\">"; 
	echo  "Onsite v/s Offsite" ;
	echo  "</td><td align=\"center\">" ;
	echo  "Windows v/s Other" ;
	echo  "</td><td align=\"center\"align=\"center\">" ;
	echo  "Explorer v/s Other" ;
	echo  "</td></tr></table><tr>" ;
	echo  "<td align=\"center\"colspan=\"3\">" ;
	echo  "&nbsp;</td></tr><tr><td>Total Distinct Hits: <b>" ;
	echo  "$total</b></td>" ;
	echo  "<td align=\"center\"></td><td align=\"left\">" ;
	// Analyze and calculate time elapsed data(i.e. Daily hits, hourly hits)
	$sql = "SELECT TO_DAYS(MAX(received)) - TO_DAYS(MIN(received)) AS record FROM $dbsql";
	$results  =  mysql_query($sql);
	while($myrow = mysql_fetch_assoc($results)) {
		$avgday = $myrow["record"];
	}
	// divide the total number of distinct hits by the difference in time
	$avghits  =($total / $avgday);
	// Analyze and calculate time elapsed data(i.e. Daily hits, hourly hits) 
	echo  "Avg. Daily Hits:" ;
	// implement round() function to accommodate avg. number of hits 
	$avghits  = round($avghits);
	echo  "<b>$avghits</b><br /><br />" ;
	echo  "Avg. Hourly Hits:<b>" ; 
	// implement round() function to accommodate avg. number of hits
	echo round($avghits / 24). "</b><br /></td>" ;
	echo  "<tr><td colspan=\"3\">" ;
	// Select Total number of hits(not just distinct hits) 
	$sql =  "SELECT COUNT(*) AS CNT FROM $dbsql" ;
	$results  =  mysql_query($sql);
	while($myrow  =  mysql_fetch_array($results)) {
		$bigtotal  =  $myrow["CNT"];
		// Repeat analysis for Total Overall Hits
		echo  "<tr><td>Total Overall Hits: <b>" ;
		echo  "$bigtotal</b></td>" ;
		echo  "<td width=\"45\"align=\"right\"></td><td align=\"left\">" ;
		$avghits  =($bigtotal /$avgday);
		echo  "Avg. Daily Hits:" ;
		// implement round() function to accommodate avg. number of hits 
		$avghits  =  round($avghits);
		echo  "<b>$avghits</b><br /><br />" ;
		echo  "Avg. Hourly Hits:<b>" ;
		// implement round() function to accommodate avg. number of hits
		echo  round($avghits / 24). "</b><br /></td></tr></table>" ;
	}
?>