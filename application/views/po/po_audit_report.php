<?php //print_r($audit_detail);exit;?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="form1" id="form1" enctype="multipart/form-data" >
<?php if(isset($msg))echo $msg;?>
<h4 class="w3-center"><fntn>AUDIT REPORT DEATILS </fntn></h4>
<hr />
                   <table cellpadding="0" cellspacing="0" width="100%" border="1" align="center">
                      <thead>
                        <tr>
						  <th width="9%">YEAR</th>
                          <th colspan="2">AUDIT REPORT</th>
                          <th width="26%">STATUS</th>
                          <th width="11%">REMARKS</th>
                        </tr>
                      </thead>
                      <tbody>
                     <?php if(empty($prev_exist) && empty($curr_exist)){?>
					 <tr  class="wordbreak">
                      <td><?php echo date("Y");?></td>
                      <td width="40%" ><input  name="txt2" type="file"  /> </td>
                      <td width="6%"> <input type="submit" value="FORWARD TO PRINCIPAL" name="upload2"  class="btn" style="background:#09C; color:#FFF;" /></td>
                      <td>-</td>
                      <td>-</td>
                      </tr>
					   <tr  class="wordbreak">
                      <td><?php echo date("Y",strtotime("-1 year"));?></td>
                      <td><input  name="txt1" type="file"  /></td>
                      <td><input type="submit" value="FORWARD TO PRINCIPAL"  name="upload1"  class="btn" style="background:#09C; color:#FFF;" /></td>
                      <td>-</td>
                      <td>-</td>
                      </tr>
					 <?php }elseif((empty($prev_exist) && !empty($curr_exist))){ ?>
					
					  <tr  class="wordbreak">
                      <td><?php echo date("Y",strtotime("-1 year"));?></td>
                      <td width="40%" ><input  name="txt1" type="file"  /> </td>
                      <td width="6%"> <input type="submit" value="FORWARD TO PRINCIPAL"  name="upload1"  class="btn" style="background:#09C; color:#FFF;" /></td>
                      <td>-</td>
                      <td>-</td>
                      </tr>
					 <?php }elseif((!empty($prev_exist) && empty($curr_exist))){  ?>
					 <tr  class="wordbreak">
                      <td><?php echo date("Y");?></td>
                      <td width="40%" ><input  name="txt2" type="file"  /> </td>
                      <td width="6%"> <input type="submit" value="FORWARD TO PRINCIPAL"  name="upload2"  class="btn" style="background:#09C; color:#FFF;" /></td>
                      <td>-</td>
                      <td>-</td>
                      </tr>
					 <?php } ?>
					 
					 <?php foreach ($audit_detail as $value ){ ?>
                        <tr   class="wordbreak">
                          <td><?php echo $value['year']; ?></td>
                          <td colspan="2"><a target="_blank" href="<?php echo base_url(); ?>upload/po/col<?php echo $college_id; ?>/AUDIT/<?php echo $value['year']; ?>.pdf"><?php echo $value['year']; ?>.pdf</a>
						  <?php if(($value['verification_id']=="1R"||$value['verification_id']=="3R")&& $value['year']== date('Y')){?>
						  <input  name="txt2" type="file"  /><input type="submit" value="FORWARD TO PRINCIPAL"  name="upload2" />
						  <?php }elseif(($value['verification_id']=="1R"||$value['verification_id']=="3R")&& $value['year']== date("Y",strtotime("-1 year"))){ ?>
						  <input  name="txt1" type="file"  />
						  <input type="submit" value="FORWARD TO PRINCIPAL"  name="upload2"  class="btn" style="background:#09C; color:#FFF;"/>
						  <?php } ?>
						  </td>
                          <td><?php if( $value['verification_id']=="1"){echo"FORWARDED TO PRINCIPAL";}
						  elseif($value['verification_id']=="2"||$value['verification_id']=="2R"||$value['verification_id']=="3"){echo"FORWARDED TO UNIVERSITY";}
						  elseif($value['verification_id']=="1R"){echo"REJECTED BY PRINCIPAL";}
						  elseif($value['verification_id']=="4"){echo"ACCEPTED BY UNIVERSITY";}
						  elseif($value['verification_id']=="3R"){echo"REJECTED BY UNIVERSITY";}
						  ?></td>
                          <td><?php 
						  if($value['verification_id']=="3R")echo $value['remarks'];
						  elseif($value['verification_id']=="1R")echo $value['remarks'];
						  ?></td>
                        </tr>                   
                       <?php }?>
                      </tbody>
                    </table>

</form>