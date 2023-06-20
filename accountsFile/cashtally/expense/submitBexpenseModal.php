<?php
session_start();
$user_id = $_SESSION['userid'];

include('../../../ajaxconfig.php');

$response = '';

$username = $_POST['username'];
$usertype = $_POST['usertype'];
$ref_code = $_POST['ref_code'];
$bank_id = $_POST['bank_id'];
$cat = $_POST['cat'];
$part = $_POST['part'];
$vou_id = $_POST['vou_id'];
$rec_per = $_POST['rec_per'];
$remark = $_POST['remark'];
$amt = $_POST['amt'];

if(isset($_FILES['upd'])){
    $upd = $_FILES['upd']['name'];
    $pic_temp = $_FILES['upd']['tmp_name'];
    $picfolder="../../../uploads/expenseBill/".$upd ;
    $fileExtension = pathinfo($picfolder, PATHINFO_EXTENSION);//get the file extention
    
    if(!file_exists($picfolder)){
        move_uploaded_file($pic_temp, $picfolder);
    }else{
        // File already exists
        // Generate a new file name
        $upd = uniqid() . '.' . $fileExtension;
        // Move the file to the new file name
        move_uploaded_file($pic_temp, "../../../uploads/expenseBill/" . $upd);
    }
}else{
    $upd='';
}
    

//////////////////////// To get Expense reference Code once again /////////////////////////
$myStr = "EXP";
$selectIC = $con->query("SELECT ref_code FROM ct_db_bexpense WHERE ref_code != '' ");
if($selectIC->num_rows>0)
{
    $codeAvailable = $con->query("SELECT ref_code FROM ct_db_bexpense WHERE ref_code != '' ORDER BY id DESC LIMIT 1");
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


//////////////////////////////////////////////////////////////////////////////////




$qry = $con->query("INSERT INTO `ct_db_bexpense`(`username`, `usertype`,`ref_code`,`bank_id`, `cat`, `part`, `vou_id`, `rec_per`, `remark`, `amt`, `upload`, `insert_login_id`, `created_date`) 
VALUES ('$username','$usertype','$ref_code','$bank_id','$cat','$part','$vou_id','$rec_per','$remark','$amt','$upd','$user_id',now())");


if($qry){
    $response = "Submitted Successfully";
}else{
    $response = "Error While Submit";
}

echo $response;


?>