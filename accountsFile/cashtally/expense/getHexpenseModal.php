<?php
session_start();
$user_id = $_SESSION['userid'];

include('../../../ajaxconfig.php');

$i=0;
$records = array();

$qry = $con->query("SELECT fullname,role,user_id from user where user_id ='$user_id' ");
$row = $qry->fetch_assoc();
$records[0]['user_id'] = $row['user_id'];
$records[0]['user_name'] = $row['fullname'];
if($row['role'] == '1'){$records[0]['user_type'] = 'Director';}elseif($row['role'] == '3'){$records[0]['user_type'] = 'Staff';}

$qry = $con->query("SELECT * from expense_category where 1");
while($row = $qry->fetch_assoc()){
    $records[$i]['cat_id'] = $row['id'];
    $records[$i]['cat_name'] = $row['category'];
    $i++;
}

echo json_encode($records);


?>