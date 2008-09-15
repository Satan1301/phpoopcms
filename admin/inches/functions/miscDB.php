<?php
    function connectDB(){
        $myconn = mysql_connect(DBHOST, DBUSER, DBPASS);
        mysql_select_db(DBNAME, $myconn);
    }
    function getPosts(){
        $sql_get_posts = "SELECT
                                post_link
                        FROM
                                posts
                        ORDER BY
								post_created
						DESC";
        return mysql_query($sql_get_posts);
    }
    function getCats(){
        $sql_get_cats = "SELECT
                                cat_name, cat_id, cat_created
                        FROM
                                cats
                        ORDER BY
                                cat_name";
        return mysql_query($sql_get_cats);
    }	
    function getTags(){
        $sql_get_tags = "SELECT
                                tag_name, tag_id, tag_created
                        FROM
                                tags";
        return mysql_query($sql_get_tags);
    }
    function getVars(){
        $sql_get_vars = "SELECT
                                var_id
                        FROM
                                config";
        return mysql_query($sql_get_vars);
    }
    function getEvents(){
        $sql_get_events = "SELECT
                                event_id, event_name, event_desc, event_datetime
                        FROM
                                events";
        return mysql_query($sql_get_events);
    }
    function getPostsForSite(){
        $sql_get_posts = "SELECT
                                post_link, 
								left(post_modified, 10) AS post_mod
                        FROM
                                posts
						WHERE
								post_delete = 1
                        ORDER BY
                                post_id
                        ASC";
        return mysql_query($sql_get_posts);
    }
    function getCatsForSite(){
        $sql_get_cats = "SELECT
                                cat_name, 
								left(cat_created, 10) AS cat_mod
                        FROM
                                cats
                        ORDER BY
                                cat_id
                        ASC";
        return mysql_query($sql_get_cats);
    }
    function getTagsForSite(){
        $sql_get_tags = "SELECT
                                tag_name, 
								left(tag_created, 10) AS tag_mod
                        FROM
                                tags
                        ORDER BY
                                tag_id
                        ASC";
        return mysql_query($sql_get_tags);
    }
    function getPostsForRSS(){
        $sql_get_posts = "SELECT
                                post_h1, post_h2, post_link, post_ps, post_created
                        FROM
                                posts
						WHERE
								post_delete =1
                        ORDER BY
                                post_id
                        DESC 
						LIMIT 0, 15";
        return mysql_query($sql_get_posts);
    }
    function formTagCloud(){
        $allTags = getTags();
        while($row = mysql_fetch_assoc($allTags)){
            echo '<span class="tag'.rand(1, 4).'">
                    <a href="'.HTTP_SERVER.'tag/'.$row['tag_name'].'" title="'.$row['tag_name'].'">'
                      .$row['tag_name'].
                    '</a>'.
                  '</span>';
        }
    }
	function getTagList($tag_result){
		$tagStr = '';
		while($row = mysql_fetch_assoc($tag_result)){
			$tagStr .= '<a href="'.HTTP_SERVER.'tag/'.$row['tag_name'].'" title="'.$row['tag_name'].'">'.$row['tag_name'].'</a> ';
		}
		return $tagStr;
	}
	function getCatList($cat_result){
		$catStr = '';
		while($row = mysql_fetch_assoc($cat_result)){
			$catStr .= '<a class="cat" href="'.HTTP_SERVER.'category/'.$row['cat_name'].'" title="'.$row['cat_name'].'">'.$row['cat_name'].'</a> ';
		}
		return $catStr;
	}
	function getComments($comment_result){
		$commentStr = '';
		$flag = 'odd';
		while($row = mysql_fetch_assoc($comment_result)){
			$commentStr .= '<h3>'.$row['comment_name'].' said:</h3><p class="'.$flag.'">'.$row['comment'].'</p><p class="commentfoot">on '.$row['comment_date'].'</p>';
			if($flag == 'odd') {
				$flag = 'even';
			}else{
				$flag = 'odd';
			}
		}
		return $commentStr;
	}
?>