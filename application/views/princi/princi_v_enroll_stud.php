<?php //if(!empty($enroll_list[0]['nss_enroll_id'])){ echo "df"; print_r($enroll_list[0]['nss_enroll_id']);exit; }else{ echo "dfg";exit;}?>
<?php 
// for the color scheme (blue)2= fwd to princi green)3,4,6 = fwd to uni (red)5= rej by uni  (red)7 = rej princi
		if(isset($enroll_list)){
		if(in_array('2',$check_veri))
		{
		$colr = '#7BABD5  ';
		$status = 'FORWARDED TO PRINCIPAL';
		}
		elseif(in_array('3',$check_veri)||in_array('4',$check_veri)||in_array('6',$check_veri))
		{
		$colr = '#7BD587';
		$status = 'FORWARDED TO UNIVERSITY';
		
		}
		elseif(in_array('7',$check_veri))
		{
		$colr = '#F79E95';
		$status = 'REJECTED BY PRINCIPAL';
		}
		elseif(in_array('5',$check_veri))
		{
		$colr = '#F79E95';
		$status = 'REJECTED BY UNIVERSITY';
		}
		}

?>
<link href="<?php echo base_url();?>tab/css/bootstrap.min.css" rel="stylesheet">   
    <link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet"> 
     <form name="frm1" id="frm1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  >
<table cellpadding="0" cellspacing="0" width="100%" height="400px">
	<tr><td colspan="5">
	<div class="w3-center" style="padding-bottom:0px">
    		<span ><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span><br>
        	<span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">NSS Enrolled List</span>
            <hr>
	</div></td></tr>
    <tr ><td colspan="4" >
    <?php if(isset($data_enroll_gen)){?>
    <div class="w3-right">
    <button type="button" class="btn w3-right" data-toggle="modal" data-target="#ViewEnroll" style="background-color:#004080; color:#FFFFFF" >Click Here to View Enrollment List</button>
<div class="modal fade" id="ViewEnroll" tabindex="-1" role="dialog" aria-labelledby="ViewEnrollLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title w3-center" id="exampleModalLabel">VIEW CAMP DETAILS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                   <h4 class="w3-center"><fntn> </fntn></h4>
      </div>
      <div class="modal-footer" >
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="submitp" id="submitp" value="Submit" style="background-color:#0080C0; color:#FFF;" />
      </div>
    </div>
  </div>
</div>
</div>
<?php }?>
</td></tr>
    <tr>
    
	<td width="3%"></td>
    
    <td width="16%" height="61"><label class=" control-label" >Select Unit</label></td>
    <td width="33%" ><select id="unit" name="unit" class="form-control" <?php if(isset($unit_list)){ ?> onchange="this.form.submit()"<?php } ?>>
  <option value="">---Select---</option>
  <?php foreach ($unit_list as $value1): ?>
  <option value="<?php echo $value1['nss_unit_id'] ?>" 
			  <?php if(set_value("unit")==$value1['nss_unit_id']) echo "selected";?>> <?php echo $value1['nss_unit_id'] ?></option>
  <?php endforeach; ?>
</select></td>
<td width="13%"></td>
</tr>
    <tr><td colspan="4"></td></tr>
    <tr style="border:0;border-top:1px solid #C0C0C0;margin:0px 0"></tr>
	<?php if(isset($unit)){ ?>
<tr class="w3-center w3-light-blue"><td colspan="4" style="font-family:Georgia, 'Times New Roman', Times, serif; font-size:16px; font-weight:500; color:#000040"> List of students under unit : <?php echo $unit; ?>  </td>
<td width="2%"></td>
</tr>
<?php } ?>
<tr><td colspan="4">&nbsp;</td></tr>
<tr style="border:0;border-top:1px solid #C0C0C0;margin:0px 0"></tr>

	<tr><td colspan="5">
<?php if(isset($enroll_list)){ ?>
	 <!-- table-->
  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" cellpadding="0" width="100%" height="100%">
                      <thead>
                        <tr>
						  <th width="14%">Admission Year</th>
                          <th width="15%">Current Semester</th> 
                          <th width="40%">Name</th> 
                          <th width="10%">Email ID</th> 
                          <th width="10%">Mobile No:</th> 
                          <th width="10%">
						  <?php if(!empty($enroll_list[0]['nss_enroll_id'])){ ?>Enrollment ID <?php }else{ ?>
                          <input type="submit" class="btn btn-primary" value="ENROLL ALL" name="enroll" id="enroll" style="background-color:#008080; color:#FFF"/>
                          <?php } ?></th>
					 </tr>
                      </thead>
                      <tbody>
					  <?php if(!empty($enroll_list)){?>
					  <?php foreach ($enroll_list as $value ){ ?>
                      <tr>
          			      <td><?php echo $value['admission_year']; ?></td>
                          <td><?php echo $value['current_semester']; ?></td>
                          <td><?php echo $value['account_student_name']; ?></td>
                          <td><?php echo $value['account_student_email']; ?></td>
                          <td><?php echo $value['account_student_mobileno']; ?></td>
 						 <?php if(!empty($enroll_list[0]['nss_enroll_id'])){ ?>
						 <td><?php echo $value['nss_enroll_id']; ?></td>	 
							<?php  }else{ ?>
                         <td>&nbsp;</td>
						 <?php } ?> 
                    
                      
                       </tr> 
					   <?php }}?>
                      </tbody>
        </table>
<div class="w3-center">		
<?php if($enroll_list[0]['verification_id']== '2'){ ?>
<input type="submit" class="btn btn-primary" value="FORWARD TO UNIVERSITY" name="fwduni" id="fwduni" style="background-color:#0080C0; color:#FFF"/>
<button type="button" class="btn " data-toggle="modal" data-target="#Rejected" style="background-color:#0099CC; color:#FFFFFF" >REJECTED</button>
<div class="modal fade" id="Rejected" tabindex="-1" role="dialog" aria-labelledby="RejectedLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reason for Rejection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>        </button>
      </div>
      <div class="modal-body">

                    <textarea id="remarktxt1" name="remarktxt1" rows="5" cols="100" class="form-control"></textarea>
                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="rejprincisubmit" id="rejprincisubmit" value="Submit"/>
      </div>
    </div>
  </div>
</div>
<?php } ?>
</div>

 </div>

<br/>
<br/>
<br/>
<br/>
<?php } ?>	
</td></tr>
<tr><td colspan="5">&nbsp;</td></tr>
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
    