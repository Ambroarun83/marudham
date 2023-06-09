<?php

if (isset($_GET['upd'])) {
	$idupd = $_GET['upd']; //Customer ID.
}

if (isset($_POST['submit_update_cus_profile']) && $_POST['submit_update_cus_profile'] != '') {

	$addUpdateCustomerProfile = $userObj->addUpdateCustomerProfile($mysqli, $userid);
?>
	<script>
		alert('Customer Profile Updated');
	</script>
	<?php
}

if(isset($_POST['update_documentation']) && $_POST['update_documentation'] != ''){

	$updateDoc = $userObj->addUpdateDocumentation($mysqli, $userid);
?>
	<script> alert('Documentation Details Updated'); </script>
<?php
}

//////////////////////// Customer Profile Info ///////////////////////////////
$getCustomerReg = $userObj->getCustomerRegister($mysqli, $idupd);
if (sizeof($getCustomerReg) > 0) {
	for ($i = 0; $i < sizeof($getCustomerReg); $i++) {
		$cus_reg_id				= $getCustomerReg['cus_reg_id'];
		$req_id					= $getCustomerReg['req_id'];
		$cus_id					= $getCustomerReg['cus_id'];
		$cus_name				= $getCustomerReg['cus_name'];
		$dob					= $getCustomerReg['dob'];
		$age					= $getCustomerReg['age'];
		$gender					= $getCustomerReg['gender'];
		$state					= $getCustomerReg['state'];
		$district				= $getCustomerReg['district'];
		$taluk					= $getCustomerReg['taluk'];
		$area					= $getCustomerReg['area'];
		$sub_area				= $getCustomerReg['sub_area'];
		$address				= $getCustomerReg['address'];
		$mobile1				= $getCustomerReg['mobile1'];
		$mobile2				= $getCustomerReg['mobile2'];
		$father_name			= $getCustomerReg['father_name'];
		$mother_name			= $getCustomerReg['mother_name'];
		$marital				= $getCustomerReg['marital'];
		$spouse_name			= $getCustomerReg['spouse'];
		$occupation_type		= $getCustomerReg['occupation_type'];
		$occupation				= $getCustomerReg['occupation'];
		$pic					= $getCustomerReg['cus_pic'];
		$how_to_know 			= $getCustomerReg['how_to_know'];
		$loan_count 			= $getCustomerReg['loan_count'];
		$first_loan_date 		= $getCustomerReg['first_loan_date'];
		$travel_with_company 	= $getCustomerReg['travel_with_company'];
		$monthly_income 		= $getCustomerReg['monthly_income'];
		$other_income 			= $getCustomerReg['other_income'];
		$support_income 		= $getCustomerReg['support_income'];
		$commitment 			= $getCustomerReg['commitment'];
		$monthly_due_capacity 	= $getCustomerReg['monthly_due_capacity'];
		$loan_limit 			= $getCustomerReg['loan_limit'];
		$about_customer 		= $getCustomerReg['about_customer'];
		$residential_type 		= $getCustomerReg['residential_type'];
		$residential_details 	= $getCustomerReg['residential_details'];
		$residential_address 	= $getCustomerReg['residential_address'];
		$residential_native_address = $getCustomerReg['residential_native_address'];
		$cr_occupation_type 		= $getCustomerReg['occupation_info_occ_type'];
		$occupation_details 		= $getCustomerReg['occupation_details'];
		$occupation_income 			= $getCustomerReg['occupation_income'];
		$occupation_address 		= $getCustomerReg['occupation_address'];
		$area_confirm_type 			= $getCustomerReg['area_confirm_type'];
		$area_confirm_state 		= $getCustomerReg['area_confirm_state'];
		$area_confirm_district 		= $getCustomerReg['area_confirm_district'];
		$area_confirm_taluk 		= $getCustomerReg['area_confirm_taluk'];
		$area_confirm_area 			= $getCustomerReg['area_confirm_area'];
		$area_confirm_subarea 		= $getCustomerReg['area_confirm_subarea'];
		$area_group 				= $getCustomerReg['area_group'];
		$area_line 					= $getCustomerReg['area_line'];
		$area_name 					= $getCustomerReg['area_name'];
		$sub_area_name 					= $getCustomerReg['sub_area_name'];
		// $request_id 					= $getCustomerReg['request_id'];
	}
}
//////////////////////// Customer Profile Info END ///////////////////////////////

/////////  Documentation ////////////
$documentationInfo = $userObj->getDocumentDetails($mysqli, $idupd);

if (sizeof($documentationInfo) > 0) {
	$document_table_id = $documentationInfo['doc_Tableid'];
	$document_sts = $documentationInfo['cus_status'];
	$doc_id = $documentationInfo['doc_id'];
	$mortgage_process = $documentationInfo['mortgage_process'];
	$Propertyholder_type = $documentationInfo['Propertyholder_type'];
	$Propertyholder_name = $documentationInfo['Propertyholder_name'];
	$Propertyholder_relationship_name = $documentationInfo['Propertyholder_relationship_name'];
	$doc_property_relation = $documentationInfo['doc_property_relation'];
	$doc_property_type = $documentationInfo['doc_property_type'];
	$doc_property_measurement = $documentationInfo['doc_property_measurement'];
	$doc_property_location = $documentationInfo['doc_property_location'];
	$doc_property_value = $documentationInfo['doc_property_value'];
	$endorsement_process = $documentationInfo['endorsement_process'];
	$owner_type = $documentationInfo['owner_type'];
	$owner_name = $documentationInfo['owner_name'];
	$ownername_relationship_name = $documentationInfo['ownername_relationship_name'];
	$en_relation = $documentationInfo['en_relation'];
	$vehicle_type = $documentationInfo['vehicle_type'];
	$vehicle_process = $documentationInfo['vehicle_process'];
	$en_Company = $documentationInfo['en_Company'];
	$en_Model = $documentationInfo['en_Model'];
	$document_name = $documentationInfo['document_name'];
	$document_details = $documentationInfo['document_details'];
	$document_type = $documentationInfo['document_type'];
	$document_holder = $documentationInfo['document_holder'];
	$docholder_name = $documentationInfo['docholder_name'];
	$docholder_relationship_name = $documentationInfo['docholder_relationship_name'];
	$doc_relation = $documentationInfo['doc_relation'];
}
////////   Documentation End ////////////
?>

<style>
	#imgshow {
		height: 150px;
		width: 150px;
		border-radius: 50%;
		object-fit: cover;
		background-color: white;
	}

	.switch {
	position: relative;
	display: inline-block;
	width: 60px;
	height: 34px;
	left: 10px;
}

.switch input { 
	opacity: 0;
	width: 0;
	height: 0;
}

.slider {
	position: absolute;
	cursor: pointer;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background-color: #ccc;
	-webkit-transition: .4s;
	transition: .4s;
}

.slider:before {
	position: absolute;
	content: "";
	height: 26px;
	width: 26px;
	left: 4px;
	bottom: 4px;
	background-color: white;
	-webkit-transition: .4s;
	transition: .4s;
}

input:checked + .slider {
	background-color: #009688;
}

input:focus + .slider {
	box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
	-webkit-transform: translateX(26px);
	-ms-transform: translateX(26px);
	transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
	border-radius: 34px;
}

.slider.round:before {
	border-radius: 50%;
}

</style>

<!-- Page header start -->
<br><br>
<div class="page-header">
	<div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px;">
		Marudham - Update
	</div>
</div><br>
<div class="page-header sticky-top" id="navbar" style="display: none;" data-toggle="toggle">
	<div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px; margin-top:50px;">
		Customer Name - <?php if (isset($cus_name)) {echo $cus_name;} ?>
	</div>
</div><br>
<div class="text-right" style="margin-right: 25px;">
	<a href="edit_update">
		<button type="button" class="btn btn-primary"><span class="icon-arrow-left"></span>&nbsp; Back</button>
	</a>
</div><br><br>
<!-- Page header end -->



