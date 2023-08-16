<?php //print_r($attendance);exit; ?>

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
<?php if(isset($sel_unit)){?>
<tr>
<td width="22%"><label class=" control-label" style="color:#000; font-size:14px;"> View Details Based on :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td></td>
<td width="12%">
<select id="get_data" name="get_data" class="form-control" onchange="this.form.submit()" >
<option value="">--Select--</option>             
<option value="Y" <?php if(set_value("get_data")== 'Y') echo "selected";?>>YEAR</option> 
<option value="M" <?php if(set_value("get_data")== 'M') echo "selected";?>>MONTH</option> 
<option value="D" <?php if(set_value("get_data")== 'D') echo "selected";?>>DATE</option> 
</select></td>
<td width="10%">&nbsp;</td>
<td width="17%">
<?php if(isset($sel)){
 if($sel == 'Y' || $sel == 'M' ){ ?>	
<select id="get_year" name="get_year" class="form-control"  >
<option value="">--Select Year--</option>    
<?php $value = ''; foreach($year_db as $value){?>         
<option value="<?php echo $value['year'] ;?>" <?php if(set_value("get_year")== $value['year']) echo "selected";?>  ><?php echo $value['year'] ;?></option> 
<?php } ?>
</select>
<?php }elseif($sel == 'D'){ ?>
<input type="text" id="date" name="date" placeholder="DD-MM-YYYY"  />
<?php } ?>
<td width="11%">
<?php if($sel == 'M'  ){ ?>
<select id="get_month" name="get_month" class="form-control"  >
<option value="">--Select Month--</option>  
<?php for($i = 1; $i<13; $i++){ ?>           
<option value="<?php echo $i; ?>"  <?php if(set_value("get_month")== $i) echo "selected";?> ><?php echo $i;?></option> 
<?php } ?>
</select>
<?php } ?>
</td>
<td width="5%"><input type="submit" id="get_val" name="get_val" value="SUBMIT" class="btn" style="background:#09C; color:#FFF;" />
</td><td width="8%">&nbsp;</td>
<?php } ?>
</tr>
<?php } ?>
</table>
</td></tr>
</table>

<!-- staus fwd to admin stage  -->
<?php if(isset($month_view_data_assi)&&!empty($month_view_data_assi)){ ?>
<fieldset class="scheduler-border">
<legend class="scheduler-border"><span style=" font-size:18px; color:#000080; font-weight:bold;">Status: Forwarded to Assistant</span></legend>
 <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>Sl.No</th>
                          <th>Date</th>
                          <th>Activity Describition</th>
                          <th>Activity Hour</th>
                          <th>Participants</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $value = ""; $i=0; foreach ($month_view_data_assi as $valueb ){ $i++; ?>
                        <tr   class="wordbreak">
                          <td><?php echo $i; ?></td>
                          <td><?php echo date("d-m-Y", strtotime($valueb['date']));?></td>
                          <td><?php echo $valueb['activity_desc']; ?></td>
                          <td><?php echo $valueb['hours'];?></td>
                          <td><a href="<?php echo base_url(); ?>Po/NssPo/monthly_atten_view_parti/<?php echo $valueb['m_attendance_id']; ?>"  target="_blank">View Participants</a></td>
                        </tr>                   
                       <?php }?>
                      </tbody>
                    </table>
					
					<input type="submit" value="FORWARD TO UNIVERSITY" id="fwd_uni" name="fwd_uni" class="btn" style="background:#09C; color:#FFF;"  />
					<button type="button" class="btn " data-toggle="modal" data-target="#Rejected" style="background-color:#800040; color:#FFFFFF" >REJECTED</button>
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
        <input type="submit" class="btn btn-primary" name="rejprincisubmit" id="rejprincisubmit" value="Submit"/>
      </div>
    </div>
  </div>
</div>
</fieldset>
<?php }?>

