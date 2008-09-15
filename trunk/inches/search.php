<h1>Search for <a href=""><?php echo $search->query; ?></a></h1>
<?php
    if($search->result){
	foreach($search->result as $row){
	    echo 
		'<h2>
			<a href="'.HTTP_SERVER.$row['post_link'].'.html">'.html_entity_decode($row['post_h1']).'</a>
		</h2>
		<p class="desc">
			'.html_entity_decode($row['post_h2']).'
		</p>';
        }
    }
?>
