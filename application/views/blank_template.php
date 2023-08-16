<script language="javascript" src='<?php echo base_url(); ?>js/jquery/jquery.min.js' type='text/javascript'></script>
<!DOCTYPE html>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
<html>
 <head>
	<title>MG University,Kottayam</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
 </head>
 <body>
     <table width="100%" height="100%"  border="0" cellspacing="0" align="center"  class="table_tmplate">
      <tr bgcolor="#003349">
        <td align="left" colspan="3" class="templt_head" width="60%">
            <img src="<?php echo base_url();?>image/logo.png"  height="74" align="center"/>
            MAHATMA GANDHI UNIVERSITY<font size="2">, KOTTAYAM, KERALA, INDIA.</font>
        </td >
        <td align="right" class="templt_head">
          	Equivalency-Eligibility Online Portal
        </td>
        
      </tr> 
     
      <tr><td colspan="4"  bgcolor="white"></td></tr>
      <tr><td colspan="4"  bgcolor="#003339"></td></tr>
      

      
      <tr valign="top">
        <td colspan="4" bgcolor="white" width="100" height="500" align="right"><div id="id1" style="display: none"><?php if(isset($result)){ echo $result;} else echo ''; ?></div> <div id="id2" class="javascript_error"><?php echo "Enable Javascript to display page content"; ?></div>
        </td>
      </tr>
      <tr>
        <td colspan="4" bgcolor="#003339" class="templt_footer"><br />
          <center>&copy; 2017 Mahatma Gandhi University, Kottayam, Kerala. Powered by IT Cell Admin. All Rights Reserved.</center><br>
        </td>
      </tr>
    </table>

 </body>
</html>
<script language="javascript">
   document.getElementById("id1").style.display = 'inline';
   document.getElementById("id2").style.display = 'none';
</script>