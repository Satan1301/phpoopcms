<h1>Archive:</h1>
<h3>posted by <a href="#"><?php echo AUTHOR; ?></a></h3>
<p class="desc">The following list is the archive of all posts on this site sorted by year, month.</p>
<?php 
	$posts = getPostsForArchive();
	foreach($posts as $post){
		list($date1, $time1) = split('[ ]', $post['post_created']);
		list($year, $month, $day) = split('[-]', $date1);
		if(gettype($lastmonth) == 'NULL'){
			$lastmonth = $month;
			echo '<h2>'.format_date($post['post_created'], "F Y").'</h2><br />';
			echo '<ul>';
		}
		if($month == $lastmonth){
		}else{
			echo '</ul>';
			echo '<p><!-- --></p>';
			echo '<h2>'.format_date($post['post_created'], "F Y").'</h2><br />';
			echo '<ul>';
			$lastmonth = $month;
		}
			echo '<li class="dot"><a href="'.HTTP_SERVER.$post['post_link'].'.html" title="'.$post['post_h1'].'">'.$post['post_h1'].'</a></li>';		
	}
			echo '</ul>';
			echo '<p><!-- --></p>';
?>
<div class="postfoot">
    <p> <a href="http://delicious.com/post" onclick="window.open('http://delicious.com/post?v=5&amp;noui&amp;jump=close&amp;url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title), 'delicious','toolbar=no,width=550,height=550'); return false;"> Bookmark this on Delicious</a> </p>
</div>