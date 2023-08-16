 <link href="<?php echo base_url();?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
 <link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css">  
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script>
<script type="text/javascript"> 
$(function() {
	
	 $(document).on('focus', '.datepicker',function(){
            $(this).datepicker({
                todayHighlight:true,
                format:'yyyy-mm-dd',
                autoclose:true
            })
        });
 
 
});
</script> 

<link rel="stylesheet" href="<?php echo base_url();?>css/w3.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/w3-theme-blue-grey.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/w3.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/w3-theme-blue-grey.css">
<h4 align="center"><b style="text-decoration:underline; color:#3b579d;">EDIT SELECTED STUDENTS</b></h4>
<form name="frm1" id="frm1" method="post"   action="<?php echo base_url(); ?>Po/NssPo/edit_elig" >

<br /></br>
<?php if(isset($elig)&&!empty($elig)&& $elig[0]['elig_chk']<>'Y'){ ?>
<table class="table  table-bordered dt-responsive  dataTable"  border="1"   >
                      <thead>
                        <tr>
						  <th  >Sl No.</th>
						  <th  >PRN No.</th>
        				  <th  >Name</th>
                           <th >Reservation</th>
						  <th  >Gender</th>
                          <th  >Admission Year</th> 
						  <th  >Name of the Programme  with Specialisation/Major Subject</th>
                         <th  >Enroll Start Date</th>
                         <th  >Enroll End Date</th>
                         <th  >Mini Camp 1</th>
                         <th  >Mini Camp 2</th>
                         <th  >Special Camp </th>
                         <th  >Special Camp Start Date</th>
                         <th  >Special Camp End Date</th>
                          <th  >Special Camp Desination</th>
                         <th  >Total Hours</th>
                                          
					 </tr>
                      </thead>
                      <tbody>
					  <?php if(isset($elig)){for ( $i=0;$i<count($elig);$i++ ){
						  //print_r($elig);exit;  ?>
                        <tr >
                        
                        
						 <td><?php  echo $i+1; ?> <input type="hidden" value="<?php echo count($elig);?>" id="cc" name="cc" /></td>
                         <td>
                         <input type="hidden" value="<?php echo $elig[$i]['nss_stud_id'];?>" id="nss_stud_id.<?php echo $i; ?>" name="nss_stud_id.<?php echo $i; ?>" />
                         <input type="number" id="prn" name="prn.<?php echo $i; ?>"  value="<?php echo $elig[$i]['account_id'];?>" /></td>
                          <td><input type="text" id="name" name="name.<?php echo $i; ?>" value="<?php echo $elig[$i]['account_student_name'];?>" /></td>
						 
                          <td>
						   <select id="cast" name="cast.<?php echo $i; ?>" class="form-control"   >
              			   <option value="">--Select--</option>  			            
			 	    	   <option value="OBC" <?php if( $elig[$i]['cast'] == "OBC") echo "selected";?>
                            
                           > <?php echo "OBC"; ?></option>
						   
						   <option value="Scheduled Castes(SC)" <?php if(  $elig[$i]['cast'] == "Scheduled Castes(SC)") echo "selected";?>> <?php echo "Scheduled Castes(SC)"; ?></option>
						   <option value="Scheduled Tribes(ST)" <?php if(  $elig[$i]['cast'] == "Scheduled Tribes(ST)") echo "selected";?>> <?php echo "Scheduled Tribes(ST)"; ?></option>
						   <option value="General Category" <?php if(  $elig[$i]['cast'] == "General Category") echo "selected";?>> <?php echo "General Category"; ?></option>
						  
						             	 
						</select>
						  </td>
						  <td> 
						    <select id="gender" name="gender.<?php echo $i; ?>" class="form-control"   >
              			   <option value="">--Select--</option>  			            
			 	    	   <option value="F" <?php if(  $elig[$i]['gender'] == "F") echo "selected";?>> <?php echo "FEMALE"; ?></option>
						   <option value="M" <?php if(  $elig[$i]['gender'] == "M") echo "selected";?>> <?php echo "MALE"; ?></option>
						   <option value="O" <?php if( $elig[$i]['gender'] == "O") echo "selected";?>> <?php echo "OTHER"; ?></option>
						   </select>
						  </td>
                          
						  <td> 
						  <select id="admyear" name="admyear.<?php echo $i; ?>" class="form-control"  >
              			   <option value="">--Select--</option>  
                           <option value="2016" <?php if(  $elig[$i]['admission_year'] == "2016") echo "selected";?>> <?php echo "2016"; ?></option>		            
			 	    	   <option value="2017" <?php if(  $elig[$i]['admission_year'] == "2017") echo "selected";?>> <?php echo "2017"; ?></option>
						   <option value="2018" <?php if( $elig[$i]['admission_year'] == "2018") echo "selected";?>> <?php echo "2018"; ?></option>
						   </select>
						  </td>
                           <td><input type="text" id="spl" name="spl.<?php echo $i; ?>" value="<?php echo $elig[$i]['specialisation_id'];?>"  /></td>
                          <td><input type="text" class="form-control datepicker" name="enrolled_date.<?php echo $i; ?>"  autocomplete="off" placeholder="MM/DD/YYYY"
                          value="<?php echo $elig[$i]['enrolled_date'];?>" />
                        </td>
                          <td><input type="text" class="form-control datepicker"  name="enroll_end.<?php echo $i; ?>" autocomplete="off" placeholder="MM/DD/YYYY"
                          value="<?php echo $elig[$i]['enroll_end'];?>"	 /></td>
                         
						  <td> 
                           <select id="mini1" name="mini1.<?php echo $i; ?>" class="form-control"   >
              			   <option value="">--Select--</option>  			            
			 	    	   <option value="YES" <?php if( $elig[$i]['mini1'] == "YES") echo "selected";?>> <?php echo "YES"; ?></option>
						   <option value="NO" <?php if(  $elig[$i]['mini1'] == "NO") echo "selected";?>> <?php echo "NO"; ?></option> 						   						</select>
                          </td>
                          <td> 
                          
                          <select id="mini2" name="mini2.<?php echo $i; ?>" class="form-control"   >
              			   <option value="">--Select--</option>  			            
			 	    	   <option value="YES" <?php if( $elig[$i]['mini2'] == "YES") echo "selected";?>> <?php echo "YES"; ?></option>
						   <option value="NO" <?php if( $elig[$i]['mini2']== "NO") echo "selected";?>> <?php echo "NO"; ?></option> 						   						</select>
                          </td>
						    <td> 
                            
                            <select id="splcamp" name="splcamp.<?php echo $i; ?>" class="form-control"   >
              			   <option value="">--Select--</option>  			            
			 	    	   <option value="YES" <?php if(  $elig[$i]['splcamp'] == "YES") echo "selected";?>> <?php echo "YES"; ?></option>
						   <option value="NO" <?php if(  $elig[$i]['splcamp']== "NO") echo "selected";?>> <?php echo "NO"; ?></option> 						   						</select>
                            </td>
                             <td> <input type="text" class="form-control datepicker "  name="splcamp_start.<?php echo $i; ?>"   autocomplete="off"	placeholder="MM/DD/YYYY" value="<?php echo $elig[$i]['splcamp_start'];?>"  />
                              </td>
                              <td> <input type="text" class="form-control datepicker "  name="splcamp_end.<?php echo $i; ?>"   autocomplete="off"	placeholder="MM/DD/YYYY" value="<?php echo $elig[$i]['splcamp_end'];?>" />
                               </td>
                               <td> <input type="text" id="spl_desti" name="spl_desti.<?php echo $i; ?>"  value="<?php echo $elig[$i]['spl_desti'];?>" /> </td>
                            
                          <td><input type="number" id="tot_hr" name="tot_hr.<?php echo $i; ?>"  value="<?php echo $elig[$i]['tot_hr'];?>" /></td>
                          
                        </tr>               
                       <?php }}?>
                      </tbody>
                      <tr align="center"><td align="center"><input type="submit"  value="Save" name="save" id="save" class="w3-button  w3-green "  />    </td></tr>
              </table>
              <?php }else{ echo 'The Details are verified and forwarded to univeristy';exit;} ?>
              
           
</form>

