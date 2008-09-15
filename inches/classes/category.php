<?php
    class Category {
        var $cat_id;
        var $cat_name;
        var $cat_posts;
        var $cat_page;
        var $cat_total_posts;
        var $cat_total_pages;
        var $cat_start;
        var $cat_end;
        var $cat_paging;
                
        function Category($cat_name, $cat_page = 1){
            $this->cat_name = $cat_name;
            $this->cat_page = $cat_page;
            $this->get_cat_details();
        }
        function total_posts(){
			global $db;
            $get_total_posts = "SELECT
                                        post_id
                                FROM
                                        post_to_cat
                                WHERE
                                        cat_id = '". $this->cat_id ."'";
            return count($db->query($get_total_posts));
        }
        function get_details(){
            $this->cat_total_posts = $this->total_posts();
            $this->cat_total_pages = ceil($this->cat_total_posts/PER_PAGE);	    
            $this->cat_start = (($this->cat_page - 1) * PER_PAGE);
            $this->cat_end = PER_PAGE;
            $this->cat_paging = $this->get_paging();
        }
        function get_paging($xtraParams = ''){
            // how many pages we have when using paging?
            $maxPage = $this->cat_total_pages;
            $rowsPerPage = PER_PAGE;
            $pageNum = $this->cat_page;

            $self = $_SERVER['PHP_SELF'];

            // creating 'previous' and 'next' link
            // plus 'first page' and 'last page' link

            // print 'previous' link only if we're not
            // on page one
            if ($pageNum > 1){
                    $page = $pageNum - 1;
                    $prev = '<a href="'.HTTP_SERVER.'category/'.$this->cat_name.'/'.$page.'">[Prev]</a> ';
		    $first = '<a href="'.HTTP_SERVER.'category/'.$this->cat_name.'/1">[First Page]</a> ';
            } /*else{
                    $prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
                    $first = ' [First Page] '; // nor 'first page' link
            }*/

            // print 'next' link only if we're not
            // on the last page
            if ($pageNum < $maxPage){
                    $page = $pageNum + 1;
		    $next = '<a href="'.HTTP_SERVER.'category/'.$this->cat_name.'/'.$page.'">[Next]</a> ';
		    $last = '<a href="'.HTTP_SERVER.'category/'.$this->cat_name.'/'.$maxPage.'">[Last Page]</a> ';
            } /*else{
                    $next = ' [Next] ';      // we're on the last page, don't enable 'next' link
                    $last = ' [Last Page] '; // nor 'last page' link
            }*/

            // print the page navigation link
            return $first . $prev . " Page <strong>$pageNum</strong> of <strong>$maxPage</strong> page(s) " . $next . $last;
	}
        function get_cat_details(){
			global $db;
            $get_cat = "SELECT
                                cat_id
                        FROM
                                cats
                        WHERE
                       
					            cat_name = '". $this->cat_name ."'
						LIMIT 1";
            $result_cat = $db->query($get_cat);
            if(count($result_cat)>0){
                $this->cat_id = $result_cat[0]['cat_id'];
                $this->cat_posts = $this->get_cat_posts();
            }else{
                return false;
            }
        }
        function get_cat_posts(){
			global $db;
            $this->get_details();
            $get_post = "SELECT
                                post_id
                        FROM
                                post_to_cat
                        WHERE
                                cat_id = '". $this->cat_id  ."'
                        LIMIT ".$this->cat_start . ',' . $this->cat_end;
            return $db->query($get_post);
        }
    }
?>