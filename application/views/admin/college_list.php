
<div class="w3-center" style="padding-bottom:20px">
    		<span ><?php if(isset($msg)){?><h6  style="color:#FF8040; "><?php echo $msg; ?></h6><?php }?></span><br>
        	<span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">COLLEGES LIST</span>
	</div>


<table id="datatable"   width="100%" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" style="padding-top:20px; margin-top:20px">
                      <thead>
                        <tr>
						  <th width="3%">Sl.No:</th>
						 
                          <th width="31%">College name</th>                          
                          <th width="12%">Address</th>
                          <th width="15%">Contact Number </th>
                          <th width="15%">Email</th>
						  <th width="12%">District</th>
              
</tr>

                                                   


                                      
</tr> 
                      </thead>
                      <tbody>
					  <?php $i=0; //var_dump($college_list);
             foreach ($college_list as $value ){$i++; ?>
                        <tr   class="wordbreak">
						
                          <td><?php echo $i; ?></td>
						 
                          <td><?php echo $value['college_name']; ?></td>
						  <td><?php echo ($value['college_address'].','.$value['college_pincode']); ?></td>
                          <td><?php echo $value['college_contact_no'].','.$value['college_contact_no2']; ?></td>
                          <td><?php echo $value['college_email']; ?></td>
                          <td><?php if( $value['college_district']==1) echo 'KASARGOD'; 
						  elseif($value['college_district']==2) echo 'KANNUR';
						   elseif($value['college_district']==3) echo 'WAYANAD' ;
               
						    //elseif($value['college_district']==6) echo 'IDUKKI';
							 //elseif($value['college_district']==10) echo 'PATHANAMTHITTA'; ?></td>
               

                          
                        </tr>  
                                         
                       <?php }?>
                      </tbody>
                    </table>
					
				