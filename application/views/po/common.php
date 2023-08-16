<?php if($show == 1){ ?><link href="<?php echo base_url();?>css/screen.css" rel="stylesheet">  
<body  style="overflow: scroll; height:100%;width:100%">
<form name="frm1" id="frm1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  >
<span class="w3-center"><?php if(isset($msg)){?><h6  style="color:#F00;  "><?php echo $msg; ?></h6><?php }?></span><br>
<span  style="color:#800000; text-transform:uppercase; font-size:16px; font-weight:bold;"><?php  echo $heading;?></span>
  <ul class="tabs">
    <li class="tab">
        <input type="radio" name="tabs"  
         <?php if(isset($tab_id)){if($tab_id == 1) $chk = 1;} else{$chk = 1;} ?>   <?php if(isset($chk)){ ?> checked="checked"   <?php } ?>
        id="tab1" value="1"  onclick="this.form.submit()" />
        <label for="tab1"><?php echo $tab_name1; ?></label>
        <div id="tab-content1" class="content">
          <hr/>
			<?php if(isset($spana)){echo $spana;}?>
        </div>
    </li>
    
    <li class="tab">
      <input type="radio" name="tabs" id="tab2" value="2" onClick="this.form.submit()" 
      <?php if(isset($tab_id)){ if($tab_id == 2){?> checked="checked" <?php }} ?>
       />
      <label for="tab2"><?php echo $tab_name2; ?></label>   
      <div id="tab-content2" class="content">
          <hr/>
          <?php if(isset($spanb)){ echo $spanb; } ?>
       </div>
    </li>
  </ul>
  </form>

  </body>
<?php } else{?>
<span  style="color:#800000; font-size:24px; text-align:center;">
NSS Volunteer Enrollment is under process...
</span>
<?php } ?>
