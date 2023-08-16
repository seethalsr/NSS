<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css">  
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script>
<?php if(isset($show)&& $show== 1){ ?>
<input type="hidden" value="<?php echo base_url(); ?>" id="baseurl"/>
<link rel="stylesheet" href="<?php echo base_url();?>css/cal_event.css">
<span class="w3-center"><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="form1" id="form1" enctype="multipart/form-data" >
<!--contant body-->
<h4 align="center"><b style="text-decoration:underline;">ENTER MONTHLY ATTENDANCE</b></h4>
  <div class="calendar" id="calendar-app">
  <div class="calendar--day-view" id="day-view"  >
    <span class="day-view-exit" id="day-view-exit">&times;</span>
    <span class="day-view-date" id="day-view-date"></span>
    <input type="hidden"  id="myField" name="myField" value=""  />
    <div class="day-view-content" >
      <table cellpadding="2" cellspacing="2" width="100%">
      <tr>
        <td style="font-size:16px; color:#000;">&nbsp;</td>
        <td style="font-size:16px; color:#000;">&nbsp;</td>
        <td></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="1%" height="83" style="font-size:16px; color:#000;">&nbsp;</td>
        <td width="14%" style="font-size:16px; color:#000;">Activity Describition (Max:250 char)</td><td width="7%"><span class="astrix_red">*</span></td>
      <td width="74%"><textarea id="act_desc" name="act_desc" rows="3"  style="width:100%; height:50%; resize:none;" maxlength="250">
	  <?php if(isset($data_input)) echo $data_input['input_act_desc']; ?></textarea></td>
      <td width="4%">&nbsp;</td>
      </tr>
      <tr>
        <td style="font-size:16px;color:#000;">&nbsp;</td>
        <td style="font-size:16px;color:#000;">&nbsp;</td>
        <td></td>
        <td class="msg_red"><?php echo form_error('act_desc');?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="font-size:16px;color:#000;">&nbsp;</td>
        <td style="font-size:16px;color:#000;">Activity Hour</td><td><span class="astrix_red">*</span></td><td>
      <input type="text" class="add-event-edit"  placeholder="00" id="act_hr"  name="act_hr" size="2" maxlength="2"   autocomplete="off"  onKeyPress="return input_number(event)"
	  value=" <?php if(isset($data_input)) echo $data_input['input_act_hr']; ?>">
      </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td style="font-size:16px;color:#000;">&nbsp;</td>
        <td style="font-size:16px;color:#000;">&nbsp;</td>
        <td>&nbsp;</td>
        <td class="msg_red"><?php echo form_error('act_hr');?></td>
        <td>&nbsp;</td>
      </tr>
      
	 <tr>
     <td colspan="3"> <div class="row" id="image_preview" style="padding-left:15px;"></div></td>
     </tr>
      </table>
          <div class="w3-center" style="padding-top:15px;">
             <a href="#" data-toggle="modal" data-target="#modaladd_parti" style="text-decoration:underline; font-size:14px; color:#000;"><b>ADD PARTICIPANTS</b></a>
          </div>
      
    </div>
  </div>
  <div class="calendar--view" id="calendar-view">
    <div class="cview__month">
      <span class="cview__month-last" id="calendar-month-last">Apr</span>
      <span class="cview__month-current" id="calendar-month">May</span>
      <span class="cview__month-next" id="calendar-month-next">Jun</span>
    </div>
    <div class="cview__header">Sun</div>
    <div class="cview__header">Mon</div>
    <div class="cview__header">Tue</div>
    <div class="cview__header">Wed</div>
    <div class="cview__header">Thu</div>
    <div class="cview__header">Fri</div>
    <div class="cview__header">Sat</div>
    <div class="calendar--view" id="dates">
    </div>
  </div>
  <div class="footer1">
    <span><span id="footer-date" class="footer__link">Today is <?php echo date('M Y'); ?></span></span>    
  </div>
</div>

<!-- add participants modal -->
<div id="modaladd_parti" class="modal fade " role="dialog" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align-last: center">Add New Participants</h4>
            </div>
            <div class="modal-body ">
				 <h4 class="w3-center"><fntn>STUDENTS UNDER <?php echo $unit; ?>  </fntn></h4>
<hr />
                    <table id="res1" class="table table-striped table-bordered dt-responsive nowrap dataTable">
                      <thead>
                        <tr>
						  <th class="check"><input type="checkbox" id="flowcheckall" value="" />All</th>
                          <th>Enrollment No:</th>
						  <th>PRN No:</th>
                          <th>Student Name</th>
                          <th>Year [Semester]</th>
					    </tr>
                      </thead>
                      <tbody>
					  <?php foreach ($enroll_list as $value){?>
					  <tr>
					  <td><input id="chk[]" name="chk[]" value="<?php echo $value['nss_stud_id'];?>" type="checkbox" 
					  <?php if(!empty($nss_stud_m_list)){if(in_array($value['nss_stud_id'],$nss_stud_m_list)){ ?> checked="checked" <?php } }?>/>
                      </td>
					  <td><?php echo $value['nss_enroll_id']; ?></td>
					  <td><?php echo $value['account_id']; ?></td>
					  <td><?php echo $value['account_student_name']; ?></td>
					  <td><?php echo $value['admission_year'] .'['.$value['current_semester'].' Sem]'; ?></td>
					  </tr>
					  <?php } ?>
                      </tbody>
                    </table>
            </div>
            <div class="modal-footer">
			<input type="hidden" name="chk_ip" id="chk_ip"  />
                <input type="submit" id="save_stud" name="save_stud" value="SAVE" class="w3-button  w3-green " onclick="myCheck()"   />
                 <button type="button" class="w3-button  w3-grey "  data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
</form>
 <script src="<?php echo base_url();?>tab/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>tab/js/dataTables.bootstrap.min.js"></script><!--pagination- pointer not that mauch important-->   
    <!-- Custom Theme Scripts need -->
    <script src="<?php echo base_url();?>tab/js/custom.min.js"></script> 
<script  src="<?php echo base_url();?>js/cal_event.js"></script>

<script>

<!-- check all script -->
	$(document).ready(function () {
    var str = "";
    oTableStaticFlow = $('#res1').DataTable({
        "aoColumnDefs": [{
            'bSortable': false,
            'aTargets': [0]
        }],
    });

    $("#flowcheckall").click(function () {
        //$('#flow-table tbody input[type="checkbox"]').prop('checked', this.checked);
        var cols = oTableStaticFlow.column(0).nodes(),
            state = this.checked;
        //alert(cols.length);exit;
        for (var i = 0; i < cols.length; i += 1) {
        	cols[i].querySelector("input[type='checkbox']").checked = state;
        }
    });
	
	
});
function myCheck()
{
//alert("sdsf");exit;
	 var cols = oTableStaticFlow.column(0).nodes(),
	    app_txt="";
		for (var i = 0; i < cols.length; i += 1) {
	 
        	if(cols[i].querySelector("input[type='checkbox']").checked )
			{
			if(app_txt=="")
			{ app_txt =  (cols[i].querySelector("input[type='checkbox']").value);
			}else
			{
			app_txt = app_txt +'|'+ (cols[i].querySelector("input[type='checkbox']").value);
			}		
			}	
		}
		
	$('input[name="chk_ip"]').val(app_txt);
	//alert(querySelector("input[name='chk_ip']").value);exit;
	}
<?php }else{ ?>
<div  class="w3-card w3-center"  style="padding-top:18%;padding-bottom:20%"><span style=" color:#800000; font-size:24px; padding-left:55px;">
"ENROLLMENT OF STUDENT IS UNDER PROCESS"</span>
</div>
<?php } ?>
	<!-- end of script -->
</script>

 <script>
 <!-- script for calender -->
    var selDiv = "";
    document.addEventListener("DOMContentLoaded", init, false);
    function init() 
	{
        document.querySelector('#files').addEventListener('change', handleFileSelect, false);
        selDiv = document.querySelector("#selectedFiles");
    }
    function handleFileSelect(e) 
	{
        if(!e.target.files || !window.FileReader) return;
        selDiv.innerHTML = "";
        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);
        filesArr.forEach(function(f) {
            var f = files[i];
            if(!f.type.match("image.*")) {
                return;
            }

            var reader = new FileReader();
            reader.onload = function (e) {
                var html = "<img src=\"" + e.target.result + "\">" + f.name + "<br clear=\"left\"/>";
                selDiv.innerHTML += html;               
            }
            reader.readAsDataURL(f); 
        });
    }
	<!-- end of script for calender -->
	
    </script>
    