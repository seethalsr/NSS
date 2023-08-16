<link rel="stylesheet" href="<?php echo base_url();?>css/w3.css">
<?php $po_id = $data['po_id']; 

$ext = substr($data['po_uploaded_img'],strpos($data['po_uploaded_img'], ".") + 1);//echo $ext;exit; ?>
<div style="padding-left:20%">

 <div class="w3-card-2 w3-round  w3-light-grey w3-twothird" >
        <div class="w3-container">
         <h4 class="w3-center" style="text-transform:uppercase;"> PROFILE OF <?php echo $data['po_name']; ?></h4>
         <hr>
         <div style="padding-top:15px;">
         <p class="w3-right w3-round"><?php if(isset($data['po_uploaded_img'])) {?>
         <img id="po_img"   src="<?php echo base_url();?>/upload/princi/col<?php echo $data['college_id']; ?>/poimage/<?php echo preg_replace('#[^\pL\pN/-]+#', '',$data['po_email']) ;?>.<?php echo $ext; ?>"/>
         <?php }?></p>
         <div class="w3-col s8">
         <table width="100%" cellpadding="0" cellspacing="0">
         <tr><td width="32%" height="25">Gender </td><td width="9%">:</td><td width="59%" class="w3-left w3-text-theme"><?php $val= $data['po_gender']; 
		 if($val=='M') echo "Male"; else echo "Female";
		 ?></td></tr>
         <tr><td height="32">Email ID</td><td>:</td><td class="w3-left w3-text-theme wordbreak"><?php echo $data['po_email']; ?></td></tr>
         <tr><td height="31">Contact Number</td><td>:</td><td class="w3-left w3-text-theme"><?php echo $data['po_contact']; ?></td></tr>
         <tr><td height="28">Joined Date</td><td>:</td><td class="w3-left w3-text-theme"><?php echo date("d-m-Y", strtotime($data['po_join_date'])); ?></td></tr>
         <tr><td height="32">Address</td><td>:</td><td class="w3-left w3-text-theme wordbreak" ><?php echo $data['po_address']; ?></td></tr>
         <tr><td height="34">Pincode:</td><td>:</td><td class="w3-left w3-text-theme" ><?php echo $data['po_pin'] ?></td></tr>
         </table>
 </div>
</div>
</div>
</div>
</div>