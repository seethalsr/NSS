<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css">  
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script>
<script type="text/javascript"> 
$(function() {
   $( "#from_date_edit" ).datepicker({
	   dateFormat: 'dd-mm-yy' 
	   });
	   $( "#to_date_edit" ).datepicker({
	   dateFormat: 'dd-mm-yy' 
	   });
 
});
</script>
<form name="frm2" id="frm2" method="post"  action="<?php echo base_url()?>Princi/Nssprinci/edit_unit/<?php echo $unit_data['unit_id']; ?>" >
<table width="100%" height="100%" style="vertical-align:top;">
<tr><td width="29%" valign="top">
<?php if(isset($msg)){?>
<div align="center"><?php echo $msg; ?></div><?php }?>
<div class="w3-card"  >
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">EDIT <?php echo $unit_data['nss_unit_id'];?> </b></h4>
<table cellpadding="0" cellspacing="0" width="100%"  >
<tr><td width="36%"></td>
<td width="9%">PO ID<span class="astrix_red"></span></td>
<td width="3%"><span class="astrix_red">*</span></td>
<td width="17%"><input type="text"  onkeypress="return input_number(event)"   id="po_id_edit" name="po_id_edit" class="form-control input-sm" 
value="<?php if(isset($upd_data)) echo $upd_data['po_id'];else  echo $unit_data['po_id']; ?>"/></td>
<td width="35%"><span class="astrix_red"><?php echo form_error('po_id_edit');?></span></td>
</tr>
<tr>
  <td></td>
  <td>&nbsp;</td>
  <td></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr><td></td>
<td>FROM DATE</td>
<td><span class="astrix_red">*</span></td>
<td><input type="text"  id="from_date_edit" name="from_date_edit" class="form-control input-sm" 
value="<?php if(isset($upd_data)) echo date("d-m-Y", strtotime($upd_data['from_date'])); else echo date("d-m-Y", strtotime($unit_data['from_date']));?> " /></td>
<td><span class="astrix_red"><?php echo form_error('from_date_edit');?></span></td></tr>
<tr>
  <td height="19"></td>
  <td  class="astrix_red">&nbsp;</td>
  <td></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr><td height="27"></td>
<td >TO DATE</td><td><span class="astrix_red">*</span></td>
<td><input type="text"   id="to_date_edit" name="to_date_edit" class="form-control input-sm"  
value="<?php  if(isset($upd_data)) echo date("d-m-Y", strtotime($upd_data['to_date'])); else echo date("d-m-Y", strtotime($unit_data['to_date']));?>"/></td>
<td><span class="astrix_red"><?php echo form_error('to_date_edit');?></span></td></tr>
<tr>
  <td></td>
  <td>&nbsp;</td>
  <td></td>
  <td>&nbsp;</td>
  <td></td>
</tr>
<tr><td></td>
  <td>&nbsp;</td>
  <td></td>
  <td>&nbsp;</td>
  <td></td></tr>
  <input type="hidden" id="unitedit" name="unitedit" value="<?php echo $unit_data['unit_id']; ?>" />
  <tr>
    <td colspan="5" class="w3-center" style="padding-bottom:20px;">&nbsp;</td>
  </tr>
  <tr><td colspan="5" class="w3-center" style="padding-bottom:20px;">
  <input type="submit" class="btn btn-primary" value="Submit" name="edit_submit" id="edit_submit" style="background-color:#0070DF; color:#FFF"/>
  
</td>
  </tr>
</table>
</div></td></tr></table>
 </form>