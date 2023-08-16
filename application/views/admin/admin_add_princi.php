
<form name="frm1" id="frm1" method="post"   >

<table cellpadding="0" cellspacing="0" height="100%" width="100%" style="vertical-align:top;">
<tr class="w3-center"><td height="31"><span ><?php if(isset($msg)){?>
  <h6  style="color:#FF8040; "><?php echo $msg; ?></h6><?php }?></span></td></tr>
<tr><td height="31" class="w3-center"><span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">Add New College</span></td>
</tr>
<tr><td height="19">&nbsp </td>
</tr>
<tr><td>

<table cellpadding="0" cellspacing="0" height="100%" width="100%" style="vertical-align:top;">
<tr><td height="36" colspan="7" style="color:#000040; font-size:18px;">Fill College Details </td></tr>
<tr style="border:0;border-top:1px solid #C0C0C0;margin:0px 0"><td colspan="7"></td></tr>
<tr>
<td height="28" colspan="7" >
 <label class="radio-inline " for="radios-1"  >
      <input type="radio" name="radios" id="radios-1" value="Government" checked="checked">
      Government
      </label>
        <label class="radio-inline" for="radios-0">
       <input type="radio" name="radios" id="radios-0" value="SF" >
       Self Financing
       </label> 
      <label class="radio-inline" for="radios-1">
      <input type="radio" name="radios" id="radios-1" value="ADC">
      Aided
      </label>
</td></tr>
<tr><td colspan="8">&nbsp </td></tr>
<tr>
<td width="145" height="31"> <label for="name">Name of College <a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="4">&nbsp;</td>
<td width="390"><input type="text" class="form-control input-sm" id="txt1" name="txt1" value="<?php echo set_value("txt1");?>"></td>
<td width="53">&nbsp </td>
<td width="145"> <label for="name">Email Id: <a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="4">&nbsp;</td>
<td width="390"><input type="text" class="form-control input-sm" id="txt2" name="txt2" value="<?php echo set_value("txt2");?>"></td>
</tr>
<tr><td height="31" colspan="4"><span style="color:#F00;"><?php echo form_error('txt1'); ?></span> </td>
<td colspan="4"><span style="color:#F00;"><?php echo form_error('txt2'); ?></span> </td></tr>
<tr><td colspan="2"></td><td colspan="2"></td><td colspan="2"></td><td colspan="2"></td></tr>
<tr>
<td width="145" height="62"> <label for="name">Address <a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="4">&nbsp;</td>
<td width="390"><textarea class="form-control input-sm" id="tx32" name="txt3" value="<?php echo set_value("txt3");?>"  rows="3" ></textarea> </td>
<td width="53">&nbsp </td>
<td width="90"><label for="name">District <a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="5">&nbsp;</td>
<td width="440"><input type="text" class="form-control input-sm" id="txt4" name="txt4" value="<?php echo set_value("txt4");?>"></td>
</tr>
<tr><td height="38" colspan="4"><span style="color:#F00;"><?php echo form_error('txt3'); ?></span> </td>
<td colspan="4"><span style="color:#F00;"><?php echo form_error('txt4'); ?></span> </td></tr>
<tr>
<td width="145"> <label for="name">Pincode <a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="4">&nbsp;</td>
<td width="390"><input type="text" class="form-control input-sm" id="txt5" name="txt5" value="<?php echo set_value("txt5");?>" maxlength="6"
			autocomplete="off" onKeyPress="return input_number(event)"></td>
<td width="53">&nbsp </td>
<td width="90"><label for="name"> Contact No: <a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="5">&nbsp;</td>
<td width="440"><input type="text" class="form-control input-sm" id="txt6" name="txt6" value="<?php echo set_value("txt6");?>" autocomplete="off" onKeyPress="return input_number(event)" maxlength="10"></td>
</tr>
<tr><td height="34" colspan="4"><span style="color:#F00;"><?php echo form_error('txt5'); ?></span> </td>
<td colspan="4"><span style="color:#F00;"><?php echo form_error('txt6'); ?></span> </td></tr>


<tr><td style="color:#000040; font-size:18px;" colspan="7">Fill Principal Details </td></tr>
<tr style="border:0;border-top:1px solid #C0C0C0;margin:0px 0"><td colspan="7"></td></tr>
<tr style="padding-bottom:5px;"><td colspan="7"></td></tr>
<tr><td colspan="8">&nbsp </td></tr>
<tr>
<td width="145" height="27"> <label for="name">Name of Principal <a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="4">&nbsp;</td>
<td width="390"><input type="text" class="form-control input-sm" id="txt7" name="txt7" value="<?php echo set_value("txt7");?>"></td>
<td width="53">&nbsp </td>
<td width="145"> <label for="name">Email Id: <a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="4">&nbsp;</td>
<td width="390"><input type="text" class="form-control input-sm" id="txt8" name="txt8" value="<?php echo set_value("txt8");?>"></td>
</tr>
<tr><td height="30" colspan="4"><span style="color:#F00;"><?php echo form_error('txt7'); ?></span> </td>
<td colspan="4"><span style="color:#F00;"><?php echo form_error('txt8'); ?></span> </td></tr>
<tr>
<td width="145"> <label for="name">Contact Number <a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="4">&nbsp;</td>
<td width="390"><input type="text" class="form-control input-sm" id="txt9" name="txt9" value="<?php echo set_value("txt9");?>" autocomplete="off" onKeyPress="return input_number(event)" maxlength="10"></td>
<td width="53">&nbsp </td>

</tr>



<tr><td colspan="2"><span style="color:#F00;"><?php echo form_error('txt9'); ?></span></td><td colspan="2"></td><td colspan="2">
 <a href='<?php echo base_url('Admin/NssAdmin/add_college/'); ?>' style="text-decoration:none; "> 
			<input type="submit" class="btn btn-primary" value="Submit" name="submit5" id="submit5" style="background-color:#0070DF; color:#FFF"/></a>
</td><td colspan="2"></td></tr>
</table>

</td></tr>

</table>

</form>



