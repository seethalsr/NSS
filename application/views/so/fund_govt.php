<form id="frm" name="frm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<span class="w3-center" ><?php if(isset($msg)){?>
<h6  style="color:#FF8040; "><?php echo $msg; ?></h6><?php }?></span>
<?php if(isset($fund_gov_data_yr)&&($fund_gov_data_yr['verification_id']=="3")){?>
<table width="100%">
<tr><td>Amount from Government</td><td></td><td><input type="text" id="fund_gov" name="fund_gov" disabled="disabled" value="<?php echo $fund_gov_data_yr['amount']; ?>"/></td></tr>
<tr><td>Account Number</td><td></td><td><input type="text" id="fund_acc" name="fund_acc" disabled="disabled" value="<?php echo $fund_gov_data_yr['account']; ?>" /></td></tr>
<tr><td></td><td></td><td></td></tr>
</table>

<div class="w3-center">		
<input type="submit" class="btn btn-primary" value="ACCEPTED BY SO" name="accso" id="accso" style="background-color:#0080C0; color:#FFF"/>
<button type="button" class="btn " data-toggle="modal" data-target="#Rejected" style="background-color:#FF7D7D; color:#FFFFFF" >REJECTED</button>
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
        <input type="submit" class="btn btn-primary" name="rejso" id="rejso" value="Submit"/>
      </div>
    </div>
  </div>
</div>
</div>
<?php }else{ echo "NO DATA FOUND";} ?>
<?php if(isset($fund_gov_data)&& !empty($fund_gov_data)){ ?>
<table width="100%">
<th>Sl.No:</th>
<th>YEAR</th>
<th>AMOUNT</th>
<th>ACCOUNT</th>
<th>STATUS</th>
<th>REMARKS</th>
<tbody>
<?php  $i=0; foreach($fund_gov_data as $val){ $i++;?>
<tr><td><?php echo $i;?></td><td><?php echo $val['year'];?></td><td><?php echo $val['amount'];?></td><td><?php echo $val['account'];?></td>
<td><?php if($val['verification_id']=="3") echo "FORWARDED TO SO"; elseif($val['verification_id']=="4") echo "ACCEPTED BY SO"; elseif($val['verification_id']=="3R") echo "REJECTED BY SO"; ?></td>
<td><?php echo $val['remarks'];?></td></tr>
<?php }?>
</tbody>
</table>
<?php } ?>
</form>