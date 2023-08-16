<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
<link href="<?php echo base_url();?>images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="<?php echo base_url();?>css/w3.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/w3-theme-blue-grey.css">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>KANNUR UNIVERSITY - NSS</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    

</head>
<div>

<table width="100%" class="w3-bar" style=" position:fixed;z-index:991; background-color:#006699;" >
		<tr>
			<td width="1%"></td>
			<td width="6%"  align="left"><img src="<?php echo base_url();?>images/logo-mgu123.png"  alt="" width="8"  style="width:60px; height:50px" ></td>
			<td width="32%" align="left">
				<fnt>MAHATMA GANDHI UNIVERSITY</fnt></br>
				<smlfnt>KOTTAYAM , INDIA</smlfnt><br>
			</td>
			<td width="34%" align="left"><fnt1>NATIONAL SERVICE SCHEME</fnt1></td>    
			<td width="20%">           
          </td>
            <td width="7%" align="left" ><img src="<?php echo base_url();?>images/NSS_H.jpg"  alt="" width="8"  style="width:60px; height:50px" ></td> 
		</tr>
        <tr height="10px;"></tr>
        
	</table>
</div>
<table align="left" border="0" cellpadding="5" cellspacing="0" height="100%" width="100%" bgcolor="#eeeeff" style="padding-top:10%;">
<tr><td><br /></td></tr>
<tr><td width="100%" height="100%" align="center" valign="top">
<form method="post"  name="submit_form" id="submit_form" onsubmit = "return check();" >
<table align="center" border="1"  cellspacing="0" width="50%" class="table_content" bordercolor="#fff">
<tr bgcolor="#069" align="center" class="sub_head"><td colspan="3">Cerificate Details</td></tr>
<tr><td>
<table align="center" border="0"  cellspacing="0" class="table_content" bordercolor="#fff" style="padding-bottom:10%;">
<tr><td height="40"></td></tr>
			
           
			<tr>
            	<td align="left">Enrollment No</td>
                <td align="left" height="40">:</td>
                <td align="left"><input type="text" name="certificate_no" id="certificate_no" class="input_type_class" size="30" maxlength="100" value="" autocomplete="off"/></td>
           	</tr>
            <tr>
            	<td align="left"></td>
                <td align="center"></td>
                <td align="left"><label><?php echo form_error('certificate_no'); ?></label></td>
           	</tr>
           
          
			
          <tr>
            	<td colspan="3" align="center" height="40"><input type="submit" size="38" name="submit" value="Submit" onclick="return validate();"/> 				</td>
    	</tr>
            
		</table>
        </td></tr></table>
        </form>
    </td></tr>
	
</table>
<div  class="w3-container  " style="background-color:#0076C7; border:0;border-top:1px solid #CCC;border-top-width:1px; margin-top:20%;"  >
<p align="center" style="font-size:12px ;color:#FFF">&copy; <?php echo date("Y");?> Mahatma Gandhi University. All Rights Reserved.<br />
    Powered by System Administration Team, Mahatma Gandhi University, Kottayam, Kerala </p>
</div>


