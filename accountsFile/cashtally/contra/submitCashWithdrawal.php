<?php
session_start();
$user_id = $_SESSION['userid'];

include('../../../ajaxconfig.php');


$ref_code = $_POST['ref_code'];
$trans_id = $_POST['trans_id'];
$from_bank = $_POST['from_bank'];
$cheque = $_POST['cheque'];
$remark = $_POST['remark'];
$amt = $_POST['amt'];


//////////// Once again fetch code /////////////
$myStr = "WD";
$selectIC = $con->query("SELECT ref_code FROM ct_db_cash_withdraw WHERE ref_code != '' ");
if($selectIC->num_rows>0)
{
    $codeAvailable = $con->query("SELECT ref_code FROM ct_db_cash_withdraw WHERE ref_code != '' ORDER BY id DESC LIMIT 1");
    while($row = $codeAvailable->fetch_assoc()){
        $ac2 = $row["ref_code"];
    }
    $appno2 = ltrim(strstr($ac2, '-'), '-'); $appno2 = $appno2+1;
    $ref_code = $myStr."-". "$appno2";
}
else
{
    $initialapp = $myStr."-100001";
    $ref_code = $initialapp;
}
/////////////////////////////////////////////

$qry = $con->query("INSERT INTO `ct_db_cash_withdraw`( `from_bank_id`, `ref_code`, `trans_id` , `cheque_no` , `remark`, `amt`, `insert_login_id`, `created_date`) 
    VALUES ('".$from_bank."','".$ref_code."','".$trans_id."','".$cheque."','".$remark."','".$amt."','".$user_id."',now())");

if($qry){
    $response = 'Submitted Successfully';
}else{
    $response = 'Error';
}

echo $response;

?>