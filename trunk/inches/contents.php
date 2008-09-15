<h1>Table of contents:</h1>
<h3>posted by <a href="<?php echo HTTP_SERVER ?>about-me.html"><?php echo AUTHOR; ?></a></h3>
<p class="desc">The following list is the table of contents of all posts
on this site sorted by categories.</p>
<?php
$cats = getCats();
foreach($cats as $row){
	echo '<h2>category <a href="'.HTTP_SERVER.'category/'.$row['cat_name'].'/" title="'.$row['cat_name'].'" rel="category">'.$row['cat_name'].'</a></h2><br />';
	$posts = getPostsByCat($row['cat_id']);
	echo '<ul>';
	foreach($posts as $post){
		echo '<li class="dot"><a href="'.HTTP_SERVER.$post['post_link'].'.html" title="'.$post['post_h1'].'">'.$post['post_h1'].'</a></li>';
	}
	echo '</ul>';
	echo '<p><!-- --></p>';
}
?>

<h2>available tags cloud on the site:</h2>
You can check the tag cloud on the right side panel of the page.

<div class="postfoot">
<p><a href="http://delicious.com/post"
	onclick="window.open('http://delicious.com/post?v=5&amp;noui&amp;jump=close&amp;url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title), 'delicious','toolbar=no,width=550,height=550'); return false;">
Bookmark this on Delicious</a></p>
</div>
