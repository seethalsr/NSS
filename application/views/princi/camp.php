<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="form1" id="form1"  >
<?php if(isset($msg)){?>
<div class="w3-center" style="color:#FF8040; "><?php echo $msg; ?></div><?php }?>
<div class="w3-card"  >
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">CAMP DETAILS </b></h4>
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
<tr>
<td width="12%"></td>
<?php if(isset($sel_unit)){ ?>
<td width="11%"><label  class="w3-text-black" >Camp Type :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="15%">
<select id="get_camp" name="get_camp" class="form-control"   >
<option value="">--Select Camp Type--</option>    
<option value="spl" <?php if(set_value("get_camp")== "spl") echo "selected";?>  >Special Camp</option> 
<option value="mini1" <?php if(set_value("get_camp")== "mini1") echo "selected";?>  >Mini Camp 1</option> 
<option value="mini2" <?php if(set_value("get_camp")== "mini2") echo "selected";?>  >Mini Camp 2</option> 
</select>
</td><td width="4%"></td><td width="37%"><input type="submit" id="get_val" name="get_val" value="SUBMIT" class="w3-button  w3-blue"   /></td>
<?php } ?>
<td width="3%"></td></tr>
</table>
<?php if(isset($camp_detail)&&!empty($camp_detail)){?>
<div class="w3-card w3-center" style="margin-top:20px; font-size:18px; color:#000080; font-weight:bold;"> <?php if(($camp_detail[0]['verification_id']=="2")||($camp_detail[0]['verification_id']=="2R")||($camp_detail[0]['verification_id']=="3")){ ?> 
 STATUS : FORWARD TO UNIVERSITY<?php }elseif(($camp_detail[0]['verification_id']=="3R")){ ?>
 STATUS: REJECTED BY UNIVERISTY<?php }elseif(($camp_detail[0]['verification_id']=="4")){ ?>STATUS: ACCEPTED BY UNIVERISTY <?php }
 elseif(($camp_detail[0]['verification_id']=="1R")){ ?>STATUS: REJECTED BY PRINCIPAL  REASON:<?php echo $camp_detail[0]['remarks'] ;}?></div>
 <div class="col-md-12 col-sm-12 col-xs-12 " >
  <div class="x_content">
  <h4 class="w3-center"><fntn>CAMP DETAILS OF <?php echo $sel_batch;?> </fntn></h4>
<hr />
                    <table id="datatable" class="table table-striped table-bordered">
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
                      <?php if(isset($sub)){?>
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
                          <td><a href="<?php echo base_url();?>Po/NssPo/camp_image/<?php echo $value['nss_camp_id'];?>" target="_blank">image</a></td>
                          <td><a href="<?php echo base_url();?>Po/NssPo/camp_parti/<?php echo $value['nss_camp_id'];?>" target="_blank">View Participants</a>
						</td>
                        </tr>                   
                       <?php }}}?>
                      </tbody>
                      <?php } ?>
                    </table>
  </div></div>
  <?php if($camp_detail[0]['verification_id']== "1" ) { ?>
 <input type="submit" value="FORWARD TO UNIVERSITY" id="fwdtoassi" name="fwdtoassi" class="w3-button  w3-green " />  
 <button type="button" class="btn " data-toggle="modal" data-target="#Rejected" style="background-color:#FF0000; color:#FFFFFF" >REJECTED</button>
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
  <?php } ?>
  <br />
  </div>
 </form>
