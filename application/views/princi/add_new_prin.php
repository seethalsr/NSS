<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css">  
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script>
<script type="text/javascript"> 
$(function() {
   $( "#from_date" ).datepicker({
	   dateFormat: 'dd-mm-yy' 
	   });
	   
 
});
</script>
<link rel="stylesheet" href="<?php echo base_url();?>css/w3.css">
<div style="color:#FF0000; text-transform:uppercase"  class="w3-center"><?php  if(isset($msg)) echo $msg;?></div>
<form id="frm" name="frm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="hidden" name="curr_prin_to_date" id="curr_prin_to_date" value="<?php if(isset($to_date))echo $to_date; ?>"  />
<div class="w3-card" style="padding-bottom:15px;" >
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">REGISTER NEW PRINCIPAL</b></h4>
<table cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr><td width="2%"></td><td width="12%">NAME:</td><td width="3%"></td>
<td width="37%"><input type="text" id="prin_name" name="prin_name" class="form-control input-sm"  value="<?php if(isset($data_new_prin['principal_name'])) echo $data_new_prin['principal_name'];?>"/></td><td width="2%"></td>
<td width="13%">EMAIL ID:</td><td width="2%"></td><td width="27%"><input type="text" id="prin_email" name="prin_email" class="form-control input-sm" value="<?php if(isset($data_new_prin['principal_email'])) echo $data_new_prin['principal_email'];?>"/></td><td width="2%"></td></tr>

<tr><td colspan="4"><span class="msg_red"><?php echo form_error('prin_name');?></span></td><td>&nbsp;</td><td colspan="2"><span class="msg_red"><?php echo form_error('prin_email');?></span></td></tr>
<tr><td></td><td>ADDRESS:</td><td></td><td><textarea name="address" id="address" rows="3" cols="55"  style="resize:none;"class="form-control input-sm"><?php if(isset($data_new_prin['principal_address'])) echo $data_new_prin['principal_address'];?></textarea></td><td></td>
<td>PINCODE:</td><td></td><td><input type="text" id="prin_pin" name="prin_pin" class="form-control input-sm" value="<?php if(isset($data_new_prin['principal_pincode'])) echo $data_new_prin['principal_pincode'];?>" /></td><td></td></tr>
<tr><td colspan="4"><span class="msg_red"><?php echo form_error('address');?></span></td><td>&nbsp;</td><td colspan="2"><span class="msg_red"><?php echo form_error('prin_pin');?></span></td></tr>
<tr><td></td><td>CONTACT:</td><td></td><td><input type="text" id="prin_contact" name="prin_contact" class="form-control input-sm"  value="<?php if(isset($data_new_prin['principal_contact'])) echo $data_new_prin['principal_contact'];?>"/></td><td></td>
<td>GENDER:</td><td></td><td>
<select id="gen" name="gen" class="form-control input-sm"><option value="M">MALE</option><option value="F">FEMALE</option></select>
</td><td></td></tr>
<tr><td colspan="4"><span class="msg_red"><?php echo form_error('prin_contact');?></span></td><td colspan="5">&nbsp;</td></tr>
<tr><td></td><td>JOINING DATE:</td><td></td><td><input type="text" id="from_date" name="from_date" class="form-control input-sm"  value="<?php if(isset($data_new_prin['from_date'])) echo $data_new_prin['from_date'];?>"/></td><td colspan="4"></td><td></td></tr>
<tr><td colspan="4"><span class="msg_red"><?php echo form_error('from_date');?></span></td><td colspan="5">&nbsp;</td></tr>
<tr><td colspan="9" class="w3-center"><input type="submit" id="sub" name="sub" value="SUBMIT"  class="btn" style="background:#09C; color:#FFF;"/></td></tr>
</table>
</div>
</form>