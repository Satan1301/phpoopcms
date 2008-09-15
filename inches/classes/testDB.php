<?php
	require_once("database.php");
	$db = new Database();
	$db->connect();
	echo('<pre>');
	print_r($db->query("SELECT * FROM test WHERE test_id=41"));
	echo('</pre>');
?>