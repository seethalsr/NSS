
<style>
.p1{
font-family:cloisterblack;
font-size:40px;
text-align:center;	
}
.p2{
font-family:Calibri;
font-size:24px;
font-weight:bold;	
}
.p3{
font-family:Georgia, "Times New Roman", Times, serif;
font-size:22px;
font-weight:bolder;	
}
.p4{
font-family:"Times New Roman", Times, serif;
font-size:14px;
width:150px;
vertical-align:baseline;
}
.p5{
font-family:Georgia, "Times New Roman", Times, serif;
font-style:italic;
font-size:14px;	
}
</style>
<table cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr><td width="1%" rowspan="18"></td>
<td width="10%" rowspan="3"><img src="<?php echo base_url();?>images/mgucerti.png" width="60"  height="60" align="center"/></td>
<td width="1%" rowspan="3"></td><td width="79%"><p class="p1">Mahatma Gandhi University</p></td>
<td width="1%" rowspan="3"></td><td width="10%" rowspan="3"><img src="<?php echo base_url();?>images/nss_bw.png" width="80"  height="60" align="center"/></td>
<td width="1%" rowspan="18"></td></tr>
<tr><td><span style="font-size:9px; text-align:center;">(Established by Kerala State Legislature by Notification No.3431/Leg.CI/85/Law,dated 17th April 1985)</span></td></tr>
<tr><td colspan="5" >&nbsp;</td></tr>
<tr><td colspan="5" >&nbsp;</td></tr>
<tr><td colspan="5" align="center"><span class="p2">NATIONAL SERVICE SCHEME</span></td></tr>
<tr><td colspan="5" align="center">&nbsp;</td></tr>
<tr><td colspan="5" align="center"><span class="p3">CERTIFICATE</span></td></tr>
<tr><td colspan="5" align="center">&nbsp;</td></tr>
<tr><td colspan="5" align="left"><span class="p4">Serial No.</span> <span style="color:#F00;"><?php echo '2017'.$student_details['nss_stud_id']; ?></span></td></tr>
<tr><td colspan="5" align="center">&nbsp;</td></tr>
<tr><td colspan="5" align="center">&nbsp;</td></tr>
<tr><td colspan="5" >  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p5">Certified that Shri / Kumari</span> <b><i> <?php  echo $student_details['account_student_name'];?> </i></b>
<span class="p5">Class </span> <b><i> <?php  echo $student_details['specialisation_id'];?></i> </b> <span class="p5"> Enrollment No.</span> <b><i> <?php  echo $student_details['nss_enroll_id'];?></i> </b> <span class="p5">of</span> <b><i> <?php  echo $student_details['college_name_for_gradecard'];?></i> </b> , <b><i><?php if($student_details['college_district']==1)echo 'ERNAKULAM';elseif($student_details['college_district']==2) echo 'KOTTAYAM'; elseif($student_details['college_district']==10) echo 'PATHANAMTHITTA'; elseif($student_details['college_district']==5) echo 'ALAPPUZHA';elseif($student_details['college_district']==6) echo 'IDUKKI'; ?></i></b>
<span class="p5"> completed satisfactorily the two year programme in the National Service Scheme from</span> <b><i> <?php  echo date("d-m-Y", strtotime($student_details['enrolled_date'])) ;?> </i></b> <span class="p5">to</span>  <b> <i><?php  echo date("d-m-Y", strtotime($student_details['enroll_end']));?></i> </b>.<br >
</td></tr>
<tr><td colspan="5" align="left"><span class="p5">Special Camping Programme:</span><br />
<span class="p5">from</span> <b><i> <?php if($student_details['splcamp_start']=='1970-01-01'){ echo'';} else{ echo date("d-m-Y", strtotime($student_details['splcamp_start']));}?> </i></b> <span class="p5">to</span> <b><i> 
<?php  if($student_details['splcamp_end']=='1970-01-01'){}else{ }echo date("d-m-Y", strtotime($student_details['splcamp_end'])) ;?> </i></b> <span class="p5">at</span> <b> <i><?php  echo $student_details['spl_desti'];?>. </i></b>
<span class="p5">Number of hours of service done </span><b><i> 240.</i> </b><br /><br /><br />
</td></tr>

<tr><td colspan="5" align="LEFT">
<table width="100%" cellpadding="1" >
<tr ><td width="20%" valign="baseline"></td>
<td width="1%"></td>
<td width="1%"></td>
<td width="32%" valign="baseline"><img src="<?php echo base_url();?>upload/pgm.PNG" width="150px;"/></td>
<td width="2%" valign="baseline"></td><td width="27%"><img src="<?php echo base_url();?>upload/vcsign.PNG" width="150px;"/></td>
</tr>
<tr ><td width="20%"><span class="p4"><?php echo 'Kottayam,'.'<br>'. date("d-m-Y", strtotime($student_details['iss_on']));?></span></td><td width="1%"></td><td width="1%"></td><td width="32%"><span class="p4">Programme Co-ordinator</span></td><td width="2%"></td><td width="27%"><span class="p4">Vice-Chancellor</span></td></tr>
</table>
</td></tr>
<tr><td colspan="5" align="center">&nbsp;</td></tr>
</table>