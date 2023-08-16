<table cellpadding="0" cellspacing="0" width="100%" border="1">
<tr><td align="center" colspan="2"><b>YEARLY REPORT OF <?php echo $year; ?></b></td></tr>
<?php if(isset($data_m_r)){
	$i=0;foreach($data_m_r as $value){$i++;?>
<?php if($i==1 or ($old_val== $value['college_id'])){ ?>
<tr><td><?php echo $i; ?></td><td align="center"><?php echo $value['college_name_for_gradecard']; ?></td></tr>
<tr><td colspan="2"><?php echo "BATCH"; echo $value['batch_period'];  echo "UNIT"; echo $value['nss_unit']; ?></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<?php $old_val = $value['college_id'];}else{ exit;} ?>
<?php } }else{ echo "NO DATA FOUND";} ?>


</table>
