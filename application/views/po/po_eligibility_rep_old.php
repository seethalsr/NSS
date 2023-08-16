 <span class="w3-center"><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span>
 <?php  if(!empty($eli_det)){ //print_r($eli_det);exit;?>
 <!-- Bootstrap -->
    <link href="<?php echo base_url();?>tab/css/bootstrap.min.css" rel="stylesheet">   
    <!-- Datatables sort -->
    <link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet">

<form name="frm1" id="frm1" method="post"   action="<?php echo base_url(); ?>Po/NssPo/eligibility_rep" >

              <div class="col-md-12 col-sm-12 col-xs-12 " >
                <div>
                  <div class="x_content">
                   <h4 class="w3-center"><fntn>LIST OF STUDENT ELIGIBLE/INELIGIBLE FOR CERTIFICATE </fntn></h4>
<hr />
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>Sl.No:</th>
                          <th>Enroll No:</th>
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
                      <?php if($value['eligibile']=='Y')
                      $style = "#92C9C9";
					  else 
                      $style = "#FBB" ;
					   ?>
					  <tr style="background-color:<?php echo $style; ?>"
                      ><td><?php echo $i;?></td>
                      <td><?php echo $value['nss_enrol'];?></td>
                      <td><?php echo $value['stud_name'];?></td>
                      <td><?php echo $value['specialisation_display_name'];?></td>
                      <td><?php if($value['spl_camp']=='Y')echo 'YES'; else echo'NO' ; ?></td>
                      <td><?php if($value['mini_cmp1']=='Y')echo 'YES'; else echo'NO' ; ?></td>
                      <td><?php if($value['mini_cmp2']=='Y')echo 'YES'; else echo'NO' ;  ?></td>
                      <td><?php echo $value['total_hr'];?></td>
                      <td><?php if($value['eligibile']=='Y')echo 'ELIGIBILE'; else echo'INELIGIBILE' ;?></td>
                      </tr>
                      <?php } ?>
                      </tbody>
                    </table>
         <?php if(isset($eli_det )&& !empty($eli_det )&& $eli_det[0]['verification_id']=="0") {?>
         <input type="submit" id="fwd_prin" name="fwd_prin" value="FORWARD TO PRINCIPAL" class="w3-button  w3-green " />
         <?php } ?>
                </div></div></div>
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
   
<?php } else{  ?>
<div  class="w3-card w3-center"  style="padding-top:18%;padding-bottom:20%"><span style=" color:#800000; font-size:24px; padding-left:55px;">
"ELIGIBILITY REPORT WILL BE READY, WHEN ENROLLMENT , CAMP DETAILS, MONTHLY ATTENDNACE IS ACCEPTED BY UNIVERSITY"</span>
</div>
<?php } ?>
 </form>