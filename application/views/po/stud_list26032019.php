 
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
<div class="w3-center" style="padding-bottom:0px;width:100%">
<b style="color:#FF0000;"><?php if(isset($msg)){?><?php echo $msg; ?><?php }?></b><br>
</div>
<form name="frm1" id="frm1" method="post"   action="<?php echo base_url(); ?>Po/NssPo/stud_list" >


<table  style="vertical-align:top;  " >
<tr>
 
<td align="center" colspan="6">
<h4 align="center"><b style="text-decoration:underline; color:#3b579d;">ENROLL STUDENTS TO <?php echo $unit_list?> &nbsp; (<?php echo $batch_period;?>)</b></h4>
</td>
</tr>
<tr>
<td width="3%"></td>
<td width="24%">
Number of Volunteers :<a class="astrix_red">*</a></td> 
<td width="1%"></td>
<td width="28%">
<input type="number" id="stud_no"  name="stud_no" value="<?php if(isset($stud_no)) echo $stud_no;?>"/>
   
</td>
<td width="1%"></td> 
<td width="16%">
<?php if(isset($upd_stud_no)){?>
<input type="submit" value="Update Number of Volunteers" id="edit" name="edit" class="w3-button  w3-green " />
<?php }else{?>
<input type="submit" value="SUBMIT" id="sub" name="sub" class="w3-button  w3-green " />
<?php } ?>

</td>
<td width="22%">			</td>
 
</tr>

