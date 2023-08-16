<?php //print_r($princi_list);exit; ?>

<form id="frm" name="frm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr>
<td height="31"><span class="w3-center" ><?php if(isset($msg)){?>
<h6  style="color:#FF8040; "><?php echo $msg; ?></h6><?php }?></span></td></tr>
<tr>
<td class="w3-center"><span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">COLLEGE PRINCPAL HISTORY</span></td></tr>
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
<?php if(set_value("type")==$value1['nss_college_type']) echo "selected";?>> <?php if($value1['nss_college_type']=="REG") echo "REGULAR"; elseif($value1['nss_college_type']=="SF") echo"SELF FINANCE";  ?></option>
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
</table>
</td></tr>
</table>
</div>
	 <!-- table-->
  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive " cellspacing="0" cellpadding="0" width="100%" height="100%">
                      <thead>
                        <tr>
						 <th width="4%">Sl.No</th>
                          <th width="14%">Principal Name</th>
                          <th width="13%">Principal Email</th>
                          <th width="9%">Principal Contact</th>
                          <th width="26%">Principal Address</th>
                          <th width="8%">Principal Gender</th>
                          <th width="18%">From Date</th>
                          <th width="8%">To Date</th>
					 </tr>
                      </thead>
                      <tbody>
					  <?php if(!empty($princi_list)){?>
					  <?php $i=0; foreach ($princi_list as $value ){$i++; ?>
                        <tr   class="wordbreak">
                          <td><?php echo $i; ?></td>
                          <td><?php echo $value['principal_name'];?></td>
                          <td><?php echo $value['principal_email'];?></td>
                          <td><?php echo $value['principal_contact'];?></td>
                          <td><?php echo $value['principal_address']; echo ","; echo $value['principal_pincode']; ?></td>
                          <td><?php if( $value['principal_gender']=="M") echo "MALE"; elseif($value['principal_gender']=="F") echo "FEMALE";?></td>
                          <td><?php echo date("d-m-Y", strtotime($value['from_date']));?></td>
                          <td><?php if($value['to_date']!='0000-00-00') echo date("d-m-Y", strtotime($value['to_date'])); else echo""; ?></td>
                        </tr>                      
                       <?php }?>
					   <?php }?>
                      </tbody>
                    </table>
</form>
