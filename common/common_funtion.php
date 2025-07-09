<?php
function insertData($table,$mysqli,$values){
    $column = [];
    $data = [];
    foreach($values as $key => $value){
        $column []=$key;
        $data[]="'" . $value . "'";
    }
    $columns = implode(", " , $column);
    $data_value = implode(", ",$data);
    $sql = "INSERT INTO `$table` 
            ($columns)
            VALUES
            ($data_value)";
    // var_dump($sql);
    // die();  
    return $mysqli->query($sql);
}

function selectData($table,$mysqli,$where='',$select='*',$order=''){
    $sql = "SELECT $select FROM $table WHERE $where $order";
    return $mysqli->query($sql);
}
?>