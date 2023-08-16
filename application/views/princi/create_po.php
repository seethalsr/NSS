<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css">  
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script>
<script type="text/javascript"> 
function ValidateAlpha(evt)
{
    var keyCode = (evt.which) ? evt.which : evt.keyCode
    if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
      return false;
      return true;
}
$(function() {
   $( "#datepicker-12" ).datepicker({
	   dateFormat: 'dd-mm-yy' 
	   });
   
  
});
</script>
<form name="frm1" id="frm1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
<table width="100%" height="100%" style="vertical-align:top;">
<tr><td width="29%" valign="top">
<?php if(isset($msg)){?>
<div class="w3-center" style="color:#FF8040; "><?php echo $msg; ?></div><?php }?>
<div class="w3-card"  >
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">REGISTRATION OF PROGRAM OFFICERS</b></h4>
<table cellpadding="0" cellspacing="0" width="100%"  >
<tr><td width="2%"></td>
<td width="36%">NAME:<span class="astrix_red">*</span></td>
<td width="7%"></td>
<td width="53%">EMAIL:<span class="astrix_red">*</span></td>
<td width="2%"></td>
</tr>
<tr><td></td>
<td><input type="text" class="form-control input-sm" id="txt1" name="txt1" onKeyPress="return ValidateAlpha(event);" autocomplete="off" value="<?php if(isset($data['po_name']))echo $data['po_name'];?>" ></td>
<td></td>
<td> <input type="email" class="form-control input-sm" id="txt6" name="txt6" value="<?php if(isset($data['po_email']))echo $data['po_email'];?>" ></td>
<td></td>
</tr>
<tr>
<td height="27"></td>
<td  class="astrix_red"><?php echo form_error('txt1'); ?></td>
<td></td>
<td  class="astrix_red"><?php echo form_error('txt6'); ?></td>
<td></td>
</tr>
<tr>
<td></td>
<td>MOBILE:<span class="astrix_red">*</span></td>
<td></td>
<td>PO DATE OF JOINING(DD-MM-YYYY)<span class="astrix_red">*</span></td>
<td></td>
</tr>
<tr>
<td></td>
<td> <input type="text" class="form-control input-sm" id="txt3"  name="txt3" maxlength="10" value="<?php if(isset($data['po_contact']))echo $data['po_contact'];?>"autocomplete="off" onKeyPress="return input_number(event)"></td>
<td></td>
<td> <input type="text" class="form-control " id="datepicker-12" name="datepicker-12"   autocomplete="off"	value="<?php if(isset($data['po_join_date'])&& !empty($data['po_join_date']))echo date("d-m-Y", strtotime( $data['po_join_date']));?>"/></td>
<td></td>
</tr>
<tr>
<td height="30"></td>
<td  class="astrix_red"><?php echo form_error('txt3'); ?></td>
<td></td>
<td  class="astrix_red"><?php echo form_error('datepicker-12'); ?></td>
<td></td>
</tr>
<tr>
<td></td>
<td>ADDDRESS:<span class="astrix_red">*</span></td><td></td><td>PINCODE<span class="astrix_red">*</span></td>
<td></td>
</tr>
<tr>
<td></td>
<td><textarea class="form-control input-sm" id="txt2" name="txt2" style="resize:none;"  rows="3" ><?php if(isset($data['po_address']))echo $data['po_address'];?> </textarea></td>
<td></td>
<td> <input type="text" class="form-control input-sm" id="txt5" name="txt5" value="<?php if(isset($data['po_pin']))echo $data['po_pin'];?>"   maxlength="6"
			autocomplete="off" onKeyPress="return input_number(event)"></td><td></td></tr>
<tr>
<td height="27"></td>
<td  class="astrix_red"><?php echo form_error('txt2'); ?></td>
<td></td>
<td  class="astrix_red"><?php echo form_error('txt5'); ?></td>
<td></td>
</tr>
<tr>
<td></td>
<td> </td>
<td></td>
<td>GENDER<span class="astrix_red">*</span></td>
<td></td>
</tr>
<tr><td height="38"></td>
<td>  </td><td></td>
<td> <label class="radio-inline" for="radios-0">
       <input type="radio" name="radios" id="radios-0" value="M" checked="checked">
       MALE
       </label> 
      <label class="radio-inline" for="radios-1">
      <input type="radio" name="radios" id="radios-1" value="F">
      FEMALE
      </label>
	  <label class="radio-inline" for="radios-2">
      <input type="radio" name="radios" id="radios-2" value="O">
     OTHER
      </label>
	  </td><td></td></tr>
<tr><td height="29">&nbsp;</td>
<td></td><td></td><td></td><td></td></tr>
<tr><td class="w3-center" colspan="5" style="padding-bottom:20px;"><input type="submit"  value="Submit" name="submit5" id="submit5" class="w3-button  w3-green " />
            <input type="submit"  value="Reset" name="submitupdate" id="submitupdate" class="w3-button  w3-blue " /></td></tr>
</table>
</div>
</tr>
</table>
</form>