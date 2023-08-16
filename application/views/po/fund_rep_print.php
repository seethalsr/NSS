<link rel="stylesheet" href="<?php echo base_url();?>css/w3.css">
<table cellpadding="0" cellspacing="0" height="100%" width="100%" >
<tr><td colspan="4" align="center" style="text-decoration:underline; font-size:16px;"> <b>FUND REPORT OF <?php echo $sel_yr ; ?></b></td></tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr ><td colspan="3" style="border:1px solid black;" ><b>AMOUNT SANCTIONED FROM UNIVERSITY</b></td><td width="22%" align="center" style="border:1px solid black;"><?php echo $sanc_fund['amount_sanc'];?></td></tr>
<tr><td colspan="3" style="border:1px solid black;"><b>TOTAL SPENT</b></td><td style="border:1px solid black;" align="center"><?php echo $amount_spent_sum; ?></td></tr>
<tr><td colspan="3" style="border:1px solid black;"><b>BALANCE</b></td><td style="border:1px solid black;" align="center"><?php echo $bal; ?></td></tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr align="center"><td width="16%" style="border:1px solid black;"><b>FUND TYPE</b></td><td width="12%" style="border:1px solid black;"><b>DATE</b></td><td width="50%" style="border:1px solid black;"><b>EXPENSE DETAILS</b></td><td style="border:1px solid black;"><b>AMOUNT SPENT</b></td></tr>
<?php  foreach($fund_det as $val){?>
<tr align="center" ><td style="border:1px solid black; " class="w3-center"><?php if($val['fund_type']=="R") echo "REGULAR"; elseif($val['fund_type']=="S") echo "SPECIAL"; ?></td><td style="border:1px solid black; " class="w3-center"><?php echo date("d-m-Y", strtotime($val['date'])) ; ?></td><td style="border:1px solid black;"><?php echo $val['expense_desc'];?></td><td style="border:1px solid black;"><?php echo $val['amount_spent']; ?></td></tr>
<?php }?>
</table>