<?php
    if(isset($_GET['task'])){
        if($_GET['task'] == 'edit'){
            $post = new Post($_GET['name']);
?>
<div id="basic" class="myform">
<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>">
<h2>Post edit form</h2>
<p>Please enter the appropriate details below</p>
<input type="hidden" value="<?php echo $post->post_id; ?>" name="hidPostID" />
<label>Post Name <span class="small">Enter post name</span> </label>
<input class="txt" type="text" name="txtPostName" id="name" value="<?php echo $post->post_h1; ?>" />
<label>Post Desc.<span class="small">Enter post short description</span> </label>
<textarea name="txtPostDesc" cols="1" rows="1"><?php echo $post->post_h2; ?></textarea>
<label>Post Content<span class="small">Enter the content</span> </label>
<textarea name="txtPostContent" cols="1" rows="1"><?php echo $post->post_ps; ?></textarea>
<label>Post Status<span class="small">Select appropriate</span> </label>
<div class="selectchk">
        <?php
            if($post->post_delete){
                $enabled = ' checked="checked"';
                $disabled = '';
            }else{
                $disabled = ' checked="checked"';
                $enabled = '';
            }
        ?>
	<div class="chk">
		<input name="radStatus" type="radio" value="1"<?php echo $enabled; ?> /> Enable
	</div>
	<div class="chk">
		<input name="radStatus" type="radio" value="0"<?php echo $disabled; ?> /> Disable
	</div>
</div>
<div class="clear"></div>
<label>Post Categories<span class="small">Unselect the categories</span> </label>
<div class="selectchk">
<?php
$all_cats = $post->selected_category();
while($row = mysql_fetch_assoc($all_cats)){
?>
	<div class="chk">
		<input name="chkUnSelCats[]" type="checkbox" value="<?php echo $row['cat_id']; ?>" /><?php echo $row['cat_name']; ?>
	</div>
<?php
}
?>
</div>
<div class="clear"></div>
<label>Post Categories<span class="small">Select the categories</span> </label>
<div class="selectchk">
<?php
$all_cats = $post->unselected_category();
while($row = mysql_fetch_assoc($all_cats)){
?>
	<div class="chk">
		<input name="chkSelCats[]" type="checkbox" value="<?php echo $row['cat_id']; ?>" /><?php echo $row['cat_name']; ?>
	</div>
<?php
}
?>
</div>
<div class="clear"></div>
<label>Current tags<span class="small">Select to remove</span> </label>
<div class="selectchk">
<?php
	$all_tags = $post->selected_tags();
	while($rowTag = mysql_fetch_assoc($all_tags)){
?>
	<div class="chk">
		<input name="chkRemTags[]" type="checkbox" value="<?php echo $rowTag['tag_id']; ?>" /><?php echo $rowTag['tag_name']; ?>
	</div>
<?php
	}
?>
</div>
<div class="clear"></div>
<label>All tags on site<span class="small">Select to add</span> </label>
<div class="selectchk">
<?php
	$all_tags = $post->unselected_tags();
	while($rowTags = mysql_fetch_assoc($all_tags)){
?>
	<div class="chk">
		<input name="chkSelTags[]" type="checkbox" value="<?php echo $rowTags['tag_id']; ?>" /><?php echo $rowTags['tag_name']; ?>
	</div>
<?php
	}
?>
</div>
<input class="btn" type="submit" name="btnPostUpdate" value="Update" />
</form>
</div>
<?php
        }elseif($_GET['task'] == 'new'){
?>
<div id="basic" class="myform">
<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>">
<h2>Post edit form</h2>
<p>Please enter the appropriate details below</p>
<label>Post Name <span class="small">Enter post name</span> </label>
<input class="txt" type="text" name="txtPostName" id="name" value="" />
<label>Post Desc.<span class="small">Enter post short description</span> </label>
<textarea name="txtPostDesc" cols="1" rows="1"></textarea>
<label>Post Content<span class="small">Enter the content</span> </label>
<textarea name="txtPostContent" cols="1" rows="1"></textarea>
<label>Post Status<span class="small">Select appropriate</span> </label>
<div class="selectchk">
	<div class="chk">
		<input name="radStatus" type="radio" value="1" /> Enable
	</div>
	<div class="chk">
		<input name="radStatus" type="radio" value="0" /> Disable
	</div>
</div>
<div class="clear"></div>
<label>Post Categories<span class="small">Unselect the categories</span> </label>
<div class="selectchk">
<?php
$all_cats = getCats();
while($row = mysql_fetch_assoc($all_cats)){
?>
	<div class="chk">
		<input name="chkPostCats[]" type="checkbox" value="<?php echo $row['cat_id']; ?>" /><?php echo $row['cat_name']; ?>
	</div>
<?php
}
?>
</div>
<div class="clear"></div>
<label>All tags on site<span class="small">Select to add</span> </label>
<div class="selectchk">
<?php
	$all_tags = getTags();
	while($rowTags = mysql_fetch_assoc($all_tags)){
?>
	<div class="chk">
		<input name="chkPostTags[]" type="checkbox" value="<?php echo $rowTags['tag_id']; ?>" /><?php echo $rowTags['tag_name']; ?>
	</div>
<?php
	}
?>
</div>
<input class="btn" type="submit" name="btnPostAdd" value="Add" />
</form>
</div>
<?php
        }elseif($_GET['task'] == 'delete'){
            $post = new Post($_GET['name']);
?>
<div id="basic" class="myform">
<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>">
<input type="hidden" value="<?php echo $post->post_id; ?>" name="hidPostID" />
                <h1>
                    <?php echo html_entity_decode($post->post_h1); ?>
                </h1>
                <p class="desc">
                    <?php echo html_entity_decode($post->post_h2); ?>
                </p>
                <?php echo html_entity_decode($post->post_ps); ?>
<input class="btn" type="submit" name="btnPostDelete" value="Delete" />
</form>
</div>
<?php
        }
    }else{
?>
<h1>
    <a href="<?php echo HTTP_SERVER.'index.php?post=1&task=new'; ?>">add new post</a>
</h1>
<h3>
</h3>
<p class="desc">
    Add a new post by clickin on above link.
</p>
<?php
        $posts = getPosts();
        if(mysql_num_rows($posts)){
            while($row = mysql_fetch_assoc($posts)){
                $post = new Post($row['post_link']);
				if($post->post_delete){
					$style = '';
				}else{
					$style = ' class="del"';
				}
?>
				<h1<?php echo $style; ?>>
                	<?php echo html_entity_decode($post->post_h1); ?>
                </h1>
                <h3>
                <a href="<?php echo HTTP_SERVER.'index.php?post=1&name='.html_entity_decode($post->post_link).'&task=edit'; ?>">edit</a>
                <a href="<?php echo HTTP_SERVER.'index.php?post=1&name='.html_entity_decode($post->post_link).'&task=delete'; ?>" onclick="if(confirm('Are you sure want to delete?')){return true;}else{return false;}">delete</a>
                </h3>
                <p class="desc">
                    <?php echo html_entity_decode($post->post_h2); ?>
                </p>
<?php
            }
        }else{
?>
            <h1>
<?php
            if($post->cat_id == ''){
                echo 'No \'' . $_GET['post'] .'\' post created yet.';
            }else{
                echo 'No posts for \'' . $post->cat_name .'\' post.';
            }
?>
            </h1>
<?php
        }
    }
?>