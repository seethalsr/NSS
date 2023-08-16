<?php //print_r($nss_fund_list);exit; ?>
<link href="<?php echo base_url();?>tab/css/bootstrap.min.css" rel="stylesheet">   
<link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet"> 
<form id="frm" name="frm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr>
<td height="31"><span class="w3-center" ><?php if(isset($msg)){?>
<h6  style="color:#FF8040; "><?php echo $msg; ?></h6><?php }?></span></td></tr>
<tr>
<td class="w3-center"><span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">FUND REPORT</span></td></tr>
<tr><td>&nbsp;</td></tr>
<tr><td>
<table cellpadding="0" cellspacing="0" width="100%" >
<tr>
<td width="15%" height="74"><label class=" control-label" >Select College Type</label></td>
<td width="2%"></td>
<td width="18%">
<select id="type" name="type" class="form-control" <?php if(isset($nss_college_type)|| isset($msg)){ ?> onchange="this.form.submit()"<?php } ?>>
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

</table>
</td></tr>
</table>
<?php if(isset($nss_fund_list)&& !empty($nss_fund_list)){	 ?>
<div class="w3-card w3-center" style="margin-top:15px; margin-bottom:20px;">
<?php if($nss_fund_list[0]['verification_id']=="3R"){ ?>
STATUS : REJECTED BY SO
<?php }elseif($nss_fund_list[0]['verification_id']=="4"){ ?>
STATUS : ACCEPTED BY SO
<?php } elseif($nss_fund_list[0]['verification_id']=="3R"){ ?>
STATUS : REJECTED BY SO ---- REMARKS:<?php echo $nss_fund_list[0]['remarks'] ; } }?>
</div>

	 <!-- table-->
  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" cellpadding="0" width="100%" height="100%">
                      <thead>
                        <tr>
						  <th width="14%">Year</th>
                          <th width="15%">Fund Report</th> 
                          <th width="40%">Status</th>         
                          <th width="40%">Remarks</th>               
					 </tr>
                      </thead>
                    <tbody>
					  <?php if(isset($nss_fund_list)){ $i=0;foreach ($nss_fund_list as $value ){ ?>
                        <tr   class="wordbreak">
                          <td><?php echo $value['year']; ?></td>
                          <?php if($value['upload_file']){ ?>
                          <td><a  href="<?php echo base_url();?>upload/po/col<?php echo $college_id;?>/FUND/<?php echo $value['year']; ?>.pdf" target="_blank"><?php echo $value['year']; ?>.pdf</a></td>
                          <?php }else{?>
                           <td>
                           <a href="<?php echo base_url();?>Admin/NssAdmin/fund_print/<?php echo $value['year']; ?>/<?php echo $college_id; ?>" target="_blank"><?php echo $value['year']; ?>.pdf</a>
                           </td>
                          <?php } ?>
                          <td>
                          <?php if($value['verification_id']=="3") echo "FORWARDED TO SO";  elseif($value['verification_id']=="3R") echo "REJECTED BY SO"; elseif($value['verification_id']=="4") echo "ACCEPETD BY UNIVERSITY";?>
                          </td>
                          <td><?php if(isset($value['remarks'])) echo $value['remarks']; else echo"-";?></td>
                         </tr>                   
                       <?php }}?>
                      </tbody>
                    </table>

<?php if( isset($nss_fund_list) && !empty($nss_fund_list) && $nss_fund_list[0]['verification_id']=="3"){ ?>
<div class="w3-center">		
<input type="submit" class="btn btn-primary" value="ACCEPTED AND FORWARD TO SO" name="fwdassi" id="fwdassi" style="background-color:#0080C0; color:#FFF"/>
<button type="button" class="btn " data-toggle="modal" data-target="#Rejected" style="background-color:#FF7D7D; color:#FFFFFF" >REJECTED AND FORWARD TO SO</button>
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
        <input type="submit" class="btn btn-primary" name="rejassisubmit" id="rejassisubmit" value="Submit"/>
      </div>
    </div>
  </div>
</div>
</div>
<?php }?>
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