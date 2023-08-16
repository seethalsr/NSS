<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css">  
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script>
<script type="text/javascript"> 
$(function() {
   $( "#fromdate" ).datepicker({
	   dateFormat: 'dd-mm-yy' 
	   });
	   $( "#todate" ).datepicker({
	   dateFormat: 'dd-mm-yy' 
	   });
 
});
</script>

 <?php  $after2yr = date('Y') + 2;//echo $after2yr;exit; ?>
 <form name="frm1" id="frm1" method="post"  action="<?php echo base_url()?>Princi/NssPrinci/create_unit" >
 <?php if(isset($msg)){?><a class="w3-center" style="color:#F00; "><?php echo $msg; ?></a><?php }?>
 <table width="100%" height="100%" style="vertical-align:top;">
<tr><td width="29%" valign="top">

<div class="w3-card"  >
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">Create New NSS Unit  </b></h4>
<table width="100%" height="100%" cellpadding="0" cellspacing="0">
  <tr>
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
		  <td width="7%"><div class="form-group ">
              <label for="name">Batch<a style="color:#FF0000;font-size:18px;">*</a> </label>
          </div></td>
		  <td width="12%"><div class="form-group ">
		  <select id="batch" name="batch" class="form-control" onchange="this.form.submit()" >
              <option value="">--Select--</option>  			            
			<!-- <option value="2016-2018" <?php if(isset($sel_batch) && $sel_batch == "2016-2018") echo "selected";?>> <?php echo "2016-2018"; ?>--></option> 			<option value="2017-2019" <?php if(isset($sel_batch) && $sel_batch == "2017-2019") echo "selected";?>> <?php echo "2017-2019"; ?></option>
           	<!--<option value="2018-2020" <?php if(isset($sel_batch) && $sel_batch == "2018-2020") echo "selected";?>> <?php echo "2018-2020"; ?></option>-->
</select>
		  </div></td>
		  <td width="1%"></td>
          <td width="26%" align="left"><div class="form-group ">
          <?php /*?>  <input type="submit" class="btn btn-primary" value="Create" name="submit5" id="submit5" style="background-color:#0070DF; color:#FFF"/><?php */?>
          </div> </td>
          <td width="1%"></td>
        </tr>
        <tr>
          <td colspan="3"><span style="color:#F00;"><?php echo form_error('txt3'); ?></span></td>
         
          <td>&nbsp;</td>
          <td colspan="2"><span style="color:#F00;"><?php echo form_error('fromdate'); ?></span> </td>
          
          <td></td>
          
          <td colspan="2"><span style="color:#F00;"><?php echo form_error('todate'); ?></span></td>
          <td></td>
          <td colspan="2"><span style="color:#F00;"><?php echo form_error('batch'); ?></span></td>
		  <td></td>
        </tr>
    </table>
      
      <h4 align="center"><b style="text-decoration:underline;color:#3b579d;">Current Active Program Officer <?php echo date('Y'). '-'. $after2yr ;?> </b></h4>
        <div class="table-responsive" style="padding-left:15px;padding-right:15px; padding-bottom:15px;">

		<table id="mytable" cellpadding="0" cellspacing="0" height="100%" width="100%" border="2">
         <thead>                   
           <th width="15%">PO ID</th>
           <th width="22%">Date Of Joining</th>
           <th width="63%">Name</th>                              
          <tbody>
  <?php foreach( $data as $value){ ?>
    <tr align="center" >
    <td><b><?php  echo $value['po_id'];?></b></td>
    <td><b><?php  echo date("d-m-Y", strtotime($value['po_join_date']));?></b></td>
    <td><b><?php  echo $value['po_name'];?></b></td>    
    </tr>
<?php }?>
</tbody>        
</table>
</div>
</div></td></tr></table>
 </form>