<!-- staus Rej by admin stage  -->
<?php if(isset($month_view_data_rej_assi)&&!empty($month_view_data_rej_assi)){ ?>
<fieldset class="scheduler-border">
<legend class="scheduler-border"><span style=" font-size:18px; color:#000080; font-weight:bold;">Status: Rejected By Assistant</span></legend>
 <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>Sl.No</th>
                          <th>Date</th>
                          <th>Activity Describition</th>
                          <th>Activity Hour</th>
                          <th>Participants</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $value = ""; $i=0; foreach ($month_view_data_rej_assi as $valueb ){ $i++; ?>
                        <tr   class="wordbreak">
                          <td><?php echo $i; ?></td>
                          <td><?php echo date("d-m-Y", strtotime($valueb['date']));?></td>
                          <td><?php echo $valueb['activity_desc']; ?></td>
                          <td><?php echo $valueb['hours'];?></td>
                          <td><a href="<?php echo base_url(); ?>Po/NssPo/monthly_atten_view_parti/<?php echo $valueb['m_attendance_id']; ?>"  target="_blank">View Participants</a></td>
                        </tr>                   
                       <?php }?>
                      </tbody>
                    </table>
					
</fieldset>
<?php }?>

<!-- staus fwd to so stage  -->
<?php if(isset($month_view_data_atten_fwduni)&&!empty($month_view_data_atten_fwduni)){ ?>
<fieldset class="scheduler-border">
<legend class="scheduler-border"><span style=" font-size:18px; color:#000080; font-weight:bold;">Status: Forwarded to SO</span></legend>
 <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>Sl.No</th>
                          <th>Date</th>
                          <th>Activity Describition</th>
                          <th>Activity Hour</th>
                          <th>Participants</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $value = ""; $i=0; foreach ($month_view_data_atten_fwduni as $valueb ){ $i++; ?>
                        <tr   class="wordbreak">
                          <td><?php echo $i; ?></td>
                          <td><?php echo date("d-m-Y", strtotime($valueb['date']));?></td>
                          <td><?php echo $valueb['activity_desc']; ?></td>
                          <td><?php echo $valueb['hours'];?></td>
                          <td><a href="<?php echo base_url(); ?>Po/NssPo/monthly_atten_view_parti/<?php echo $valueb['m_attendance_id']; ?>"  target="_blank">View Participants</a></td>
                        </tr>                   
                       <?php }?>
                      </tbody>
                    </table>
				
</fieldset>
<?php }?>

<!-- staus rej to so stage  -->
<?php if(isset($month_view_data_atten_rejuni)&&!empty($month_view_data_atten_rejuni)){ ?>
<fieldset class="scheduler-border">
<legend class="scheduler-border"><span style=" font-size:18px; color:#000080; font-weight:bold;">Status: Rejected By SO</span></legend>
 <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>Sl.No</th>
                          <th>Date</th>
                          <th>Activity Describition</th>
                          <th>Activity Hour</th>
                          <th>Participants</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $value = ""; $i=0; foreach ($month_view_data_atten_rejuni as $valueb ){ $i++; ?>
                        <tr   class="wordbreak">
                          <td><?php echo $i; ?></td>
                          <td><?php echo date("d-m-Y", strtotime($valueb['date']));?></td>
                          <td><?php echo $valueb['activity_desc']; ?></td>
                          <td><?php echo $valueb['hours'];?></td>
                          <td><a href="<?php echo base_url(); ?>Po/NssPo/monthly_atten_view_parti/<?php echo $valueb['m_attendance_id']; ?>"  target="_blank">View Participants</a></td>
                        </tr>                   
                       <?php }?>
                      </tbody>
                    </table>
					
</fieldset>
<?php }?>

<!-- staus accpted by so stage  -->
<?php if(isset($month_view_data_atten_uni)&&!empty($month_view_data_atten_uni)){ ?>
<fieldset class="scheduler-border">
<legend class="scheduler-border"><span style=" font-size:18px; color:#000080; font-weight:bold;">Status: Accepted By SO</span></legend>
 <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>Sl.No</th>
                          <th>Date</th>
                          <th>Activity Describition</th>
                          <th>Activity Hour</th>
                          <th>Participants</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $value = ""; $i=0; foreach ($month_view_data_atten_uni as $valueb ){ $i++; ?>
                        <tr   class="wordbreak">
                          <td><?php echo $i; ?></td>
                          <td><?php echo date("d-m-Y", strtotime($valueb['date']));?></td>
                          <td><?php echo $valueb['activity_desc']; ?></td>
                          <td><?php echo $valueb['hours'];?></td>
                          <td><a href="<?php echo base_url(); ?>Po/NssPo/monthly_atten_view_parti/<?php echo $valueb['m_attendance_id']; ?>"  target="_blank">View Participants</a></td>
                        </tr>                   
                       <?php }?>
                      </tbody>
                    </table>
					
</fieldset>
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