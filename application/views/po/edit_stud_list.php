 
 <link href="<?php echo base_url();?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
 <link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css">  
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script>
<script type="text/javascript"> 
$(function() {
	
	 $(document).on('focus', '.datepicker',function(){
            $(this).datepicker({
                todayHighlight:true,
                format:'yyyy-mm-dd',
                autoclose:true
            })
        });
 
 
});
</script>

<form name="frm1" id="frm1" method="post"   action="<?php echo base_url(); ?>Po/NssPo/edit_stud_list/<?php echo $stud_det['nss_stud_id'];?>" >

<table cellpadding="0" cellspacing="0" width="100%" align="center" style="padding-left:75px; padding-top:20px;">
<tr><td colspan="4" align="center"><span style="color:#066; padding-bottom:5px;"><?php if(isset($msg)){?><?php echo $msg; ?><?php }?></span><br></td></tr>
<tr>
<td><label for="name">PRN No:</label></td>
<td></td>
<td><input type="text" class="form-control input-sm" id="prn" name="prn" value="<?php echo $stud_det['account_id'];?>" readonly="readonly"></td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">NAME:</label></td>
<td></td>
<td><input type="text" class="form-control input-sm" id="name" name="name" value="<?php echo $stud_det['account_student_name'];?>" readonly="readonly"></td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">MOBILE NO:</label></td>
<td></td>
<td><input type="text" class="form-control input-sm" id="mob" name="mob" value="<?php echo $stud_det['account_student_mobileno'];?>" readonly="readonly"></td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name" style="display:none">RESERVATION:</label></td>
<td></td>
<td>
 <select id="res" name="res" class="form-control" style="display:none" >
              			 <option value="">--Select--</option>
			 			 <option value="OBC" <?php if(isset($stud_det['cast']) && $stud_det['cast'] == "OBC") echo "selected";?>> <?php echo "OBC"; ?></option>
						  
						   <option value="Scheduled Castes(SC)" <?php if(isset($stud_det['cast']) &&$stud_det['cast'] == "Scheduled Castes(SC)") echo "selected";?>> <?php echo "Scheduled Castes(SC)"; ?></option>
						   <option value="Scheduled Tribes(ST)" <?php if(isset($stud_det['cast']) &&$stud_det['cast'] == "Scheduled Tribes(ST)") echo "selected";?>> <?php echo "Scheduled Tribes(ST)"; ?></option>
						   <option value="General Category" <?php if(isset($stud_det['cast']) && $stud_det['cast'] == "General Category") echo "selected";?>> <?php echo "General Category"; ?></option>
						  
            			 </select>	
</td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr style="display:none">
<td><label for="name">GENDER:</label></td>
<td></td>
<td>
<select id="gender" name="gender" readonly="readonly">
<option value="F" <?php if(isset($stud_det['gender']) && $stud_det['gender'] == "F") echo "selected";?>> <?php echo "FEMALE"; ?></option>
						   <option value="M" <?php if(isset($stud_det['gender']) && $stud_det['gender'] == "M") echo "selected";?>> <?php echo "MALE"; ?></option>
						   <option value="O" <?php if(isset($stud_det['gender']) && $stud_det['gender'] == "O") echo "selected";?>> <?php echo "OTHER"; ?></option>
						</select>  
						  </td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>

<tr style="display:none">
<td><label for="name">Blood Group</label></td>
<td></td>
<td>
   						 <select id="blood_group" name="blood_group"  readonly="readonly">
              			 <option value="">--Select--</option>
			 			 <option value="O+" <?php if($stud_det['blood_group'] == 'O+') echo "selected";?> >O+ </option>
                         <option value="O-" <?php if($stud_det['blood_group'] == 'O-') echo "selected";?>>O- </option>
                         <option value="A+" <?php if($stud_det['blood_group'] == 'A+') echo "selected";?> >A+ </option>
                         <option value="A-" <?php if($stud_det['blood_group'] == 'A-') echo "selected";?> >A- </option>
                         <option value="B+" <?php if($stud_det['blood_group'] == 'B+') echo "selected";?> >B+ </option>
                         <option value="B-" <?php if($stud_det['blood_group'] == 'B-') echo "selected";?> >B- </option>
                         <option value="AB+" <?php if($stud_det['blood_group'] == 'AB+') echo "selected";?> >AB+ </option>
                         <option value="AB-" <?php if($stud_det['blood_group'] == 'AB-') echo "selected";?> >AB- </option>
            			 </select>
</td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr style="display:none">
<td><label for="name">Willing to Donate</label></td>
<td></td>
<td>
 <select id="donate" name="donate" class="form-control" readonly="readonly" >
              			 <option value="">--Select--</option>
			 			 <option value="YES" <?php if($stud_det['donate'] == 'YES') echo "selected";?> >YES </option>
                         <option value="NO" <?php if($stud_det['donate'] == 'NO') echo "selected";?>>NO</option>
                         
            			 </select>	
</td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr style="display:none">
<td><label for="name">ADMISSION YEAR:</label></td>
<td></td>
<td>
 <select id="admyear" name="admyear" class="form-control" readonly="readonly" >
 <option value="2016" <?php if(isset($stud_det['admission_year']) && $stud_det['admission_year'] == "2016") echo "selected";?>> <?php echo "2016"; ?></option>
