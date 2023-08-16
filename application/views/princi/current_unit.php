<form name="frm2" id="frm2" method="post"  action="<?php echo base_url()?>Princi/Nssprinci/current_unit" >
 <table width="100%" height="100%" style="vertical-align:top;">
<tr><td width="29%" valign="top">
<?php if(isset($msg)){?>
<div class="w3-center" style="color:#FF8040; "><?php echo $msg; ?></div><?php }?>
<div class="w3-card"  >
<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">CURRENT ACTIVE NSS UNIT LIST </b></h4>
		<table width="100%" class="table table-bordred table-striped" id="mytable"  height="100%">
         <thead>                  
		  <th width="12%">Batch</th>
           <th width="11%"> UNIT</th>
           <th width="7%">PO ID</th> 
           <th width="25%">PO Name</th>  
		   <th width="11%">From Date</th> 
		   <th width="10%">To Date</th> 
           <th width="8%">Total Students enrolled</th>  
           <th width="8%">Unit Status</th>
		   <th width="7%">EDIT</th> 
                             
          <td width="1%"></thead>
          <tbody>
		 
  <?php  $i=0;foreach( $data as $value){?>
    <tr align="center">
    <td ><b><?php  echo $value['batch_period'];?></b></td>
	<td><b><?php  echo $value['nss_unit_id'];?></b></td>
    <td><b><?php  echo $value['po_id'];?></b></td>
    <td><b><?php  echo $value['po_name'];?></b></td>
	<td><b><?php  echo date("d-m-Y", strtotime($value['from_date']));?></b></td>
	<td><b><?php   echo date("d-m-Y", strtotime($value['to_date']));?></b></td>
    <td><b><?php  echo $value['total_stud'];?></b></td>
     <td><b><?php  echo $value['status'];?></b></td>
	<td><a href="<?php echo base_url('Princi/NssPrinci/edit_unit/'.$value['unit_id']); ?>"><button type="button" class="w3-button  w3-blue " ><span class="glyphicon glyphicon-pencil"></span> EDIT</button></a>
     </td>
    </tr>
<?php $i++;}?>
</tbody>        
</table>

</div>


</div></td></tr></table>
</form>