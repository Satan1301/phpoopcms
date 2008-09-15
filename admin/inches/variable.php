<?php
    if(isset($_GET['task'])){
        if($_GET['task'] == 'edit'){
            $var = new Variable($_GET['id']);
?>
<div id="basic" class="myform">
<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>">
<h2>Variable edit form</h2>
<p>Please enter the appropriate details below</p>
<input type="hidden" value="<?php echo $var->var_id; ?>" name="hidVarID" />
<label>Variable Name <span class="small">Enter variable name</span> </label>
<input class="txt" type="text" name="txtVarName" id="name" value="<?php echo $var->var_name; ?>" />
<label>Variable Desc.<span class="small">Enter variable value</span> </label>
<textarea name="txtVarVal" cols="1" rows="1"><?php echo $var->var_value; ?></textarea>
<input class="btn" type="submit" name="btnVarUpdate" value="Update" />
</form>
</div>
<?php
        }elseif($_GET['task'] == 'new'){
?>
<div id="basic" class="myform">
<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>">
<h2>Variable edit form</h2>
<p>Please enter the appropriate details below</p>
<label>Variable Name <span class="small">Enter variable name</span> </label>
<input class="txt" type="text" name="txtVarName" id="name" value="" />
<label>Variable Desc.<span class="small">Enter variable value</span> </label>
<textarea name="txtVarVal" cols="1" rows="1"></textarea>
<input class="btn" type="submit" name="btnVarAdd" value="Add" />
</form>
</div>
<?php
        }elseif($_GET['task'] == 'delete'){
            $var = new Variable($_GET['name']);
?>
<div id="basic" class="myform">
<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>">
<input type="hidden" value="<?php echo $var->var_id; ?>" name="hidVarID" />
                <h1>
                    <?php echo html_entity_decode($var->var_name); ?>
                </h1>
                <p class="desc">
                    <?php echo html_entity_decode($var->var_value); ?>
                </p>
<input class="btn" type="submit" name="btnVarDelete" value="Delete" />
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
    Add a new variable by clickin on above link.
</p>
<?php
        $vars = getVars();
        if(mysql_num_rows($vars)){
            while($row = mysql_fetch_assoc($vars)){
                $var = new Variable($row['var_id']);
?>
                <h1>
                    <?php echo html_entity_decode($var->var_name); ?>
                </h1>
                <h3>
                <a href="<?php echo HTTP_SERVER.'index.php?variable=1&id='.html_entity_decode($var->var_id).'&task=edit'; ?>">edit</a>
                <a href="<?php echo HTTP_SERVER.'index.php?variable=1&id='.html_entity_decode($var->var_id).'&task=delete'; ?>" onclick="if(confirm('Are you sure want to delete?')){return true;}else{return false;}">delete</a>
                </h3>
                <p class="desc">
                    <?php echo html_entity_decode($var->var_value); ?>
                </p>
<?php
            }
        }else{
?>
            <h1>
<?php
            if($varegory->var_id == ''){
                echo 'No \'' . $_GET['category'] .'\' variable created yet.';
            }else{
                echo 'No posts for \'' . $varegory->var_name .'\' category.';
            }
?>
            </h1>
<?php
        }
    }
?>