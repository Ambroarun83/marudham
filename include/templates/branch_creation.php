<?php 
@session_start();
if(isset($_SESSION["userid"])){
    $userid = $_SESSION["userid"];
} 
$companyName = $userObj->getCompanyName($mysqli);

$id=0;
 if(isset($_POST['submitbranch_creation']) && $_POST['submitbranch_creation'] != '')
 {
    if(isset($_POST['id']) && $_POST['id'] >0 && is_numeric($_POST['id'])){		
        $id = $_POST['id']; 	
    $updateBranchCreationmaster = $userObj->updateBranchCreation($mysqli,$id,$userid);  
    ?>
   <script>location.href='<?php echo $HOSTPATH; ?>edit_branch_creation&msc=2';</script> 
    <?php	}
    else{   
		$addBranchCreation = $userObj->addBranchCreation($mysqli,$userid);   
        ?>
     <script>location.href='<?php echo $HOSTPATH; ?>edit_branch_creation&msc=1';</script>
        <?php
    }
 }   

$del=0;
if(isset($_GET['del']))
{
$del=$_GET['del'];
}
if($del>0)
{
	$deleteBranchCreation = $userObj->deleteBranchCreation($mysqli,$del,$userid); 
	?>
	<script>location.href='<?php echo $HOSTPATH; ?>edit_branch_creation&msc=3';</script>
<?php	
}

if(isset($_GET['upd']))
{
$idupd=$_GET['upd'];
}
$status =0;
if($idupd>0)
{
	$getBranchCreation = $userObj->getBranchCreation($mysqli,$idupd); 
	
	if (sizeof($getBranchCreation)>0) {
        for($ibranch=0;$ibranch<sizeof($getBranchCreation);$ibranch++)  {	
            $branch_id                      = $getBranchCreation['branch_id'];
            $branch_code                      = $getBranchCreation['branch_code'];
			$branch_name          		     = $getBranchCreation['branch_name'];
			$mobile_number      			     = $getBranchCreation['mobile_number'];
			$address1		         = $getBranchCreation['address1'];
			$address2    			         = $getBranchCreation['address2'];
			$state                	 = $getBranchCreation['state'];
            $place                   = $getBranchCreation['place'];
			$pincode       		     = $getBranchCreation['pincode'];
			$email_id     			     = $getBranchCreation['email_id'];
			$district     		             = $getBranchCreation['district']; 
			$taluk     			     = $getBranchCreation['taluk'];
			$whatsapp_number                      = $getBranchCreation['whatsapp_number']; 
            $landline_number                      = $getBranchCreation['landline_number']; 
            $company_name                      = $getBranchCreation['company_name']; 
            
		}
	}
}
?>
   
<!-- Page header start -->
<br><br>
<div class="page-header">
    <div style="background-color:#009688; width:100%; padding:12px; color: #ffff; font-size: 20px; border-radius:5px;">
       Marudham -  Branch Creation 
   </div>
</div><br>
<div class="text-right" style="margin-right: 25px;">
    <a href="edit_branch_creation">
        <button type="button" class="btn btn-primary"><span class="icon-arrow-left"></span>&nbsp; Back</button>
    <!-- <button type="button" class="btn btn-primary"><span class="icon-border_color"></span>&nbsp Edit Employee Master</button> -->
    </a>
</div><br><br>
<!-- Page header end -->

