<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/easyui.css">
<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
<?php  ?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data" name="form1" id="form1">


<hr>
<table cellpadding="0" cellspacing="0"  width="100%">
<tr><td colspan="2"></td>
<td width="7%"><label class=" control-label">Year:</label></td><td width="14%"><select id="year" name="year" class="form-control" onchange="this.form.submit()" >
<option value="">--Select--</option>             
<option value="<?php echo date("Y"); ?>" <?php if(set_value("year")== date("Y")) echo "selected";?>> <?php echo date("Y") ?></option> 
<option value="<?php echo date("Y",strtotime("-1 year"));?>" <?php if(set_value("year")==date("Y",strtotime("-1 year"))) echo "selected";?>> <?php echo date("Y",strtotime("-1 year")) ?></option> 
</select>
</td><td width="43%" colspan="2"></td></tr>

<tr><td colspan="5">&nbsp;</td></tr></table>
</div>
<div class="easyui-tabs" style="width:1050px;height:420PX;">
		<div title="ENTER MONTHLY ATTENDANCE"  style="padding:10px;">
        <?php echo $spana ;?>
        </div>
        <div title="VIEW MONTHLY ATTENDANCE"  style="padding:10px;">
        <?php echo $spanb; ?>
        </div>
</div>        
        
</form>
