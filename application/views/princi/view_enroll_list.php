<script language="javascript" src="<?php echo base_url(); ?>js/thickbox.js" type="text/javascript"></script>
<link href='<?php echo base_url(); ?>css/thickbox.css' rel='stylesheet' type='text/css'/>
<link href='<?php //echo base_url(); ?>css/w3.css' rel='stylesheet' type='text/css'/>

<?php //print_r($enroll_list); exit;
if(isset($msg))echo $msg; ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="form1" id="form1"  >
<?php if(isset($batch_period)){?>
<table cellpadding="0" cellspacing="0"  width="100%">
<tr>
<td width="3%"></td>
<td width="12%"> <label class=" control-label" for="unit">BATCH :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="1%"></td>
<td width="30%">
<select id="batch" name="batch" class="form-control" onchange="this.form.submit()" >
              <option value="">--Select--</option>  
			  <?php foreach($batch_period as $value){?>           
			  <option value="<?php echo $value['batch_period']; ?>" <?php if(isset($sel_batch) && $sel_batch == $value['batch_period']) echo "selected";?>> <?php echo $value['batch_period']; ?></option> 
           	 <?php }?>
</select>
</td><td width="3%"></td>
<td width="3%"></td>
<td width="15%"> <label class=" control-label" for="unit">UNIT :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
<td width="3%"></td>
<td width="24%">
<select id="unit" name="unit" class="form-control" onchange="this.form.submit()" >
              <option value="">--Select--</option>  
			  <?php foreach($unit_det as $value){?>           
			  <option value="<?php echo $value['nss_unit_id']; ?>" <?php if(isset($sel_unit) && $sel_unit == $value['nss_unit_id']) echo "selected";?>> <?php echo $value['nss_unit_id']; ?></option> 
           	 <?php }?>
</select>
</td><td width="6%"></td>
</tr>
</table>

 <?php if(isset($enroll_list) && (!empty($enroll_list))) {?>
 
 <div class="w3-card w3-center" style="margin-top:20px; font-size:18px; color:#000080; font-weight:bold;"> <?php if(($enroll_list[0]['verification_id']=="2")||($enroll_list[0]['verification_id']=="2R")||($enroll_list[0]['verification_id']=="3")){ ?> 
 STATUS : FORWARD TO UNIVERSITY<?php }elseif(($enroll_list[0]['verification_id']=="3R")){ ?>
 STATUS: REJECTED BY UNIVERISTY<?php }elseif(($enroll_list[0]['verification_id']=="4")){ ?>STATUS: ACCEPTED BY UNIVERISTY <?php }
 elseif(($enroll_list[0]['verification_id']=="1R")){ ?>STATUS: REJECTED BY PRINCIPAL  REASON:<?php echo $enroll_list[0]['remarks'] ;}?></div>
<div class="col-md-12 col-sm-12 col-xs-12 " ><div><div class="x_content">
   <h4 class="w3-center"><fntn>LIST OF ENROLLED STUDENT </fntn></h4>
	<hr />
	<span style="color:#0080FF; font-weight:bold;padding-left:40%"> TOTAL NUMBER OF STUDENT <?php echo $count_stud; ?> </span>
                    <table id="datatable" class="table table-striped table-bordered" width="100%">
                      <thead>
                        <tr>
						
                         <th width="10%">VIEW</th>
						  <th width="10%">BATCH</th>
                        
						  <th width="15%">PRN NO:</th>
                          <th width="35%">NAME</th>
                         
                          <th width="11%">MOBILE NO:</th>
                           <th width="5%">GENDER</th>
                           <th width="20%">CAST</th>
						  <?php if(!empty($enroll_list[0]['nss_enroll_id'])){ ?><th width="14%">ENROLLMENT ID </th><?php }?>
						 </tr>
                      </thead>
                      <tbody>
					  <?php foreach ($enroll_list as $value ){ ?>
                        <tr   class="wordbreak">
                        <td><a href="<?php echo base_url(); ?>Po/NssPo/view_stud_detail/<?php  echo $value['nss_stud_id'];?>?keepThis=true&TB_iframe=true&height=350&width=600" title="VIEW STUDENT DETAIL" class="thickbox w3-button  w3-blue "> DETAILS</a></td>
                          <td><?php echo $value['batch_period']; ?></td>                          
						  <td><?php echo $value['account_id']; ?></td>
                          <td><?php echo $value['account_student_name']; ?></td>                          
                          <td><?php echo $value['account_student_mobileno']; ?></td>
                          <td><?php if($value['gender']=="F") echo "Female"; elseif($value['gender']=="M") echo "Male"; else echo "Other" ; ?></td>
                          <td><?php echo $value['cast']; ?></td>
						   <?php if(!empty($enroll_list[0]['nss_enroll_id'])){ ?><td><?php echo $value['nss_enroll_id']; ?></td><?php  } ?>
                         </tr>                   
                       <?php }?>
                      </tbody>
					 
                    </table>
 </div></div></div>
 <div class="w3-center">
 <?php if(empty($enroll_list[0]['nss_enroll_id'] )&& $enroll_list[0]['verification_id']== "1"){ ?>
  <input type="submit" class="btn btn-primary" value="CLICK TO ENROLL ALL" name="enroll" id="enroll" style="background-color:#0080C0; color:#FFF"/>
  <?php }elseif($enroll_list[0]['verification_id']== "1" ) { ?>
 <input type="submit" value="FORWARD TO UNIVERSITY" id="fwdtoassi" name="fwdtoassi" class="btn" style="background:#09C; color:#FFF;"  />  
 <?php }
 if($enroll_list[0]['verification_id']== "1" ||( empty($enroll_list[0]['nss_enroll_id']) && $enroll_list[0]['verification_id']== "1") ){?>
 <button type="button" class="btn " data-toggle="modal" data-target="#Rejected" style="background-color:#800040; color:#FFFFFF" >REJECTED</button>
 <div class="modal fade" id="Rejected" tabindex="-1" role="dialog" aria-labelledby="RejectedLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">REASON FOR REJECTION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>        </button>
      </div>
      <div class="modal-body">

                    <textarea id="remarktxt1" name="remarktxt1" rows="5" cols="100" class="form-control" style="resize:none"></textarea>
                
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="rejprincisubmit" id="rejprincisubmit" value="Submit"/>
      </div>
    </div>
  </div>
</div>
<?php } ?>
 </div>

<?php }?> <?php }?>
<?php if(isset($enroll_list)&& empty($enroll_list)){ ?>
NO DATA AVAILABLE
<?php } ?>


</form>
