<?php
    if(isset($_POST['btnCatUpdate'])){
        require_once(CLASSES.'category.php');
        $cat_id = $_POST['hidCatID'];
        $cat_name = $_POST['txtCatName'];
        $cat_desc = $_POST['txtCatDesc'];
        $cat = new Category($cat_id, 'edit');
        if($cat->update_category($cat_name, $cat_desc)){
            url_redirect(HTTP_SERVER.'index.php?category=1');
        }else{
            
        }
    }
    if(isset($_POST['btnCatAdd'])){
        require_once(CLASSES.'category.php');
        $cat_name = $_POST['txtCatName'];
        $cat_desc = $_POST['txtCatDesc'];
        $cat = new Category();
        if($cat->add_category($cat_name, $cat_desc)){
            url_redirect(HTTP_SERVER.'index.php?category=1');
        }else{
            
        }
    }
    if(isset($_POST['btnCatDelete'])){
        require_once(CLASSES.'category.php');
        $cat_id = $_POST['hidCatID'];
        $cat = new Category($cat_id, 'edit');
        if($cat->delete_category()){
            url_redirect(HTTP_SERVER.'index.php?category=1');
        }else{
            
        }
    }
    if(isset($_POST['btnTagUpdate'])){
        require_once(CLASSES.'tag.php');
        $tag_id = $_POST['hidTagID'];
        $tag_name = $_POST['txtTagName'];
        $tag = new Tag($tag_id, 'edit');
        if($tag->update_tag($tag_name)){
            url_redirect(HTTP_SERVER.'index.php?tag=1');
        }else{
            
        }
    }
    if(isset($_POST['btnTagAdd'])){
        require_once(CLASSES.'tag.php');
        $tag_name = $_POST['txtTagName'];
		$tag_names = explode(" ", $tag_name);
        $tag = new Tag();
        if($tag->add_tag($tag_names)){
            url_redirect(HTTP_SERVER.'index.php?tag=1');
        }else{
            
        }
    }
    if(isset($_POST['btnTagDelete'])){
        require_once(CLASSES.'tag.php');
        $tag_id = $_POST['hidTagID'];
        $tag = new Tag($tag_id, 'edit');
        if($tag->delete_tag()){
            url_redirect(HTTP_SERVER.'index.php?tag=1');
        }else{
            
        }
    }
    if(isset($_POST['btnPostUpdate'])){
        require_once(CLASSES.'post.php');
        $post_id = $_POST['hidPostID'];
        $post_h1 = $_POST['txtPostName'];
        $post_h2 = $_POST['txtPostDesc'];
        $post_ps = $_POST['txtPostContent'];
        $post_status = $_POST['radStatus'];
        $post_sel = $_POST['chkSelCats'];
        $post_unsel = $_POST['chkUnSelCats'];
        $tag_sel = $_POST['chkSelTags'];
        $tag_unsel = $_POST['chkRemTags'];
        $post = new Post($post_id, 'edit');
        if($post->update_post($post_h1, $post_h2, $post_ps, $post_sel, $post_unsel, $tag_sel, $tag_unsel, $post_status)){
            //url_redirect(HTTP_SERVER.'index.php?post=1');
        }else{
            
        }
    }
    if(isset($_POST['btnPostAdd'])){
        require_once(CLASSES.'post.php');
        $post_h1 = $_POST['txtPostName'];
        $post_h2 = $_POST['txtPostDesc'];
        $post_ps = $_POST['txtPostContent'];
        $post_status = $_POST['radStatus'];
		$post_cats = $_POST['chkPostCats'];
		$post_tags = $_POST['chkPostTags'];
        $post = new Post();
        if($post->add_post($post_h1, $post_h2, $post_ps, $post_cats, $post_tags, $post_status)){
			unset($_POST['btnPostAdd']);
            url_redirect(HTTP_SERVER.'index.php?post=1');
        }else{
            
        }
    }
    if(isset($_POST['btnPostDelete'])){
        require_once(CLASSES.'post.php');
        $post_id = $_POST['hidPostID'];
        $post = new Post($post_id, 'edit');
        if($post->delete_post()){
            url_redirect(HTTP_SERVER.'index.php?post=1');
        }else{
            
        }
    }
    if(isset($_POST['btnEventUpdate'])){
        require_once(CLASSES.'event.php');
        $event_id = $_POST['hidEventID'];
        $event_name = $_POST['txtEventName'];
        $event_datetime = $_POST['txtEventDate'];
        $event_desc = $_POST['txtEventDesc'];
        $event = new Event($event_id, 'edit');
        if($event->update_event($event_name, $event_datetime, $event_desc)){
            //url_redirect(HTTP_SERVER.'index.php?post=1');
        }else{
            
        }
    }
    if(isset($_POST['btnEventAdd'])){
        require_once(CLASSES.'event.php');
        $event_name = $_POST['txtEventName'];
        $event_datetime = $_POST['txtEventDate'];
        $event_desc = $_POST['txtEventDesc'];
        $event = new Event();
        if($event->add_event($event_name, $event_datetime, $event_desc)){
	    unset($_POST['btnEventAdd']);
            url_redirect(HTTP_SERVER.'index.php?event=1');
        }else{
            
        }
    }
    if(isset($_POST['btnEventDelete'])){
        require_once(CLASSES.'event.php');
        $post_id = $_POST['hidPostID'];
        $post = new Post($post_id, 'edit');
        if($post->delete_post()){
            url_redirect(HTTP_SERVER.'index.php?post=1');
        }else{
            
        }
    }
	if(isset($_POST['btnVarUpdate'])){
        require_once(CLASSES.'variable.php');
        $var_id = $_POST['hidVarID'];
        $var_name = $_POST['txtVarName'];
        $var_value = $_POST['txtVarVal'];
        $variable = new Variable($var_id, 'edit');
        if($variable->update_variable($var_name, $var_value)){
	    unset($_POST['btnVarUpdate']);
            url_redirect(HTTP_SERVER.'index.php?variable=1');
        }else{
            
        }
    }
	if(isset($_POST['btnVarAdd'])){
        require_once(CLASSES.'variable.php');
        $var_name = $_POST['txtVarName'];
        $var_value = $_POST['txtVarVal'];
        $variable = new Variable();
        if($variable->add_variable($var_name, $var_value)){
	    unset($_POST['btnVarAdd']);
            url_redirect(HTTP_SERVER.'index.php?variable=1');
        }else{
            
        }
    }
    if(isset($_POST['btnUploadImg'])){
        print_r($_FILES);
        if(imageUpload($_FILES['upImage']['tmp_name'], UPLOAD_DIR.$_FILES['upImage']['name'], UPLOAD_DIR.'thumb_'.$_FILES['upImage']['name'])){
            echo('About Upload');
        }
        
    }
?>