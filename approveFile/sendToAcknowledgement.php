<?php 
session_start();
include('../ajaxconfig.php');
if (isset($_POST['req_id'])) {
    $req_id = $_POST['req_id'];
}
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
}


    $selectIC = $con->query("UPDATE request_creation set cus_status = 3, update_login_id = $userid WHERE  req_id = '".$req_id."' ") or die('Error on Request Table');
    $selectIC = $con->query("UPDATE customer_register set cus_status = 3 WHERE req_ref_id = '".$req_id."' ")or die('Error on Customer Table');
    $selectIC = $con->query("UPDATE in_verification set cus_status = 3, update_login_id = $userid WHERE req_id = '".$req_id."' ") or die('Error on inVerification Table');
    $selectIC = $con->query("UPDATE in_approval set `cus_status`= 3 where `req_id`= '".$req_id."' ") or die('Error on in-Approval Table');
    $insertACK = $con->query("INSERT INTO `in_acknowledgement`(`req_id`, `cus_id`, `cus_status`, `status`, `insert_login_id`) 
    SELECT req_id,cus_id,cus_status,status,update_login_id from in_verification where req_id = '".$req_id."' ");

$insertCusProfile = $con->query("INSERT INTO `acknowlegement_customer_profile`(`id`, `req_id`, `cus_id`, `cus_name`, `gender`, `dob`, `age`, `blood_group`, `mobile1`, `mobile2`, `whatsapp`, `cus_pic`, `guarentor_name`, `guarentor_relation`, `guarentor_photo`, `cus_type`, `cus_exist_type`, `residential_type`, `residential_details`, `residential_address`, `residential_native_address`, `occupation_type`, `occupation_details`, `occupation_income`, `occupation_address`, `area_confirm_type`, `area_confirm_state`, `area_confirm_district`, `area_confirm_taluk`, `area_confirm_area`, `area_confirm_subarea`, `area_group`, `area_line`, `communication`, `com_audio`, `verification_person`, `verification_location`, `cus_status`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`)
SELECT * FROM `customer_profile` WHERE `req_id`='$req_id' ");

$insertDocumentation = $con->query("INSERT INTO `acknowlegement_documentation`(`id`, `req_id`, `cus_id_doc`, `customer_name`, `cus_profile_id`, `doc_id`, `mortgage_process`, `Propertyholder_type`, `Propertyholder_name`, `Propertyholder_relationship_name`, `doc_property_relation`, `doc_property_type`, `doc_property_measurement`, `doc_property_location`, `doc_property_value`, `mortgage_name`, `mortgage_dsgn`, `mortgage_nuumber`, `reg_office`, `mortgage_value`, `mortgage_document`, `mortgage_document_upd`, `mortgage_document_pending`, `endorsement_process`, `owner_type`, `owner_name`, `ownername_relationship_name`, `en_relation`, `vehicle_type`, `vehicle_process`, `en_Company`, `en_Model`, `vehicle_reg_no`, `endorsement_name`, `en_RC`, `Rc_document_upd`, `Rc_document_pending`, `en_Key`, `gold_info`, `gold_sts`, `gold_type`, `Purity`, `gold_Count`, `gold_Weight`, `gold_Value`, `document_name`, `document_details`, `document_type`, `doc_info_upload`, `document_holder`, `docholder_name`, `docholder_relationship_name`, `doc_relation`, `cus_status`, `status`, `insert_login_id`, `update_login_id`, `delete_login_id`, `created_date`, `updated_date`)
SELECT * FROM `verification_documentation` WHERE `req_id` ='$req_id'");

$insertLoanCalc = $con->query("INSERT INTO `acknowlegement_loan_calculation`(`loan_cal_id`, `req_id`, `cus_id_loan`, `cus_name_loan`, `cus_data_loan`, `mobile_loan`, `pic_loan`, `loan_category`, `sub_category`, `tot_value`, `ad_amt`, `loan_amt`, `profit_type`, `due_method_calc`, `due_type`, `profit_method`, `calc_method`, `due_method_scheme`, `day_scheme`, `scheme_name`, `int_rate`, `due_period`, `doc_charge`, `proc_fee`, `loan_amt_cal`, `principal_amt_cal`, `int_amt_cal`, `tot_amt_cal`, `due_amt_cal`, `doc_charge_cal`, `proc_fee_cal`, `net_cash_cal`, `due_start_from`, `maturity_month`, `collection_method`, `cus_status`, `insert_login_id`, `update_login_id`, `create_date`, `update_date`)
SELECT * FROM `verification_loan_calculation` WHERE `req_id`='$req_id' ");

$insertLoanCat = $con->query("INSERT INTO `acknowledge_verif_loan_cal_category`(`cat_id`, `req_id`, `loan_cal_id`, `category`) SELECT * FROM `verif_loan_cal_category` WHERE `req_id`='$req_id'");


    $response = 'Verification Approved';
echo json_encode($response);
?>