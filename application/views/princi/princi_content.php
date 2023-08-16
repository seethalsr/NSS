<!-- admin contect-->
<table style="width:100%; ">
<tr>
<td>
<div class="main-panel" >
	<nav class="navbar navbar-default navbar-fixed" >
    <div class="container-fluid" >
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand " style="text-transform:uppercase;"><?php echo $college_id; ?></a>
                 </div>
                 
                 <div class="collapse navbar-collapse" style="float:right;">
                   
                    <ul class="nav navbar-nav navbar-right">                       
                        <li>
                            <a href="<?php echo base_url();?>Admin/NssAdmin/logout">
                                Log out
                            </a>
                        </li>
                    </ul>
                </div>
     </div>
    </nav>
</div>
</td>
</tr>
</table>