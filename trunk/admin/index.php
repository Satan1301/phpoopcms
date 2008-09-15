<?php require_once("inches/configure.php"); ?>
<?php require_once("inches/checkpage.php"); ?>
<?php require_once(FUNCTIONS."miscDB.php"); ?>
<?php require_once(FUNCTIONS."misc.php"); ?>
<?php connectDB(); ?>
<?php require_once(INCLUDES."submit.php"); ?>
<?php
		if((isset($_GET['category']))&&($_GET['category'] == 1)){
			require_once(CLASSES.'category.php');
		//	$title = $_GET['category'] . ' < Category | ';
		}elseif(isset($_GET['tag'])){
			require_once(CLASSES.'tag.php');
			//$title = $_GET['tag'] . ' < Tag | ';
		}elseif(isset($_GET['post'])){
			require_once(CLASSES.'post.php');
			//$title = $post->post_h1 . ' < Post | ';
		}elseif(isset($_GET['siterss'])){
			//require_once(CLASSES.'siterss.php');
			//$title = $post->post_h1 . ' < Post | ';
		}elseif(isset($_GET['event'])){
			require_once(CLASSES.'event.php');
			//$title = $post->post_h1 . ' < Post | ';
		}elseif(isset($_GET['variable'])){
			require_once(CLASSES.'variable.php');
			//$title = $post->post_h1 . ' < Post | ';
		}elseif(isset($_GET['upload'])){
			require_once(CLASSES.'upload.php');
			//$title = $post->post_h1 . ' < Post | ';
		}elseif(isset($_GET['logout'])){
			session_destroy(); 
			$loginOk = false;
			$host  = $_SERVER['HTTP_HOST'];
			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			$extra = '../';
			header("Location: http://$host$uri/$extra");
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title . WEBSITE_TITLE; ?></title>
<script type="text/javascript" src="<?php echo HTTP_SERVER; ?>scripts/javascript.js">
	</script>
<link href="<?php echo HTTP_SERVER; ?>css/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="container">
  <div id="header">
    <h1><a href="<?php echo HTTP_SERVER; ?>"><?php echo WEBSITE_TITLE; ?></a> </h1>
  </div>
  <div id="navbar">
    <ul>
      <li> <a href="<?php echo HTTP_SERVER ?>index.php?post=1">Post</a> </li>
      <li> <a href="<?php echo HTTP_SERVER ?>index.php?category=1">Category</a> </li>
      <li> <a href="<?php echo HTTP_SERVER ?>index.php?tag=1">Tag</a> </li>
      <li> <a href="<?php echo HTTP_SERVER ?>index.php?event=1">Events</a> </li>
      <li> <a href="<?php echo HTTP_SERVER ?>index.php?variable=1">Variables</a> </li>
      <li> <a href="<?php echo HTTP_SERVER ?>index.php?upload=1">Uploads</a> </li>
      <li> <a href="<?php echo HTTP_SERVER ?>index.php?siterss=1">Update RSS, Sitemap</a> </li>
      <li> <a href="<?php echo HTTP_SERVER ?>index.php?logout=1">Logout</a> </li>
    </ul>
  </div>
  <div id="wrapper">
    <div id="maincontent">
      <?php
				if($loginOk){
					if(isset($_GET['category'])){
						require_once(INCLUDES.'category.php');
					}elseif(isset($_GET['tag'])){
						require_once(INCLUDES.'tag.php');
					}elseif(isset($_GET['post'])){
						require_once(INCLUDES.'post.php');
					}elseif(isset($_GET['event'])){
						require_once(INCLUDES.'event.php');
					}elseif(isset($_GET['variable'])){
						require_once(INCLUDES.'variable.php');
					}elseif(isset($_GET['upload'])){
						require_once(INCLUDES.'upload.php');
					}elseif(isset($_GET['siterss'])){
						require_once(INCLUDES.'siterss.php');
					}else{
						require_once(INCLUDES.'posts.php');
					}
				}else{
					require_once(INCLUDES.'login.php');
				}
            ?>
    </div>
    <div id="navcol">
      <div class="box">
        <h2>Box No. 1</h2>
        <p> My name is Swapnil Sarwe. A human being by nature. </p>
      </div>
      <div class="box">
        <h2>Box No. 1</h2>
        <div class="left">
          <h3>Categories:</h3>
          <ul>
            <?php
                            /*$cats = getCats();
                            while($row = mysql_fetch_assoc($cats)){
                                echo('<li><a href="'.HTTP_SERVER.'category/'.$row['cat_name'].'" title="'.$row['cat_name'].'">'.$row['cat_name'].'</a></li>');
                            }*/
                        ?>
          </ul>
        </div>
        <div class="left">
          <h3>Tags:</h3>
          <?php //formTagCloud(); ?>
        </div>
      </div>
    </div>
  </div>
  <div id="footer"> This is footer </div>
</div>
</body>
</html>
