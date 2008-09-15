<?php
    class Comments {
        var $comment_id;
        var $post_id;
		var $comment_name;
		var $comment_email;
		var $comment_url;
		var $comment;
		var $comment_date;
                
        function Comments($post_id){
        	$this->post_id = $post_id;
        }
        function get_comments(){
        	
        }
		function add_cats($cats, $post_id){
			$add_cats = "INSERT INTO
								post_to_cat(post_id, cat_id)
							VALUES";
			for($i = 0; $i < count($cats); $i++){
				$add_cats .= "(".$post_id.", ".$cats[$i]."),";
			}
			$add_cats = substr($add_cats, 0, -1);
			if(mysql_query($add_cats)){
				//return true;
			}else{
				return false;
			}	
		}
		function add_tags($tags, $post_id){
			$add_tags = "INSERT INTO
					post_to_tag(post_id, tag_id)
				VALUES ";
			for($i = 0; $i < count($tags); $i++){
				$add_tags .= "(".$post_id.", ".$tags[$i]."),";
			}
			$add_tags = substr($add_tags, 0, -1);
			if(mysql_query($add_tags)){
				//return true;
			}else{
				return false;
			}	
		}
		function del_cats($cats, $post_id){
			for($i = 0; $i < count($cats); $i++){
				$del_cats = "DELETE FROM
								post_to_cat
							WHERE
								post_id = ".$this->post_id." 
							AND
								cat_id = ".$cats[$i];
				if(mysql_query($del_cats)){
				}else{
					return false;
				}
			}
		}
		function del_tags($tags, $post_id){
			for($i = 0; $i < count($tags); $i++){
				$del_tags = "DELETE FROM
								post_to_tag
							WHERE
								post_id = ".$this->post_id." 
							AND
								tag_id = ".$tags[$i];
				if(mysql_query($del_tags)){
				}else{
					return false;
				}
			}
		}
        function add_post($post_h1, $post_h2, $post_ps, $post_cats, $post_tags, $post_status){
            $add_post = "INSERT INTO
                            posts(post_id, post_h1, post_link,
                                        post_h2, post_ps, post_created, post_modified, post_delete)
                        VALUES
			   (NULL, '".$post_h1."', '".sanitize_title_with_dashes($post_h1)."',
                                '".$post_h2."', '".htmlentities($post_ps)."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."', ".$post_status.")";
            if(mysql_query($add_post)){
				$this->post_id = mysql_insert_id();
				$this->add_cats($post_cats, $this->post_id);
				$this->add_tags($post_tags, $this->post_id);
				return true;
            }else{
                return false;
            }
        }
		function selected_category(){
			$get_post_cat = "SELECT
									c.cat_name, c.cat_id
							FROM
									cats c, post_to_cat p2c
							WHERE
									p2c.post_id = ".$this->post_id.
							" AND
									p2c.cat_id = c.cat_id
							ORDER BY
									cat_name";
			return mysql_query($get_post_cat);
		}
		function unselected_category(){
			$get_post_cat = "SELECT
								cat_name, cat_id
							FROM
								cats
							WHERE
								cat_id
							NOT IN(
									SELECT 
										c.cat_id 
									FROM 
										cats c, post_to_cat p2c 
									WHERE 
										p2c.post_id = ".$this->post_id."
									AND 
										c.cat_id = p2c.cat_id
								)";
			return mysql_query($get_post_cat);
		}
		function unselected_tags(){
			$get_post_tag = "SELECT
								tag_name, tag_id
							FROM
								tags
							WHERE
								tag_id
							NOT IN(
									SELECT 
										t.tag_id 
									FROM 
										tags t, post_to_tag p2t 
									WHERE 
										p2t.post_id = ".$this->post_id."
									AND 
										t.tag_id = p2t.tag_id
								)";
			return mysql_query($get_post_tag);
		}
		function selected_tags(){
			$sql_get_tags = "SELECT
									t.tag_name, t.tag_id
							FROM
									tags t, post_to_tag p2t
							WHERE
									p2t.post_id = ".$this->post_id.
							" AND
									p2t.tag_id = t.tag_id
							ORDER BY
									tag_name";
			return mysql_query($sql_get_tags);
		}
        function update_post($post_h1, $post_h2, $post_ps, $post_sel, $post_unsel, $tag_sel, $tag_unsel, $post_status){
            $update_post = "UPDATE 
                                posts
                            SET
                                post_h1 = '".$post_h1."',
                                post_h2 = '".$post_h2."',
                                post_ps = '".htmlentities($post_ps)."',
                                post_modified = '".date("Y-m-d H:i:s")."',
                                post_delete = ".$post_status."
                            WHERE
                                post_id = ".$this->post_id;
            if(mysql_query($update_post)){
				$post_id = $this->post_id;
                $this->add_cats($post_sel, $post_id);
				$this->del_cats($post_unsel, $post_id);
				$this->add_tags($tag_sel, $post_id);
				$this->del_tags($tag_unsel, $post_id);
				return true;
            }else{
                return false;
            }
        }
        function delete_post(){
            $delete_post = "UPDATE
                                posts
							SET
								post_delete = '0',
								post_modified = '".date("Y-m-d H:i:s")."'
                            WHERE
                                post_id = ".$this->post_id;
            if(mysql_query($delete_post)){
                return true;
            }else{
                return false;
            }
        }
        function get_post_details(){
            $get_post = "SELECT
                                post_id, post_h1, post_link, post_h2, post_ps, post_delete
                        FROM
                                posts
						WHERE
								post_id = '" . $this->post_id . "'";
            $result_post = mysql_query($get_post);
            if($result_post){
                $row = mysql_fetch_assoc($result_post);
                $this->post_id = $row['post_id'];
				$this->post_h1 = $row['post_h1'];
				$this->post_link = $row['post_link'];
				$this->post_h2 = $row['post_h2'];
				$this->post_ps = $row['post_ps'];
				$this->post_delete = $row['post_delete'];
            }else{
                return false;
            }
        }
    }
?>