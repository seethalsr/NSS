
<?php $after2yr = date('Y') + 2;//echo $after2yr;exit; ?>
<table cellpadding="0" cellspacing="0" height="100%" width="100%">
<tr><td><span ><?php if(isset($msg)){?><h6  style="color:#FF8040; "><?php echo $msg; ?></h6><?php }?></span><br></td></tr>
<tr><td class="w3-center"><span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">Create New NSS Unit For Bacth <?php echo date('Y'). '-'. $after2yr ;?> </span></td></tr>
<tr><td>&nbsp </td></tr>
<tr><td>
 <form name="frm1" id="frm1" method="post"  action="<?php echo base_url()?>Princi/Nssprinciunit/create_unit" >
      <table width="100%" height="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td width="1%"></td>
          
          <td width="1%"></td>
          <td width="14%"><div class="form-group ">
              <label for="mobile">Program Officer ID<a style="color:#FF0000;font-size:18px;">*</a></label>
          </div></td>
          <td width="9%"><div class="form-group ">
            <input type="text" class="form-control input-sm" id="txt3" size="10"  name="txt3" autocomplete="off" onkeypress="return input_number(event)" value="<?php echo set_value("txt3");?>" />
          </div></td>
          <td width="1%"></td>
          <td width="8%"><div class="form-group ">
              <label for="name">From Date <a style="color:#FF0000;font-size:18px;">*</a> </label>
          </div></td>
          <td width="8%"><div class="form-group "><input type="text" class="form-control input-sm " id="fromdate"  size="10" name="fromdate" value="<?php echo set_value("fromdate");?>"  maxlength="10" autocomplete="off" onkeypress="return input_date(event)" /></div></td>
		  <td width="1%"></td>
          <td width="7%"><div class="form-group ">
              <label for="name">To date <a style="color:#FF0000;font-size:18px;">*</a> </label>
          </div></td>
          <td width="12%"><div class="form-group "><input type="text" class="form-control input-sm datepicker" id="todate" name="todate"  size="10" value="<?php echo set_value("todate");?>"  maxlength="10" autocomplete="off" onkeypress="return input_date(event)"></div></td>
          <td width="1%"></td>
          <td width="26%" align="left"><div class="form-group ">
            <input type="submit" class="btn btn-primary" value="Submit" name="submit5" id="submit5" style="background-color:#0070DF; color:#FFF"/>
          </div> </td>
          <td width="1%"></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
         
          <td><span style="color:#F00;"><?php echo form_error('txt3'); ?></span></td>
          <td> </td>
          <td ></td>
          <td><span style="color:#F00;"><?php echo form_error('fromdate'); ?></span></td>
          <td></td>
          <td></td>
          <td><span style="color:#F00;"><?php echo form_error('todate'); ?></span></td>
          <td colspan="2"></td>
        </tr>
      </table>
    </form>
</td></tr>
<tr><td></td></tr>
<tr><td class="w3-center"><span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">Current Active Program Officer</span></td></tr>
<tr><td>&nbsp</td></tr>
<tr><td>
  <div class="table-responsive">

		<table id="mytable" class="table table-bordred table-striped" cellpadding="0" cellspacing="0" height="100%" width="100%">
         <thead>                   
           
           <th width="20%">PO ID</th>
           <th width="26%">Date Of Joining</th>
           <th width="42%">Name</th>                              
          <td width="2%"></thead>
          <tbody>
  <?php foreach( $data as $value){ ?>
            
    <tr>
    
    <td><?php  echo $value['po_id']?></td>
    <td><?php  echo date("d-m-Y", strtotime($value['po_join_date']))?></td>
    <td><?php  echo $value['po_name']?></td>    
    </tr>
<?php }?>
</tbody>        
</table>

</div>
</td></tr>
</table>










