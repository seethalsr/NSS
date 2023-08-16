<?php		// for the color scheme (blue)2= fwd to princi green)3,4,6 = fwd to uni (red)5= rej by uni  (red)7 = rej princi
		if(isset($enroll_list)){
		if(in_array('1',$check_veri))
		{
		$colr = '#7BABD5  ';
		$status = 'FORWARDED TO PRINCIPAL';
		}
		elseif(in_array('2',$check_veri)||in_array('2R',$check_veri)||in_array('3',$check_veri))
		{
		$colr = '#7BD587';
		$status = 'FORWARDED TO UNIVERSITY';
		}
		elseif(in_array('1R',$check_veri))
		{
		$colr = '#F79E95';
		$status = 'REJECTED BY PRINCIPAL';
		}
		elseif(in_array('3R',$check_veri))
		{
		$colr = '#F79E95';
		$status = 'REJECTED BY UNIVERSITY';
		}
		}
 ?>
<script language="javascript" src="<?php echo base_url(); ?>js/thickbox.js" type="text/javascript"></script>
<link href='<?php echo base_url(); ?>css/thickbox.css' rel='stylesheet' type='text/css'/>
<link href='<?php //echo base_url(); ?>css/w3.css' rel='stylesheet' type='text/css'/>
<div class="w3-center " style="padding-bottom:0px; color:#9F0">
<span ><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span><br>
</div>
<div class="w3-card" >
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">NSS ENROLLED LIST</b></h4>
<form name="frm1" id="frm1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td colspan="4">&nbsp;</td></tr>
  
    <tr><td colspan="4"></td></tr>
    <tr style="border:0;border-top:1px solid #C0C0C0;margin:0px 0"></tr>
	<?php if(isset($unit)){ ?>
   <tr><td colspan="13">&nbsp;</td></tr>
   <tr><?php if(isset($status)){ ?><td colspan="6" >Status: <b style="color:<?php $colr;?>;"><?php echo $status;?></b> 
   <?php if(!empty($enroll_list[0]['remarks'])){ ?>Remarks: <?php echo $enroll_list[0]['remarks']; ?>  <?php } ?>
   </td><?php } ?><td>&nbsp;</td><td colspan="6"></td></tr>
  
   <tr class="w3-center w3-light-blue"><td colspan="13" style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:16px; font-weight:500; color:#000040"> List of students under : <?php echo $unit; ?>  </td></tr>
   <?php } ?>
   <tr style="border:0;border-top:1px solid #C0C0C0;margin:0px 0"></tr>
	<tr><td colspan="4">
   <?php if(!empty($enroll_list)){ ?>
	 <!-- table-->
	  <span style="color:#0080FF; font-weight:bold;padding-left:40%"> TOTAL NUMBER OF STUDENT <?php echo $count_stud; ?> </span>
      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive " cellspacing="0" width="100%" height="100%">
      <thead>
      <tr><?php if((($enroll_list[0]['verification_id']==0 ||$enroll_list[0]['verification_id']=='1R' ||$enroll_list[0]['verification_id']=='3R'))){ ?>
	    <th width="7%" >Remove</th>
		<th width="7%" >Edit</th>	
	    <?php }?>
		<th width="7%" >VIEW</th>
		<th width="19%">PRN No.</th>
		<th width="10%">Admission Year</th>
        <th width="12%">Name</th> 
       
        <th width="8%">Mobile No</th> 
        <th width="7%">Cast</th> 
        <th width="9%">Gender</th> 
        <th width="18%">Enrollment No:</th> 
       
		</tr>
        </thead>
        <tbody>
		<?php foreach ($enroll_list as $value ){ ?>
        <tr style="background-color:<?php if(isset($colr))echo $colr;?>">
        <?php if((($enroll_list[0]['verification_id']==0 ||$enroll_list[0]['verification_id']=='1R' ||$enroll_list[0]['verification_id']=='3R'))){ ?>
		<td>
		<input id="chk" name="chk"  width="20" height="20" value="<?php  echo $value['nss_stud_id']; ?>" type="checkbox" class="css-label" onchange="this.form.submit()"  hidden/>
		<label for="chk" class="w3-button w3-red">X</label>
		</td> 
		<td>
		<a href="<?php echo base_url(); ?>Po/NssPo/edit_stud_list/<?php  echo $value['nss_stud_id'];?>?keepThis=true&TB_iframe=true&height=500&width=600" title="EDIT STUDENT DETAIL" class="thickbox w3-button  w3-blue "> EDIT</a>
		</td>
		<?php }?>
		<td>	
		<a href="<?php echo base_url(); ?>Po/NssPo/view_stud_detail/<?php  echo $value['nss_stud_id'];?>?keepThis=true&TB_iframe=true&height=350&width=600" title="VIEW STUDENT DETAIL" class="thickbox w3-button  w3-blue "> DETAILS</a>
		</td>
		<td><?php echo $value['account_id']; ?></td>
		<td><?php echo $value['admission_year'] ;?></td>
        <td><?php echo $value['account_student_name'] ;?></td>        
        <td><?php echo $value['account_student_mobileno']; ?></td>
         <td><?php echo $value['cast']; ?></td>
          <td><?php if($value['gender']=="F") {echo "FEMALE" ;}elseif($value['gender']=='M'){ echo "MALE";}
						  else {echo"OTHER" ;}?></td>
           <td width="3%"><?php echo $value['nss_enroll_id']; ?></td>
        <?php ?>
        </tr>                   
         <?php }?>
         </tbody>
         </table>
        </td></tr>
        <tr><td class="w3-center"  colspan="13">
		<?php if( (in_array("0", $check_veri)||in_array("1R", $check_veri) || in_array("3R", $check_veri)) ){ ?>
        <input type="submit" class="btn btn-primary" value="Forward to Principal" name="fwdprinci" id="fwdprinci" style="background-color:#0070DF; color:#FFF"/>
		<?php }?> 
        </td></tr>
        <?php }elseif(isset($unit)&&(empty($enroll_list))){?>
        <div class="w3-center"> No Enrolled Student Found</div>
        <?php } ?>
</table>
</form>
</div>
