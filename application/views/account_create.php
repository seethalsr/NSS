<!-- outer div-->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="form1" id="form1"  >
<table align="center" width="100%" class="comm_fnt_web" >
<tr  style="vertical-align:top;" >
<td width="2%"></td>
<td width="95%" class="w3-row-padding" height="500px">
<div class="w3-cardfaq"  >
<img src="<?php echo base_url();?>images/prin.svg" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:40px; padding-left:5px">
        	
<h4><fntn>Account Creation for Principal</fntn></h4>
<hr />
<div  style="padding-left:53px; padding-bottom:15px" >
<br />
  <?php if(isset($msg1)) echo $msg1;?><br />
 <?php if(isset($msg)) echo $msg;?>

 <table cellpadding="0" cellspacing="0" width="100%">
 <tr><td width="6"></td> <td width="208" style=" color:#800040; font-weight:bold;">District<span style="color:#F00;">*</span></td><td width="15">:</td><td width="809">
 <select id="dis" name="dis" class="form-control"  onchange="this.form.submit()" >
  <option value="">--Select--</option>  
  <option value="1" <?php if(isset($dis) && $dis=='1') echo 'selected';?> >ERNAKULAM</option>
   <option value="2" <?php if(isset($dis) && $dis=='2') echo 'selected';?>>KOTTAYAM</option>
    <option value="6" <?php if(isset($dis) && $dis=='6') echo 'selected';?>>IDUKKI</option>
     <option value="5"<?php if(isset($dis) && $dis=='5') echo 'selected';?> >ALAPPUZHA</option>
      <option value="10" <?php if(isset($dis) && $dis=='10') echo 'selected';?>>PATHANAMTHITTA</option>
 
</select>
 </td><td width="30"></td></tr>
 <tr><td colspan="5">&nbsp;</td></tr>
  <tr><td></td> <td style=" color:#800040;font-weight:bold;">College Name <span style="color:#F00;">*</span></td><td>:</td><td>
  <select id="coll" name="coll" class="form-control"   >
  <option value="">--Select--</option>
  <?php foreach($college_list as $value){?>
  <option value="<?php echo $value['college_id']; ?>" > <?php echo $value['college_name']; ?></option>
  <?php }?>
</select>
  </td><td></td></tr>
  <tr><td colspan="5">&nbsp;</td></tr>
   <tr><td></td> <td style=" color:#800040;font-weight:bold;">Principal Email Id <span style="color:#F00;">*</span></td><td>:</td><td><input type="text" name="email" id="email" size="80" /></td><td></td></tr>
   <tr><td colspan="5">&nbsp;</td></tr>
    <tr><td></td> <td style=" color:#800040;font-weight:bold;"><input type="submit" value="SUBMIT" id="sub" name="sub" /></td><td></td><td> </td><td></td></tr>
    
    <tr> <td style=" color:#800000;" colspan="4"><br /><br />
    NOTE : <br />
    1. After clicking on submit. Wait for some time, in order to sent mail to the registred email id.<br />
    2. Credential will be sent to your email id within 24 hrs.<br />
    3. Facing any issue regarding the NSS online portal, mail us at <b>donotreply.mgu.nss@gmail.com</b>
    
    
    </td></tr>
 
 
 </table>
 					
</div>
 </div>           

</td>
<td  width="5%" ></td>
 <td style="height:600px">&nbsp;</td>
 </tr>
</table>

</form>