<!-- Main container start -->
<div class="main-container">

	<div class="col-md-12">
		<div class="form-group" style="text-align:center">
			<input type="radio" name="verification_type" id="cus_profile" value="cus_profile"></input><label for='cus_profile'>&nbsp;&nbsp; Customer Profile </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="verification_type" id="documentation" value="documentation"></input><label for='documentation'>&nbsp;&nbsp; Documentation </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
	</div>

	<!-- Customer Profile form start-->
	<div id="customer_profile" style="display: none;">
		<form id="cus_Profiles" name="cus_Profiles" action="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="req_id" id="req_id" value="<?php if (isset($req_id)) {echo $req_id;} ?>" />
			<input type="hidden" name="state_upd" id="state_upd" value="<?php if (isset($state)) {echo $state;} ?>" />
			<input type="hidden" name="district_upd" id="district_upd" value="<?php if (isset($district)) {echo $district;} ?>" />
			<input type="hidden" name="taluk_upd" id="taluk_upd" value="<?php if (isset($taluk)) {echo $taluk;} ?>" />
			<input type="hidden" name="area_upd" id="area_upd" value="<?php if (isset($area)) {echo $area;} ?>" />
			<input type="hidden" name="sub_area_upd" id="sub_area_upd" value="<?php if (isset($sub_area)) {echo $sub_area;} ?>" />

			<input type="hidden" name="area_state_upd" id="area_state_upd" value="<?php if (isset($area_confirm_state)) {echo $area_confirm_state;} ?>" />
			<input type="hidden" name="area_district_upd" id="area_district_upd" value="<?php if (isset($area_confirm_district)) {echo $area_confirm_district;} ?>" />
			<input type="hidden" name="area_taluk_upd" id="area_taluk_upd" value="<?php if (isset($area_confirm_taluk)) {echo $area_confirm_taluk;} ?>" />
			<input type="hidden" name="area_confirm_area" id="area_confirm_area" value="<?php if (isset($area_confirm_area)) {echo $area_confirm_area;} ?>" />
			<input type="hidden" name="sub_area_confirm" id="sub_area_confirm" value="<?php if (isset($area_confirm_subarea)) {echo $area_confirm_subarea;} ?>" />

			<!-- Row start -->
			<div class="row gutters">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

					<!-- Personal info START -->
					<div class="card">
						<div class="card-header">General Info</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-8">
									<div class="row">
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="cus_id">Customer ID</label><span class="required">&nbsp;*</span>
												<input type="text" class="form-control" id="cus_id" name="cus_id" value='<?php if (isset($cus_id)) {echo $cus_id;} ?>' tabindex='9' data-type="adhaar-number" maxlength="14" placeholder="Enter Adhaar Number" readonly>
												<span class="text-danger" style='display:none' id='cusidCheck'>Please Enter Customer ID</span>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="cus_name">Customer Name</label><span class="required">&nbsp;*</span>
												<input type="text" class="form-control" id="cus_name" name="cus_name" value='<?php if (isset($cus_name)) {echo $cus_name;} ?>' tabindex='11' placeholder="Enter Customer Name" pattern="[a-zA-Z\s]+">
												<span class="text-danger" style='display:none' id='cusnameCheck'>Please Enter Customer Name</span>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="dob">Date of Birth</label><span class="required">&nbsp;*</span>
												<input type="date" class="form-control" id="dob" name="dob" value='<?php if (isset($dob)) {echo $dob;} ?>' tabindex='12'>
												<span class="text-danger" style='display:none' id='dobCheck'>Please Select DOB</span>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="age">Age</label><span class="required">&nbsp;*</span>
												<input type="text" class="form-control" id="age" name="age" readonly value='<?php if (isset($age)) {echo $age;} ?>' tabindex='13'>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="gender">Gender&nbsp;<span class="required">&nbsp;*</span></label>
												<select tabindex="14" type="text" class="form-control" id="gender" name="gender">
													<option value="">Select Gender</option>
													<option value="1" <?php if (isset($gender) and $gender == '1') echo 'selected'; ?>>Male</option>
													<option value="2" <?php if (isset($gender) and $gender == '2') echo 'selected'; ?>>Female</option>
													<option value="3" <?php if (isset($gender) and $gender == '3') echo 'selected'; ?>>Other</option>
												</select>
												<span class="text-danger" style='display:none' id='genderCheck'>Please Select Gender</span>
											</div>
										</div>

										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="state">State</label>&nbsp;<span class="text-danger">*</span>
												<select type="text" class="form-control" id="state" name="state" tabindex="16">
													<option value="SelectState">Select State</option>
													<option value="TamilNadu" <?php if (isset($state) && $state == 'TamilNadu') echo 'selected' ?>>Tamil Nadu</option>
													<option value="Puducherry" <?php if (isset($state) && $state == 'Puducherry') echo 'selected' ?>>Puducherry</option>
												</select>
												<span class="text-danger" style='display:none' id='stateCheck'>Please Select State</span>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="district">District</label>&nbsp;<span class="text-danger">*</span>
												<input type="hidden" class="form-control" id="district1" name="district1">
												<select type="text" class="form-control" id="district" name="district" tabindex='17'>
													<option value="Select District">Select District</option>
												</select>
												<span class="text-danger" style='display:none' id='districtCheck'>Please Select District</span>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="taluk">Taluk</label>&nbsp;<span class="text-danger">*</span>
												<input type="hidden" class="form-control" id="taluk1" name="taluk1">
												<select type="text" class="form-control" id="taluk" name="taluk" tabindex="18">
													<option value="Select Taluk">Select Taluk</option>
												</select>
												<span class="text-danger" style='display:none' id='talukCheck'>Please Select Taluk</span>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="area">Area</label>&nbsp;<span class="text-danger">*</span>
												<select tabindex="19" type="text" class="form-control" id="area" name="area">
													<option value="">Select Area</option>

												</select>
												<span class="text-danger" style='display:none' id='areaCheck'>Please Select Area</span>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="sub_area">Sub Area</label>&nbsp;<span class="text-danger">*</span>
												<select tabindex="20" type="text" class="form-control" id="sub_area" name="sub_area">
													<option value=''>Select Sub Area</option>
												</select>
												<span class="text-danger" style='display:none' id='subareaCheck'>Please Select Sub Area</span>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="address">Address</label><span class="required">&nbsp;*</span>
												<input type="text" class="form-control" id="address" name="address" 
												value='<?php if (isset($address)) {echo $address;} ?>' tabindex='21' placeholder="Enter Address">
												<span class="text-danger" style='display:none' id='addressCheck'>Please Enter Address</span>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="mobile1">Mobile No 1</label><span class="required">&nbsp;*</span>
												<input type="number" class="form-control" id="mobile1" name="mobile1" onkeypress="if(this.value.length==10) return false;" 
												value='<?php if (isset($mobile1)) {echo $mobile1;} ?>' tabindex='22' placeholder="Enter Mobile Number">
												<span class="text-danger" style='display:none' id='mobile1Check'>Please Enter Mobile Number</span>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="mobile2">Mobile No 2</label>
												<input type="number" class="form-control" id="mobile2" name="mobile2" onkeypress="if(this.value.length==10) return false;" 
												value='<?php if (isset($mobile2)) {echo $mobile2;} ?>' tabindex='23' placeholder="Enter Mobile Number">
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="father_name">Father Name</label><span class="required">&nbsp;*</span>
												<input type="text" class="form-control" id="father_name" name="father_name" value='<?php if (isset($father_name)) {echo $father_name;} ?>' tabindex='24' placeholder="Enter Father's Name" pattern="[a-zA-Z\s]+">
												<span class="text-danger" style='display:none' id='fathernameCheck'>Please Enter Father Name</span>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="mother_name">Mother Name</label><span class="required">&nbsp;*</span>
												<input type="text" class="form-control" id="mother_name" name="mother_name" value='<?php if (isset($mother_name)) {echo $mother_name;} ?>' tabindex='25' placeholder="Enter Mother's Name" pattern="[a-zA-Z\s]+">
												<span class="text-danger" style='display:none' id='mothernameCheck'>Please Enter Mother Name</span>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="marital">Marital Status<span class="required">&nbsp;*</span></label>
												<select tabindex="26" type="text" class="form-control" id="marital" name="marital">
													<option value="">Select Marital Status</option>
													<option value="1" <?php if (isset($marital) and $marital == '1') echo 'selected'; ?>>Married</option>
													<option value="2" <?php if (isset($marital) and $marital == '2') echo 'selected'; ?>>Unmarried</option>
												</select>
												<span class="text-danger" style='display:none' id='maritalCheck'>Please Select Marital status</span>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8 spouse" style="display:none">
											<div class="form-group">
												<label for="spouse_name">Spouse Name</label><span class="required">&nbsp;*</span>
												<input type="text" class="form-control" id="spouse_name" name="spouse_name" value='<?php if (isset($spouse_name)) {echo $spouse_name;} ?>' tabindex='27' placeholder="Enter Spouse Name" pattern="[a-zA-Z\s]+">
												<span class="text-danger" style='display:none' id='spousenameCheck'>Please Enter Spouse Name</span>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="occupation_type">Occupation Type<span class="required">&nbsp;*</span></label>
												<select tabindex="28" type="text" class="form-control" id="occupation_type" name="occupation_type">
													<option value="">Select Occupation Type</option>
													<option value="1" <?php if (isset($occupation_type) and $occupation_type == '1') echo 'selected'; ?>>Govt Job</option>
													<option value="2" <?php if (isset($occupation_type) and $occupation_type == '2') echo 'selected'; ?>>Pvt Job</option>
													<option value="3" <?php if (isset($occupation_type) and $occupation_type == '3') echo 'selected'; ?>>Business</option>
													<option value="4" <?php if (isset($occupation_type) and $occupation_type == '4') echo 'selected'; ?>>Self Employed</option>
													<option value="5" <?php if (isset($occupation_type) and $occupation_type == '5') echo 'selected'; ?>>Daily wages</option>
													<option value="6" <?php if (isset($occupation_type) and $occupation_type == '6') echo 'selected'; ?>>Agriculture</option>
													<option value="7" <?php if (isset($occupation_type) and $occupation_type == '7') echo 'selected'; ?>>Others</option>
												</select>
												<span class="text-danger" style='display:none' id='occupationtypeCheck'>Please Select Occupation Type</span>
											</div>
										</div>
										<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-8">
											<div class="form-group">
												<label for="occupation">Occupation</label><span class="required">&nbsp;*</span>
												<input type="text" class="form-control" id="occupation" name="occupation" value='<?php if (isset($occupation)) {echo $occupation;} ?>' tabindex='29' placeholder="Enter Occupation" pattern="[a-zA-Z\s]+">
												<span class="text-danger" style='display:none' id='occupationCheck'>Please Enter Occupation</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
										<div class="form-group" style="margin-left: 30px;">
											<label  style="margin-left: -20px;">Photo</label><span class="required">&nbsp;*</span><br>
											<input type="hidden" class="form-control" id="cus_image" name="cus_image" value='<?php if (isset($pic)) {echo $pic;} ?>'>
											<img id='imgshow' src='img/avatar.png' />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Personal info END -->

					<!-- Family info START -->
					<div class="card">
						<div class="card-header">Family Info <span style="font-weight:bold" class=""></span>
							<button type="button" class="btn btn-primary" id="add_group" name="add_group" data-toggle="modal" data-target=".addGroup" style="padding: 5px 35px; float: right;"><span class="icon-add"></span></button>
						</div>
						<span class="text-danger" style='display:none' id='family_infoCheck'>Please Fill Family Info </span>
						<div class="card-body">

							<div class="row">

								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group" id="famList">
										<table class="table custom-table">
											<thead>
												<tr>
													<th>S.No</th>
													<th>Name</th>
													<th>Relationship</th>
													<th>Age</th>
													<th>Aadhar No</th>
													<th>Mobile No</th>
													<th>Occupation</th>
													<th>Income</th>
													<th>Blood Group</th>
												</tr>
											</thead>
											<tbody>

											</tbody>
										</table>
									</div>
								</div>

							</div>

						</div>
					</div>
					<!-- Family info END -->

					<!-- Residential  Info START -->
					<div class="card">
						<div class="card-header"> Residential Info <span style="font-weight:bold" class=""></span></div>
						<span class="text-danger" style='display:none' id='res_infoCheck'>Please Fill Residential Info </span>
						<div class="card-body">
							<div class="row">

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_res_type"> Residential Type </label>
										<select type="text" class="form-control" name="cus_res_type" id="cus_res_type" tabindex="28">
											<option> Select Residential Type </option>
											<option value="0" <?php if (isset($residential_type) and $residential_type == '0') echo 'selected'; ?>> Own </option>
											<option value="1" <?php if (isset($residential_type) and $residential_type == '1') echo 'selected'; ?>> Rental </option>
											<option value="2" <?php if (isset($residential_type) and $residential_type == '2') echo 'selected'; ?>> Lease </option>
											<option value="3" <?php if (isset($residential_type) and $residential_type == '3') echo 'selected'; ?>> Quarters </option>
										</select>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_res_details"> Resident Details </label>
										<input type="text" class="form-control" name="cus_res_details" id="cus_res_details" placeholder="Enter Resident Details" 
										value="<?php if (isset($residential_details)) {echo $residential_details;} ?>" tabindex="29">
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_res_address"> Address </label>
										<input type="text" class="form-control" name="cus_res_address" id="cus_res_address" placeholder="Enter Address" 
										value="<?php if (isset($residential_address)) {echo $residential_address;} ?>" tabindex="30">
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_res_native"> Native Address </label>
										<input type="text" class="form-control" name="cus_res_native" id="cus_res_native" placeholder="Enter Native Address" 
										value="<?php if (isset($residential_native_address)) {echo $residential_native_address;} ?>" tabindex="31">
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- Residential  Info END -->

					<!-- Occupation info START -->
					<div class="card">
						<div class="card-header"> Occupation info <span style="font-weight:bold" class=""></span></div>
						<span class="text-danger" style='display:none' id='occ_infoCheck'>Please Fill Occupation Info </span>
						<div class="card-body">
							<div class="row">

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_occ_type"> Occupation Type </label>
										<select type="text" class="form-control" name="cus_occ_type" id="cus_occ_type" tabindex="32">
											<option value="">Select Occupation Type</option>
											<option value="1" <?php if (isset($cr_occupation_type) and $cr_occupation_type == '1') echo 'selected'; ?>>Govt Job</option>
											<option value="2" <?php if (isset($cr_occupation_type) and $cr_occupation_type == '2') echo 'selected'; ?>>Pvt Job</option>
											<option value="3" <?php if (isset($cr_occupation_type) and $cr_occupation_type == '3') echo 'selected'; ?>>Business</option>
											<option value="4" <?php if (isset($cr_occupation_type) and $cr_occupation_type == '4') echo 'selected'; ?>>Self Employed</option>
											<option value="5" <?php if (isset($cr_occupation_type) and $cr_occupation_type == '5') echo 'selected'; ?>>Daily wages</option>
											<option value="6" <?php if (isset($cr_occupation_type) and $cr_occupation_type == '6') echo 'selected'; ?>>Agriculture</option>
											<option value="7" <?php if (isset($cr_occupation_type) and $cr_occupation_type == '7') echo 'selected'; ?>>Others</option>
										</select>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_occ_detail"> Occupation Detail </label>
										<input type="text" class="form-control" name="cus_occ_detail" id="cus_occ_detail" placeholder="Enter Occupation Detail" onkeydown="return /[a-z ]/i.test(event.key)" value="<?php if (isset($occupation_details)) {	echo $occupation_details;} ?>" tabindex="33">
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_occ_income"> Income </label>
										<input type="number" class="form-control" name="cus_occ_income" id="cus_occ_income" placeholder="Enter Income" 
										value="<?php if (isset($occupation_income)) {echo $occupation_income;} ?>" tabindex="34">
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_occ_address"> Address </label>
										<input type="text" class="form-control" name="cus_occ_address" id="cus_occ_address" placeholder="Enter Address" 
										value="<?php if (isset($occupation_address)) {echo $occupation_address;} ?>" tabindex="35">
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- Occupation info END -->

					<!-- Area Confirm START -->
					<div class="card">
						<div class="card-header"> Area Confirm <span style="font-weight:bold" class=""></span></div>
						<div class="card-body">
							<div class="row">

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="area_cnfrm"> Area confirm </label><span class="required">&nbsp;*</span>
										<select type="text" class="form-control" name="area_cnfrm" id="area_cnfrm" tabindex="36">
											<option value="">Select Area Type</option>
											<option value="0" <?php if (isset($area_confirm_type) and $area_confirm_type == '0') echo 'selected'; ?>> Residential Area </option>
											<option value="1" <?php if (isset($area_confirm_type) and $area_confirm_type == '1') echo 'selected'; ?>> Occupation Area </option>
										</select>
										<span class="text-danger" style='display:none' id='areacnfrmCheck'>Please Select Confirm Area</span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-8">
									<div class="form-group">
										<label for="area_state">State</label>&nbsp;<span class="text-danger">*</span>
										<select type="text" class="form-control" id="area_state" name="area_state" tabindex="37">
											<option value="SelectState">Select State</option>
											<option value="TamilNadu" <?php if (isset($area_confirm_state) and $area_confirm_state == 'TamilNadu') echo 'selected'; ?>>Tamil Nadu</option>
											<option value="Puducherry" <?php if (isset($area_confirm_state) and $area_confirm_state == 'Puducherry') echo 'selected'; ?>>Puducherry</option>
										</select>
										<span class="text-danger" style='display:none' id='stateCheck'>Please Select State</span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="area_district">District</label>&nbsp;<span class="text-danger">*</span>
										<input type="hidden" class="form-control" id="area_district1" name="area_district1">
										<select type="text" class="form-control" id="area_district" name="area_district" tabindex='38'>
											<option value="Select District">Select District</option>
										</select>
										<span class="text-danger" style='display:none' id='districtCheck'>Please Select District</span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="area_taluk">Taluk</label>&nbsp;<span class="text-danger">*</span>
										<input type="hidden" class="form-control" id="area_taluk1" name="area_taluk1">
										<select type="text" class="form-control" id="area_taluk" name="area_taluk" tabindex="39">
											<option value="Select Taluk">Select Taluk</option>
										</select>
										<span class="text-danger" style='display:none' id='talukCheck'>Please Select Taluk</span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="area_confirm">Area</label>&nbsp;<span class="text-danger">*</span>
										<select tabindex="40" type="text" class="form-control" id="area_confirm" name="area_confirm">
											<option value="">Select Area</option>

										</select>
										<span class="text-danger" style='display:none' id='areaCheck'>Please Select Area</span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="area_sub_area">Sub Area</label>&nbsp;<span class="text-danger">*</span>
										<select tabindex="41" type="text" class="form-control" id="area_sub_area" name="area_sub_area">
											<option value=''>Select Sub Area</option>
										</select>
										<span class="text-danger" style='display:none' id='subareaCheck'>Please Select Sub Area</span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="area_group">Group</label>
										<input type="text" class="form-control" name="area_group" id="area_group" 
										value="<?php if (isset($area_group)) {echo $area_group;} ?>" readonly tabindex="42">
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="area_line">Line</label>
										<input type="text" class="form-control" name="area_line" id="area_line" 
										value="<?php if (isset($area_line)) {echo $area_line;} ?>" readonly tabindex="43">
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- Area Confirm END -->

					<!-- Property info START -->
					<div class="card">
						<div class="card-header"> Property info <span style="font-weight:bold" class=""></span>
							<button type="button" class="btn btn-primary" id="property_add" name="property_add" data-toggle="modal" data-target=".addproperty" style="padding: 5px 35px;  float: right; " onclick="propertyHolder()"><span class="icon-add"></span></button>
						</div>
						<span class="text-danger" style='display:none' id='property_infoCheck'>Please Fill Property Info </span>
						<div class="card-body">

							<div class="row">

								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group" id="propertyList">
										<table class="table custom-table modalTable">
											<thead>
												<tr>
													<th width="50"> S.No </th>
													<th> Property Type </th>
													<th> Property Measurement </th>
													<th> Property Value </th>
													<th> Property Holder </th>
													<th> ACTION </th>
												</tr>
											</thead>
											<tbody>

											</tbody>
										</table>
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- Property info END -->

					<!-- Bank info START -->
					<div class="card">
						<div class="card-header"> Bank info <span style="font-weight:bold" class=""></span>
							<button type="button" class="btn btn-primary" id="bank_add" name="bank_add" data-toggle="modal" data-target=".addbank" style="padding: 5px 35px;  float: right;"><span class="icon-add"></span></button>
						</div>
						<span class="text-danger" style='display:none' id='bank_infoCheck'>Please Fill Bank Info </span>
						<div class="card-body">

							<div class="row">

								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group" id="bankResetTable">
										<table class="table custom-table modalTable">
											<thead>
												<tr>
													<th width="50"> S.No </th>
													<th> Bank Name </th>
													<th> Branch Name </th>
													<th> Account Holder Name </th>
													<th> Account Number </th>
													<th> IFSC Code </th>
													<th> ACTION </th>
												</tr>
											</thead>
											<tbody>

											</tbody>
										</table>
									</div>
								</div>

							</div>

						</div>
					</div>
					<!-- Bank info END -->


					<!-- ///////////////////////////////////////////////// Customer Summary START ///////////////////////////////////////////////////////////// -->
					<div class="card">
						<div class="card-header"> Customer Summary <span style="font-weight:bold" class=""></span></div>
						<div class="card-body">
							<div class="row">

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_how_know"> How to Know </label> <span class="required">*</span>
										<select type="text" class="form-control" name="cus_how_know" id="cus_how_know" tabindex="44">
											<option value=""> Select How to Know </option>
											<option value="0" <?php if (isset($how_to_know) and $how_to_know == '0') echo 'selected'; ?>> Customer Reference </option>
											<option value="1" <?php if (isset($how_to_know) and $how_to_know == '1') echo 'selected'; ?>> Advertisement </option>
											<option value="2" <?php if (isset($how_to_know) and $how_to_know == '2') echo 'selected'; ?>> Promotion activity </option>
											<option value="3" <?php if (isset($how_to_know) and $how_to_know == '3') echo 'selected'; ?>> Agent Reference </option>
											<option value="4" <?php if (isset($how_to_know) and $how_to_know == '4') echo 'selected'; ?>> Staff Reference </option>
											<option value="5" <?php if (isset($how_to_know) and $how_to_know == '5') echo 'selected'; ?>> Other Reference </option>
										</select>
										<span class="text-danger" style='display:none' id='howToKnowCheck'>Please Select How To Know </span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_loan_count"> Loan Counts </label>
										<input type="text" class="form-control" name="cus_loan_count" id="cus_loan_count" 
										value="<?php if (isset($loan_count)) {echo $loan_count;} ?>" readonly tabindex="45">
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_frst_loanDate"> First Loan Date </label>
										<input type="text" class="form-control" name="cus_frst_loanDate" id="cus_frst_loanDate" 
										value="<?php if (isset($first_loan_date)) {echo $first_loan_date;} ?>" readonly tabindex="46">
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_travel_cmpy"> Travel with Company </label>
										<input type="text" class="form-control" name="cus_travel_cmpy" id="cus_travel_cmpy" 
										value="<?php if (isset($travel_with_company)) {echo $travel_with_company;} ?>" readonly tabindex="47">
									</div>
								</div>

							</div>

							<hr>

							<div class="row">

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_monthly_income"> Monthly Income </label> <span class="required">*</span>
										<input type="number" class="form-control" name="cus_monthly_income" id="cus_monthly_income" placeholder="Enter Monthly Income" 
										value="<?php if (isset($monthly_income)) {echo $monthly_income;} ?>" tabindex="48">
										<span class="text-danger" style='display:none' id='monthlyIncomeCheck'>Please Enter Monthly Income </span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_other_income"> Other Income </label> <span class="required">*</span>
										<input type="number" class="form-control" name="cus_other_income" id="cus_other_income" placeholder="Enter Other Income" 
										value="<?php if (isset($other_income)) {echo $other_income;} ?>" tabindex="49">
										<span class="text-danger" style='display:none' id='otherIncomeCheck'>Please Enter Other Income </span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_support_income"> Support Income </label> <span class="required">*</span>
										<input type="number" class="form-control" name="cus_support_income" id="cus_support_income" placeholder="Enter Support Income" 
										value="<?php if (isset($support_income)) {echo $support_income;} ?>" tabindex="50">
										<span class="text-danger" style='display:none' id='supportIncomeCheck'>Please Enter Support Income </span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_Commitment"> Commitment </label> <span class="required">*</span>
										<input type="number" class="form-control" name="cus_Commitment" id="cus_Commitment" placeholder="Enter Commitment" 
										value="<?php if (isset($commitment)) {echo $commitment;} ?>" tabindex="51">
										<span class="text-danger" style='display:none' id='commitmentCheck'>Please Enter Commitment </span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_monDue_capacity"> Monthly Due Capacity </label> <span class="required">*</span>
										<input type="number" class="form-control" name="cus_monDue_capacity" id="cus_monDue_capacity" placeholder="Enter Monthly Due Capacity" 
										value="<?php if (isset($monthly_due_capacity)) {echo $monthly_due_capacity;} ?>" tabindex="52">
										<span class="text-danger" style='display:none' id='monthlyDueCapacityCheck'> Please Enter Monthly Due Capacity </span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="cus_loan_limit"> Loan Limit </label> <span class="required">*</span>
										<input type="number" class="form-control" name="cus_loan_limit" id="cus_loan_limit" placeholder="Enter Loan Limit" 
										value="<?php if (isset($loan_limit)) {echo $loan_limit;} ?>" tabindex="53">
										<span class="text-danger" style='display:none' id='loanLimitCheck'>Please Enter Loan Limit </span>
									</div>
								</div>

							</div>

							<hr>
							<div class="row">
								<div class="col-12">
									<button type="button" class="btn btn-primary" id="add_cus_label" name="add_cus_label" data-toggle="modal" data-target=".addCusLabel" style="padding: 5px 35px; float: right;" tabindex="54"><span class="icon-add"></span></button>
								</div>
							</div> <br>

							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group" id="feedbackListTable">
										<table class="table custom-table modalTable">
											<thead>
												<tr>
													<th width="50"> S.No </th>
													<th> Feedback Label </th>
													<th> Feedback </th>
													<th> Remarks </th>
												</tr>
											</thead>
											<tbody>

											</tbody>
										</table>
									</div>
								</div>
							</div>

							<hr>

							<div class="row">
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="about_cus"> About Customer </label> <span class="required">*</span>
										<textarea class="form-control" name="about_cus" id="about_cus" tabindex="55"><?php if (isset($about_customer)) {echo $about_customer;} ?></textarea>
										<span class="text-danger" style='display:none' id='aboutcusCheck'> Please Enter About Customer </span>
									</div>
								</div>
							</div>

						</div>
					</div>
					<!-- ///////////////////////////////////////////////  Customer Summary  END /////////////////////////////////////////////////////////// -->


					<div class="col-md-12 ">
						<div class="text-right">
							<button type="submit" name="submit_update_cus_profile" id="submit_update_cus_profile" class="btn btn-primary" value="Submit" tabindex="60"><span class="icon-check"></span>&nbsp;Submit</button>
							<button type="reset" class="btn btn-outline-secondary" tabindex="61">Clear</button>
						</div>
					</div>

				</div>
			</div>
		</form>
	</div>
	<!-- Customer Form End -->



	<!--  ///////////////////////////////////////////////////////////////// Documentation  start ////////////////////////////////////////////////////////// -->
	<div id="cus_document" style="display: none;">
		<form id="cus_doc" name="cus_doc" action="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="req_id_doc" id="req_id_doc" value="<?php if (isset($req_id)) {echo $req_id;} ?>">
			<input type="hidden" name="doc_table_id" id="doc_table_id" value="<?php if (isset($document_table_id)) {echo $document_table_id;} ?>">
			<input type="hidden" name="doc_id" id="doc_id" value="<?php if (isset($doc_id)) {echo $doc_id;} ?>">
			<input type="hidden" name="en_relation_name" id="en_relation_name" value="<?php if (isset($ownername_relationship_name)) {echo $ownername_relationship_name;} ?>">
			<input type="hidden" name="mortgage_relation_name" id="mortgage_relation_name"	value="<?php if (isset($Propertyholder_relationship_name)) {echo $Propertyholder_relationship_name;} ?>">
			<input type="hidden" name="docrelation_name" id="docrelation_name" value="<?php if (isset($docholder_relationship_name)) {echo $docholder_relationship_name;} ?>">
			<input type="hidden" name="submitted" id="submitted" value="<?php if (isset($submitted)) {echo $submitted;} ?>">

			<!-- Row start -->
			<div class="row gutters">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

					<div class="card">
						<div class="card-header">Documentation Info</div>
						<div class="card-body">
							<div class="row">

								<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
									<div class="form-group">
										<label for="cus_id_doc">Customer ID </label> <span class="required">* </span>
										<input type="text" class="form-control" id="cus_id_doc" name="cus_id_doc" value='<?php if (isset($cus_id)) echo $cus_id; ?>' readonly tabindex="1">
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="Customer_name"> Customer Name </label> <span class="required"> * </span>
										<input type="text" class="form-control" id="Customer_name" name="Customer_name" value='<?php if (isset($cus_name)) echo $cus_name; ?>' readonly tabindex="2">
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="doc_area"> Area </label> <span class="required"> * </span>
										<input tabindex="3" type="text" class="form-control" id="doc_area" name="doc_area" value="<?php if (isset($area_name)) echo $area_name; ?>" readonly>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="doc_Sub_Area"> Sub Area </label> <span class="required"> * </span>
										<input type="text" class="form-control" id="doc_Sub_Area" name="doc_Sub_Area" value='<?php if (isset($sub_area_name)) echo $sub_area_name; ?>' readonly tabindex="4">
									</div>
								</div>


							</div>
						</div>
					</div>
					<!-- Documentations Info  End-->

					<!-- Signed Doc Info START -->
					<div class="card">
						<div class="card-header"> Signed Doc Info
							<button type="button" class="btn btn-primary" id="add_sign_doc" name="add_sign_doc" data-toggle="modal" data-target=".addSignDoc" style="padding: 5px 35px;  float: right;" tabindex="6"><span class="icon-add"></span></button>
						</div>
						<span class="text-danger" style='display:none' id='signed_infoCheck'>Please Fill Signed Doc Info </span>
						<div class="card-body">

							<div class="row">

								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group" id="signDocResetTable">
										<table class="table custom-table">
											<thead>
												<tr>
													<th width="50"> S.No </th>
													<th> Doc Name </th>
													<th> Sign Type </th>
													<th> Count </th>
												</tr>
											</thead>
											<tbody>

											</tbody>
										</table>
									</div>
								</div>

							</div>

						</div>
					</div>
					<!-- Signed Doc Info END -->

					<!-- Cheque Info START -->
					<div class="card">
						<div class="card-header"> Cheque Info
							<button type="button" class="btn btn-primary" id="add_Cheque" name="add_Cheque" data-toggle="modal" data-target=".addCheque" style="padding: 5px 35px;  float: right;" tabindex="7"><span class="icon-add"></span></button>
						</div>
						<span class="text-danger" style='display:none' id='Cheque_infoCheck'>Please Fill Cheque Info </span>
						<div class="card-body">

							<div class="row">

								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group" id="ChequeResetTable">
										<table class="table custom-table">
											<thead>
												<tr>
													<th width="50"> S.No </th>
													<th> Holder type </th>
													<th> Holder Name </th>
													<th> Relationship </th>
													<th> Bank Name </th>
													<th> Cheque No </th>
												</tr>
											</thead>
											<tbody>

											</tbody>
										</table>
									</div>
								</div>

							</div>

						</div>
					</div>
					<!-- Cheque Info END -->

					<!-- Mortgage Info START-->

					<div class="card">
						<div class="card-header"> Mortgage Info </div>
						<div class="card-body">
							<div class="row">

								<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
									<div class="form-group">
										<label for="mortgage_process"> Mortgage Process</label> <span class="required">&nbsp;*</span>
										<select type="text" class="form-control" id="mortgage_process" name="mortgage_process" tabindex="8">
											<option value=""> Select Mortgage Process </option>
											<option value="0" <?php if (isset($mortgage_process) and $mortgage_process == '0') echo 'selected'; ?>> YES </option>
											<option value="1" <?php if (isset($mortgage_process) and $mortgage_process == '1') echo 'selected'; ?>> NO </option>
										</select>
										<span class="text-danger" id="mortgageprocessCheck"> Select Mortgage Process </span>
									</div>
								</div>
							</div>

							<div id="Mortgageprocess" <?php if (isset($mortgage_process)) {if ($mortgage_process != '0') { ?> style="display: none;" <?php }} else { ?> style="display: none;" <?php } ?>>
								<div class="row">
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label > Property Holder type </label> <span class="required">&nbsp;*</span>
											<select type="text" class="form-control" id="Propertyholder_type" name="Propertyholder_type" tabindex="9">
												<option value=""> Select Holder type </option>
												<option value="0" <?php if (isset($Propertyholder_type) and $Propertyholder_type == '0') echo 'selected'; ?>> Customer </option>
												<option value="1" <?php if (isset($Propertyholder_type) and $Propertyholder_type == '1') echo 'selected'; ?>> Guarantor </option>
												<option value="2" <?php if (isset($Propertyholder_type) and $Propertyholder_type == '2') echo 'selected'; ?>> Family Members </option>
											</select>
											<span class="text-danger" id="propertyholdertypeCheck"> Select Property Holder type </span>
										</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label > Property Holder Name </label>
											<input type="text" class="form-control" id="Propertyholder_name" name="Propertyholder_name" value="<?php if (isset($Propertyholder_name)) echo $Propertyholder_name; ?>" readonly tabindex="10">

											<select type="text" class="form-control" id="Propertyholder_relationship_name" name="Propertyholder_relationship_name" style="display: none;">
												<option value=""> Select Relationship </option>
											</select>
										</div>
									</div>


									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="doc_property_relation"> Relationship </label>
											<input type="text" class="form-control" id="doc_property_relation" name="doc_property_relation" value="<?php if (isset($doc_property_relation)) echo $doc_property_relation; ?>" readonly tabindex="11">
										</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="doc_property_pype"> Property Type </label> <span class="required">&nbsp;*</span>
											<input type="text" class="form-control" id="doc_property_pype" name="doc_property_pype" placeholder="Enter Property Type" value="<?php if (isset($doc_property_type)) echo $doc_property_type; ?>" tabindex="12">
											<span class="text-danger" id="docpropertytypeCheck"> Enter Property Type </span>
										</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="doc_property_measurement"> Property Measurement </label> <span class="required">&nbsp;*</span>
											<input type="text" class="form-control" id="doc_property_measurement" name="doc_property_measurement" placeholder="Enter Property Measurement" value="<?php if (isset($doc_property_measurement)) echo $doc_property_measurement; ?>" tabindex="13">
											<span class="text-danger" id="docpropertymeasureCheck"> Enter Property Measurement </span>
										</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="doc_property_location"> Property Location </label> <span class="required">&nbsp;*</span>
											<input type="text" class="form-control" id="doc_property_location" name="doc_property_location" placeholder="Enter Property Location" value="<?php if (isset($doc_property_location)) echo $doc_property_location; ?>" tabindex="14">
											<span class="text-danger" id="docpropertylocCheck"> Enter Property Location </span>
										</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="doc_property_value"> Property Value </label> <span class="required">&nbsp;*</span>
											<input type="text" class="form-control" id="doc_property_value" name="doc_property_value" placeholder="Enter Property Value" value="<?php if (isset($doc_property_value)) echo $doc_property_value; ?>" tabindex="15">
										</div>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="mortgage_name"> Mortgage Name </label> <span class="required">&nbsp;*</span>
											<input type="text" class="form-control" id="mortgage_name" name="mortgage_name" onkeydown="return /[a-z ]/i.test(event.key)" placeholder="Enter Mortgage Name" value="<?php if (isset($mortgage_name)) echo $mortgage_name; ?>" tabindex="16">
											<span class="text-danger" id="mortgagenameCheck"> Enter Mortgage Name </span>
										</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="mortgage_dsgn"> Designation </label> <span class="required">&nbsp;*</span>
											<input type="text" class="form-control" id="mortgage_dsgn" name="mortgage_dsgn" onkeydown="return /[a-z ]/i.test(event.key)" placeholder="Enter Designation" value="<?php if (isset($mortgage_dsgn)) echo $mortgage_dsgn; ?>" tabindex="17">
											<span class="text-danger" id="mortgagedsgnCheck"> Enter Designation </span>
										</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="mortgage_nuumber"> Mortgage Number </label> <span class="required">&nbsp;*</span>
											<input type="text" class="form-control" id="mortgage_nuumber" name="mortgage_nuumber" placeholder="Enter Mortgage Number" value="<?php if (isset($mortgage_nuumber)) echo $mortgage_nuumber; ?>" tabindex="18">
											<span class="text-danger" id="mortgagenumCheck"> Enter Mortgage Number </span>
										</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="reg_office"> Reg Office </label> <span class="required">&nbsp;*</span>
											<input type="text" class="form-control" id="reg_office" name="reg_office" placeholder="Enter Reg Office" value="<?php if (isset($reg_office)) echo $reg_office; ?>" tabindex="19">
											<span class="text-danger" id="regofficeCheck"> Enter Reg Office </span>
										</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="mortgage_value"> Mortgage Value </label> <span class="required">&nbsp;*</span>
											<input type="text" class="form-control" id="mortgage_value" name="mortgage_value" placeholder="Enter Mortgage Value" value="<?php if (isset($mortgage_value)) echo $mortgage_value; ?>" tabindex="20">
											<span class="text-danger" id="mortgagevalueCheck"> Enter Mortgage Value </span>
										</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="mortgage_document"> Mortgage Document </label> <span class="required">&nbsp;*</span>
											<select type="text" class="form-control" id="mortgage_document" name="mortgage_document" tabindex="21">
												<option value=""> Select Mortgage Document </option>
												<option value="0" <?php if (isset($mortgage_document) and $mortgage_document == '0') echo 'selected'; ?>> YES </option>
												<option value="1" <?php if (isset($mortgage_document) and $mortgage_document == '1') echo 'selected'; ?>> NO </option>
											</select>
											<span class="text-danger" id="mortgagedocCheck"> Select Mortgage Document </span>
										</div>
									</div>

									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" id="docUpd" style="display: none;">
										<div class="form-group">
											<label for="mortgage_document_upd"> Mortgage Document Uploads </label> <span class="required">&nbsp;*</span>
											<input type="file" class="form-control" id="mortgage_document_upd" name="mortgage_document_upd" tabindex="22">
											<input type="hidden" id="mortgage_doc_upd" name="mortgage_doc_upd" value="<?php if (isset($mortgage_document_upd)) echo $mortgage_document_upd; ?>">
											<!-- <a href="<?php echo "uploads/verification/mortgage_doc/" . $mortgage_document_upd; ?>" target="_blank" >  <?php if (isset($mortgage_document_upd)) echo $mortgage_document_upd; ?> </a> -->
											<span class="text-danger" id="mortgagedocUpdCheck"> Upload Mortgage Document </span>
										</div>
									</div>


									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group">
											<label for="pendingchk"> Pending </label> <span class="required">&nbsp;*</span>
											<label class="switch">
												<input type="checkbox" value="YES" id="pendingchk" name="pendingchk" checked tabindex="23">
												<span class="slider round"></span>
											</label>
										</div>
									</div>


								</div>

							</div>
						</div>
					</div>
					<!-- Mortgage Info  End-->

					<!-- Endorsement Info START-->

					<div class="card">
						<div class="card-header"> Endorsement Info </div>
						<div class="card-body">
							<div class="row">

								<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
									<div class="form-group">
										<label for="endorsement_process"> Endorsement Process</label> <span class="required">&nbsp;*</span>
										<select type="text" class="form-control" id="endorsement_process" name="endorsement_process" tabindex="24">
											<option value=""> Select Endorsement Process </option>
											<option value="0" <?php if (isset($endorsement_process) and $endorsement_process == '0') echo 'selected'; ?>> YES </option>
											<option value="1" <?php if (isset($endorsement_process) and $endorsement_process == '1') echo 'selected'; ?>> NO </option>
										</select>
										<span class="text-danger" id="endorsementprocessCheck"> Select Endorsement Process </span>
									</div>
								</div>
							</div>

							<div class="row" id="endorsementprocess" <?php if (isset($endorsement_process)) {
																			if ($endorsement_process != '0') { ?> style="display: none;" <?php }
																																	} else { ?> style="display: none;" <?php } ?>>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label > Owner Type </label> <span class="required">&nbsp;*</span>
										<select type="text" class="form-control" id="owner_type" name="owner_type" tabindex="25">
											<option value=""> Select Holder type </option>
											<option value="0" <?php if (isset($owner_type) and $owner_type == '0') echo 'selected'; ?>> Customer </option>
											<option value="1" <?php if (isset($owner_type) and $owner_type == '1') echo 'selected'; ?>> Guarantor </option>
											<option value="2" <?php if (isset($owner_type) and $owner_type == '2') echo 'selected'; ?>> Family Members </option>
										</select>
										<span class="text-danger" id="ownertypeCheck"> Select Owner type </span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label> Owner Name </label>
										<input type="text" class="form-control" id="owner_name" name="owner_name" value="<?php if (isset($owner_name)) echo $owner_name; ?>" readonly>

										<select type="text" class="form-control" id="ownername_relationship_name" name="ownername_relationship_name" style="display: none;" tabindex="26">
											<option value=""> Select Relationship </option>
										</select>
									</div>
								</div>


								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="en_relation"> Relationship </label>
										<input type="text" class="form-control" id="en_relation" name="en_relation" value="<?php if (isset($en_relation)) echo $en_relation; ?>" readonly tabindex="27">
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="vehicle_type"> Vehicle type </label> <span class="required">&nbsp;*</span>
										<select type="text" class="form-control" id="vehicle_type" name="vehicle_type" tabindex="28">
											<option value=""> Select Vehicle type </option>
											<option value="0" <?php if (isset($vehicle_type) and $vehicle_type == '0') echo 'selected'; ?>> 2 Wheeler </option>
											<option value="1" <?php if (isset($vehicle_type) and $vehicle_type == '1') echo 'selected'; ?>> 4 Wheeler </option>
										</select>
										<span class="text-danger" id="vehicletypeCheck"> Enter Vehicle Type </span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="vehicle_process"> Vehicle Process </label> <span class="required">&nbsp;*</span>
										<select type="text" class="form-control" id="vehicle_process" name="vehicle_process" tabindex="29">
											<option value=""> Select Vehicle Process </option>
											<option value="0" <?php if (isset($vehicle_process) and $vehicle_process == '0') echo 'selected'; ?>> New </option>
											<option value="1" <?php if (isset($vehicle_process) and $vehicle_process == '1') echo 'selected'; ?>> Old </option>
										</select>
										<span class="text-danger" id="vehicleprocessCheck"> Enter Vehicle Process </span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="en_Company"> Company </label> <span class="required">&nbsp;*</span>
										<input type="text" class="form-control" id="en_Company" name="en_Company" placeholder="Enter Company" value="<?php if (isset($en_Company)) echo $en_Company; ?>" tabindex="30">
										<span class="text-danger" id="enCompanyCheck"> Enter Company </span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="en_Model"> Model </label> <span class="required">&nbsp;*</span>
										<input type="text" class="form-control" id="en_Model" name="en_Model" placeholder="Enter Model" value="<?php if (isset($en_Model)) echo $en_Model; ?>" tabindex="31">
										<span class="text-danger" id="enModelCheck"> Enter Model </span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="vehicle_reg_no"> Vehicle Reg No. </label> <span class="required">&nbsp;*</span>
										<input type="text" class="form-control" id="vehicle_reg_no" name="vehicle_reg_no" placeholder="Enter Vehicle No" value="<?php if (isset($vehicle_reg_no)) echo $vehicle_reg_no; ?>" tabindex="32">
										<span class="text-danger" id="vehicle_reg_noCheck"> Enter Vehicle No </span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="endorsement_name"> Endorsement name </label> <span class="required">&nbsp;*</span>
										<input type="text" class="form-control" id="endorsement_name" name="endorsement_name" onkeydown="return /[a-z ]/i.test(event.key)" placeholder="Enter Endorsement Name" value="<?php if (isset($endorsement_name)) echo $endorsement_name; ?>" tabindex="33">
										<span class="text-danger" id="endorsementnameCheck"> Enter Endorsement Name</span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="en_RC"> RC </label> <span class="required">&nbsp;*</span>
										<select type="text" class="form-control" id="en_RC" name="en_RC" tabindex="34">
											<option value=""> Select RC </option>
											<option value="0" <?php if (isset($en_RC) and $en_RC == '0') echo 'selected'; ?>> YES </option>
											<option value="1" <?php if (isset($en_RC) and $en_RC == '1') echo 'selected'; ?>> NO </option>
										</select>
										<span class="text-danger" id="enRCCheck"> Select RC </span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" id="RCdocUpd" style="display: none;">
									<div class="form-group">
										<label for="RC_document_upd"> RC Uploads </label> <span class="required">&nbsp;*</span>
										<input type="file" class="form-control" id="RC_document_upd" name="Rc_document_upd" tabindex="35">
										<input type="hidden" id="rc_doc_upd" name="rc_doc_upd" value="<?php if (isset($Rc_document_upd)) echo $Rc_document_upd; ?>">
										<!-- <a href="<?php echo "uploads/verification/endorsement_doc/" . $Rc_document_upd; ?>" target="_blank" > <?php if (isset($Rc_document_upd)) echo $Rc_document_upd; ?>  </a> -->
										<span class="text-danger" id="rcdocUpdCheck"> Upload RC </span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="en_Key"> Key </label> <span class="required">&nbsp;*</span>
										<select type="text" class="form-control" id="en_Key" name="en_Key" tabindex="36">
											<option value=""> Select Key </option>
											<option value="0" <?php if (isset($en_Key) and $en_Key == '0') echo 'selected'; ?>> YES </option>
											<option value="1" <?php if (isset($en_Key) and $en_Key == '1') echo 'selected'; ?>> NO </option>
										</select>
										<span class="text-danger" id="enKeyCheck"> Select Key </span>
									</div>
								</div>

								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
									<div class="form-group">
										<label for="endorsependingchk"> Pending </label> <span class="required">&nbsp;*</span>
										<label class="switch">
											<input type="checkbox" value="YES" id="endorsependingchk" name="endorsependingchk" checked tabindex="37">
											<span class="slider round"></span>
										</label>
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- Endorsement Info  End-->
					<!-- Gold Info Start -->
					<div class="card">
						<div class="card-header"> Gold Info
							<button type="button" class="btn btn-primary" id="add_gold" name="add_gold" data-toggle="modal" data-target=".addGold" style="padding: 5px 35px;  float: right;"><span class="icon-add"></span></button>
						</div>
						<span class="text-danger" style='display:none' id='Gold_infoCheck'>Please Fill Gold Info </span>
						<div class="card-body">
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group" id="GoldResetTableDiv">
										<table class="table custom-table">
											<thead>
												<tr>
													<th width="50"> S.No </th>
													<th> Gold type </th>
													<th> Purity </th>
													<th> Count </th>
													<th> Weight </th>
													<th> Value </th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Gold Info End -->
					<!-- Documents Info START-->

					<div class="card">
						<div class="card-header"> Documents Info
							<button type="button" class="btn btn-primary" id="add_document" name="add_document" data-toggle="modal" data-target=".addDocument" style="padding: 5px 35px;  float: right;" tabindex="25"><span class="icon-add"></span></button>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group" id="DocResetTableDiv">
										<table class="table custom-table">
											<thead>
												<tr>
													<th width="50"> S.No </th>
													<th> Document Name </th>
													<th> Document Details</th>
													<th> Document Type </th>
													<th> Document Holder</th>
													<th> Holder Name</th>
													<th> Relationship</th>
												</tr>
											</thead>
											<tbody>

											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Document Info End -->

					<div class="col-md-12 ">
						<div class="text-right">
							<button type="submit" name="update_documentation" id="update_documentation" class="btn btn-primary" value="Submit" tabindex="46"><span class="icon-check"></span>&nbsp;Submit</button>
							<button type="reset" class="btn btn-outline-secondary" tabindex="47">Clear</button>
						</div>
					</div>

				</div>
			</div> <!-- Row End -->
		</form>
	</div>

	<!--  ///////////////////////////////////////////////////////////////// Documentation  End ////////////////////////////////////////////////////////// -->

