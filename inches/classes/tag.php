<?php
    class Tag {
        var $tag_id;
        var $tag_name;
        var $tag_posts;	
        var $tag_page;
        var $tag_total_posts;
        var $tag_total_pages;
        var $tag_start;
        var $tag_end;
        var $tag_paging;
                
        function Tag($tag_name, $tag_page = 1){
            $this->tag_name = $tag_name;
            $this->tag_page = $tag_page;
            $this->get_tag_details();
        }
        function total_posts(){
			global $db;
            $get_total_posts = "SELECT
                                        post_id
                                FROM
                                        post_to_tag
                                WHERE
                                        tag_id = '". $this->tag_id ."'";
            return count($db->query($get_total_posts));
        }
        function get_details(){
            $this->tag_total_posts = $this->total_posts();
            $this->tag_total_pages = ceil($this->tag_total_posts/PER_PAGE);
            $this->tag_start = (($this->tag_page - 1) * PER_PAGE);
            $this->tag_end = PER_PAGE;
        }
        function get_paging($xtraParams = ''){
            // how many pages we have when using paging?
            $maxPage = $this->tag_total_pages;
            $rowsPerPage = PER_PAGE;
            $pageNum = $this->tag_page;

            $self = $_SERVER['PHP_SELF'];

            // creating 'previous' and 'next' link
            // plus 'first page' and 'last page' link

            // print 'previous' link only if we're not
            // on page one
            if ($pageNum > 1){
                    $page = $pageNum - 1;
                    $prev = '<a href="'.HTTP_SERVER.'tag/'.$this->tag_name.'/'.$page.'">[Prev]</a> ';
		    $first = '<a href="'.HTTP_SERVER.'tag/'.$this->tag_name.'/1">[First Page]</a> ';
            } /*else{
                    $prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
                    $first = ' [First Page] '; // nor 'first page' link
            }*/

            // print 'next' link only if we're not
            // on the last page
            if ($pageNum < $maxPage){
                    $page = $pageNum + 1;
		    $next = '<a href="'.HTTP_SERVER.'tag/'.$this->tag_name.'/'.$page.'">[Next]</a> ';
		    $last = '<a href="'.HTTP_SERVER.'tag/'.$this->tag_name.'/'.$maxPage.'">[Last Page]</a> ';
            } /*else{
                    $next = ' [Next] ';      // we're on the last page, don't enable 'next' link
                    $last = ' [Last Page] '; // nor 'last page' link
            }*/

            // print the page navigation link
            return $first . $prev . " Page <strong>$pageNum</strong> of <strong>$maxPage</strong> page(s) " . $next . $last;
	}
        function get_tag_details(){
			global $db;
            $get_tag = "SELECT
                                tag_id
                        FROM
                                tags
                        WHERE
                                tag_name = '". $this->tag_name ."'";
            $result_tag = $db->query($get_tag);
            if(count($result_tag)>0){
                $row_tag = mysql_fetch_array($result_tag);
                $this->tag_id = $result_tag[0]['tag_id'];
                $this->tag_posts = $this->get_tag_posts();
            }else{
                return false;
            }
        }
        function get_tag_posts(){
			global $db;
            $this->get_details();
            $get_post = "SELECT
                                post_id
                        FROM
                                post_to_tag
                        WHERE
                                tag_id = '". $this->tag_id ."'
                        LIMIT ".$this->tag_start . ',' . $this->tag_end;
            return $db->query($get_post);
        }
    }
?>