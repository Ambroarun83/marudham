<?php
session_start();

include("../../ajaxconfig.php");

if(isset($_SESSION['userid'])){ //fetch if user has cash tally admin access or not
    $user_id = $_SESSION['userid'];
    $qry = $con->query("SELECT cash_tally_admin from user where user_id = $user_id");
    $admin_access = $qry->fetch_assoc()['cash_tally_admin'];
}else{
    $admin_access = '1';
}


$bank_id = $_POST['bank_id'];
$from_date = $_POST['from_date'];
$to_date = $_POST['to_date'];


$i= 1;


$qry = $con->query("SELECT * from bank_stmt where bank_id = '$bank_id' and (date(trans_date) >= date('$from_date') and date(trans_date) <= date('$to_date') ) and insert_login_id = '$user_id' ");
// fetching details of bank statement where same user id and bank id,transaction date should be in range of from date and to date which is user selected last



?>


<table class="table custom-table">
    <thead>
        <th width='50'>S.No</th>
        <th>Date</th>
        <th>Tansaction ID</th>
        <th>Credit</th>
        <th>Debit</th>
        <th>Balance</th>
        <th>Clear Category</th>
        <th>Ref ID</th>
        <th>Clearance</th>
    </thead>
    <tbody>
        <?php
        while($row = $qry->fetch_assoc()){ ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $row['trans_date'];?></td>
                <td><?php echo $row['trans_id'];?></td>
                <td><?php echo $row['credit'];?></td>
                <td><?php echo $row['debit'];?></td>
                <td><?php echo $row['balance'];?></td>
                <td><?php if($row['credit'] != ''){ echo runcreditCategories($con,$admin_access); }elseif($row['debit'] !=''){echo rundebitCategories($con,$admin_access); } ?></td>
                <td><?php echo "<select class='form-control ref-id' ><option value=''>Select Ref ID</option></select>"; ?></td>
                <td><?php echo "<input type='text' class='form-control clr-status' readonly placeholder='Please Choose Ref ID' value=''>"; ?></td>
            </tr>
        <?php 
            $i++; 
        }
        ?>
    </tbody>
</table>

<?php

function runcreditCategories($con,$admin_access){

    $catqry = "SELECT * from cash_tally_modes where bankcredit = 0  ";
    if($admin_access == '1'){
        $catqry .= "and admin_access = 1 ";
    }
    
    $runqry = $con->query($catqry);
    
    $selectTxt = "<select class='form-control clr_cat' ><option value=''>Select Category</option>";
    while($catrow = $runqry->fetch_assoc()){
        $selectTxt .= "<option value='".$catrow['id']."'>".$catrow['modes']."</option>";
    }
    $selectTxt .= "</select>";
    
    return $selectTxt;
}

function rundebitCategories($con,$admin_access){

    $catqry = "SELECT * from cash_tally_modes where bankdebit = 0  ";
    if($admin_access == '1'){
        $catqry .= "and admin_access = 1 ";
    }
    
    $runqry = $con->query($catqry);
    
    $selectTxt = "<select class='form-control clr_cat' ><option value=''>Select Category</option>";
    while($catrow = $runqry->fetch_assoc()){
        $selectTxt .= "<option value='".$catrow['id']."'>".$catrow['modes']."</option>";
    }
    $selectTxt .= "</select>";

    return $selectTxt;
}

?>