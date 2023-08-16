<?php //print_r($camp_image_arr);exit;?>
<h4 class="w3-center"><fntn>CAMP IMAGES </fntn></h4>
<table  class="table table-striped table-bordered dt-responsive nowrap dataTable" width="64%">
                <thead><tr>
                <th>Sl.No</th>
                <th>IMAGE</th>
                </tr></thead>
                <tbody>
                <?php for($i=0 ,$j=1;$i< count($camp_image_arr);$i++){?>
                <tr>
                <td><?php echo $j;?></td>
                <td>
                <?php 
				$ext = substr($camp_image_arr[$i], strpos($camp_image_arr[$i], ".") + 1);
				?>
                <img src="<?php echo base_url();?>upload/po/col<?php echo $camp_image['college_id'];?>/<?php echo $camp_image['batch_period']; ?>/<?php echo $camp_image['nss_unit'];?>/camp/<?php echo date("d-m-Y", strtotime($camp_image['fromdate'])); ?>_<?php echo $i ;?>.<?php echo $ext;?>"
                height="150px;" width="200px;"
                /></td>
                </tr>
                <?php $j++;}?>
                </tbody>
                </table>