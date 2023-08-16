<?php //print_r($get_2yr[0]['verification_id']);exit; ?>

<?php // print_r($get_2yr[0]['verification_id']);exit; ?>
<form name="frm1" id="frm1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data"  >
<table cellpadding="0" cellspacing="0" height="100%" width="100%"  >
<tr>
<td colspan="4">
	<div class="w3-center" style="padding-bottom:0px">
    		<span ><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span><br>
        	<span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">Fund Report Upload</span>
            <hr>
	</div>
</td>
</tr>
<tr>
<td class="w3-center" colspan="4">
<?php if($get_2yr){?><a href="<?php echo base_url();?>uploaded_pdf/<?php echo  $college_id ;?>/fund_2yr.pdf" class="two " target="_blank"><span style="color:#004080; text-decoration:underline;"  > CLICK HERE TO VIEW PREVIOUS YEAR FUND REPORT </span></a></td>
<?php }?>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<?php if($get_2yr[0]['verification_id'] == 1)
{
	if(isset($msg)){if($msg == "Successfully forwarded to University")
	{?>
<tr>
<td width="20%">
<label class="radio-inline" for="radios-0">
       <input type="radio"  name="radios" id="radios-0" value="A" checked="checked" >
       Accepted
       </label> 
      <label class="radio-inline" for="radios-1">
      <input type="radio"  name="radios" id="radios-1" value="R"  >
      Rejected
      </label>
</td>

<td width="52%">
<textarea class="form-control input-sm" id="txt1" name="txt1"   rows="3" >Remarks:</textarea>
</td>
<td width="9%"></td>
<td width="19%"><input type="submit" class="btn btn-primary" value="Forward to University/Program Officer" name="submitfwd" id="submitfwd" style="background-color:#FF8000; color:#FFF"/></td>
</tr>
<?php }}}?>
</table>

<?php if(isset($monthly_fund)){?>
<table cellpadding="0" cellspacing="0" height="100%" width="100%" border="1">
<thead>
<tr>
<th>month</th>
<th>Spent</th>
<th>Description</th>
<th>Attachment</th>
</tr>
</thead>
<tbody>
<?php $total = 0; foreach ($monthly_fund as $value): $total = $total + $value['fund_spent'];  ?>
<tr>
<td><?php echo $value['fund_month'];?></td>
<td><?php echo $value['fund_spent'];?></td>
<td><?php echo $value['fund_desc'];?></td>
<td><a href="<?php echo base_url();?>uploaded_pdf/<?php echo  $college_id ;?>/fund_monthly_<?php echo $value['fund_month'];?>.pdf" target="_blank">View</a></td>
</tr>
<?php endforeach; ?>
<tr style="background-color:#FFB"><td></td><td><?php echo $total;?> </td><td colspan="2"></td></tr>
</tbody>
</table>
<?php } ?>
</form>