<!-- Main container start -->
<div class="main-container">
<!--------form start-->
<form id = "branch_creation" name="branch_creation" action="" method="post" enctype="multipart/form-data"> 
    <input type="hidden" class="form-control" value="<?php if(isset($branch_id)) echo $branch_id; ?>"  id="id" name="id" aria-describedby="id" placeholder="Enter id">
    <input type="hidden" class="form-control" value="<?php if(isset($state)) echo $state; ?>"  id="state_upd" name="state_upd" aria-describedby="id" placeholder="Enter id">
    <input type="hidden" class="form-control" value="<?php if(isset($district)) echo $district; ?>"  id="district_upd" name="district_upd" aria-describedby="id" placeholder="Enter id">
    <input type="hidden" class="form-control" value="<?php if(isset($taluk)) echo $taluk; ?>"  id="taluk_upd" name="taluk_upd" aria-describedby="id" placeholder="Enter id">
 		<!-- Row start -->
         <div class="row gutters">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
					<div class="card-header">
						<div class="card-title">General Info</div>
					</div>
                    <div class="card-body">

                    	 <div class="row ">
                            <!--Fields -->
                           <div class="col-md-12"> 
                              <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">Company Name</label>&nbsp;<span class="text-danger">*</span>
                                            <select tabindex="1" type="text" class="form-control" id="company_name" name="company_name" tabindex="1" required >
                                                <option value="">Select Company Name</option>   
                                                <?php if (sizeof($companyName)>0) { 
                                                for($j=0;$j<count($companyName);$j++) { ?>
                                                <option <?php if(isset($company_name)) { if($companyName[$j]['company_id'] == $company_name)  echo 'selected'; }  ?> value="<?php echo $companyName[$j]['company_id']; ?>">
                                                <?php echo $companyName[$j]['company_name'];?></option>
                                                <?php }} ?>  
                                            </select> 
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                        <label for="disabledInput">Branch Code</label>

                                            <?php if($idupd == ''){?>
                                                <input type="text" readonly class="form-control" id="branch_code" name="branch_code" placeholder="Enter Branch Code">
                                                    <?php } else { ?>
                                                        <input type="text" readonly class="form-control" id="branch_code1" name="branch_code" value="<?php if(isset($branch_code)) print_r($branch_code); ?>" placeholder="Enter Branch Code">
                                                    <?php } ?>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">Branch Name</label>&nbsp;<span class="text-danger">*</span>
                                            <input type="text" tabindex="2" id="branch_name" name="branch_name" class="form-control" required value="<?php if(isset($branch_name)) echo $branch_name; ?>" placeholder="Enter Branch Name">
                                              <!-- <span id="branch_namecheck" class="text-danger" >Enter Branch Name</span>  -->
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">Address</label>
                                            <input type="text" tabindex="3" id="address1" name="address1" class="form-control"  value="<?php if(isset($address1)) echo $address1; ?>" placeholder="Enter Address">
                                             <!-- <span id="address1check" class="text-danger" >Enter Address1 </span>  -->
                                        </div>
                                    </div>

                                    <!-- <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">Address 2</label>
                                            <input type="text" tabindex="5" id="address2" name="address2" class="form-control"  value="<?php if(isset($address2)) echo $address2; ?>" placeholder="Enter Address 2">
                                              <span id="address2check" class="text-danger" >Enter Address2</span> 
                                        </div>
                                    </div> -->
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">State</label>&nbsp;<span class="text-danger">*</span>
                                            <select type="text" class="form-control" id="state" name="state" required tabindex="4">
												<option value="SelectState">Select State</option>
												<option value="TamilNadu" <?php if(isset($state) && $state == 'TamilNadu') echo 'selected' ?>>Tamil Nadu</option>
												<option value="Puducherry"  <?php if(isset($state) && $state == 'Puducherry') echo 'selected' ?> >Puducherry</option>
											</select>
                                        </div>
                                    </div>
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="form-group">
											<label for="disabledInput">District</label>&nbsp;<span class="text-danger">*</span>
                                            <input type="hidden" class="form-control" id="district1" name="district1" >
                                            <select type="text" class="form-control" id="district" name="district" required tabindex="5">
                                             <?php if($idupd == ''){?>
                                                <option value="Select District">Select District</option>
                                                <?php } else { ?>
                                            <!--    <option value="<?php if(isset($district)) echo $district; ?>"><?php if(isset($district)) echo $district; ?></option>
                                                <?php } ?> -->
											</select>	
                                        </div>
                                    </div>
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">Taluk</label>&nbsp;<span class="text-danger">*</span>
                                            <input type="hidden" class="form-control" id="taluk1" name="taluk1" >
                                            <select type="text" class="form-control" id="taluk" name="taluk" required tabindex="6">
                                                <?php if($idupd == ''){?>
                                                <option value="Select Taluk">Select Taluk</option>
                                                <?php } else { ?>
                                               <!-- <option value="<?php if(isset($taluk)) echo $taluk; ?>"><?php if(isset($taluk)) echo $taluk; ?></option>
                                                <?php } ?> -->
											</select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="inputReadOnly">Place</label>&nbsp;<span class="text-danger">*</span>
                                            <input class="form-control" tabindex="7" id="place" name="place" type="text" required value="<?php if(isset($place)) echo $place; ?>" placeholder="Enter Place">
                                              <!-- <span class="text-danger" id="placecheck">Enter Valid place</span>  -->
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label class="label">Pincode</label>&nbsp;<span class="text-danger">*</span>
                                            <input tabindex="8" type="number" required onkeydown="javascript: return event.keyCode == 69 ? false : true" name="pincode" id="pincode" class="form-control" placeholder="Enter Pincode" value="<?php if(isset($pincode)) echo $pincode; ?>" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==6) return false;">
                                              <!-- <span id="pincodecheck" class="text-danger">Enter Pincode</span>  -->
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            </div></div>
                            <div class="card-header">
						<div class="card-title">Communication Info</div>
					</div>
                    <div class="card-body">
                            <!--Fields -->
                            <div class="row">
                           <div class="col-md-12"> 
                              <div class="row">
                              <div class="col-xl-6 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="inputReadOnly">E-Mail Id</label>
                                            <input class="form-control" tabindex="9" id="email_id" name="email_id" type="text" value="<?php if(isset($email_id)) echo $email_id; ?>" placeholder="Enter Email Id">
                                             <!-- <span class="text-danger" id="email_idcheck">Enter Valid E-mail Id</span> -->
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">Mobile Number</label>
                                            <input tabindex="10" type="number" onkeydown="javascript: return event.keyCode == 69 ? false : true" name="mobile_number" 
                                            id="mobile_number" class="form-control" placeholder="Enter Mobile Number" value="<?php if(isset($mobile_number )) 
                                            echo $mobile_number ; ?>" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;">
                                                <!-- <span id="mobile_nocheck" class="text-danger" >Enter Mobile Number</span>  -->
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">WhatsApp Number</label>
                                            <input tabindex="11" type="number" onkeydown="javascript: return event.keyCode == 69 ? false : true" name="whatsapp_number" 
                                            id="whatsapp_number" class="form-control" placeholder="Enter WhatsApp Number" value="<?php if(isset($whatsapp_number )) 
                                            echo $whatsapp_number ; ?>" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;">

                                              <!-- <span id="whatsapp_numbercheck" class="text-danger" >Enter Whatsapp Number</span>  -->
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="disabledInput">Landline Number</label>
                                            <input tabindex="12" type="number" onkeydown="javascript: return event.keyCode == 69 ? false : true" name="landline_number"
                                             id="landline_number" class="form-control" placeholder="Enter Landline Number" value="<?php if(isset($landline_number )) 
                                             echo $landline_number ; ?>" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;">

                                        </div>
                                    </div>
                                </div>
                            </div>  
                          <div class="col-md-12">
                            <br><br>
                            <div class="text-right">
                                <button type="submit" onclick="submitbranch_creation();" name="submitbranch_creation" id="submitbranch_creation" class="btn btn-primary" value="Submit" tabindex="14">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary" tabindex="15">Clear</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    var loadFile = function(event) {
        var image = document.getElementById("viewimage");
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>



