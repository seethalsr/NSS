<?php //print_r($colge_list);exit;?>
<span ><?php if(isset($msg)){?><h6  style="color:#FF8040; "><?php echo $msg; ?></h6><?php }?></span><br>
<form id="frm" name="frm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table width="100%"><tr>
    <td width="13%"> Select College Type:</td><td width="18%"><select id="type" name="type" class="form-control" <?php if(isset($college_type)|| isset($msg)){ ?>onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($nss_college_type as $value1): ?>
<option value="<?php echo $value1['nss_college_type']; ?>" 
<?php if(set_value("type")==$value1['nss_college_type']) echo "selected";?>> <?php if($value1['nss_college_type']=="SF") echo "SELF FINANCING" ; elseif($value1['nss_college_type']=="REG") echo "REGULAR" ;  ?></option>
<?php endforeach; ?>
</select></td><td width="69%"></td></tr></table>

<?php if(isset($colge_list)){?>
<table id="datatable"  height="100%" width="100%" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" >
<thead><tr>
<th><input type="checkbox" id="flowcheckall" value="" />ALL</th>
<th>Sl.No:</th>
<th>College Name</th>
<th>College Contact</th>
<th>College Address</th>
</tr></thead>
<tbody>
<?php {$i=0; foreach($colge_list as $val){$i++; ?>
<tr>
<td><input id="chk[]" name="chk[]" value="<?php  echo $val['college_id'];?>" type="checkbox"  class="messageCheckbox" /></td>
<td><?php echo $i; ?></td>
<td><?php echo $val['college_name']; ?></td>
<td><?php echo $val['college_contact_no']; ?></td>
<td><?php echo $val['college_address']; ?></td>
</tr>
<?php } }?>
</tbody>
</table>
<input type="hidden" id="ids" name="ids" />
<a href="#" data-toggle="modal" data-target="#myModal" class="w3-button  w3-green "><b>SUBMIT</b></a>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <p>Are You Sure, You want to generate login credential for the selected colleges ?				</p>
      </div>
      <div class="modal-footer">
       <input type="submit" class="w3-button  w3-red  w3-left" value="YES" id="subm" name="subm"/>
        <button type="button"  class="w3-button  w3-green  w3-right" data-dismiss="modal">NO</button>
      </div>
    </div>

  </div>
</div>
<?php }  ?>


</form>
 <script>
 	$(document).ready(function () {
    var str = "";
    oTableStaticFlow = $('#datatable').DataTable({
        "aoColumnDefs": [{
            'bSortable': false,
            'aTargets': [0]
        }],
    });
    $("#flowcheckall").click(function () {
	  var cols = oTableStaticFlow.column(0).nodes(),
            state = this.checked;
        
        for (var i = 0; i < cols.length; i += 1) {
        	cols[i].querySelector("input[type='checkbox']").checked = state;
        }
    });
	 $("#subm").click(function () {
		 var arr = [];
		  var cols = oTableStaticFlow.column(0).nodes();
		 for (var i = 0; i < cols.length; i += 1) {
		 if(cols[i].querySelector("input[type='checkbox']").checked )
		 { 
			 arr.push(cols[i].querySelector("input[type='checkbox']").value);
		 }
		   }
		   $("#ids").val(arr);
	 });
});
</script>
