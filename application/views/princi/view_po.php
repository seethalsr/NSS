<form id="frm" name="frm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table width="100%" height="100%" style="vertical-align:top;">
<tr><td width="29%" valign="top">
<?php if(isset($msg)){?>
<div class="w3-center" style="color:#FF8040; "><?php echo $msg; ?></div><?php }?>
<div class="w3-card"  >
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">LIST OF PROGRAM OFFICERS</b></h4>

<?php if(isset($user_type)&& ( $user_type=="assistant"||$user_type=="so" )){ ?>
<table cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr>
<td height="31"><span class="w3-center" ><?php if(isset($msg)){?>
<h6  style="color:#FF8040; "><?php echo $msg; ?></h6><?php }?></span></td></tr>
<tr><td>
<table cellpadding="0" cellspacing="0" width="100%" >
<tr>
<td width="15%" height="74"><label class=" control-label" >Select District</label></td>
<td width="2%"></td>
<td width="18%">
<select id="type" name="type" class="form-control" <?php if(isset($college_type)|| isset($msg)){ ?> onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option> 
<option value="1" <?php if(set_value("type")==1) echo "selected";?>>KASARGOD</option>
<option value="2" <?php if(set_value("type")==2) echo "selected";?>>KANNUR</option>
<option value="6" <?php if(set_value("type")==6) echo "selected";?>>WAYANAD </option>
</select>
</td>
<td width="3%"></td>
<td width="14%"><label class=" control-label" >Select College Name</label></td>
<td width="48%">
<select id="name" name="name" class="form-control" <?php if(isset($college_name)|| isset($msg)){ ?>onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($college_name_sel as $value): ?>
<option value="<?php echo $value['college_id'] ?>" 
<?php if(set_value("name")==$value['college_id']) echo "selected";?>> <?php echo $value['college_name'] ?></option>
<?php endforeach; ?>
</select>
</td>
</tr>
</table>
</td></tr>
</table>
<?php }?>

<table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>PO ID</th>
                          <th>PO NAME</th>
                          <th>DATE OF JOINING</th>
                          <th>NSS UNIT</th>
                          <th>BATCH PERIOD</th>
                          <th>VIEW</th>
                         <?php if($user_type=="principal"){?> <th>EDIT</th><?php }?>
                          <th>STATUS</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php if(isset($po_det)){foreach ($po_det as $value ){ ?>
                        <tr   class="wordbreak">
                          <td><?php echo $value['po_id'] ;?></td>
                          <td><?php echo $value['po_name'] ;?></td>
                          <td><?php echo date("d-m-Y", strtotime($value['po_join_date']));?></td>
                          <td><?php echo $value['nss_unit_id']; ?></td>
                          <td><?php echo $value['batch_period']; ?></td>
                          <td><a href="<?php echo base_url()?>Princi/NssPrinci/view_po_form?po_id=<?php echo $value['po_id']; ?> " >VIEW</a></td>
                          <?php if($user_type=="principal"){?>
                          <td><a href="<?php echo base_url()?>Princi/NssPrinci/edit_po_form?po_id=<?php echo $value['po_id']; ?>">EDIT</a></td><?php } ?>
                          <td><?php echo $value['po_status'] ;?></td>
                        </tr>                   
                       <?php }}?>
                      </tbody>
                    </table> 
					</div> 
</td></tr></table>
</form>