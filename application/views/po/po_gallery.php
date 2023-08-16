<head>
<script>
function preview_images() 
{
 var total_file=document.getElementById("images").files.length;
 for(var i=0;i<total_file;i++)
 {
  $('#image_preview').append("<div class='col-md-3 w3-table-all' style='height:100px; width:250px;'><img class='img-responsive' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
 }
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
<div class="card" >
<h4 align="center"><b style="text-decoration:underline;">CREATE GALLERY</b></h4>
<label class="control-label">Upload Picture</label>
<input  autocomplete="off" name="txt4[]" class=" form-control input-file" type="file" id="images" onchange="preview_images();" multiple >
<input type="reset" value="CLEAR" onclick="preview_images_clr();" />
<div class="row" id="image_preview" style="padding-left:15px;"></div>
</div>
<input type="submit" name="fwdprinci" id="fwdprinci" value="FORWARD TO PRINCIPAL"  />	
</form>
