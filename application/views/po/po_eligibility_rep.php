 <span class="w3-center"><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span>
 
 <!-- Bootstrap -->
    <link href="<?php echo base_url();?>tab/css/bootstrap.min.css" rel="stylesheet">   
    <!-- Datatables sort -->
    <link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet">



              <div class="col-md-12 col-sm-12 col-xs-12 " >
                <div>
                  <div class="x_content">
                   <h4 class="w3-center"><fntn>LIST OF STUDENT ELIGIBLE FOR CERTIFICATE 2019</fntn></h4>
<hr />
 <a href="<?php echo base_url();?>Po/NssPo/elig_print" target="_blank"><b>PRINT</b></a> 
<?php if(isset($eli_det)&&!empty($eli_det)){ ?>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>Sl.No:</th>
                          <th>Enroll No:</th>
                           <th>PRN:</th>
                          <th>Student name</th>
                          <th>Course</th>
                          <th>Special Camp</th>
                          <th>Mini Camp 1</th>
                          <th>Mini Camp 2</th>
                          <th>Total Hour</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $i = 0; foreach($eli_det as $value){ $i++; ?>
                      <?php if($value['elig']=='Y')
                      $style = "#92C9C9";
					  else 
                      $style = "#FBB" ;
					   ?>
					  <tr style="background-color:<?php echo $style; ?>"
                      ><td><?php echo $i;?></td>
                      <td><?php echo $value['nss_enroll_id'];?></td>
                      <td><?php echo $value['account_id'];?></td>
                      <td><?php echo $value['account_student_name'];?></td>
                      <td><?php echo $value['specialisation_id'];?></td>
                      <td><?php if($value['splcamp']=='YES')echo 'YES'; else echo'NO' ; ?></td>
                      <td><?php if($value['mini1']=='YES')echo 'YES'; else echo'NO' ; ?></td>
                      <td><?php if($value['mini2']=='YES')echo 'YES'; else echo'NO' ;  ?></td>
                      <td><?php echo $value['tot_hr'];?></td>
                      <td><?php if($value['elig']=='Y')echo 'ELIGIBILE'; else echo'INELIGIBILE' ;?></td>
                      </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                    
        
                </div></div></div>
                <br />
                <form name="frm1" id="frm1" method="post"   action="<?php echo base_url(); ?>Po/NssPo/view_elig" >
              <?php if($eli_det[0]['elig_chk']!='Y'){ ?> <p style="padding-left:50px;"> <input type="checkbox" id="ch" name="ch" /> I,hearby declare that i have verified the details i have entered.
               <br />
                <input type="submit" value="VERIFY" id="ver" name="ver"  class="w3-blue"/>
               </p>
               <?php }else{?>
               <label class="w3-green">VERIFIED</label>
               <?php } ?>
              <?php } ?>
                </form>
                <br /><br />
                <div style="color:#F00;"> NOTE: If any of the volunteer is not eligible check these Eligiblity Criteria  <br />
                1. Enroll start and Enroll end should be for 2 Years<br />
                2. Should attend any one of the camp<br />
                3. total hours , atleast 240 hrs </div>
        <!-- /page content -->

    <!-- jQuery need -->
    <script src="<?php echo base_url();?>tab/js/jquery.min.js"></script>
    <!-- Bootstrap need -->
    <script src="<?php echo base_url();?>tab/js/bootstrap.min.js"></script>   
    <!-- Datatables -need-->
    <script src="<?php echo base_url();?>tab/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>tab/js/dataTables.bootstrap.min.js"></script><!--pagination- pointer not that mauch important-->
    <!-- Custom Theme Scripts need -->
    <script src="<?php echo base_url();?>tab/js/custom.min.js"></script>
   

