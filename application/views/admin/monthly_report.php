<span ><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span><br>
<form name="frm1" id="frm1" method="post"   action="<?php echo base_url(); ?>Admin/NssAdmin/monthly_report" enctype="multipart/form-data"  >
<div class="card" >
<h4 align="center"><b style="text-decoration:underline;">MONTHLY REPORT</b></h4>
<table width="100%">
<tr><td width="19%"><label class=" control-label" >VIEW MONTHLY REPORT :</label></td><td width="2%"></td><td width="25%"><select id="view_type" name="view_type" class="form-control"  onchange="this.form.submit()">
<option value="">---Select---</option>
<option value="ALL" <?php if(isset($view_type)&& $view_type=="ALL") {?>selected="selected"<?php } ?>>ALL</option>
<option value="COLGE" <?php if(isset($view_type)&& $view_type=="COLGE") {?>selected="selected"<?php } ?>>COLLEGE WISE</option>
</select></td>
<td width="54%"></td></tr>
</table>

<?php if(isset($view_type)&&($view_type=="ALL")){ ?>
<?php if(isset($get_yrs)){?>
<table width="100%">
<tr><td width="8%"><label class=" control-label" for="selectbasic"> Year :<a style="color:#FF0000;font-size:18px;">*</a></label></td><td width="13%"></td>
<td width="25%"><select id="year1" name="year1" class="form-control"  onchange="this.form.submit()">
          <option value="">--Select--</option>
          <?php foreach( $get_yrs as $val){?>
          <option value="<?php echo $val['year']; ?>" <?php if(isset($year1)&& $year1==$val['year']) echo "selected";?>> <?php echo $val['year']; ?></option>
          <?php } ?>
        </select></td><td width="54%">
        <?php if(isset($year1)){?>  <a href="<?php echo base_url(); ?>Admin/NssAdmin/monthly_report_view_all/<?php echo $year1;?>" target="_blank" > View Yearly Report</a> <?php } ?>
        </td></tr>
</table>



<?php }}if(isset($view_type)&&($view_type=="COLGE")){?>
 <table cellpadding="0" cellspacing="0" width="100%" align="center">
        <tr>
<td width="11%" height="74"><label class=" control-label" >Select College Type</label></td>
<td width="5%"></td>
<td width="32%">
<select id="type" name="type" class="form-control" <?php if(isset($college_type)|| isset($msg)){ ?> onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($nss_college_type as $value1): ?>
<option value="<?php echo $value1['nss_college_type'] ?>" 
<?php if(set_value("type")==$value1['nss_college_type']) echo "selected";?>> <?php if($value1['nss_college_type']=="SF") echo"SELF FINANCING"; elseif($value1['nss_college_type'] =="REG")echo"REGULAR";  ?></option>
<?php endforeach; ?>
</select></td>
<td width="5%"></td>
<td width="10%"><label class=" control-label" >Select College Name</label></td>
<td width="37%">
<select id="name" name="name" class="form-control" <?php if(isset($college_name)|| isset($msg)){ ?>onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($college_name_sel as $value): ?>
<option value="<?php echo $value['college_id'] ?>" 
<?php if(set_value("name")==$value['college_id']) echo "selected";?>> <?php echo $value['college_name'] ?></option>
<?php endforeach; ?>
</select></td>
</tr>
<tr>
<?php if(isset($batch_list)&& !empty($batch_list)){?>
<td width="11%" height="74"><label class=" control-label" >Select Batch </label></td>
<td width="5%"></td>
<td width="32%">
<select id="batch" name="batch" class="form-control" <?php if(isset($college_type)|| isset($msg)){ ?> onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($batch_list as $valueb): ?>
<option value="<?php echo $valueb['batch_period'] ?>" 
<?php if(isset($sel_batch) && $sel_batch==$valueb['batch_period']) echo "selected";?>> <?php echo $valueb['batch_period'] ?></option>
<?php endforeach; ?>
</select>
<?php } ?></td>
<td width="5%"></td>
<?php if(isset($unit_list)){?>
<td width="10%"><label class=" control-label" >Select Unit</label></td>
<td width="37%">
<select id="unit" name="unit" class="form-control" <?php if(isset($unit_list)){ ?> onchange="this.form.submit()"<?php } ?>>
  <option value="">---Select---</option>
  <?php foreach ($unit_list as $value1): ?>
  <option value="<?php echo $value1['nss_unit_id']; ?>" 
			  <?php if(set_value("unit")==$value1['nss_unit_id']) echo "selected";?>> <?php echo $value1['nss_unit_id'];?></option>
  <?php endforeach; ?>
</select></td>
<?php } ?>
</tr>
<?php if(isset($get_yrs)){?>
        <tr>
        
        <td width="11%"><label class=" control-label" for="selectbasic"> Year :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
        <td width="5%">&nbsp;</td>
        <td width="32%"><select id="year" name="year" class="form-control"  onchange="this.form.submit()">
          <option value="">--Select--</option>
          <?php foreach( $get_yrs as $val){?>
          <option value="<?php echo $val['year']; ?>" <?php if(set_value("year")== $val['year']) echo "selected";?>> <?php echo $val['year']; ?></option>
          <?php } ?>
        </select></td>
        <td width="5%"><label class=" control-label" for="selectbasic"></label></td>
        
        <td width="10%">Month :<a style="color:#FF0000;font-size:18px;">*</a></td>
        <td width="37%"><select id="month" name="month" class="form-control" onchange="this.form.submit()" >
          <option value="">--Select--</option>
          <option value="01" <?php if(set_value("month")== '01') echo "selected";?> >January</option>
          <option value="02" <?php if(set_value("month")== '02') echo "selected";?> >February</option>
          <option value="03" <?php if(set_value("month")== '03') echo "selected";?> >March</option>
          <option value="04" <?php if(set_value("month")== '04') echo "selected";?> >April</option>
          <option value="05" <?php if(set_value("month")== '05') echo "selected";?> >May</option>
          <option value="06" <?php if(set_value("month")== '06') echo "selected";?> >June</option>
          <option value="07"  <?php if(set_value("month")== '07') echo "selected";?> >July</option>
          <option value="08" <?php if(set_value("month")== '08') echo "selected";?> >August</option>
          <option value="09" <?php if(set_value("month")== '09') echo "selected";?> >September</option>
          <option value="10"<?php if(set_value("month")== '10') echo "selected";?> >October</option>
          <option value="11"<?php if(set_value("month")== '11') echo "selected";?> >November</option>
          <option value="12" <?php if(set_value("month")== '12') echo "selected";?> >December</option>
        </select></td>
		</tr>
		<tr><td colspan="6">
         <table width="100%">
         <tr><td colspan="3"></td></tr>
         <tr>
        <td width="17%"></td>
        <td width="36%"><?php if(isset($year_sel)){?>
          <a href="<?php echo base_url(); ?>Admin/NssAdmin/monthly_report_view/<?php echo $year_sel;echo'|';echo $sel_colge;echo'|'; echo $sel_batch;echo'|'; echo $sel_unit;?>" target="_blank" > View Yearly Report</a>
          <?php } ?></td>
        <td width="47%"><?php if((isset($year_sel))&&(isset($month_sel))){?>
          <a href="<?php echo base_url(); ?>Admin/NssAdmin/monthly_report_view/<?php echo $year_sel; echo'|'; echo $month_sel_n;echo'|'; echo $sel_colge;echo'|'; echo $sel_batch;echo'|'; echo $sel_unit;?>" target="_blank"> View Monthly Report of <?php echo $month_sel; ?></a>
          <?php } ?></td>
          </tr>
        </table>
        </td>
        </tr>
		<?php } ?>
        </table>
<?php if(isset($monthly_report_data)&&!empty($monthly_report_data)) {?>
<div class="w3-card w3-center" style="margin-top:20px;"> <?php if($monthly_report_data[0]['verification_id']=="3"){ ?> 
 STATUS : FORWARD TO SO <?php }elseif(($monthly_report_data[0]['verification_id']=="4")){ ?>STATUS: ACCEPTED BY SO <?php }
 elseif(($monthly_report_data[0]['verification_id']=="3R")){ ?>STATUS: REJECTED BY SO  REASON:<?php echo $monthly_report_data[0]['remarks'] ;}?></div>
<?php } ?>
<?php if(isset($monthly_report_data[0]['verification_id'])&& $monthly_report_data[0]['verification_id']== "2" ) { ?>
<input type="submit" value="FORWARD TO UNIVERSITY" id="fwdtoassi" name="fwdtoassi"  />
<button type="button" class="btn " data-toggle="modal" data-target="#Rejected" style="background-color:#0099CC; color:#FFFFFF" >REJECT</button>
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
<?php }}?>
</div>
</form>