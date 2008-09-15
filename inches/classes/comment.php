<?php
    class Comment{
        var $comment_id;
        var $post_id;
		var $comment_name;
		var $comment_email;
		var $comment_url;
		var $comment_comment;
		var $comment_date;
                
        function Comment(){
            /*if($task == ''){
                $this->cat_name = $cat_id;
                $this->get_cat_details();                
            }elseif($task == 'edit'){
                $this->cat_id = $cat_id;
            }*/
        }
        function add_comment($post_id, $comment_name, $comment_email, $comment_url, $comment){
			global $db;
			$add_comment = "INSERT INTO
								comments(comment_id,post_id,comment_name,comment_email,comment_url,comment,comment_date) 
							VALUES ( NULL,'".$post_id."','".$comment_name."','".$cmment_email."','".$comment_url."','".$comment."','".date("Y-m-d H:i:s")."')";
            return $db->iquery($add_comment);
        }
/*        function update_category($cat_name, $cat_desc){
            $update_cat = "UPDATE 
                                cats
                            SET
                                cat_name = '".$cat_name."',
                                cat_desc = '".$cat_desc."'
                            WHERE
                                cat_id = ".$this->cat_id;
            if(mysql_query($update_cat)){
                return true;
            }else{
                return false;
            }
        }
        function delete_category(){
            $delete_cat = "DELETE FROM
                                cats
                            WHERE
                                cat_id = ".$this->cat_id;
            if(mysql_query($delete_cat)){
                return true;
            }else{
                return false;
            }
        }*/
        /*function get_cat_details(){
            $get_cat = "SELECT
                                cat_id, cat_name, cat_desc, cat_created
                        FROM
                                cats
			WHERE
				cat_name = '" . $this->cat_name . "'";
            $result_cat = mysql_query($get_cat);
            if($result_cat){
                $row = mysql_fetch_assoc($result_cat);
                $this->cat_id = $row['cat_id'];
		$this->cat_desc = $row['cat_desc'];
		$this->cat_created = $row['cat_created'];
            }else{
                return false;
            }
        }*/
    }
?>