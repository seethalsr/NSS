

<table height="100%" width="100%" border="1">
<tr align="center" style="width:25px;"><td height="23" colspan="9"><p><b>ELIGIBLITY LIST PRINT 2019</b></p></td></tr>

<tr align="center"><td >Sl.No</td><td>Enroll No.</td><td>PRN</td><td>Student Name</td><td>Course</td><td>Special Camp</td><td>Mini 1</td><td>Mini 2</td><td>Total Hour</td></tr>
<?php $i=1;foreach ($eli_det as $val){ ?>
<tr align="center"><td><?php echo $i;?></td><td><?php echo $val['nss_enroll_id'];?></td><td><?php echo $val['account_id'];?></td><td><?php echo $val['account_student_name'];?></td><td><?php echo $val['specialisation_id'];?></td><td><?php 
if($val['splcamp']=='')echo 'NO';else
echo $val['splcamp'];?></td><td><?php if($val['mini1']=='')echo 'NO';else
echo $val['mini1'];?></td><td><?php if($val['mini2']=='')echo 'NO';else 
echo $val['mini2'];?></td><td><?php echo $val['tot_hr'];?></td></tr>
<?php $i++;}?>
</table>