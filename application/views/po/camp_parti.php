<?php //print_r($camp_atten_parti);exit;?>
<h4 class="w3-center"><fntn>PARTICIPANTS </fntn></h4>
<table  class="table table-striped table-bordered dt-responsive nowrap dataTable" width="100%">
                <thead><tr>
                <th>Sl.No</th>
                <th>Enrollment No:</th>
				<th>PRN No:</th>
                <th>Student Name</th>
                <th>Gender</th>
                <th>Cast</th>
                </tr></thead>
                <tbody>
                <?php $i=0; foreach($camp_atten_parti as $value){$i++;?>
                <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $value['nss_enroll_id']; ?></td>
				 <td><?php echo $value['account_id']; ?></td>
                <td><?php echo $value['account_student_name']; ?></td>
                <td><?php if($value['gender']=="F") echo "FEMALE"; elseif($value['gender']=="M") echo "MALE"; else echo "OTHER"; ?></td>
                <td><?php echo $value['cast']; ?></td>
                </tr>
                <?php }?>
                </tbody>
                </table>