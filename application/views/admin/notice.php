<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="form1" id="form1" class="card"  enctype="multipart/form-data" >
<div class="w3-center"><?php if(isset($msg)){ echo $msg;}?></div>
<?php if($user_type=="assistant"){?>
<div class="card" style="padding-bottom:20px;" >
<h4 align="center"><b style="text-decoration:underline;">MANAGE NOTICE BOARD</b></h4>
<table cellpadding="0" cellspacing="0" width="100%">
<tr><td></td>
<td width="14%">Notice No:</td><td width="29%"><input type="text" id="notice_id" name="notice_id"  class="form-control"
 title="Should not contain '\ / : * ? '' < > |"
 /></td>
<td width="10%">&nbsp;</td>
<td width="11%">Upload:</td><td width="33%"><input  name="manual" type="file" /></td></tr>
<tr>
  <td></td>
  <td colspan="2"><?php echo form_error('notice_id');?></td><td></td><td colspan="2"></td>
  <td></td>
</tr>
<tr><td width="1%"></td><td colspan="5">Heading:(Max: 70 Characters)
<textarea id="head_content" name="head_content" class="form-control"  style="resize:none;width:70%;" maxlength="70" ></textarea></td><td width="2%"></td></tr>
<tr><td colspan="6"><?php echo form_error('head_content'); ?></td></tr>
<tr><td colspan="6">&nbsp;</td></tr>
<tr><td colspan="6" align="center"><input type="submit" value="SUBMIT" name="submit_notice" class="w3-button  w3-green " /></td></tr>
</table>
</div>
<?php } ?>
<div class="col-md-12 col-sm-12 col-xs-12 " >
  <div class="x_content">
<h4 align="center"><b style="text-decoration:underline;">NOTIFICATION LIST OF <?php echo date('Y'); ?></b></h4>
                    <table id="datatable" class="table table-striped table-bordered" width="100%" align="center">
                      <thead>
                        <tr>
						  <th width="37">Sl.No</th>
                          <th width="186">Date of Publish</th>
                          <th width="247">NOTIFICATION No:</th>
                          <th width="659">Notification</th>
                          <th width="147">Display at Notice Board</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $value = ""; $i=0; if(isset($notification_data)){{foreach ($notification_data as $value ){ $i++; ?>
                        <tr   class="wordbreak">
                          <td><?php echo $i; ?></td>
                          <td><?php echo date("d-m-Y", strtotime($value['created_date']));?></td>
                          <td><?php echo $value['notice_no'];?></td>
                          <td><a href="<?php echo base_url();?>upload/website/notice/<?php echo $value['path'];?>.pdf" target="_blank" ><?php echo $value['heading'];?></a></td>
                          <td><input type="checkbox" id="chk[]" name="chk[]"  value="<?php echo $value['notice_no'];?>"  <?php if( $value['display']=="Y"){?>checked="checked"<?php } ?>/></td>
                        </tr>                   
                       <?php }}}?>
                      </tbody>
                    </table>
                   <div class="w3-center"> <?php if(isset($notification_data)&& !empty($notification_data)){ ?><input type="submit" name="update_chek" value="UPDATE" class="w3-button w3-blue " /><?php } ?></div>
  </div></div>

 </form>