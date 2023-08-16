<link href="<?php echo base_url();?>tab/css/bootstrap.min.css" rel="stylesheet">   
<link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet">

<form id="frm" name="frm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td>&nbsp;</td></tr>
<tr><td class="w3-center"><?php  if(empty($exist)){?>
<input type="submit" class="btn " style="color:#FFF; background-color:#002D2D; " name="gen" id="gen" value="Generate Eligibile Report For All Colleges <?php echo $batch_period; ?>"/>
<?php }?></td></tr>
</table>
<hr />
<?php if($exist){?>
  <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>College Type</th>
                          <th>College name</th>
                          <th>Address</th>
                          <th>Contact Number </th>
                          <th>Email</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php foreach ($college_list as $value ){ ?>
                        <tr   class="wordbreak">
						
                          <td><?php echo $value['college_type'] ?></td>
                          <td><?php echo $value['college_name'] ?></td>
                          <td><?php echo ($value['college_address'].','.$value['college_pincode']) ?></td>
                          <td><?php echo $value['college_contact_no']+','+$value['college_contact_no2'] ?></td>
                          <td><?php echo $value['college_email'] ?></td>
                        </tr>                   
                       <?php }?>
                      </tbody>
                    </table>
<?php } ?>
</form>

 <!-- jQuery need -->
    <script src="<?php echo base_url();?>tab/js/jquery.min.js"></script>
    <!-- Bootstrap need -->
    <script src="<?php echo base_url();?>tab/js/bootstrap.min.js"></script>   
    <!-- Datatables -need-->
    <script src="<?php echo base_url();?>tab/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>tab/js/dataTables.bootstrap.min.js"></script><!--pagination- pointer not that mauch important-->
   