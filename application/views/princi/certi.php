
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
<tr><td width="0%"></td>
<td width="18%"> <label class=" control-label" for="unit">BATCH :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="26%"><select id="batch" name="batch" class="form-control" onchange="this.form.submit()" >
  <option value="">--Select--</option>
  <?php foreach($batch_period as $value){?>
  <option value="<?php echo $value['batch_period']; ?>" <?php if(isset($sel_batch)&& $sel_batch== $value['batch_period']) echo "selected";?>> <?php echo $value['batch_period']; ?></option>
  <?php }?>
</select></td>
<td width="9%"></td>
<td width="10%"> <label class=" control-label" for="unit">UNIT :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="26%"><select id="unit" name="unit" class="form-control" onchange="this.form.submit()" >
  <option value="">--Select--</option>
  <?php foreach($unit_det as $value){?>
  <option value="<?php echo $value['nss_unit_id']; ?>" <?php if(isset($sel_unit)&& $sel_unit== $value['nss_unit_id']) echo "selected";?>> <?php echo $value['nss_unit_id']; ?></option>
  <?php }?>
</select></td>
<td width="11%" >&nbsp;</td>
<td width="0%" colspan="7"></td>
</tr>
<?php if(isset($sel_unit)){?>
<tr><td colspan="5"></td></tr>
<tr><td width="0%"></td><td width="18%"><label class=" control-label" >Certificate Category:</label></td><td width="26%">
 	<select id="certi_type" name="certi_type" class="form-control"  onchange="this.form.submit()">
    <option value="">--------------------Select--------------------</option>
    <option value="V" <?php if(isset($certi_type)){ if($certi_type=="V") echo "selected";}?> >NSS Volunteer Certificate</option>
    <?php /*?><option value="VS" <?php if(isset($certi_type)){if($certi_type=="VS") echo "selected";}?>>NSS Volunteer Secretary Certificate</option>
    <option value="POC"<?php if(isset($certi_type)){if($certi_type=="POC") echo "selected";}?> >NSS Program Officer Certificate</option>
    <?php */?>
	</select>
</td><td width="9%" colspan="4"></td></tr>
<?php } ?>
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
                      <td><?php echo $value['nss_enrol'];?></td>
                      <td><?php echo $value['stud_name'];?></td>
                      <td><?php echo $value['specialisation_display_name'];?></td>
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