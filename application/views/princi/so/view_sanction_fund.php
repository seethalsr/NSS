<?php //print_r($college_list);exit; ?>
<form action="<?php echo base_url();?>Admin/NssSo/view_sanc_fund" method="post"  name="form1" id="form1" class="card"   >
<div class="card" style="padding-bottom:20px;" >
<div class="w3-center"><?php if(isset($msg)){ echo $msg;}?></div>
<h4 align="center"><b style="text-decoration:underline;">VIEW SANCTION FUND FOR YEAR <?php echo date('Y');?> </b></h4>
</div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr><td width="3%"></td><td width="32%"><label for="head" class="form-control-label">Select College Type:</label></td>
<td width="18%">&nbsp;</td><td width="37%"><select id="type" name="type" class="form-control" >
  <option value="">---Select---</option>
  <?php foreach ($nss_college_type as $value1): ?>
  <option value="<?php echo $value1['nss_college_type']; ?>" 
  <?php if($sel['type']==$value1['nss_college_type']) echo "selected";?>> <?php if($value1['nss_college_type']=="SF") echo"SELF FINANCING"; elseif($value1['nss_college_type'] =="REG")echo"REGULAR"; ?>
  </option>
  <?php endforeach; ?>
</select></td>
<td></td></tr>
<tr><td colspan="5">&nbsp;</td></tr>
<tr>
<td></td>
<td><label for="head" class="form-control-label">Year:</label></td>
<td></td>
<td><select id="year" name="year" class="form-control" <?php if(isset($year_list)|| isset($msg)){ ?> onchange="this.form.submit()"<?php } ?> >
  <option value="">---Select---</option>
  <?php foreach ($year_list as $value2): ?>
  <option value="<?php echo $value2['year']; ?>" 
  <?php if($sel['year']==$value2['year']) echo "selected";?>> <?php echo $value2['year']; ?>
  </option>
  <?php endforeach; ?>
</select></td>
<td width="10%"></td>
</tr>
</table>
<?php if(isset($college_list)&&!empty($college_list)){ ?>
<div class="col-md-12 col-sm-12 col-xs-12 " ><div><div class="x_content">
   <h4 class="w3-center"><fntn>LIST OF COLLEGES </fntn></h4>
	<hr />
    <table id="res" class="table table-striped table-bordered dataTable">
                      <thead>
                        <tr>
                         <?php if($sel['year']==date('Y')&& $college_list[0]['verification_id']==""){?> <th>DELETE</th><?php } ?>
						  <th>SL.NO</th>
                          <th>COLLEGE NAME</th>
                          <th>ADDRESS</th>
                          <th>CONTACT NO:</th>
                          <th>EMAIL ID:</th>
                          <th>SANCTIONED AMOUNT</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $i =0; foreach ($college_list as $value ){ $i++; ?>
                        <tr   class="wordbreak">
                         <?php if($sel['year']==date('Y')&& $college_list[0]['verification_id']==""){?> <td><a href="<?php echo base_url();?>Admin/NssAdmin/view_sanc_fund/<?php  echo $value['nss_fund_sanc_id'];?>/<?php  echo $sel['year'];?>/<?php  echo $sel['type'];?>">
                          <span class="glyphicon glyphicon-trash"></span></a></td><?php } ?>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $value['college_name_for_gradecard']; ?></td>
                          <td><?php echo $value['college_address']; ?></td>
                          <td><?php if($value['college_contact_no']!= ' / '){ echo $value['college_contact_no']; }?></td>
                          <td><?php echo $value['college_email']; ?></td>
                          <td><?php echo $value['amount_sanc']; ?></td>
                         </tr>                   
                       <?php }?>
                      </tbody>
                    </table>
     </div></div></div>
       <?php if($sel['year']==date('Y')&& $college_list[0]['verification_id']=="3"){?><input type="submit" id="sanc_fund_submit" name="sanc_fund_submit" value= "ACCEPTED BY SO"/>
	   <button type="button" class="btn " data-toggle="modal" data-target="#Rejected" style="background-color:#FF7D7D; color:#FFFFFF" >REJECTED BY SO</button>
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
     <?php }} ?>
</form>

<script>
	$(document).ready(function () {
   

    oTableStaticFlow = $('#res').DataTable();

    $("#flowcheckall").click(function () {
        $('#flow-table tbody input[type="checkbox"]').prop('checked', this.checked);
        var cols = oTableStaticFlow.column(0).nodes(),
            state = this.checked;
        
        for (var i = 0; i < cols.length; i += 1) {
        	cols[i].querySelector("input[type='checkbox']").checked = state;
        }
    });
});


</script>