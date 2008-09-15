<?php
    function connectDB(){
        $myconn = mysql_connect(DBHOST, DBUSER, DBPASS);
        mysql_select_db(DBNAME, $myconn);
    }
    function getCats($limit=0, $order='DESC'){
		global $db;
        $sql_get_cats = "SELECT
                                cat_name, cat_id
                        FROM
                                cats
                        ORDER BY
                                cat_name
                        ".$order;
        if($limit != 0){
            $sql_get_cats .= " LIMIT 0,".$limit;
        }
		return $db->query($sql_get_cats);
    }
	function getPostsForArchive(){
		global $db;
		$sql_get_posts = "SELECT
							post_h1, post_link, post_created
						FROM
							posts
						ORDER BY
							post_created
						DESC";
		return $db->query($sql_get_posts);
	}
	function getPostsByCat($cat_id){
		global $db;
		$sql_get_posts = "SELECT
								p.post_h1, p.post_link
							FROM
								posts p, post_to_cat p2c
							WHERE
								p2c.cat_id = ".$cat_id." 
							AND
								p2c.post_id = p.post_id";
		return $db->query($sql_get_posts);
	}
    function getTags(){
		global $db;
        $sql_get_tags = "SELECT
                                tag_name
                        FROM
                                tags";
		return $db->query($sql_get_tags);
    }
	function getLatestPosts(){
		global $db;
        $sql_get_posts = "SELECT
                                post_h1, post_link
                        FROM
                                posts
			WHERE
				post_delete = 1
                        ORDER BY
                                post_id
                        DESC LIMIT 5";
        return $db->query($sql_get_posts);
	}
	function getLatestComments(){
		global $db;
        $sql_get_comments = "SELECT
								p.post_link, c.comment_id, c.comment
							FROM
								posts p, comments c
							WHERE
								p.post_id = c.post_id
							ORDER BY
								c.comment_date
							DESC LIMIT 5";
		return $db->query($sql_get_comments);
	}
    function formTagCloud(){
        $allTags = getTags();
        foreach($allTags as $row){
            echo '<span class="tag'.rand(1, 4).'">
                    <a href="'.HTTP_SERVER.'tag/'.$row['tag_name'].'/" title="'.$row['tag_name'].'" rel="tag">'.$row['tag_name'].'</a>'.
                  '</span>';
        }
    }
	function getTagList($tag_result){
		$tagStr = '';
		foreach($tag_result as $row){
			$tagStr .= '<a href="'.HTTP_SERVER.'tag/'.$row['tag_name'].'/" title="'.$row['tag_name'].'" rel="tag">'.$row['tag_name'].'</a> ';
		}
		return $tagStr;
	}
	function formTagMeta($tag_list){
		$tagStr = '';
		foreach($tag_list as $row) {
			$tagStr .= $row['tag_name'].', ';
		}
		$tagStr = substr($tagStr, 0, -2);
		return $tagStr;
	}
	function getCatList($cat_result){
		$catStr = '';
		foreach($cat_result as $row){
			$catStr .= '<a class="cat" href="'.HTTP_SERVER.'category/'.$row['cat_name'].'/" title="'.$row['cat_name'].'">'.$row['cat_name'].'</a> ';
		}
		return $catStr;
	}
	function getComments($comment_result){
		$commentStr = '';
		$flag = 'odd';
		foreach($comment_result as $row){
			$commentStr .= '<h3><a name="'.$row['comment_id'].'" href="'.$row['comment_url'].'">'.$row['comment_name'].'</a> said:</h3><p class="'.$flag.'">'.$row['comment'].'</p><p class="commentfoot">on '.$row['comment_date'].'</p>';
			if($flag == 'odd') {
				$flag = 'even';
			}else{
				$flag = 'odd';
			}
		}
		return $commentStr;
	}
	function getFeedbacks(){
		global $db;
		$sql_get_feedback = "SELECT
								feedback_name,feedback_email, feedback_url, feedback, feedback_date
							FROM
								feedback
							ORDER BY
								feedback_id
							DESC";
		$feedback_result = $db->query($sql_get_feedback);
		$feedbackStr = '';
		$flag = 'odd';
		foreach($feedback_result as $row){
			$feedbackStr .= '<h3><a name="'.$row['feedback_id'].'" href="'.$row['feedback_url'].'">'.$row['feedback_name'].'</a> said:</h3><p class="'.$flag.'">'.$row['feedback'].'</p><p class="commentfoot">on '.$row['feedback_date'].'</p>';
			if($flag == 'odd') {
				$flag = 'even';
			}else{
				$flag = 'odd';
			}
		}
		return $feedbackStr;
	}
	function format_date($date, $dateForm = DATE_FORMAT){
		list($date1, $time1) = split('[ ]', $date);
		list($year, $month, $day) = split('[-]', $date1);
		list($hours, $minutes, $seconds) = split('[:]', $time1);
		$timestamp = mktime($hours, $minutes, $seconds, $month, $day, $year);
		return date($dateForm, $timestamp);
	}
	function getVariables(){
		global $db;
		return $db->query("SELECT
							  var_name, var_value
					  FROM
							  config");
	}
	function getEvents(){
		global $db;
		$sql_get_events = "SELECT
                                event_id, event_name, event_desc, event_datetime
							FROM
								events
							WHERE
								event_datetime > SYSDATE() 
							ORDER BY
								event_datetime
							LIMIT 1";
		return $db->query($sql_get_events);
	}
?>