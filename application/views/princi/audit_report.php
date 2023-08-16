<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="form1" id="form1"  >
<?php if(isset($msg)){?>
<div class="w3-center" style="color:#FF8040; "><?php echo $msg; ?></div><?php }?>
<div class="w3-card"  >
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">Audit Report</b></h4>
<div class="w3-card w3-center" style="margin-top:20px;"> <?php if(isset($audit_detail)&& !empty($audit_detail)){
if(($audit_detail[0]['verification_id']=="2")||($audit_detail[0]['verification_id']=="2R")||($audit_detail[0]['verification_id']=="3")){ ?> 
 STATUS : FORWARD TO UNIVERSITY<?php }elseif(($audit_detail[0]['verification_id']=="3R")){ ?>
 STATUS: REJECTED BY UNIVERISTY<?php }elseif(($audit_detail[0]['verification_id']=="4")){ ?>STATUS: ACCEPTED BY UNIVERISTY <?php }
 elseif(($audit_detail[0]['verification_id']=="1R")){ ?>STATUS: REJECTED BY PRINCIPAL  REASON:<?php echo $audit_detail[0]['remarks'] ;}?></div>
 
<div class="col-md-12 col-sm-12 col-xs-12 " ><div><div class="x_content">
   <h4 class="w3-center"><fntn>LIST OF AUDIT REPORT </fntn></h4>
	<hr />
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>YEAR</th>
                          <th>AUDIT REPORT</th>
                          <th>STATUS</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $i=0;foreach ($audit_detail as $value ){ ?>
                        <tr   class="wordbreak">
                          <td><?php echo $value['year']; ?></td>
                           <td>
                           <a href="<?php echo base_url();?>upload/po/col<?php echo $college_id; ?>/AUDIT/<?php echo $value['year']; ?>.pdf" target="_blank"><?php echo $value['year']; ?>.pdf</a>
                           </td>
                          <td></td>
                         </tr>                   
                       <?php }?>
                      </tbody>
                    </table>
 </div></div></div>
 <?php if($audit_detail[0]['verification_id']== "1" ) { ?>
 <input type="submit" value="FORWARD TO UNIVERSITY" id="fwdtoassi" name="fwdtoassi"  />  
 <button type="button" class="btn " data-toggle="modal" data-target="#Rejected" style="background-color:#0099CC; color:#FFFFFF" >REJECTED</button>
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
<?php  }} echo "NO DATA FOUND";?>
</a>
</div>