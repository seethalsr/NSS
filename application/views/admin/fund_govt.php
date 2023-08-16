<form id="frm" name="frm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<?php if(empty($fund_gov_data_yr)){?>
<div class="card" >
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">FUND FROM GOVERNMENT</b></h4>
<table width="100%">
<tr>
  <td width="30%">&nbsp;</td>
  <td width="16%">Amount from Government</td><td width="2%"><span class="astrix_red">*</span></td><td width="25%"><input type="text" id="fund_gov" name="fund_gov"  class="form-control"onKeyPress="return input_number(event)" /></td>
  <td width="27%">&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>Account Number</td><td><span class="astrix_red">*</span></td><td><input type="text" id="fund_acc" name="fund_acc"  class="form-control"/></td>
  <td>&nbsp;</td>
</tr>
<tr ><td colspan="5">&nbsp;</td></tr>
<tr align="center"><td colspan="5"><input type="submit" id="sub_fund_gov" name="sub_fund_gov"  class="w3-button r w3-green " value="FORWARD TO SO" /></td></tr>
<tr ><td colspan="5">&nbsp;</td></tr>
</table>
</div>
<?php }?>
<?php if(isset($fund_gov_data)&& !empty($fund_gov_data)){ ?>
<table width="100%">
<th>Sl.No:</th>
<th>YEAR</th>
<th>AMOUNT</th>
<th>ACCOUNT</th>
<th>STATUS</th>
<th>REMARKS</th>
<tbody>
<?php  $i=0; foreach($fund_gov_data as $val){ $i++;?>
<tr><td><?php echo $i;?></td><td><?php echo $val['year'];?></td><td><?php echo $val['amount'];?></td><td><?php echo $val['account'];?></td>
<td><?php if($val['verification_id']=="3") echo "FORWARDED TO SO"; elseif($val['verification_id']=="4") echo "ACCEPTED BY SO"; elseif($val['verification_id']=="3R") echo "REJECTED BY SO"; ?></td>
<td><?php echo $val['remarks'];?></td></tr>
<?php }?>
</tbody>
</table>
<?php } ?>
</form>