</div>


<!-- Add Family Members Modal -->
<div class="modal fade addGroup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Add Family Info</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeFamModal()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- alert messages -->
				<div id="FamInsertNotOk" class="unsuccessalert"> Name Already Exists, Please Enter a Different Name!
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="FamInsertOk" class="successalert">Family Info Added Succesfully!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="famUpdateok" class="successalert">Family Info Updated Succesfully!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="NotOk" class="unsuccessalert">Please Retry!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="FamDeleteNotOk" class="unsuccessalert"> Please Retry to Delete Family Info!
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="FamDeleteOk" class="unsuccessalert"> Family Info Has been Deleted!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<br />

				<div class="row" id="editFam">

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

						<div class="form-group">
							<label class="label"> Name </label>&nbsp;<span class="text-danger">*</span>
							<input type="text" class="form-control" name="famname" id="famname" onkeydown="return /[a-z ]/i.test(event.key)">
							<span class="text-danger" id="famnameCheck">Enter Name</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="relationship"> Relationship </label> &nbsp;<span class="text-danger">*</span>
							<select type="text" class="form-control" id="relationship" name="relationship">
								<option value=""> Select Relationship </option>
								<option value="Father"> Father </option>
								<option value="Mother"> Mother </option>
								<option value="Spouse"> Spouse </option>
								<option value="Son"> Son </option>
								<option value="Daughter"> Daughter </option>
								<option value="Brother"> Brother </option>
								<option value="Sister"> Sister </option>
								<option value="Other"> Other </option>
							</select>
							<span class="text-danger" id="famrelationCheck">Select Relationship</span>
						</div>
					</div>

					<div id="remark" style="display: none" class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="other_remark"> Remark</label>
							<input type="text" class="form-control" name="other_remark" id="other_remark">
							<span class="text-danger" id="famremarkCheck">Enter Remark</span>
						</div>
					</div>

					<div id="address" style="display: none" class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="other_address"> Address </label>
							<input type="text" class="form-control" name="other_address" id="other_address">
							<span class="text-danger" id="famaddressCheck">Enter Address</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label class="label"> Age </label>&nbsp;<span class="text-danger">*</span>
							<input type="number" class="form-control" name="relation_age" id="relation_age">
							<span class="text-danger" id="famageCheck">Enter Age</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label class="label"> Aadhar No </label>&nbsp;<span class="text-danger">*</span>
							<input type="text" class="form-control" name="relation_aadhar" id="relation_aadhar" data-type="adhaar-number" maxlength="14">
							<span class="text-danger" id="famaadharCheck">Enter Aadhar Number</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label class="label"> Mobile No </label>&nbsp;<span class="text-danger">*</span>
							<input type="number" class="form-control" name="relation_Mobile" id="relation_Mobile" maxlength="10" onkeypress="if(this.value.length==10) return false;">
							<span class="text-danger" id="fammobileCheck">Enter Mobile Number</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label class="label"> Occupation </label>&nbsp;<span class="text-danger">*</span>
							<input type="text" class="form-control" name="relation_Occupation" id="relation_Occupation" onkeydown="return /[a-z ]/i.test(event.key)">
							<span class="text-danger" id="famoccCheck">Enter Occupation</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label class="label"> Income </label>&nbsp;<span class="text-danger">*</span>
							<input type="number" class="form-control" name="relation_Income" id="relation_Income">
							<span class="text-danger" id="famincomeCheck">Enter Income</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label class="label"> Blood Group </label>&nbsp;
							<input type="text" class="form-control" name="relation_Blood" id="relation_Blood">
						</div>
					</div>


					<div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12">
						<input type="hidden" name="famID" id="famID">
						<button type="button" tabindex="2" name="submitFamInfoBtn" id="submitFamInfoBtn" class="btn btn-primary" style="margin-top: 19px;">Submit</button>
					</div>

				</div>
				</br>

				<div id="updatedFamTable">
					<table class="table custom-table modalTable">
						<thead>
							<tr>
								<th width="50">S.No</th>
								<th>Name</th>
								<th>Relationship</th>
								<th>ACTION</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeFamModal()">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- END  Add Family Members Modal -->

