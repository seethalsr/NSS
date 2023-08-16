<?php  print_r($princi_list);exit;?>
<link href="<?php echo base_url();?>tab/css/bootstrap.min.css" rel="stylesheet">   
<link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet">
<div class="w3-center" style="padding-bottom:20px">
    		<span ><?php if(isset($msg)){?><h6  style="color:#FF8040; "><?php echo $msg; ?></h6><?php }?></span><br>
	</div>
<div class="w3-center" style="padding-top:5px">
<span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">Assign/View Principal </span>
<hr>
</div>
<form id="frm" name="frm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<table cellpadding="0" cellspacing="0" width="100%" height="100%"  style="vertical-align:text-top">
<tr >
<td width="15%" height="74"><label class=" control-label" >Select College Type</label></td>
<td width="2%"></td>
<td width="18%">
<select id="type" name="type" class="form-control" <?php if(isset($college_type)|| isset($msg)){ ?>onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($college_type as $value1): ?>
<option value="<?php echo $value1['college_type']; ?>" 
<?php if(set_value("type")==$value1['college_type']) echo "selected";?>> <?php echo $value1['college_type']; ?></option>
<?php endforeach; ?>
</select></td>
<td width="3%"></td>
<td width="14%"><label class=" control-label" >Select College Name</label></td>
<td width="48%">
<select id="name" name="name" class="form-control" <?php if(isset($college_name)|| isset($msg)){ ?>onchange="this.form.submit()"<?php } ?>>
<option value="">---Select---</option>
<?php foreach ($college_name_sel as $value): ?>
<option value="<?php echo $value['college_id']; ?>" 
<?php if(set_value("name")==$value['college_id']) echo "selected";?>> <?php echo $value['college_name']; ?></option>
<?php endforeach; ?>
</select></td>
</tr>
<tr ><td colspan="6"></td></tr>
<tr valign="top" >
<td colspan="3">&nbsp; </td>
<td colspan="2" >
<?php if(isset($princi_list) && (empty($princi_list)||$todate == 0)){ ?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#NewPrinci" >Add New Principal</button>
<div class="modal fade" id="NewPrinci" tabindex="-1" role="dialog" aria-labelledby="NewPrinciLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Principal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>        </button>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
            <label for="txt1" class="form-control-label">Name:</label>
            <input type="text" class="form-control input-sm" id="txt1" name="txt1"  value="<?php echo set_value("txt1");?>" autocomplete="off">
            <span style="color:#F00;" ><?php echo form_error('txt1'); ?></span>          </div>
           <div class="form-group">
            <label for="txt2" class="form-control-label">Email:</label>
            <input type="text" class="form-control input-sm" id="txt2" name="txt2"  value="<?php echo set_value("txt2");?>" autocomplete="off">
            <span style="color:#F00;" ><?php echo form_error('txt2'); ?></span>          </div>
           <div class="form-group">
            <label for="txt3" class="form-control-label">Mobile No:</label>
            <input type="text" class="form-control input-sm" id="txt3" name="txt3"  maxlength="10" value="<?php echo set_value("txt3");?>" autocomplete="off" onKeyPress="return input_number(event)">
            <span style="color:#F00;" ><?php echo form_error('txt3'); ?></span>          </div>           
          <div class="form-group">
            <label for="txt4" class="form-control-label">Address:</label>
            <textarea class="form-control" id="txt4" name="txt4" ></textarea>
            <span style="color:#F00;" ><?php echo form_error('txt4'); ?></span>          </div>
           <div class="form-group">
            <label for="txt5" class="form-control-label">Pincode:</label>
            <input type="text" class="form-control" id="txt5" name="txt5" maxlength="6" value="<?php echo set_value("txt5");?>" autocomplete="off" onKeyPress="return input_number(event)">
            <span style="color:#F00;" ><?php echo form_error('txt5'); ?></span>          </div>
          <div class="form-group">
            <label for="txt6" class="form-control-label">Gender:</label>
            
        		<label class="radio-inline" for="radios-0">
       			<input type="radio" name="radios" id="radios-0" value="M" checked="checked">
       			MALE      			 </label> 
      			<label class="radio-inline" for="radios-1">
     			 <input type="radio" name="radios" id="radios-1" value="F">
      			FEMALE      			</label>
          </div>
          <div class="form-group">
            <label for="txt7" class="form-control-label">Join Date:</label>
            <input type="text" class="form-control input-sm datepicker" id="txt7" name="txt7" maxlength="10" value="<?php echo set_value("txt7");?>" autocomplete="off" onkeypress="return input_date(event)" />
            <span style="color:#F00;" ><?php echo form_error('txt7'); ?></span>          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="w3-button  w3-left w3-red " data-dismiss="modal">Close</button>
        <input type="submit" class="w3-button w3-right  w3-green " name="submitp" id="submitp" value="Submit"/>
      </div>
    </div>
  </div>
</div>  
<?php } ?></td>
<td >&nbsp;</td>
</tr>
</table>


<?php if(isset($princi_list) && !empty($princi_list)){?>
<table id="datatable"  height="100%" width="100%" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" style="padding-top:20px; margin-top:20px">
                      <thead>
                        <tr>
						  <th width="6%">College Code</th>
						  <th width="16%">College name</th>
                          <th width="12%">Principal name</th>                          
                          <th width="14%">Principal Contact</th>
                          <th width="15%">Principal Address </th>
                          <th width="12%">Principal Email</th>
						  <th width="9%">From Date</th>
                          <th width="16%">To Date</th>                                                   
                        </tr>
                      </thead>
                       <tbody>
					  <?php foreach ($princi_list as $value ){ ?>
                        <tr   class="wordbreak">						
                          <td><?php echo $value['college_code']; ?></td>
						  <td><?php echo $value['college_name']; ?></td>
                          <td><?php echo $value['principal_name']; ?></td>                         
                          <td><?php echo $value['principal_contact'];?></td>
                          <td><?php echo $value['principal_address']; ?></td>
                          <td><?php echo $value['principal_email']; ?></td>
                           <td><?php if($value['from_date']!= '0000-00-00'){ echo date("d-m-Y", strtotime($value['from_date']));}?></td>
                            <td><?php if($value['to_date']!= '0000-00-00'){ echo date("d-m-Y", strtotime($value['to_date']));}
							else{ ?>
							<a href=""  data-toggle="modal" data-target="#EditPrinci" >
                            <img border="0" alt="" src="<?php echo base_url();?>images/edit.svg" width="30" height="40">
                            </a>	
							<div class="modal fade" id="EditPrinci" tabindex="-1" role="dialog" aria-labelledby="NewPrinciLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add  Principal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
            <label for="txt9" class="form-control-label">Name:</label>
            <input type="text" class="form-control input-sm" id="txt9" name="txt9" readonly="readonly"  value="<?php echo $value['principal_name'] ?>" autocomplete="off">
          <input type="text" id="txt10" name="txt10" class="w3-hide"  value="<?php echo $value['principal_id']; ?>"/> 
          </div>
          
          <div class="form-group">
            <label for="txt8" class="form-control-label">To Date:</label>
            <input type="text" class="form-control input-sm datepicker" id="txt8" name="txt8" maxlength="10" value="<?php echo set_value("txt8");?>" autocomplete="off" onkeypress="return input_date(event)">
            <span style="color:#F00;" ><?php echo form_error('txt8'); ?></span>
          </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="w3-button  w3-red w3-left "data-dismiss="modal">Close</button>
        <input type="submit"  class="w3-button w3-right w3-green " value="Save"  name="submite" id="submite"/>
		
      </div>
    </div>
  </div>
</div>	
							<?php } ?></td>
                         </tr>
                            <?php } ?>
    </tbody>
  </table>
            <?php } ?>   
			
   
</form>                  			  
    <!-- jQuery need -->
    <script src="<?php echo base_url();?>tab/js/jquery.min.js"></script>
    <!-- Bootstrap need -->
    <script src="<?php echo base_url();?>tab/js/bootstrap.min.js"></script>   
    <!-- Datatables -need-->
    <script src="<?php echo base_url();?>tab/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>tab/js/dataTables.bootstrap.min.js"></script><!--pagination- pointer not that mauch important-->
    <!-- Custom Theme Scripts need -->
    <script src="<?php echo base_url();?>tab/js/custom.min.js"></script>