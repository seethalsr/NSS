
<table width="100%" height="100%" cellpadding="0" cellspacing="0">
<tr>
<td width="1%" height="208"></td>
<td width="79%" class="w3-round">
 <div class="w3-center"><b>Welcome to NSS - KANNUR UNIVERSITY</b></div>
      <div id="wowslider-container1">
				    <div class="ws_images"><ul>
					<?php foreach ($dataact as $value){ 
					 ?>
					<li><img src="<?php echo base_url($value['photo_full_path']);?>" width="100"  height="450"alt="1" title="1" id="wows1_0"/></li>
					<?php  unset($value);}?>
					
					</ul></div>	
	  </div></td>
<td width="1%"></td>
<td width="18%" rowspan="2" valign="top">
<table class="w3-card" cellpadding="0" cellspacing="0" height="100%" width="100%" >
<!--<tr><td height="117" class="w3-center">
<img src="<?php echo base_url();?>upload/website/officers/vc.PNG" alt="img" height="100px;" width="100px;"/>
</td>
</tr>
<tr><td height="23" align="center" valign="top"> <b style="font-size:14px;">VICE-CHANCELLOR</b><br />Dr. Babu Sebastian</td>
</tr>-->
<tr><td height="21">&nbsp;</td>
</tr>
<tr><td class="w3-center" height="100">
<img src="<?php echo base_url();?>upload/website/officers/vcku.jpg" alt="img" height="100px;" width="100px;"/>
</td></tr>
<tr><td height="21" align="center"><b style="font-size:14px;">VICE-CHANCELLOR</b><br />Prof. Gopinath Ravindran</td>
</tr>
<tr><td height="21">&nbsp;</td>
</tr>
<tr><td class="w3-center" height="100">
<img src="<?php echo base_url();?>upload/website/officers/registrarku.jpg" alt="img" height="100px;" width="100px;"/>
</td></tr>
<tr><td height="21" align="center"><b style="font-size:14px;">REGISTRAR(Incharge)</b><br />Prof. (Dr.) Joby K Jose</td>
</tr>
<tr><td >&nbsp;</td></tr>
<tr><td class="w3-center" height="100">
<img src="<?php echo base_url();?>upload/website/officers/nsspgm.jpg" alt="img" height="100px;" width="100px;"/>
</td></tr>
<tr><td height="21" align="center"><b style="font-size:14px;">NSS PROGRAMME CO-ORDINATOR</b><br />Dr.Nafeesa Baby T.P  </td>
</tr>
<tr><td ></td></tr>
<tr><td class="  w3-card-2  w3-round w3-white   " >
<div  style="line-height:25px;min-height:258px; ">
		  <p style="border:1px solid blue;"></p>

<p align="center" style="color:#800080; font-weight:bold">LATEST NEWS</p>
<div class="wordbreak" style="width:228px">
		<marquee id="test" direction="up" onmouseover="document.all.test.stop()"  onmouseout="document.all.test.start()">
                      <ul>
                      <?php if(isset($notice_detail)){
						  foreach($notice_detail as $value){?>
                      <li style="text-transform:uppercase;"><a href="<?php echo base_url();?>upload/website/notice/<?php echo $value['path'];?>.pdf" style=" text-decoration:none;" target="_blank"><?php echo $value['heading'];?></a></li>
                      <?php }}?>
                      
        </ul>
        </marquee></div>
</div>
</td></tr>
</table>
 <!-- notice-->

<!-- end of notice--></td>
<td width="1%"></td>
</tr>

<tr><!--about-->
<td></td>
<td class="w3-card-2 w3-round w3-white w3-left-margin"; valign="top" >

<p align="left" style="padding-left:35px;color:#400040;font-size:18px;vertical-align:middle;font-weight:bold;">NATIONAL SERVICE SCHEME</p>
 

  		 			 <p style="padding-left:30px; padding-right:5px; text-align:justify; width:98%;" ><img src="<?php echo base_url();?>images/nss.png" alt="Avatar" class="w3-left  w3-margin-right" style="width:70px; height:70px">
                     <?php if(isset($web_content['web_text'])){ echo $web_content['web_text'];} else{ echo"
					National Service Scheme is a Central Government Educational Programme started in the year 1969.
					<br></br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Major aim of National Service Scheme is the development of the personality of students through community service.It provides an extention dimension to the higher Education system and orient the student youth to community service.
					 ";}?>
                     </p></td>
<td></td>
<td></td></tr>
</table>
<!-- The Modal -->
 
</div>

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


</script>