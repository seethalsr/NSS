<?php //print_r($batch_list);exit; ?>
<link href="<?php echo base_url();?>tab/css/bootstrap.min.css" rel="stylesheet">   
<link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet"> 
<form id="frm" name="frm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr>
<td height="31"><span class="w3-center" ><?php if(isset($msg)){?>
<h6  style="color:#FF8040; "><?php echo $msg; ?></h6><?php }?></span></td></tr>
<tr>
<td class="w3-center"><span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">NSS Enrolled List</span></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table cellpadding="0" cellspacing="0" width="100%" >
<tr>
<td width="15%" height="74"><label class=" control-label" >Select College Type</label></td>
<td width="2%"></td>
<td width="18%">
<select id="type" name="type" class="form-control" <?php if(isset($college_type)|| isset($msg)){ ?> onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($nss_college_type as $value1): ?>
<option value="<?php echo $value1['nss_college_type'] ?>" 
<?php if(set_value("type")==$value1['nss_college_type']) echo "selected";?>> <?php  if($value1['nss_college_type']=="SF") echo"SELF FINANCING"; elseif($value1['nss_college_type'] =="REG")echo"REGULAR";  ?></option>
<?php endforeach; ?>
</select>
</td>
<td width="3%"></td>
<td width="14%"><label class=" control-label" >Select College Name</label></td>
<td width="48%">
<select id="name" name="name" class="form-control" <?php if(isset($college_name)|| isset($msg)){ ?>onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($college_name_sel as $value): ?>
<option value="<?php echo $value['college_id'] ?>" 
<?php if(set_value("name")==$value['college_id']) echo "selected";?>> <?php echo $value['college_name'] ?></option>
<?php endforeach; ?>
</select>
</td>
</tr>
<tr><td colspan="7">&nbsp; </td></tr>
<tr>
<?php if(isset($batch_list)&& !empty($batch_list)){?>
<td width="15%" height="74"><label class=" control-label" >Select Batch </label></td>
<td width="2%"></td>
<td width="18%">
<select id="batch" name="batch" class="form-control" <?php if(isset($college_type)|| isset($msg)){ ?> onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($batch_list as $valueb): ?>
<option value="<?php echo $valueb['batch_period'] ?>" 
<?php if(isset($sel_batch) && $sel_batch==$valueb['batch_period']) echo "selected";?>> <?php echo $valueb['batch_period'] ?></option>
<?php endforeach; ?>
</select>
<?php } ?>
</td>
<td width="3%"></td>
<?php if(isset($unit_list)){?>
<td width="14%"><label class=" control-label" >Select Unit</label></td>
<td width="48%">
<select id="unit" name="unit" class="form-control" <?php if(isset($unit_list)){ ?> onchange="this.form.submit()"<?php } ?>>
  <option value="">---Select---</option>
  <?php foreach ($unit_list as $value1): ?>
  <option value="<?php echo $value1['nss_unit_id']; ?>" 
			  <?php if(set_value("unit")==$value1['nss_unit_id']) echo "selected";?>> <?php echo $value1['nss_unit_id'];?></option>
  <?php endforeach; ?>
</select>
</td>
<?php } ?>
</tr>

</table>
</td></tr>
</table>
<?php if(isset($enroll_list)&& !empty($enroll_list)){	 ?>
<div class="w3-card w3-center" style="margin-top:15px; margin-bottom:20px;font-size:18px; color:#000080; font-weight:bold;">
<?php if($enroll_list[0]['verification_id']=="3"){?>
STATUS : FORWARD TO SO
<?php }elseif($enroll_list[0]['verification_id']=="3R"){ ?>
STATUS : REJECTED BY SO
<?php }elseif($enroll_list[0]['verification_id']=="4"){ ?>
STATUS : ACCEPTED BY SO
<?php } elseif($enroll_list[0]['verification_id']=="2R"){ ?>
STATUS : REJECTED BY ASSISTANT, FORWARDED TO SO ---- REMARKS:<?php echo $enroll_list[0]['remarks'] ; } }?>
</div>
<?php if(isset($count_stud)&&($count_stud)){?><span style="color:#0080FF; font-weight:bold;padding-left:40%"> TOTAL NUMBER OF STUDENT <?php echo $count_stud; ?> </span><?php }?>
	 <!-- table-->
  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive " cellspacing="0" cellpadding="0" width="100%" height="100%">
                      <thead>
                        <tr>
						  <th width="14%">Admission Year-Semester</th>
                          
						   <th width="14%">PRN NO:</th> 
                          <th width="40%">Name</th> 
                           
                          <th width="10%">Mobile No:</th>   
                          <th width="10%">Gender</th>
                          <th width="10%">Cast</th> 
                          <th width="10%">Enrollment No:</th>                   
					 </tr>
                      </thead>
                      <tbody>
					  <?php if(!empty($enroll_list)){?>
					  <?php foreach ($enroll_list as $value ){ ?>
                        <tr>
                         <td><?php echo $value['admission_year'] ;?>[<?php echo $value['current_semester'] ;?> Semester]</td>
                         
						  <td><?php echo $value['account_id']; ?></td>
                          <td><?php echo $value['account_student_name']; ?></td>
                          
                          <td><?php echo $value['account_student_mobileno']; ?></td>
                         <td><?php if($value['gender']=="F") {echo "FEMALE" ;}elseif($value['gender']=='M'){ echo "MALE";}
						  else {echo"OTHER" ;}?></td>
                          <td><?php echo $value['cast']; ?></td>
                          <td><?php echo $value['nss_enroll_id']; ?></td>
                        </tr>                   
                       <?php }?>
					   <?php }?>
                      </tbody>
                    </table>

<?php if( isset($enroll_list) && !empty($enroll_list) && $enroll_list[0]['verification_id']=="2"){ ?>
<div class="w3-center">		
<input type="submit" class="btn btn-primary" value="ACCEPTED AND FORWARD TO SO" name="fwdassi" id="fwdassi" style="background-color:#0080C0; color:#FFF"/>
<button type="button" class="btn " data-toggle="modal" data-target="#Rejected" style="background-color:#FF7D7D; color:#FFFFFF" >REJECTED AND FORWARD TO SO</button>
<div class="modal fade" id="Rejected" tabindex="-1" role="dialog" aria-labelledby="RejectedLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reason for Rejection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>        </button>
      </div>
      <div class="modal-body">
                    <textarea id="remarktxt1" name="remarktxt1" rows="5" cols="100" class="form-control"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="rejassisubmit" id="rejassisubmit" value="Submit"/>
      </div>
    </div>
  </div>
</div>
</div>
<?php }?>
</form>
 <!-- jQuery need -->
    <script src="<?php echo base_url();?>tab/js/jquery.min.js"></script>
    <!-- Bootstrap need -->
    <script src="<?php echo base_url();?>tab/js/bootstrap.min.js"></script>   
    <!-- Datatables -need-->
    <script src="<?php echo base_url();?>tab/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>tab/js/dataTables.bootstrap.min.js"></script><!--pagination- pointer not that mauch important-->   
    <!-- Custom Theme Scripts need -->
    <script src="<?php echo base_url();?>tab/js/custom.min.js"></script>