<!-- Add Property Modal  START -->
<div class="modal fade addproperty" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Add Property Info</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetPropertyinfoList()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- alert messages -->
				<div id="prptyInsertOk" class="successalert"> Property Info Added Succesfully!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="prptyUpdateok" class="successalert"> Property Info Updated Succesfully!<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="prptyNotOk" class="unsuccessalert"> Something Went Wrong!
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="prptyDeleteOk" class="successalert"> Property Info Deleted!
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="prptyDeleteNotOk" class="unsuccessalert"> Property Info not Deleted <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<br />

				<div class="row">

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label> Property Type </label><span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="property_typ" name="property_typ" placeholder="Enter Property Type" onkeydown="return /[a-z ]/i.test(event.key)">
							<span class="text-danger" id="prtytypeCheck">Enter Property Type</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="property_measurement"> Property Measurement </label><span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="property_measurement" name="property_measurement" placeholder="Enter Property Measurement">
							<span class="text-danger" id="prtymeasureCheck">Enter Property Measurement</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="property_value"> Property Value </label><span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="property_value" name="property_value" placeholder="Enter Property Value">
							<span class="text-danger" id="prtyvalCheck">Enter Property Value</span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="property_holder"> Property Holder </label><span class="required">&nbsp;*</span>
							<select type="number" class="form-control" id="property_holder" name="property_holder">
								<option> Select Property Holder </option>
							</select>
							<span class="text-danger" id="prtyholdCheck">Select Property Holder </span>
						</div>
					</div>

					<div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12">
						<input type="hidden" name="propertyID" id="propertyID">
						<button type="button" tabindex="2" name="propertyInfoBtn" id="propertyInfoBtn" class="btn btn-primary" style="margin-top: 19px;">Submit</button>
					</div>

				</div>
				</br>

				<div id="propertyTable">
					<table class="table custom-table modalTable">
						<thead>
							<tr>
								<th width="50"> S.No </th>
								<th> Property Type </th>
								<!-- <th> Property Measurement </th> -->
								<th> Property Value </th>
								<th> Property Holder </th>
								<th> ACTION </th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="resetPropertyinfoList()">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- END  Add Property Modal -->

