<style>
.modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
</style>
<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css">  
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script>
<script type="text/javascript"> 
$(function() {
   $( "#fdate" ).datepicker({
	   dateFormat: 'dd-mm-yy' 
	   });

});
function ValidateAlpha(evt)
{
   var keyCode = (evt.which) ? evt.which : evt.keyCode
    if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
        return false;
            return true;
}
</script>
<form id="frm" name="frm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="container">
  <div class="modal show  " id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">PROFILE</h4>
        </div>
        <div class="modal-body ">
		<span ><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span><br>
          <table width="100%" cellpadding="0" cellspacing="0" >
          <tr><td width="16%">NAME:</td><td width="49%"> <input type="text" name="name" id="name" onKeyPress="return ValidateAlpha(event);" class="form-control"   autocomplete="off"
		  value="<?php if(isset($data_prin['principal_name'])) echo $data_prin['principal_name'];?>"/></td><td></td>
         <tr><td colspan="3" class="msg_red "><?php echo form_error('name');?></td></tr>
		  <tr><td width="10%">EMAIL:</td><td width="21%"><input type="text" class="form-control" id="email" name="email"autocomplete="off"  value="<?php if(isset($data_prin['principal_email'])) echo $data_prin['principal_email']; ?>" /></td><td></td></tr>
          <tr><td colspan="3" class="msg_red "><?php echo form_error('email')?></td></tr>
          <tr><td>ADDRESS:</td><td><textarea name="address" rows="3" cols="55" class="form-control" style="resize:none"><?php if(isset($data_prin['principal_address'])) echo $data_prin['principal_address']?></textarea></td><td></td></tr>
		  <tr><td colspan="3" class="msg_red "><?php echo form_error('address');?></td>
          <tr><td>PINCODE:</td><td><input type="text" id="pin" name="pin" class="form-control" onKeyPress="return input_number(event)" maxlength="6" value="<?php if(isset($data_prin['principal_pincode'])) echo $data_prin['principal_pincode'];?>" /></td><td></td></tr>
          <tr><td colspan="3" class="msg_red "><?php echo form_error('pin')?></td></tr>
          <tr>
            <td>CONTACT:</td><td><input type="text" id="contact" name="contact"  class="form-control" onKeyPress="return input_number(event)"  maxlength="10" 
			value="<?php if(isset($data_prin['principal_contact'])) echo $data_prin['principal_contact'];?>"/></td><td></td></tr><tr>
			 <tr><td colspan="3" class="msg_red "><?php echo form_error('contact');?></td></tr>
            <td>GENDER:</td><td> <select id="gen" name="gen" class="form-control"><option value="M">MALE</option><option value="F">FEMALE</option>
			<option value="O">OTHER</option></select></td><td></td></tr>
            <tr><td colspan="3">&nbsp;</td><tr>
            <td>FROM DATE: </td><td><input type="text" id="fdate" name="fdate" placeholder="DD-MM-YYYY" class="form-control" autocomplete="off" value="<?php if(isset($data_prin['from_date'])) echo $data_prin['from_date'];?>"/></td><td></td>
          <tr><td colspan="3" class="msg_red "><?php echo form_error('fdate');?></td></tr>
          </table>
        </div>
        <div class="modal-footer">
          <?php /*?><button type="button" class="btn btn-default " data-dismiss="modal"  onclick="$('.modal').removeClass('show').addClass('fade');">Close</button><?php */?>
        <input type="submit" value="SUBMIT" id="sub" name="sub" class="w3-button w3-center w3-green " />
        </div>
      </div>
    </div>
  </div>
</div>
</form>
