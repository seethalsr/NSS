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


    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url();?>admin_dashboard/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?php echo base_url();?>admin_dashboard/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="<?php echo base_url();?>admin_dashboard/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url();?>admin_dashboard/css/pe-icon-7-stroke.css" rel="stylesheet" />
	<script src="<?php echo base_url();?>admin_dashboard/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>admin_dashboard/js/bootstrap.min.js"></script>

</head>
<body>
<div>
<table width="100%" class="w3-bar" style=" position:fixed;z-index:991; background-color:#128ea8" >
		<tr>
			<td width="1%"></td>
			<td width="6%"  align="left"><img src="<?php echo base_url();?>images/mgu-logo.png"  alt="" width="8"  style="width:60px; height:50px" ></td>
			<td width="32%" align="left">
				<fnt>MAHATMA GANDHI UNIVERSITY</fnt></br>
				<smlfnt>KOTTAYAM , INDIA</smlfnt><br>
			</td>
			<td width="34%" align="left"><fnt1>NATIONAL SERVICE SCHEME</fnt1></td>    
			<td width="20%">           
          </td>
            <td width="7%" align="left" ><img src="<?php echo base_url();?>images/nss.jpg"  alt="" width="8"  style="width:60px; height:50px" ></td> 
		</tr>
        <tr height="10px;"></tr>
	</table>
</div>
    
<div class="wrapper" style="padding-top:3.1%;">
<table width="100%">

<tr >
<td width="57%" rowspan="2" style="position:fixed; height:560px ; width:25%"><!--sidebar-->
<?php echo $princispan1; ?>
</td>
<td  style="width:100%; position:fixed; height:5px; "><!--topcontentbar--><?php echo $princispan2; ?>
                                
</td></tr>
<tr >
  <td style="width:100%;  height:550px;  padding-left:290px; vertical-align:top; padding-top:80px; "><!--body-->
  <?php echo $princispan3; ?></td>
</tr></table>
<table width="100%">
<tr>
<td style="height:5%;width:100%;padding-top:12px; " colspan="2"><!--footer-->
 <footer class="footer">
            <div class="container-fluid" style=" background: linear-gradient(to bottom, #000 0%, #000 100%);">               
                <p align="right" style="font-size:12px ;color:#FFF">&copy; <?php echo date("Y");?> Mahatma Gandhi University. All Rights Reserved.<br />
    Powered by System Administration Team, Mahatma Gandhi University, Kottayam, Kerala </p>
            </div>
        </footer>

</td></tr>

</table>
</div>
</body>