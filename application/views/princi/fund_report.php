<?php if(isset($msg)){?>
<div class="w3-center" style="color:#FF8040; "><?php echo $msg; ?></div><?php }?>
<div class="w3-card"  >
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">Fund Report</b></h4>
</div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="form1" id="form1"  >
<?php if(count($nss_fund_list)>4){?>
<label  class="w3-text-black" >Select year to view fund report of before <?php echo $nss_fund_list[4]['year'];?></label>
<input type="text" id="b_year" name="b_year" autocomplete="off" />
<input type="submit" id="b_sub" name="b_sub" value="SUBMIT"/>
<?php }?>

<div class="w3-card w3-center" style="margin-top:20px;font-size:18px; color:#000080; font-weight:bold;"> <?php if(isset($nss_fund_list)&& 
!empty($nss_fund_list)){ 
if(($nss_fund_list[0]['verification_id']=="2")||($nss_fund_list[0]['verification_id']=="2R")||($nss_fund_list[0]['verification_id']=="3")){ ?> 
 STATUS : FORWARD TO UNIVERSITY<?php }elseif(($nss_fund_list[0]['verification_id']=="3R")){ ?>
 STATUS: REJECTED BY UNIVERISTY<?php }elseif(($nss_fund_list[0]['verification_id']=="4")){ ?>STATUS: ACCEPTED BY UNIVERISTY <?php }
 elseif(($nss_fund_list[0]['verification_id']=="1R")){ ?>STATUS: REJECTED BY PRINCIPAL  REASON:<?php echo $nss_fund_list[0]['remarks'] ;}?></div>
 
<div class="col-md-12 col-sm-12 col-xs-12 " ><div><div class="x_content">
   <h4 class="w3-center"><fntn>LIST OF FUND REPORT </fntn></h4>
	<hr />
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>YEAR</th>
                          <th>FUND REPORT</th>
                          <th>STATUS</th>
                          <th>REMARK</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $i=0;foreach ($nss_fund_list as $value ){ ?>
                        <tr   class="wordbreak">
                          <td><?php echo $value['year']; ?></td>
                          <?php if($value['upload_file']){ ?>
                          <td><a  href="<?php echo base_url();?>upload/po/col<?php echo $college_id;?>/FUND/<?php echo $value['year']; ?>.pdf" target="_blank"><?php echo $value['year']; ?>.pdf</a></td>
                          <?php }else{?>
                           <td>
                           <a href="<?php echo base_url();?>princi/NssPrinci/fund_print/<?php echo $value['year']; ?>" target="_blank"><?php echo $value['year']; ?>.pdf</a>
                           </td>
                          <?php } ?>
                          <td>
                          <?php if($value['verification_id']=="1") echo "FORWARDED TO PRINCIPAL"; 
						  elseif($value['verification_id']=="1R") echo "REJECTED BY PRINCIPAL"; elseif($value['verification_id']=="2"||$value['verification_id']=="3"||$value['verification_id']=="2R") echo "FORWARD TO UNIVERISTY"; elseif($value['verification_id']=="3R") echo "REJECTED BY UNIVERSITY"; elseif($value['verification_id']=="4") echo "ACCEPETD BY UNIVERSITY";?>
                          </td>
                          <td><?php if(isset($value['remarks'])) echo $value['remarks']; ?></td>
                         </tr>                   
                       <?php }?>
                      </tbody>
                    </table>
 </div></div></div>
 
   <?php if($nss_fund_list[0]['verification_id']== "1" ) { ?>
 <input type="submit" value="FORWARD TO UNIVERSITY" id="fwdtoassi" name="fwdtoassi"  class="w3-button  w3-green "/>  
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
<?php  }}else echo"NO DATA FOUND";?>
 </form>
