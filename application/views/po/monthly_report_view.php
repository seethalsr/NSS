<?php //print_r($monthly_rep_data);exit;?>
<table cellpadding="0" cellspacing="0"  width="100%" >
<tr ><td colspan="4" align="center"> <b>MONTHLY REPORT OF <span style="text-transform:uppercase;"><?php echo $month_sel;?></span> - <?php echo $yr_sel; ?></b></td></tr>
<tr ><td height="41" colspan="4" >&nbsp;</td>
</tr>
<?php if(!empty($monthly_rep_data)){
$cnt = 0;
 foreach($monthly_rep_data as $value){ $cnt++;?>
<tr >
<td colspan="4" align="center" style=" border-top: 1px solid black; border-bottom: 1px solid black;border-right:1px solid black;border-left:1px solid black;">[<?php echo $cnt;?>] -    <span style="text-transform:uppercase;padding-left:15px;"><?php echo $value['heading'];?></span></td>
</tr>
<tr ><td colspan="4" style=" border-top: 1px solid black; border-bottom: 1px solid black; border-left:1px solid black;border-right:1px solid black;">
<table cellpadding="0" cellspacing="2" width="100%">
<tr><td width="15%">Date</td><td width="2%">:</td><td width="83%" align="left">
<font face="Times New Roman, Times, serif"><?php echo date("d-m-Y", strtotime($value['from_date'])) ;?> to <?php echo date("d-m-Y", strtotime($value['to_date'])) ; ?></font></td></tr>
<tr><td>Description</td><td>:</td>
<td><font face="Times New Roman, Times, serif"><?php echo $value['content'];?></font></td>
</tr>
<?php if(!empty($value['image'])){ $img_arr = explode(",",$value['image']); $cnt = count($img_arr)-1;?>
<tr><td>Images</td><td>:</td><td>
<?php if($cnt==1){ ?>
<img src="<?php echo base_url();?>upload/po/col<?php echo $college_id;?>/<?php echo $monthly_rep_data[0]['batch_period'];?>/<?php echo $monthly_rep_data[0]['nss_unit'];?>/mon_rep/<?php echo date("d-m-Y", strtotime($value['from_date'])); ?>_<?php echo date("d-m-Y", strtotime($value['to_date'])); ?>_0.jpg" height="70px" width="100px;" />
<?php }else{ for($i=0;$i<=$cnt;$i++){ ?>
<img src="<?php echo base_url();?>upload/po/col<?php echo $college_id;?>/<?php echo $monthly_rep_data[$i]['batch_period'];?>/<?php echo $monthly_rep_data[$i]['nss_unit'];?>/mon_rep/<?php echo date("d-m-Y", strtotime($value['from_date'])); ?>_<?php echo date("d-m-Y", strtotime($value['to_date'])); ?>_<?php echo $i;?>.jpg" height="70px" width="100px;" />
<?php }} ?>
</td></tr><?php } ?>
</table>
</td>
</tr>
<?php }}else{?>
No Data found
<?php } ?>
</table>
