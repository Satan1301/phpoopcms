<?php
	function url_redirect($url,$permanent = false){
		if($permanent){
			header('HTTP/1.1 301 Moved Permanently');
		}
		header('Location: '.$url);
		exit;
	}
	function stripString($string, $limit, $break=" ", $pad="...") {
		// return with no change if string is shorter than $limit
		if(strlen($string) <= $limit) return $string;
		// is $break present between $limit and the end of the string?
		if(false !== ($breakpoint = strpos($string, $break, $limit))) {
			if($breakpoint < strlen($string) - 1) {
				$string = substr($string, 0, $breakpoint) . $pad;
			}
		}
		return $string;
	}
	function stripslashes_if_gpc_magic_quotes( $string ) {
	    if(get_magic_quotes_gpc()) {
		return stripslashes($string);
	    } else {
		return $string;
	    }
	}
?>