<!-- Add Bank info Modal  START -->
<div class="modal fade addbank" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Add Bank Info</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetbankinfoList()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- alert messages -->
				<div id="bankInsertOk" class="successalert"> Bank Info Added Successfully
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="bankUpdateok" class="successalert"> Bank Info Updated Succesfully! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="bankNotOk" class="unsuccessalert"> Something Went Wrong! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="bankDeleteOk" class="unsuccessalert"> Bank Info Deleted
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="bankDeleteNotOk" class="unsuccessalert"> Bank Info not Deleted <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<br />

				<div class="row">

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="bank_name"> Bank Name </label> <span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter Bank Name" onkeydown="return /[a-z ]/i.test(event.key)">
							<span class="text-danger" id="bankNameCheck"> Enter Bank Name </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="branch_name"> Branch Name </label> <span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Enter Branch Name" onkeydown="return /[a-z ]/i.test(event.key)">
							<span class="text-danger" id="branchCheck"> Enter Branch Name </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="account_holder_name"> Account Holder Name </label> <span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="account_holder_name" name="account_holder_name" placeholder="Enter Account Holder Name" onkeydown="return /[a-z ]/i.test(event.key)">
							<span class="text-danger" id="accholdCheck"> Enter Account Holder Name </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="account_number"> Account Number </label> <span class="required">&nbsp;*</span>
							<input type="number" class="form-control" id="account_number" name="account_number" placeholder="Enter Account Number">
							<span class="text-danger" id="accnoCheck"> Enter Account Number </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="Ifsc_code"> IFSC Code </label> <span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="Ifsc_code" name="Ifsc_code" placeholder="Enter IFSC Code">
							<span class="text-danger" id="ifscCheck"> Enter IFSC Code </span>
						</div>
					</div>

					<div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12">
						<input type="hidden" name="bankID" id="bankID">
						<button type="button" tabindex="2" name="bankInfoBtn" id="bankInfoBtn" class="btn btn-primary" style="margin-top: 19px;">Submit</button>
					</div>

				</div>
				</br>

				<div id="bankTable">
					<table class="table custom-table modalTable">
						<thead>
							<tr>
								<th width="50"> S.No </th>
								<th> Bank Name </th>
								<!-- <th> Branch Name </th> -->
								<th> Account Holder Name </th>
								<th> Account Number </th>
								<!-- <th> IFSC Code </th> -->
								<th> ACTION </th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="resetbankinfoList()">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- END  Add Bank Info Modal -->

