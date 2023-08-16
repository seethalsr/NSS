
<style>
.p1{
font-family:cloisterblack;
font-size:40px;
text-align:center;	
}
.p2{
font-family:Calibri;
font-size:38px;
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
}
.p5{
font-family:Georgia, "Times New Roman", Times, serif;
font-style:italic;
font-size:14px;	
}
</style>


<?php  foreach($student_details_arr as $student_details){?>
<table cellpadding="0" cellspacing="0" height="100%" width="100%" style="page-break-after:always">
<tr align="center"><td width="1%" rowspan="18"></td>
<td width="1%" rowspan="3"></td><td width="79%"><img src="<?php echo base_url();?>images/nss_bw.png" width="80"  height="60" align="center"/></td>
<td width="1%" rowspan="18"></td></tr>
<tr align="center"><td  width="1%"  align="center"><span class="p2">NATIONAL SERVICE SCHEME</span></td></tr>
<tr><td colspan="5" align="center"><span class="p3">CERTIFICATE</span></td></tr>
<tr><td colspan="5" align="center">&nbsp;</td></tr>
<tr><td colspan="5" align="center">&nbsp;</td></tr>
<tr><td colspan="5" align="center">&nbsp;</td></tr>
<tr><td colspan="5" >  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="p5">This is to Certify that Shri / Kumari</span> <b><i> <?php  echo $student_details['account_student_name'];?> </i></b>
<span class="p5">Class </span> <b><i> <?php  echo $student_details['specialisation_id'];?></i> </b> <span class="p5"> Enrollment No.</span> <b><i> <?php  echo $student_details['nss_enroll_id'];?></i> </b> <span class="p5">of</span> <b><i> <?php  echo $student_details['college_name_for_gradecard'];?></i> </b> , <b><i><?php if($student_details['college_district']==1)echo 'KASARGOD';elseif($student_details['college_district']==2) echo 'KANNUR'; elseif($student_details['college_district']==6) echo 'WAYANAD'; ?></i></b>
<span class="p5">has successfully completed 240 hours of various N.S.S activities undertaken by the College N.S.S unit during the two year period</span> <b><i> <?php  echo date("Y", strtotime($student_details['enrolled_date'])) ;?> </i></b> <span class="p5">to</span>  <b> <i><?php  echo date("Y", strtotime($student_details['enroll_end']));?></i> </b>and also he/she has also attended the special camping programme during the perod.<br >
</td></tr>
<tr><td colspan="5" align="left"><span class="p5">Special Camping Programme:</span><br />
<span class="p5">from</span> <b><i> <?php  echo date("d-m-Y", strtotime($student_details['splcamp_start']));?> </i></b> <span class="p5">to</span> <b><i> 
<?php  echo date("d-m-Y", strtotime($student_details['splcamp_end'])) ;?> </i></b> <span class="p5">at</span> <b> <i><?php  echo $student_details['spl_desti'];?> .</i></b>
<span class="p5">Number of hours of service done </span><b><i> 240.</i> </b><br /><br /><br />
</td></tr>
<tr><td colspan="5" align="center">
<table width="100%" cellpadding="1" cellspacing="2">
<tr><td width="1%"></td><td width="1%"></td><td width="1%"></td><td width="82%"><span class="p4">Programme Co-ordinator</span></td><td width="2%"></td><td width="27%"><span class="p4">Vice-Chancellor</span></td></tr>
</table>
</td></tr>
<tr ><td colspan="5" align="center">&nbsp;</td></tr>
 
</table>
<hr />

<?php }?>