<option value="2017" <?php if(isset($stud_det['admission_year']) && $stud_det['admission_year'] == "2017") echo "selected";?>> <?php echo "2017"; ?></option>
						   <option value="2018" <?php if(isset($stud_det['admission_year']) && $stud_det['admission_year'] == "2018") echo "selected";?>> <?php echo "2018"; ?></option>
</select>						   
</td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">SPECIALISATION NAME:</label></td>
<td></td>
<td><input type="text" class="form-control input-sm" id="spl" name="spl" value="<?php echo $stud_det['specialisation_id'];?>"></td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr style="display:none">
<td><label for="name">ENROLL START DATE:</label></td>
<td></td>
<td><input type="text" readonly="readonly" class="form-control datepicker" name="start_enrolled_date" value="<?php if($stud_det['enrolled_date']<>'1970-01-01 00:00:00')echo date("m/d/Y", strtotime($stud_det['enrolled_date'] )) ;?>" autocomplete="off" placeholder="MM/DD/YYYY"  /></td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr style="display:none">
<td><label for="name">ENROLL END DATE:</label></td>
<td></td>
<td><input type="text" readonly="readonly" class="form-control datepicker" name="end_enrolled_date" value="<?php if($stud_det['enroll_end']<>'1970-01-01 00:00:00') echo date("m/d/Y", strtotime($stud_det['enroll_end'] )) ;?>" autocomplete="off" placeholder="MM/DD/YYYY" /></td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr style="display:none">
<td><label for="name">MINI CAMP 1:</label></td>
<td></td>
<td>
<select id="mini1" name="mini1" class="form-control" readonly="readonly" >
<option value="" <?php if(isset($stud_det['mini1']) && $stud_det['mini1'] == "") echo "selected";?>> <?php echo "---Select--"; ?></option>
<option value="YES" <?php if(isset($stud_det['mini1']) && $stud_det['mini1'] == "YES") echo "selected";?>> <?php echo "YES"; ?></option>
						   <option value="NO" <?php if(isset($stud_det['mini1']) && $stud_det['mini1'] == "NO") echo "selected";?>> <?php echo "NO"; ?></option>
</select>
 </td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr style="display:none">
<td><label for="name">MINI CAMP 2:</label></td>
<td></td>
<td>
<select id="mini2" name="mini2" class="form-control" readonly="readonly" >
<option value="" <?php if(isset($stud_det['mini2']) && $stud_det['mini2'] == "") echo "selected";?>> <?php echo "--select--"; ?></option>
<option value="YES" <?php if(isset($stud_det['mini2']) && $stud_det['mini2'] == "YES") echo "selected";?>> <?php echo "YES"; ?></option>
						   <option value="NO" <?php if(isset($stud_det['mini2']) && $stud_det['mini2'] == "NO") echo "selected";?>> <?php echo "NO"; ?></option>
</select>
</td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr style="display:none">
<td><label for="name">SPECIAL CAMP:</label></td>
<td></td>
<td>

<select id="splcamp" name="splcamp" class="form-control" readonly="readonly" >
<option value="" <?php if(isset($stud_det['splcamp']) && $stud_det['splcamp'] == "") echo "selected";?>> <?php echo "--select--"; ?></option>
<option value="YES" <?php if(isset($stud_det['splcamp']) && $stud_det['splcamp'] == "YES") echo "selected";?>> <?php echo "YES"; ?></option>
						   <option value="NO" <?php if(isset($stud_det['splcamp']) && $stud_det['splcamp'] == "NO") echo "selected";?>> <?php echo "NO"; ?></option>
</select>
</td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">SPECIAL CAMP START DATE:</label></td>
<td></td>
<td><input type="text" class="form-control datepicker" name="spl_start" value="<?php if($stud_det['splcamp_start']<>'1970-01-01 00:00:00') echo date("m/d/Y", strtotime($stud_det['splcamp_start'] )) ;?>" autocomplete="off" placeholder="MM/DD/YYYY"  /></td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">SPECIAL CAMP END DATE:</label></td>
<td></td>
<td><input type="text" class="form-control datepicker" name="spl_end" value="<?php if($stud_det['splcamp_end']<>'1970-01-01 00:00:00') echo date("m/d/Y", strtotime($stud_det['splcamp_end'] )) ;?>" autocomplete="off" placeholder="MM/DD/YYYY"  /></td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">SPECIAL CAMP DESTINATION:</label></td>
<td></td>
<td><input type="text" class="form-control input-sm" id="spl_desti" name="spl_desti" value="<?php echo $stud_det['spl_desti'];?>" readonly="readonly"></td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">TOTAL HOURS:</label></td>
<td></td>
<td><input type="text" class="form-control input-sm" id="tot_hr" name="tot_hr" value="<?php echo $stud_det['tot_hr'];?>"readonly="readonly"></td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr><td colspan="4"><input type="submit" id="upd" name="upd" value="UPDATE" class="w3-button  w3-green " /></td></tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>

<div align="center" style="padding-bottom:25px;"></div>

</form>