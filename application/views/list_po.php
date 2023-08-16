    <link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/w3.css" rel="stylesheet"> 
	<body class="comm_fnt_web">
              <div class="col-md-12 col-sm-12 col-xs-12 " >
             
                   <h4 class="w3-center"><b>LIST OF PROGRAM OFFICERS</b></h4>
<hr />
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>Sl.No</th>
                          <th>PO Name</th>
                          <th>College</th>
                          <th>Unit</th>
						  <th>Total Volunteer</th>
                          <th>Contact Number</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $i=0;foreach ($po_list as $value ){$i++; ?>
                        <tr   class="wordbreak">
						
                          <td><?php echo $i;  ?></td>
                          <td><?php echo $value['po_name']; ?></td>
                          <td><?php echo $value['college_name']; ?></td>
                          <td><?php echo $value['nss_unit_id']; ?></td>
						   <td><?php echo $value['total_stud']; ?></td>
                          <td><?php echo $value['po_contact']; ?></td>
                        </tr>                   
                       <?php }?>
                      </tbody>
                    </table>
					 </div>

    <script src="<?php echo base_url();?>tab/js/jquery.min.js"></script>
    <!-- Bootstrap need -->
    <script src="<?php echo base_url();?>tab/js/bootstrap.min.js"></script>   
    <!-- Datatables -need-->
    <script src="<?php echo base_url();?>tab/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>tab/js/dataTables.bootstrap.min.js"></script><!--pagination- pointer not that mauch important-->
    <link href="<?php echo base_url();?>tab/css/bootstrap.min.css" rel="stylesheet">   
    <!-- Custom Theme Scripts need -->
    <script src="<?php echo base_url();?>tab/js/custom.min.js"></script>
   </body></html>