<style>
    #selectedFiles img {
        max-width: 125px;
        max-height: 125px;
        float: left;
        margin-bottom:10px;
    }
</style>
<script>
function preview_images() 
{
 var total_file=document.getElementById("images").files.length;
 for(var i=0;i<total_file;i++)
 {
  $('#image_preview').append("<div class='col-md-3 w3-table-all' style='height:100px; width:250px;'><img class='img-responsive' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
 }
}
</script>
<link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css">  
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script>
<script type="text/javascript"> 
$(function() {
   $( "#from_date" ).datepicker({
	   dateFormat: 'dd-mm-yy' 
	   });
	    $( "#to_date" ).datepicker({
	   dateFormat: 'dd-mm-yy' 
	   });
 
});
</script>

<?php if(isset($show)&& $show== 1){ ?>
<link rel = "stylesheet" href = "<?php echo base_url();?>css/jquery-ui.css"   >
<script src="<?php echo base_url();?>tab/js/bootstrap.min.js"></script>  
<script src="<?php echo base_url();?>js/jquery-ui.js"></script>
<span ><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg;//exit; ?></h6><?php }?></span><br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="form1" id="form1" enctype="multipart/form-data" >
<h4 align="center"><b style="text-decoration:underline;">ENTER CAMP DETAILS</b></h4>
<div class="card">
<table cellpadding="0" cellspacing="0" width="100%" >
<tr><td width="0%"></td>
<td colspan="3"><span  style=" font-weight:bold; font-size:14px">CAMP TYPE</span></td><td width="2%"></td>
<td colspan="3">
<input type="radio" checked="checked" id="spl" name="cmp" value="spl"  /> <label for="spl"  style="color:#000;font-size:14px;">SPECIAL CAMP </label>
<input type="radio" id="m1" name="cmp" value="mini1" />  <label for="mini1" style="color:#000;font-size:14px;" >MINI CAMP 1 </label>
<input type="radio" id="m2" name="cmp" value="mini2"  />  <label for="mini2" style="color:#000;font-size:14px;" > MINI CAMP 2 </label>
</td><td width="3%"></td>
</tr>
<tr><td colspan="9">&nbsp;</td></tr>
<tr><td></td><td width="15%"><span  style=" font-weight:bold; font-size:14px">FROM DATE:</span></td>
<td width="1%"></td>
<td width="21%"> <input type="text" id="from_date" name="from_date" class="form-control input-sm" placeholder="DD-MM-YYYY"  value="<?php if(isset($data_input['from_date'])) echo $data_input['from_date'];?>"/></td><td></td><td width="18%"><span  style=" font-weight:bold; font-size:14px">TO DATE:</span></td>
<td width="7%"></td>
<td width="33%"><input type="text" id="to_date" name="to_date" class="form-control input-sm" placeholder="DD-MM-YYYY"  value="<?php if(isset($data_input['to_date'])) echo $data_input['to_date'];?>"/></td><td></td></tr>
<tr  class="msg_red"><td colspan="4"><?php echo form_error('from_date');?></td><td>&nbsp;</td><td colspan="4"><?php echo form_error('to_date');?></td></tr>
<tr><td></td><td><span  style=" font-weight:bold; font-size:14px">CAMP SITE:</span></td><td></td><td colspan="4"><textarea id="dest" name="dest" maxlength="250" style="resize:none;" class="form-control input-sm"><?php if(isset($data_input['dest'])) echo $data_input['dest'];?> </textarea></td><td></td></tr>
<tr class="msg_red"><td colspan="9"><?php  echo form_error('dest');?></td></tr>
<tr><td></td><td><span  style=" font-weight:bold; font-size:14px">ACTIVITIES:</span></td><td></td><td colspan="4"><textarea id="act" name="act" style="resize:none;" maxlength="500" class="form-control input-sm"><?php if(isset($data_input['act'])) echo $data_input['act'];?></textarea></td><td></td></tr>
<tr class="msg_red"><td colspan="9"><?php  echo form_error('act');?></td></tr>
<tr><td></td><td><span  style=" font-weight:bold; font-size:14px">HOURS:</span></td><td></td><td>
<input type="text" id="hr" name="hr" size="3" class="form-control input-sm"  value="<?php if(isset($data_input['hr'])) echo $data_input['hr'];?>" onKeyPress="return input_number(event)" maxlength="3"/></td><td></td><td><span  style=" font-weight:bold; font-size:14px">UPLOAD IMAGE:</span></td><td></td>
<td><input type="file" class="form-control" id="images" name="txt4[]"  onchange="preview_images();" multiple/><div class="row" id="image_preview" style="padding-left:15px;"></div> </td><td></td></tr>
<tr  class="msg_red"><td colspan="4"><?php  echo form_error('hr');?></td><td></td><td colspan="4"></td></tr>
<tr><td colspan="9" class="w3-center">
<a href="#" data-toggle="modal" data-target="#modaladd_parti" style="text-decoration:underline; font-size:14px; color:#000;"><b>ADD PARTICIPANTS</b></a>
 <!-- add participants modal -->


<!-- add participants modal -->
<div id="modaladd_parti" class="modal fade" role="dialog" data-backdrop="false">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align-last: center">Add New Participants</h4>
            </div>
            <div class="modal-body">
				 <h4 class="w3-center"><fntn>STUDENTS UNDER <?php echo $unit; ?>  </fntn></h4>
<hr />
                    <table id="res" class="table table-striped table-bordered dt-responsive nowrap dataTable">
                      <thead>
                        <tr>
						  <th class="check"><input type="checkbox" id="flowcheckall" value="" />All</th>
                          <th>Enrollment No:</th>
						  <th>PRN No:</th>
                          <th>Student Name</th>
                          <th>Semester</th>
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
					  <td><?php echo $value['current_semester']; ?></td>
					  </tr>
					  <?php } ?>
                      </tbody>
                    </table>
            </div>
            <div class="modal-footer">
			<input type="hidden" name="chk_ip" id="chk_ip"  />
                <input type="submit" id="save_stud" name="save_stud" value="SAVE" onclick="myCheck()" class="w3-button  w3-green " />
                 <button type="button" class="w3-button  w3-grey"   data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
</td></tr>
<tr><td colspan="9">&nbsp;</td></tr>
</table>
</div>

</form>
 <script src="<?php echo base_url();?>tab/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>tab/js/dataTables.bootstrap.min.js"></script><!--pagination- pointer not that mauch important-->   
    <!-- Custom Theme Scripts need -->
    <script src="<?php echo base_url();?>tab/js/custom.min.js"></script> 

<script>
	$(document).ready(function () {
    var str = "";
    oTableStaticFlow = $('#res').DataTable({
        "aoColumnDefs": [{
            'bSortable': false,
            'aTargets': [0]
        }],
    });

    $("#flowcheckall").click(function () {
        //$('#flow-table tbody input[type="checkbox"]').prop('checked', this.checked);
        var cols = oTableStaticFlow.column(0).nodes(),
            state = this.checked;
        
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
</script>
<?php }else{ ?>
<div  class="w3-card w3-center"  style="padding-top:18%;padding-bottom:20%"><span style=" color:#800000; font-size:24px; padding-left:55px;">
ENROLLMENT OF STUDENT IS UNDER PROCESS</span>
</div>

<?php } ?>

 <script>
    var selDiv = "";
        
    document.addEventListener("DOMContentLoaded", init, false);
    
    function init() {
        document.querySelector('#files').addEventListener('change', handleFileSelect, false);
        selDiv = document.querySelector("#selectedFiles");
    }
        
    function handleFileSelect(e) {
        
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
    </script>