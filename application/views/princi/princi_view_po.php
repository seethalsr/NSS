
<table width="100%" cellpadding="0" cellspacing="0" >
 <form name="frm1" id="frm1" method="post"  action="<?php echo base_url()?>Princi/Nssprinci/view_po" >

<!-- current PO-->  
  <tr>
  <td>
 <div class="model-content-mine" style="width:70%; ">
  	<div class="container">
	<div class="row">	
        
        <div class="col-md-12">
        <h4><span style="color:#903">Current Program Officers</span></h4>
        
        <div class="table-responsive">

		<table id="mytable" class="table table-bordred table-striped" style="width:70%">
         <thead>                   
           
           <th width="20%">PO ID</th>
           <th width="26%">Date Of Joining</th>
           <th width="42%">Name</th>                    
          <td width="2%"></thead>
          <tbody>
  <?php foreach( $cur_po as $value){?>
            
    <tr>
   
    <td><?php  echo $value['po_id']?></td>
    <td><?php  echo date("d-m-Y", strtotime($value['po_join_date']))?></td>
    <td><?php  echo $value['po_name']?></td>    
    </tr>
<?php }?>
</tbody>        
</table>

</div>
</div>
</div>
</div>
 </div>
  </td>
  </tr>
</form>
</table>

