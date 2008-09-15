<?php
	$ip = $_SERVER['REMOTE_ADDR'];
	if($ip != '122.169.86.163'){
		$url = mysql_real_escape_string($_SERVER['REQUEST_URI']);
		$referrer = mysql_real_escape_string($_SERVER['HTTP_REFERER']);
		$browser = mysql_real_escape_string($_SERVER['HTTP_USER_AGENT']);
		$sql = "INSERT INTO 
					stats(url, referrer, ip, browser, received) 
				VALUES
					('".$url."','".$referrer."','".$ip."','".$browser."','".date("Y-m-d H:i:s")."')" ;
		$results = mysql_query($sql);
	}
?> 