</table>
<?php if(($enroll_access == '1')&& isset($stud_no)&&$stud_no<>0) {?>
<table class="table  table-bordered dt-responsive  dataTable"     >
                      <thead>
                        <tr>
						  		<th  >Sl No.</th>
						  <th  >PRN No.</th>
        				  <th  >Name</th> 						  
                          <th  >Mobile No</th>	
						  <th >Reservation</th>
						  <th  >Gender</th>
                          <th  >Blood Group</th>
						  <th   >Donate blood</th>
                          <th  >Admission Year</th>  
                         <!-- <th width="3%">Semester</th>-->
						  <th  >Specialisation Display Name</th>
                          <th  >Enroll Start Date</th>
                          <th  >Enroll End Date</th>
						  <th  >Mini Camp 1</th>
						  <th  >Mini Camp 2</th>
						  <th  >Special Camp </th>
                          <th  >Special Cap Start Date</th>
                          <th  >Special Cap End Date</th>
                          <th  >Special Cap Destination</th>
                          <th  >Total Hours </th>
                                          
					 </tr>
                      </thead>
                      <tbody>
					  <?php if(isset($end_no)&& isset($start_no)){for ( $i=$start_no;$i<=$end_no;$i++ ){  ?>
                        <tr >
						 <td><?php  echo $i; ?> </td>
                         <td><input type="number" id="prn" name="prn.<?php echo $i; ?>"  /></td>
                          <td><input type="text" id="name" name="name.<?php echo $i; ?>"  /></td>
						  <td><input type="number" id="mob" name="mob.<?php echo $i; ?>"  /></td>
                          <td>
						   <select id="cast" name="cast.<?php echo $i; ?>" class="form-control"   >
              			   <option value="">--Select--</option>  			            
			 	    	   <option value="Ezhava(EZ)/Thiyyas/Billava" <?php if(isset($cast) && $cast == "Ezhava(EZ)/Thiyyas/Billava") echo "selected";?>> <?php echo "Ezhava(EZ)/Thiyyas/Billava"; ?></option>
						   <option value="Muslim(MU)" <?php if(isset($cast) && $cast == "Muslim(MU)") echo "selected";?>> <?php echo "Muslim(MU)"; ?></option>
						   <option value="Latin Catholic other than Anglo Indians" <?php if(isset($cast) && $cast == "Latin Catholic other than Anglo Indians") echo "selected";?>> <?php echo "Latin Catholic other than Anglo Indians"; ?></option>
						   <option value="Other Backward Christain(BX)" <?php if(isset($cast) && $cast == "Other Backward Christain(BX)") echo "selected";?>> <?php echo "Other Backward Christain(BX)"; ?></option>
						   <option value="Other Backward Hindu(BH)" <?php if(isset($cast) && $cast == "Other Backward Hindu(BH)") echo "selected";?>> <?php echo "Other Backward Hindu(BH)"; ?></option>
						   <option value="Scheduled Castes(SC)" <?php if(isset($cast) && $cast == "Scheduled Castes(SC)") echo "selected";?>> <?php echo "Scheduled Castes(SC)"; ?></option>
						   <option value="Scheduled Tribes(ST)" <?php if(isset($cast) && $cast == "Scheduled Tribes(ST)") echo "selected";?>> <?php echo "Scheduled Tribes(ST)"; ?></option>
						   <option value="General Category" <?php if(isset($cast) && $cast == "General Category") echo "selected";?>> <?php echo "General Category"; ?></option>
						   <option value="Lakshadweep Muslim (ST)" <?php if(isset($cast) && $cast == "Lakshadweep Muslim (ST)") echo "selected";?>> <?php echo "Lakshadweep Muslim (ST)"; ?></option>
						             	 
						</select>
						  </td>
						  <td> 
						    <select id="gender" name="gender.<?php echo $i; ?>" class="form-control"   >
              			   <option value="">--Select--</option>  			            
			 	    	   <option value="F" <?php if(isset($gender) && $gender == "F") echo "selected";?>> <?php echo "FEMALE"; ?></option>
						   <option value="M" <?php if(isset($gender) && $gender == "M") echo "selected";?>> <?php echo "MALE"; ?></option>
						   <option value="O" <?php if(isset($gender) && $gender == "O") echo "selected";?>> <?php echo "OTHER"; ?></option>
						   </select>
						  </td>
                          <td> 
						   <select id="blood" name="blood.<?php echo $i; ?>" class="form-control"   >
              			   <option value="">--Select--</option>  			            
			 	    	   <option value="O+" <?php if(isset($gender) && $gender == "O+") echo "selected";?>> <?php echo "O+"; ?></option>
						   <option value="O-" <?php if(isset($gender) && $gender == "O-") echo "selected";?>> <?php echo "O-"; ?></option>
						   <option value="A+" <?php if(isset($gender) && $gender == "A+") echo "selected";?>> <?php echo "A+"; ?></option>
						   <option value="A-" <?php if(isset($gender) && $gender == "A-") echo "selected";?>> <?php echo "A-"; ?></option>
						   <option value="B+" <?php if(isset($gender) && $gender == "B+") echo "selected";?>> <?php echo "B+"; ?></option>
						   <option value="B-" <?php if(isset($gender) && $gender == "B-") echo "selected";?>> <?php echo "B-"; ?></option>
						   <option value="AB+" <?php if(isset($gender) && $gender == "AB+") echo "selected";?>> <?php echo "AB+"; ?></option>
						   <option value="AB-" <?php if(isset($gender) && $gender == "AB-") echo "selected";?>> <?php echo "AB-"; ?></option>						   						</select>
						  </td>
						   <td> 
						   <select id="donate" name="donate.<?php echo $i; ?>" class="form-control"   >
              			   <option value="">--Select--</option>  			            
			 	    	   <option value="YES" <?php if(isset($donate) && $donate == "YES") echo "selected";?>> <?php echo "YES"; ?></option>
						   <option value="NO" <?php if(isset($donate) && $donate == "NO") echo "selected";?>> <?php echo "NO"; ?></option> 						   						</select>
						  </td>
						  <td> 
						  <select id="admyear" name="admyear.<?php echo $i; ?>" class="form-control"   >
              			   <option value="">--Select--</option>  			            
			 	    	   <option value="2017" <?php if(isset($admyear) && $admyear == "2017") echo "selected";?>> <?php echo "2017"; ?></option>
						   <option value="2018" <?php if(isset($admyear) && $admyear == "2018") echo "selected";?>> <?php echo "2018"; ?></option>
						   </select>
						  </td>
                           <td><input type="text" id="spl" name="spl.<?php echo $i; ?>"  /></td>
                          <td><input type="text" class="form-control datepicker" name="enrolled_date.<?php echo $i; ?>"  autocomplete="off" placeholder="MM/DD/YYYY" />
                        </td>
                          <td><input type="text" class="form-control datepicker"  name="enroll_end.<?php echo $i; ?>" autocomplete="off" placeholder="MM/DD/YYYY"	 /></td>
                         
						  <td> 
                           <select id="mini1" name="mini1.<?php echo $i; ?>" class="form-control"   >
              			   <option value="">--Select--</option>  			            
			 	    	   <option value="YES" <?php if(isset($mini1) && $mini1 == "YES") echo "selected";?>> <?php echo "YES"; ?></option>
						   <option value="NO" <?php if(isset($mini1) && $mini1 == "NO") echo "selected";?>> <?php echo "NO"; ?></option> 						   						</select>
                          </td>
                          <td> 
                          
                          <select id="mini2" name="mini2.<?php echo $i; ?>" class="form-control"   >
              			   <option value="">--Select--</option>  			            
			 	    	   <option value="YES" <?php if(isset($mini2) && $mini2 == "YES") echo "selected";?>> <?php echo "YES"; ?></option>
						   <option value="NO" <?php if(isset($mini2) && $mini2 == "NO") echo "selected";?>> <?php echo "NO"; ?></option> 						   						</select>
                          </td>
						    <td> 
                            
                            <select id="splcamp" name="splcamp.<?php echo $i; ?>" class="form-control"   >
              			   <option value="">--Select--</option>  			            
			 	    	   <option value="YES" <?php if(isset($splcamp) && $splcamp == "YES") echo "selected";?>> <?php echo "YES"; ?></option>
						   <option value="NO" <?php if(isset($splcamp) && $splcamp == "NO") echo "selected";?>> <?php echo "NO"; ?></option> 						   						</select>
                            </td>
                             <td> <input type="text" class="form-control datepicker "  name="splcamp_start.<?php echo $i; ?>"   autocomplete="off"	placeholder="MM/DD/YYYY" />
                              </td>
                              <td> <input type="text" class="form-control datepicker "  name="splcamp_end.<?php echo $i; ?>"   autocomplete="off"	placeholder="MM/DD/YYYY" />
                               </td>
                               <td> <input type="text" id="spl_desti" name="spl_desti.<?php echo $i; ?>"  /> </td>
                            
                          <td><input type="number" id="tot_hr" name="tot_hr.<?php echo $i; ?>"  /></td>
                          
                        </tr>                   
                       <?php }}?>
                      </tbody>
              </table>
	<?php } ?>		  
<table>
<tr align="center"><td colspan="13"> 
<?php if(($enroll_access == '1')&&isset($end_no)&& isset($start_no)&& isset($stud_no)&&$stud_no<>0) {?>

<?php if( $stud_no!=$end_no){?>
              <input type="submit"  value="Save and Next " name="enroll" id="enroll" class="w3-button  w3-green "  />
			  <?php }else{?>
			   <input type="submit"  value="Final Submit " name="enroll" id="enroll" class="w3-button  w3-green "  />
			  
          <?php }} ?>  </td>
            
            </tr>
</table>			  


</form>

    
