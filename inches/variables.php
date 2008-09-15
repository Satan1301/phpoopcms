<?php
    $list_var = getVariables();
    foreach($list_var as $row){
        define($row['var_name'], html_entity_decode($row['var_value']));
    }
?>