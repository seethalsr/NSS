<?php //print_r($faq_data);?>
<script>

$(document).ready(function () {
		$(".flip").click(function () {
        $(this).next('.panel').slideToggle("slow").siblings('.panel').slideUp("slow");

	});

});
</script>
<!-- outer div-->
<table align="center" width="100%" class="comm_fnt_web" >
<tr  style="vertical-align:top;" >
<td width="2%"></td>
<td width="95%" class="w3-row-padding" height="500px">
<div class="w3-cardfaq"  >
<img src="<?php echo base_url();?>images/faq.svg" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:40px; padding-left:5px">
        	
<h4><fntn>Frequently Asked Questions </fntn></h4>
<hr />
<div  style="padding-left:53px; padding-bottom:15px" >
				
					<div class="flip">Q1 : What is the strength of a unit? </div>						
					<div class="panel" style="display:none;"><a class="w3-text-green">Answer :</a> Maximum alloted candidates for a unit is 50-100.
                    </div>                
					<div class="flip">Q2 : How many units can be made in a college?</div>
					<div class="panel " style="display:none;"><a class="w3-text-green">Answer :</a>  There is no maximum no: of units, depends upon the candidates in a college.<br />
                    </div>
                    <div class="flip">Q3 : What are the eligiblity criteria to get NSS certificte?</div>
					<div class="panel" style="display:none;"><a class="w3-text-green">Answer :</a> Candidate should have minimum attendance of 240 hours in NSS, should take part in NSS for 2 years, should attend 1 Special camp and atleast one mini camp.</div>
                    <div class="flip">Q3 :If Candidate couldn't attend special camp for 1 st year, what should he do to continue at NSS?</div>
					<div class="panel" style="display:none;"><a class="w3-text-green">Answer :</a> Candidate should attend special camp and atleast 1 mini camp within the 2 years.</div>
                    <div class="flip">Q5: Candidate is in 2nd year and wanted to join in NSS, he was not enrolled during the 1 st year.</div>
					<div class="panel" style="display:none;"><a class="w3-text-green">Answer :</a> Can enroll the candidate with the 1st year.</div>
                    <div class="flip">Q6 : What is the percentage of grace mark awarded to the candidate enrolled for NSS? </div>
					<div class="panel" style="display:none;"><a class="w3-text-green">Answer :</a> Grace mark awarded for the candidate enrolled in NSS is 2 percentage.</div>
                    
                    
                    <?php if(isset($faq_data)){$i=8; foreach($faq_data as $val){$i++;?>
                      <div class="flip">Q<?php echo $i;?> : <?php echo $val['faq_ques']; ?> </div>
					<div class="panel" style="display:none;"><a class="w3-text-green">Answer :</a> <?php echo $val['faq_ans']; ?></div>
					<?php } }?>
					
</div>
 </div>           

</td>
<td  width="5%" ></td>
 <td style="height:600px">&nbsp;</td>
 </tr>
</table>





