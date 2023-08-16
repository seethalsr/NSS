<?php  //print_r($faq_data);exit;?>
<script>
$(document).ready(function () {
		$(".flip").click(function () {
        $(this).next('.panel').slideToggle("slow").siblings('.panel').slideUp("slow");
	});
});
</script>


<link rel="stylesheet" href="<?php echo base_url();?>font-awesome/css/font-awesome.min.css">  
<link href = "<?php echo base_url();?>css/jquery-ui.css"   rel = "stylesheet">
<script src="<?php echo base_url();?>js/jquery-ui.js"></script>
<script src="<?php echo base_url();?>js/mask.min.js"></script>
<script>
$(function() {

</script>
<div class="w3-center">
<?php if(isset($msg)){?>
<h6  style="color:#FF8040; "><?php echo $msg; ?></h6><?php }?></span>
</div>
<div class="w3-center">
<span style="color:#903; font-size:20px;font-family:'Times New Roman', Times, serif; ">MANAGE</span>
</div>

<table cellpadding="0" cellspacing="0" width="100%">
<tr><td width="88%">
	<div class="flip"><h6 > <i class="fa fa-hand-o-right" aria-hidden="true"></i><span style="color:#000082;">Fix date for enrollment of students
	</span></h6> </div>						
	<div class="panel" style="display:none;">
    <form action="<?php echo base_url();?>Admin/NssAdmin/admin_manage/1" method="post"  name="form1" id="form1" enctype="multipart/form-data" >
	<table align="center" cellpadding="0" cellspacing="0" height="100%" width="100%" id="tab_enroll">
	<tr>
	<td width="2%">&nbsp;</td>
	<td width="20%"><label for="txt1" class="form-control-label">Date of Enrollment Start:</label></td>
	<td width="5%">&nbsp;</td>
	<td width="20%"><input type="text" class="form-control" id="date" name="fromdatepicker"   autocomplete="off"  placeholder="DD-MM-YYYY"
    <?php if(isset($get_data_manage)){
	 echo "value='". date("d-m-Y", strtotime($get_data_manage['start_date']))."'"; 
	 if(($get_data_manage['verification_id']== "3" || $get_data_manage['verification_id']== "4" || $get_data_manage['extended']== "yes"|| $user_type == "so")&& date("Y-m-d")<=			     $get_data_manage['to_date']){ echo "disabled='disabled'" ;}}
	 elseif(isset($data4_manage)){ echo " value=";echo $data4_manage['fromdatepicker'];}?> ></td>
	<td width="11%">&nbsp;</td>
	<td width="20%"><label for="txt1" class="form-control-label">Date of Enrollment Ends:</label></td>
	<td width="3%">&nbsp;</td>
	<td width="17%"><input type="text" class="form-control" id="date" name="todatepicker"  autocomplete="off" placeholder="DD-MM-YYYY" required
    <?php if(isset($get_data_manage)){ echo "value="; echo date("d-m-Y", strtotime($get_data_manage['to_date'])); 
	 if(($get_data_manage['verification_id']== "3" || $get_data_manage['verification_id']== "4" || $user_type == "so" || $get_data_manage['extended']=="no"|| $user_type =="so")&&
	 date("Y-m-d")<$get_data_manage['to_date']){ echo " disabled= 'disabled'"; }} elseif(isset($data4_manage)){ echo " value="; echo $data4_manage['todatepicker']; }?> >	</td>
	<td width="2%">&nbsp;</td>
	</tr>
	<tr><td colspan="4"><span style="color:#F00;" ><?php echo form_error('fromdatepicker'); ?></span></td><td>&nbsp;</td>
	<td colspan="4"><span style="color:#F00;" ><?php echo form_error('todatepicker'); ?></span></td></tr>
	<tr><td colspan="9">&nbsp;</td></tr>
	<tr><td colspan="9" class="w3-center">
     <?php if($get_data_manage['verification_id'] == 4 && $get_data_manage['extended'] == 'no'){?>
     <button type="button" class="w3-button  w3-blue  " data-toggle="modal" data-target="#Rejected"  >Extend To Date</button>
     <div class="modal fade" id="Rejected" tabindex="-1" role="dialog" aria-labelledby="RejectedLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Extend To Date</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>        </button>
      </div>
      <div class="modal-body">
          <input type="text" class="form-control" id="todatepickerexten" name="todatepickerexten"  autocomplete="off"	 >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="extended" id="extended" value="Submit"/>
      </div>
    </div>
  </div>
</div>
    <?php } if((empty($get_data_manage)|| date("Y-m-d")>$get_data_manage['to_date']||$get_data_manage['verification_id'] == 0 ||$get_data_manage['verification_id'] == '3R')&&($user_type=="assistant")
	) { ?>
	<input type="submit" class="btn btn-primary" value="Forward to SO" name="submitenrolldate" id="submitenrolldate" style="background-color:#0080FF; color:#FFF"/>
    <?php }if($get_data_manage['verification_id'] == "3"&& date('Y-m-d')<=$get_data_manage['to_date']){?>
    <span style="color:#0080C0;">STATUS:</span><span style="color:#004000;"> SUCCESSFULLY FORWARDED TO SO</span>
    <?php }elseif($get_data_manage['verification_id'] == "4"&& date('Y-m-d')<=$get_data_manage['to_date']){ ?>
    <span style="color:#0080C0;">STATUS:</span><span style="color:#004000;">ACCEPTED BY SO</span>
    <?php }elseif($get_data_manage['verification_id'] == "3R"&& date('Y-m-d')<=$get_data_manage['to_date']){ ?>
    <span style="color:#0080C0;">STATUS:</span><span style="color:#004000;">REJECTED BY SO</span>
    <p> Remarks: <?php echo $get_data_manage['remarks'];?></p>
    <?php } ?>
    <?php if(($get_data_manage['verification_id']=="3")&&($user_type=="so")){?>
	<input type="submit" class="w3-button  w3-green " value="ACCEPTED BY SO" name="acc_so" id="acc_so" />
    <button type="button"  data-toggle="modal" data-target="#Rejected" class="w3-button w3-right w3-red " >REJECTED BY SO</button>
<div class="modal fade" id="Rejected" tabindex="-1" role="dialog" aria-labelledby="RejectedLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reason for Rejection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>        </button>
      </div>
      <div class="modal-body">
            <textarea id="remarktxt1" name="remarktxt1" rows="5" cols="100" class="form-control" placeholder=" maximum 250 char" style="resize:none;"></textarea>
			<?php echo form_error('remarktxt1');?>
      </div>
      <div class="modal-footer">
        <button type="button"  data-dismiss="modal" class="w3-button w3-left w3-red ">Close</button>
        <input type="submit"  name="rej_so" id="rej_so" class="w3-button  w3-green  w3-right" value="Submit"/>
      </div>
    </div>
  </div>
</div>


	<?php } ?>
	</td></tr>
	</table>
    </form>
    </div>
    <div class="flip"><h6 > <i class="fa fa-hand-o-right" aria-hidden="true"></i><span style="color:#000082;">Web Site Content Management
	</span></h6> </div>						
	<div class="panel" style="display:none;" >
    <form action="<?php echo base_url();?>Admin/NssAdmin/admin_manage/2" method="post"  name="form1" id="form1" enctype="multipart/form-data" >
    <table align="center" cellpadding="0" cellspacing="0" height="100%" width="100%" id="tab_enroll">
    <tr>
    <td width="1%"></td><td width="83%"><textarea  class="form-control" id="content_area" name="content_area" style="resize:none" maxlength="1030"
    <?php if($user_type=="so" || $web_data['verification_id']=="3"  ){?> disabled="disabled"<?php } ?>>
	<?php if($web_data['verification_id']<>"4")echo $web_data['web_text'] ;?></textarea></td>
    <td width="2%"></td>
    <?php if($user_type=="assistant" ){?><td width="7%">
    <a href="#" onclick="myFunction()" >PREVIEW</a> 
    </td>
    <td width="2%"></td><?php } ?></tr>
    <tr>
	<td width="5%" colspan="4" class="w3-center"><?php if(($user_type=="assistant" && $web_data['verification_id']=='0')||($user_type=="assistant" && empty($web_data)
	||($user_type=="assistant" && $web_data['verification_id']=='3R')||($user_type=="assistant" && $web_data['verification_id']=='4'))){?>
    <input type="submit" value="Forward to SO" name="content_but" id="content_but" class="w3-button  w3-green "/>
	<?php }elseif($user_type=="so" &&($web_data['verification_id']=="3")){ ?>
   <input type="submit"  value="ACCEPTED BY SO" name="web_acc_so" id="web_acc_so" class="w3-button w3-right w3-green "/>
    <button type="button"  data-toggle="modal" data-target="#Rejected1" class="w3-button  w3-red " >REJECTED BY SO</button>
<div class="modal fade" id="Rejected1" tabindex="-1" role="dialog" aria-labelledby="RejectedLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reason for Rejection</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
            <textarea id="remarktxt2" name="remarktxt2" rows="5" cols="100" class="form-control" placeholder=" maximum 250 char" style="resize:none;"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="w3-button w3-left w3-red " data-dismiss="modal">Close</button>
        <input type="submit" class="w3-button w3-right w3-blue "name="web_rej_so" id="web_rej_so" value="Submit"/>
      </div>
    </div>
  </div>
</div>
    <?php } 
    if($web_data['verification_id'] == "3"){?>
    <span style="color:#0080C0;">STATUS:</span><span style="color:#004000;"> SUCCESSFULLY FORWARDED TO SO</span>
    <?php }elseif($web_data['verification_id'] == "3R"){ ?>
    <span style="color:#0080C0;">STATUS:</span><span style="color:#004000;">REJECTED BY SO</span>
    <p> Remarks: <?php echo $web_data['remarks'];?></p>
    <?php } ?>
</td></tr>
    </table>
    </form>
    </div>
     <div class="flip"><h6 > <i class="fa fa-hand-o-right" aria-hidden="true"></i><span style="color:#000082;">Add new FAQ
	</span></h6> </div>						
	<div class="panel" style="display:none;">
    <form action="<?php echo base_url();?>Admin/NssAdmin/admin_manage/4" method="post"  name="form1" id="form1" enctype="multipart/form-data" >
    <table align="center" cellpadding="0" cellspacing="0" height="100%" width="100%" id="tab_enroll">
    <tr><td></td><td>Question</td><td>
    <input type="text" id="faq_ques" name="faq_ques" class="form-control"  value="<?php if(isset($faq_data)){echo $faq_data['faq_ques'];}?>" 
    <?php if($faq_data['verification_id']=='3'||$faq_data['verification_id']=='4'|| $user_type =="so"){ ?>disabled="disabled"<?php } ?> /></td><td></td></tr>
    <tr><td colspan="4" style="color:#F00;"><?php echo form_error('faq_ques');?></td></tr>
    
    <tr><td></td><td>Answer</td><td><textarea id="faq_ans" name="faq_ans" class="form-control" <?php if($faq_data['verification_id']=='3'||$faq_data['verification_id']=='4'|| $user_type =="so"){ ?>disabled="disabled"<?php } ?> style="resize:none;"><?php if(isset($faq_data)){echo $faq_data['faq_ans'];}?></textarea></td><td></td></tr>
    <tr><td colspan="4" style="color:#F00;"><?php echo form_error('faq_ans');?></td></tr>
    
    <tr><td  class="w3-center" colspan="4">
    <?php if(($user_type=="assistant" && $faq_data['verification_id']=='0')||($user_type=="assistant") && empty($faq_data)||($faq_data['verification_id']=='3R'&& $user_type=="assistant")){?>
    <input type="submit"  value="Forward to SO" name="faq_fwd_so" id="faq_fwd_so" class="w3-button  w3-green " />
    <?php }elseif($user_type=="so" &&($faq_data['verification_id']=="3")){ ?>
   <input type="submit" class="btn btn-primary" value="ACCEPTED BY SO" name="faq_acc_so" id="faq_acc_so" style="background-color:#0080FF; color:#FFF"/>
    <button type="button" data-toggle="modal" data-target="#Rejected2" class="w3-button  w3-red " >REJECTED BY SO</button>
<div class="modal fade" id="Rejected2" tabindex="-1" role="dialog" aria-labelledby="RejectedLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reason for Rejection</h5>
        <button type="button"  data-dismiss="modal" aria-label="Close" class="w3-button w3-left w3-red  close">
          <span aria-hidden="true">&times;</span>        </button>
      </div>
      <div class="modal-body">
            <textarea id="remarktxt4" name="remarktxt4" rows="5" cols="100" class="form-control" placeholder=" maximum 250 char" style="resize:none;"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="w3-button w3-left w3-red " data-dismiss="modal">Close</button>
        <input type="submit" class="w3-button w3-right w3-green " name="faq_rej_so" id="faq_rej_so" value="Submit"/>
      </div>
    </div>
  </div>
</div>
    <?php } 
    if($faq_data['verification_id'] == "3"){?>
    <span style="color:#0080C0;">STATUS:</span><span style="color:#004000;"> SUCCESSFULLY FORWARDED TO SO</span>
    <?php }elseif($faq_data['verification_id'] == "4"){ ?>
    <span style="color:#0080C0;">STATUS:</span><span style="color:#004000;">ACCEPTED BY SO</span>
    <?php }elseif($faq_data['verification_id'] == "3R"){ ?>
    <span style="color:#0080C0;">STATUS:</span><span style="color:#004000;">REJECTED BY SO</span>
    <p> Remarks: <?php echo $faq_data['remarks'];?></p>
    <?php } ?>
     </td></tr>
    </table>
    </form>
    </div>
</td>
<td width="12%">
<div id="mySidenav" class="sidenav">
  <a href="<?php echo base_url();?>Admin/NssAdmin/front_image" id="frontimage">FRONT IMAGE</a>
  <a href="<?php echo base_url();?>Admin/NssAdmin/notice" id="notice">NOTICE</a>
<?php /*?>  <a href="<?php echo base_url();?>Admin/NssAdmin/projects" id="project">PROJECTS</a><?php */?>
  <?php /*?><a href="<?php echo base_url();?>Admin/NssAdmin/funds" id="fund">FUND</a><?php */?>
 <?php /*?> <a href="<?php echo base_url();?>Admin/NssAdmin/list" id="list">LIST </a><?php */?>
</div>
</td></tr>
</table>

<script src="<?php echo base_url();?>js/jquery_maskedinput.js"></script>
<script>
jQuery(function($){
	$("#fromdatepicker").mask("99-99-9999");
	$("#todatepicker").mask("99-99-9999");
	
	});
	
function myFunction() {
	var x =document.getElementById("content_area").value;
   alert(x);
}

function enableFunction(){
	document.getElementById("content_area").disabled="false";
}
</script>