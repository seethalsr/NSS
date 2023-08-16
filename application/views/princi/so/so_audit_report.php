<?php  //print_r ($audit_det);exit;?>
<?php $curr_yr = date("Y"); ; $prev_yr = date("Y",strtotime("-1 year")); ;?>
<div class="w3-center" style="padding-bottom:0px">
<span ><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span><br>
<span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">Audit Report</span>
<hr>
</div>

<form name="frm1" id="frm1" method="post"   action="<?php echo base_url(); ?>Admin/NssSo/so_audit_report" enctype="multipart/form-data"  >
<table cellpadding="0" cellspacing="0" width="100%" height="100%">
<tr><td width="16%"><label class=" control-label" >Select College Type</label></td>
<td width="53%">
<select id="type" name="type" class="form-control" <?php if(isset($college_type)|| isset($msg)){ ?> onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($college_type as $value1): ?>
<option value="<?php echo $value1['college_type'] ?>" 
<?php if(set_value("type")==$value1['college_type']) echo "selected";?>> <?php echo $value1['college_type'] ?></option>
<?php endforeach; ?>
</select></td>
<td width="9%">

</td>
<td width="22%" colspan="2"></td>
</tr>

<tr><td width="16%"><label class=" control-label" >Select College Name</label></td>
<td width="53%">
<select id="name" name="name" class="form-control" <?php if(isset($college_name)|| isset($msg)){ ?>onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($college_name_sel as $value): ?>
<option value="<?php echo $value['college_id'] ?>" 
<?php if(set_value("name")==$value['college_id']) echo "selected";?>> <?php echo $value['college_name'] ?></option>
<?php endforeach; ?>
</select></td>
<td width="9%">

</td>
<td width="22%" colspan="2"></td>
</tr>
<?php if(isset($college_id_sel)){?>
<tr><td width="16%"><label class=" control-label" for="selectbasic">Select Year :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="53%">
<select id="year" name="year" class="form-control" onchange="this.form.submit()" >
<option value="">--Select--</option>             
<option value="<?php echo date("Y"); ?>" <?php if(set_value("year")== date("Y")) echo "selected";?>> <?php echo date("Y") ?></option> 
<option value="<?php echo date("Y",strtotime("-1 year"));?>" <?php if(set_value("year")==date("Y",strtotime("-1 year"))) echo "selected";?>> <?php echo date("Y",strtotime("-1 year")) ?></option> 
</select></td>
<td width="9%">

</td>
<td width="22%" colspan="2"></td>
</tr>
<tr><td colspan="6">&nbsp;</td></tr>
<?php if(isset($year)){?>
<tr style="background-color:#D7EBFF;"><td colspan="6" class="w3-center"><span style="font-size:16px;"> Audit report of <?php echo $year;?></span></td></tr>
<tr><td colspan="6">&nbsp;</td></tr>
<tr><td colspan="2">

<table cellpadding="0" cellspacing="0" height="100%" width="100%" class="w3-center">

<tr><td colspan="6">&nbsp;</td></tr>
<?php if(!empty($audit_det)){?><tr>
<?php if($audit_det[0]['status']!= 0 && $audit_det[0]['status']!= 1 && $audit_det[0]['status']!= 2 && $audit_det[0]['status']!= 3){ ?><td colspan="3"><a href="<?php echo base_url();?>uploaded_pdf/<?php echo  $college_id_sel ;?>/audit/<?php echo $year;?>.pdf" target="_blank" > Click here to view Audit Report of <?php echo $year; ?></a></td>
<?php } ?>
<td>&nbsp;</td>
<?php if ($audit_det[0]['status']== 4 || $audit_det[0]['status']== 5 ){ ?>
<td>
<input type="submit" class="btn btn-primary" value="Accepted" name="accso" id="accso" style="background-color:#0080C0; color:#FFF"/>
<button type="button" class="btn " data-toggle="modal" data-target="#Rejected" style="background-color:#0099CC; color:#FFFFFF" >Rejected </button>
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
        <input type="submit" class="btn btn-primary" name="rejsosubmit" id="rejsosubmit" value="Submit"/>
      </div>
    </div>
  </div>
</div>

</td>
<?php } ?>
</tr>
</table>

</td>
<td>&nbsp;</td>
<td colspan="2">
<table cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr><td>
<div class="w3-container">
  <div class="w3-panel w3-light-grey w3-topbar w3-bottombar w3-border-amber">
    <h6 class="w3-center"><span>STATUS</span></h6>
	<?php if($audit_det[0]['status']== '3'){?>
	<span style="color:#004040;" >Forwarded to University</span>
	<?php }elseif($audit_det[0]['status']== '4'){?>
	<span style="color:#004040;">Forwarded to University Seniour Officer</span>
	<?php }elseif($audit_det[0]['status']== '5'){?>
    <span style="color:#FF0000;">Rejected by University Assistant and has been forwarded to Seniour Officer</span>
	<p>
    <span><?php echo $audit_det[0]['remarks']; ?> </span>
    </p>
	<?php }elseif($audit_det[0]['status']== '6'){?>
    <span style="color:#004040;">Accepted by University</span>
	<?php }elseif($audit_det[0]['status']== '7'){?>
    <span style="color:#FF0000;">Rejected by University Senior officer and has been forwarded to resepective PO</span>
	<p>
    <span><?php echo $audit_det[0]['remarks']; ?> </span>
    </p>
	<?php } ?>
  </div>
</div>
</td></tr>
<?php }} }?>
</table>
</td></tr>

</table>
</form>