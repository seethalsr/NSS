<?php //print_r($yr_rep_data);exit;?>
<table cellpadding="0" cellspacing="0"  width="100%">
<tr ><td colspan="3" align="center"> <b>YEARLY REPORT OF <?php echo $yr_sel; ?></b></td></tr>
<tr ><td colspan="3" >&nbsp;</td></tr>
<?php if(!empty($months_in_array)){foreach($months_in_array as $value){?>
<tr><td colspan="3" align="center" style="border: 1px solid black;"><span style="text-transform:uppercase;"><b><?php  echo date('F', mktime(0, 0, 0, $value, 10)); ?></b></span></td></tr>
<?php $k=0;foreach($yr_rep_data as $val1){
	if($val1['month']== $value){?>
<tr align="center" >
<td  rowspan="3" style=" border-left: 1px solid black; border-bottom: 1px solid black;border-right: 1px solid black;"> <div class="w3-center"><?php echo date("d-m-Y", strtotime($val1['from_date']));?> to <?php echo date("d-m-Y", strtotime($val1['to_date']));?></div> </td>
<td align="center" colspan="2" style="border-bottom: 1px solid black;border-right: 1px solid black;"><span style="text-transform:uppercase; font:Georgia, 'Times New Roman', Times, serif;"><?php echo $val1['heading']; ?></span></td>
</tr>
<tr><td  colspan="2" style="border-right: 1px solid black; font:Georgia, 'Times New Roman', Times, serif;  ">  <?php echo $val1['content'];?></td>
</tr>

<tr><td align="justify" colspan="2" style="border-bottom: 1px solid black;border-right: 1px solid black;">
<?php if(!empty($val1['image'])){ $img_arr = explode(",",$val1['image']); $cnt = count($img_arr)-1;?>
<?php if($cnt==1){ ?>

<img src="<?php echo base_url();?>upload/po/col<?php echo $college_id;?>/<?php echo $yr_rep_data[$k]['batch_period'];?>/<?php echo $yr_rep_data[$k]['nss_unit'];?>/mon_rep/<?php echo date("d-m-Y", strtotime($val1['from_date'])); ?>_<?php echo date("d-m-Y", strtotime($val1['to_date'])); ?>_0.jpg" height="70px" width="100px;" />
<?php }else{ for($i=0;$i<=$cnt;$i++){?>
<img src="<?php echo base_url();?>upload/po/col<?php echo $college_id;?>/<?php echo $yr_rep_data[$i]['batch_period'];?>/<?php echo $yr_rep_data[$i]['nss_unit'];?>/mon_rep/<?php echo date("d-m-Y", strtotime($val1['from_date'])); ?>_<?php echo date("d-m-Y", strtotime($val1['to_date'])); ?>_<?php echo $i;?>.jpg" height="70px" width="100px;" />
<?php }} ?>
<?php } ?>
</td></tr>
<?php $k++;}}}}else{?>
No Data Found
<?php } ?>
</table>
