<?php
    if(isset($_GET['task'])){
        if($_GET['task'] == 'edit'){
            $tag = new Tag($_GET['name']);
?>
<div id="basic" class="myform">
<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>">
<h2>Tag edit form</h2>
<p>Please enter the appropriate details below</p>
<input type="hidden" value="<?php echo $tag->tag_id; ?>" name="hidTagID" />
<label>Tag Name <span class="small">Enter tag name</span> </label>
<input class="txt" type="text" name="txtTagName" id="name" value="<?php echo $tag->tag_name; ?>" />
<input class="btn" type="submit" name="btnTagUpdate" value="Update" />
</form>
</div>
<?php
        }elseif($_GET['task'] == 'new'){
?>
<div id="basic" class="myform">
<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>">
<h2>Tag edit form</h2>
<p>Please enter the appropriate details below</p>
<label>Tag Name <span class="small">Enter tag names with spaces</span> </label>
<input class="txt" type="text" name="txtTagName" id="name" value="" />
<div class="clear"></div>
<label>All tags<span class="small">Check b4 adding above</span> </label>
<div class="selectchk">
<?php
	$all_tags = getTags();
	while($rowTags = mysql_fetch_assoc($all_tags)){
?>
	<div class="chk">
		<?php echo $rowTags['tag_name']; ?>
	</div>
<?php
	}
?>
</div>
<div class="clear"></div>
<input class="btn" type="submit" name="btnTagAdd" value="Add" />
</form>
</div>
<?php
        }elseif($_GET['task'] == 'delete'){
            $tag = new Tag($_GET['name']);
?>
<div id="basic" class="myform">
<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>">
<input type="hidden" value="<?php echo $tag->tag_id; ?>" name="hidTagID" />
                <h1>
                    <?php echo html_entity_decode($tag->tag_name); ?>
                </h1>
<input class="btn" type="submit" name="btnTagDelete" value="Delete" />
</form>
</div>
<?php
        }
    }else{
?>
<h1>
    <a href="<?php echo HTTP_SERVER.'index.php?tag=1&task=new'; ?>">add new tag</a>
</h1>
<h3>
</h3>
<p class="desc">
    Add a new tag by clickin on above link.
</p>
<?php
        $tags = getTags();
        if(mysql_num_rows($tags)){
            while($row = mysql_fetch_assoc($tags)){
                $tag = new Tag($row['tag_name']);
?>
                <h1>
                    <?php echo html_entity_decode($tag->tag_name); ?>
                </h1>
                <h3>
                <a href="<?php echo HTTP_SERVER.'index.php?tag=1&name='.html_entity_decode($tag->tag_name).'&task=edit'; ?>">edit</a>
                <a href="<?php echo HTTP_SERVER.'index.php?tag=1&name='.html_entity_decode($tag->tag_name).'&task=delete'; ?>" onclick="if(confirm('Are you sure want to delete?')){return true;}else{return false;}">delete</a>
                </h3>
<?php
            }
        }else{
?>
            <h1>
<?php
            if($tag->tag_id == ''){
                echo 'No \'' . $_GET['tag'] .'\' tag created yet.';
            }else{
                echo 'No posts for \'' . $tag->tag_name .'\' tag.';
            }
?>
            </h1>
<?php
        }
    }
?>