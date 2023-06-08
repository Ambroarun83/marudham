<?php
session_start();
include('../../../ajaxconfig.php');

$user_id = $_SESSION['userid'];


$bank_id_arr=array();
$records=array();
$i =0;

$qry = $con->query("SELECT bank_details from `user` where `user_id` = $user_id ");
$values = $qry->fetch_assoc()['bank_details'];

if($values != ''){

    $bank_id_arr = explode(',',$values);

    foreach ($bank_id_arr as $val){

        $qry = $con->query("SELECT id,short_name,acc_no from bank_creation where id=$val");
        while($row = $qry->fetch_assoc()){
            $records[$i]['bank_id'] = $row['id'];
            $records[$i]['bank_name'] = $row['short_name'] .' - '. substr($row['acc_no'],-5) ;
            $i++;
        }
    }
}

echo json_encode($records);
?>