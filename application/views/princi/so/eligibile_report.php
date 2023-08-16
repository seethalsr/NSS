<?php //echo $user_type; ?>
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
<select id="type" name="type" class="form-control" <?php if(isset($nss_college_type)|| isset($msg)){ ?> onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($nss_college_type as $value1): ?>
<option value="<?php echo $value1['nss_college_type'] ?>" 
<?php if(set_value("type")==$value1['nss_college_type']) echo "selected";?>> <?php if($value1['nss_college_type']=="SF") echo"SELF FINANCING"; elseif($value1['nss_college_type'] =="REG")echo"REGULAR";  ?></option>
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
<?php if(isset($eli_det)&& !empty($eli_det)){	 ?>
 
	 <!-- table-->
 <div class="col-md-12 col-sm-12 col-xs-12 " ><div><div class="x_content">
   <h4 class="w3-center"><fntn>LIST OF ELIGIBLE REPORT </fntn></h4>
	<hr />
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						   <th>Sl.No:</th>
                          <th>Enroll No:</th>
                          <th>PRN:</th>
                          <th>Student name</th>
                          <th>Course</th>
                          <th>Special Camp</th>
                          <th>Mini Camp 1</th>
                          <th>Mini Camp 2</th>
                          <th>Total Hour</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                       <?php if(isset($eli_det)&& (!empty($eli_det))){?>
                      <tbody>
					   <?php $i = 0; foreach($eli_det as $value){ $i++; ?>
                      <?php if($value['elig']=='Y')
                      $style = "#92C9C9";
					  else 
                      $style = "#FBB" ;
					   ?>
					  <tr style="background-color:<?php echo $style; ?>"
                      ><td><?php echo $i;?></td>
                      <td><?php echo $value['nss_enroll_id'];?></td>
                       <td><?php echo $value['account_id'];?></td>
                      <td><?php echo $value['account_student_name'];?></td>
                      <td><?php echo $value['specialisation_id'];?></td>
                      <td><?php if($value['splcamp']=='Y')echo 'YES'; else echo'NO' ; ?></td>
                      <td><?php if($value['mini1']=='Y')echo 'YES'; else echo'NO' ; ?></td>
                      <td><?php if($value['mini2']=='Y')echo 'YES'; else echo'NO' ;  ?></td>
                      <td><?php echo $value['tot_hr'];?></td>
                      <td><?php if($value['elig']=='Y')echo 'ELIGIBILE'; else echo'INELIGIBILE' ;?></td>
                      </tr>
                      <?php } ?>
                      </tbody>
                      <?php } ?>
                    </table>
 </div></div></div>
 <?php } ?>

 
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