
<script>
$(document).ready(function () {
		$(".flip").click(function () {
        $(this).next('.panel').slideToggle("slow").siblings('.panel').slideUp("slow");
	});
});
<?php  //print_r($get_data_manage);exit;  ?>
</script>
<?php  //print_r($get_data_manage['verification_id']);exit;  ?>
<link rel="stylesheet" href="<?php echo base_url();?>font-awesome/css/font-awesome.min.css">  

<div class="w3-center">
<?php if(isset($msg)){?>
<h6  style="color:#FF8040; "><?php echo $msg; ?></h6><?php }?></span>

</div>
<div class="w3-center">
<span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">MANAGE</span>
</div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="form1" id="form1">
<div>
	<div class="flip"><h6 > <i class="fa fa-hand-o-right" aria-hidden="true"></i><span style="color:#000082;">Fix date for enrollment of students
	</span></h6> </div>						
	<div class="panel" style="display:none;">
	 <?php if($get_data_manage['verification_id'] == 0){?>
	 <div style="color:#F55;" class="w3-center">"Not yet fixed the date for enrollment "</div>
	 <?php }
	 elseif($get_data_manage['verification_id'] == 1||$get_data_manage['verification_id'] == 2 ||$get_data_manage['verification_id'] == 3 ){ ?>
		<table cellpadding="0" cellspacing="0" height="100%" width="100%">
     <tr><td width="4%">&nbsp;</td>
     <td width="16%"><label for="txt1" class="form-control-label">Date of Enrollment Start:</label></td>
     <td width="2%">&nbsp;</td>
     <td width="17%"><input type="text" class="form-control" id="fromdatepicker" name="fromdatepicker"   readonly="readonly"
     <?php if(isset($get_data_manage)){?> value="<?php echo $get_data_manage['start_date'];  ?>"   <?php }?>  ></td>
     <td width="7%">&nbsp;</td>
     <td width="20%"><label for="txt1" class="form-control-label">Date of Enrollment End:</label></td>
     <td width="18%"><input type="text" class="form-control" id="todatepicker" name="todatepicker"  readonly="readonly"
     <?php if(isset($get_data_manage)){?> value="<?php echo date("m/d/Y", strtotime($get_data_manage['to_date']));  ?>"   <?php }?>   >	</td>
     <td width="16%">&nbsp;</td>
     </tr>
     <tr><td colspan="8">&nbsp;</td></tr>
     <tr><td colspan="8">
     <div class="w3-center">
     <?php if($get_data_manage['verification_id'] == 4 && $get_data_manage['extended'] == 'no'){?>
	 <input type="submit" class="btn btn-primary" value="Extend To Date" name="extend" id="extend" style="background-color:#0080C0; color:#FFF"/>
	 <?php }elseif($get_data_manage['verification_id'] == 1){?>
     <input type="submit" class="btn btn-primary" value="Accepted" name="accso" id="accso" style="background-color:#0080C0; color:#FFF"/>
     <button type="button" class="btn " data-toggle="modal" data-target="#Rejected" style="background-color:#0099CC; color:#FFFFFF" >Rejected</button>
<div class="modal fade" id="Rejected" tabindex="-1" role="dialog" aria-labelledby="RejectedLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reason for Rejection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>        </button>
      </div>
      <div class="modal-body">
            <textarea id="remarktxt1" name="remarktxt1" rows="5" cols="100" class="form-control" placeholder=" maximum 250 char"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="rejsosubmit" id="rejsosubmit" value="Submit"/>
      </div>
    </div>
  </div>
</div>
<?php }elseif($get_data_manage['verification_id']== 3){?>
<span style="color:#F00;"> REJECTED BY SO AND FORWARDED TO ASSISTANT</span>
<p>REMARKS: <?php echo $get_data_manage['remarks']; ?></p>
<?php } ?>
</div>
     </td></tr>
     </table>
	 <?php } ?>
    </div>   
</div>
 	

</form>