<?php
    class Feedback{
        function Feedback(){
        }
        function add_feedback($feedback_name, $feedback_email, $feedback_url, $feedback){
			global $db;
			$add_feedback = "INSERT INTO
								feedback(feedback_id,feedback_name,feedback_email,feedback_url,feedback,feedback_date) 
							VALUES ( NULL,'".$feedback_name."','".$feedback_email."','".$feedback_url."','".$feedback."','".date("Y-m-d H:i:s")."')";
            return $db->iquery($add_feedback);
        }
    }
?>