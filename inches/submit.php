<?php
    if(isset($_POST['btnPostComment'])){
        require_once(CLASSES.'comment.php');
        $post_id = $_POST['hidPostID'];
        $comment_name = $_POST['txtName'];
        $comment_email = $_POST['txtEmail'];
        $comment_url = $_POST['txtWebPage'];
		$comment_comment = $_POST['txtComments'];
        $comment = new Comment();
        if($comment->add_comment($post_id, $comment_name, $comment_email, $comment_url, $comment_comment)){
			unset($_POST['btnPostComment']);
            url_redirect($_SERVER['HTTP_REFERER']);
        }else{
            
        }
    }
    if(isset($_POST['btnPostFeedback'])){
        require_once(CLASSES.'feedback.php');
        $feedback_name = $_POST['txtName'];
        $feedback_email = $_POST['txtEmail'];
        $feedback_url = $_POST['txtWebPage'];
		$feedback_feedback = $_POST['txtComments'];
        $feedback = new Feedback();
        if($feedback->add_feedback($feedback_name, $feedback_email, $feedback_url, $feedback_feedback)){
			unset($_POST['btnPostComment']);
            url_redirect($_SERVER['HTTP_REFERER']);
        }else{
            
        }
    }
    
?>