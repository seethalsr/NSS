<?php //print_r( $enroll_list); ?>
<link href="<?php echo base_url();?>tab/css/bootstrap.min.css" rel="stylesheet">   
<link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet"> 
<form id="frm" name="frm" method="post" action="<?php echo base_url(); ?>Admin/NssSo/nss_certi_pgm_view">
<table cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr>
<td height="31"><span class="w3-center" ><?php if(isset($msg)){?>
<h6  style="color:#FF8040; "><?php echo $msg; ?></h6><?php }?></span></td></tr>
<tr>
<td class="w3-center"><span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">NSS Enrolled List</span></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table cellpadding="0" cellspacing="0" width="100%" >

<tr><td colspan="7">&nbsp; </td></tr>


</table>
</td></tr>
</table>

	 <!-- table-->
  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive " cellspacing="0" cellpadding="0" width="100%" height="100%">
                      <thead>
                        <tr>
						  <th width="14%">Sl.No</th>
                          <th width="15%">College Name</th> 
                          <th width="40%">Unit</th> 
                          <th width="40%">Verified Status</th>
                          <th width="10%">View Certificate</th>  
                          <th width="10%">Forward to Principal</th> 
                                            
					 </tr>
                      </thead>
                      <tbody>
					  <?php if(!empty($enroll_list)){?>
					  <?php $i=0; foreach ($enroll_list as $value ){$i++; ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $value['college_name']; ?></td>
                          <td><?php echo $value['nss_enroll_unit']; ?></td>
                          <td><?php if($value['elig_chk']=='Y'){?><span style="background-color:#008080; color:#FFF;">VERIFIED</span><?php }else{ ?><span
                          style="background-color:#F00; color:#FFF;">NOT VERIFIED</span><?php } ?></td>
                          <td>
                          <?php if($value['elig_chk']=='Y'){?>
                          <a href="<?php echo base_url();?>Admin/NssSo/nss_certi_pgm_view/<?php echo $value['nss_unit_id'];?>" target="_blank">VIEW CERTIFICATE</a>
                          <?PHP } ?>
                          </td>
                         <td>
                         <?php if($value['elig_chk']=='Y'){?>
                         
                        <?php if($value['fwd_coll']!='Y'){?> 
                        
                        <a href="<?php echo base_url();?>Admin/NssSo/nss_certi_pgm_view/<?php echo $value['nss_unit_id'];?>/iss">ISSUE CERTIFICATE</a>
						<?php } else{ echo'ISSUED';}} ?></td>
                          
                        </tr>                   
                       <?php }?>
					   <?php }?>
                      </tbody>
                    </table>


</form>
 <!-- jQuery need -->
    <script src="<?php echo base_url();?>tab/js/jquery.min.js"></script>
    <!-- Bootstrap need -->
    <script src="<?php echo base_url();?>tab/js/bootstrap.min.js"></script>   
    <!-- Datatables -need-->
    <script src="<?php echo base_url();?>tab/js/jquery.dataTables.min.js"></script>
    <!--pagination- pointer not that mauch important-->   
    <!-- Custom Theme Scripts need -->
   