<?php
    class Category {
        var $cat_id;
        var $cat_name;
	var $cat_desc;
	var $cat_created;
                
        function Category($cat_id, $task = ''){
            if($task == ''){
                $this->cat_name = $cat_id;
                $this->get_cat_details();                
            }elseif($task == 'edit'){
                $this->cat_id = $cat_id;
            }
        }
        function add_category($cat_name, $cat_desc){
            $add_cat = "INSERT INTO
                            cats(cat_id, cat_name, cat_desc, cat_created)
                        VALUES(NULL, '".$cat_name."', '".$cat_desc."', '".date("Y-m-d H:i:s")."')";
            if(mysql_query($add_cat)){
                return true;
            }else{
                return false;
            }
        }
        function update_category($cat_name, $cat_desc){
            $update_cat = "UPDATE 
                                cats
                            SET
                                cat_name = '".$cat_name."',
                                cat_desc = '".$cat_desc."',
								cat_modified = '".date("Y-m-d H:i:s")."'
                            WHERE
                                cat_id = ".$this->cat_id;
            if(mysql_query($update_cat)){
                return true;
            }else{
                return false;
            }
        }
        function delete_category(){
            $delete_cat = "DELETE FROM
                                cats
                            WHERE
                                cat_id = ".$this->cat_id;
            if(mysql_query($delete_cat)){
                return true;
            }else{
                return false;
            }
        }
        function get_cat_details(){
            $get_cat = "SELECT
                                cat_id, cat_name, cat_desc, cat_created
                        FROM
                                cats
			WHERE
				cat_name = '" . $this->cat_name . "'";
            $result_cat = mysql_query($get_cat);
            if($result_cat){
                $row = mysql_fetch_assoc($result_cat);
                $this->cat_id = $row['cat_id'];
		$this->cat_desc = $row['cat_desc'];
		$this->cat_created = $row['cat_created'];
            }else{
                return false;
            }
        }
    }
?>