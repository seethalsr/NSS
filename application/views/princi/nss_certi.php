
<link href="<?php echo base_url();?>tab/css/bootstrap.min.css" rel="stylesheet">   
<link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet">
<form id="frm1" name="frm1" method="post" action="<?php echo base_url(); ?>Po/NssPo/nss_certi">
<table cellpadding="0" cellspacing="1" width="100%">
<tr><td colspan="5"></td></tr>
<tr><td colspan="5"></td>
<div class="w3-center" style="padding-bottom:0px; color:#9F0">
    <span ><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span><br>
    <span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">CERTIFICATES</span>
    <hr>
	</div>
</tr>
<tr><td colspan="5"></td></tr>

<tr><td colspan="5">&nbsp;</td></tr>
<tr><td colspan="5">
<?php if(isset($eli_dat)&& $eli_dat!='N'){ ?>
<div class="col-md-12 col-sm-12 col-xs-12 " >
                <div>
                  <div class="x_content">
                   <h4 class="w3-center"><fntn>LIST OF NSS VOLUNTEER CERTIFICATE </fntn></h4>
<hr />
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>Sl.No:</th>
                          <th>Enroll No:</th>
                          <th>Student name</th>
                          <th>Course</th>
                          <th>Certificate</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i = 0; foreach($eli_dat as $value){ $i++; ?>
					  <tr><td><?php echo $i;?></td>
                      <td><?php echo $value['nss_enroll_id'];?></td>
                      <td><?php echo $value['account_student_name'];?></td>
                      <td><?php echo $value['specialisation_id'];?></td>
                      <td><a href="<?php echo base_url(); ?>Po/NssPo/nss_certi_view/<?php echo $value['nss_stud_id'];?>" target="_blank">VIEW</a></td>
                      </tr>
                      <?php } ?>
                      </tbody>
                    </table>
         
                </div></div></div>
<?php  } else{ echo 'UNIVERSITY HAS NOT YET ISSUED THE CERTIICATE TO YOUR COLLEGE';

echo'<br>';
echo'<br>';
echo'Reason :';echo'<br>';
echo'1 ) From the college Eligiblity Report might not have been Verified. In order to Verify, login to PO click on Eligiblity report then on "View eligiblity Report"
and do the verification also click on "verify" button';
echo '<br>';
echo '2) University  Verifying the Certificate  , wait for 2 days. Still not issued contact the university or mail at donotreply.kannuuniversity.nss@gmail.com';
} ?>
</td></tr>
</table>

</form>

 <!-- jQuery need -->
    <script src="<?php echo base_url();?>tab/js/jquery.min.js"></script>
    <!-- Bootstrap need -->
    <script src="<?php echo base_url();?>tab/js/bootstrap.min.js"></script>   
    <!-- Datatables -need-->
    <script src="<?php echo base_url();?>tab/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>tab/js/dataTables.bootstrap.min.js"></script><!--pagination- pointer not that mauch important-->
    <!-- Custom Theme Scripts need -->
    <script src="<?php echo base_url();?>tab/js/custom.min.js"></script>