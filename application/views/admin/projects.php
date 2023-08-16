<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="form1" id="form1" class="card"  enctype="multipart/form-data" >
<div class="card" style="padding-bottom:20px;" >
<div class="w3-center"><?php if(isset($msg)){ echo $msg;}?></div>
<h4 align="center"><b style="text-decoration:underline;">MANAGE PROJECT LIST</b></h4>

<table cellpadding="0" cellspacing="0" width="100%">
<tr><td width="1%"></td><td colspan="3"><label for="head" class="form-control-label">Heading:(Max: 70 Characters)</label>
<textarea id="head_content" name="head_content" class="form-control"  style="resize:none;width:70%;" maxlength="70" ></textarea></td></tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr><td></td><td width="14%"><label for="head" >Upload:</label></td><td width="25%"><input  name="manual" type="file" /></td>
<td width="60%"><input type="submit" id="submit_proj" name="submit_proj" value="SUBMIT" /></td></tr>
</table>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 " >
  <div class="x_content">
<h4 align="center"><b style="text-decoration:underline;">PROJECTS LIST OF <?php echo date('Y');?></b></h4>
                    <table id="datatable" class="table table-striped table-bordered" width="100%">
                      <thead>
                        <tr>
						  <th width="4%">Sl.No</th>
                          <th width="23%">PROJECT ID</th>
                          <th width="21%">DATE OF PUBLISH</th>
                          <th width="52%">PROJECTS</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $value = ""; $i=0; if(isset($proj_detail)){{foreach ($proj_detail as $value ){ $i++; ?>
                        <tr   class="wordbreak">
                          <td><?php echo $i; ?></td>
                          <td><?php echo $value['project_id'];?></td>
                          <td><?php echo date("d-m-Y", strtotime($value['created_date']));?></td>
                          <td><a href="<?php echo base_url();?>upload/website/project/<?php echo $value['project_id'];?>.pdf" target="_blank"><?php echo $value['heading'];?></a></td>
                        </tr>                   
                       <?php }}}?>
                      </tbody>
                    </table>
  </div></div>

 </form>