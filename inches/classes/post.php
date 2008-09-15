<?php
	class Post {
		var $post_id;
		var $post_h1;
		var $post_link;		
		var $post_h2;
		var $post_ps;
		var $post_created;
		var $post_modified;
		var $post_cats;
		var $post_tags;
		var $post_comments;
		var $post_delete;
		
		function Post($post_type, $bytype = 'link'){
			if($bytype == 'link'){
				$this->post_link = $post_type;
				$this->get_post_details_by_name();
			}else if($bytype == 'id'){
				$this->post_id = $post_type;
				$this->get_post_details_by_id();
			}
		}
		function get_cats(){
			global $db;
			$sql_get_cats = "SELECT
									c.cat_name
							FROM
									cats c, post_to_cat p2c
							WHERE
									p2c.post_id = ".$this->post_id.
							" AND
									p2c.cat_id = c.cat_id
							ORDER BY
									cat_name";
			return $db->query($sql_get_cats);
		}
		function get_tags(){
			global $db;
			$sql_get_tags = "SELECT
									t.tag_name
							FROM
									tags t, post_to_tag p2t
							WHERE
									p2t.post_id = ".$this->post_id.
							" AND
									p2t.tag_id = t.tag_id
							ORDER BY
									tag_name";
			return $db->query($sql_get_tags);
		}
		function get_comments(){
			global $db;
			$sql_get_comments = "SELECT
								comment_name, comment_id, comment_email, comment_url, comment, comment_date
							FROM
								comments
							WHERE
								post_id = ".$this->post_id;
			return $db->query($sql_get_comments);
		}
		function get_comments_count(){
			$sql_get_comments = "SELECT
								COUNT(comment_id) AS total_count
							FROM
								comments
							WHERE
								post_id = ".$this->post_id;
			$result_count = mysql_query($sql_get_comments);
			$total_count = mysql_fetch_assoc($result_count);
			return $total_count['total_count'];
		}
		function get_post_details_by_name(){
			global $db;
			$get_post = "SELECT
							post_id, post_h1, post_h2, post_ps, post_created, post_modified
						FROM
							posts
						WHERE
							post_link = '". $this->post_link ."'" . "
						AND
							post_delete = '1'
						LIMIT 1";
			$row_post = $db->query($get_post);
			if($row_post){
				$this->post_id = $row_post[0]['post_id'];
				$this->post_h1 = html_entity_decode($row_post[0]['post_h1']);
				$this->post_h2 = html_entity_decode($row_post[0]['post_h2']);
				$this->post_ps = html_entity_decode($row_post[0]['post_ps']);
				$this->post_created = $row_post[0]['post_created'];
				$this->post_modified = $row_post[0]['post_modified'];
				$this->cats = $this->get_cats();
				$this->tags = $this->get_tags();
				$this->comments = $this->get_comments_count();
			}else{
			}
		}
		function get_post_details_by_id(){
			$get_post = "SELECT
							post_link, post_h1, post_h2, post_ps, post_created, post_modified
						FROM
							posts
						WHERE
							post_id = ". $this->post_id . "
						AND
							post_delete = '1'";
			$result_post = mysql_query($get_post);
			if($result_post){
				$row_post = mysql_fetch_assoc($result_post);
				$this->post_link = html_entity_decode($row_post['post_link']);
				$this->post_h1 = html_entity_decode($row_post['post_h1']);
				$this->post_h2 = html_entity_decode($row_post['post_h2']);
				$this->post_ps = html_entity_decode($row_post['post_ps']);
				$this->post_created = $row_post['post_created'];
				$this->post_modified = $row_post['post_modified'];
				$this->cats = $this->get_cats();
				$this->tags = $this->get_tags();
				$this->comments = $this->get_comments_count();
			}else{
			}
		}
		function print_post(){
			echo 
'<h1>
	<a href="'.HTTP_SERVER.$this->post_link.'.html">'.html_entity_decode($this->post_h1).'</a>
</h1>
<h3>
	posted by
	<a href="'.HTTP_SERVER .'about-me.html">'.AUTHOR.'</a>
	under '.getCatList($this->cats).' on '.format_date($this->post_created).'

</h3>
<p class="desc">
	'.html_entity_decode($this->post_h2).'
</p>
'.$this->post_ps.'
<div class="updates">
	<p>
	This post has been updated from its original form on '.format_date($this->post_modified).'- originally posted on '.format_date($this->post_created).'.
	</p>
</div>
<div class="postfoot">
	<p>
		Tagged under: '.getTagList($this->tags).'
	</p>
</div>
<div class="postfoot">
	<p>
		'.$this->comments.' Comments
	</p>
</div>';
		}
	}
?>