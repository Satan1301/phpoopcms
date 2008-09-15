<?php
	$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
	<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
		<url>
			<loc>http://swapnilsarwe.phpnet.us/</loc>
			<lastmod>2008-08-04</lastmod>
			<changefreq>monthly</changefreq>
			<priority>0.8</priority>
		</url>
		<url>
			<loc>http://swapnilsarwe.phpnet.us/contents/</loc>
			<lastmod>2008-08-28</lastmod>
			<changefreq>monthly</changefreq>
		</url>
		<url>
			<loc>http://swapnilsarwe.phpnet.us/archive/</loc>
			<lastmod>2008-08-28</lastmod>
			<changefreq>monthly</changefreq>
		</url>';
	$rss = '<?xml version="1.0" encoding="ISO-8859-1" ?>
	<rss version="2.0">
	<channel>
	  <title>Swapnil Sarwe - Home Page</title>
	  <link>http://swapnilsarwe.phpnet.us/</link>
	  <description>Swapnil Sarwe - Personal Website aKa Blog</description>';
	$sitemap_content = getPostsForSite();
	while($row = mysql_fetch_assoc($sitemap_content)){
		$sitemap .= '
		<url>
			<loc>http://swapnilsarwe.phpnet.us/'.$row['post_link'].'.html</loc>
			<lastmod>'.$row['post_mod'].'</lastmod>
			<changefreq>monthly</changefreq>
		</url>';
	}
	$cats_sitemap = getCatsForSite();
	while($row = mysql_fetch_assoc($cats_sitemap)){
		$sitemap .= '
		<url>
			<loc>http://swapnilsarwe.phpnet.us/category/'.$row['cat_name'].'/</loc>
			<lastmod>'.$row['cat_mod'].'</lastmod>
			<changefreq>monthly</changefreq>
		</url>';
	}
	$tags_sitemap = getTagsForSite();
	while($row = mysql_fetch_assoc($tags_sitemap)){
		$sitemap .= '
		<url>
			<loc>http://swapnilsarwe.phpnet.us/tag/'.$row['tag_name'].'/</loc>
			<lastmod>'.$row['tag_mod'].'</lastmod>
			<changefreq>monthly</changefreq>
		</url>';
	}
	$sitemap .= '</urlset>';
	$rss_content = getPostsForRSS();
	while($row1 = mysql_fetch_assoc($rss_content)){
		$rss .= '<item>
					<title>'.$row1['post_h1'].'</title>
					<author>swapnilsarwe@gmail.com (Swapnil Sarwe)</author>
					<link>http://swapnilsarwe.phpnet.us/'.$row1['post_link'].'.html</link>
					<description><![CDATA['.strip_tags(html_entity_decode($row1['post_h2']).html_entity_decode($row1['post_ps']),'<p><strong><blockquote><span><a><i><ul><li><img><br>').']]></description>
					<guid>http://swapnilsarwe.phpnet.us/'.$row1['post_link'].'.html</guid>
				  </item>
				  ';
	}
	$rss .= '</channel>
	</rss>';
	file_put_contents ('../sitemap.xml', $sitemap);
	file_put_contents ('../feed.rss', $rss);
?>