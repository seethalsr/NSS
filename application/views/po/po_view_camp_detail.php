<?php //print_r($camp_detail);exit; ?>
<link href="<?php echo base_url();?>tab/css/bootstrap.min.css" rel="stylesheet">   
<link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet">
<span class="w3-center"><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span><br>
<form name="frm1" id="frm1" method="post"   action="<?php echo base_url(); ?>Po/NssPo/po_view_camp_detail" >
<table width="100%" height="100%" style="vertical-align:top;">
<tr>
<td >
<div class="card" >
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">VIEW CAMP DETAILS</b></h4>
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
<td width="2%"></td>
<td width="12%">Select Camp Type</td>
<td width="1%"></td>
<td width="21%"><select id="get_camp" name="get_camp" class="form-control"  onchange="this.form.submit()" >
<option value="">--Select Camp Type--</option>    
<option value="spl" <?php if(set_value("get_camp")== "spl") echo "selected";?>  >Special Camp</option> 
<option value="mini1" <?php if(set_value("get_camp")== "mini1") echo "selected";?>  >Mini Camp 1</option> 
<option value="mini2" <?php if(set_value("get_camp")== "mini2") echo "selected";?>  >Mini Camp 2</option> 
</select></td>
<td width="13%"></td>
<?php /*?><?php if(set_value("get_camp")){ ?><td width="21%"><input type="submit" id="get_val" name="get_val" value="SUBMIT"  class="btn" style="background:#09C; color:#FFF;"  /></td>
<?php } ?><?php */?>
</tr>
</table>
</div>
</td>
</tr>
<tr><td>
<?php if(isset($detail['sel_camp_type'])){?>
 <div class="col-md-12 col-sm-12 col-xs-12 " >
  <div class="x_content">
  <h4 class="w3-center"><fntn>CAMP DETAILS OF <?php if($detail['sel_camp_type']=="spl"){?>SPECIAL CAMP<?php }elseif($detail['sel_camp_type']=="mini1"){?> MINI1<?php }if($detail['sel_camp_type']=="mini2"){?>MINI2<?php } ?> </fntn></h4>
<hr />
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>Sl.No</th>
                          <th>From Date</th>
                          <th>To Date</th>
                          <th>Camp Type</th>
                          <th>Camp Destination</th>
                          <th>Activity Describition</th>
                          <th>Activity Hour</th>
                          <th>Image</th>
                          <th>Participants</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $value = ""; $i=0; if(isset($camp_detail)){{foreach ($camp_detail as $value ){ $i++; ?>
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
                          <td>
						  <?php if($value['nss_camp_image']==",") echo ""; else {?>
						  <a href="<?php echo base_url();?>Po/NssPo/camp_image/<?php echo $value['nss_camp_id'];?>" target="_blank">IMAGE</a>
						  <?php } ?></td>
                          <td><a href="<?php echo base_url();?>Po/NssPo/camp_parti/<?php echo $value['nss_camp_id'];?>" target="_blank">View Participants</a>
                           </td>
                        </tr>                   
                       <?php }}}?>
                      </tbody>
                    </table>
  </div></div>
  <?php if(!empty($camp_detail)&&($camp_detail[0]['verification_id']=="0"||$camp_detail[0]['verification_id']=="1R"||$camp_detail[0]['verification_id']=="3R")){ ?>
  <input type="submit" value="FORWARD TO PRINCIPAL" id="fwd_p" name="fwd_p" class="w3-button  w3-green " />
  <?php }} ?>
</td></tr>
</table>



</form>
    <script src="<?php echo base_url();?>tab/js/jquery.min.js"></script>
    <!-- Bootstrap need -->
    <script src="<?php echo base_url();?>tab/js/bootstrap.min.js"></script>   
    <!-- Datatables -need-->
    <script src="<?php echo base_url();?>tab/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>tab/js/dataTables.bootstrap.min.js"></script><!--pagination- pointer not that mauch important-->
    <!-- Custom Theme Scripts need -->
    <script src="<?php echo base_url();?>tab/js/custom.min.js"></script>