<!-- Add Signed Doc info Modal  START -->
<div class="modal fade addSignDoc" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<form method="POST" enctype="multipart/form-data"  id="signDocUploads">
	<input type="hidden" name="doc_req_id" id="doc_req_id" value="<?php if(isset($req_id)){echo $req_id;} ?>" >
	<input type="hidden" name="doc_cus_id" id="doc_cus_id" value="<?php if(isset($cus_id)){echo $cus_id;} ?>" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Add Signed Doc Info</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetsigninfoList()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- alert messages -->
				<div id="signInsertOk" class="successalert"> Signed Doc Info Uploaded Successfully
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="signUpdateok" class="successalert"> Signed Doc Info Updated Succesfully! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="signNotOk" class="unsuccessalert"> Something Went Wrong! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="signDeleteOk" class="unsuccessalert"> Signed Doc Info Deleted
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="signDeleteNotOk" class="unsuccessalert"> Signed Doc Info not Deleted <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<br />

				<div class="row">

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="DocName "> Doc Name </label> <span class="required">&nbsp;*</span>
							<select type="text" class="form-control" id="doc_name" name="doc_name" disabled>
								<option value=""> Select Doc Name </option>
								<option value="0"> Promissory Note </option>
								<option value="1"> Stamp Paper </option>
								<option value="2"> P Additional </option>
								<option value="3"> S Additional </option>
							</select>
							<span class="text-danger" id="docNameCheck"> Select Doc Name </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="SignType"> Sign Type </label> <span class="required">&nbsp;*</span>
							<select type="text" class="form-control" id="sign_type" name="sign_type" disabled>
								<option value=""> Select Sign Type </option>
								<option value="0"> Customer </option>
								<option value="1"> Guarantor </option>
								<option value="2"> Combined </option>
								<option value="3"> Family Members </option>
							</select>
							<span class="text-danger" id="signTypeCheck"> Select Sign Type </span>
						</div>
					</div>


					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12" style="display: none;" id="relation_doc">
						<div class="form-group">
							<label for="signRelationship"> Relationship </label>
							<select type="text" class="form-control" id="signType_relationship" name="signType_relationship" disabled>
								<option value=""> Select Relationship </option>
							</select>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="Count"> Count </label> <span class="required">&nbsp;*</span>
							<input type="number" class="form-control" id="doc_Count" name="doc_Count" placeholder="Enter Count" readonly>
							<span class="text-danger" id="docCountCheck"> Enter Count </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="upd"> Uploads </label>
							<input type="file" class="form-control" id="signdoc_upd" name="signdoc_upd[]" multiple onchange="filesCount()">
							<span class="text-danger" id="docupdCheck" style="display: none;"> Upload Document </span>
						</div>
					</div>

					<div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12">
						<input type="hidden" name="signedID" id="signedID">
						<button type="submit" name="signInfoBtn" id="signInfoBtn" class="btn btn-primary" style="margin-top: 19px;">Submit</button>
					</div>
				
				</div>
				</br>

				<div id="signTable" style="overflow-x: auto;">
					<table class="table custom-table modalTable">
						<thead>
							<tr>
								<th width="50"> S.No </th>
								<th> Doc Name </th>
								<th> Sign Type </th>
								<th> Relationship </th>
								<th> Count </th>
								<th> ACTION </th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="resetsigninfoList()">Close</button>
			</div>
		</div>
	</div>
	</form>
