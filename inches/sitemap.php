<h1>Sitemap:</h1>
<h3>posted by <a href="<?php echo HTTP_SERVER ?>about-me.html"><?php echo AUTHOR; ?></a></h3>
<p class="desc">The following is the replication of the sitemap.xml on
the webpage.</p>

<ul>
<?php
// The file test.xml contains an XML document with a root element
// and at least an element /[root]/title.

$handle = fopen("sitemap.xml", "rb");
if($handle){
	$contents = stream_get_contents($handle);
	if ($contents != '') {
		$xml = simplexml_load_string($contents);
		foreach ($xml->children() as $second_gen) {
			echo '<li class="dot"><a href="'.$second_gen->loc.'">'.$second_gen->loc.'</a><br /> last modified on '.$second_gen->lastmod.'</li><li></li>';
		}

	} else {
		exit('Failed to open test.xml.');
	}
	fclose($handle);
}else{
	echo 'Cant get content';
}
?>
</ul>

<div class="postfoot">
<p><a href="http://delicious.com/post"
	onclick="window.open('http://delicious.com/post?v=5&amp;noui&amp;jump=close&amp;url='+encodeURIComponent(location.href)+'&amp;title='+encodeURIComponent(document.title), 'delicious','toolbar=no,width=550,height=550'); return false;">
Bookmark this on Delicious</a></p>
</div>
