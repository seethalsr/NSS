<head>
<script>
function preview_images() 
{
 var total_file=document.getElementById("images").files.length;
 for(var i=0;i<total_file;i++)
 {
  $('#image_preview').append("<div class='col-md-3 w3-table-all' style='height:100px; width:250px;'><img class='img-responsive' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
 }
 var fwdso = document.getElementById("fwdso");
 var clr = document.getElementById("clr");
 fwdso.style.visibility = "visible";
 clr.style.visibility = "visible";
}
function preview_images_clr() 
{
  $('#image_preview').empty();
  document.getElementById("images").value="";
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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="form1" id="form1" enctype="multipart/form-data" >
<div class="card" style="padding-bottom:20px;" >
<h5 align="center"><b style="text-decoration:underline;">MANAGE FRONT PANNEL IMAGE</b></h5>
<?php if(isset($msg)){ print_r( $msg); }?><br />
<?php if($user_type=="assistant") {?>
<label class="control-label">Upload Picture</label>
<input  autocomplete="off" name="txt4[]" class=" form-control input-file" type="file" id="images" onchange="preview_images();" multiple >
<input type="reset" value="CLEAR" id="clr" onclick="preview_images_clr();"  style="visibility:hidden"/>
<div class="row" id="image_preview" style="padding-left:15px;"></div>
<input type="submit" name="fwdso" id="fwdso" value="SUBMIT" class="w3-button w3-green " style="visibility:hidden" />	
</div>
<?php } ?>
<div class="card"  >

<table cellpadding="0" cellspacing="0" width="100%">
<tr> 
<?php $c = 0; $n = 4; foreach($images as $value){ 
if($c % $n == 0 && $c != 0)
{   // New table row
    echo '</tr><tr>';
} $c++;?>
<td style="padding-left:5px; padding-bottom:8px;">
<input type="checkbox" name="chk[]"  <?php if($value['checked']=="1") echo "checked"; ?> value="<?php echo $value['photo_activity_id']; ?>"  />
<a href="<?php echo base_url($value['photo_full_path']); ?>" target="_blank"><img src="<?php echo base_url($value['photo_full_path']); ?>" /></a></td>
<?php } ?>
</tr>
</table>
<div align="center"><input type="submit" id="sub_f_img" name="sub_f_img" class="w3-button  w3-green " value="DISPLAY IN FRONT PANNEL" /> </div>
</div>


</form>
