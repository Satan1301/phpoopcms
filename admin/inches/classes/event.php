<?php
    class Event {
        var $event_id;
        var $event_name;
        var $event_created;
        var $event_desc;
        var $event_datetime;
                
        function Event($event_id = 0, $task = ''){
            if($task == ''){
                $this->event_id = $event_id;
                $this->get_event_details();                
            }elseif($task == 'edit'){
                $this->event_id = $event_id;
            }
        }
        function add_event($event_name, $event_datetime, $event_desc){
            $add_event = "INSERT INTO
                            events(event_id, event_name, event_desc, event_datetime, event_created)
                        VALUES (NULL, '".$event_name."','".$event_desc."','".$event_datetime."','".date("Y-m-d H:i:s")."')";                        
            if(mysql_query($add_event)){
                return true;
            }else{
                return false;
            }
        }
        function update_event($event_name, $event_datetime, $event_desc){
            $update_event = "UPDATE 
                                events
                            SET
                                event_name = '".$event_name."',
                                event_desc = '".$event_desc."',
                                event_datetime = '".$event_datetime."',
                                event_modified = '".date("Y-m-d H:i:s")."'
                            WHERE
                                event_id = ".$this->event_id;
            if(mysql_query($update_event)){
                return true;
            }else{
                return false;
            }
        }
        function delete_event(){
            $delete_event = "DELETE FROM
                                events
                            WHERE
                                event_id = ".$this->event_id;
            if(mysql_query($delete_event)){
                return true;
            }else{
                return false;
            }
        }
        function get_event_details(){
            $get_event = "SELECT
                                event_id, event_name, event_desc, event_datetime
                        FROM
                                events
                        WHERE
                                event_id = '" . $this->event_id . "'";
            $result_event = mysql_query($get_event);
            if($result_event){
                $row = mysql_fetch_assoc($result_event);
                $this->event_name = $row['event_name'];
                $this->event_desc = $row['event_desc'];
                $this->event_datetime = $row['event_datetime'];
            }else{
                return false;
            }
        }
    }
?>