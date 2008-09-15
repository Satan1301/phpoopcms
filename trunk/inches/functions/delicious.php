<?php
    function getDelLinks($username, $limit){
        $strURL = 'http://feeds.delicious.com/rss/'.$username;
        if($handle = fopen($strURL, "rb")){
            $contents = stream_get_contents($handle);
            $doc = new DOMDocument();
            $doc->loadXML($contents);
            $items = $doc->getElementsByTagName("item");
            $strHTML = '';
            //			$strHTML = '<ul>';
            for($i = 0; $i < $limit; $i++){
                $item = $items->item($i);
                $title = $item->firstChild->nextSibling;
                $link = $title->nextSibling->nextSibling;
                $strHTML .= '<li>';
                $strHTML .= '<a href="'.$link->nodeValue.'" title="'.$title->nodeValue.'">'.$title->nodeValue.'</a>';
                $strHTML .= '</li>';
            }
            //			$strHTML .= '</ul>';
            fclose($handle);
            return $strHTML;
        }
    }
?>