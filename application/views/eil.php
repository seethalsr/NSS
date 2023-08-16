<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="form1" id="form1"  >
<div class="col-md-12 col-sm-12 col-xs-12 " >
  <div class="x_content">
  <h4 class="w3-center"><fntn>NOTIFICATION LIST </fntn></h4>
<hr />
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
						  <th>Sl.No</th>
                          <th>Date of Publish</th>
                          <th>Notification</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php $value = ""; $i=0; if(isset($camp_detail)){{foreach ($camp_detail as $value ){ $i++; ?>
                        <tr   class="wordbreak">
                          <td><?php echo $i; ?></td>
                          <td><?php echo date("d-m-Y", strtotime($value['fromdate']));?></td>
                          <td><?php echo date("d-m-Y", strtotime($value['todate']));?></td>
                        </tr>                   
                       <?php }}}?>
                      </tbody>
                    </table>
  </div></div>
 </form>