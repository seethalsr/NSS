<form id="frm" name="frm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<link rel="stylesheet" href="<?php echo base_url();?>css/w3.css">
<div class="container">
  <div class="modal show  " id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header w3-center">
          <h4 class="modal-title" style="color:#3b579d">CHANGE PASSWORD</h4>
        </div>
        <div class="modal-body w3-card w3-center">
		<?php if(isset($msg)) echo '<div class='.$msg_type.'>'.$msg.'</div>';  ?>
          <table width="100%" cellpadding="0" cellspacing="0" >
         <tr><td width="25%" align="left">CURRENT PASSWORD <span class="astrix_red">*</span></td><td width="1%"></td><td width="74%">
         <input type="password" id="curr_pwd" name="curr_pwd" onkeypress="return RestrictSpace()" class="form-control input-sm" required ></td></tr>
		 <tr>
		   <td height="19" colspan="3"><span class="astrix_red"><?php echo form_error('curr_pwd'); ?></span></td>
		 </tr>
		 <tr><td colspan="3">&nbsp;</td></tr>
		 <tr><td align="left">NEW PASSWORD<span class="astrix_red">*</span></td><td></td>
         <td><input type="password" id="new_pwd" name="new_pwd" onkeypress="return RestrictSpace()" class="form-control input-sm"   required></td></tr>
		 <tr><td colspan="3"><span class="astrix_red"><?php echo form_error('new_pwd'); ?></span></td></tr>
		 <tr><td colspan="3">&nbsp;</td></tr>
		 <tr><td align="left">CONFIRM PASSWORD<span class="astrix_red">*</span></td><td></td>
         <td><input type="password" id="con_pwd" name="con_pwd" onkeypress="return RestrictSpace()" class="form-control input-sm" required></td></tr>
		 <tr><td colspan="3"><span class="astrix_red"><?php echo form_error('con_pwd'); ?></span></td></tr>
		 <tr><td colspan="3">&nbsp;</td></tr>
          </table>
        </div>
        <div class="modal-footer">
          <a href="<?php echo base_url();?>Po/NssPo" class="w3-button w3-red w3-left" ><span class="glyphicon glyphicon-remove"></span>Close</a>
        <input type="submit" value=" SUBMIT" id="sub" name="sub"  class="w3-button w3-right w3-green w3-right " />
        
        </div>
      </div>
    </div>
  </div>
</div>
</form>

<script>
function RestrictSpace() {
    if (event.keyCode == 32) {
        return false;
    }
}
</script>
