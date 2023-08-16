<table width="100%" cellpadding="0" cellspacing="0">
<tr><td><h4>View Program Officer Details</h4></td></tr>
<tr><td>PO ID</td>
<td>NAME</td>
<td>DATE OF JOIN</td>
</tr>
<?php foreach($po_data as $value){?>
<tr>
<td><?php echo $value['po_id']; ?>
</td>
<td><?php echo $value['po_name']; ?>
</td>
<td><?php echo date("d-m-Y", strtotime($value['po_join_date'])); ?>
</td>
<td><a href="<?php echo base_url()?>Princi/NssPrinci/view_po_form?po_id=<?php echo $value['po_id']; ?> ">VIEW</a>
</td>
</tr>
<?php }?>
</table>