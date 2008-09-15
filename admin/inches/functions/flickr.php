<?php
    function getFlickrLinks($limit){
        $strURL = 'http://api.flickr.com/services/feeds/photos_public.gne?id=85538283@N00&lang=en-us&format=rss_200';
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