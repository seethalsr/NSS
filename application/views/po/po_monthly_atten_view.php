<!--contant body-->
<style>
fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}
legend.scheduler-border {
   width:inherit; /* Or auto */
    padding:0 10px; /* To give a bit of padding on the left and right */
    border-bottom:none;
}
</style>
<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css">  
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script><script type="text/javascript"> 
$(function() {
   $( "#date" ).datepicker({
	   dateFormat: 'dd-mm-yy' 
	   });
   
  
});
</script>
<p style="color:#FF0000;" class="w3-center"><?php if(isset($msg)) echo $msg;  ?></p>
<form name="frm1" id="frm1" method="post"   action="<?php echo base_url(); ?>Po/NssPo/po_monthly_atten_view" >
<table width="100%" height="100%" style="vertical-align:top;">
<tr>
<td >
<div class="card" >
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">VIEW MONTHLY ATTENDANCE</b></h4>
<table width="100%" height="100%" cellpadding="0" cellspacing="0">
<tr><td width="2%"></td>
<td width="20%"><label class=" control-label" style="color:#000; font-size:14px;"> View Details Based on :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="16%">
<select id="get_data" name="get_data" class="form-control" onchange="this.form.submit()" >
<option value="">--Select--</option>             
<option value="Y" <?php if(set_value("get_data")== 'Y') echo "selected";?>>YEAR</option> 
<option value="M" <?php if(set_value("get_data")== 'M') echo "selected";?>>MONTH</option> 
<option value="D" <?php if(set_value("get_data")== 'D') echo "selected";?>>DATE</option> 
</select></td>
<td width="2%">&nbsp;</td>
<td width="15%">
<?php if(isset($sel)){
 if($sel == 'Y' || $sel == 'M' ){ ?>	
<select id="get_year" name="get_year" class="form-control"  >
<option value="">--Select Year--</option>    
<?php $value = ''; foreach($year_db as $value){?>         
<option value="<?php echo $value['year'] ;?>" <?php if(set_value("get_year")== $value['year']) echo "selected";?>  ><?php echo $value['year'] ;?></option> 
<?php } ?>
</select>
<?php }elseif($sel == 'D'){ ?>
<input type="text" id="date" name="date" class="form-control " placeholder="DD-MM-YYYY"  />

<?php } ?></td><td width="3%">&nbsp;</td>
<td width="16%">
<?php if($sel == 'M'  ){ ?>
<select id="get_month" name="get_month" class="form-control"  >
<option value="">--Select Month--</option>  
<?php for($i = 1; $i<13; $i++){ ?>           
<option value="<?php echo $i; ?>"  <?php if(set_value("get_month")== $i) echo "selected";?> ><?php echo $i;?></option> 
<?php } ?>
</select>
<?php } ?></td><td width="3%">&nbsp;</td>
<td width="2%">&nbsp;</td>
<td width="19%"><input type="submit" id="get_val" name="get_val" value="SUBMIT" class="w3-button  w3-blue " /></td><td width="2%">&nbsp;</td>
<?php } ?>
</tr>
</table>
</div></td>
</tr>
<tr><td>
<?php if(isset($sub)){?>
 <div class="col-md-12 col-sm-12 col-xs-12 " >
  <div class="x_content">
  <h4 class="w3-center"><fntn>MONTHLY ATTENDANCE DETAILS OF <?php 
	   if($sel == 'Y' &&(isset($sel_year))) echo "YEAR-".$sel_year; 
	   elseif($sel == 'M' &&(isset($sel_year)&&($sel_month))) echo "YEAR-".$sel_year.",MONTH-".$sel_month; 
	   elseif($sel == 'D'&&(isset($sel_date))) echo $sel_date; ?> </fntn></h4>
<hr />
<!-- intial stage  -->
<?php if(isset($month_view_data_initial)&&!empty($month_view_data_initial)){ ?>
<fieldset class="scheduler-border">
<legend class="scheduler-border">Created Monthly Attendance:</legend>
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
					  <?php $value = ""; $i=0; foreach ($month_view_data_initial as $valuea ){ $i++; ?>
                        <tr   class="wordbreak">
                          <td><?php echo $i; ?></td>
                          <td><?php echo date("d-m-Y", strtotime($valuea['date']));?></td>
                          <td><?php echo $valuea['activity_desc']; ?></td>
                          <td><?php echo $valuea['hours'];?></td>
                          <td><a href="<?php echo base_url(); ?>Po/NssPo/monthly_atten_view_parti/<?php echo $valuea['m_attendance_id']; ?>"  target="_blank">View Participants</a></td>
                        </tr>                   
                       <?php }?>
                      </tbody>
            </table>
					
			<input type="submit" id="fwd_prin" name="fwd_prin" value="FORWARD TO PRINCIPAL"  class="w3-button  w3-green " />
</fieldset>
<?php }?>
<!-- staus fwd to princi stage  -->
<?php if(isset($month_view_data_fwd_prin)&&!empty($month_view_data_fwd_prin)){ ?>
<fieldset class="scheduler-border">
<legend class="scheduler-border">Status: Forwarded to Principal</legend>
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
</fieldset>
<?php }?>

<!-- status fwd to univeristy stage  -->
<?php if(isset($month_view_data_fwd_uni)&&!empty($month_view_data_fwd_uni)){ ?>
<fieldset class="scheduler-border">
<legend class="scheduler-border">Status: Forwarded to University</legend>
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
                          <td><a href="<?php echo base_url(); ?>po/NssPo/monthly_atten_view_parti/<?php echo $valuec['m_attendance_id']; ?>"  target="_blank">View Participants</a></td>
                        </tr>                   
                       <?php }?>
                      </tbody>
                    </table>
</fieldset>
<?php }?>
<?php if(isset($month_view_data_atten_uni)&&!empty($month_view_data_atten_uni)){ ?>
<!-- status university accepeted stage  -->
<fieldset class="scheduler-border">
<legend class="scheduler-border">Status: Accepted by Univeristy</legend>
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
                          <td><a href="<?php echo base_url(); ?>po/NssPo/monthly_atten_view_parti/<?php echo $valued['m_attendance_id']; ?>"  target="_blank">View Participants</a></td>
                        </tr>                   
                       <?php }?>
                      </tbody>
                    </table>
</fieldset>
<?php }?>
</div></div>
  <?php } ?>
</td></tr>
</table>



<?php if(isset($monthly_stud)&&!empty($monthly_stud)){ ?>
<input type="submit" id="fwdtoprinci" name="fwdtoprinci" value="FORWARD TO PRINCIPAL" class="w3-button  w3-green "  />
<?php } ?>
</form>
  