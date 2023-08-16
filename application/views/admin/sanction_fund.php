<?php //print_r($college_name_sel);exit; ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="form1" id="form1" class="card"   >
<div class="card" style="padding-bottom:20px;" >
<div class="w3-center"><?php if(isset($msg)){ echo $msg;}?></div>
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">SANCTION FUND FOR YEAR <?php echo date('Y');?></b></h4>
</div>

<table width="100%" cellpadding="0" cellspacing="0">
<tr><td width="3%"></td><td width="17%">Select College Type:</td>
<td width="4%"><span class="astrix_red">*</span></td><td width="15%"><select id="type" name="type" class="form-control" <?php if(isset($nss_college_type)|| isset($msg)){ ?> onchange="this.form.submit()"<?php } ?>>
  <option value="">---Select---</option>
  <?php foreach ($nss_college_type as $value1): ?>
  <option value="<?php echo $value1['nss_college_type']; ?>" 
  <?php if(set_value("type")==$value1['nss_college_type']) echo "selected";?>> <?php if($value1['nss_college_type']=="SF") echo"SELF FINANCING"; elseif($value1['nss_college_type'] =="REG")echo"REGULAR";  ?>
  </option>
  <?php endforeach; ?>
</select></td>
<td></td></tr>
<tr><td colspan="5">&nbsp;</td></tr>
<tr>
<td></td>
<td>Amount Sanctioned (Rs):</td>
<td><span class="astrix_red">*</span></td>
<td><input type="text" id="amount_txt" name="amount_txt" maxlength="5" onKeyPress="return input_number(event)" class="form-control" /></td>
<td width="61%"></td>
</tr>
</table>
<?php if(isset($college_name_sel)){ ?>
<div class="col-md-12 col-sm-12 col-xs-12 " ><div><div class="x_content">
   <h4 class="w3-center"><fntn>LIST OF COLLEGES </fntn></h4>
	<hr />
    <table id="res" class="table table-striped table-bordered dataTable">
                      <thead>
                        <tr>
                          <th> <input type="checkbox" id="flowcheckall" value="" />ALL</th>
						  <th>SL.NO</th>
                          <th>COLLEGE NAME</th>
                          <th>ADDRESS</th>
                          <th>CONTACT NO:</th>
                          <th>EMAIL ID:</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $i =0; foreach ($college_name_sel as $value ){ $i++; ?>
                        <tr   class="wordbreak">
                          <td><input id="chk[]" name="chk[]" value="<?php  echo $value['college_id'];?>" type="checkbox"
                          <?php if($value['fund_status']=='active'){ ?> checked="checked" <?php } ?>
                           /></td>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $value['college_name_for_gradecard']; ?></td>
                          <td><?php echo $value['college_address']; ?></td>
                          <td><?php if($value['college_contact_no']!= ' / '){ echo $value['college_contact_no']; }?></td>
                          <td><?php echo $value['college_email']; ?></td>
                        </tr>                   
                       <?php }?>
                      </tbody>
        </table>
     </div></div></div>
	 
     <input type="submit" id="sanc_fund_submit" name="sanc_fund_submit" value= "SAVE"   onclick="uncheckedList()" class="w3-button  w3-green w3-center"/>
     <input type="hidden" id="unchk" name="unchk"  />
     <?php } ?>
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

function uncheckedList(){
	var unchecked = "";
	var unchecked = $('input[name="chk[]"]').not(':checked').map(function(i,v) {
    return this.value;
})
.get().join('|');
$("input[type='hidden'][name='unchk']").val(unchecked);

}
</script>