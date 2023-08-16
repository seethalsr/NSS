<?php if(isset($alert_msg)) echo $alert_msg;?>
<form name="frm1" id="frm1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" >
<input type="file" class="form-control" id="file1" name="file1"   />
<input type="submit" id="upload" name="upload" value="SUBMIT" />
</form>



