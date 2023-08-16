 <span class="w3-center"><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="form1" id="form1"  >
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td width="4%"></td>
<td width="22%"> <label class=" control-label" for="unit">BATCH :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="12%"><select id="batch" name="batch" class="form-control" onchange="this.form.submit()" >
  <option value="">--Select--</option>
  <?php foreach($batch_period as $value){?>
  <option value="<?php echo $value['batch_period']; ?>" <?php if(isset($sel_batch)&& $sel_batch== $value['batch_period']) echo "selected";?>> <?php echo $value['batch_period']; ?></option>
  <?php }?>
</select></td>
<td width="4%"></td>
<td width="22%"> <label class=" control-label" for="unit">UNIT :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="12%"><select id="unit" name="unit" class="form-control" onchange="this.form.submit()" >
  <option value="">--Select--</option>
  <?php foreach($unit_det as $value){?>
  <option value="<?php echo $value['nss_unit_id']; ?>" <?php if(isset($sel_unit)&& $sel_unit== $value['nss_unit_id']) echo "selected";?>> <?php echo $value['nss_unit_id']; ?></option>
  <?php }?>
</select></td>
<td width="10%" >&nbsp;</td>
<td colspan="7"></td>
</tr>
</table>
<div class="col-md-12 col-sm-12 col-xs-12 " ><div><div class="x_content">
   <h4 class="w3-center"><fntn>LIST OF ELIGIBLE REPORT </fntn></h4>
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
                       <?php if(isset($eli_det)&& (!empty($eli_det))){?>
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
                      <?php } ?>
                    </table>
 </div></div></div>
 
 <?php if(isset($eli_det) && !empty($eli_det)&& $eli_det[0]['verification_id']=="1"){ ?>
<input type="submit" id="fwd_uni" name="fwd_uni" value="FORWARD TO UNIVERSITY" class="w3-button  w3-green "  />
<button type="button" class="btn " data-toggle="modal" data-target="#Rejected" style="background-color:#FF0000 ; color:#FFFFFF" >REJECTED</button>
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
 </form>