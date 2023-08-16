

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
 
 
<table border="0" cellpadding="0" cellspacing="10" align="center" class="cert_teplat_cls" style="padding-top:5%">
<tr>
	<td align="center" colspan="3"><h2>MG UNIVERSITY - NSS CERTIFICATE VERIFICATION REPORT</h2></td>
</tr>
<tr>
	<td align="center" colspan="3">Generated On <?php echo date('d-m-Y H:i:s'); ?></td>
</tr>

<tr>
	<td align="center" colspan="3"><h3><b><u>Details of the Enrollment no. <?php echo $result_value['enroll_no'];?> Issued on <?php echo $result_value['iss_on'];?></u></b></h3> </td>
</tr>
<br /><br />
<tr><td align="center" colspan="3"><table  cellpadding="0" cellspacing="0" frame="box">
<tr >
 <td width="20px;">&nbsp;</td>
	<td align="left" height="20" style="color:#0080FF;">Personal Register Number to whom certificate is issued</td>
    <td width="20px;">:</td>
    <td align="left" height="20"><?php echo $result_value['prn'];?></td>
     <td width="20px;">&nbsp;</td>
</tr>

<tr >
 <td width="20px;">&nbsp;</td>
	<td align="left" height="20" style="color:#0080FF;">Name of Person to whom certificate is issued</td><td width="20px;">:</td>
    <td align="left" height="20"><?php echo $result_value['name'];?></td> <td width="20px;">&nbsp;</td>
</tr>
 
<tr> <td width="20px;">&nbsp;</td>
	<td align="left" height="20" style="color:#0080FF;">Name of University/Institution where the Volunteer studied</td><td width="20px;">:</td>
    <td align="left" height="20"><?php echo $result_value['college_name'];?></td> <td width="20px;">&nbsp;</td>
</tr>
<tr> <td width="20px;">&nbsp;</td>
	<td align="left" height="20" style="color:#0080FF;">Course studied by the Volunteer</td><td width="20px;">:</td>
    <td align="left" height="20"><?php echo $result_value['course'];?></td> <td width="20px;">&nbsp;</td>
</tr>
<tr> <td width="20px;">&nbsp;</td>
	<td align="left" height="20" style="color:#0080FF;">Enrolled NSS Batch</td><td width="20px;">:</td>
    <td align="left" height="20"><?php echo $result_value['nss_batch'];?></td> <td width="20px;">&nbsp;</td>
</tr>
<tr> <td width="20px;">&nbsp;</td>
	<td align="left" height="20" style="color:#0080FF;">Enrolled NSS Unit</td><td width="20px;">:</td>
    <td align="left" height="20"><?php echo $result_value['nss_unit'];?></td> <td width="20px;">&nbsp;</td>
</tr>
<tr> <td width="20px;">&nbsp;</td>
	<td align="left" height="20" style="color:#0080FF;">Name of the NSS Programme Co-ordinator  Verified by:</td><td width="20px;">:</td>
    <td align="left" height="20"><?php echo $result_value['verified_by'];?></td> <td width="20px;">&nbsp;</td>
</tr>
<tr> <td width="20px;">&nbsp;</td>
	<td align="left" height="20" style="color:#0080FF;">Verified Person Designation:</td><td width="20px;">:</td>
    <td align="left" height="20"><?php echo $result_value['verified_desig'];?></td> <td width="20px;">&nbsp;</td>
</tr>
<tr> <td width="20px;">&nbsp;</td>
	<td align="left" height="20" style="color:#0080FF;">Verified on:</td><td width="20px;">:</td>
    <td align="left" height="20"><?php echo $result_value['verified_on'];?></td> <td width="20px;">&nbsp;</td>
</tr>


</table>
 