<?php
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$starttime = $mtime;
	$query_sel = 0;
	$sel_true = 0;
	$sel_false = 0;
	ob_start("ob_gzhandler");
	require_once("inches/configure.php"); 
	require_once(FUNCTIONS."miscDB.php");
	require_once(FUNCTIONS."misc.php");
	require_once(CLASSES.'database.php');
	$db = new Database();
	$db->connect();
	require_once(INCLUDES."collect.php");
	require_once(INCLUDES."variables.php");
	require_once(INCLUDES."submit.php");
?>
<?php
	if(isset($_GET['category'])){
		require_once(CLASSES.'category.php');
		require_once(CLASSES.'post.php');
		$category = new Category($_GET['category'], $_GET['page']);
		$title = $_GET['category'] . ' < Category | ';
	}elseif(isset($_GET['tag'])){
		require_once(CLASSES.'tag.php');
		require_once(CLASSES.'post.php');
		$tag = new Tag($_GET['tag'], $_GET['page']);
		$title = $_GET['tag'] . ' < Tag | ';
	}elseif(isset($_GET['post'])){
		require_once(CLASSES.'post.php');
		$post = new Post($_GET['post']);
		$title = $post->post_h1 . ' < Post | ';
	}elseif(isset($_GET['contents'])){
		$title = 'Archive < Table of contents | ';
	}elseif(isset($_GET['sitemap'])){
		$title = 'Sitemap | ';
	}elseif(isset($_GET['archive'])){
		$title = 'Archive | ';
	}elseif(isset($_GET['feedback'])){
		$title = 'Feedback | ';
	}elseif(isset($_GET['pageid'])){
		if($_GET['pageid'] == 10){
			header('Location: '.HTTP_SERVER.'memorable-day-at-pali.html');
			exit;
		}
		$title = 'Archive | ';
	}elseif(isset($_GET['query'])){
		require_once(CLASSES.'search.php');
		$search = new Search($_GET['query']);
		$title = $_GET['query'] . ' < Search | ';
	}else{
		require_once(CLASSES.'posts.php');
		require_once(CLASSES.'post.php');
		$posts = new Posts($_GET['page']);
		$title = '';
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title . WEBSITE_TITLE; ?></title>
<meta name="verify-v1" content="KlSUQDVnMzXQ1UZyxpTl+k1WeDIqIRqRpB2QyOHBRKA=" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php if(isset($_GET['post'])){ echo formTagMeta($post->tags); }else{echo META_KEYWORD;} ?>" />
<meta name="description" content="<?php if(isset($_GET['post'])){ echo htmlentities(stripslashes_if_gpc_magic_quotes($post->post_h2)); }else{ echo htmlentities(stripslashes_if_gpc_magic_quotes(META_DESC)); } ?>" />
<link rel="alternate" type="application/rss+xml" title="Swapnil Sarwe - RSS" href="<?php echo HTTP_SERVER; ?>feed.rss" />
<link rel="alternate" type="application/rss+xml" title="Swapnil Sarwe - Feedburner" href="http://feeds.feedburner.com/swapnilsarwefeed" />
<link href="<?php echo HTTP_SERVER; ?>css/style.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo HTTP_SERVER; ?>scripts/javascript.js"></script>
</head>
<body>
<div id="container">
  <div id="header">
    <div class="title"><a href="<?php echo HTTP_SERVER; ?>"><?php echo WEBSITE_TITLE; ?></a></div>
  </div>
  <div id="navbar">
    <ul>
      <li> <a href="<?php echo HTTP_SERVER ?>about-me.html">About Me</a> </li>
      <li> <a href="<?php echo HTTP_SERVER ?>about-site.html">About Site</a> </li>
      <li> <a href="mailto:swapnilsarwe@gmail.com">Contact Me</a> </li>
      <li> <a href="<?php echo HTTP_SERVER ?>contents/">Category Archives</a></li>
      <li><a href="<?php echo HTTP_SERVER ?>archive/">Month Archives</a> </li>
      <li><a href="<?php echo HTTP_SERVER ?>feedback/">Feedback</a> </li>
    </ul>
  </div>
  <div id="wrapper">
    <div id="maincontent">
      <?php
                if(isset($_GET['category'])){
                    require_once(INCLUDES.'category.php');
                }elseif(isset($_GET['tag'])){
                    require_once(INCLUDES.'tag.php');
                }elseif(isset($_GET['post'])){
                    require_once(INCLUDES.'post.php');
                }elseif(isset($_GET['contents'])){
                    require_once(INCLUDES.'contents.php');
                }elseif(isset($_GET['sitemap'])){
                    require_once(INCLUDES.'sitemap.php');
                }elseif(isset($_GET['feedback'])){
                    require_once(INCLUDES.'feedback.php');
                }elseif(isset($_GET['archive'])){
                    require_once(INCLUDES.'archive.php');
                }elseif(isset($_GET['query'])){
			require_once(INCLUDES.'search.php');
		}else{
                    require_once(INCLUDES.'posts.php');
                }
            ?>
    </div>
    <div id="navcol">
      <div class="box">
        <h2>About Me</h2>
        <p> <img class="myimage" src="<?php echo HTTP_SERVER ?>images/swapnil.jpg" title="Swapnil Sarwe" alt="Swapnil Sarwe" /><span class="aboutme"><?php echo ABOUT_ME; ?> </span></p>
      </div>
      <div class="box">
        <h2>About Site</h2>
        <p><?php echo ABOUT_SITE; ?></p>
      </div>
      <div class="box">
        <h2>Archives:</h2>
        <div class="full">
          <ul>
            <li> <a href="<?php echo HTTP_SERVER ?>contents/">Archives [By Category]</a> </li>
            <li> <a href="<?php echo HTTP_SERVER ?>archive/">Archives [By Month n Year]</a> </li>
          </ul>
        </div>
      </div>
      <div class="box">
        <h2>Search:</h2>
        <div class="full">
          <form name="search_form" action="search" method="get">
		<input type="text" name="query" id="query" />
	</form>
        </div>
      </div>
      <div class="box">
        <h2>Categories</h2>
        <?php
                           $cats = getCats();
                           $shiftFlag = true;
                            foreach($cats as $row){
                                if($shiftFlag){
                                        $strLI1 .= '<li><a href="'.HTTP_SERVER.'category/'.$row['cat_name'].'/" title="'.$row['cat_name'].'" rel="category">'.$row['cat_name'].'</a></li>';
                                        $shiftFlag = false;
                                }else{
                                        $strLI2 .= '<li><a href="'.HTTP_SERVER.'category/'.$row['cat_name'].'/" title="'.$row['cat_name'].'" rel="category">'.$row['cat_name'].'</a></li>';
                                        $shiftFlag = true;
                                }
                            }
                ?>
        <div class="left">
          <ul>
            <?php echo $strLI1; ?>
          </ul>
        </div>
        <div class="left">
          <ul>
            <?php echo $strLI2; ?>
          </ul>
        </div>
      </div>
      <div class="box">
        <h2>Tag Cloud</h2>
        <div class="full">
          <?php
                        formTagCloud();
                    ?>
        </div>
      </div>
      <div class="box">
        <h2>Recent posts:</h2>
        <div class="full">
          <ul>
            <?php
                            $posts = getLatestPosts();
                            foreach($posts as $row){
                                echo('<li><a href="'.HTTP_SERVER.$row['post_link'].'.html" title="'.$row['post_h1'].'">'.$row['post_h1'].'</a></li>');
                            }
                        ?>
          </ul>
        </div>
      </div>
      <div class="box">
        <h2>Recent comments:</h2>
        <div class="full">
          <ul>
            <?php
                            $comments = getLatestComments();
                            foreach($comments as $row){
                                echo('<li><a href="'.HTTP_SERVER.$row['post_link'].'.html#'.$row['comment_id'].'" title="'.$row['post_h1'].'">'.stripString($row['comment'], 38).'</a></li>');
                            }
                        ?>
          </ul>
        </div>
      </div>
      <div class="box">
        <h2>Flickr Photos: </h2>
        <div id="flickr_badge_uber_wrapper"> <a href="http://www.flickr.com/photos/swapnilsarwe/" id="flickr_www"> www.<strong>flickr</strong>.com/photos/swapnilsarwe/ </a>
          <div id="flickr_badge_wrapper">
            <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=9&amp;display=random&amp;size=s&amp;layout=x&amp;source=user&amp;user=85538283%40N00"></script>
          </div>
        </div>
      </div>
      <div class="box">
        <?php //require_once(INCLUDES."stats.php"); ?>
      </div>
      <!--<div class="box">
                <h2>My Delicious Bookmarks:
                </h2>-->
      <!--<script type="text/javascript" src="http://feeds.delicious.com/v2/js/swapnilsarwe?count=9&sort=date"></script>-->
      <!--</div>-->
    </div>
  </div>
  <div id="footer"> <a href="http://swapnilsarwe.phpnet.us/" title="Swapnil Sarwe">swapnilsarwe.phpnet.us</a> is designed and maintained by <a href="mailto:swapnilsarwe@gmail.com">Swapnil Sarwe</a> </div>
</div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-4409261-1");
pageTracker._initData();
pageTracker._trackPageview();
</script>
<?php
	$mtime = microtime();
	$mtime = explode(" ",$mtime);
	$mtime = $mtime[1] + $mtime[0];
	$endtime = $mtime;
	$totaltime = ($endtime - $starttime);
	echo "<!-- This page was created in ".$totaltime." seconds.-->";
	echo "<!-- ".$sel_true." of ".$query_sel." select executed succesfully. ".$sel_false." failed. -->";
?>
</body>
</html>
