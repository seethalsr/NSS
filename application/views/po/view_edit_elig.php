 <link href="<?php echo base_url();?>tab/css/bootstrap.min.css" rel="stylesheet">   
<link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet">

<script src="<?php echo base_url();?>tab/js/jquery.min.js"></script>

<script language="javascript" src="<?php echo base_url(); ?>js/thickbox.js" type="text/javascript"></script>
<link href='<?php echo base_url(); ?>css/thickbox.css' rel='stylesheet' type='text/css'/>
<link href='<?php //echo base_url(); ?>css/w3.css' rel='stylesheet' type='text/css'/>
<div class="w3-center " style="padding-bottom:0px; color:#9F0">
<span ><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span><br>
</div>
<div class="w3-card" >
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">NSS ENROLLED LIST</b></h4>
<form name="frm1" id="frm1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
<table cellpadding="0" cellspacing="0" width="100%" >
<tr><td colspan="4">&nbsp;</td></tr>
  
    <tr><td colspan="4"></td></tr>
    <tr style="border:0;border-top:1px solid #C0C0C0;margin:0px 0"></tr>
	<?php if(isset($unit)){ ?>
   <tr><td colspan="13">&nbsp;</td></tr>
    
  
   <tr class="w3-center w3-light-blue"><td colspan="13" style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:16px; font-weight:500; color:#000040"> List of students under : <?php echo $unit; ?>  </td></tr>
   <?php } ?>
   <tr style="border:0;border-top:1px solid #C0C0C0;margin:0px 0"></tr>
	<tr><td colspan="4">
   <?php if(!empty($enroll_list)){ ?>
	 <!-- table-->
	  <span style="color:#0080FF; font-weight:bold;padding-left:40%"> TOTAL NUMBER OF STUDENT <?php echo $count_stud; ?> </span>
      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive " cellspacing="0" width="100%" height="100%" border="1">
      <thead>
      <tr>
	    <?php if($enroll_list[0]['elig_chk']<>'Y'||($college_id=='164')){?>
		<th width="7%" >Edit</th>	
	   <?php }?>
		<th width="7%" >VIEW</th>
		<th width="19%">PRN No.</th>
		<th width="10%">Admission Year</th>
        <th width="12%">Name</th>
       <th width="8%">Name of the Programme with Specialisation/Major Subject</th> 
        <th width="7%">Enroll Start Date</th> 
        <th width="9%">Enroll End Date</th> 
        <th width="18%">Mini 1</th> 
        <th width="18%">Mini 2</th> 
          <th width="18%">Special Camp</th> 
          <th width="18%">Total Hours</th>
       
		</tr>
        </thead>
        <tbody>
		<?php foreach ($enroll_list as $value ){ ?>
        <tr style="background-color:<?php if(isset($colr))echo $colr;?>">
       
		 <?php if($enroll_list[0]['elig_chk']<>'Y'||($college_id=='164')){?>  
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
        <td><?php echo $value['specialisation_id']; ?></td>
         <td><?php echo $value['enrolled_date']; ?></td>
           <td><?php echo $value['enroll_end']; ?></td>
           <td width="3%"> <?php echo $value['mini1']; ?></td>
      <td width="3%"><?php echo $value['mini2']; ?> </td>
                            <td width="3%"> <?php echo $value['splcamp']; ?></td>
                            <td><?php echo $value['tot_hr']; ?></td>
        <?php ?>
        </tr>                   
         <?php }?>
         </tbody>
         </table>
        </td></tr>
        <tr><td class="w3-center"  colspan="13">
		
        </td></tr>
        <?php }?>
</table>
</form>
</div>
