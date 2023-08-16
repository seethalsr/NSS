<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NssPo extends CI_Controller 
{
	public function __construct() 
	{
        parent::__construct();
		$this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('captcha');
		$this->load->model('Publicmodel');
		$login_id	= $this->session->userdata('login_id');
		$utype	    = $this->session->userdata('utype');
		$HTTP_REF = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:null;
		if(empty($login_id) || empty($utype) ) 
		redirect('/Nsscontrol');	
		else if(empty($HTTP_REF)) redirect('/Nsscontrol');	
		if($utype=="po"){
		$login_detail = $this->Publicmodel->get_po_login_details($login_id);
		if($login_detail)
		{//print_r($login_detail);exit;
		$this->session->college_id   = $login_detail[0]['college_id'];
		$this->session->user_type    = $login_detail[0]['user_type'];
		$this->session->name         = $login_detail[0]['name'];
		$this->session->user_id      = $login_detail[0]['user_id'];
		$this->session->college_name = $login_detail[0]['college_name'];
		$this->session->po_unit      = $login_detail[0]['nss_unit_id'];
		$this->session->unit_id      = $login_detail[0]['unit_id'];
		$this->session->po_batch_period  = $login_detail[0]['batch_period'];
		}
		}
    }
	public function index()
	{
		$querypo['college_name'] = $this->session->userdata('college_name');	
		$querypo['name']         = $this->session->userdata('name');	
		$querypo['college_id']   = $this->session->userdata('college_id');
		$querypo['user_type']    = $this->session->userdata('user_type');	
		$querypo['user_id']      = $this->session->userdata('user_id');	
		$querypo['po_unit'] 	 = $this->session->userdata('po_unit');
		$querypo['po_batch_period'] = $this->session->userdata('po_batch_period');
		$querypo['main_menu']="home";$querypo['sub_menu']="";
		$querypo['adminspan1']   = $this->load->view('common_sidebar',$querypo,true);
	    $querypo['adminspan2']   = $this->load->view('common_template_topbar',$querypo,true);	
		$querypo['listspan']   = $this->load->view('po/po_body','',true);	
		$querypo['adminspan3'] = $this->load->view('common_list_view',$querypo,true);	//template
		$this->load->view('common_template',$querypo);
	}
	public function logout()
	{
		$this->session->unset_userdata('login_id');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('college_id');
		$this->session->unset_userdata('user_type');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('po_unit');
		$this->session->unset_userdata('po_batch_period');
		redirect(base_url().'Nsscontrol');
	} 
	public function profile()
	{
		$querypo['main_menu']="profile";
	    $querypo['sub_menu']="";
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['id']= $this->session->userdata('user_id');
		if($querypo['user_type']=="po")	
		$querypo['po_det'] = $this->Publicmodel->get_profile_po($querypo['id']);
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['adminspan3'] = $this->load->view('profile',$querypo,true);
		$this->load->view('common_template',$querypo);
	}
	public function stud_list()
	{
		$querypo['main_menu']="enroll";
		$querypo['sub_menu']="stud_list";
		$querypo['po_id']   = $this->session->userdata('user_id');	
		$querypo['unit_list']   = $this->session->userdata('po_unit');
		$querypo['unit_id']   = $this->session->userdata('unit_id');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['enroll_access'] = 0; 
		$querypo['stud_no']=$this->Publicmodel->get_total_stud($querypo['unit_id']);
		//echo $querypo['stud_no'];exit;
		$get_enroll_date = $this->Publicmodel->get_data_manage_enroll(date('Y'));
		if(isset($get_enroll_date)&&date('Y-m-d')>= $get_enroll_date['start_date'] && date('Y-m-d')<= $get_enroll_date['to_date']  )
			{ 
			$querypo['enroll_access'] = 1; 
			}
		
		if($this->input->post('sub'))
		{
		if($this->session->flashdata('page_message')) $querypo['msg']=$this->session->flashdata('page_message');
		else $querypo['msg']='';
			$this->form_validation->set_error_delimiters('<span class="error_form_validation">', '</span>');			
			$this->form_validation->set_rules('stud_no', 'No: pf Volunteers', 'required',array('required' => 'Please Enter  %s'));
			if ($this->form_validation->run() === FALSE)						
			$querypo['msg']= "PLEASE FILL THE REQUIRED FIELDS";						
			else
			{
		$querypo['stud_no']=$this->input->post('stud_no');
		$querypo['upd_stud_no']=$this->Publicmodel->insert_totstud($querypo['stud_no'],$querypo['unit_id']);
		}		
		}
		if($this->input->post('edit'))
		{
		$querypo['stud_no']=$this->input->post('stud_no');
		$querypo['upd_stud_no']=$this->Publicmodel->insert_totstud($querypo['stud_no'],$querypo['unit_id']);	
		}
		 
		$querypo['start_no']=$this->Publicmodel->get_strtend_no($querypo['college_id'],$querypo['unit_list']);
		if(isset($querypo['stud_no'])&&$querypo['start_no']!=$querypo['stud_no']){
		$querypo['start_no']+=1;
		$querypo['end_no']=$querypo['start_no']+9;
		if($querypo['end_no']> $querypo['stud_no'])
		$querypo['end_no']=$querypo['stud_no'];
		//echo $querypo['end_no'];echo '<br>';echo $querypo['start_no'];exit;
		}
		
		
		if($this->input->post('enroll'))
		{
		if(isset($querypo['start_no'])&&isset($querypo['end_no'])){
		for($i=$querypo['start_no'];$i<=$querypo['end_no'];$i++)
			{
			//print_r($this->input->post()	);exit;
			if($this->session->flashdata('page_message')) $querypo['msg']=$this->session->flashdata('page_message');
		else $querypo['msg']='';
			$this->form_validation->set_error_delimiters('<span class="error_form_validation">', '</span>');			
			$this->form_validation->set_rules('prn_'.$i, 'PRN Number', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('name_'.$i, 'Name', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('admyear_'.$i, 'Admission Year', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('spl_'.$i, 'Specialisation display Name', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('mob_'.$i, 'Mobile Number', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('gender_'.$i, 'Gender', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('cast_'.$i, 'Reservation', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('blood_'.$i, 'Blood Group', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('donate_'.$i, 'Donate Blood', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('mini1_'.$i, 'Donate Blood', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('mini2_'.$i, 'Donate Blood', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('splcamp_'.$i, 'Donate Blood', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('enrolled_date_'.$i, 'enroll date', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('enroll_end_'.$i, 'enroll end date', 'required',array('required' => 'Please Enter  %s'));
			
			if ($this->form_validation->run() === FALSE)
			{	
					
			$querypo['msg']= "PLEASE FILL THE REQUIRED FIELDS";		
			
			}				
			else
			{
			
		$data[$i]=array(
		'account_id'=>$this->input->post('prn_'.$i),
		'current_semester'=>'',
		'admission_year'=>$this->input->post('admyear_'.$i),
		'account_student_name'=>$this->input->post('name_'.$i),
		'college_id'=>$querypo['college_id'],
		'specialisation_id'=>$this->input->post('spl_'.$i),
		'batch'=>'',
		'account_student_email'=>'',
		'account_student_mobileno'=>$this->input->post('mob_'.$i),
		'gender'=>$this->input->post('gender_'.$i),
		'cast'=>$this->input->post('cast_'.$i),
		'student_status'=>'active',
		'nss_unit_id'=>$querypo['unit_id'],
		'nss_enroll_unit'=>$querypo['unit_list'],		
		'nss_enroll_id'=>'',
		'batch_period'=>$querypo['batch_period'],
		'enrolled_date'=>'',
		'blood_group'=>$this->input->post('blood_'.$i),
		'donate'=>$this->input->post('donate_'.$i),
		'verification_id'=>'0',
		'remarks'=>'',
		'details_changed'=>'',
		'uploaded_date'=>'',
		'nss_status'=>'null',
		'created_date'=>date('Y-m-d H:i:s'),
		'mini1'=>$this->input->post('mini1_'.$i),
		'mini2'=>$this->input->post('mini2_'.$i),
		'splcamp'=>$this->input->post('splcamp_'.$i),
		'tot_hr'=>$this->input->post('tot_hr_'.$i),
		'enroll_end'=>date("Y-m-d", strtotime( $this->input->post('enroll_end_'.$i))) ,
		'splcamp_start'=>date("Y-m-d", strtotime( $this->input->post('splcamp_start_'.$i))) ,
		'splcamp_end'=>date("Y-m-d", strtotime( $this->input->post('splcamp_end_'.$i))) ,
		'spl_desti'=>$this->input->post('spl_desti_'.$i),
		'enrolled_date'=>date("Y-m-d", strtotime( $this->input->post('enrolled_date_'.$i))),
		);
		
	
		}
		}
		if(isset($data))
		{
			$ins_id = $this->Publicmodel->insert_stud($data);
			
			}
		}
		}
		$querypo['start_no']=$this->Publicmodel->get_strtend_no($querypo['college_id'],$querypo['unit_list']);
		if(isset($querypo['stud_no'])&&$querypo['start_no']!=$querypo['stud_no']){
		$querypo['start_no']+=1;
		$querypo['end_no']=$querypo['start_no']+9;
		if($querypo['end_no']> $querypo['stud_no'])
		$querypo['end_no']=$querypo['stud_no'];
		//echo $querypo['end_no'];echo '<br>';echo $querypo['start_no'];exit;
		}
		
		if(isset($ins_id) && ($querypo['end_no']==$querypo['stud_no'])){
		$querypo['msg']="<div style='color:008040'>Enrolled Successfully!!!</div>";
		$querypo['enroll_access'] = 0; 
		}
		$this->load->view('po/stud_list',$querypo);
		
		
	}
		
		public function stud_list_org()
	{ 	$querypo['main_menu']="enroll";
		$querypo['sub_menu']="stud_list";
		$querypo['po_id']   = $this->session->userdata('user_id');	
		$querypo['unit_list']   = $this->session->userdata('po_unit');
		$querypo['unit_id']   = $this->session->userdata('unit_id');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		//generate student details list
		$querypo['course_spl'] = $this->Publicmodel->get_course_spl($querypo['college_id']);
		$spl_name = $this->input->post('splname');
		
		//print_r($querypo['course_spl']);echo"<br></br>";print_r($spl_name);exit;
		if($spl_name)
		{
		
		if($this->session->flashdata('page_message')) $querypo['msg']=$this->session->flashdata('page_message');
		else $querypo['msg']='';
			$this->form_validation->set_error_delimiters('<span class="error_form_validation">', '</span>');			
			$this->form_validation->set_rules('batch', 'Batch', 'required',array('required' => 'Please select  %s'));
			if ($this->form_validation->run() === FALSE)						
			$querypo['msg']= "PLEASE FILL THE REQUIRED FIELDS";						
			else
			{//specialisation name and batch
			
			if($this->input->post('splname') && $this->input->post('batch'))
			{
			$year 	   = $this->input->post('batch');			
			$splname   = $this->input->post('splname');	
			$get_enroll_date = $this->Publicmodel->get_data_manage_enroll(date('Y'));
		    if($get_enroll_date)
		    {  
			if(date('Y-m-d')>= $get_enroll_date['start_date'] && date('Y-m-d')<= $get_enroll_date['to_date']  )
			{// enrollment can be made****************************************************************************************
				// check if already forwarded to principal/fwd to asii/fwd to so/rej so/rej assi/rej princi
			$querypo['enroll_access'] = 1;// make the checkbox show
		   	$enroll_list = $this->Publicmodel->get_enrolled_list($querypo['unit_list'],$querypo['college_id'],$querypo['batch_period']);
			if($enroll_list)
			{
			$enroll_id_present = array_column($enroll_list,'nss_enroll_id');
			$key_enroll_id_present = in_array(null, $enroll_id_present);
			$enroll_id_present = "";
			$fil_ver_id = array_column($enroll_list,'verification_id');
			if(in_array('1',array_column($fil_ver_id,'verification_id'))||in_array('2',$fil_ver_id)||in_array('2R',$fil_ver_id)
			||in_array('3',$fil_ver_id)||in_array('4',$fil_ver_id)||count($enroll_list)> 50||!empty($enroll_id_present))
			{
			$querypo['enroll_access'] = 0;
			}
			else
			{
			$querypo['enroll_access'] = 1;// make the checkbox show
			
			//enroll
			if($this->input->post('enroll'))
		 	{// check no: of students in enrolled unit exceeds 60
		 	//$nss_stud_new = $this->input->post('chk'); 
			//echo count($enroll_list);exit;
			$chk_ip_arr = $this->input->post('chk_ip');	
			$nss_stud_new = explode('|',$chk_ip_arr);
			//print_r($chk_ip_arr);exit;
			$enroll_no_cc = count($enroll_list)+count($nss_stud_new);
			if($enroll_no_cc > 50)
			{
			 $querypo['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SHOULD NOT EXCEED MORE THAN 50 STUDENTS</h4>';
			}
			else
			{
			
			
		 	$upd = $this->Publicmodel->update_nss_stud_enroll($nss_stud_new,$querypo['unit_list'],$querypo['batch_period'],$querypo['unit_id']);	
			if($upd)
			{
			 
			$querypo['msg']= '<h4 style="color:#186A3B  ;font-weight:bold;">SUCCESSFULLY ENROLLED</h4>';
			$data_log=array(
			'po_id'=>$this->session->userdata('user_id'),
			'po_action'=>"2",
			'done_ip'=>$_SERVER['REMOTE_ADDR'],
			'done_on'=>date('Y-m-d H:i:s'),
			);
			//€€€print_r($data_log);exit;
			$log_id = $this->Publicmodel->po_log_attempt($data_log);
			$querypo['stud_list'] = $this->Publicmodel->get_stud_list($splname,$year,$querypo['college_id']);				
			}
			}}
			}
			}else
			{
				if($this->input->post('enroll')){
				$chk_ip_arr = $this->input->post('chk_ip');	
			    $nss_stud_new = explode('|',$chk_ip_arr);	
				if(count($nss_stud_new)> 50)
				{ $querypo['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SHOULD NOT EXCEED MORE THAN 50 STUDENTS</h4>';	
				}
				else
				{//$querypo['enroll_access'] = 1;
				
				$upd = $this->Publicmodel->update_nss_stud_enroll($nss_stud_new,$querypo['unit_list'],$querypo['batch_period'],$querypo['unit_id']);	
				if($upd)
				{
				$querypo['msg']= '<h4 style="color:#186A3B;font-weight:bold;">SUCCESSFULLY ENROLLED</h4>';
				$querypo['stud_list'] = $this->Publicmodel->get_stud_list($splname,$year,$querypo['college_id']);				
				}
				}}
			}
			}
			else			
				$out_of_date = 1;
		}		
			$stud_list = $this->Publicmodel->get_stud_list($splname,$year,$querypo['college_id']);	
			
			$querypo['stud_list'] = $stud_list;
			$querypo['year']      = $year;
			$querypo['splname']   = $splname;	
		}
		}
		}
		if(empty($get_enroll_date)|| isset($out_of_date))
		{
			$querypo['enroll_access'] = 0;
		}
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['listspan'] = $this->load->view('po/stud_list',$querypo,true);
		$querypo['adminspan3'] = $this->load->view('common_list_view',$querypo,true);	//template	
		$this->load->view('common_template',$querypo);
	}
	public function edit_stud_list($id)
	{	
	
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['po_unit']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['stud_det'] = $this->Publicmodel->get_stud_det($id);
		if($this->input->post('upd'))
		{
		  $upd_data = array(
		  'nss_stud_id' => $id,
		  'account_id'=> $this->input->post('prn'),
		  'admission_year'=> $this->input->post('admyear'),
		  'account_student_name'=> $this->input->post('name'),
		  'specialisation_id'=> $this->input->post('spl'),
		  'account_student_mobileno' => $this->input->post('mob'),
		  'gender'=>$this->input->post('gender'),
		   'cast'=> $this->input->post('res'),
		  'blood_group'=> $this->input->post('blood_group'),
		  'donate'=> $this->input->post('donate'),
		   'mini1'=> $this->input->post('mini1'),
		  'mini2'=> $this->input->post('mini2'),
		  'splcamp'=> $this->input->post('mini1'),
		  'tot_hr'=> $this->input->post('tot_hr'),
		  'enroll_end'=> $this->input->post('enroll_end'),
		  'splcamp_start'=> $this->input->post('splcamp_start'),
		  'splcamp_end'=> $this->input->post('splcamp_end'),
		  'spl_desti'=> $this->input->post('spl_desti'),
		  'enrolled_date'=> $this->input->post('enrolled_date'),
		  
		 
		  );
		$querypo['id'] = $this->Publicmodel->update_nss_stud($upd_data);	
		if($querypo['id'])
		{
		    $querypo['msg']="UPDATED SUCCESSFULLY";
			$data_po_log=array(
			'po_id'=>$querypo['po_id'],
			'po_action'=>'3',
			'done_ip'=>$_SERVER['REMOTE_ADDR'],
			'done_on'=>date('Y-m-d H:i:s'),
			);
			$log_id = $this->Publicmodel->po_log_attempt($data_po_log);
		}
			$querypo['stud_det'] = $this->Publicmodel->get_stud_certi($id);
		}
		$this->load->view('po/edit_stud_list',$querypo);
	}
	public function view_stud_detail($id='')
	{
	$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['po_unit']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['stud_det'] = $this->Publicmodel->get_stud_det($id);
		
		$this->load->view('po/view_stud_detail',$querypo);
	}
	public function view_enroll_list()
	{	$querypo['main_menu']="enroll";
		$querypo['sub_menu']="v_enroll";
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['po_unit']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		if($querypo['po_unit'])
		{
		$ver_id= array('0','1','1R','2','2R','3','3R','4');
		$data = array(
		'college_id'=>$querypo['college_id'],
		'nss_unit'=>$querypo['po_unit'],
		'batch_period'=>$querypo['batch_period'],
		'ver_id'=>$ver_id,
		);
		$querypo['enroll_list']= $this->Publicmodel->get_enroll_stud_detail($data);
		$querypo['count_stud'] = count($querypo['enroll_list']);
		if($this->input->post('chk'))
		{$val = $this->input->post('chk');
		$rmd= $this->Publicmodel->remove_nss_stud_enroll($val);
		if($rmd)
		{
		$data_log=array(
			'po_id'=>$this->session->userdata('user_id'),
			'po_action'=>"6",
			'done_ip'=>$_SERVER['REMOTE_ADDR'],
			'done_on'=>date('Y-m-d H:i:s'),
			);
			//€€€print_r($data_log);exit;
			$log_id = $this->Publicmodel->po_log_attempt($data_log);
		$querypo['enroll_list']= $this->Publicmodel->get_enroll_stud_detail($data);
		$querypo['count_stud'] = count($querypo['enroll_list']);
		}
		}
		$enroll_stud_p= $this->Publicmodel->get_enroll_stud_detail($data);
		}
		if(isset($enroll_stud_p))
		$enroll_stud_p_id = array_column($enroll_stud_p,'nss_stud_id');
		if($this->input->post('fwdprinci'))
		{
		$ver_id_prin = '1';
		$fwd = $this->Publicmodel->fwd_or_rej($enroll_stud_p_id,$ver_id_prin);
		if($fwd)
		{
		 $querypo['msg']= '<h4 style="color:#FF0000;font-weight:bold;">FORWARDED THE ENROLLED LIST SUCCESSFULLY</h4>';
		 $data_log_id=array(
		    'po_id'=>$this->session->userdata('user_id'),
			'po_action'=>"4",
			'done_ip'=>$_SERVER['REMOTE_ADDR'],
			'done_on'=>date('Y-m-d H:i:s'),
		 );
		 $querypo['enroll_list']= $this->Publicmodel->get_enroll_stud_detail($data);
		 $querypo['count_stud'] = count($querypo['enroll_list']);
		}
		}
		if(isset($querypo['enroll_list']))
		{// for the color scheme (blue)2= fwd to princi green)3,4,6 = fwd to uni (red)5= rej by uni  (red)7 = rej princi
			$querypo['check_veri'] = array_column($querypo['enroll_list'],'verification_id');
		}
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['listspan'] = $this->load->view('po/view_enroll_list',$querypo,true);
		$querypo['adminspan3'] = $this->load->view('common_list_view',$querypo,true);	//template		
		$this->load->view('common_template',$querypo);	
	}
	public function po_monthly_atten()
	{ 					

		$querypo['main_menu']="atten";
	    $querypo['sub_menu']="m_atten";
		if($this->session->flashdata('page_message'))
			$querypo['msg']=$this->session->flashdata('page_message');
			else
			 $querypo['msg']='';
			 
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['unit']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['enroll_list']= $this->Publicmodel->get_enrolled_list($querypo['unit'],$querypo['college_id'],$querypo['batch_period']);	
		$fil_ver_id = array_column($querypo['enroll_list'],'verification_id');
	    if(in_array('4',$fil_ver_id))
		{	$querypo['show'] = 1;// if verification id is 4 then only entry is done
			if($this->input->post('save_stud'))
			{
			$querypo['data_input']=array(
			'input_act_desc'=>$this->input->post('act_desc'),
			'input_act_hr'=>$this->input->post('act_hr'),
			);
			
			//print_r($this->session->flashdata());exit;
			
			$this->form_validation->set_rules('act_desc', 'Activity Description', 'required', array('required' => 'Please enter %s.'));
			$this->form_validation->set_rules('act_hr', 'Activity Hour', 'required|callback_valid_hour', array('required' => 'Please enter %s.','valid_hour' => 'Enter less than 20 hours'));
			
			if ($this->form_validation->run() == FALSE)
			$querypo['msg'] = '<div class="red_msg">ERROR in data submitted. Please clear the errors mentioned below  field.<div>'; 
		 	else
		 	{		
				$date = date("Y-m-d", strtotime($this->input->post('myField')));
				$stud_saved = $this->input->post('chk');		
				$data_mon_aten_o = array(
				'college_id' => $querypo['college_id'],
				'nss_unit_id' => $querypo['unit'],
				'batch_period' => $querypo['batch_period'] ,
				'activity_desc' => $this->input->post('act_desc'),
				'date' =>$date,
				'year'=>substr($date,0,4),
				'month'=>substr($date,5,2),
				'hours' => $this->input->post('act_hr'),
				'verification_id' =>'0',
				'remarks' =>'',
				'created_date'=>date('Y-m-d H:i:s'),
				'status'=>'active',
				);
				if(!empty($data_mon_aten_o))
				{
				//print_r($this->input->post('chk_ip'));exit;
				// insert into nss_m_attendance
				$stud_enroll_val = $this->input->post('chk_ip');
				$stud_enroll= explode('|',$stud_enroll_val);
				//print_r($stud_enroll);exit;
					 if(empty($stud_enroll))
					 $querypo['msg']="Atleast one participant is must";
					 else{
					$ins_id = $this->Publicmodel->insert_monthly_atten($data_mon_aten_o);
					if($ins_id)
					{// batch insertion of enroll students into nss_map_monthlyatten_stud
					 
					 $get_enroll = $this->Publicmodel->get_enroll_from_stud_id($stud_enroll);
					 $j =0; $data_ins = '';
					 for($i=0;$i<count($get_enroll);$i++)
					{
						if($get_enroll && $get_enroll[$i])
						{
							$data_ins[$j] = array(
									'monthly_id'=> $ins_id,
									'nss_stud_id'=> $get_enroll[$i]['nss_stud_id'],
									'nss_enroll_id'=>$get_enroll[$i]['nss_enroll_id'],
									'created_date'=>date('Y-m-d H:i:s'),
								);
							$j++;
						}
					}
					$ins_id_map = $this->Publicmodel->insert_map_monthly($data_ins);
					
					$querypo['msg'] = '<h4 style="color:#FF0000;font-weight:bold;" >SUCCESSFULLY SUBMITTED</h4>';
					$this->session->set_flashdata('page_message',$querypo['msg']);
				    redirect('/Po/NssPo/po_monthly_atten');
					}
					}
				}
				}
			}
		}
		else
		{
			$querypo['show'] = 0;
		}
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['adminspan3'] = $this->load->view('po/po_monthly_atten',$querypo,true);	
		$this->load->view('common_template',$querypo);	
	}
	
	public function po_monthly_atten_view()
	{
		$querypo['main_menu']="atten";
	    $querypo['sub_menu']="m_atten_v";
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['unit']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['sel'] = $this->input->post('get_data');
		if($this->input->post('get_data'))
		{
			if($querypo['sel'] == "Y" || $querypo['sel'] == "M")
				$querypo['year_db'] =$this->Publicmodel->get_mo_atten_year($querypo['college_id'],$querypo['batch_period'],$querypo['unit']);
		}
		if($this->input->post())
		{$year_input= $this->input->post('get_year');
		    if(empty($year_input))
			{
			$querypo['msg']="Select year";
			$querypo['msg_type']="msg_red";
			}
			else
			{
			$querypo['sub'] = 1; 
		    $querypo['sel_year'] = $this->input->post('get_year') ;
			$querypo['sel_month']= $this->input->post('get_month');
			$querypo['sel_date']= $this->input->post('date');
			$detail= array(
			'college_id'=>$querypo['college_id'],
			'batch_period' => $querypo['batch_period'],
			'unit'=> $querypo['unit'],
			'year'=> $this->input->post('get_year'),
			'month'=>$this->input->post('get_month'),
			'date'=>  date("Y-m-d", strtotime($this->input->post('date'))),
			);
			$querypo['month_view_data_initial'] = $this->Publicmodel->get_view_atten_initial($detail);
			
			
			$querypo['msg_type']="msg_red";
			if($this->input->post('fwd_prin')&& !empty($querypo['month_view_data_initial']))
		   { 
			$atten_id = array_column($querypo['month_view_data_initial'],'m_attendance_id');
			$upd_fwd_p = $this->Publicmodel->fwd_prin_atten($atten_id,"1");
			if($upd_fwd_p)
			{
			$querpo['msg']='<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO PRINCIPAL</h4>';
			}
		}
		    $querypo['month_view_data_initial'] = $this->Publicmodel->get_view_atten_initial($detail);
		    $querypo['month_view_data_fwd_prin'] = $this->Publicmodel->get_view_atten_fwd_prin($detail,"1");
			$querypo['month_view_data_fwd_uni'] = $this->Publicmodel->get_view_atten_fwd_uni($detail,"2");
			$querypo['month_view_data_atten_uni'] = $this->Publicmodel->get_view_atten_uni($detail,"4");
			}
			}
			if(empty($querypo['month_view_data_initial'])&&(empty($querypo['month_view_data_fwd_prin']))&&(empty($querypo['month_view_data_fwd_uni']))&&(empty($querypo['month_view_data_atten_uni'])))
			$querypo['msg']='<h4 style="color:#FF0000;font-weight:bold;">NO DATA FOUND</h4>';
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['listspan'] = $this->load->view('po/po_monthly_atten_view',$querypo,true);	
		$querypo['adminspan3'] = $this->load->view('common_list_view',$querypo,true);	//template
		$this->load->view('common_template',$querypo);	
	}
	public function monthly_atten_view_parti()
	{
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['unit']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['monthly_atten_id'] =$this->uri->segment(4);
		$querypo['monthly_atten_parti'] = $this->Publicmodel->get_view_atten_stud($querypo['monthly_atten_id']);
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['listspan'] = $this->load->view('po/monthly_atten_view_parti',$querypo,true);
		$querypo['adminspan3'] = $this->load->view('common_list_view',$querypo,true);	//template	
		$this->load->view('common_template',$querypo);//template
	}
	public function po_camp_detail()
	{
	if($this->session->flashdata('page_message')) $querypo['msg']=$this->session->flashdata('page_message');
			else $querypo['msg']='';
			
		$querypo['main_menu']="camp";
	    $querypo['sub_menu']="c_d";
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['unit']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['enroll_list']= $this->Publicmodel->get_enrolled_list($querypo['unit'],$querypo['college_id'],$querypo['batch_period']);	
		$fil_ver_id = array_column($querypo['enroll_list'],'verification_id');	
		if(in_array('4',$fil_ver_id))
		{
			$querypo['show'] = 1;// if verification id is 8 then only entry is done
		 if($this->input->post('save_stud'))
		 {
		 $querypo['data_input']=array(
		 'from_date'=>$this->input->post('from_date'),
		 'to_date'=>$this->input->post('to_date'),
		 'dest'=>$this->input->post('dest'),
		 'act'=>$this->input->post('act'),
		 'hr'=>$this->input->post('hr'),
		 );
		 
			$this->form_validation->set_rules('from_date', 'from date', 'required|callback_valid_date', array('required' => 'Please enter %s.','valid_date'=>'Enter in (dd-mm-yyyy) format and should be less than current date' ));
			$this->form_validation->set_rules('to_date', 'to date', 'required|callback_valid_date', array('required' => 'Please enter %s.','valid_date'=>'Enter valid  (dd-mm-yyyy) format and should be less than current date'));
			$this->form_validation->set_rules('dest', 'camp site', 'required', array('required' => 'Please enter %s.'));
			$this->form_validation->set_rules('act', 'Activities', 'required', array('required' => 'Please enter %s.'));
			$this->form_validation->set_rules('hr', 'Hours', 'required', array('required' => 'Please enter %s.'));
			if ($this->form_validation->run() == FALSE)
			$querypo['msg'] = '<div class="red_msg">ERROR in data submitted. Please clear the errors mentioned below  field.<div>'; 
		 	else
		 	{
			$fdate = $this->input->post('from_date');
			$tdate = $this->input->post('to_date');
			if($fdate > $tdate)
			$querypo['msg']='<h4 style="color:#FF0000;font-weight:bold;">FROM DATE SHOULD BE LESS THAN TO DATE</h4>';
			else
			{
			 $stud_saved_val = $this->input->post('chk_ip');
			 $stud_saved = explode('|',$stud_saved_val);
			// print_r($stud_saved);exit;
			 if(empty( $stud_saved))
			 $querypo['msg']='<h4 style="color:#FF0000;font-weight:bold;">SELECT ATLEAST ONE PARTICIPANT</h4>'
			 ;
			 else
			 {
			 if(count($_FILES['txt4']['name']))
				{ 
					for($images='',$i=0;$i<count($_FILES['txt4']['name']);$i++)
						$images =  $images.','.$_FILES['txt4']['name'][$i];
				}
			 $cmp_input_data = array(
			'college_id'=>$querypo['college_id'],
			'batch_period'=>$querypo['batch_period'],
			'nss_unit'=>$querypo['unit'],
			'nss_camp_type'=>$this->input->post('cmp'),
			'fromdate'=> date("Y-m-d", strtotime($this->input->post('from_date'))), 
			'todate'=> date("Y-m-d", strtotime($this->input->post('to_date'))),
			'nss_camp_desti'=>$this->input->post('dest'),
			'nss_act'=>$this->input->post('act'),
			'hour_camp'=>$this->input->post('hr'),
			'nss_camp_image'=>$images,
			'created_date'=>date('Y-m-d H:i:s'),
			);
			if(!empty($cmp_input_data))
			{
				$ins_id = $this->Publicmodel->insert_camp($cmp_input_data);
				if($ins_id)
				{// batch insertion of enroll students into nss_map_monthlyatten_stud
					 $stud_enroll_val = $this->input->post('chk_ip');
			 $stud_enroll = explode('|',$stud_enroll_val);
			//// print_r($get_enroll);exit;
					 $get_enroll = $this->Publicmodel->get_enroll_from_stud_id($stud_enroll);
					 $j =0; $data_ins = '';
					 for($i=0;$i<count($get_enroll);$i++)
					 {
						if($get_enroll && $get_enroll[$i])
						{
							$data_ins[$j] = array(
									'nss_camp_id'=> $ins_id,
									'nss_stud_id'=> $get_enroll[$i]['nss_stud_id'],
									'nss_enroll_id'=>$get_enroll[$i]['nss_enroll_id'],
									'created_date'=>date('Y-m-d H:i:s'),
								);
							$j++;
						}
					}
					$ins_id_map = $this->Publicmodel->insert_map_camp($data_ins);
					if($ins_id_map )
					{	$number_of_files_uploaded = count($_FILES['txt4']['name']);
					//print_r($_FILES['txt4']['name'][0]);exit;
					if(!empty($_FILES['txt4']['name'][0]))
					{
						$frmdate = date("d-m-Y", strtotime($this->input->post('from_date')));
					//upload section
						$path_camp   = './upload/po/col'.$querypo['college_id'].'/'.$querypo['batch_period'].'/'.$querypo['unit'].'/camp';
						//echo $path_camp ;exit;
						if (!is_dir($path_camp)) 
						{ //create the folder if it's not  exists
						mkdir($path_camp, 0777, TRUE);
		 				}
						 $this->load->library('upload');
   						 
						  for ($i = 0; $i < $number_of_files_uploaded; $i++) :
      						$_FILES['userfile']['name']     = $_FILES['txt4']['name'][$i];
      						$_FILES['userfile']['type']     = $_FILES['txt4']['type'][$i];
      						$_FILES['userfile']['tmp_name'] = $_FILES['txt4']['tmp_name'][$i];
      						$_FILES['userfile']['error']    = $_FILES['txt4']['error'][$i];
     						$_FILES['userfile']['size']     = $_FILES['txt4']['size'][$i];
      						$config = array(
        					'file_name'     => ($frmdate.'_'.$i),
        					'allowed_types' => 'jpg|jpeg|png',
        					'max_size'      => 3000,
        					'overwrite'     => TRUE,
							'upload_path'   => $path_camp,
      						);
      						$this->upload->initialize($config);
      						if ( ! $this->upload->do_upload()) :
       						 $error =  $this->upload->display_errors();
        					 $querypo['msg']=$error;
      						else :
       						 $final_files_data[] = $this->upload->data();
							 $querypo['msg']=
							  '<h4 style="color:#FF0000;font-weight:bold;">SAVED SUCCESSFULLY</h4>';
							$this->session->set_flashdata('page_message',$querypo['msg']);
							redirect('/Po/NssPo/po_camp_detail');
      						endif;
    						endfor;
							}
							else
							{$querypo['msg']=
							  '<h4 style="color:#FF0000;font-weight:bold;">SAVED SUCCESSFULLY</h4>';
							$this->session->set_flashdata('page_message',$querypo['msg']);
							redirect('/Po/NssPo/po_camp_detail');
							}
							
					}
				}
			}
			}
			}
			}
		 }
		}
		else
		{
			$querypo['show'] = 0;
		}
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['adminspan3'] = $this->load->view('po/po_camp_detail',$querypo,true);	
		$this->load->view('common_template',$querypo);
	}
	public function po_view_camp_detail()
	{
		$querypo['main_menu']="camp";
		$querypo['sub_menu']="v_d";
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['unit_list']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		if($this->input->post())
		{$ver_id=array("0","1","2","3","4","1R","2R","3R");
			$querypo['detail']= array(
			'college_id'=>$querypo['college_id'],
			'batch_period' => $querypo['batch_period'],
			'unit'=> $querypo['unit_list'],	
			'sel_camp_type'=>$this->input->post('get_camp'),
			'veri_id'=>$ver_id,
			);
			$querypo['camp_detail'] = $this->Publicmodel->get_camp_date($querypo['detail']);
			if($this->input->post('fwd_p'))
			{
			 $upd_fwd=$this->Publicmodel->camp_fwd_princi($querypo['camp_detail'][0]['nss_camp_id'],"1");
			 if($upd_fwd)			
			 $querypo['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO PRINCIPAL</h4>';
			}
		}
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['adminspan3'] = $this->load->view('po/po_view_camp_detail',$querypo,true);	
		$this->load->view('common_template',$querypo);
	}
	public function camp_parti()
	{
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['unit']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['camp_id'] =$this->uri->segment(4);
		$querypo['camp_atten_parti'] = $this->Publicmodel->get_camp_parti($querypo['camp_id']);
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['listspan'] = $this->load->view('po/camp_parti',$querypo,true);
		$querypo['adminspan3'] = $this->load->view('common_list_view',$querypo,true);	//template	
		$this->load->view('common_template',$querypo);//template
	}
	public function camp_image()
	{
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['unit']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['camp_id'] =$this->uri->segment(4);
		$querypo['camp_image'] = $this->Publicmodel->get_camp_image($querypo['camp_id']);
		$querypo['camp_image_exp'] = explode(",",$querypo['camp_image']['nss_camp_image']);
		$querypo['camp_image_arr']= array_values( array_filter($querypo['camp_image_exp']) );
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['listspan'] = $this->load->view('po/camp_image',$querypo,true);
		$querypo['adminspan3'] = $this->load->view('common_list_view',$querypo,true);	//template	
		$this->load->view('common_template',$querypo);//template
	}
	public function po_fund_report_prev()
	{
		$querypo['main_menu']="fund";
	    $querypo['sub_menu']="v_f_r";
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['unit_list']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['yrs'] = $this->Publicmodel->get_nss_fund_yrs($querypo['college_id']);
		$querypo['sel_yr'] = $this->input->post('yr');
		$print = $this->uri->segment(4);
		if(isset($print))
		{
			$querypo['sel_yr'] = $print;
		}
		if($querypo['sel_yr'])
		{
			$querypo['fund_det'] = $this->Publicmodel->get_nss_fund($querypo['college_id'],$querypo['sel_yr']);
			$querypo['sanc_fund']= $this->Publicmodel->get_nss_fund_sanc($querypo['college_id'],date('Y'));
			$amount_spent = array_column($querypo['fund_det'], 'amount_spent');
			$querypo['amount_spent_sum'] = array_sum($amount_spent);
		    $querypo['bal'] = $querypo['sanc_fund']['amount_sanc'] - $querypo['amount_spent_sum'];
		}
		if($this->input->post('fwd_prin'))
		{
			if($querypo['fund_det'][0]['nss_fund_id'])
			{
			for($i=0;$i<count($querypo['fund_det']);$i++)
			{
			$fund_ids[$i]=$querypo['fund_det'][$i]['nss_fund_id'];
			}
			$upd = $this->Publicmodel->upd_fund_rep($fund_ids);
			if($upd)
			$querypo['msg']=
			 '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO PRINCIPAL</h4>';
			
			$querypo['msg_type']="msg_green";
			}
			$querypo['fund_det'] = $this->Publicmodel->get_nss_fund($querypo['college_id'],$querypo['sel_yr']);
		}
			if(isset($print))
			{
		    $this->load->library('Pdf');
			$pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
			$pdf->SetTitle('FUND REPORT');
			$pdf->SetTopMargin(15);
			$pdf->setFooterMargin(15);
			$pdf->SetAuthor('Author');
			$pdf->SetDisplayMode('real', 'default');
			$pdf->setPrintHeader(false);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$pdf->AddPage();
 			// Set some content to print
			$html = $this->load->view('po/fund_rep_print', $querypo, true);
			$pdf->writeHTML($html, true, false, true, false, '');
			// set font
			$pdf->SetFont('dejavusans', '', 10);
	 		ob_end_clean();
			//watermark
			$myPageWidth = $pdf->getPageWidth();
			$myPageHeight = $pdf->getPageHeight();
			// Find the middle of the page and adjust.
			$myX = ( $myPageWidth / 2 ) - 70;
			$myY = ( $myPageHeight / 2 ) + 65;
			// Set the transparency of the text to really light
			$pdf->SetAlpha(0.09);
			// Reset the transparency to default
			$pdf->SetAlpha(1);
			$pdf->SetFont("dejavusans", "", 10);
    		$pdf->Output('fund report.pdf', 'I'); 
			}
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['adminspan3'] = $this->load->view('po/po_fund_report_prev',$querypo,true);	
		$this->load->view('common_template',$querypo);
	}
	public function po_fund_report()
	{
		$querypo['main_menu']="fund";
	    $querypo['sub_menu']="f_r";
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['unit_list']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		// get the sanctioned fund from university
		$querypo['sanc_fund']= $this->Publicmodel->get_nss_fund_sanc($querypo['college_id'],date('Y'));
		// if previous year report doesnt exits then upload file enables
		$prevyear = date("Y",strtotime("-1 year"));
		$querypo['data_prev'] = $this->Publicmodel->get_nss_fund($querypo['college_id'],$prevyear);
		if(empty($querypo['data_prev']))
		{
		if($this->input->post('up_but'))
		{
		$ins_data = array(
		'college_id' => $querypo['college_id'],
		'year'=>$prevyear,
		'upload_file'=>($_FILES['up1']['name']),
		'verification_id'=>'0',
		'created_date'=> date('Y-m-d H:i:s'),
		);
		//upload prev fund report
		$path   = './upload/po/'.'col'.$querypo['college_id'].'/FUND/';
		 if (!is_dir($path)) 
		 { 
		  mkdir($path, 0777, TRUE);//create the folder if it's not  exists
		 }
		 $name = $prevyear;
		 $config = array(
                    'allowed_types' =>"pdf|PDF",
					'overwrite'     => TRUE,
                    'upload_path' => $path,
                    'max_size' => '50000',                    
                    'file_name' => $name,
                    'max_height' => "50000",
                    'max_width' => "50000",
                );
		  $this->load->library('upload');
		  $this->upload->initialize($config);
		  if($this->upload->do_upload('up1'))
		  {
			$upload_data = $this->upload->data();
		  }
		  else
		  {
			$error = $this->upload->display_errors();
			$querypo['msg']= $error ;
			$querypo['msg_type']="msg_red";	
		  }
		  if(isset($error))
		  {	}
		  else
		  {
			 $ins_f_prev_id = $this->Publicmodel->upload_data_fund($ins_data);
			 if($ins_f_prev_id)
			 {
				
				 $querypo['msg']=
			 '<h4 style="color:#FF0000;font-weight:bold;">YOU HAVE SUCCESSFULLY UPLOADED PREVIOUS FUND REPORT!</h4>';
			     $querypo['msg_type']="msg_green";	
			 }
		  	}
		   }
		}
		//get the fund report of current year
		$querypo['fund_details'] = $this->Publicmodel->get_nss_fund($querypo['college_id'],date('Y'));
		$amount_spent = array_column($querypo['fund_details'], 'amount_spent');
		$querypo['amount_spent_sum'] = array_sum($amount_spent);
		$querypo['bal'] = $querypo['sanc_fund']['amount_sanc'] - $querypo['amount_spent_sum'];
		$tab_date =  array_column($querypo['fund_details'], 'date');
		// CURRENT YEAR ENTRIES OF FUND REPORT
		if($this->input->post('save_f'))
		{ 
			$fund_type = $this->input->post('fund_type');
			$date = $this->input->post('date');
		    $expense = $this->input->post('txt');
			$amount = $this->input->post('exp');
			//print_r($fund_type);echo"<br></br>";print_r($date);echo"<br></br>";print_r($expense);echo"<br></br>";print_r($amount);exit;
			for($i=0;$i<count($date);$i++)
			{
				$date[$i] = date("Y-m-d", strtotime($date[$i]));
			}
			if(count($date)> count($tab_date)){
				$result=array_intersect($date,$tab_date);
			}
			else
			{
				$result=array_intersect($tab_date,$date);
			}
			if(empty($result))
			{
			for($i=0;$i<count($date);$i++)
			{
			$data_fund_curr[$i] = array(
			'college_id'=>$querypo['college_id'],
			'year'=> substr($date[$i], 0, 4),
			'month'=>substr($date[$i], 5, 2),
			'date'=>date('Y-m-d', strtotime($date[$i])),
			'fund_type'=>$fund_type[$i],
			'expense_desc'=> $expense[$i],
			'amount_spent'=>$amount[$i],
			'upload_file'=>'',
			'verification_id'=>'0',
			'created_date'=>date('Y-m-d H:i:s'),
			);	
			}
			//insert_batch for fund
			 $fund_ins_id = $this->Publicmodel->insert_nss_fund($data_fund_curr);
			 if($fund_ins_id )
			 {
				
				 $querypo['msg']=
			 '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY SAVED THE FUND DETAILS</h4>';
				 $querypo['msg_type']="msg_green";
			 }
			}
		}
		$querypo['data_prev'] = $this->Publicmodel->get_nss_fund($querypo['college_id'],$prevyear);
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['adminspan3'] = $this->load->view('po/po_fund_report',$querypo,true);	
		$this->load->view('common_template',$querypo);
	}
	public function po_monthly_report()
	{
	if($this->session->flashdata('page_message')) $querypo['msg']=$this->session->flashdata('page_message');
			else $querypo['msg']='';
			
		$querypo['main_menu']="month";
		$querypo['sub_menu']="";
		$querypo['id'] = $this->session->userdata('user_id');
		$querypo['unit']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		// year selected
		if($this->input->post('year'))
		{
			 $querypo['year_sel'] = $this->input->post('year');
		}
		//month selected
		if($this->input->post('month'))
		{
			if(empty($querypo['year_sel'] ))
			$querypo['msg']="Select Year";
			elseif(date('Y') == $this->input->post('year') && date('m')>=$this->input->post('month') )
			$flag_ok = '1';
			elseif(date('Y')!= $this->input->post('year'))
			$flag_ok = '1';
			
			if(isset($flag_ok))
			{
			 $querypo['month_sel_n']= $this->input->post('month');	
			 $querypo['month_sel']=date('F', mktime(0, 0, 0, $querypo['month_sel_n'], 10));
			}
			$data_fde = array(
				'college_id' => $querypo['college_id'],
				'nss_unit' => $querypo['unit'],
				'batch_period' => $querypo['batch_period'],
				'year' => $this->input->post('year'),
				'month' => $this->input->post('month'),
				);
			$querypo['monthly_rep_data'] = $this->Publicmodel->get_mothly_report($data_fde);
			$veri_id = array_column($querypo['monthly_rep_data'],'verification_id');//print_r($veri_id);
			if(in_array("0",$veri_id)||in_array("1R",$veri_id)||in_array("3R",$veri_id))
			{
				$querypo['display']=1; 
			}
			elseif(empty($veri_id )){$querypo['display']=1; }else{$querypo['display']=0;}
		    if($this->input->post('todatepicker'))
		    {
				$querypo['start_date'] = $this->input->post('fromdatepicker');
				$querypo['to_date'] = $this->input->post('todatepicker');
				$date1 = new DateTime(date('Y-m-d', strtotime($querypo['start_date'])));
				$date2 = new DateTime(date('Y-m-d', strtotime($querypo['to_date'])));
				$diff=date_diff($date1,$date2);
				$var = $diff->format("%R%a");
				if($var < 0 )
				{
					
					 
				 $querypo['msg']=
			 '<h4 style="color:#FF0000;font-weight:bold;">FROM DATE SHOULD BE LESS THAN OR EQUAL TO TO DATE!</h4>';
					 $flag_error = 1;
					 $querypo['to_date'] = '';
				}
				if( date("Y", strtotime($this->input->post('fromdatepicker'))) != $this->input->post('year'))
				{
					
				
					$querypo['msg']=
			 '<h4 style="color:#FF0000;font-weight:bold;">DATE DOESNOT MATCH TO THE SELECTED YEAR!</h4>';
					$querypo['start_date'] = '';
					$querypo['to_date'] = '';
					$flag_error = 1;
				}
				if(empty($flag_error)){
				$data_chk = array(
				'college_id' => $querypo['college_id'],
				'nss_unit' => $querypo['unit'],
				'batch_period' => $querypo['batch_period'],
				'year' => $this->input->post('year'),
				'month' => $this->input->post('month'),
				'from_date' => date("Y-m-d", strtotime($this->input->post('fromdatepicker'))),
				'to_date' => date("Y-m-d", strtotime($this->input->post('todatepicker'))),
				);
				$querypo['monthly_report_data'] = $this->Publicmodel->get_mothly_report($data_chk);
				}
		}
		if($this->input->post('save'))
		{
		$querypo['data_input']=array(
		'from_date'=>$this->input->post('fromdatepicker'),
		'to_date'=>$this->input->post('todatepicker'),
		'head'=>$this->input->post('head'),
		'content'=>$this->input->post('content_area'),
		);
			
			$this->form_validation->set_rules('fromdatepicker', 'From date', 'required|callback_valid_date|callback_valid_month', array('required' => 'Please enter %s.','valid_date'=>'Enter in (dd-mm-yyyy) format and date should ot be greater than curret date','valid_month'=>'Please enter date based on selected month'));
			$this->form_validation->set_rules('todatepicker', 'To date', 'required|callback_valid_date|callback_valid_month', array('required' => 'Please enter %s.','valid_date'=>'Enter in (dd-mm-yyyy) format and date should ot be greater than curret date','valid_month'=>'Please enter date based on selected month'));
			$this->form_validation->set_rules('head', 'Heading', 'required', array('required' => 'Please enter %s.'));
			$this->form_validation->set_rules('content_area', 'Content', 'required', array('required' => 'Please enter %s.'));
			if ($this->form_validation->run() == FALSE)
			$querypo['msg'] = '<div class="red_msg">ERROR in data submitted. Please clear the errors mentioned below  field.<div>'; 
		 	else
		 	{//value exist
				if(count($_FILES['txt4']['name']))
				{ 
					for($images='',$i=0;$i<count($_FILES['txt4']['name']);$i++)
						$images =  $images.','.$_FILES['txt4']['name'][$i];
				}
				if($querypo['monthly_report_data'] )
				{//update
				$dataupd_month = array(
				'college_id' => $querypo['college_id'],
				'nss_unit' => $querypo['unit'],
				'batch_period' => $querypo['batch_period'],
				'year' => $this->input->post('year'),
				'month' => $this->input->post('month'),
				'from_date' => date("Y-m-d", strtotime($this->input->post('fromdatepicker'))),
				'to_date' => date("Y-m-d", strtotime($this->input->post('todatepicker'))),
				'heading' => trim($this->input->post('head')),
				'content' =>trim($this->input->post('content_area')),
				'image' => '',
				);
				$upd_report_id = $this->Publicmodel->update_monthly_report($dataupd_month);
				if($upd_report_id)
				
				$querypo['msg']=
			 '<h4 style="color:#FF0000;font-weight:bold;">UPDATED SUCCESSFULLY!</h4>';
				$querypo['monthly_report_data'] = $this->Publicmodel->get_mothly_report($data_chk);
				}
				else //value doesnt exist
				{
				$datains_month = array(
				'college_id' => $querypo['college_id'],
				'nss_unit' => $querypo['unit'],
				'batch_period' => $querypo['batch_period'],
				'year' => $this->input->post('year'),
				'month' => $this->input->post('month'),
				'from_date' => date("Y-m-d", strtotime($this->input->post('fromdatepicker'))),
				'to_date' => date("Y-m-d", strtotime($this->input->post('todatepicker'))),
				'heading' => trim($this->input->post('head')),
				'content' => trim($this->input->post('content_area')),
				'image' => $images,
				'created_date' => date('Y-m-d H:i:s'),
				);
				$ins_id = $this->Publicmodel->insert_monthly_report($datains_month);
				if($ins_id)
				{
				//upload section
				$frmdate = date("d-m-Y", strtotime($this->input->post('fromdatepicker')));
				$todate = date("d-m-Y", strtotime($this->input->post('todatepicker')));
				$path_mon_rep   = './upload/po/col'.$querypo['college_id'].'/'.$querypo['batch_period'].'/'.$querypo['unit'].'/mon_rep';
				if (!is_dir($path_mon_rep)) 
				{ //create the folder if it's not  exists
					mkdir($path_mon_rep, 0777, TRUE);
		 		}
				$this->load->library('upload');
   				$number_of_files_uploaded = count($_FILES['txt4']['name']);
				if(empty($_FILES['txt4']['name'][0]))
				{
				
				$querypo['msg']=
			 '<h4 style="color:#FF0000;font-weight:bold;">SAVED SUCCESSFULLY</h4>';
				$this->session->set_flashdata('page_message',$querypo['msg']);
				    redirect('/Po/NssPo/po_monthly_report');
				}
				else
				{
				for ($i = 0; $i < $number_of_files_uploaded; $i++) :
      				$_FILES['userfile']['name']     = $_FILES['txt4']['name'][$i];
      				$_FILES['userfile']['type']     = $_FILES['txt4']['type'][$i];
      				$_FILES['userfile']['tmp_name'] = $_FILES['txt4']['tmp_name'][$i];
      				$_FILES['userfile']['error']    = $_FILES['txt4']['error'][$i];
     				$_FILES['userfile']['size']     = $_FILES['txt4']['size'][$i];
      				$config = array(
        		            'file_name'     => ($frmdate.'_'.$todate.'_'.$i),
        					'allowed_types' => 'jpg|jpeg|png',
        					'max_size'      => 3000,
        					'overwrite'     => TRUE,
							'upload_path'   => $path_mon_rep,
      				);
					$this->upload->initialize($config);
      				if ( ! $this->upload->do_upload()) :
       					$error =  $this->upload->display_errors();
        				$querypo['msg']=$error;
      				else :
       					$final_files_data[] = $this->upload->data();
						
						$querypo['msg']=
			 '<h4 style="color:#FF0000;font-weight:bold;">SAVED SUCCESSFULLY</h4>';
						$this->session->set_flashdata('page_message',$querypo['msg']);
				    redirect('/Po/NssPo/po_monthly_report');
      				endif;
    				endfor;
					}
				}
				$querypo['monthly_report_data'] = $this->Publicmodel->get_mothly_report($data_chk);
				}
			}
			}
			if($this->input->post('fwde'))
			{
			$mon_rep_id = array_column($querypo['monthly_rep_data'],'nss_monthly_report_id');
			$upd_mr = $this->Publicmodel->upd_mon_rep_fwd($mon_rep_id,"1");
			if($upd_mr)
			{
				 
				$querypo['msg']=
			 '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWADED TO PRINCIPAL</h4>';
			}
			}}
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['adminspan3'] = $this->load->view('po/po_monthly_report',$querypo,true);	
		$this->load->view('common_template',$querypo);
	}
	public function po_monthly_report_view()
	{	
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['unit']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		$url_string = $this->uri->segment(4);
		$yr = substr($url_string, 0, 4);
		$month = substr($url_string, 4, 2);
		$querypo['yr_sel'] = $yr;
		if(!empty($month)){
		if($month)
		 $querypo['month_sel']=date('F', mktime(0, 0, 0, $month, 10));
		$data = array(
				'college_id' => $querypo['college_id'],
				'nss_unit' => $querypo['unit'],
				'batch_period' => $querypo['batch_period'],
				'year' => $yr,
				'month' => $month,
				);
		$querypo['monthly_rep_data'] = $this->Publicmodel->get_mothly_report($data);
		 	$this->load->library('Pdf');
			$pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
			$pdf->SetTitle('MONTHLY REPORT');
			$pdf->SetTopMargin(15);
			$pdf->setFooterMargin(15);
			$pdf->SetAuthor('Author');
			$pdf->SetDisplayMode('real', 'default');
			$pdf->setPrintHeader(false);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$pdf->AddPage();
			$html = $this->load->view('po/monthly_report_view', $querypo, true);
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->SetFont('dejavusans', '', 10);
	 		ob_end_clean();
			$pdf->Output('monthly report.pdf', 'I');
		}
		else
		{
			$data = array(
				'college_id' => $querypo['college_id'],
				'nss_unit' => $querypo['unit'],
				'batch_period' => $querypo['batch_period'],
				'year' => $yr,
				);
		   $querypo['yr_rep_data'] = $this->Publicmodel->get_mothly_report($data);
		   $querypo['months_in_array'] = array_unique(array_column($querypo['yr_rep_data'], 'month'));
		 	$this->load->library('Pdf');
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
			$pdf->SetTitle('YEARLY REPORT');
			$pdf->SetTopMargin(15);
			$pdf->setFooterMargin(15);
			$pdf->SetAuthor('Author');
			$pdf->SetDisplayMode('real', 'default');
			$pdf->setPrintHeader(false);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$pdf->AddPage();
			$html = $this->load->view('po/yrly_report_view', $querypo, true);
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->SetAlpha(1);
			$pdf->SetFont('dejavusans', '', 10);
	 		ob_end_clean();
			$pdf->Output('Yearly report.pdf', 'I');
			}
	}
	public function eligibility_rep()
	{
		$querypo['main_menu']="eli";
	    $querypo['sub_menu']="";
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['unit']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		
		$querypo['eli_det'] = $this->Publicmodel->get_elig_rep($querypo['college_id'],$querypo['batch_period'],$querypo['unit']);
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['adminspan3'] = $this->load->view('po/po_eligibility_rep',$querypo,true);	
		$this->load->view('common_template',$querypo);
	}
	public function eligibility_rep_old()
	{
		$querypo['main_menu']="eli";
	    $querypo['sub_menu']="";
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['unit']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['stud_det']= array();
		$camp_data = array(
		'college_id'=>$querypo['college_id'],
		'batch_period'=>$querypo['batch_period'],
		'unit'=>$querypo['unit'],
		//'verification_id'=>'4',
		);
		//echo $querypo['college_id'];exit;
		$camp_data['veri_id'] = array('4');
		$camp_exist = $this->Publicmodel->get_camp_date($camp_data);
		
		$ver_id = array("0","1","1R","2","2R","3","4","3R");
		if(!empty($camp_exist))
		{//print_r($camp_exist);exit;
		$querypo['eli_det'] = $this->Publicmodel->chk_elig_rep($querypo['college_id'],$querypo['batch_period'],$querypo['unit'],$ver_id);
		if(empty($querypo['eli_det']))
		{// insert_batch  into table nss_elig_rep
		$eli_data = $this->Publicmodel->get_data_for_elig_rep1($querypo['college_id'],$querypo['batch_period'],$querypo['unit']);
		
		if(!empty($eli_data))
		{
			$j =0; $data_eli_ins='';
			for($i=0; $i< count($eli_data);$i++)
			{
			if($eli_data && $eli_data[$i])
			{
			  if($eli_data[$i]['camp_type'])
				{
					$cmp = explode(",",$eli_data[$i]['camp_type']);
					if(in_array('spl',$cmp)) $spl = 'Y'; else $spl = 'N';
					if(in_array('mini1',$cmp)) $mini1 = 'Y'; else  $mini1 = 'N';
					if(in_array('mini2',$cmp))	$mini2 = 'Y';else $mini2 = 'N';
				}
				else
				{
					$spl = 'N';$mini1 = 'N'; $mini2 = 'N';
				}
				if(!empty($eli_data[$i]['nss_enroll_id']))
				$twoyr = 'Y';
				else
				$twoyr = 'N';
				$total_hr=0;
				if($eli_data[$i]['atten_hour'] || $eli_data[$i]['hour_camp'] )
				$total_hr = $eli_data[$i]['atten_hour'] + $eli_data[$i]['hour_camp'];
					 //1. enroll 2. spl camp 3. minicamp1/minicamp2 4. 240 hr
				if(!empty($eli_data[$i]['nss_enroll_id']) && ($spl == 'Y') && (($mini1 == 'Y') || ($mini1 == 'Y')) && ($total_hr >= 240))
				$eli = 'Y';
				else
				$eli = 'N';
					$data_eli_ins[$j] = array(
					'college_id'=> $querypo['college_id'] ,
					'batch_period'=>$querypo['batch_period'],
					'nss_unit'=>$querypo['unit'],
					'nss_stud_id'=>$eli_data[$i]['nss_stud_id'],
					'stud_name'=>$eli_data[$i]['account_student_name'],
					'accademic_year'=>'',
					'accademic_month'=>'',
					'spl_camp'=>$spl,
					'mini_cmp1'=>$mini1,
					'mini_cmp2'=>$mini2,
					'total_hr'=>$total_hr,
					'2yr'=> $twoyr,
					'nss_enroll_id'=>$eli_data[$i]['nss_enroll_id'],
					'stud_gender'=>'',
					'specialisation_display_name'=>$eli_data[$i]['specialisation_display_name'],
					'nss_enrol'=>$eli_data[$i]['nss_enroll_id'],
					'remarks'=>'',
					'prepared_by_po'=>$querypo['po_id'],
					'verified_by_princi'=>'',
					'verified_by_admin'=>'',
					'eligibile'=> $eli,
					'verification_id'=>'0',
					'created_date'=>date('Y-m-d H:i:s'),
					);
					$j++;
				}
			}
			if(isset($data_eli_ins))
			{
				$ins = $this->Publicmodel->insert_elig_rep($data_eli_ins);
				if($ins)
				
				 $querypo['msg']=
			 '<h4 style="color:#FF0000;font-weight:bold;">NSS ELIGIBILE REPORT GENERATED SUCCESSFULLY!</h4>';
			}
			}
			else
			
			 $querypo['msg']=
			 '<h4 style="color:#FF0000;font-weight:bold;">ELIGIBILITY REPORT NOT AVAILABLE</h4>';
		}
		if($this->input->post('fwd_prin'))
		{
			$data_eli_upd = array(
			'college_id'=>$querypo['college_id'],
			'batch_period'=>$querypo['batch_period'],
			'nss_unit'=>$querypo['unit'],
			'verification_id'=>'',
			'chg_ver_id'=>'1',
			'remarks'=>''
			);
			$upd_eli = $this->Publicmodel->fwd_prin_eli($data_eli_upd);
			if($upd_eli)
			
			$querypo['msg']=
			 '<h4 style="color:#FF0000;font-weight:bold;">FORWARDED TO PRINCIPAL</h4>';
		}
	
		}
		$querypo['eli_det'] = $this->Publicmodel->chk_elig_rep($querypo['college_id'],$querypo['batch_period'],$querypo['unit'],$ver_id);
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['adminspan3'] = $this->load->view('po/po_eligibility_rep',$querypo,true);	
		$this->load->view('common_template',$querypo);
	}
	public function po_audit_report()
	{
		$querypo['main_menu']="audit";
	    $querypo['sub_menu']="";
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['unit_list']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		$prev_yr = date("Y",strtotime("-1 year"));
		$curr_yr = date("Y");
		if($this->input->post())
		{
			if($this->input->post('upload1'))
			{
			$upload_det = $_FILES['txt1']['name'];
			$name = $prev_yr;
			$upload_value = "txt1";
			}
			elseif($this->input->post('upload2'))
			{
			$upload_det = $_FILES['txt2']['name'];
			$name = $curr_yr;
			$upload_value = "txt2";
			}
			$ins_data = array(
			'year'=> $name,
			'college_id'=>$querypo['college_id'],
			'created_po_id'=>$querypo['po_id'] ,
			'created_date'=>date('Y-m-d H:i:s'),
			'status'=>'active',
			'upload_audit'=> $upload_det ,
			'verification_id'=>"1",
			'remarks'=>'',
			);
			//upload prev audit
		  $path   = './upload/po/'.'col'.$querypo['college_id'].'/AUDIT/';
		 if (!is_dir($path)) 
		 { 
		  mkdir($path, 0777, TRUE);//create the folder if it's not  exists
		 }
		 $config = array(
                    'allowed_types' =>"pdf|PDF",
					'overwrite'     => TRUE,
                    'upload_path' => $path,
                    'max_size' => '50000',                    
                    'file_name' => $name,
                    'max_height' => "50000",
                    'max_width' => "50000",
                );
		  $this->load->library('upload');
		  $this->upload->initialize($config);
		  if($this->upload->do_upload($upload_value))
		  {
			$upload_data = $this->upload->data();
		  }
		  else
		  {
			$error = $this->upload->display_errors();
			$querypo['msg']= $error ;	
			print_r( $error);exit;
		  }
		   if(isset($error))
		  {
			echo '<script>alert('.$error.');</script>';	  
		  }
		   else
		  {
			 $ins_audit_id = $this->Publicmodel->ins_audit($ins_data);
			 if($ins_audit_id)
			 {
				
				$querypo['msg']=
			 '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY SAVED THE AUIDT DETAILS</h4>';
			 }
		  }
		}
		$querypo['audit_detail']=$this->Publicmodel->get_audit_last5($querypo['college_id']);
		$years = array_column($querypo['audit_detail'], 'year');
		$querypo['prev_exist']=in_array($prev_yr,$years);
		$querypo['curr_exist']=in_array($curr_yr,$years);
		//upload section
		$querypo['audit_detail']=$this->Publicmodel->get_audit_last5($querypo['college_id']);
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['adminspan3'] = $this->load->view('po/po_audit_report',$querypo,true);	
		$this->load->view('common_template',$querypo);
	}
	public function nss_certi()
	{
		$querypo['main_menu']="certi";
	    $querypo['sub_menu']="";
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['unit_list']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		if($this->input->post('certi_type'))
		{		
			$querypo['certi_type'] = $this->input->post('certi_type');
			if($querypo['certi_type']=='V')
			{
				$querypo['eli_dat'] = $this->Publicmodel->get_elig_rep_certi($querypo['college_id'],$querypo['batch_period'],$querypo['unit_list']);
			}
		}
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['adminspan3'] = $this->load->view('po/nss_certi',$querypo,true);	
		$this->load->view('common_template',$querypo);
	}
	public function nss_certi_view1()
	{
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['unit_list']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['adminspan3'] = $this->load->view('po/nss_certi',$querypo,true);	
		$this->load->view('common_template',$querypo);
	}
	public function nss_certi_view()
	{	
		$id = $this->uri->segment(4);
		$data['student_details'] = $this->Publicmodel->certi_new($id);
		//print_r();exit;
		$this->load->library('Pdf');
			//$pdf = new Pdf('L', 'mm', array(200,97), true, 'UTF-8', false);
		$pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('NSS CERTIFICATE');
		//pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(15);
		$pdf->setFooterMargin(15);
		//$pdf->setLeftMargin(20);
		//$pdf->setRightMargin(20);
		//$pdf->SetAutoPageBreak(true);
	    $pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');
		//$pdf->SetAutoPageBreak(true, 55);
		$pdf->setPrintHeader(false);
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->AddPage();
		$cloisterblack = $pdf->AddFont('cloisterblack');
 		// Set some content to print
		$pdf->AddPage('L', 'A4');
		$pdf->deletePage('1');
		$pdf->SetAutoPageBreak(false, 0);
		$html = $this->load->view('po/nss_certi_view', $data, true);
		$pdf->writeHTML($html, true, false, true, false, '');
		// set font
		$pdf->SetFont('dejavusans', '', 10);
	    ob_end_clean();
		//watermark
		$myPageWidth = $pdf->getPageWidth();
		$myPageHeight = $pdf->getPageHeight();
		// Find the middle of the page and adjust.
		$myX = ( $myPageWidth / 2 ) - 70;
		$myY = ( $myPageHeight / 2 ) + 65;
		// Set the transparency of the text to really light
		$pdf->SetAlpha(0.09);
		// Rotate 45 degrees and write the watermarking text
		$pdf->StartTransform();
		$pdf->Rotate(45, $myX, $myY);
		$pdf->SetFont("cloisterblack", "", 40);
		$pdf->Text($myX, $myY,"Mahatma Gandhi University"); 
		$pdf->StopTransform();
		// Reset the transparency to default
		$pdf->SetAlpha(1);
		// QR code
			$style = array(
			'border' => true,
			'vpadding' => 'auto',
			'hpadding' => 'auto',
			'fgcolor' => array(0,0,0),
			'bgcolor' => false, //array(255,255,255)
			'module_width' => 1, // width of a single module in points
			'module_height' => 1 // height of a single module in points
			);
			//QR code for application no.
			//$security_code= $approval_details[0]['security_code'];
			$seccode=$id*27;
		$code = md5($data['student_details']['nss_enroll_id']); //exit;
		//print_r($code);exit;
			// QRCODE,M : QR-CODE Medium error correction
		$pdf->SetFont("dejavusans", "", 10);
			//$pdf->write2DBarcode($code, 'QRCODE,M', 190, 06, 12, 12, $style, 'N');
			//$pdf->Text(20, 60, 'Security Code: '.$security_code);
			//$pdf->Text(20, 70, 'Certificate No.: '.$code);
			//QR code for verification . redirecting to site
			// QRCODE,M : QR-CODE Medium error correction
		$pdf->write2DBarcode(base_url().'VerifyCertificate/verify_certificate_view/'.$data['student_details']['nss_enroll_id'].'/'.$code, 'QRCODE,M', 250, 170, 18, 18, $style, 'N');
			//$pdf->write2DBarcode('www.google.com', 'QRCODE,M', 177, 260, 50, 50, $style, 'N');
		$pdf->Text(20, 190, 'NB: Authenticity of this document can be verified by scanning the QR code or can visit the following link :'. base_url("VerifyCertificate") );
    	$pdf->Output('certificate.pdf', 'I'); 
	}
	public function track_his()
	{
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['adminspan3'] = $this->load->view('track_his',$querypo,true);	
		$this->load->view('common_template',$querypo);
	}
	public function notification()
	{
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar',$querypo,true);	
		$querypo['listspan'] = $this->load->view('notification',$querypo,true);
		$querypo['adminspan3'] = $this->load->view('common_list_view',$querypo,true);	//template	
		$this->load->view('common_template',$querypo);//template		
	}	
	public function blood_bank()
	{
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar',$querypo,true);	
		$querypo['listspan'] = $this->load->view('blood_bank',$querypo,true);
		$querypo['adminspan3'] = $this->load->view('common_list_view',$querypo,true);	//template	
		$this->load->view('common_template',$querypo);//template	
	}
	public function gallery()
	{
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar',$querypo,true);	
		$querypo['adminspan3'] = $this->load->view('po/po_gallery',$querypo,true);	//template	
		$this->load->view('common_template',$querypo);//template	
	}
	public function eil()
	{
		$querypo['user_type']    = $this->session->userdata('user_type');
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar',$querypo,true);	
		$querypo['listspan'] = $this->load->view('eil',$querypo,true);
		$querypo['adminspan3'] = $this->load->view('common_list_view',$querypo,true);	//template	
		$this->load->view('common_template',$querypo);//template	
	}
	function valid_hour($var)
	{ //echo $var;exit;
		if($var <20)
		return true;
		else
		return false;
	}
	
	function valid_date($post_string)
	{
		if(!preg_match("/(^(((0[1-9]|1[0-9]|2[0-8])[-](0[1-9]|1[012]))|((29|30|31)[-](0[13578]|1[02]))|((29|30)[-](0[4,6,9]|11)))[-](19|[2-9][0-9])\d\d$)|(^29[-]02[-](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/", $post_string)){//!preg_match("/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/", $post_string)
			return false;
		}
		else
		{
		if($post_string > date("d-m-y"))
		return false;
		else
		
		 return true;
		 }
	}
	function valid_month($post_month)
	{
	$sel_month = $this->input->post('month');
	$ip_month=date("m", strtotime($post_month));
	if($sel_month == $ip_month)
	return true;
	else return false;
	}
																															
}
