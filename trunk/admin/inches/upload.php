<?php
    if(isset($_GET['task'])){
        if($_GET['task'] == 'new'){
?>
<div id="basic" class="myform">
<form id="form1" name="form1" method="post" action="<?php echo $PHP_SELF; ?>" enctype="multipart/form-data">
<h2>Image Upload form</h2>
<p>Please enter the appropriate details below</p>
<label>Select the file <span class="small">only JPEG, PNGs</span> </label>
<input name="upImage" id="upImage" type="file" class="txt" />
<input class="btn" type="submit" name="btnUploadImg" value="Upload" />
</form>
</div>
<?php
        }
    }else{
?>
<h1>
    <a href="<?php echo HTTP_SERVER.'index.php?upload=1&task=new'; ?>">upload new photo</a>
</h1>
<?php
    }
?>