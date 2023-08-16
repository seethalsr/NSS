<link href="<?php echo base_url();?>tab/css/bootstrap.min.css" rel="stylesheet">   
<link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet">
<form name="frm1" id="frm1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data"  >
<span class="w3-center"><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span>

<div class="card" style="padding-top:2px;background-color:#FEF9E7       ">
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">VIEW MONTHLY ATTENDANCE</b></h4>
<div class="card" style="padding-top:20px;" >
<table cellpadding="0" cellspacing="0" width="100%" >
<?php if(isset($yrs)){?>
<tr><td width="1%"></td><td width="24%"><label  class="w3-text-black" >Select Year :<a style="color:#FF0000;font-size:18px;">*</a></label></td><td width="6%"></td>
<td width="17%">
<select id="yr" name="yr" class="form-control" onchange="this.form.submit()" >
<option value="">--Select--</option>  
<?php foreach( $yrs as $val){ ?>           
<option value="<?php echo $val['year']; ?>" <?php if(set_value("yr")== $val['year']) echo "selected";?>> <?php echo $val['year']; ?></option> 
<?php } ?>
</select>
</td><td width="2%"></td>
<td width="50%">
<?php if(!empty($fund_det[0]['upload_file'])){ ?>
<a href="<?php echo base_url();?>upload/po/col<?php echo $college_id; ?>/FUND/<?php echo $sel_yr; ?>.pdf" target="_blank"> Click here to view Fund Report of <?php if(isset($sel_yr)) echo $sel_yr;?></a>
<?php if($fund_det[0]['verification_id']=="0"||$fund_det[0]['verification_id']=="1R"||$fund_det[0]['verification_id']=="3R"){ ?>
<input type="submit" value="FORWARD TO PRINCIPAL" id="fwd_prin" name="fwd_prin"  class="btn" style="background:#09C; color:#FFF;" />
<?php } ?>
<?php }elseif(isset($fund_det)){?>
<a href="<?php echo base_url();?>Po/NssPo/po_fund_report_prev/<?php echo $sel_yr; ?>" target="_blank">PRINT</a>
<?php if($fund_det[0]['verification_id']=="0"||$fund_det[0]['verification_id']=="1R"||$fund_det[0]['verification_id']=="3R"){ ?>
<input type="submit" value="FORWARD TO PRINCIPAL" id="fwd_prin" name="fwd_prin"  class="btn" style="background:#09C; color:#FFF;" />
<?php } ?>
<?php } ?>

</td></tr>
<tr><td colspan="6" >&nbsp;</td></tr>
<?php }else{ ?>
<tr><td colspan="6" > <label class="w3-text-black w3-center">Please Upload previous year Fund report</label></td></tr>
<?php } ?>
</table>
</div>
<?php if(empty($fund_det[0]['upload_file'])){ ?>
<div class="card">
<?php if(isset($amount_spent_sum)|| isset($sanc_fund['amount_sanc'])|| isset($bal)){?>
<table cellpadding="0" cellspacing="0" width="100%" border="1">
<tr align="center" class="table_th_cu"><td width="34%" height="22">Amount Sanctioned From University</td><td width="38%"> Total Spent</td><td width="28%">Balance</td></tr>
<tr align="center" style="background-color:#d9e6f9;"><td><b><?php if(isset($sanc_fund['amount_sanc'])) echo $sanc_fund['amount_sanc']; ?></b></td>
<td><b><?php if(isset($amount_spent_sum)) echo $amount_spent_sum; ?></b></td><td><b><?php if(isset($bal)) echo $bal; ?></b></td></tr>
</table>
<?php } ?>
<br />
<?php if (isset($fund_det)){ ?>
 <table id="datatable" class="table table-striped table-bordered" width="100%" >
                      <thead>
                        <tr>
                         <th>SL.NO</th>
                          <th>FUND TYPE</th>
						  <th>Date</th>
                          <th>Expense Describition</th>
                          <th>Amount Spent</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php  $i=0;foreach ($fund_det as $value ){ $i++;?>
                        <tr   class="wordbreak" align="center">
                        <td><?php echo $i;?></td>
						 <td><?php if($value['fund_type']=="R") echo "REGULAR FUND"; elseif($value['fund_type']=="S") echo "SPECIAL FUND";?></td>
                          <td><?php echo date("d-m-Y", strtotime($value['date'])); ?></td>
                          <td><?php echo $value['expense_desc']; ?></td>
                          <td><?php echo $value['amount_spent']; ?></td>
                        </tr>                   
                       <?php }?>
                      </tbody>
                    </table>
</div>
<?php } }?>
</div>
</form>
    <script src="<?php echo base_url();?>tab/js/jquery.min.js"></script>
    <!-- Bootstrap need -->
    <script src="<?php echo base_url();?>tab/js/bootstrap.min.js"></script>   
    <!-- Datatables -need-->
    <script src="<?php echo base_url();?>tab/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>tab/js/dataTables.bootstrap.min.js"></script><!--pagination- pointer not that mauch important-->
    <!-- Custom Theme Scripts need -->
    <script src="<?php echo base_url();?>tab/js/custom.min.js"></script>
