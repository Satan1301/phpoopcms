<?php
    class Tag {
        var $tag_id;
        var $tag_name;
	var $tag_created;
                
        function Tag($tag_id, $task = ''){
            if($task == ''){
                $this->tag_name = $tag_id;
                $this->get_tag_details();                
            }elseif($task == 'edit'){
                $this->tag_id = $tag_id;
            }
        }
        function add_tag($tag_name){
			$add_tag = "INSERT INTO
                            tags(tag_id, tag_name, tag_created)
                        VALUES ";
			for($i = 0; $i < count($tag_name); $i++){
	            $add_tag .= "(NULL, '".$tag_name[$i]."', '".date("Y-m-d H:i:s")."'),";
			}
			$add_tag = substr($add_tag, 0, -1);
            if(mysql_query($add_tag)){
                return true;
            }else{
                return false;
            }
        }
        function update_tag($tag_name){
            $update_tag = "UPDATE 
                                tags
                            SET
                                tag_name = '".$tag_name."',
								tag_modified = '".date("Y-m-d H:i:s")."'
                            WHERE
                                tag_id = ".$this->tag_id;
            if(mysql_query($update_tag)){
                return true;
            }else{
                return false;
            }
        }
        function delete_tag(){
            $delete_tag = "DELETE FROM
                                tags
                            WHERE
                                tag_id = ".$this->tag_id;
            if(mysql_query($delete_tag)){
                return true;
            }else{
                return false;
            }
        }
        function get_tag_details(){
            $get_tag = "SELECT
                                tag_id, tag_name, tag_created
                        FROM
                                tags
			WHERE
				tag_name = '" . $this->tag_name . "'";
            $result_tag = mysql_query($get_tag);
            if($result_tag){
                $row = mysql_fetch_assoc($result_tag);
                $this->tag_id = $row['tag_id'];
		$this->tag_created = $row['tag_created'];
            }else{
                return false;
            }
        }
    }
?>