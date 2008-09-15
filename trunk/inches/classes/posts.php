<?php
    class Posts {
        var $post_posts;
        var $post_page;
        var $post_total_posts;
        var $post_total_pages;
        var $post_start;
        var $post_end;
        var $post_paging;
                
        function Posts($post_page = 1){
            $this->post_page = $post_page;
            $this->get_post_details();
        }
        function total_posts(){
			global $db;
            $get_total_posts = "SELECT
                                        post_id
                                FROM
                                        posts
								WHERE
									post_delete = '1'";
			return count($db->query($get_total_posts));
        }
        function get_details(){
            $this->post_total_posts = $this->total_posts();
            $this->post_total_pages = ceil($this->post_total_posts/PER_PAGE);
            $this->post_start = (($this->post_page - 1) * PER_PAGE);
            $this->post_end = PER_PAGE;
            $this->post_paging = $this->get_paging();
        }
        function get_paging($xtraParams = ''){
            // how many pages we have when using paging?
            $maxPage = $this->post_total_pages;
            $rowsPerPage = PER_PAGE;
            $pageNum = $this->post_page;

            $self = $_SERVER['PHP_SELF'];

            // creating 'previous' and 'next' link
            // plus 'first page' and 'last page' link

            // print 'previous' link only if we're not
            // on page one
            if ($pageNum > 1){
                    $page = $pageNum - 1;
                    $prev = '<a href="'.HTTP_SERVER.$page.'">[Prev]</a> ';
		    		$first = '<a href="'.HTTP_SERVER.'1">[First Page]</a> ';
            } /*else{
                    $prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
                    $first = ' [First Page] '; // nor 'first page' link
            }*/

            // print 'next' link only if we're not
            // on the last page
            if ($pageNum < $maxPage){
                    $page = $pageNum + 1;
		    $next = '<a href="'.HTTP_SERVER.$page.'">[Next]</a> ';
		    $last = '<a href="'.HTTP_SERVER.$maxPage.'">[Last Page]</a> ';
            } /*else{
                    $next = ' [Next] ';      // we're on the last page, don't enable 'next' link
                    $last = ' [Last Page] '; // nor 'last page' link
            }*/

            // print the page navigation link
            return $first . $prev . " Page <strong>$pageNum</strong> of <strong>$maxPage</strong> page(s) " . $next . $last;
	}
        function get_post_details(){
                 $this->post_posts = $this->get_post_posts();
        }
        function get_post_posts(){
			global $db;
            $this->get_details();
            $get_post = "SELECT
                                post_id
                        FROM
                                posts
						WHERE
								post_delete = '1'
						ORDER BY
								post_created DESC 
                        LIMIT ".$this->post_start . ',' . $this->post_end;
			return $db->query($get_post);
        }
    }
?>