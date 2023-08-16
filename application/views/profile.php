<script>
$(document).ready(function () {
		$(".flip").click(function () {
        $(this).next('.panel').slideToggle("slow").siblings('.panel').slideUp("slow");
	});
});
</script>
<?php if(isset($po_det)){ $po_id = $po_det['po_id']; //print_r($po_det);exit;
$ext = substr($po_det['po_uploaded_img'],strpos($po_det['po_uploaded_img'], ".") + 1);}//echo $ext;exit; ?>
<!--contant body-->

<div class="card" >
<h4 align="center"><b style="text-decoration:underline; color:#3b579d;">PROFILE</b></h4>
<table cellpadding="0" cellspacing="0" width="100%" align="center" >
<tr><td width="18%"></td>
<td width="64%"  >
<table width="100%"  bordercolor="#CCCCCC"  >
<tr><td colspan="7" align="center"><span  style="text-transform:uppercase; font-weight:bold; font-size:24px"><?php echo $name;?></span><hr /></td></tr>
<tr><td colspan="7"></td></tr>
<tr><td width="11"></td><td width="188"><span  style=" font-weight:bold; font-size:14px">DESIGNATION</span></td>
<td width="10">:</td>
<td width="248"><?php if($user_type=="po"){?>PROGRAM OFFICER<?php }elseif($user_type=="principal" || $user_type=="admin" ){ ?>PRINCIPAL<?php } ?></td>
<td width="76"></td>
<td width="222" rowspan="8"></td>
<td width="47" rowspan="8">
<p class="w3-right w3-round">&nbsp;</p>
</td></tr>
<?php if($user_type=="po"){?><tr><td></td><td><span  style=" font-weight:bold; font-size:14px">PO ID:</span></td><td>:</td><td><?php echo $po_det['po_id'] ;?></td>
  <td></td>
  </tr><?php } ?>
<tr><td></td><td><span  style=" font-weight:bold; font-size:14px">JOINED DATE:</span></td><td>:</td><td>
<?php if($user_type=="po") {echo date("d-m-Y", strtotime($po_det['po_join_date']));} elseif($user_type=="principal" || $user_type=="admin"){ echo date("d-m-Y", strtotime($princi_det['from_date'])) ;}?></td>
  <td></td>
  </tr>
<tr><td></td>
<td><span  style="font-weight:bold; font-size:14px">CONTACT NUMBER </span></td>
<td>:</td><td><?php if($user_type=="po"){ echo $po_det['po_contact'];} elseif($user_type=="principal" || $user_type=="admin") {echo $princi_det['principal_contact'];}?></td>
<td></td>
</tr>
<tr><td></td>
<td><span  style=" font-weight:bold; font-size:14px">EMAIL ID</span> </td>
<td>:</td><td><?php if($user_type=="po") {echo $po_det['po_email']; }elseif($user_type=="principal"|| $user_type=="admin") {echo $princi_det['principal_email'];}?></td>
<td></td>
</tr>
<tr><td></td><td><span style=" font-weight:bold; font-size:14px">NSS UNIT:</span></td>
<td>:</td><td><?php if($user_type=="po") {echo $po_det['nss_unit_id'];} elseif($user_type=="principal"|| $user_type=="admin") {echo $princi_det['unit'];}?></td>
<td></td>
</tr>
<tr><td></td><td><span style=" font-weight:bold; font-size:14px">BATCH ALLOTTED</span></td>
<td>:</td><td><?php if($user_type=="po") {echo $po_det['batch_period']; }elseif($user_type=="principal"|| $user_type=="admin") {echo $princi_det['batch_period'];}?></td>
<td></td>
</tr>
<tr><td></td><td><span style=" font-weight:bold; font-size:14px">TOTAL NO: OF STUDENTS IN UNIT</span></td>
<td>:</td><td><?php if($user_type=="po") {echo $po_det['total_stud'];} elseif($user_type=="principal"|| $user_type=="admin") {echo $princi_det['total_stud'];}  ?></td>
<td></td>
</tr>
<tr><td colspan="7">&nbsp;</td></tr>
<tr><td colspan="7">&nbsp;</td></tr>
</table>
</td><td width="18%"></td>
</tr>
</table>
<?php if($user_type=="principal"){ ?>
<div id="mySidenav" class="sidenav">
<a href="<?php echo base_url();?>Princi/NssPrinci/add_new_prin" id="frontimage">ADD NEW PRINCIPAL</a>
</div>
<?php }?>
</div>
