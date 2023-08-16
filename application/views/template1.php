<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>KANNUR UNIVERSITY-NSS</title>
<link href="<?php echo base_url();?>images/favicon1.ico" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="<?php echo base_url();?>css/w3.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/w3-theme-blue-grey.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>engine1/style.css" />
<link rel="stylesheet" href="<?php echo base_url();?>font-awesome/css/font-awesome.min.css"> 
 
<script type="text/javascript" src="<?php echo base_url();?>engine1/jquery.js"></script>
</head>
<body>
<?php //echo $msg;exit; ?>
<table cellpadding="0" cellspacing="0"  width="100%"    >
<!-- header-->
<tr class="temp1_header">
<td width="2%"></td>
<td width="38%" height="115"  class="temp1_header_mgu"  >
<table cellpadding="0" cellspacing="0" width="97%" >
<tr>
<td width="3%">&nbsp;</td>
<td width="18%" height="100"><img src="<?php echo base_url();?>images/kulogo.jpg"  alt="" width="8"  style="width:120px; height:70px; padding-right:5px;" /><br />
  <br /></td>
<td width="79%">
<span >KANNUR  UNIVERSITY</span><br />
  <span class="temp1_header_ktm" >KANNUR,INDIA</span><br /><br />
</td>
</tr></table>
</td>
<td width="44%" class="temp1_header_nss">NATIONAL SERVICE SCHEME</b></td>
<td width="2%"></td>
<td width="16%"><img src="<?php echo base_url();?>images/NSS_H.jpg"  alt="" width="8"  style="width:130px; height:80px;; padding-left:20px;"  ><br /> 
  <span class="temp1_header_ktm" style="padding-left:15px;">NOT ME BUT YOU</span></td>
  
  </tr>

<!-- menu-->
<tr><td  colspan="5">
	
<ul class="ul_style w3-center"  >
  	<li class="li_style"><a href="<?php echo base_url();?>">HOME</a></li>
  	<li class="li_style"><a href="<?php echo base_url();?>Nsscontrol/about">ABOUT US</a></li>
  	<li class="dropdown li_style"><a href="javascript:void(0)" class="dropbtn">NSS UNITS</a>
         <div class="dropdown-content" >
           <a href="<?php echo base_url();?>Nsscontrol/college_list" >COLLEGE LIST</a> 
            <a href="<?php echo base_url();?>Nsscontrol/list_po" >PROGRAM OFFICER LIST</a>
        </div>
    </li>
    <li class="li_style"><a href="<?php echo base_url();?>Nsscontrol/blood_bank">BLOOD BANK</a></li>
	<li class="li_style"><a href="<?php echo base_url();?>Nsscontrol/faq">FAQ</a></li>
   <li class="li_style"><a href="<?php echo base_url();?>Nsscontrol/awards">AWARDS</a></li>
    <li class="li_style"><a href="<?php echo base_url();?>Nsscontrol/gallery">GALLERY</a></li>
    <li class="li_style"><a href="<?php echo base_url();?>Nsscontrol/download">DOWNLOADS</a></li>
    <li class="li_style"><a href="<?php echo base_url();?>Nsscontrol/contact">CONTACT US</a></li> 
</ul>
</td></tr>
<tr>
  <td height="5" colspan="5">&nbsp;</td>
</tr>
<!-- body-->
<tr ><td height="134"  colspan="5">
<table cellpadding="0" cellspacing="0" width="100%" height="100%" >
<tr><td width="1%"></td>
<td width="15%" style="background-color:#FFF" valign="top">
<!-- vertical menu-->
<div class="vertical-menu w3-container  w3-card-2 w3-round w3-white w3-left">
 <p align="center" style="color:#800080; font-weight:bold">MAIN MENU</p>
  <a href="<?php echo base_url();?>upload/website/NSSMANUAL.pdf" target="_blank" class="active">NSS Manual</a>
  <a href="<?php echo base_url();?>Nsscontrol/aim">Aim and Objective</a>
  <a href="<?php echo base_url();?>Nsscontrol/pgm">NSS Programmes</a>
  <a href="<?php echo base_url();?>Nsscontrol/acti">Regular Activities</a>
  <a href="<?php echo base_url();?>Nsscontrol/sp">Special Programmes</a>
   <a href="<?php echo base_url();?>Nsscontrol/sc">Special Camp</a>

