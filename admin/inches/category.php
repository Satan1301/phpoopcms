<?php
    if(isset($_GET['task'])){
        if($_GET['task'] == 'edit'){
            $cat = new Category($_GET['name']);
?>
<div id="basic" class="myform">
<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>">
<h2>Category edit form</h2>
<p>Please enter the appropriate details below</p>
<input type="hidden" value="<?php echo $cat->cat_id; ?>" name="hidCatID" />
<label>Category Name <span class="small">Enter category name</span> </label>
<input class="txt" type="text" name="txtCatName" id="name" value="<?php echo $cat->cat_name; ?>" />
<label>Category Desc.<span class="small">Enter category description</span> </label>
<textarea name="txtCatDesc" cols="1" rows="1"><?php echo $cat->cat_desc; ?></textarea>
<input class="btn" type="submit" name="btnCatUpdate" value="Update" />
</form>
</div>
<?php
        }elseif($_GET['task'] == 'new'){
?>
<div id="basic" class="myform">
<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>">
<h2>Category edit form</h2>
<p>Please enter the appropriate details below</p>
<label>Category Name <span class="small">Enter category name</span> </label>
<input class="txt" type="text" name="txtCatName" id="name" value="" />
<label>Category Desc.<span class="small">Enter category description</span> </label>
<textarea name="txtCatDesc" cols="1" rows="1"></textarea>
<input class="btn" type="submit" name="btnCatAdd" value="Add" />
</form>
</div>
<?php
        }elseif($_GET['task'] == 'delete'){
            $cat = new Category($_GET['name']);
?>
<div id="basic" class="myform">
<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>">
<input type="hidden" value="<?php echo $cat->cat_id; ?>" name="hidCatID" />
                <h1>
                    <?php echo html_entity_decode($cat->cat_name); ?>
                </h1>
                <p class="desc">
                    <?php echo html_entity_decode($cat->cat_desc); ?>
                </p>
<input class="btn" type="submit" name="btnCatDelete" value="Delete" />
</form>
</div>
<?php
        }
    }else{
?>
<h1>
    <a href="<?php echo HTTP_SERVER.'index.php?category=1&task=new'; ?>">add new category</a>
</h1>
<h3>
</h3>
<p class="desc">
    Add a new category by clickin on above link.
</p>
<?php
        $cats = getCats();
        if(mysql_num_rows($cats)){
            while($row = mysql_fetch_assoc($cats)){
                $cat = new Category($row['cat_name']);
?>
                <h1>
                    <?php echo html_entity_decode($cat->cat_name); ?>
                </h1>
                <h3>
                <a href="<?php echo HTTP_SERVER.'index.php?category=1&name='.html_entity_decode($cat->cat_name).'&task=edit'; ?>">edit</a>
                <a href="<?php echo HTTP_SERVER.'index.php?category=1&name='.html_entity_decode($cat->cat_name).'&task=delete'; ?>" onclick="if(confirm('Are you sure want to delete?')){return true;}else{return false;}">delete</a>
                </h3>
                <p class="desc">
                    <?php echo html_entity_decode($cat->cat_desc); ?>
                </p>
<?php
            }
        }else{
?>
            <h1>
<?php
            if($category->cat_id == ''){
                echo 'No \'' . $_GET['category'] .'\' category created yet.';
            }else{
                echo 'No posts for \'' . $category->cat_name .'\' category.';
            }
?>
            </h1>
<?php
        }
    }
?>