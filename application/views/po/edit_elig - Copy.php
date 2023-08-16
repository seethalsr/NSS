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
<h4 align="center"><b style="text-decoration:underline; color:#3b579d;">EDIT ELIGIBILITY REPORT</b></h4>
<form name="frm1" id="frm1" method="post"   action="<?php echo base_url(); ?>Po/NssPo/edit_elig" >
<table cellpadding="0" cellspacing="0" width="50%" border="1">
<thead><th width="36%">Select Column Name</th><th width="22%">Value</th>
<th width="42%">Button</th></thead>
<tr><td>
<select name="field" id="field" onchange="myshow()">
<option >--select--</option>
<option value="res">Reservation</option>
<option value="gen">Gender</option>
<option value="adm">Admission Year</option>
<option value="cou">Name of the programme with Specialisation subject/Major subject</option>
<option value="estart">Enroll start date</option>
<option value="eend">Enroll End Date</option>
<option value="mini1">Mini Camp 1</option>
<option value="mini2">Mini Camp 2</option>
<option value="spl">Special Camp</option>
<option value="splstart">Special Camp Start Date</option>
<option value="splend">Special Camp End Date</option>
<option value="spldesti">Special Camp Destination </option>
<option value="tot">Total Hours</option>
</select>
</td><td>
<select id="res" name="res" style="display:none"><option>--select--</option><option  value="General Category">General</option><option value="OBC">OBC</option><option value="Scheduled Castes(SC)">SC</option><option value="Scheduled Tribes(ST)">ST</option></select>
<select id="gen" name="gen" style="display:none"><option>--select--</option><option value="M">Male</option><option value="F">Female</option><option value="O">Other</option></select>
<select id="adm" name="adm"  style="display:none"><option>--select--</option><option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option></select>
<input type="text" id="cou" name="cou" value="" style="display:none" />
<input type="text" id="estart" name="estart" value="" style="display:none" class="form-control datepicker " autocomplete="off"	placeholder="MM/DD/YYYY"/>
<input type="text" id="eend" name="eend" value="" style="display:none" class="form-control datepicker " autocomplete="off"	placeholder="MM/DD/YYYY"/>
<select id="mini1" name="mini1" style="display:none"><option>--select--</option><option value="YES">YES</option><option value="NO">NO</option></select>
<select id="mini2" name="mini2" style="display:none"><option>--select--</option><option value="YES">YES</option><option value="NO">NO</option></select>
<select id="spl" name="spl" style="display:none"><option>--select--</option><option value="YES">YES</option><option value="NO">NO</option></select>
<input type="text" id="splstart" name="splstart" value=""  style="display:none" class="form-control datepicker " autocomplete="off"	placeholder="MM/DD/YYYY"/>
<input type="text" id="splend" name="splend" value="" style="display:none"  class="form-control datepicker " autocomplete="off"	placeholder="MM/DD/YYYY"/>
<input type="text" id="spldesti" name="spldesti" value=""  style="display:none"/>
<input type="number" id="tot" name="tot" value="" style="display:none"/>
</td><td>
<input type="submit" id="apply" name="apply" value="Apply to selected students" class="w3-blue" style="display:none" />
</td></tr>
</table>
<br /></br>
<table class="table  table-bordered dt-responsive  dataTable"  border="1"   >
                      <thead>
                        <tr>
                        <th>Select</th>
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
					  <?php if(isset($elig)){for ( $i=1;$i<count($elig);$i++ ){
						  //print_r($elig);exit;  ?>
                        <tr >
                         <th class="check"><input type="checkbox" id="flowcheckall[]" name="flowcheckall[]" value="<?php echo $elig[$i]['nss_stud_id']; ?>"
                         /></th>
                        
						 <td><?php  echo $i; ?> </td>
                         <td><input type="number" id="prn" name="prn.<?php echo $i; ?>"  value="<?php echo $elig[$i]['account_id'];?>" /></td>
                          <td><input type="text" id="name" name="name.<?php echo $i; ?>" value="<?php echo $elig[$i]['account_student_name'];?>" /></td>
						 
                          <td>
						   <select id="cast" name="cast.<?php echo $i; ?>" class="form-control"   >
              			   <option value="">--Select--</option>  			            
			 	    	   <option value="Ezhava(EZ)/Thiyyas/Billava" <?php if( $elig[$i]['cast'] == "Ezhava(EZ)/Thiyyas/Billava") echo "selected";?>
                            
                           > <?php echo "Ezhava(EZ)/Thiyyas/Billava"; ?></option>
						   <option value="Muslim(MU)" <?php if( $elig[$i]['cast'] == "Muslim(MU)") echo "selected";?>> <?php echo "Muslim(MU)"; ?></option>
						   <option value="Latin Catholic other than Anglo Indians" <?php if($elig[$i]['cast'] == "Latin Catholic other than Anglo Indians") echo "selected";?>> <?php echo "Latin Catholic other than Anglo Indians"; ?></option>
						   <option value="Other Backward Christain(BX)" <?php if( $elig[$i]['cast'] == "Other Backward Christain(BX)") echo "selected";?>> <?php echo "Other Backward Christain(BX)"; ?></option>
						   <option value="Other Backward Hindu(BH)" <?php if( $elig[$i]['cast']  == "Other Backward Hindu(BH)") echo "selected";?>> <?php echo "Other Backward Hindu(BH)"; ?></option>
						   <option value="Scheduled Castes(SC)" <?php if(  $elig[$i]['cast'] == "Scheduled Castes(SC)") echo "selected";?>> <?php echo "Scheduled Castes(SC)"; ?></option>
						   <option value="Scheduled Tribes(ST)" <?php if(  $elig[$i]['cast'] == "Scheduled Tribes(ST)") echo "selected";?>> <?php echo "Scheduled Tribes(ST)"; ?></option>
						   <option value="General Category" <?php if(  $elig[$i]['cast'] == "General Category") echo "selected";?>> <?php echo "General Category"; ?></option>
						   <option value="Lakshadweep Muslim (ST)" <?php if(  $elig[$i]['cast']== "Lakshadweep Muslim (ST)") echo "selected";?>> <?php echo "Lakshadweep Muslim (ST)"; ?></option>
						             	 
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
              
           
</form>

<script type="text/javascript">
function myshow()
{
	 var fieldval = document.getElementById("field").value;
	 //alert(fieldval);
	 if(fieldval!='')
	  document.getElementById("apply").style.display="block";
	 if(fieldval=='res')
	 {
		// alert('resa');
		 document.getElementById("res").style.display="block";
	 document.getElementById("gen").style.display="none";
	 document.getElementById("adm").style.display="none";
	 document.getElementById("cou").style.display="none";
	 document.getElementById("estart").style.display="none";
	 document.getElementById("eend").style.display="none";
	 document.getElementById("mini1").style.display="none";
	 document.getElementById("mini2").style.display="none";
	 document.getElementById("spl").style.display="none";
	 document.getElementById("splstart").style.display="none";
	 document.getElementById("splend").style.display="none";
	 document.getElementById("spldesti").style.display="none";
	 document.getElementById("tot").style.display="none";
	 }
	 if(fieldval=='gen')
	 {
		 //alert('gena');
		 document.getElementById("res").style.display="none";
	 document.getElementById("gen").style.display="block";
	 document.getElementById("adm").style.display="none";
	 document.getElementById("cou").style.display="none";
	 document.getElementById("estart").style.display="none";
	 document.getElementById("eend").style.display="none";
	 document.getElementById("mini1").style.display="none";
	 document.getElementById("mini2").style.display="none";
	 document.getElementById("spl").style.display="none";
	 document.getElementById("splstart").style.display="none";
	 document.getElementById("splend").style.display="none";
	 document.getElementById("spldesti").style.display="none";
	 document.getElementById("tot").style.display="none";
	 }
	 if(fieldval=='adm')
	 {document.getElementById("res").style.display="none";
	 document.getElementById("gen").style.display="none";
	 document.getElementById("adm").style.display="block";
	 document.getElementById("cou").style.display="none";
	 document.getElementById("estart").style.display="none";
	 document.getElementById("eend").style.display="none";
	 document.getElementById("mini1").style.display="none";
	 document.getElementById("mini2").style.display="none";
	 document.getElementById("spl").style.display="none";
	 document.getElementById("splstart").style.display="none";
	 document.getElementById("splend").style.display="none";
	 document.getElementById("spldesti").style.display="none";
	 document.getElementById("tot").style.display="none";
	 }
	  if(fieldval=='cou')
	 {document.getElementById("res").style.display="none";
	 document.getElementById("gen").style.display="none";
	 document.getElementById("adm").style.display="none";
	 document.getElementById("cou").style.display="block";
	 document.getElementById("estart").style.display="none";
	 document.getElementById("eend").style.display="none";
	 document.getElementById("mini1").style.display="none";
	 document.getElementById("mini2").style.display="none";
	 document.getElementById("spl").style.display="none";
	 document.getElementById("splstart").style.display="none";
	 document.getElementById("splend").style.display="none";
	 document.getElementById("spldesti").style.display="none";
	 document.getElementById("tot").style.display="none";
	 }
	  if(fieldval=='estart')
	 {document.getElementById("res").style.display="none";
	 document.getElementById("gen").style.display="none";
	 document.getElementById("adm").style.display="none";
	 document.getElementById("cou").style.display="none";
	 document.getElementById("estart").style.display="block";
	 document.getElementById("eend").style.display="none";
	 document.getElementById("mini1").style.display="none";
	 document.getElementById("mini2").style.display="none";
	 document.getElementById("spl").style.display="none";
	 document.getElementById("splstart").style.display="none";
	 document.getElementById("splend").style.display="none";
	 document.getElementById("spldesti").style.display="none";
	 document.getElementById("tot").style.display="none";
	 }
	  if(fieldval=='eend')
	 {document.getElementById("res").style.display="none";
	 document.getElementById("gen").style.display="none";
	 document.getElementById("adm").style.display="none";
	 document.getElementById("cou").style.display="none";
	 document.getElementById("estart").style.display="none";
	 document.getElementById("eend").style.display="block";
	 document.getElementById("mini1").style.display="none";
	 document.getElementById("mini2").style.display="none";
	 document.getElementById("spl").style.display="none";
	 document.getElementById("splstart").style.display="none";
	 document.getElementById("splend").style.display="none";
	 document.getElementById("spldesti").style.display="none";
	 document.getElementById("tot").style.display="none";
	 }
	  if(fieldval=='mini1')
	 {document.getElementById("res").style.display="none";
	 document.getElementById("gen").style.display="none";
	 document.getElementById("adm").style.display="none";
	 document.getElementById("cou").style.display="none";
	 document.getElementById("estart").style.display="none";
	 document.getElementById("eend").style.display="none";
	 document.getElementById("mini1").style.display="block";
	 document.getElementById("mini2").style.display="none";
	 document.getElementById("spl").style.display="none";
	 document.getElementById("splstart").style.display="none";
	 document.getElementById("splend").style.display="none";
	 document.getElementById("spldesti").style.display="none";
	 document.getElementById("tot").style.display="none";
	 }
	  if(fieldval=='mini2')
	 {document.getElementById("res").style.display="none";
	 document.getElementById("gen").style.display="none";
	 document.getElementById("adm").style.display="none";
	 document.getElementById("cou").style.display="none";
	 document.getElementById("estart").style.display="none";
	 document.getElementById("eend").style.display="none";
	 document.getElementById("mini1").style.display="none";
	 document.getElementById("mini2").style.display="block";
	 document.getElementById("spl").style.display="none";
	 document.getElementById("splstart").style.display="none";
	 document.getElementById("splend").style.display="none";
	 document.getElementById("spldesti").style.display="none";
	 document.getElementById("tot").style.display="none";
	 }
	  if(fieldval=='spl')
	 {document.getElementById("res").style.display="none";
	 document.getElementById("gen").style.display="none";
	 document.getElementById("adm").style.display="none";
	 document.getElementById("cou").style.display="none";
	 document.getElementById("estart").style.display="none";
	 document.getElementById("eend").style.display="none";
	 document.getElementById("mini1").style.display="none";
	 document.getElementById("mini2").style.display="none";
	 document.getElementById("spl").style.display="block";
	 document.getElementById("splstart").style.display="none";
	 document.getElementById("splend").style.display="none";
	 document.getElementById("spldesti").style.display="none";
	 document.getElementById("tot").style.display="none";
	 }
	  if(fieldval=='splstart')
	 {document.getElementById("res").style.display="none";
	 document.getElementById("gen").style.display="none";
	 document.getElementById("adm").style.display="none";
	 document.getElementById("cou").style.display="none";
	 document.getElementById("estart").style.display="none";
	 document.getElementById("eend").style.display="none";
	 document.getElementById("mini1").style.display="none";
	 document.getElementById("mini2").style.display="none";
	 document.getElementById("spl").style.display="none";
	 document.getElementById("splstart").style.display="block";
	 document.getElementById("splend").style.display="none";
	 document.getElementById("spldesti").style.display="none";
	 document.getElementById("tot").style.display="none";
	 }
	  if(fieldval=='splend')
	 {document.getElementById("res").style.display="none";
	 document.getElementById("gen").style.display="none";
	 document.getElementById("adm").style.display="none";
	 document.getElementById("cou").style.display="none";
	 document.getElementById("estart").style.display="none";
	 document.getElementById("eend").style.display="none";
	 document.getElementById("mini1").style.display="none";
	 document.getElementById("mini2").style.display="none";
	 document.getElementById("spl").style.display="none";
	 document.getElementById("splstart").style.display="none";
	 document.getElementById("splend").style.display="block";
	 document.getElementById("spldesti").style.display="none";
	 document.getElementById("tot").style.display="none";
	 }
	  if(fieldval=='spldesti')
	 {document.getElementById("res").style.display="none";
	 document.getElementById("gen").style.display="none";
	 document.getElementById("adm").style.display="none";
	 document.getElementById("cou").style.display="none";
	 document.getElementById("estart").style.display="none";
	 document.getElementById("eend").style.display="none";
	 document.getElementById("mini1").style.display="none";
	 document.getElementById("mini2").style.display="none";
	 document.getElementById("spl").style.display="none";
	 document.getElementById("splstart").style.display="none";
	 document.getElementById("splend").style.display="none";
	 document.getElementById("spldesti").style.display="block";
	 document.getElementById("tot").style.display="none";
	 }
	  if(fieldval=='tot')
	 {document.getElementById("res").style.display="none";
	 document.getElementById("gen").style.display="none";
	 document.getElementById("adm").style.display="none";
	 document.getElementById("cou").style.display="none";
	 document.getElementById("estart").style.display="none";
	 document.getElementById("eend").style.display="none";
	 document.getElementById("mini1").style.display="none";
	 document.getElementById("mini2").style.display="none";
	 document.getElementById("spl").style.display="none";
	 document.getElementById("splstart").style.display="none";
	 document.getElementById("splend").style.display="none";
	 document.getElementById("spldesti").style.display="none";
	 document.getElementById("tot").style.display="block";
	 }
	
}

</script>