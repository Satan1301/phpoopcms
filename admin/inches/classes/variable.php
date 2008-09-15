<?php
    class Variable {
        var $var_id;
        var $var_name;
	var $var_value;
	var $var_created;
                
        function Variable($var_id, $task = ''){
            if($task == ''){
                $this->var_id = $var_id;
                $this->get_var_details();                
            }elseif($task == 'edit'){
                $this->var_id = $var_id;
            }
        }
        function add_variable($var_name, $var_value){
            $add_var = "INSERT INTO
                            config(var_id, var_name, var_value)
                        VALUES(NULL, '".$var_name."', '".$var_value."')";
            if(mysql_query($add_var)){
                return true;
            }else{
                return false;
            }
        }
        function update_variable($var_name, $var_value){
            $update_var = "UPDATE 
                                config
                            SET
                                var_name = '".$var_name."',
                                var_value = '".htmlentities($var_value)."',
                                var_modified = '".date("Y-m-d H:i:s")."'
                            WHERE
                                var_id = ".$this->var_id;
            if(mysql_query($update_var)){
                return true;
            }else{
                return false;
            }
        }
        function delete_variable(){
            $delete_var = "DELETE FROM
                                vars
                            WHERE
                                var_id = ".$this->var_id;
            if(mysql_query($delete_var)){
                return true;
            }else{
                return false;
            }
        }
        function get_var_details(){
            $get_var = "SELECT
                                var_name, var_value, var_created
                        FROM
                                config
			WHERE
				var_id = '" . $this->var_id . "'";
            $result_var = mysql_query($get_var);
            if($result_var){
                $row = mysql_fetch_assoc($result_var);
                $this->var_name = $row['var_name'];
				$this->var_value = $row['var_value'];
				$this->var_created = $row['var_created'];
            }else{
                return false;
            }
        }
    }
?>