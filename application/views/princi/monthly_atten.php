<?php if(isset($msg)){?>
<div class="w3-center" style="color:#FF8040; "><?php echo $msg; ?></div><?php }?>
<div class="w3-card"  >
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">Monthly Attendance </b></h4>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="form1" id="form1"  >
<table cellpadding="0" cellspacing="0" height="100%" width="100%" >

<tr><td width="4%"></td>
<td width="22%"> <label class=" control-label" for="unit">BATCH :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="12%"><select id="batch" name="batch" class="form-control" onchange="this.form.submit()" >
  <option value="">--Select--</option>
  <?php foreach($batch_period as $value){?>
  <option value="<?php echo $value['batch_period']; ?>" <?php if(isset($sel_batch)&& $sel_batch== $value['batch_period']) echo "selected";?>> <?php echo $value['batch_period']; ?></option>
  <?php }?>
</select></td>
<td width="4%"></td>
<td width="22%"> <label class=" control-label" for="unit">UNIT :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="12%"><select id="unit" name="unit" class="form-control" onchange="this.form.submit()" >
  <option value="">--Select--</option>
  <?php foreach($unit_det as $value){?>
  <option value="<?php echo $value['nss_unit_id']; ?>" <?php if(isset($sel_unit)&& $sel_unit== $value['nss_unit_id']) echo "selected";?>> <?php echo $value['nss_unit_id']; ?></option>
  <?php }?>
</select></td>
<td width="10%" >&nbsp;</td>
<td colspan="7"></td>
</tr>
<?php if(isset($sel_unit)){?>
<tr>
  <td></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
<td width="4%"></td>
<td width="22%"><label class=" control-label" style="color:#000; font-size:14px;"> View Details Based on :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
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
<?php } ?></td><td width="1%">&nbsp;</td>
<td width="11%">
<?php if($sel == 'M'  ){ ?>
<select id="get_month" name="get_month" class="form-control"  >
<option value="">--Select Month--</option>  
<?php for($i = 1; $i<13; $i++){ ?>           
<option value="<?php echo $i; ?>"  <?php if(set_value("get_month")== $i) echo "selected";?> ><?php echo $i;?></option> 
<?php } ?>
</select>
<?php } ?>
</td><td width="1%">&nbsp;</td>
<td width="9%">&nbsp;</td>
<td width="5%"><input type="submit" id="get_val" name="get_val" value="SUBMIT" class="btn" style="background:#09C; color:#FFF;" /></td><td width="8%">&nbsp;</td>
<?php } ?>
</tr>
<?php } ?>
</table>
<!-- staus fwd to princi stage  -->
<?php if(isset($month_view_data_fwd_prin)&&!empty($month_view_data_fwd_prin)){ ?>
<fieldset class="scheduler-border">
<legend class="scheduler-border"><span style="font-size:18px; color:#000080; font-weight:bold;">Status: Forwarded to Principal</span></legend>
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
					  <?php $value = ""; $i=0; foreach ($month_view_data_fwd_prin as $valueb ){ $i++; ?>
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

<!-- status fwd to univeristy stage  -->
<?php if(isset($month_view_data_fwd_uni)&&!empty($month_view_data_fwd_uni)){ ?>
<fieldset class="scheduler-border">
<legend class="scheduler-border"><span style="font-size:18px; color:#000080; font-weight:bold;">Status: Forwarded to University</span></legend>
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
					  <?php $value = ""; $i=0; foreach ($month_view_data_fwd_uni as $valuec ){ $i++; ?>
                        <tr   class="wordbreak">
                          <td><?php echo $i; ?></td>
                          <td><?php echo date("d-m-Y", strtotime($valuec['date']));?></td>
                          <td><?php echo $valuec['activity_desc']; ?></td>
                          <td><?php echo $valuec['hours'];?></td>
                          <td><a href="<?php echo base_url(); ?>Po/NssPo/monthly_atten_view_parti/<?php echo $valuec['m_attendance_id']; ?>"  target="_blank">View Participants</a></td>
                        </tr>                   
                       <?php }?>
                      </tbody>
                    </table>
</fieldset>
<?php }?>
<?php if(isset($month_view_data_atten_uni)&&!empty($month_view_data_atten_uni)){ ?>
<!-- status university accepeted stage  -->
<fieldset class="scheduler-border">
<legend class="scheduler-border"><span style="font-size:18px; color:#000080; font-weight:bold;">Status: Accepted by Univeristy</span></legend>
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
					  <?php $value = ""; $i=0; foreach ($month_view_data_atten_uni as $valued ){ $i++; ?>
                        <tr   class="wordbreak">
                          <td><?php echo $i; ?></td>
                          <td><?php echo date("d-m-Y", strtotime($valued['date']));?></td>
                          <td><?php echo $valued['activity_desc']; ?></td>
                          <td><?php echo $valued['hours'];?></td>
                          <td><a href="<?php echo base_url(); ?>Po/NssPo/monthly_atten_view_parti/<?php echo $valued['m_attendance_id']; ?>"  target="_blank">View Participants</a></td>
                        </tr>                   
                       <?php }?>
                      </tbody>
                    </table>
</fieldset>
<?php }?>



 <?php if(isset($month_view_data)){ ?>
<div class="col-md-12 col-sm-12 col-xs-12 " ><div><div class="x_content">
   <h4 class="w3-center"><fntn>MONTHLY ATTENDANCE OF ENROLLED STUDENT </fntn></h4>
	<hr />
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>SL.NO</th>
                          <th>DATE</th>
                          <th>ACTIVITY DESCRIBITION</th>
                          <th>ACTIVITY HOUR</th>
                          <th>PARTICIPANTS</th>
                        </tr>
                      </thead>
					 
                      <tbody>
					  <?php $i=0; foreach ($month_view_data as $value ){$i++; ?>
                        <tr   class="wordbreak">
                          <td><?php echo $i; ?></td>
                          <td><?php echo $value['date']; ?></td>
                          <td><?php echo $value['activity_desc']; ?></td>
                          <td><?php echo $value['hours']; ?></td>
                          <td><a href="#" data-toggle="modal" data-target="#modalViewparti">View Participants</a></td>
                        </tr>                   
                       <?php }?>
                      </tbody>
					  
                    </table>
					
					<div id="modalViewparti" class="modal fade" role="dialog" data-backdrop="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align-last: center">LIST OF STUDENTS PARTICIPATED</h4>
            </div>
            <div class="modal-body">
				<table  class="table table-striped table-bordered dt-responsive nowrap dataTable">
                <thead><tr>
                <th>Sl.No</th>
                <th>Enroll Id</th>
                <th>Student Name</th>
                </tr></thead>
                <tbody>
                <?php if(isset($monthly_stud)){ $i = 0; foreach($monthly_stud as $value){$i++;?>
                <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $value['nss_enroll_id']; ?></td>
                <td><?php echo $value['account_student_name']; ?></td>
                </tr>
                <?php }}?>
                </tbody>
                </table>
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
 </div></div></div>
<?php } ?>
</form>
<br />
</div>