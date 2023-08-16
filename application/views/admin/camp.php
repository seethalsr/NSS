<?php //echo $user_type; ?>
<link href="<?php echo base_url();?>tab/css/bootstrap.min.css" rel="stylesheet">   
<link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet"> 
<form id="frm" name="frm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr>
<td height="31"><span class="w3-center" ><?php if(isset($msg)){?>
<h6  style="color:#FF8040; "><?php echo $msg; ?></h6><?php }?></span></td></tr>

<tr>
<td class="w3-center"><span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">NSS CAMP</span></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table cellpadding="0" cellspacing="0" width="100%" >
<tr>
<td width="15%" height="74"><label class=" control-label" >Select College Type</label></td>
<td width="2%"></td>
<td width="18%">
<select id="type" name="type" class="form-control" <?php if(isset($college_type)|| isset($msg)){ ?> onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($nss_college_type as $value1): ?>
<option value="<?php echo $value1['nss_college_type'] ?>" 
<?php if(set_value("type")==$value1['nss_college_type']) echo "selected";?>> <?php if($value1['nss_college_type']=="SF") echo"SELF FINANCING"; elseif($value1['nss_college_type'] =="REG")echo"REGULAR"; ?></option>
<?php endforeach; ?>
</select>
</td>
<td width="3%"></td>
<td width="14%"><label class=" control-label" >Select College Name</label></td>
<td width="48%">
<select id="name" name="name" class="form-control" <?php if(isset($college_name)|| isset($msg)){ ?>onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($college_name_sel as $value): ?>
<option value="<?php echo $value['college_id'] ?>" 
<?php if(set_value("name")==$value['college_id']) echo "selected";?>> <?php echo $value['college_name'] ?></option>
<?php endforeach; ?>
</select>
</td>
</tr>
<tr><td colspan="7">&nbsp; </td></tr>
<tr>
<?php if(isset($batch_list)&& !empty($batch_list)){?>
<td width="15%" height="74"><label class=" control-label" >Select Batch </label></td>
<td width="2%"></td>
<td width="18%">
<select id="batch" name="batch" class="form-control" <?php if(isset($college_type)|| isset($msg)){ ?> onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($batch_list as $valueb): ?>
<option value="<?php echo $valueb['batch_period'] ?>" 
<?php if(isset($sel_batch) && $sel_batch==$valueb['batch_period']) echo "selected";?>> <?php echo $valueb['batch_period'] ?></option>
<?php endforeach; ?>
</select>
<?php } ?>
</td>
<td width="3%"></td>
<?php if(isset($unit_list)){?>
<td width="14%"><label class=" control-label" >Select Unit</label></td>
<td width="48%">
<select id="unit" name="unit" class="form-control" <?php if(isset($unit_list)){ ?> onchange="this.form.submit()"<?php } ?>>
  <option value="">---Select---</option>
  <?php foreach ($unit_list as $value1): ?>
  <option value="<?php echo $value1['nss_unit_id']; ?>" 
			  <?php if(set_value("unit")==$value1['nss_unit_id']) echo "selected";?>> <?php echo $value1['nss_unit_id'];?></option>
  <?php endforeach; ?>
</select>
</td>
<?php } ?>
</tr>
<tr>
<?php if(isset($sel_unit)){ ?>
<td width="11%"><label  class="w3-text-black" >Camp Type :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="3%"></td>
<td width="15%">
<select id="get_camp" name="get_camp" class="form-control"   >
<option value="">--Select Camp Type--</option>    
<option value="spl" <?php if(set_value("get_camp")== "spl") echo "selected";?>  >Special Camp</option> 
<option value="mini1" <?php if(set_value("get_camp")== "mini1") echo "selected";?>  >Mini Camp 1</option> 
<option value="mini2" <?php if(set_value("get_camp")== "mini2") echo "selected";?>  >Mini Camp 2</option> 
</select>
</td><td width="4%"></td><td width="37%"><input type="submit" id="get_val" name="get_val" value="SUBMIT" class="w3-button  w3-blue"  /></td>
<?php } ?>
<td width="3%"></td></tr>
</table>
</td></tr>
</table>
<?php if(isset($camp_detail)&& !empty($camp_detail)){	 ?>
<div class="w3-card w3-center" style="margin-top:15px; margin-bottom:20px;font-size:18px; color:#000080; font-weight:bold;">
<?php if($camp_detail[0]['verification_id']=="3"){?>
STATUS : FORWARD TO SO
<?php }elseif($camp_detail[0]['verification_id']=="3R"){ ?>
STATUS : REJECTED BY SO
<?php }elseif($camp_detail[0]['verification_id']=="4"){ ?>
STATUS : ACCEPTED BY SO
<?php } elseif($camp_detail[0]['verification_id']=="2R"){ ?>
STATUS : REJECTED BY ASSISTANT, FORWARDED TO SO ---- REMARKS:<?php echo $camp_detail[0]['remarks'] ; } }?>
</div>

	 <!-- table-->
  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" cellpadding="0" width="100%" height="100%">
                      <thead>
                        <tr>
						 <th>Sl.No</th>
                          <th>From Date</th>
                          <th>To Date</th>
                          <th>Camp Type</th>
                          <th>Camp Site</th>
                          <th>Activity Describition</th>
                          <th>Activity Hour</th>
                          <th>Image</th>
                          <th>Participants</th>                     
					 </tr>
                      </thead>
                      <tbody>
					  <?php if(!empty($camp_detail)){?>
					  <?php $i=0; foreach ($camp_detail as $value ){$i++; ?>
                        <tr   class="wordbreak">
                          <td><?php echo $i; ?></td>
                          <td><?php echo date("d-m-Y", strtotime($value['fromdate']));?></td>
                          <td><?php echo date("d-m-Y", strtotime($value['todate']));?></td>
                          <td><?php if($value['nss_camp_type']=='spl')
						   {echo "Special Camp";}
						   elseif($value['nss_camp_type']=='mini1') 
						   {echo "Mini Camp 1";} 
						   elseif($value['nss_camp_type']=='mini2') 
						   {echo "Mini Camp 2";} ?></td>
                          <td><?php echo $value['nss_camp_desti']; ?></td>
                          <td><?php echo $value['nss_act'];?></td>
                          <td><?php echo $value['hour_camp']; ?></td>
                          <td><a href="<?php echo base_url();?>Po/NssPo/camp_image/<?php echo $value['nss_camp_id'];?>" target="_blank">image</a></td>
                          <td><a href="<?php echo base_url();?>Po/NssPo/camp_parti/<?php echo $value['nss_camp_id'];?>" target="_blank">View Participants</a>
						</td>
                        </tr>                      
                       <?php }?>
					   <?php }?>
                      </tbody>
                    </table>

  <?php if(isset($camp_detail[0]['verification_id'])&& $camp_detail[0]['verification_id']== "2" ) { ?>
 <input type="submit" value="FORWARD TO SO" id="fwdtoassi" name="fwdtoassi"  class="w3-button  w3-green "/>  
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
<?php  }?>
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