<!--login-->
  
       <?php if(isset($captcha)) {?>
          <form name="form_login" id="form_login" method="post"  action="<?php echo base_url();?>Nsscontrol/login/">
		  <p style="border:1px solid blue;"></p>
            <p align="center" style="color:#800080; font-weight:bold">LOGIN</p>
             <?php if( isset($login_error)){?>
            <label style="color:#F00;" > <?php echo($login_error); ?></label>
            <?php }?>
            
			<div class="container w3-center ">
    		<input type="text"  name="uname" id="uname" required placeholder="Enter Username" class="form-control input-sm chat-input" style="background-color:#E9E9F3; text-align:center; margin-bottom:20px"  >
			<input type="password"  name="psw" id="psw" onkeypress="return RestrictSpace()" required placeholder="Enter Password" class="form-control input-sm chat-input" style="background-color:#E9E9F3;text-align:center; margin-bottom:15px" >
			<div><input type="text" disabled="disabled" value="<?php echo $captcha;?>" size="7"  style="background-color:#000; color:#FFF; text-align:center;margin-bottom:15px;" class="stripe-7" />			 <a href="<?php echo base_url();?>/Nsscontrol" id="new_captcha"><img src="<?php echo base_url();?>/images/refresh.jpg" width="15" height="15" border="0" alt="Reload Security Code" title="Reload Security Code" /></a></div>
            <input autocomplete="off" name="math_captcha" id="math_captcha"  type="text" onkeypress="return RestrictSpace()" required placeholder="Evaluate the above" class="form-control input-sm chat-input" style="background-color:#E9E9F3;text-align:center; margin-bottom:15px" >
            <button name="login_but" id="login_but" type="submit" class="button">Login</button>   
			</div>
  			<div class="container" style="background-color:#FFF; padding-top:10px;">
    
    		<span class="psw">
          </span>
          
  			</div>
			</form>
            <?php } ?>
        </div>
		<div id="id01" class="w3-modal" style="z-index:999">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
  
      <div class="w3-center"><br>
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-transparent w3-display-topright" title="Close Modal">×</span>
      </div>

      <form name="frm" id="frm" class="w3-container"  method="post"  action="<?php echo base_url();?>Nsscontrol/forgot_pwd">
        <div class="w3-section">
			<span  class="w3-center astrix_red"><?php if(isset($msg) ){ echo $msg;}?></span><br />
          <label><b>username</b></label>
          <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="usrname" required >
        </div>
      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
        <input type="submit" value="SUBMIT" id="sub" name="sub"  class="w3-button w3-right w3-green "  />
      </div>
</form>
    </div>
</div>
<!-- end of login-->
</td>
<td width="1%"></td>
<td width="79%"><?php echo $span; ?></td>

</tr>
</table>
</td>
</tr>
<!-- footer-->
<tr><td colspan="5">
<div style="padding-top:10px; background-color:#ededed;" >
<footer  class="w3-container   w3-padding-32 " style="background-color:#333">
   <table width="100%" cellpadding="0" cellspacing="0" height="100%" >
   <tr><td width="271">
   <a href="https://www.mappls.com/opdsct"
    target="_blank">
	<img src="<?php echo base_url();?>images/address.svg"  alt="" width="8"  style="width:60px; height:50px" ></a>
	<p align="left" style="color:#FFF; font-size:16px; padding-left:39px;"><strong> Contact Us</strong></p>
	<p align="justify" style=" padding-left:39px; color:#FFF">
	Kannur University <br />
	Civil station
  PO<br />Thavakkara<br />
   Kannur, Kerala <br />
   Pin 670002
	<br />
</p>
	</td>
	<td width="13" style="border:0;border-left:1px solid #FFF;margin:0px 0"></td>
	<td width="5"></td>
	<td width="545" align="center" style="color:#FFF">
	Talk About Us @
	<br />
	<a href="https://www.facebook.com/kannuruniversityofficial" class="fa fa-facebook"></a>
	<a href="https://twitter.com/" class="fa fa-twitter"></a>
	<a href="https://www.google.co.in/" class="fa fa-google"></a>
	<a href="https://www.linkedin.com/" class="fa fa-linkedin"></a>
	<a href="https://www.youtube.com/" class="fa fa-youtube"></a>
	<a href="https://www.instagram.com/kannuruniversityofficial/" class="fa fa-instagram"></a>
	</td>
<td width="25" style="border:0;border-left:1px solid #FFF;margin:0px 0"></td>
<td width="12"></td>
<td width="206" align="center" style="color:#FFF">
<p> Know More About Us At: <a href="https://www.kannuruniversity.ac.in/en/" style="color:#FFF" target="_blank">kannuruniversity.ac.in</a> </p>
 Contact State Officers at:
 <p> <a href="http://nss.gov.in/" target="_blank" style="color:#FFF">NSS NIC</a>
								<a href="http://www.dhsenss.kerala.gov.in" target="_blank" style="color:#FFF">NSS DHSE</a></p>
</td>
<td width="20"></td></tr>
</table>  


<footer class="w3-container  w3-padding-16" style="background-color:#333; border:0;border-top:1px solid #CCC;border-top-width:1px; margin-top:20px ">

   <p align="center" style="font-size:12px ;color:#FFF">&copy; <?php echo date("Y");?> kannur University. All Rights Reserved by CITAD, <br />Kannur University,Kannur, Kerala </p>
</footer>

</div>
</td></tr>
</table>
</body>
</html>
<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
function RestrictSpace() {
    if (event.keyCode == 32) {
        return false;
    }
}

<?php if(set_value('sub'))
{?>
$('#fopwd').click();
<?php } ?>

</script>
<script type="text/javascript" src="<?php echo base_url();?>engine1/wowslider.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>engine1/script.js"></script>
