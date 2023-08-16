 
<table width="100%" cellpadding="0" cellspacing="0" >

<!--instruction-->
<tr ><td><p><i style="color:#F00">
For instruction click here:</i> <a href="#" data-toggle="modal" data-target="#myModal">
<img border="0" alt="" src="<?php echo base_url();?>images/info.svg" width="30" height="40">
</a>
</p>
 <!-- Instruction Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">       
        <div class="modal-body">
          <ol style="color:#800000; display:block"><li>You can make current program officers inactive by putting checkmark to the corresponding checkbox and click on 'Make inactive' button.</li>
          <li>New Program Officer can be added by cliking on the 'Add new PO' button.</li></ol>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  </td></tr>
   <form name="frm1" id="frm1" method="post"  action="<?php echo base_url()?>Princi/Nssprinci/inactive_po" >
  <tr><td style="padding-bottom:20px;">
  
  </td></tr>
<!-- current PO-->  
  <tr>
  <td>
 <div class="model-content-mine" style="width:70%; ">
  	<div class="container">
	<div class="row">	
        
        <div class="col-md-12">
        <h4><span style="color:#903">Edit Unit</span></h4>
        
        <div class="table-responsive">

		<table id="mytable" class="table table-bordred table-striped" style="width:70%">
         <thead>                   
           
           <th width="20%">PO ID</th>
           <th width="26%">Date Of Joining</th>
           <th width="42%">Name</th> 
           <th width="42%">View</th>                    
          <td width="2%"></thead>
          <tbody>
  <?php foreach( $cur_po as $value){?>
            
    <tr>
    
    <td><?php  echo $value['po_id']?></td>
    <td><?php  echo date("d-m-Y", strtotime($value['po_join_date']))?></td>
    <td><?php  echo $value['po_name']?></td>
    <td><a href="<?php echo base_url()?>Princi/NssPrinci/view_po_form?po_id=<?php echo $value['po_id']; ?> ">VIEW</a></td>     
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
