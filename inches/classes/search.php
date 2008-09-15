<?php
	class Search {
		var $query;
		var $type;
		var $result;
		
		function Search($query, $type = 'all'){
			$this->query = $query;
			$this->type = $type;
			$this->result = $this->search_title();
		}
		function search_title(){
			global $db;
			$get_urls = "SELECT
						post_h1, post_link, post_h2
					FROM
						posts
					WHERE
						post_h1 LIKE '%".$this->query."%'
					OR
						post_h2 LIKE '%".$this->query."%'
					OR
						post_ps LIKE '%".$this->query."%'
					";
			return $db->query($get_urls);
		}
	}
?>