</div>
<!-- END  Add Signed Doc Info Modal -->

<!-- Add Cheque info Modal  START -->
<div class="modal fade addCheque" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<form method="POST" enctype="multipart/form-data"  id="chequeUploads">
	<input type="hidden" name="cheque_req_id" id="cheque_req_id" value="<?php if(isset($req_id)){echo $req_id;} ?>" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Add Cheque Info</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="chequeinfoList()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- alert messages -->
				<div id="chequeInsertOk" class="successalert"> Cheque Info Uploaded Successfully
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="chequeUpdateok" class="successalert"> Cheque Info Updated Succesfully! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="chequeNotOk" class="unsuccessalert"> Something Went Wrong! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="chequeDeleteOk" class="unsuccessalert"> Cheque Info Deleted
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="chequeDeleteNotOk" class="unsuccessalert"> Cheque Info not Deleted <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<br />

				<div class="row">

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="Holdertype "> Holder type </label> <span class="required">&nbsp;*</span>
							<select type="text" class="form-control" id="holder_type" name="holder_type" disabled>
								<option value=""> Select Holder type </option>
								<option value="0"> Customer </option>
								<option value="1"> Guarantor </option>
								<option value="2"> Family Members </option>
							</select>
							<span class="text-danger" id="holdertypeCheck"> Select Holder type </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="HolderName "> Holder Name </label>
							<input type="text" class="form-control" id="holder_name" name="holder_name" readonly>

							<select type="text" class="form-control" id="holder_relationship_name" name="holder_relationship_name" style="display: none;" disabled>
								<option value=""> Select Holder Name </option>
							</select>
						</div>
					</div>


					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="chequeRelationship"> Relationship </label>
							<input type="text" class="form-control" id="cheque_relation" name="cheque_relation" readonly>

						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="BankName"> Bank Name </label> <span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="chequebank_name" name="chequebank_name" placeholder="Enter Bank Name" onkeydown="return /[a-z ]/i.test(event.key)" readonly>
							<span class="text-danger" id="chequebankCheck"> Enter Bank Name </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="chequeNo"> Cheque Count </label> <span class="required">&nbsp;*</span>
							<input type="number" class="form-control" id="cheque_count" name="cheque_count" placeholder="Enter Cheque Count" readonly>
							<span class="text-danger" id="chequeCountCheck"> Enter Cheque Count </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="upd"> Uploads </label>
							<input type="file" class="form-control" id="cheque_upd" name="cheque_upd[]" multiple  onchange="chequefilesCount()">
							<span class="text-danger" id="chequeupdCheck"> Upload Cheque </span>
						</div>
					</div>
				</div>

				<div class="row" id="chequeColumnDiv">  </div>

				<div class="row">
					<div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12">
						<input type="hidden" name="chequeID" id="chequeID">
						<button type="submit" name="chequeInfoBtn" id="chequeInfoBtn" class="btn btn-primary" style="margin-top: 19px;">Submit</button>
					</div>
				</div>
				</br>


				<div id="chequeTable" style="overflow-x: auto;">
					<table class="table custom-table">
						<thead>
							<tr>
								<th width="50"> S.No </th>
								<th> Holder type </th>
								<th> Holder Name </th>
								<th> Relationship </th>
								<th> Bank Name </th>
								<th> Cheque No </th>
								<th> ACTION </th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="chequeinfoList();">Close</button>
			</div>
		</div>
	</div>
