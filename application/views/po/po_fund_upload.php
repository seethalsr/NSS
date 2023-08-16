
<?php $prev = date("Y",strtotime("-1 year")); $prev2 = date("Y",strtotime("-2 year"));  ?>
<form name="frm1" id="frm1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data"  >
<table cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr>
<td colspan="5">
<div class="w3-center" style="padding-bottom:0px">
<span ><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span><br>
<span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">Fund Report Upload</span>
<hr>
</div>
</td>
</tr>
<?php if(isset($hide)){ if(isset($status)){?>
<tr>
<td width="16%" ><label class=" control-label" >Status of Previous year Fund Report:</label></td>
<td width="22%"><label class=" control-label" ><span style="color:#008080;"><?php  echo $status;}?></span></label></td>
<td width="2%">&nbsp;</td>
<?php if(!empty($get_2yr[0]['remarks_from_princi']) ){?>
<td width="34%"><textarea class="form-control input-sm" id="txt1" name="txt1" readonly="readonly"  rows="3" >Remarks from Principal:</textarea></td>
<?php } ?>
<td width="26%">&nbsp;</td>
</tr>
<?php } ?>
</table>


<table cellpadding="0" cellspacing="0" height="100%" width="100%">
<?php if(empty($hide)){?>
<tr><td colspan="6">&nbsp;</td></tr>
<tr>
<td width="34%">
<label class=" control-label" >Upload Previous Two Year Fund Report (<?php echo $prev; ?> - <?php echo $prev2; ?>):</label>
</td>
<td width="1%"></td>
<td width="34%">
<input  name="txt4" class=" form-control input-file" type="file">
<span style="color:#F00;"><?php echo form_error('txt4'); ?></span>	
</td>
<td width="3%"></td>

<td width="27%"><input type="submit" class="btn btn-primary" value="Upload" name="submit1" id="submit1" style="background-color:#FF8000; color:#FFF"/></td><?php } ?>
<td width="1%">&nbsp;</td></tr>
</table>
<table cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr><td colspan="6">&nbsp;</td></tr>
<tr><td width="35%"><?php if($get_2yr){?>
<a href="<?php echo base_url();?>uploaded_pdf/<?php echo  $college_id ;?>/fund_2yr.pdf" target="_blank">
<span style="color:#0080FF;" >
<img border="0" alt="" src="<?php echo base_url();?>images/link.png" width="30" height="40"> Click Here To View Previous Year Fund Report </span></a></td>
<td width="2%"></td>
<?php if(empty($status)) { ?>
<td width="61%"><input type="submit" class="btn btn-primary" value="Forward to Principal" name="submitp" id="submitp" style="background-color:#FF8000; color:#FFF"/></td><?php } }?>
<td width="2%" colspan="3">&nbsp;</td>
</tr>
</table>
</br>
<table cellpadding="0" cellspacing="0" height="100%" width="100%" id="myTable" >
<thead>
<tr>
<th>Month</th>
<th>Total Spent</th>
<th>Description</th>
<th>Attachment</th>
<th>Submit</th>
</tr></thead>
<tbody>
<?php if(isset($data_monthly_fund)){ $total = 0;foreach ($data_monthly_fund as $value):?>
<tr><td><?php echo $value['fund_month'];?></td>
<td><?php echo $value['fund_spent'];?></td>
<td><?php echo $value['fund_desc'];?></td>
<td><a href="<?php echo base_url();?>uploaded_pdf/<?php echo  $college_id ;?>/fund_monthly_<?php echo $value['fund_month'];?>.pdf" target="_blank">View</a></td>
<?php $total = $total + $value['fund_spent'];?>
</tr>
<?php endforeach;}else{?>
<tr>
<td>

                         <select id="month" name="month" class="form-control"  >
              			 <option value="">--Select--</option>
			 			 <option value="01" >01 </option>
                         <option value="02">02 </option>
                         <option value="03" >03 </option>
                         <option value="04">04 </option>
                         <option value="05">05 </option>
                         <option value="06">06 </option>
                         <option value="07">07 </option>
                         <option value="08">08</option>
                         <option value="09">09</option>
                         <option value="10">10 </option>
                         <option value="11">11 </option>
                         <option value="12">12 </option>
            			 </select>	
</td>
<td> <input type="text" class="form-control input-sm" id="spent" name="spent"  value="<?php echo set_value("spent");?>" autocomplete="off"></td>
<td><input type="text" class="form-control input-sm" id="desc" name="desc"  value="<?php echo set_value("desc");?>" autocomplete="off"></td>
<td><input  name="attach" class=" form-control input-file" type="file"></td>
<td><input type="submit" class="btn btn-primary" value="OK" name="msubmit" id="msubmit" style="background-color:#0070DF; color:#FFF"/></td>
</tr><?php } ?>

<tr style="background-color:#FFB"><td></td><td><?php if(isset($total)){ echo $total;}?></td><td colspan="3"></td></tr>
</tbody>

</table>
<a id="add_row" class="btn btn-default pull-left">Add Row</a><a id='delete_row' class="pull-right btn btn-default">Delete Row</a>
</form>

<script>
     $(document).ready(function(){
      var i=1;
     $("#add_row").click(function(){
      $('#addr'+i).html("<td><select  name='month' class='form-control input-md'><option value=''>--Select--</option><option value='01' >01 </option><option value='02'>02 </option><option value='03'>03 </option><option value='04'>04 </option><option value='05'>05 </option><option value='06'>06 </option><option value='07'>07 </option><option value='08'>08 </option><option value='09'>09 </option><option value='10'>10 </option><option value='11'>11 </option><option value='12'>12 </option></select></td><td><input name='spent' type='text'  class='form-control input-md'  /> </td><td><input  name='desc' type='text'  class='form-control input-md'></td><td><input  name='attach' type='file'   class='form-control input-md'></td><td><input  name='msubmit' type='submit' value='OK' class='form-control input-md' style='background-color:#0070DF; color:#FFF'></td>");

      $('#myTable').append('<tr id="addr'+(i+1)+'"></tr>');
      i++; 
  });
     $("#delete_row").click(function(){
    	 if(i>1){
		 $("#addr"+(i-1)).html('');
		 i--;
		 }
	 });

});
</script>