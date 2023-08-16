
<div class="w3-center" style="padding-bottom:20px">
    		<span ><?php if(isset($msg)){?><h6  style="color:#FF8040; "><?php echo $msg; ?></h6><?php }?></span><br>
        	<span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">STUDENTS LIST</span>
	</div>
    
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
<?php if(isset($batch_list)&&!empty($batch_list)){?>
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

<table id="datatable"  width="100%" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" >
                      <thead>
                        <tr>
						  <th width="4%">Sl.No:</th>
						  <th width="10%">Admission Year</th>
                          <th width="6%">Semester</th>                          
                          <th width="23%">Student Name</th>
                          <th width="14%">Email </th>
                          <th width="5%">NSS Unit</th>
						  <th width="17%">Enrolled Date</th>
                          <th width="8%">Blood Group </th>
                          <th width="13%">Donate Blood</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $i=0;foreach ($student_list as $value ){$i++; ?>
                        <tr   class="wordbreak">
						
                          <td><?php echo $i; ?></td>
						  <td><?php echo $value['admission_year'] ?></td>
                          <td><?php echo $value['current_semester'] ?></td>
						  <td><?php echo $value['account_student_name']?></td>
                          <td><?php echo $value['account_student_email']?></td>
                          <td><?php echo $value['nss_enroll_unit'] ?></td>
                          <td><?php if($value['enrolled_date']!="0000-00-00 00:00:00"){echo 
						  date("d-m-Y", strtotime($value['enrolled_date']));}else{} ?></td>
                          <td><?php echo $value['blood_group'] ?></td>
						  <td><?php echo $value['donate']?></td>
                        
                        </tr>                   
                       <?php }?>
                      </tbody>
                    </table>
					