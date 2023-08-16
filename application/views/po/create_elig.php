 <link href="<?php echo base_url();?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
 <link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css">  

<link rel="stylesheet" href="<?php echo base_url();?>css/w3.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/w3-theme-blue-grey.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/w3.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/w3-theme-blue-grey.css">
<h4 align="center"><b style="text-decoration:underline; color:#3b579d;">SELECT STUDENTS FOR EDITING ELIGIBILITY REPORT</b></h4>
<form name="frm1" id="frm1" method="post"   action="<?php echo base_url(); ?>Po/NssPo/create_elig" >
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
                         <!-- <th width="3%">Semester</th>-->
						  <th  >Name of the Programme  with Specialisation/Major Subject</th>
                         
                                          
					 </tr>
                      </thead>
                      <tbody>
					  <?php if(isset($enroll_list)){for ( $i=1;$i<count($enroll_list);$i++ ){
						 // print_r($enroll_list);exit;  ?>
                        <tr >
                         <th class="check"><input type="checkbox" id="flowcheckall[]" name="flowcheckall[]" value="<?php echo $enroll_list[$i]['nss_stud_id']; ?>"
                         <?php if($enroll_list[$i]['elig_chk']=='Y') echo 'checked="checked"'; ?>  /></th>
                        <td><?php  echo $i; ?></td>
						 <td><?php  echo $enroll_list[$i]['account_id']; ?> </td>
                          <td><?php  echo $enroll_list[$i]['account_student_name']; ?> </td>
                           <td><?php  echo $enroll_list[$i]['cast']; ?> </td>
                            <td><?php  echo $enroll_list[$i]['gender']; ?> </td>
                             <td><?php  echo $enroll_list[$i]['admission_year']; ?> </td>
                              <td><?php  echo $enroll_list[$i]['specialisation_id']; ?> </td>
                               
                               
                         
                         
                          
                        </tr>                   
                       <?php }}?>
                      </tbody>
                      <tr align="center"><td align="center"><input type="submit"  value="Save" name="save" id="save" class="w3-button  w3-green "  />    </td></tr>
              </table>
              
           
</form>
