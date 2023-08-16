<head>
<link href="<?php echo base_url();?>tab/css/bootstrap.min.css" rel="stylesheet">   
<link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>css/w3.css">
</head>
<form name="frm1" id="frm1" method="post"   action="<?php echo base_url(); ?>Nsscontrol/blood_bank" >
<table align="center" width="100%" >
<tr  style="vertical-align:top;">
<td></td>
<td width="100%" height="362"  class="w3-row-padding">
<div class="  w3-card-2 w3-white w3-round  " style="padding-bottom:10px; height:450px"><br>
<img src="<?php echo base_url();?>images/blood.svg" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:40px; padding-left:5px">
<p style="font-family:Verdana, Geneva, sans-serif; font-size:18px; margin:0">Search Blood Donors</p>
<div style="padding-bottom:15px"></div>
<hr />   
<table width="100%">
<tr>
<td width="23%"></td>
<td width="20%"><label class=" control-label" for="blood" style="padding-left:15px;">Select Blood Group<a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="2%"></td>
<td width="10%">
 <select id="blood" name="blood" class="form-control" onChange="this.form.submit()"  >
              <option value="">--Select--</option>             
			  <option value="O+" <?php if(set_value("blood")== 'O+') echo "selected";?>> O+</option> 
           	  <option value="O-" <?php if(set_value("blood")== 'O-') echo "selected";?>> O-</option>
			  <option value="A+" <?php if(set_value("blood")== 'A+') echo "selected";?>> A+</option>
			  <option value="A-" <?php if(set_value("blood")== 'A-') echo "selected";?>> A-</option>
			  <option value="B+" <?php if(set_value("blood")== 'B+') echo "selected";?>> B+</option>
			  <option value="B-" <?php if(set_value("blood")== 'B-') echo "selected";?>> B-</option>
			  <option value="AB+" <?php if(set_value("blood")== 'AB+') echo "selected";?>> AB+</option>
			  <option value="AB-" <?php if(set_value("blood")== 'AB-') echo "selected";?>> AB-</option>
   </select>
</td>
<td width="45%"></td></tr>
</table>
<?php if(isset($blood_list)){ ?>

     <table id="datatable" class="table table-striped table-bordered" width="100%">
                      <thead>
                        <tr>
						  <th>Program Officer</th>
                          <th>Contact No:</th>
                          <th>No: of Students</th>
                         
                          <th>Blood Group</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php  if(($blood_list)){ ?>
					  <?php foreach ($blood_list as $value ){ ?>
                        <tr   class="wordbreak">
						 <td><?php echo $value['po_name'] ?></td>
                          <td><?php echo $value['po_contact'] ?></td>
                          <td><?php echo $value['cc'] ?></td>
                         
                          <td><?php echo $value['blood_group'] ?></td>
                          </tr>                   
                       <?php }}?>
                      </tbody>
                    </table>
                   
<?php }?>
</div>
</td>
</tr>
</table>
</form>
<script src="<?php echo base_url();?>tab/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>tab/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>tab/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>tab/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>tab/js/custom.min.js"></script>



