
<h4 class="w3-center"><fntn>PARTICIPANTS </fntn></h4>
<table  class="table table-striped table-bordered dt-responsive nowrap dataTable" width="100%">
                <thead><tr>
                <th>Sl.No</th>
                <th>Enroll Id</th>
                <th>Student Name</th>
                </tr></thead>
                <tbody>
                <?php if(isset($monthly_atten_parti)){ $i = 0; foreach($monthly_atten_parti as $value){$i++;?>
                <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $value['nss_enroll_id']; ?></td>
                <td><?php echo $value['account_student_name']; ?></td>
                </tr>
                <?php }}?>
                </tbody>
                </table>