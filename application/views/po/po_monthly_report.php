<?php //print_r($monthly_report_data);exit;?><head>
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
</head>

<style>
    #selectedFiles img {
        max-width: 125px;
        max-height: 125px;
        float: left;
        margin-bottom:10px;
    }
</style>
<link rel = "stylesheet" href = "<?php echo base_url();?>css/jquery-ui.css"   >
<script src="<?php echo base_url();?>js/jquery-ui.js"></script>
<script>
$(function() {
$( "#fromdatepicker" ).datepicker({dateFormat:'dd-mm-yy'});
 $( "#todatepicker" ).datepicker({dateFormat:'dd-mm-yy'});
});
</script>
<div class="w3-center" style="padding-bottom:0px">
<span ><?php if(isset($msg)){?><h6  style="color:#F00; "><?php echo $msg; ?></h6><?php }?></span><br>

<h4 align="center"><b style="text-decoration:underline;color:#3b579d;">MONTHLY REPORT</b></h4>
<hr>
</div>
<?php // echo $to_date;exit;?>
<?php $curr_yr = date("Y"); ; $prev_yr = date("Y",strtotime("-1 year"));?>
<form name="frm1" id="frm1" method="post"   action="<?php echo base_url(); ?>Po/NssPo/po_monthly_report" enctype="multipart/form-data"  >
        <table cellpadding="0" cellspacing="0" width="100%" align="center">
        <tr>
        <td width="1%"></td>
        <td width="6%"><label class=" control-label" for="selectbasic"> Year :<a style="color:#FF0000;font-size:18px;">*</a></label></td><td width="2%">&nbsp;</td>
        <td width="10%"><select id="year" name="year" class="form-control"  onchange="this.form.submit()">
        <option value="">--Select--</option>             
        <option value="<?php echo date("Y"); ?>" <?php if(set_value("year")== date("Y")) echo "selected";?>> <?php echo date("Y") ?></option> 
        <option value="<?php echo date("Y",strtotime("-1 year"));?>" <?php if(set_value("year")==date("Y",strtotime("-1 year"))) echo "selected";?>> <?php echo date("Y",strtotime("-1 year")) ?></option> 
        </select></td>
        <td width="3%">&nbsp;</td>
        <td width="7%"><label class=" control-label" for="selectbasic"> Month :<a style="color:#FF0000;font-size:18px;">*</a></label></td>
        <td width="2%"></td>
        <td width="12%">
        <select id="month" name="month" class="form-control" onchange="this.form.submit()" >
        <option value="">--Select--</option>
        <option value="01" <?php if(set_value("month")== '01') echo "selected";?> >January</option>
        <option value="02" <?php if(set_value("month")== '02') echo "selected";?> >February</option>
        <option value="03" <?php if(set_value("month")== '03') echo "selected";?> >March</option>
        <option value="04" <?php if(set_value("month")== '04') echo "selected";?> >April</option>
        <option value="05" <?php if(set_value("month")== '05') echo "selected";?> >May</option>
        <option value="06" <?php if(set_value("month")== '06') echo "selected";?> >June</option>
        <option value="07"  <?php if(set_value("month")== '07') echo "selected";?> >July</option>
        <option value="08" <?php if(set_value("month")== '08') echo "selected";?> >August</option>
        <option value="09" <?php if(set_value("month")== '09') echo "selected";?> >September</option>
        <option value="10"<?php if(set_value("month")== '10') echo "selected";?> >October</option>
        <option value="11"<?php if(set_value("month")== '11') echo "selected";?> >November</option>
        <option value="12" <?php if(set_value("month")== '12') echo "selected";?> >December</option>
        </select>
        </td>
        <td width="2%">&nbsp;</td>
        <td width="22%"><?php if((isset($year_sel))&&(isset($month_sel))){?><a href="<?php echo base_url(); ?>Po/NssPo/po_monthly_report_view/<?php echo $year_sel; echo $month_sel_n;?>" target="_blank"> View Monthly Report of <?php echo $month_sel; ?></a><?php } ?></td>
        <td width="3%">&nbsp;</td>
        <td width="29%"><?php if(isset($year_sel)){?><a href="<?php echo base_url(); ?>Po/NssPo/po_monthly_report_view/<?php echo $year_sel;?>" target="_blank" > View Yearly Report</a><?php } ?></td>
        <td width="1%"></td>
        
        </tr>
        <tr><td colspan="13">&nbsp; </td></tr>
        <tr><td colspan="13">
        <?php if(isset($display)&& $display =="1"){?>
        <h6 class="w3-center"><span style="color:#000080; " >Monthly Report of <?php echo $month_sel; ?></span></h6>
        <hr>
        
          <table cellpadding="0" cellspacing="0" width="100%" >
          <tr><td colspan="5">&nbsp;</td></tr>
          <tr><td colspan="5">
          <table width="97%" cellpadding="0" cellspacing="0" ><tr>
          <td width="15%"><label class=" control-label">From Date:</label></td>
          <td width="1%">&nbsp;</td>
          <td width="34%"><input type="text" class="form-control" id="fromdatepicker" name="fromdatepicker"   autocomplete="off"    
          value="<?php if(isset($start_date)){ if($start_date != '') {echo date("d-m-Y", strtotime($start_date));}}elseif(isset($data_input['from_date'])){ echo $data_input['from_date'];} ?>" 
           ></td>
          <td width="2%">&nbsp;</td>
          <td width="12%"><label class=" control-label">To Date:</label></td>
          <td width="1%">&nbsp;</td>
          <td width="34%"><input type="text" class="form-control" id="todatepicker" name="todatepicker"   autocomplete="off"   onchange="this.form.submit()"
         
          value="<?php if(isset($to_date)){  if($to_date != ''){echo date("d-m-Y", strtotime($to_date)); }}elseif(isset($data_input['to_date'])) echo $data_input['to_date'];?>" 
          ></td>
          <td width="1%">&nbsp;</td>
          </tr>
          </table>
          </td>
          </tr>
          <tr class="msg_red"><td colspan="2"><?php echo form_error('fromdatepicker');?></td><td>&nbsp;</td><td colspan="2"><?php echo form_error('fromdatepicker');?></td></tr>
          <tr>
          <td width="11%"><label class=" control-label">Heading</label></td>
          <td width="11%">&nbsp;</td>
          <td  colspan="2"><input type="text" class="form-control input-sm" id="head" name="head" 
          value="<?php if(isset($monthly_report_data[0]['heading'])){  echo $monthly_report_data[0]['heading'];}elseif(isset($data_input['head'])) echo $data_input['head']; ?>" ></td>
          <td width="3%">&nbsp;</td>
          </tr>
          <tr ><td colspan="5"><span style="color:#FF0000;"><?php echo form_error('head');?></span></td></tr>
          <tr>
          <td><label class=" control-label">Content</label></td>
          <td width="11%">&nbsp;</td>
          <td colspan="2" ><textarea id="content_area" name="content_area"   rows="5" class="form-control"  style="resize:none">
          <?php if(isset($monthly_report_data[0]['content'])){ 
           echo $monthly_report_data[0]['content'];  }elseif(isset($data_input['content'])) echo $data_input['content'];?>
          </textarea></td>
          <td width="3%" >&nbsp;</td>
          </tr>
          <tr ><td colspan="5" ><span style="color:#FF0000;"><?php echo form_error('content_area');?></span></td></tr>
         <?php if(!isset($monthly_report_data[0]['content'])){ ?> <tr><td><label class="control-label">Upload Picture , If any</label></td><td>&nbsp;</td>
          <td width="28%"><input  autocomplete="off" name="txt4[]" class=" form-control input-file" type="file" id="images" onchange="preview_images();" multiple ><div class="row" id="image_preview" style="padding-left:15px;"></div>
		  </td><td width="47%">&nbsp;</td>
          <td>&nbsp;</td></tr><?php } ?>
          <tr><td colspan="5">&nbsp;</td></tr>
          </table>
        <div class="w3-center">
        <input type="submit" class="btn btn-primary" value="Save" name="save" id="save" style="background-color:#0080FF; color:#FFF"/>
        <?php if(isset($monthly_report_data)&& !empty($monthly_report_data)){ ?><input type="submit" class="btn btn-primary" value="Forward  <?php echo $month_sel;?> Report to Principal" name="fwde" id="fwde" style="background-color:#008080; color:#FFF"/>
       <?php } ?> </div> 
        <?php } ?>
        </td></tr>
        </table>
</form>
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