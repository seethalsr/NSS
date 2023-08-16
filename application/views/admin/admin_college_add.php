<form name="frm1" id="frm1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
       <label class="radio-inline" for="radios-1">
      <input type="radio" name="radios" id="radios-1" value="ADC">
      Aided
      </label>
        <label class="radio-inline" for="radios-0">
       <input type="radio" name="radios" id="radios-0" value="SF" >
       Self Financing
       </label> 
     
</td></tr>
<tr><td colspan="8">&nbsp </td></tr>
<tr>

<td width="145" height="31"> <label for="name">College Name <a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="4">&nbsp;</td>
<td width="390"><input type="text" class="form-control input-sm" id="txt1" name="txt1" value="<?php echo set_value("txt1");?>"></td>
<td width="53">&nbsp </td>
<td width="145" height="62"> <label for="name">Address <a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="4">&nbsp;</td>
<td width="390"><textarea class="form-control input-sm" id="txt2" name="txt2" value="<?php echo set_value("txt2");?>"  rows="3" ></textarea> </td>
<td width="53">&nbsp </td>


<td width="90"><label for="name">Contact Number <a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="5">&nbsp;</td>
<td width="440"><input type="text" class="form-control input-sm" id="txt3" name="txt3" value="<?php echo set_value("txt3");?>"></td>
</tr>
<tr><td height="38" colspan="4"><span style="color:#F00;"></span> </td>
<td colspan="4"><span style="color:#F00;"></span> </td></tr>
<tr>
<td width="145"> <label for="name">Email <a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="4">&nbsp;</td>
<td width="390"><input type="text" class="form-control input-sm" id="txt4" name="txt4" value="<?php echo set_value("txt4");?>" ></td>
<td width="53">&nbsp </td>
<td width="90"><label for="name"> District: <a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="5">&nbsp;</td>
<td width="440"><input type="text" class="form-control input-sm" id="txt5" name="txt5" value="<?php echo set_value("txt5");?>" ></td>
<tr><td height="34" colspan="4"><span style="color:#F00;"><?php echo form_error('txt5'); ?></span> </td>
<td colspan="4"><span style="color:#F00;"><?php echo form_error('txt5'); ?></span> </td></tr>





<tr>
    <td>

 <a href='<?php echo base_url('Admin/NssAdmin/admin_college_add/'); ?>' style="text-decoration:none; "> 
			<input type="submit" class="btn btn-primary" value="Submit" name="submit5" id="submit5" style="background-color:#0070DF; color:#FFF"/></a>
</td><td colspan="2"></td></tr>
</table>

</td></tr>

</table>

</form>



