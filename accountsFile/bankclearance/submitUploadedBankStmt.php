<?php
// error_reporting(0);
@session_start();
$user_id = $_SESSION["userid"];
include("../../ajaxconfig.php");

$bank_id = $_POST['bank_id'];
$acc_no = $_POST['acc_no'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];


require_once('../../vendor/csvreader/php-excel-reader/excel_reader2.php');
require_once('../../vendor/csvreader/SpreadsheetReader.php');
if(isset($_FILES["file"]["type"])){
    $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    if(in_array($_FILES["file"]["type"],$allowedFileType)){
        
        
        $targetPath = '../../uploads/bank_stmt/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new SpreadsheetReader($targetPath);
        $sheetCount = count($Reader->sheets()); 
        
        for($i=0;$i<$sheetCount;$i++)
        {
            $Reader->ChangeSheet($i);
            foreach ($Reader as $Row){ 
                if($Row[0] != "Date"){
                    

                    $trans_date = "";
                    if(isset($Row[0])) {
                        
                        $date = DateTime::createFromFormat('m-d-y', $Row[0]);
                        if ($date) {
                            $trans_date = $date->format('Y-m-d');
                        }
                    }
                    
                    $trans_id = "";
                    if(isset($Row[1])) {
                        $trans_id = mysqli_real_escape_string($con,$Row[1]); 
                    }
                    
                    $credit = "";
                    if(isset($Row[2])) {
                        $credit = mysqli_real_escape_string($con,$Row[2]); 
                    }
                    
                    $debit = "";
                    if(isset($Row[3])) {
                        $debit = mysqli_real_escape_string($con,$Row[3]); 
                    }
                    
                    $balance = "";
                    if(isset($Row[4])) {
                        $balance = mysqli_real_escape_string($con,$Row[4]); 
                    }
                    
    
                    if($i==0 && $trans_date != "" && $trans_id != "" )
                    { 
                        $insert=$con->query("INSERT INTO `bank_stmt`(`bank_id`, `trans_date`, `trans_id`, `credit`, `debit`, `balance`, `insert_login_id`, `created_date`) 
                        VALUES ('$bank_id','$trans_date','$trans_id','$credit','$debit','$balance','$user_id',now() )");
                    }
                    
                }
            }
        }

        if($con->affected_rows > 0) {
            $message = 0; // if successfully inserted
        }
        else{
            $message = 1; // if insert query not working
        }
    }
}else{
    $message = 2; //if file is not sent
}

echo $message;
?>

    