<?php
session_start();
include '../ajaxconfig.php';

if(isset($_POST["pending_sts"])){
    $pending_sts = explode(',',$_POST["pending_sts"]);
}
if(isset($_POST["od_sts"])){
    $od_sts = explode(',',$_POST["od_sts"]);
}
if(isset($_POST["due_nil_sts"])){
    $due_nil_sts = explode(',',$_POST["due_nil_sts"]);
}
if(isset($_POST["closed_sts"])){
    $closed_sts = explode(',',$_POST["closed_sts"]);
}

?>


<table class="table custom-table" id='dataCheckTable'>
    <thead>
    <tr>
        <th width="15">S.No</th>
		<th>Customer ID</th>
		<th>Custommer Name</th>            
		<th>Mobile Number</th>
		<th>Guarentor Name</th>
		<th>Status</th>
        <th>Sub Status</th>
	</tr>
    </thead>
    <tbody>
	<?php

	$cus_id = $_POST['cus_id'];
	$guarentorInfo = $connect->query("SELECT acp.id as acpID, acp.req_id, acp.cus_id,acp.cus_name,acp.mobile1,vfi.famname,vfi.relation_aadhar,ii.cus_status as ii_sts FROM `acknowlegement_customer_profile` acp  JOIN `verification_family_info` vfi  on acp.guarentor_name = vfi.id  JOIN `in_issue` ii ON acp.req_id = ii.req_id WHERE vfi.relation_aadhar ='".strip_tags($cus_id)."' && ii.cus_status >= 13  ");

	$i = 0;
	while ($guarentor = $guarentorInfo->fetch()) {
	?>
		<tr>
			<td> <?php  ?></td>
			<td> <?php  echo $guarentor['cus_id']; ?></td>
			<td> <?php  echo $guarentor['cus_name']; ?></td>
			<td> <?php  echo $guarentor['mobile1']; ?></td>
			<td> <?php  echo $guarentor['famname']; ?></td>
			<td><?php if($guarentor['ii_sts'] < 20){echo 'Present';}else if($guarentor['ii_sts'] >= 20){ echo 'Closed';} ?></td>  <!-- Status -->
			<td><?php if($guarentor['ii_sts'] == 13){
						echo 'In Issue';
					}
						else if($pending_sts[$i] == 'true' && $od_sts[$i] == 'false'){
						if($guarentor['ii_sts'] == '15'){
							echo 'Error';
						}elseif($guarentor['ii_sts']== '16'){
							echo 'Legal';
						}else{
							echo 'Pending';
						}
					}else if($od_sts[$i] == 'true'){
						if($guarentor['ii_sts'] == '15'){
							echo 'Error';
						}elseif($guarentor['ii_sts']== '16'){
							echo 'Legal';
						}else{
							echo 'OD';
						}
					}elseif($due_nil_sts[$i] == 'true'){
						if($guarentor['ii_sts'] == '15'){
							echo 'Error';
						}elseif($guarentor['ii_sts']== '16'){
							echo 'Legal';
						}else{
							echo 'Due Nil';
						}
					}elseif($pending_sts[$i] == 'false'){
						if($guarentor['ii_sts'] == '15'){
							echo 'Error';
						}elseif($guarentor['ii_sts']== '16'){
							echo 'Legal';
						}else{
							if($closed_sts[$i] == 'true'){
								echo "Closed";
							}else{
								echo 'Current';
							}
						}
					} 
					$i++;?></td> <!-- Sub status -->
		</tr>
	<?php
	}
	?>
    </tbody>
</table>

<script type="text/javascript">
    $(function() {
        $('#dataCheckTable').DataTable({
            'processing': true,
            'iDisplayLength': 5,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "createdRow": function(row, data, dataIndex) {
                $(row).find('td:first').html(dataIndex + 1);
            },
            "drawCallback": function(settings) {
                this.api().column(0).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            },
        });
    });
</script>