<style>
	#tags span{
		padding:0 1px;
	}
	.tag1{
		font-size:0.75em;
	}
	.tag2{
		font-size:0.95em;
	}
	.tag3{
		font-size:1.15em;
	}
	.tag4{
		font-size:1.25em;
	}
</style>
<?php
require("misc.php");
connectDB();
?>
	<div id="tags">
		<?php
        formTagCloud();
        ?>
	</div>
    <ul>
    <?php
		$catsforpost = getCatsForPost(1);
		while($row = mysql_fetch_assoc($catsforpost)){
			echo('<li>'.$row['cat_name'].'</li>');
		}
	?>
	</ul>