</form>
</div>
<!-- END  Add Cheque Info Modal -->

<!-- Add Customer Label Modal  START -->
<div class="modal fade addCusLabel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Add Customer Feedback </h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="feedbackList()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- alert messages -->
				<div id="feedbackInsertOk" class="successalert"> Feedback Added Successfully
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="feedbackUpdateok" class="successalert"> Feedback Updated Succesfully! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="feedbackNotOk" class="unsuccessalert"> Something Went Wrong! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="feedbackDeleteOk" class="unsuccessalert"> Feedback Deleted
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="feedbackDeleteNotOk" class="unsuccessalert"> Feedback not Deleted <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<br />

				<div class="row">

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="feedback_label"> Feedback Label </label> <span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="feedback_label" name="feedback_label" onkeydown="return /[a-z ]/i.test(event.key)" placeholder="Enter Feedback Label">
							<span class="text-danger" id="feedbacklabelCheck"> Enter Feedback Label </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="cus_feedback"> Feedback </label> <span class="required">&nbsp;*</span>
							<select type="text" class="form-control" id="cus_feedback" name="cus_feedback">
								<option value=""> Select Feedback </option>
								<option value="1"> Bad </option>
								<option value="2"> Poor </option>
								<option value="3"> Average </option>
								<option value="4"> Good </option>
								<option value="5"> Excellent </option>
							</select>
							<span class="text-danger" id="feedbackCheck"> Select Feedback </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12"></div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
						<div class="form-group">
							<label for="feedback_remark"> Remarks </label>
							<textarea class="form-control" name="feedback_remark" id="feedback_remark"></textarea>
						</div>
					</div>

					<div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-12"></div>
					<div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12">
						<input type="hidden" name="feedbackID" id="feedbackID">
						<button type="button" name="feedbackBtn" id="feedbackBtn" class="btn btn-primary" style="margin-top: 19px;"> Submit </button>
					</div>
				</div>
				</br>


				<div id="feedbackTable">
					<table class="table custom-table">
						<thead>
							<tr>
								<th width="50"> S.No </th>
								<th> Feedback Label </th>
								<th> Feedback </th>
								<th> ACTION </th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="feedbackList();">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- END  Add Customer Label Info Modal -->

<!-- Add Gold info Modal  START -->
<div class="modal fade addGold" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Add Gold Info</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="goldinfoList()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- alert messages -->
				<div id="goldInsertOk" class="successalert"> Gold Info Added Successfully
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="goldUpdateok" class="successalert"> Gold Info Updated Succesfully! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="goldNotOk" class="unsuccessalert"> Something Went Wrong! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="goldDeleteOk" class="unsuccessalert"> Gold Info Deleted
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="goldDeleteNotOk" class="unsuccessalert"> Gold Info not Deleted <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<br />

				<div class="row">

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="gold_sts"> Gold Status </label> <span class="required">&nbsp;*</span>
							<select type="text" class="form-control" id="gold_sts" name="gold_sts">
								<option value=""> Select Gold Status </option>
								<option value="0"> Old </option>
								<option value="1"> New </option>
							</select>
							<span class="text-danger" id="GoldstatusCheck"> Select Gold Status </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="gold_type"> Gold Type </label> <span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="gold_type" name="gold_type" placeholder="Enter Gold Type">
							<span class="text-danger" id="GoldtypeCheck"> Enter Gold Type </span>
						</div>
					</div>


					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="Purity"> Purity </label> <span class="required">&nbsp;*</span>
							<input type="text" class="form-control" id="Purity" name="Purity" placeholder="Enter Purity">
							<span class="text-danger" id="purityCheck"> Enter Purity </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="gold_Count"> Count </label> <span class="required">&nbsp;*</span>
							<input type="number" class="form-control" id="gold_Count" name="gold_Count" placeholder="Enter Count">
							<span class="text-danger" id="goldCountCheck"> Enter Count </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="gold_Weight"> Weight </label> <span class="required">&nbsp;*</span>
							<input type="number" class="form-control" id="gold_Weight" name="gold_Weight" placeholder="Enter Weight in Grams">
							<span class="text-danger" id="goldWeightCheck"> Enter Weight </span>
						</div>
					</div>

					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
						<div class="form-group">
							<label for="gold_Value"> Value </label> <span class="required">&nbsp;*</span>
							<input type="number" class="form-control" id="gold_Value" name="gold_Value" placeholder="Enter Value">
							<span class="text-danger" id="goldValueCheck"> Enter Value </span>
						</div>
					</div>

					<div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12">
						<input type="hidden" name="goldID" id="goldID">
						<button type="button" name="goldInfoBtn" id="goldInfoBtn" class="btn btn-primary" style="margin-top: 19px;">Submit</button>
					</div>
				</div>
				</br>


				<div id="goldTable">
					<table class="table custom-table">
						<thead>
							<tr>
								<th width="50"> S.No </th>
								<th> Gold Status </th>
								<th> Purity </th>
								<th> Count </th>
								<th> Weight </th>
								<th> Value </th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="goldinfoList()">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- END  Add Gold Info Modal -->

<!-- Add Document info Modal  START -->
<div class="modal fade addDocument" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
<form method="POST" enctype="multipart/form-data"  id="docUploads">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" style="background-color: white">
			<div class="modal-header">
				<h5 class="modal-title" id="myLargeModalLabel">Add Document Info</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="docinfoList()">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- alert messages -->
				<div id="docInsertOk" class="successalert"> Document Info Added Successfully
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="docUpdateok" class="successalert"> Document Info Updated Succesfully! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="docNotOk" class="unsuccessalert"> Something Went Wrong! <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="docDeleteOk" class="unsuccessalert"> Document Info Deleted
					<span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<div id="docDeleteNotOk" class="unsuccessalert"> Document Info not Deleted <span class="custclosebtn" onclick="this.parentElement.style.display='none';"><span class="icon-squared-cross"></span></span>
				</div>

				<br />

				<div class="row">

				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
					<div class="form-group">
						<label for="Documentname "> Document name </label> <span class="required">&nbsp;*</span>
						<input type="text" class="form-control" id="document_name" name="document_name" placeholder="Enter Document name" value="" tabindex="1" readonly />
						<span class="text-danger" id="documentnameCheck"> Enter Document name </span>
					</div>
				</div>

				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
					<div class="form-group">
						<label for="DocumentDeatails "> Document Details </label> <span class="required">&nbsp;*</span>
						<input type="text" class="form-control" id="document_details" name="document_details" placeholder="Enter Document Details" value="" tabindex="2" readonly />
						<span class="text-danger" id="documentdetailsCheck"> Enter Document Details </span>
					</div>
				</div>

				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
					<div class="form-group">
						<label for="Documenttype"> Document Type </label> <span class="required">&nbsp;*</span>
						<select type="text" class="form-control" id="document_type" name="document_type" tabindex="3" disabled>
							<option value=''> Select Document Type </option>
							<option value='0' > Original </option>
							<option value='1' > Xerox </option>
						</select>
						<span class="text-danger" id="documentTypeCheck"> Select Document Type </span>
					</div>
				</div>

				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
					<div class="form-group">
						<label for="DocumentHolder"> Document Holder </label> <span class="required">&nbsp;*</span>
						<select type="text" class="form-control" id="document_holder" name="document_holder" tabindex="4" disabled>
							<option value=""> Select Holder type </option>
							<option value="0" > Customer </option>
							<option value="1" > Guarantor </option>
							<option value="2" > Family Members </option>
						</select>
						<span class="text-danger" id="docholderCheck"> Select Document Holder </span>
					</div>
				</div>

				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
					<div class="form-group">
						<label for="docholdername"> Holder Name </label>
						<input type="text" class="form-control" id="docholder_name" name="docholder_name" value="" readonly tabindex="5" readonly>

						<select type="text" class="form-control" id="docholder_relationship_name" name="docholder_relationship_name" style="display: none;" tabindex="6" disabled>
							<option value=""> Select Relationship </option>
						</select>
					</div>
				</div>


				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
					<div class="form-group">
						<label for="DocRelationship"> Relationship </label>
						<input type="text" class="form-control" id="doc_relation" name="doc_relation" value="" readonly tabindex="7" >
					</div>
				</div>

				<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
					<div class="form-group">
						<label for="DocumentUpd"> Document Uploads </label>
						<input type="file" class="form-control" id="document_info_upd" name="document_info_upd[]"  multiple tabindex="8">
					</div>
				</div>

					<div class="col-xl-2 col-lg-2 col-md-6 col-sm-4 col-12">
						<input type="hidden" name="doc_info_id" id="doc_info_id" value=''>
						<button type="button" name="docInfoBtn" id="docInfoBtn" class="btn btn-primary" style="margin-top: 19px;" tabindex="9">Submit</button>
					</div>
				</div>
				</br>


				<div id="docModalDiv" style="overflow-x: auto;">
					<table class="table custom-table">
						<thead>
							<tr>
								<th width="50"> S.No </th>
								<th> Document Name </th>
								<th> Document Details</th>
								<th> Document Type </th>
								<th> Document Holder</th>
								<th> Holder Name</th>
								<th> Relationship</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="docinfoList()">Close</button>
			</div>
		</div>
	</div>
</form>
</div>
<!-- END  Add Document Info Modal -->