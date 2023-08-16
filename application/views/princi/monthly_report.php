<?php if(isset($msg)){?>
<div class="w3-center" style="color:#FF8040; "><?php echo $msg; ?></div><?php }?>
<div class="w3-card"  >
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">Monthly Report </b></h4>
<form name="frm1" id="frm1" method="post"   action="<?php echo base_url(); ?>Princi/NssPrinci/monthly_report" enctype="multipart/form-data"  >
        <table cellpadding="0" cellspacing="0" width="100%" align="center">
		<tr><td width="4%"></td>
<td width="22%"> <label class=" control-label" for="unit">BATCH :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="12%"><select id="batch" name="batch" class="form-control" onchange="this.form.submit()" >
  <option value="">--Select--</option>
  <?php foreach($batch_period as $value){?>
  <option value="<?php echo $value['batch_period']; ?>" <?php if(isset($sel_batch)&& $sel_batch== $value['batch_period']) echo "selected";?>> <?php echo $value['batch_period']; ?></option>
  <?php }?>
</select></td>
<td width="4%"></td>
<?php if(isset($sel_batch)&& !empty( $sel_batch)){?>
<td width="22%"> <label class=" control-label" for="unit">UNIT :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="12%"><select id="unit" name="unit" class="form-control" onchange="this.form.submit()" >
  <option value="">--Select--</option>
  <?php foreach($unit_det as $value){?>
  <option value="<?php echo $value['nss_unit_id']; ?>" <?php if(isset($sel_unit)&& $sel_unit== $value['nss_unit_id']) echo "selected";?>> <?php echo $value['nss_unit_id']; ?></option>
  <?php }?>
</select></td>
<?php }?>
<td width="10%" >&nbsp;</td>
<td colspan="7"></td>
</tr>
        <tr>
        <td width="1%"></td>
		<?php if(isset($sel_unit)&& !empty($sel_unit)){ ?>
        <td width="6%"><label class=" control-label" for="selectbasic"> Year :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
        <td width="10%"><select id="year" name="year" class="form-control"  onchange="this.form.submit()">
        <option value="">--Select--</option> 
        <?php foreach( $get_yrs as $val){?>            
        <option value="<?php echo $val['year']; ?>" <?php if(set_value("year")== $val['year']) echo "selected";?>> <?php echo $val['year']; ?></option> 
        <?php } ?>
        </select></td>
        <td width="3%">&nbsp;</td>
        <td width="7%"><label class=" control-label" for="selectbasic"> Month :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
        
        <td width="12%">
        <select id="month" name="month" class="form-control" onchange="this.form.submit()" >
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
        </select>        </td><?php } ?>
        <td width="2%">&nbsp;</td>
		</tr>
		<tr><td></td>
        <td width="22%"><?php if((isset($year_sel))&&(isset($month_sel))){?><a href="<?php echo base_url(); ?>Princi/NssPrinci/monthly_report_view/<?php echo $year_sel; echo $month_sel_n;?>" target="_blank"> View Monthly Report of <?php echo $month_sel; ?></a>
          <?php } ?></td>
        
        <td width="29%"><?php if(isset($year_sel)){?><a href="<?php echo base_url(); ?>Princi/NssPrinci/monthly_report_view/<?php echo $year_sel;?>" target="_blank" > View Yearly Report</a><?php } ?></td>
        <td width="1%"></td>
        </tr>
        </table>
		
		
		<?php if(isset($monthly_report_data)&&!empty($monthly_report_data)) {?>
		<div class="w3-card w3-center" style="margin-top:20px;"> <?php if(($monthly_report_data[0]['verification_id']=="2")||($monthly_report_data[0]['verification_id']=="2R")||($monthly_report_data[0]['verification_id']=="3")){ ?> 
 STATUS : FORWARD TO UNIVERSITY<?php }elseif(($monthly_report_data[0]['verification_id']=="3R")){ ?>
 STATUS: REJECTED BY UNIVERISTY<?php }elseif(($monthly_report_data[0]['verification_id']=="4")){ ?>STATUS: ACCEPTED BY UNIVERISTY <?php }
 elseif(($monthly_report_data[0]['verification_id']=="1R")){ ?>STATUS: REJECTED BY PRINCIPAL  REASON:<?php echo $monthly_report_data[0]['remarks'] ;}?></div>
		<?php } ?>
		
		<?php if(isset($monthly_report_data[0]['verification_id'])&& $monthly_report_data[0]['verification_id']== "1" ) { ?>
 <input type="submit" value="FORWARD TO UNIVERSITY" id="fwdtoassi" name="fwdtoassi"  />  
 <button type="button" class="btn " data-toggle="modal" data-target="#Rejected" style="background-color:#0099CC; color:#FFFFFF" >REJECTED</button>
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
<?php  }?>
</form>
<br />
</div>