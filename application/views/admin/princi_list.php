<?php //print_r($colge_list);exit;?>
<form id="frm" name="frm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<?php if(isset($princi_list)){?>
<table id="datatable"  height="100%" width="100%" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" >
<thead><tr>
<th>Sl.No:</th> 
<th>College Name</th>
<th>Principal Name</th>
<th>From Date</th>
<th>To Date</th>
<th>Details</th>
<th>Status</th>
</tr></thead>
<tbody>
<?php {$i=0; foreach($princi_list as $val){$i++; ?>
<tr>
<td><?php echo $i; ?></td> 
<td><?php echo $val['college_name']; ?></td>
<td><?php echo $val['principal_name']; ?></td>
<td><?php if($val['from_date'] && $val['to_date']!="1970-01-01" ) echo date('d-m-Y',strtotime($val['from_date'])); else echo ""; ?></td>
<td><?php if($val['to_date']=="0000-00-00" or $val['to_date']=="" ){ echo "";} else{ echo date('d-m-Y',strtotime($val['to_date']));} ?></td>
<td><?php if($val['principal_id']!=""){ ?><a href="<?php echo base_url();?>Admin/NssAdmin/princi_det/<?php echo $val['principal_id']; ?>" target="_blank">Details</a><?php } ?></td>
<td><?php if($val['principal_id']!="") echo "Active"; else echo "Inactive"; ?></td>
</tr>
<?php } }?>
</tbody>
</table>

<?php }  ?>

</form>

