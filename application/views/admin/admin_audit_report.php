<?php  //print_r ($audit_det);exit;?>
<?php $curr_yr = date("Y"); ; $prev_yr = date("Y",strtotime("-1 year")); ;?>
<div class="w3-center" style="padding-bottom:0px">
<span ><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span><br>
<span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">Audit Report</span>
<hr>
</div>

<form name="frm1" id="frm1" method="post"   action="<?php echo base_url(); ?>Admin/NssAdmin/admin_audit_report" enctype="multipart/form-data"  >
<table cellpadding="0" cellspacing="0" width="100%" height="100%">
<tr><td width="16%"><label class=" control-label" >Select College Type</label></td>
<td width="53%">
<select id="type" name="type" class="form-control" <?php if(isset($nss_college_type)|| isset($msg)){ ?> onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($nss_college_type as $value1): ?>
<option value="<?php echo $value1['nss_college_type'] ?>" 
<?php if(set_value("type")==$value1['nss_college_type']) echo "selected";?>> <?php if($value1['nss_college_type']=="SF") echo"SELF FINANCING"; elseif($value1['nss_college_type'] =="REG")echo"REGULAR";  ?></option>
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
<option value="<?php echo "ALL"; ?>"<?php if(set_value("year")== "ALL") echo "selected";?> ><?php echo "ALL"; ?></option>             
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

<?php if(isset($audit_det)&& !empty($audit_det)){?>
<table cellpadding="0" cellspacing="0" height="100%" width="100%" class="w3-center" border="1">
<tr><td>Sl.No.</td>
<td>AUDIT REPORT</td>
<td>STATUS</td>
<td>REMARKS</td></tr>
<?php $i=0; foreach($audit_det as $value){$i++;?>
<tr>
<td><?php echo $i; ?></td>
<td ><a href="<?php echo base_url();?>upload/po/col<?php echo  $college_id_sel ;?>/AUDIT/<?php echo $value['year'];?>.pdf" target="_blank" > Click here to view Audit Report of <?php echo $value['year']; ?></a></td>
<td><?php
if($value['verification_id']=="2") echo"Forwarded to Assistant"; elseif($value['verification_id']=="2R") echo "Rejected by Assistant"; elseif($value['verification_id']=="3") echo "Forwarded to SO"; if($value['verification_id']=="3R") echo "Rejected by SO" ;if($value['verification_id']=="4") echo "Accepted by SO" ;?></td>
<td><?php echo $value['remarks'];?></td>
</tr>
<?php }?> 
</table>
<?php }} ?>
</td>
<td>&nbsp;</td>
<td colspan="2"></td></tr>
<?php } ?>
</table>
<?php if (isset($audit_det)&& !empty($audit_det)&& $audit_det[0]['verification_id']== "2"){ ?>
<input type="submit" class="btn btn-primary" value="Accepted By SO" name="fwdso" id="fwdso" style="background-color:#0080C0; color:#FFF"/>
<button type="button" class="btn " data-toggle="modal" data-target="#Rejected" style="background-color:#0099CC; color:#FFFFFF" >Rejected by SO</button>
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
        <input type="submit" class="btn btn-primary" name="rejassiisubmit" id="rejassiisubmit" value="Submit"/>
      </div>
    </div>
  </div>
</div>
<?php }  ?>
</form>