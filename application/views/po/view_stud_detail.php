

<table cellpadding="0" cellspacing="0" width="100%" align="center" style="padding-left:75px; padding-top:20px;">
<tr><td colspan="4" align="center"><span style="color:#066; padding-bottom:5px;"><?php if(isset($msg)){?><?php echo $msg; ?><?php }?></span><br></td></tr>
<tr>
<td><label for="name">PRN No:</label></td>
<td></td>
<td> <?php echo $stud_det['account_id'];?> </td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">NAME:</label></td>
<td></td>
<td> <?php echo $stud_det['account_student_name'];?> </td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">MOBILE NO:</label></td>
<td></td>
<td> <?php echo $stud_det['account_student_mobileno'];?> </td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">RESERVATION:</label></td>
<td></td>
<td>
  <?php echo $stud_det['cast']; ?> 
</td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">GENDER:</label></td>
<td></td>
<td>  <?php echo  $stud_det['gender']; ?>   
						  </td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>

<tr>
<td><label for="name">Blood Group</label></td>
<td></td>
<td>   <?php  echo $stud_det['blood_group'];?> 
</td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">Willing to Donate</label></td>
<td></td>
<td> <?php echo  $stud_det['donate'];?> 
</td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">ADMISSION YEAR:</label></td>
<td></td>
<td> <?php  echo $stud_det['admission_year'];?>    
</td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">SPECIALISATION NAME:</label></td>
<td></td>
<td> <?php echo $stud_det['specialisation_id'];?> </td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">ENROLL START DATE:</label></td>
<td></td>
<td> <?php if($stud_det['enrolled_date']<>'1970-01-01 00:00:00') echo $stud_det['enrolled_date'];?> </td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">ENROLL END DATE:</label></td>
<td></td>
<td> <?php if($stud_det['enroll_end']<>'1970-01-01 00:00:00') echo $stud_det['enroll_end'];?> </td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">MINI CAMP 1:</label></td>
<td></td>
<td> <?php echo $stud_det['mini1'];?> </td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">MINI CAMP 2:</label></td>
<td></td>
<td> <?php echo $stud_det['mini2'];?> </td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">SPECIAL CAMP:</label></td>
<td></td>
<td> <?php echo $stud_det['splcamp'];?> </td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">SPECIAL CAMP START DATE:</label></td>
<td></td>
<td> <?php if($stud_det['splcamp_start']<>'1970-01-01 00:00:00') echo $stud_det['splcamp_start'];?> </td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">SPECIAL CAMP END DATE:</label></td>
<td></td>
<td> <?php if($stud_det['splcamp_end']<>'1970-01-01 00:00:00') echo $stud_det['splcamp_end'];?> </td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">SPECIALISATION DESTINATION:</label></td>
<td></td>
<td> <?php echo $stud_det['spl_desti'];?> </td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr>
<td><label for="name">TOTAL HOURS:</label></td>
<td></td>
<td> <?php echo $stud_det['tot_hr'];?> </td>
<td></td>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
</table>

</form>