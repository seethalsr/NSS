
<link href="<?php echo base_url();?>tab/css/bootstrap.min.css" rel="stylesheet">   
<link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="form1" id="form1"  >
<table cellpadding="0" cellspacing="1" width="100%">

<tr><td colspan="5"></td></tr>
<tr><td colspan="5"></td>
<div class="w3-center" style="padding-bottom:0px; color:#9F0">
    <span ><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span><br>
    <span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">CERTIFICATES</span>
    <hr>
	</div>
</tr>

<tr><td colspan="9">&nbsp;</td></tr>
<tr><td colspan="9">
<?php  if(isset($eli_dat)){ ?>
<div class="col-md-12 col-sm-12 col-xs-12 " >
                <div>
                  <div class="x_content">
                   <h4 class="w3-center"><fntn>LIST OF NSS VOLUNTEER FOR CERTIFICATE </fntn></h4>
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
<?php  } ?>
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