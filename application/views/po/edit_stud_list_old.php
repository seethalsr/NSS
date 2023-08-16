<form name="frm1" id="frm1" method="post"   action="<?php echo base_url(); ?>Po/NssPo/edit_stud_list/<?php echo $stud_det['nss_stud_id'];?>" >

<table cellpadding="0" cellspacing="0" width="100%" align="center" style="padding-left:75px; padding-top:20px;">
<tr><td colspan="4" align="center"><span style="color:#066; padding-bottom:5px;"><?php if(isset($msg)){?><?php echo $msg; ?><?php }?></span><br></td></tr>
<tr>
<td><label for="name">Email Id</label></td>
<td></td>
<td><input type="text" class="form-control input-sm" id="txt1" name="txt1" value="<?php echo $stud_det['account_student_email'];?>"></td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">Mobile Number</label></td>
<td></td>
<td><input type="text" class="form-control input-sm" id="txt2" name="txt2" value="<?php echo $stud_det['account_student_mobileno'];?>"></td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">Blood Group</label></td>
<td></td>
<td>
   						 <select id="blood_group" name="blood_group" >
              			 <option value="">--Select--</option>
			 			 <option value="O+" <?php if($stud_det['blood_group'] == 'O+') echo "selected";?> >O+ </option>
                         <option value="O-" <?php if($stud_det['blood_group'] == 'O-') echo "selected";?>>O- </option>
                         <option value="A+" <?php if($stud_det['blood_group'] == 'A+') echo "selected";?> >A+ </option>
                         <option value="A-" <?php if($stud_det['blood_group'] == 'A-') echo "selected";?> >A- </option>
                         <option value="AB+" <?php if($stud_det['blood_group'] == 'AB+') echo "selected";?> >AB+ </option>
                         <option value="AB-" <?php if($stud_det['blood_group'] == 'AB-') echo "selected";?> >AB- </option>
            			 </select>
</td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">Willing to Donate</label></td>
<td></td>
<td>
 <select id="donate" name="donate" class="form-control"  >
              			 <option value="">--Select--</option>
			 			 <option value="yes" <?php if($stud_det['donate'] == 'YES') echo "selected";?> >YES </option>
                         <option value="no" <?php if($stud_det['donate'] == 'NO') echo "selected";?>>NO</option>
                         
            			 </select>	
</td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">Last Donated</label></td>
<td></td>
<td>
<select size="1" name="month" >
<option  value="nil">NIL</option>
<option   value="01">January</option>
<option   value="02">February</option>
<option    value="03">March</option>
<option    value="04">April</option>
<option    value="05">May</option>
<option	   value="06">June</option>
<option    value="07">July</option>
<option    value="08">August</option>
<option     value="09">September</option>
<option   value="10">October</option>
<option value="11">November</option>
<option  value="12">December</option>
</select>
</td>
<td><label for="name">Year</label>
<input type="text" id="donate_yr" name="donate_yr" maxlength="4" />
</td>
</tr>
</table>

<div align="center" style="padding-top:25px;"><input type="submit" id="upd" name="upd" value="UPDATE" class="w3-button  w3-green " /></div>

</form>