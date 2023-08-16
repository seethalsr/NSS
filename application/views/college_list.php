<?php //print_r($college_list);exit;?>
 <!-- Bootstrap -->
 <html>
 <head>
    
   

    <!-- Datatables sort -->
    <link href="<?php echo base_url();?>tab/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/w3.css" rel="stylesheet"> 
   
</head><body class="comm_fnt_web">

              <div class="col-md-12 col-sm-12 col-xs-12 " >
               
                   <h4 class="w3-center"><b>LIST OF COLLEGES </b></h4>
<hr />
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>Sl.No</th>
                          <th>College name</th>
                          <th>Address</th>
                          <th>Contact Number </th>
                          <th>Email</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $k=0;$i=0;foreach ($college_list as $value ){$i++; ?>
                      <?php if($k==0 || $k!=$value['college_district'] ){?>
                      <tr><td colspan="5" align="center" style="background-color:#C0C0C0;color:#000;">                      
                      DISTRICT:
                      <?php if($value['college_district']==1) echo 'KASARGOD';elseif($value['college_district']==2) echo 'KANNUR';elseif($value['college_district']==5) echo 'ALAPPUZHA';elseif($value['college_district']==6) echo 'WAYANAD';elseif($value['college_district']==10) echo 'PATHANAMTHITTA';?>
                    </td></tr>
                      <?php $k=$value['college_district'];} ?>
                        <tr   class="wordbreak">						
                          <td><?php echo $i;  ?></td>
                          <td><?php echo $value['college_name'] ?></td>
                          <td><?php echo ($value['college_address'].','.$value['college_pincode']) ?></td>
                          <td><?php echo $value['college_contact_no'].','.$value['college_contact_no2'] ?></td>
                          <td><?php echo $value['college_email'] ?></td>
                          
                          
						  
                        </tr>                   
                       <?php }?>
                      </tbody>
                    </table>
					</div>
           
        <!-- /page content -->

        
     
    <!-- jQuery need -->
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