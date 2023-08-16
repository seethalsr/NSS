<?php $po_id = $data['po_id']; ?>
<table width="100%" cellpadding="0" cellspacing="0">
<tr><td>Name of Program officer:</td><td><?php echo $data['po_name']; ?></td></tr>
<tr><td>gender:</td><td><?php echo $data['po_gender']; ?></td></tr>

<tr><td>Address:</td><td><?php echo $data['po_address']; ?></td></tr>
<tr><td>Contact:</td><td><?php echo $data['po_contact']; ?></td></tr>
<tr><td>Joining date:</td><td><?php echo $data['po_join_date']; ?></td></tr>
<tr><td>Photo Name:</td><td><?php echo $data['po_uploaded_img']; ?></td></tr>
<tr><td>Photo:</td><td><?php if(isset($data['po_uploaded_img'])) {?><img id="po_img"   src="<?php echo base_url("/PO/$po_id/photo.jpg");?>"/>
                              <?php }?></td></tr>

</table>