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
    $sql = "SELECT $select FROM $table  $where $order";
    return $mysqli->query($sql);
}

function updateData($table,$mysqli,$values,$where){
    $sql = "UPDATE `$table` SET ";
    $updates = [];
    foreach($values as $key=>$value){
        $updates[] = "$key = '$value'";
    }
    $sql.=implode(",",$updates);
    $wheres = [];
    $sql.= " WHERE ";
    foreach($where as $key=>$value)
    {
        $wheres[]="$key = '$value'";
    }
    $sql.= implode(" AND",$wheres);
    // var_dump($sql);
    // die();
    return $mysqli->query($sql);
}

function deleteData($table,$mysqli,$where=''){
    $sql = "DELETE FROM $table $where";
    return $mysqli->query($sql);
}
?>