<!-- outer div-->
<div >
 <table align="center" width="100%" >
   <tr  style="vertical-align:top;">
   <td width="100%" height="362"  class="w3-row-padding">
   <!-- about NSS-->
		   <div class="  w3-card-2 w3-white w3-round  " style="padding-bottom:10px; height:450px"><br>
      		<img src="<?php echo base_url();?>images/aboutus.svg" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:40px; padding-left:5px">
        	<fntn>About Us</fntn>
    <div style="padding-bottom:15px"></div>
  	<hr />   
	 <?php if(!$about_link)
   {?>     
	 <h3 style="color:#004040; " class="w3-center">Regional Director</h3>
      <p class="w3-container w3-content w3-code w3-round  w3-center"><img  src="<?php echo base_url();?>upload/website/officers/regional_director.jpg" height="150px" width="150px"/> </br><br />
	  <div align="center">
     <b> Shri.G.Sreedhar<br />
	  	Regional Directorate of NSS</b><br />
		CGO Complex, 2nd
		Floor PO-Poonakulam,<br />
		Vellayani,
        Trivandrum-695522
      </div>	
      </p>	
  	</div> 
	<?php }?>
  
    <!-- vision-->
	<?php if($about_link == '1'){?>
    <h3 style="color:#004040; " class="w3-center">Regional Director</h3>
      <p class="w3-container w3-content w3-code w3-round  w3-center"><img  src="<?php echo base_url();?>upload/website/officers/regional_director.jpg" height="150px" width="150px"/> </br><br />
	  <div align="center">
     <b> Shri.G.Sreedhar<br />
	  Regional Directorate of NSS</b><br />
		CGO Complex, 2nd
		Floor PO-Poonakulam,<br />
		Vellayani,
        Trivandrum-695522
      </div>	
      </p>
    <?php } ?>
    <!-- Mission-->
    <?php if($about_link == '2'){?>
    <h3 style="color:#004040;" class="w3-center">State NSS Officer</h3>
    <p class="w3-container w3-content w3-code w3-round  w3-center"><img  src="<?php echo base_url();?>upload/website/officers/stateliason_ku.jpg" height="150px" width="150px"/> </br><br />
	  <div align="center">
     <b>Dr.Anzer R N<br />
	 The State NSS Officer </b><br />
     State NSS Cell, Vikas bhavan
Thiruvananthapuram<br />
E mail -keralansscell@gmail. com
Ph.04712308687
      </div>	
      </p>
	<?php } ?>
    
	<?php if($about_link == '3'){?>
    <h3 style="color:#004040;" class="w3-center">NSS Programme Co-Ordinator</h3>
    
      <p class="w3-container w3-content w3-code w3-round w3-center ">
       <p class="w3-container w3-content w3-code w3-round  w3-center"><img  src="<?php echo base_url();?>upload/website/officers/nsspgm.jpg" height="150px" width="150px"/> </br><br />
	  <b> NSS Programme Co-Ordinator<br />Dr.Nafeesa Baby T.P</b> <br />  
<br />
National Sevice Scheme Cell<br />
Kannur University Thavakkara P O kannur,Kerala,India pin 670002
<br />
 Mobile:9074203568<br />
 <a href="https://dss.kannuruniversity.ac.in/" target="_blank">dss.kannuruniversity.ac.in </a>
      </p>
	<?php } ?>
    
        <!-- Motto-->
	<?php if($about_link == '4'){?>
    <h3 style="color:#004040;" class="w3-center">NSS Office Members</h3>
    
      <p >
<table class="w3-container w3-content w3-left w3-round " style="padding-left:200px;">
<!--<tr><td></td><td>Section Officer</td><td>:</td><td>Smt.Ligi Mathew</td><td></td></tr>
<tr><td></td><td>Assistant Section Officer</td><td>:</td><td>Sri. Krishna Kumar.R</td><td></td></tr>-->
<tr><td></td><td>Director of Student Services:

   </td><td>:</td><td>Dr.Nafeesa Baby T.P</td><td></td></tr>
<!--<tr><td></td><td>Computer Assistant</td><td>:</td><td>Murugan.R</td><td></td></tr>-->
</table>
     </p>
     	
  	
	<?php } ?>
	
		  <!-- end of awards--> 
   </td>
   <td style="height:600px">&nbsp;</td>
<td width="100%"   style="padding-top:5pxs; padding-right:5px;padding-left:5px">
	 
 <div class="w3-card-aboutmenu w3-round">
     <div class="w3-white">
        <button onClick="myFunction1('Demo4')" class="w3-button w3-block w3-theme-added2 w3-left-align"><img src="<?php echo base_url();?>images/moreabout.svg"  style="width:20px; height:20px"  alt="" > Know More</button>
			<div id="Demo4" class=" w3-container">
				
                <div class="vertical-menu">
  <a href='<?php echo base_url();?>Nsscontrol/about?link_id=1' style="border-bottom:1px solid  #8c8b8b;" >Reginoal Director</a>
  <a href='<?php echo base_url();?>Nsscontrol/about?link_id=2'   style="border-bottom:1px solid  #8c8b8b;">State NSS Liason Officer</a>
  <a href='<?php echo base_url();?>Nsscontrol/about?link_id=3'  style="border-bottom:1px solid  #8c8b8b;">Programe Co-ordinator Incharge</a>
  <a href='<?php echo base_url();?>Nsscontrol/about?link_id=4' >NSS Office</a>
</div>
</div>
</div>
</div>         		
 </td>
   </tr>
   <tr>
   </tr>

 </table>
</div>
<!-- outer div closed-->


<script>
// Accordion
function myFunction1(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
		
    } else { 
        x.className = x.className.replace("w3-show", "");
    }
}
</script>
