<?php 
session_start();
include('../ajaxconfig.php');

if(isset($_SESSION["userid"])){
    $userid = $_SESSION["userid"];
}
if(isset($_POST['req_id'])){
    $req_id = $_POST['req_id'];
}
if(isset($_POST['cus_status'])){
    $cus_status = $_POST['cus_status'];
}

    $selectIC = $con->query("UPDATE request_creation set cus_status = $cus_status, update_login_id = $userid WHERE  req_id = '".$req_id."' ") or die('Error on Request Table');
    $selectIC = $con->query("UPDATE customer_register set cus_status = $cus_status WHERE req_ref_id = '".$req_id."' ")or die('Error on Customer Table');
    $selectIC = $con->query("UPDATE in_verification set cus_status = $cus_status, update_login_id = $userid WHERE req_id = '".$req_id."' ")or die('Error on inVerification Table');
    $selectIC = $con->query("UPDATE `in_approval` SET `cus_status`= $cus_status,`update_login_id`= $userid WHERE  req_id = '".$req_id."' ") or die('Error on in_approval Table');
    $selectIC = $con->query("UPDATE `in_acknowledgement` SET `cus_status`= $cus_status,`update_login_id`= $userid WHERE  req_id = '".$req_id."' ") or die('Error on in_acknowledgement Table');
    $insertIssue = $con->query("UPDATE `in_issue` SET `cus_status`= $cus_status,`updated_date`=current_timestamp,`update_login_id` = $userid where req_id = '".$req_id."' ") or die('Error on in_issue Table');


?>