<?php //print_r($get_2yr);exit;?>

<link href="<?php echo base_url();?>tab/css/bootstrap.min.css" rel="stylesheet">   
<link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet"> 
<form id="frm" name="frm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr>
<td height="31"><span class="w3-center" ><?php if(isset($msg)){?>
<h6  style="color:#FF8040; "><?php echo $msg; ?></h6><?php }?></span></td></tr>
<tr>
<td class="w3-center"><span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">NSS Enrolled List</span></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table cellpadding="0" cellspacing="0" width="100%" height="100%">
<tr>
<td width="15%" height="74"><label class=" control-label" >Select College Type</label></td>
<td width="2%"></td>
<td width="18%">
<select id="type" name="type" class="form-control" <?php if(isset($college_type)|| isset($msg)){ ?> onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($college_type as $value1): ?>
<option value="<?php echo $value1['college_type'] ?>" 
<?php if(set_value("type")==$value1['college_type']) echo "selected";?>> <?php echo $value1['college_type'] ?></option>
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
<?php if(!empty	($get_2yr)) {?>
<table cellpadding="0" cellspacing="0" width="100%" height="100%">
<tr>
<td class="w3-center" colspan="4">
<?php if($get_2yr){?><a href="<?php echo base_url();?>uploaded_pdf/<?php echo  $college_id_sel ;?>/fund_2yr.pdf" class="two " target="_blank"><span style="color:#004080; text-decoration:underline;"  > CLICK HERE TO VIEW PREVIOUS YEAR FUND REPORT </span></a></td>
<?php }?>
</tr>
<tr><td colspan="4">&nbsp;</td></tr>
<?php if($get_2yr[0]['verification_id'] == 2){?>
<tr>
<td width="20%">
<label class="radio-inline" for="radios-0">
       <input type="radio"  name="radios" id="radios-0" value="A" checked="checked" >
       Accepted
       </label> 
      <label class="radio-inline" for="radios-1">
      <input type="radio"  name="radios" id="radios-1" value="R"  >
      Rejected
      </label>
</td>

<td width="52%">
<textarea class="form-control input-sm" id="txt1" name="txt1"   rows="3" >Remarks:</textarea>
</td>
<td width="9%"></td>
<td width="19%"><input type="submit" class="btn btn-primary" value="Forward to So/principal" name="submitfwd" id="submitfwd" style="background-color:#FF8000; color:#FFF"/></td>
</tr>
<?php } ?>
</table>
<?php if(isset($monthly_fund)){?>
<table cellpadding="0" cellspacing="0" height="100%" width="100%" border="1">
<thead>
<tr>
<th>month</th>
<th>Spent</th>
<th>Description</th>
<th>Attachment</th>
</tr>
</thead>
<tbody>
<?php $total = 0; foreach ($monthly_fund as $value): $total = $total + $value['fund_spent'];  ?>
<tr>
<td><?php echo $value['fund_month'];?></td>
<td><?php echo $value['fund_spent'];?></td>
<td><?php echo $value['fund_desc'];?></td>
<td><a href="<?php echo base_url();?>uploaded_pdf/<?php echo  $college_name_sel ;?>/fund_monthly_<?php echo $value['fund_month'];?>.pdf" target="_blank">View</a></td>
</tr>
<?php endforeach; ?>
<tr style="background-color:#FFB"><td></td><td><?php echo $total;?> </td><td colspan="2"></td></tr>
</tbody>
</table>
<?php } ?>
<?php } ?>
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