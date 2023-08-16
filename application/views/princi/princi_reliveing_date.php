<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css">  
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script>
<script type="text/javascript"> 
$(function() {
   $( "#to_date" ).datepicker({
	   dateFormat: 'dd-mm-yy' 
	   });

});
</script>
<link rel="stylesheet" href="<?php echo base_url();?>css/w3.css">
<?php if(isset($logout_msg)){?>
<div class="container">
  <div class="modal show  " id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          NEW PRINCIPAL HAS BEEN CREATED SUCCESSFULLY.NOW YOU CAN LOGOUT.
        </div>
        
      </div>
    </div>
  </div>
</div>
<?php }else{ ?>
<form id="frm" name="frm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="container">
  <div class="modal show  " id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header w3-center">
        <span style="color:#F00;"><?php if(isset($msg)) echo $msg;  ?></span>
        
          <h4 class="modal-title" style="color:#3b579d">ENTER RELIVING DATE</h4>
        </div>
        <div class="modal-body">
          <table width="100%" cellpadding="0" cellspacing="0">
         
          <tr><td width="16%">FROM DATE:<span class="astrix_red">*</span></td><td width="30%"> <input type="text" name="from_date" id="from_date" class="form-control input-sm"  disabled="disabled" 
		  <?php if(isset($princi_det)){?>value="<?php echo date("d-m-Y", strtotime($princi_det['from_date'])); ?>"<?php } ?> /></td>
          <td width="3%"></td><td width="16%">TO DATE:<span class="astrix_red">*</span></td><td width="35%"><input type="text" id="to_date" name="to_date" class="form-control input-sm"  value="<?php if(isset($data_curr_prin['to_date'])&& !empty($data_curr_prin['to_date'])) echo date("Y-m-d", strtotime($data_curr_prin['to_date'])); ?>"
          /></td></tr>
           <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td></td>
            <td colspan="2"><label class="msg_red" style="color:#F00;"><?php echo form_error('to_date');?></label></td>
          </tr>
          </table>
        </div>
        <div class="modal-footer">
        <a href="<?php echo base_url();?>Princi/NssPrinci/profile" class="btn" style="background:#09C; color:#FFF;"><span class="glyphicon glyphicon-remove"></span>Close</a>
        <input type="submit" value="NEXT" id="sub_next" name="sub_next"  class="btn" style="background:#1acc36; color:#FFF;" />
        </div>
      </div>
    </div>
  </div>
</div>
</form>
<?php } ?>