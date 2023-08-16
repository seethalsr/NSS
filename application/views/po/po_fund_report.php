<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css">  
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script>
<script type="text/javascript"> 
$(function() {
   $( "#date" ).datepicker({
	   dateFormat: 'dd-mm-yy' 
	   });
 
});
</script>

<link rel="stylesheet" href="<?php echo base_url();?>css/w3.css">
<form name="frm1" id="frm1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data"  >
<span class="w3-center "><?php if(isset($msg)) echo '<div class='.$msg_type.'>'.$msg.'</div>';  ?></span>
<div class="card" >
<br />
<h5 align="center" ><b style="text-decoration:underline; color:#400040; ">ENTER FUND REPORT DETAILS OF <?php  if(isset($data_prev)){echo date('Y');}else{ echo date("Y",strtotime("-1 year"));}?></b></h5>
<?php if(isset($data_prev)&&(!empty($data_prev))){ 
if((isset($sanc_fund)&& !empty($sanc_fund))){?>
<table cellpadding="0" cellspacing="0" width="100%" border="1">
<tr align="center" class="table_th_cu"><td width="34%" height="22">Amount Sanctioned From University</td><td width="38%"> Total Spent</td><td width="28%">Balance</td></tr>
<tr align="center" style="background-color:#d9e6f9;"><td><b><?php if(isset($sanc_fund['amount_sanc'])) echo $sanc_fund['amount_sanc']; ?></b></td>
<td><b><?php if(isset($amount_spent_sum)) echo $amount_spent_sum; ?></b></td><td><b><?php if(isset($bal)) echo $bal; ?></b></td></tr>
<tr><td colspan="3">
<table cellpadding="0" cellspacing="0" height="100%" width="100%" border="1" id="myTable">
<tr align="center" class="table_th_cu" >
<td width="5%" ><b>Sl.No</b></td>
<td width="10%"><b>FUND TYPE</b></td>
<td width="22%"><b>Date</b></td><td width="44%"><b>Description on Expense</b></td>
<td width="19%"><b>Amount(Expense)</b></td>
</tr>
<tr align="center" >
<td >1</td>
<td>
<select id="fund_type[]" name="fund_type[]">
<option value="">---SELECT---</option>
<option value="R">REGULAR FUND</option>
<option value="S">SPECIAL FUND</option>
</select>
</td>
<td><input  type="text" id="date" name="date[]" placeholder='DD-MM-YYYY' maxlength="10" size="10"/></td>
<td style="padding: 5px 0px 5px 0px;"><textarea id="txt[]" name="txt[]" style="resize:none;overflow:auto; width:90%;" ></textarea></td>
<td><input  type="text" id="exp[]" name="exp[]" size="5" maxlength="5"/></td>
</tr>
</table>
</td></tr>
</table>
</div>
<a id="add_row" class="add_row  pull-left" > + Add Row</a>
<a id='delete_row' class="pull-right del_row"  ><span class="glyphicon-minus"></span> Delete Row</a>
<div class="w3-center"><input type="submit" value="SAVE" class="submit_but " id="save_f" name="save_f" />
 <input type="submit" value="FORWARD TO PRINCIPAL >>" class="fwd_but " id="fwd_f" name="fwd_f" /> </div>
 
<?php }else{?><h4  style="color:#330033; " class="w3-center"> FUND HAS NOT YET SANCTIONED BY UNIVERSITY</h4><?php }}else{?>
<table cellpadding="2" cellspacing="0" width="100%">
<tr><td width="2%"></td><td width="34%"><b>UPLOAD PREVIOUS YEAR(<?php echo date("Y",strtotime("-1 year")); ?>) FUND REPORT</b></td><td width="4%"></td>
<td width="43%"><input  name="up1" id="up1" class=" form-control input-file" type="file"></td> <td width="2%"></td><td width="12%"><input type="submit" value="UPLOAD" name="up_but" id="up_but" /></td><td width="3%"></td>
</tr>
</table>
<?php } ?>
</div>
</form>
<script>
     $(document).ready(function(){
      var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td> "+(i)+" </td><td><select id='fund_type[]' name='fund_type[]'><option value=''>---SELECT---</option><option value='R'>REGULAR FUND</option><option value='S'>SPECIAL FUND</option></select></td><td><input type='text' size='10' maxlength='10' placeholder='DD-MM-YYYY' id='date' name='date[]' /></td><td><textarea style='resize:none;overflow:auto; width:90%;' id='txt[]' name='txt[]'></textarea></td><td><input type='text' size='5' id='exp[]' name='exp[]' /></td>");

      $('#myTable').append('<tr  id="addr'+(i+1)+'" align="center" ></tr>');
      i++; 
  });
     $("#delete_row").click(function(){
    	 if(i>1){
		 $("#addr"+(i-1)).html('');
		 i--;
		 }
	 });

});
</script>