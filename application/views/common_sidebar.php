<?php  //echo $college_id; exit;// echo $sub_menu;?>
<link rel="stylesheet" href="<?php echo base_url();?>css/style4.css">
<body >
<div class="wrapper"   >
<nav id="sidebar" style="overflow:auto;  " >
<div class="sidebar-header ">
<h4 >WELCOME <span style="text-transform:uppercase;"><?php if($name=='nsspgm')echo 'NSS PROGRAMME CO-ORDINATOR'; else echo $name; ?></span> </h4>
</div>
<ul class="list-unstyled components" style="margin-bottom:100px;" >
<!-- PO --> 
<?php if(isset($user_type)&&($user_type == 'po')){ ?>
<li<?php if(isset($main_menu) && $main_menu=="home"){ ?> class="active"<?php }?>><a href="<?php echo base_url()?>Po/NssPo/" class="active"><i class="glyphicon glyphicon-home "></i>HOME
</a></li>
<li>
<a href="<?php echo base_url()?>Admin/NssAdmin/chg_pwd" class="active">
<i class="glyphicon glyphicon-lock "></i>CHANGE PASSWORD
</a>
</li>
<li<?php if(isset($main_menu) && $main_menu=="profile"){ ?> class="active"<?php }?>><a href="<?php echo base_url()?>Po/NssPo/profile" ><i class="glyphicon glyphicon-user "></i>PROFILE
</a></li>
<?php if($college_id =='1000'){?><li  >
<a href="#colapseitpo"  data-toggle="collapse"  <?php if(isset($main_menu)&& isset($sub_menu)&& $main_menu == "enroll") echo "aria-expanded='true'";
 else "aria-expanded='false'";?> >
<i class=" glyphicon glyphicon-eye-close"></i>ENROLLMENT
</a>
<ul class="<?php if(isset($main_menu)&& isset($sub_menu)&& $main_menu == "enroll") {echo"";} else {echo "collapse";}?> list-unstyled active" id="colapseitpo"  >
 <li<?php if(isset($main_menu) && $sub_menu=="stud_list"){ ?> class="active1"<?php }?>><a target="_blank"  href="<?php echo base_url()?>Po/NssPo/stud_list" class="active" >ENROLL STUDENTS</a></li> 
<li<?php if(isset($main_menu) && $sub_menu=="v_enroll"){ ?> class="active1"<?php }?>><a href="<?php echo base_url()?>Po/NssPo/view_enroll_list" class="active">VIEW ENROLLED STUDENTS</a></li>
</ul>
</li><?php } ?>
<?php //if($college_id==213)
{?>
<li  >
<a href="#colapseitma"  data-toggle="collapse"  <?php if(isset($main_menu)&& isset($sub_menu)&& $main_menu == "elig") echo "aria-expanded='true'";
 else "aria-expanded='false'";?> >
<i class=" glyphicon glyphicon-eye-close"></i>ELIGIBLITY REPORT
</a>
<ul class="<?php if(isset($main_menu)&& isset($sub_menu)&& $main_menu == "elig") {echo"";} else {echo "collapse";}?> list-unstyled active" id="colapseitma"  >
<?php if($college_id == 213) {?>
<li<?php if(isset($main_menu) && $sub_menu=="edit_elig"){ ?> class="active1"<?php }?>><a target="_blank"  href="<?php echo base_url()?>Po/NssPo/edit_elig" class="active" > >>EDIT STUDENTS DETAILS</a></li>
<?php } ?>


<li<?php if(isset($main_menu) && $sub_menu=="edit_elig"){ ?> class="active1"<?php }?>><a target="_blank"  href="<?php echo base_url()?>Po/NssPo/edit_elig_final" class="active" > >>EDIT  STUDENTS DETAILS</a></li>

<li<?php if(isset($main_menu) && $sub_menu=="view_elig"){ ?> class="active1"<?php }?>><a href="<?php echo base_url()?>Po/NssPo/view_elig" class="active"> >>VIEW ELIGIBILITY REPORT</a></li>
</ul>
</li>

<?php }?>
<?php } ?>
<!-- END PO -->
<!-- PRINCI -->
<?php if(isset($user_type)&&($user_type == 'principal')){ ?> 
<li <?php if(isset($main_menu) && $main_menu=="home"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Princi/NssPrinci/" >
<i class="glyphicon glyphicon-home "></i>HOME 
</a></li>
<li >
<a href="<?php echo base_url()?>Admin/NssAdmin/chg_pwd" >
<i class="glyphicon glyphicon-lock "></i>CHANGE PASSWORD 
</a>
</li>
<li <?php if(isset($main_menu) && $main_menu=="profile"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Princi/NssPrinci/profile" >
<i class="glyphicon glyphicon-user "></i>PROFILE 
</a></li>
<!--<li >
<a href="#colapseitnunit"  data-toggle="collapse"<?php if(isset($main_menu)&& isset($sub_menu)&& $main_menu == "nunit") echo "aria-expanded='true'";
 else "aria-expanded='false'";?> >
<i class=" glyphicon glyphicon-user"></i>
NSS UNIT NEED
</a>
<ul class="<?php if(isset($main_menu)&& isset($sub_menu)&& $main_menu == "nunit") {echo"";} else {echo "collapse";}?> list-unstyled active" id="colapseitnunit"  >
<li <?php if(isset($sub_menu)&& $sub_menu == "c_nunit")  {echo "class='active1'";} else {echo "";} ?>><a href="<?php echo base_url()?>Princi/NssPrinci/create_new_unit" class="active" >CREATE UNIT</a></li>
<li <?php if(isset($sub_menu)&& $sub_menu == "v_nunit")  {echo "class='active1'";} else {echo "";} ?>><a href="<?php echo base_url()?>Princi/NssPrinci/view_new_unit" class="active">VIEW UNIT</a></li>
</ul>
</li>-->
<li >
<a href="#colapseitpo"  data-toggle="collapse"<?php if(isset($main_menu)&& isset($sub_menu)&& $main_menu == "po") echo "aria-expanded='true'";
 else "aria-expanded='false'";?> >
<i class=" glyphicon glyphicon-user"></i>
PROGRAM OFFICERS
</a>
<ul class="<?php if(isset($main_menu)&& isset($sub_menu)&& $main_menu == "po") {echo"";} else {echo "collapse";}?> list-unstyled active" id="colapseitpo"  >
<li <?php if(isset($sub_menu)&& $sub_menu == "c_po")  {echo "class='active1'";} else {echo "";} ?>><a href="<?php echo base_url()?>Princi/NssPrinci/create_po" class="active" >CREATE PROGRAM OFFICERS</a></li>
<li <?php if(isset($sub_menu)&& $sub_menu == "v_po")  {echo "class='active1'";} else {echo "";} ?>><a href="<?php echo base_url()?>Princi/NssPrinci/view_po" class="active">VIEW PROGRAM OFFICERS</a></li>
</ul>
</li>
<li  >
<a href="#colapseitunit"  data-toggle="collapse" <?php if(isset($main_menu)&& isset($sub_menu)&& $main_menu == "unit") echo "aria-expanded='true'";
 else "aria-expanded='false'";?> >
<i class=" glyphicon glyphicon-home"></i>NSS UNIT
</a>
<ul class="<?php if(isset($main_menu)&& isset($sub_menu)&& $main_menu == "unit") {echo"";} else {echo "collapse";}?> list-unstyled active " id="colapseitunit"  >
<li <?php if(isset($sub_menu)&& $sub_menu == "c_u")  {echo "class='active1'";} else {echo "";} ?>><a href="<?php echo base_url()?>Princi/NssPrinci/create_unit" class="active" >CREATE NSS UNIT</a></li>
<li <?php if(isset($sub_menu)&& $sub_menu == "cu_u")  {echo "class='active1'";} else {echo "";} ?>><a href="<?php echo base_url()?>Princi/NssPrinci/current_unit" class="active" >VIEW NSS UNIT</a></li>
</ul>
</li>
<li <?php if(isset($main_menu) && $main_menu=="enroll"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Princi/NssPrinci/view_enroll_list/">
<i class="glyphicon glyphicon-eye-close" ></i>ENROLLED STUDENTS
</a>
</li>

<?php // if($college_id==213)
{?>
 <li <?php if(isset($main_menu) && $main_menu=="certi"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Princi/NssPrinci/nss_certi" >
<i class="glyphicon glyphicon-certificate "></i>CERTIFICATES
</a>
</li>
<?php } ?>
<?php } ?>
<!-- END PRINCI -->
<!-- ASSI --> 
<?php if(isset($user_type)&&($user_type == 'assistant')){ ?>
<li <?php if(isset($main_menu) && $main_menu=="home"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Po/NssPo/" >
<i class="glyphicon glyphicon-home "></i>HOME
</a>
</li>
<li>
<a href="<?php echo base_url()?>Admin/NssAdmin/chg_pwd" >
<i class="glyphicon glyphicon-lock "></i>CHANGE PASSWORD
</a>
</li>
<li <?php if(isset($main_menu) && $main_menu=="college_list"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssAdmin/college_list" >
<i class="glyphicon glyphicon-education "></i>COLLEGE LIST
</a>



</li>
<?php /*?><li <?php if(isset($main_menu) && $main_menu=="student_list"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssAdmin/stud_list" >
<i class="glyphicon glyphicon-education "></i>STUDENTS LIST
</a>
</li><?php */?>
<li<?php if(isset($main_menu) && $main_menu=="manage"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssAdmin/admin_manage" >
<i class="glyphicon glyphicon-cog "></i>MANAGE
</a>
</li>
<li  >
<a href="#colapseitprin"  data-toggle="collapse"  <?php if(isset($main_menu)&& isset($sub_menu)&& $main_menu == "princi") echo "aria-expanded='true'";
 else "aria-expanded='false'";?> >
<i class=" glyphicon glyphicon-user"></i>
PRINCIPAL
</a>
<ul class="<?php if(isset($main_menu)&& isset($sub_menu)&& $main_menu == "princi") {echo"";} else {echo "collapse";}?> list-unstyled " id="colapseitprin"  >
<li <?php if(isset($sub_menu)&& $sub_menu == "admin_princi")  {echo "class='active1'";} else {echo "";} ?>><a href="<?php echo base_url()?>Admin/NssAdmin/admin_princi"  >CREATE PRINCIPAL</a></li>
<li <?php if(isset($sub_menu)&& $sub_menu == "admin_princi_list")  {echo "class='active1'";} else {echo "";} ?>><a href="<?php echo base_url()?>Admin/NssAdmin/admin_princi_list" class="active">VIEW PRINCIPAL LIST</a></li>
<li <?php if(isset($sub_menu)&& $sub_menu == "prin_his")  {echo "class='active1'";} else {echo "";} ?>><a href="<?php echo base_url()?>Admin/NssAdmin/prin_his" class="active">VIEW COLLEGE-PRINCIPAL HISTORY</a></li>
</ul>
</li>
<li <?php if(isset($main_menu) && $main_menu=="po_list"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssAdmin/po_list/" >
<i class="glyphicon glyphicon-eye-close" ></i>PO LIST
</a>
</li>
<li <?php if(isset($main_menu) && $main_menu=="enroll"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssAdmin/admin_v_enroll_list/" class="active">
<i class="glyphicon glyphicon-eye-close" ></i>ENROLLED STUDENTS
</a>
</li>
<!--<li <?php if(isset($main_menu) && $main_menu=="atten"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssAdmin/admin_v_m_attendance" class="active">
<i class="glyphicon glyphicon-calendar "></i>MONTHLY ATTENDANCE
</a>
</li>
<li <?php if(isset($main_menu) && $main_menu=="camp"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssAdmin/camp" class="active">
<i class="glyphicon glyphicon-tent "></i>CAMP DETAIL
</a>
</li>
<li <?php if(isset($main_menu) && $main_menu=="month"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssAdmin/monthly_report" class="active">
<i class="glyphicon glyphicon-list-alt "></i>MONTHLY REPORT
</a>
</li>

<li  >
<a href="#colapseitfund"  data-toggle="collapse"  <?php if(isset($main_menu)&& isset($sub_menu)&& $main_menu == "fund") echo "aria-expanded='true'";
 else "aria-expanded='false'";?> >
<i class=" glyphicon glyphicon-usd"></i>FUND REPORT
</a>
<ul class="<?php if(isset($main_menu)&& isset($sub_menu)&& $main_menu == "fund") {echo"";} else {echo "collapse";}?> list-unstyled active" id="colapseitfund"  >
<li <?php if(isset($sub_menu)&& $sub_menu == "fund_govt")  {echo "class='active1'";} else {echo "";} ?>><a href="<?php echo base_url()?>Admin/NssAdmin/fund_govt" class="active" >FUND FROM GOVT</a></li>
<li <?php if(isset($sub_menu)&& $sub_menu == "sanct_fund")  {echo "class='active1'";} else {echo "";} ?>><a href="<?php echo base_url()?>Admin/NssAdmin/sanctioned_fund" class="active" >FUND DISTRIBUTION</a></li>
<li <?php if(isset($sub_menu)&& $sub_menu == "sanc_fund")  {echo "class='active1'";} else {echo "";} ?>><a href="<?php echo base_url()?>Admin/NssAdmin/view_sanc_fund" class="active">VIEW FUND DISTRIBUTION</a></li>
<li <?php if(isset($sub_menu)&& $sub_menu == "view_fund")  {echo "class='active1'";} else {echo "";} ?>><a href="<?php echo base_url()?>Admin/NssAdmin/view_fund" class="active">VIEW FUND REPORT</a></li>
</ul>
</li>

<li <?php if(isset($main_menu) && $main_menu=="audit"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssAdmin/admin_audit_report" class="active">
<i class="glyphicon glyphicon-stats "></i>AUDIT REPORT
</a>
</li>
<li <?php if(isset($main_menu) && $main_menu=="elig"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssAdmin/eligibile_report" class="active">
<i class="glyphicon glyphicon-star-empty "></i>ELIGIBILITY REPORT
</a>
</li>
<li <?php if(isset($main_menu) && $main_menu=="certi"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssAdmin/certi" class="active">
<i class="glyphicon glyphicon-certificate "></i>CERTIFICATES
</a>
</li>
<?php /*?><li>
<a href="<?php echo base_url()?>Admin/NssAdmin/gallery" class="active">
<i class="glyphicon glyphicon-picture "></i>GALLERY
</a>
</li><?php */?>
<?php /*?><li>
<a href="<?php echo base_url()?>Admin/NssAdmin//track_his" class="active">
<i class="glyphicon glyphicon-time "></i>TRACKING HISTORY
</a>
</li><?php */?>

<?php } ?>
<!-- END ASSI -->
<!-- SO --> 
<?php if(isset($user_type)&&($user_type == 'so')){ ?>
<li<?php if(isset($main_menu) && $main_menu=="home"){ ?> class="active"<?php }?> >
<a href="<?php echo base_url()?>Admin/NssSo/" >
<i class="glyphicon glyphicon-home "></i>HOME
</a>
</li>
<li>
<a href="<?php echo base_url()?>Admin/NssAdmin/chg_pwd" >
<i class="glyphicon glyphicon-lock "></i>CHANGE PASSWORD
</a>
</li>
<li <?php if(isset($main_menu) && $main_menu=="college_list"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssAdmin/college_list" >
<i class="glyphicon glyphicon-education "></i>COLLEGES LIST
</a>
</li>
<?php /*?><li <?php if(isset($main_menu) && $main_menu=="student_list"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssAdmin/stud_list">
<i class="glyphicon glyphicon-education "></i>STUDENTS LIST
</a>
</li><?php */?>
<li  >
<a href="#colapseitprin"  data-toggle="collapse" <?php if(isset($main_menu)&& isset($sub_menu)&& $main_menu == "princi") echo "aria-expanded='true'";
 else "aria-expanded='false'";?> >
<i class=" glyphicon glyphicon-user"></i>
PRINCIPAL
</a>
<ul class="<?php if(isset($main_menu)&& isset($sub_menu)&& $main_menu == "princi") {echo"";} else {echo "collapse";}?> list-unstyled active" id="colapseitprin"  >
<li <?php if(isset($sub_menu)&& $sub_menu == "admin_princi_list")  {echo "class='active1'";} else {echo "";} ?>><a href="<?php echo base_url()?>Admin/NssAdmin/admin_princi_list" class="active">VIEW PRINCIPAL LIST</a></li>
<li <?php if(isset($sub_menu)&& $sub_menu == "prin_his")  {echo "class='active1'";} else {echo "";} ?>><a href="<?php echo base_url()?>Admin/NssAdmin/prin_his" class="active">VIEW COLLEGE-PRINCIPAL HISTORY</a></li>
</ul>
</li>
<?php /*?><li>
<a href="#" class="active">
<i class="glyphicon glyphicon-pushpin "></i>NSS DETAILS LIST
</a>
</li>
<li <?php if(isset($main_menu) && $main_menu=="manage"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssAdmin/admin_manage" >
<i class="glyphicon glyphicon-cog "></i>MANAGE
</a>
</li><?php */?>
<li <?php if(isset($main_menu) && $main_menu=="po_list"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssAdmin/po_list/" >
<i class="glyphicon glyphicon-eye-close" ></i>PO LIST
</a>
</li>
<li <?php if(isset($main_menu) && $main_menu=="enroll"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssSo/so_v_enroll_list/" >
<i class="glyphicon glyphicon-eye-close" ></i>ENROLLED STUDENTS
</a>
</li>

<li <?php if(isset($main_menu) && $main_menu=="elig"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssSo/eligibility_rep" >
<i class="glyphicon glyphicon-star-empty "></i>ELIGIBILITY REPORT
</a>
</li>
<li <?php if(isset($main_menu) && $main_menu=="eligso"){ ?> class="active"<?php }?>>
<a href="<?php echo base_url()?>Admin/NssSo/verify_eli_list" >
<i class="glyphicon glyphicon-education "></i>CERTIFICATE 2019
</a>
</li>
<?php }?>
<!-- END SO -->
<!-- COMMON --> 


<?php /*?><li>
<a href="<?php echo base_url()?>Po/NssPo/" class="active">
<i class="glyphicon glyphicon-tint "></i>BLOOD BANK
</a>
</li><?php */?>

<?php /*?><li>
<a href="<?php echo base_url()?>Po/NssPo/" class="active">
<i class="glyphicon glyphicon-comment "></i>CHAT
</a>
</li>
<li>
<a href="<?php echo base_url()?>Po/NssPo/eil" class="active">
<i class="glyphicon glyphicon-hand-right "></i>EIL
</a>
</li><?php */?>
<!-- END COMMON -->
<!-- ADMIN --> 
<?php if(isset($user_type)&&($user_type == 'admin')){ ?>
<li<?php if(isset($main_menu) && $main_menu=="home"){ ?> class="active"<?php }?> >
<a href="<?php echo base_url()?>Admin/NssAdministrator" >
<i class="glyphicon glyphicon-home "></i>HOME
</a>
</li>
<li<?php if(isset($main_menu) && $main_menu=="upload"){ ?> class="active"<?php }?> >
<a href="<?php echo base_url()?>Admin/NssAdministrator/upload" >
<i class="glyphicon glyphicon-home "></i>UPLOAD
</a>
</li>
<?php } ?>
</ul>

</nav>

</div>
 

