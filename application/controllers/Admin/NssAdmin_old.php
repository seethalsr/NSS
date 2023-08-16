<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NssAdmin extends CI_Controller 
{
	public function __construct() 
	{
        parent::__construct();
		$this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->helper('string');
        $this->load->helper('captcha');
        $this->load->model('Publicmodel');		
		$login_id	= $this->session->userdata('login_id');
		$utype	    = $this->session->userdata('utype');
		$HTTP_REF = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:null;
		if(empty($login_id) || empty($utype) ) 
		redirect('/Nsscontrol');	
		else if(empty($HTTP_REF)) redirect('/Nsscontrol');
		$login_detail = $this->Publicmodel->getlogin_login_id($login_id);
		$this->session->user_id = $login_detail['user_id'];
		$this->session->name = $login_detail['name'];
		$this->session->college_id = $login_detail['college_id'];
		$this->session->user_type = $login_detail['user_type'];
    }
	public function index()
	{
		$queryadmin['main_menu']= 'home';
		$queryadmin['sub_menu']= "";
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['adminspan3'] = $this->load->view('po/po_body','',true);	
		$this->load->view('common_template',$queryadmin);
	}
	public function chg_pwd()
	{
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$login_id = $this->session->userdata('login_id');
		$queryadmin['adminspan3'] = $this->load->view('chg_pwd','',true);
		if($this->input->post('sub'))
		{
		$queryadmin['curr_pwd'] = $this->input->post('curr_pwd');
		$queryadmin['new_pwd'] = $this->input->post('new_pwd');
		$queryadmin['con_pwd'] = $this->input->post('con_pwd');
		if($this->session->flashdata('page_message')) 
		$queryadmin['msg']=$this->session->flashdata('page_message');
		else $queryadmin['msg']='';
		$this->form_validation->set_error_delimiters('<span class="error_form_validation">', '</span>');
		$this->form_validation->set_rules('curr_pwd', 'Current Password', 'required',array('required' => 'Please provide %s.'));
		$this->form_validation->set_rules('new_pwd', 'New Password', 'required',array('required' => 'Please provide %s.'));
		$this->form_validation->set_rules('con_pwd', 'Confirm Password', 'required',array('required' => 'Please provide %s.'));
		if ($this->form_validation->run() === FALSE){ 
		$queryadmin['msg']="PLEASE FILL THE  REQUIRED FIELDS BELOW";	
		$queryadmin['msg_type']="msg_red";
		$queryadmin['adminspan3'] = $this->load->view('chg_pwd',$queryadmin,true);			
		}
		else
		{
		$login_detail = $this->Publicmodel->getlogin_login_id($login_id);
		if($queryadmin['curr_pwd'] == $login_detail['password'])
		{
			if($queryadmin['new_pwd'] == $queryadmin['con_pwd'])
			{
				$data_chg_pwd = array(
			    'password'=>$queryadmin['con_pwd'],
			    );
			    $upd_id = $this->Publicmodel->login_upd_prin($data_chg_pwd,$login_id);
				if($upd_id)
				{
				//$queryadmin['msg']="NEW PASSWORD UPDATED SUCCESSFULLY";
				$queryadmin['msg']= '<h6 style="color:#006600;font-weight:bold">NEW PASSWORD UPDATED SUCCESSFULLY</h6>';
				if($queryadmin['user_type']=="po")
				{
				$data_po_log_attempt=array(
				'po_id'=>$this->session->userdata('user_id'),
				'po_action'=>"1",
				'done_ip'=>$_SERVER['REMOTE_ADDR'],
				'done_on'=>date('Y-m-d H:i:s'),
				);
				$ins_attempt_id = $this->Publicmodel->po_log_attempt($data_po_log_attempt);
			}
			elseif($queryadmin['user_type']=="assistant")
			{
				$data_assi_log_attempt=array(
				'assi_id'=>'0',
				'assi_action'=>"1",
				'done_ip'=>$_SERVER['REMOTE_ADDR'],
				'done_on'=>date('Y-m-d H:i:s'),
				);
				$ins_attempt_id = $this->Publicmodel->assi_log_attempt($data_assi_log_attempt);
			}
			elseif($queryadmin['user_type']=="principal")
			{
				$data_princi_log_attempt=array(
				'princi_id'=>$this->session->userdata('user_id'),
				'princi_action'=>"1",
				'done_ip'=>$_SERVER['REMOTE_ADDR'],
				'done_on'=>date('Y-m-d H:i:s'),
				);
				$ins_attempt_id = $this->Publicmodel->princi_log_attempt($data_princi_log_attempt);
			}
			elseif($queryadmin['user_type']=="so")
			{
				$data_so_log_attempt=array(
				'so_id'=>$this->session->userdata('user_id'),
				'so_action'=>"1",
				'done_ip'=>$_SERVER['REMOTE_ADDR'],
				'done_on'=>date('Y-m-d H:i:s'),
				);
				$ins_attempt_id = $this->Publicmodel->so_log_attempt($data_so_log_attempt);
			}
			}
				$queryadmin['msg_type']="msg_green";
			 	$queryadmin['adminspan3'] = $this->load->view('chg_pwd',$queryadmin,true);
			}
			else
			{
				$queryadmin['msg']="NEW PASSWORD AND CONFIRM PASSWORD DOESNOT MATCH";
				$queryadmin['msg_type']="msg_red";
				$queryadmin['adminspan3'] = $this->load->view('chg_pwd',$queryadmin,true);
			}
		}	
		else
		{
			$queryadmin['msg']="CURRENT PASSWORD DOESNOT MATCH!";
			$queryadmin['msg_type']="msg_red";
			$queryadmin['adminspan3'] = $this->load->view('chg_pwd',$queryadmin,true);
		}	
		}
		}
		
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$this->load->view('common_template',$queryadmin);
	}
	public function college_list()
	{
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['main_menu']= 'college_list';
		$queryadmin['sub_menu']="";
		$queryadmin['college_list'] = $this->Publicmodel->getlistcollege();
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['listspan'] = $this->load->view('admin/college_list',$queryadmin,true);
		$queryadmin['adminspan3'] = $this->load->view('common_list_view',$queryadmin,true);	//template		
		$this->load->view('common_template',$queryadmin);
	}
	public function stud_list()
	{/*
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['main_menu']= 'student_list';
		$queryadmin['sub_menu']="";
		$queryadmin['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)
		{
			$queryadmin['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
			$college_name_sel = $this->input->post('name');
			if($college_name_sel)
		{
			$queryadmin['batch_list']=$this->Publicmodel->princi_batch_period($college_name_sel);
			if(empty($queryadmin['batch_list'])) $queryadmin['msg']="NO DATA FOUND";
			$queryadmin['sel_batch'] = $this->input->post('batch');
		}
		}
			
		//$queryadmin['student_list'] = $this->Publicmodel->get_student();
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['listspan'] = $this->load->view('admin/stud_list',$queryadmin,true);	
		$queryadmin['adminspan3'] = $this->load->view('common_list_view',$queryadmin,true);	//template
		$this->load->view('common_template',$queryadmin);
	*/}
	public function add_college()
	{
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		
		if($this->session->flashdata('page_message')) $queryadmin['msg']=$this->session->flashdata('page_message');		
		else $queryadmin['msg']='';
		
		$this->form_validation->set_error_delimiters('<span class="error_form_validation">', '</span>');		
		$this->form_validation->set_rules('txt1', 'Name ', 'required|regex_match[/^[a-zA-Z. ]*$/]',array('required' => 'Please provide %s.','regex_match'=>'Invalid Name.'));
		$this->form_validation->set_rules('txt2', 'Email', 'required|valid_email|is_unique[nss_college.college_email]',array('required' => 'Please provide a valid %s.','is_unique'=>'This %s is already registered'));
		$this->form_validation->set_rules('txt3', 'address', 'required',array('required' => 'Please provide a valid %s.'));
		$this->form_validation->set_rules('txt4', 'district', 'required',array('required' => 'Please provide a valid %s.'));
		$this->form_validation->set_rules('txt5', 'Pincode	', 'trim|required|exact_length[6]|numeric', array('required' => 'Please enter %s.', 'min_length' => '%s length should be 6'));
		$this->form_validation->set_rules('txt6', 'Mobile Number', 'required|is_unique[nss_college.college_contact_no]|regex_match[/^[7-9]\d{9}$/]',array('required' => 'Please provide a valid %s.','is_unique'=>'This %s is already registered','regex_match'=>'Please provide a valid %s.'));
		$this->form_validation->set_rules('txt7', 'Name ', 'required|regex_match[/^[a-zA-Z. ]*$/]',array('required' => 'Please provide %s.','regex_match'=>'Invalid Name.'));
		$this->form_validation->set_rules('txt8', 'Email', 'required|valid_email|is_unique[nss_principal.principal_email]',array('required' => 'Please provide a valid %s.','is_unique'=>'This %s is already registered'));
		$this->form_validation->set_rules('txt9', 'Mobile Number', 'required|is_unique[nss_principal.principal_contact]|regex_match[/^[7-9]\d{9}$/]',array('required' => 'Please provide a valid %s.','is_unique'=>'This %s is already registered','regex_match'=>'Please provide a valid %s.'));
		 if ($this->form_validation->run() == FALSE)
		 {
			$queryadmin['msg'] = '<div class="red_msg">ERROR in data submitted. Please clear the errors mentioned below  field.<div>'; 
		 }
		 else
		 {
			$code_array =$this->Publicmodel->get_college_code();
			$code = count($code_array);
			if ($code <10)
			{
			$code++;
			$code = 'X00'.$code;
			}
			elseif($code<100)
			{
			$code++;
			$code = 'X0'.$code;
			}
		if($this->input->post('submit5'))
		{
			$data = array(
						'college_code'=> $code,
						'college_name'=>$this->input->post('txt1'),
						'college_name'=>$this->input->post('txt1'),
						'college_email'=>$this->input->post('txt2'),						
						'college_address'=>$this->input->post('txt3'),
						'college_district'=>$this->input->post('txt4'),						
						'college_pincode'=>$this->input->post('txt5'),
						'college_contact_no'=>$this->input->post('txt6'),
						'college_type'=>$this->input->post('radios'),			
					);
		$datap = array(
						'principal_name'=> $this->input->post('txt7'),
						'principal_contact'=>$this->input->post('txt9'),
						'principal_email'=>$this->input->post('txt8'),
					);
		$inc =$this->Publicmodel->insert_new_college($data);
		$inp =$this->Publicmodel->insert_princi($datap);
		if($inc && $inp )
		{
			$datalogin =array(
						'college_id'=>$inc,
						'user_type'=>'principal',						
						'username'=>$this->input->post('txt8'),
						'password'=>random_string('alnum', 8),
						'status'=>'active',
						'user_id'=> $inp,
						'name'=>$this->input->post('txt7'),
						);
						$inl = $this->Publicmodel->addlogin($datalogin);
						if($inl)
						{ 	
						$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY CREATED!!</h4>';					
		}
		}
		}
		}
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['adminspan3'] = $this->load->view('admin/add_college','',true);	
		$this->load->view('common_template',$queryadmin);	
	}
		public function admin_princi()
	{
		$queryadmin['msg']="";
		$queryadmin['main_menu']="princi";
		$queryadmin['sub_menu']="admin_princi";
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['nss_college_type'] = $this->Publicmodel->get_college_type();	
		if($type = $this->input->post('type'))	
		{
			$queryadmin['colge_list']=$this->Publicmodel->get_college_name_wo_princi($type);
			if($this->input->post('subm'))
			{
				$colge_id = $this->input->post('ids');
				$arr_colge = explode(",",$colge_id);
				$colge_email = $this->Publicmodel->get_colge_email($arr_colge);
				//generate principal login creditial for colleges
				for($i=0;$i< count($colge_email);$i++)
				{
				$datalogin[$i] =array(
						'college_id'=>$colge_email[$i]['college_id'],
						'user_type'=>'principal',						
						'username'=>$colge_email[$i]['college_email'],
						'password'=>random_string('alnum', 8),
						'status'=>'active',
						'user_id'=>'',
						'name'=>'PRINCIPAL',
						'first_login'=>'Y',
						'created_date'=>date('Y-m-d H:i:s'),
						);
				}
			$inslogin = $this->Publicmodel->addlogin_batch($datalogin);
			if($inslogin)
			{//mail + if mail sent ,catch action attempt
			
			$count_nss_login =$this->Publicmodel->get_login_count();
			do{
				$send_email = $this->sendaccountdetailsemail($inslogin);	
				$inslogin++;
				}while( $inslogin <= $count_nss_login['login_id']);

			$queryadmin['msg']='<div class="w3-text-green">Saved successfully!!! Username and Password has sent it to Collge Email Id. Please check in spam mail also.<div>';
			$data_log=array(
							'assi_id'=>$this->session->userdata('user_id'),
							'assi_action'=>"9",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->assi_log_attempt($data_log);
			}
			}
			$queryadmin['colge_list']=$this->Publicmodel->get_college_name_wo_princi($type);
		}
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['listspan'] = $this->load->view('admin/create_princi',$queryadmin,true);
		$queryadmin['adminspan3'] = $this->load->view('common_list_view',$queryadmin,true);	//template		
		$this->load->view('common_template',$queryadmin);		
	}
	public function admin_princi_list()
	{	$queryadmin['msg']="";
		$queryadmin['main_menu']="princi";
		$queryadmin['sub_menu']="admin_princi_list";
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['princi_list']= $this->Publicmodel->princi_det_join();
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['listspan'] = $this->load->view('admin/princi_list',$queryadmin,true);
		$queryadmin['adminspan3'] = $this->load->view('common_list_view',$queryadmin,true);	//template		
		$this->load->view('common_template',$queryadmin);	
	}	
	public function princi_det()
	{
		$prin_id = $this->uri->segment(4);
		$queryadmin['princi_det']= $this->Publicmodel->get_profile_princi($prin_id);
		$queryadmin['user_type']="admin";
		$queryadmin['name']=$queryadmin['princi_det']['principal_name'];	
		$this->load->view('profile',$queryadmin);
	}
	public function prin_his()
	{
		$queryadmin['msg']="";
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['main_menu']="princi";
		$queryadmin['sub_menu']="prin_his";
		$queryadmin['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)
		{
			$queryadmin['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
			$college_name_sel = $this->input->post('name');
		if($college_name_sel)
		{
			$queryadmin['princi_list']= $this->Publicmodel->prin_his($college_name_sel);
		}
		}
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['listspan'] = $this->load->view('admin/prin_his',$queryadmin,true);
		$queryadmin['adminspan3'] = $this->load->view('common_list_view',$queryadmin,true);	//template		
		$this->load->view('common_template',$queryadmin);	
	}
	public function po_list()
	{
		$queryadmin['msg']="";
		$queryadmin['main_menu']= 'po_list';
		$queryadmin['sub_menu']="";
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)
		{ 
			$queryadmin['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
			$college_name_sel = $this->input->post('name');
		if($college_name_sel)
		{
			$queryadmin['po_det']= $this->Publicmodel->get_po($college_name_sel);
		}
		}	
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['listspan'] = $this->load->view('princi/view_po',$queryadmin,true);
		$queryadmin['adminspan3'] = $this->load->view('common_list_view',$queryadmin,true);	//template		
		$this->load->view('common_template',$queryadmin);	
	}
	public function admin_manage()
	{
		$queryadmin['msg']="";
		$queryadmin['main_menu']= 'manage';
		$queryadmin['sub_menu']="";
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['get_data_manage'] = $this->Publicmodel->get_data_manage_enroll(date('Y'));
		$queryadmin['web_data'] = $this->Publicmodel->get_web_content();
		$verfaq_id="process";
		$queryadmin['faq_data'] = $this->Publicmodel->get_faq_data($verfaq_id);
		$type = $this->uri->segment(4);
		if(!empty($type))
		{
			switch($type)
			{
				case 1://enroll date
					if($queryadmin['user_type']=="assistant")
					{
					  if($this->input->post('submitenrolldate'))
					  {
					  	if($this->input->post('fromdatepicker')<> ""){
					   $fdate= date("d-m-Y", strtotime($this->input->post('fromdatepicker')));}
					   else $fdate= "";
					  $queryadmin['data4_manage']=array(
					  'fromdatepicker'=>$fdate,
						'todatepicker'=>$this->input->post('todatepicker'),
						);
						if($queryadmin['get_data_manage'])//update
						{
							if($this->session->flashdata('page_message')) $queryadmin['msg']=$this->session->flashdata('page_message');
							else $queryadmin['msg']='';
							$this->form_validation->set_error_delimiters('<span class="error_form_validation">', '</span>');			
							$this->form_validation->set_rules('fromdatepicker', 'Start date', 'required|callback_valid_enroll_date_f',array('required' => 'Please fill  %s','valid_enroll_date_f'=>'%s  should be gretaer than or equal to current date '));
							$this->form_validation->set_rules('todatepicker', 'End date', 'required|callback_ valid_enroll_date_t',array('required' => 'Please fill  %s','valid_enroll_date_t'=>'%s should be gretaer than or equal to current date'));
							if ($this->form_validation->run() === FALSE)						
							$queryadmin['msg']= "please fill the valid required fields of date for enrollment of students";						
							else
							{
							if(date("Y-m-d", strtotime($this->input->post('fromdatepicker')))  < date("Y-m-d", strtotime($this->input->post('todatepicker'))) ){
							$data_manage_x = array(
				  			'year' => date('Y'),
				  			'start_date' => date("Y-m-d", strtotime($this->input->post('fromdatepicker'))), 
				  			'to_date' => date("Y-m-d", strtotime($this->input->post('todatepicker'))),
				  			'extended'=> 'no',
				 			 'created_date' => date('Y-m-d H:i:s'), 
				  			'verification_id' => '3',
				  			'remarks' => '',
				  			);
							$uupd_id = $this->Publicmodel->update_enroll_date($data_manage_x);
				  			if($uupd_id)
							{
							
							$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO SO</h4>';	
							$data_log=array(
							'assi_id'=>$this->session->userdata('user_id'),
							'assi_action'=>"2",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->assi_log_attempt($data_log);
							$queryadmin['verification_id']= 3;
							}}else{
							 
							$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">START DATE SHOULD BE LESSER THAN END DATE</h4>';		
							}
							}
						}
						else//insert
						{
						if($this->session->flashdata('page_message')) $queryadmin['msg']=$this->session->flashdata('page_message');
						else $queryadmin['msg']='';
						$this->form_validation->set_error_delimiters('<span class="error_form_validation">', '</span>');			
						$this->form_validation->set_rules('fromdatepicker', 'Start date', 'required|callback_valid_enroll_date_f',array('required' => 'Please fill  %s','valid_enroll_date_f'=>'%s should be gretaer than or equal to current date '));
						$this->form_validation->set_rules('todatepicker', 'End date', 'required|callback_valid_enroll_date_t',array('required' => 'Please fill  %s','valid_enroll_date_t'=>'%s should be gretaer than or equal to current date'));
						if ($this->form_validation->run() === FALSE)						
						$queryadmin['msg']= "please fill the required fields of date for enrollment of students";						
						else
						{
						if(date("Y-m-d", strtotime($this->input->post('fromdatepicker')))  < date("Y-m-d", strtotime($this->input->post('todatepicker'))) )
						{
				 		$data_manage = array(
				  		'year' => date('Y'),
				  		'start_date' => date("Y-m-d", strtotime($this->input->post('fromdatepicker'))), 
				  		'to_date' => date("Y-m-d", strtotime($this->input->post('todatepicker'))),
				  		'extended'=> 'no',
				  		'created_date' => date('Y-m-d H:i:s'), 
				  		'verification_id' => '3',
				  		'remarks' => '',
				 		 );
				  		if($data_manage)
				  		{	
				  		$ins_id = $this->Publicmodel->ins_manage_enroll_date($data_manage);
						if($ins_id)
						{
						$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO SO</h4>'	;
						$data_log=array(
							'assi_id'=>$this->session->userdata('user_id'),
							'assi_action'=>"2",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
						$log_id = $this->Publicmodel->assi_log_attempt($data_log);
						$queryadmin['verification_id']= 3;
						}
						else
						{
						 
						$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">NOT FORWARDED TO SO</h4>';
						$queryadmin['verification_id']= 0;
						}
				  		}
						}
					else 
					$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">START DATE SHOULD BE LESSER THAN END DATE</h4>';
					}}
					}}
					elseif($queryadmin['user_type']=="so")
					{ 
					   if($this->input->post('acc_so'))
						{ 
						    $year = date('Y');$ver_id = '4';$remaks="";
							$upd_id = $this->Publicmodel->upd_manage_enroll_date($year,$ver_id,$remaks);
							 $queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">ACCEPTED BY UNIVERSITY</h4>';
							$data_log=array(
							'so_id'=>$this->session->userdata('user_id'),
							'so_action'=>"2",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->so_log_attempt($data_log);
						}
						elseif($this->input->post('rej_so'))
						{
						$this->form_validation->set_rules('remarktxt1', 'Rejection reason', 'required',array('required' => 'Please enter %s.'));
						if ($this->form_validation->run() === FALSE)						
							$queryadmin['msg']= "please enter the reason for rejection";													
						else
						{
						$year = date('Y');$ver_id = '3R';$remaks=$this->input->post('remarktxt1');
						$upd_id = $this->Publicmodel->upd_manage_enroll_date($year,$ver_id,$remaks);
						 
						$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY UNIVERSITY</h4>';
						$data_log=array(
							'so_id'=>$this->session->userdata('user_id'),
							'so_action'=>"9",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->so_log_attempt($data_log);
						}
						}
						elseif($this->input->post('extended'))
						{
							$upd_ex_date = $this->Publicmodel->upd_manage_enroll_date('yes','extend',date("Y-m-d", strtotime($this->input->post('todatepickerexten'))));
							if($upd_ex_date)
							{$queryadmin['msg']="Successfully extended";
						}
						}
					}
				$queryadmin['get_data_manage'] = $this->Publicmodel->get_data_manage_enroll(date('Y'));
				break;
				case 2://web
				if($queryadmin['user_type']=="assistant")
				{
				  if($this->input->post('content_but'))
				  {
					if($this->session->flashdata('page_message')) $queryadmin['msg']=$this->session->flashdata('page_message');
					else $queryadmin['msg']='';
					$this->form_validation->set_error_delimiters('<span class="error_form_validation">', '</span>');			
					$this->form_validation->set_rules('content_area', 'Content', 'required',array('required' => 'Please fill  %s'));
					if ($this->form_validation->run() === FALSE)						
					$queryadmin['msg']= "please fill the  required content";						
					else
					{
					if($queryadmin['web_data'])//update
					{
						$dates = $queryadmin['web_data']['created_date'];
						$data = array(
						'web_text'=> $this->input->post('content_area'),
						'updated_date'=>date('Y-m-d H:i:s'), 
						'verification_id'=>'3',
						);
						$upd_id = $this->Publicmodel->upd_web_content($data);
						if($upd_id)
						{$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO SO</h4>';
						$data_log=array(
							'assi_id'=>$this->session->userdata('user_id'),
							'assi_action'=>"3",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->assi_log_attempt($data_log);
						}
					}
					else//insert
					{
						$data = array(
						'web_text'=> $this->input->post('content_area'),
						'updated_date'=>'', 
						'verification_id'=>'3',
						'created_date'=>date('Y-m-d H:i:s'), 
						);
						$ins_id = $this->Publicmodel->ins_web_content($data);
						if($ins_id)
						{$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO SO</h4>';	
						$data_log=array(
							'assi_id'=>$this->session->userdata('user_id'),
							'assi_action'=>"3",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->assi_log_attempt($data_log);
						}
					   }
					  }
				    }
				}
				elseif($queryadmin['user_type']=="so")
				{
						if($this->input->post('web_acc_so'))
						{ 
						$data = array(
						'verification_id'=>'4',
						);
						$upd_id_web = $this->Publicmodel->upd_web_content($data);
						if($upd_id_web)
						{ 
						$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">ACCEPTED BY UNIVERSITY</h4>';
							$data_log=array(
							'so_id'=>$this->session->userdata('user_id'),
							'so_action'=>"3",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->so_log_attempt($data_log);
						}
						}elseif($this->input->post('web_rej_so')){
						$this->form_validation->set_rules('remarktxt2', 'Rejection reason', 'required',array('required' => 'Please enter %s.'));
						if ($this->form_validation->run() === FALSE)
						$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">PLEASE ENTER THE REASON FOR REJECTION</h4>';						
							 	
												
							else
						{
						$data = array(
						'verification_id'=>'3R',
						'remarks'=>$this->input->post('remarktxt2'),
						);
						$upd_id_web = $this->Publicmodel->upd_web_content($data);
						
						if($upd_id_web)
						{
							$data_log=array(
							'so_id'=>$this->session->userdata('user_id'),
							'so_action'=>"16",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->so_log_attempt($data_log);
						}
					}	
				   }				
				}
				$queryadmin['web_data'] = $this->Publicmodel->get_web_content();
				break;
				case 4://faq
				if($queryadmin['user_type']=="assistant")
				{
				  if(!empty($queryadmin['faq_data']))//update
				  {
					  $data_upd_faq=array(
					  'faq_ques'=>$this->input->post('faq_ques'),
					  'faq_ans'=>$this->input->post('faq_ans'),
					  'verification_id'=>'3',
					  );
					  $upd_faq = $this->Publicmodel->upd_faq($queryadmin['faq_data']['nss_faq_id'],$data_upd_faq);
					  if( $upd_faq)
					  { 
					  $queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">FORWARDED TO SO</h4>';	
					
					  $data_log=array(
							'assi_id'=>$this->session->userdata('user_id'),
							'assi_action'=>"4",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->assi_log_attempt($data_log);
					  }
				  }
				  else//insert
				  {
					  if($this->input->post('faq_fwd_so'))
					  {
						  if($this->session->flashdata('page_message')) $queryadmin['msg']=$this->session->flashdata('page_message');
							else $queryadmin['msg']='';
							$this->form_validation->set_error_delimiters('<span class="error_form_validation">', '</span>');			
							$this->form_validation->set_rules('faq_ques', 'Question', 'required',array('required' => 'Please fill required  %s'));
							$this->form_validation->set_rules('faq_ans', 'Answer', 'required',array('required' => 'Please fill required  %s'));
							if ($this->form_validation->run() === FALSE)						
							$queryadmin['msg']= "please fill the  required details";						
							else
							{
						    $data_faq = array(
						    'faq_ques'=> $this->input->post('faq_ques'),
						    'faq_ans'=>$this->input->post('faq_ans'),
						    'verification_id'=>'3',
						    'created_date'=>date('Y-m-d H:i:s'),
						    );
						   $ins_faq_id = $this->Publicmodel->ins_faq_data($data_faq); 
						   if($ins_faq_id)
						   {
						    $queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO SO</h4>';
						    $data_log=array(
							'assi_id'=>$this->session->userdata('user_id'),
							'assi_action'=>"4",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->assi_log_attempt($data_log);
						    }
						}
					  }
				   }
				}
				elseif($queryadmin['user_type']=="so")
				{
						if($this->input->post('faq_acc_so'))
						{ 
						  $faq_id=$queryadmin['faq_data']['nss_faq_id'];
						  $data=array(
						  'verification_id'=>'4'
						  );
						 $upd_id = $this->Publicmodel->upd_faq($faq_id,$data);
						 if( $upd_id)
						 {
							 $data_log=array(
							'so_id'=>$this->session->userdata('user_id'),
							'so_action'=>"4",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->so_log_attempt($data_log);
						 }
						}
						elseif($this->input->post('faq_rej_so')){
							$this->form_validation->set_rules('remarktxt4', 'Rejection reason', 'required',array('required' => 'Please enter %s.'));
						if ($this->form_validation->run() === FALSE)						
							 
							$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">PLEASE ENTER THE REASON FOR REJECTION</h4>';						
						else
						{
						  $faq_id=$queryadmin['faq_data']['nss_faq_id'];
						  $data=array(
						  'verification_id'=>'3R',						  
						  'remarks'=>$this->input->post('remarktxt4'),
						  );
						$upd_id = $this->Publicmodel->upd_faq($faq_id,$data);
						if($upd_id)
						{
						 
						$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY SO</h4>';	
						$data_log=array(
							'so_id'=>$this->session->userdata('user_id'),
							'so_action'=>"17",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->so_log_attempt($data_log);
						}
						}
						}
				}
				$queryadmin['faq_data'] = $this->Publicmodel->get_faq_data($verfaq_id);
				break;
			}
		}
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['listspan'] = $this->load->view('admin/admin_manage',$queryadmin,true);
		$queryadmin['adminspan3'] = $this->load->view('common_list_view',$queryadmin,true);	//template
		$this->load->view('common_template',$queryadmin);		
	}
	public function admin_v_enroll_list()
	{
		$queryadmin['msg']="";
		$queryadmin['main_menu']= 'enroll';
		$queryadmin['sub_menu']="";
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$ver_id= array('2','2R','3','3R','4');
		$queryadmin['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)
		{
		$queryadmin['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
		$college_name_sel = $this->input->post('name');
		if($college_name_sel)
		{
			$queryadmin['batch_list']=$this->Publicmodel->princi_batch_period($college_name_sel);
			if($queryadmin['batch_list']){
			$queryadmin['sel_batch'] = $this->input->post('batch');
			if($queryadmin['sel_batch'])
			{
			$queryadmin['unit_list']= $this->Publicmodel->get_unit_from_batch($college_name_sel,$queryadmin['sel_batch']);
			$queryadmin['sel_unit']=$this->input->post('unit');
			if(empty($queryadmin['unit_list'])){
				 
				$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">Unit is not created for the this College</h4>';	}
			elseif($queryadmin['sel_unit']){
				$data_enroll_stud_det = array(
				'nss_unit'=>$queryadmin['sel_unit'],
				'college_id'=>$college_name_sel,
				'ver_id'=>$ver_id,
				'batch_period'=>$queryadmin['sel_batch'],
				);
				$queryadmin['enroll_list']= $this->Publicmodel->get_enroll_stud_detail($data_enroll_stud_det);
				$queryadmin['count_stud'] = count($queryadmin['enroll_list']);
				if($this->input->post('fwdassi'))
			    {
				if($queryadmin['enroll_list'])
				{
					$enroll_stud_p_id = array_column($queryadmin['enroll_list'],'nss_stud_id');
					$ver_id_prin = '3';
					$data_fwd_so=array(
						'college_id'=>$college_name_sel,
						'batch_period'=>$queryadmin['sel_batch'],
						'nss_enroll_unit'=>$queryadmin['sel_unit'],
						'verification_id'=>'3',
						);
					$fwd = $this->Publicmodel->fwd_to_so($data_fwd_so,$enroll_stud_p_id );
					if($fwd)
					{
		 				 
						$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">FORWARDED SUCCESSFULLY TO SO </h4>';
						$data_log=array(
							'assi_id'=>$this->session->userdata('user_id'),
							'assi_action'=>"10",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
						$log_id = $this->Publicmodel->assi_log_attempt($data_log);
						$data_enroll_stud_det = array(
							'nss_unit'=>$queryadmin['sel_unit'],
							'college_id'=>$college_name_sel,
							'ver_id'=>$ver_id,
							'batch_period'=>$queryadmin['sel_batch'],
							);
						$queryadmin['enroll_list']= $this->Publicmodel->get_enroll_stud_detail($data_enroll_stud_det);
						$queryadmin['count_stud'] = count($queryadmin['enroll_list']);
					}
				}
			}
			elseif($this->input->post('rejassisubmit'))
			{
				$reson = $this->input->post('remarktxt1');
				$enroll_stud_p_id = array_column($queryadmin['enroll_list'],'nss_stud_id');
				$data_rej_assi=array(
				'college_id'=>$college_name_sel,
				'batch_period'=>$queryadmin['sel_batch'],
				'nss_enroll_unit'=>$queryadmin['sel_unit'],
				'verification_id'=>'2R',
				'remarks'=>$reson,
				);
				$upd_id_re = $this->Publicmodel->rej_assi($data_rej_assi,$enroll_stud_p_id);
				if($upd_id_re)
				{ 
				echo '<script>alert("Forwarded the rejection reason to SO");</script>';	
				$data_log=array(
							'assi_id'=>$this->session->userdata('user_id'),
							'assi_action'=>"11",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->assi_log_attempt($data_log);
				}
			}
			$queryadmin['enroll_list']= $this->Publicmodel->get_enroll_stud_detail($data_enroll_stud_det);
			$queryadmin['count_stud'] = count($queryadmin['enroll_list']);
			}
			}
		}else
		{
			$queryadmin['msg']="ENROLLMENT HAS NOT YET STARTED";
		}
		}
		}
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['adminspan3'] = $this->load->view('admin/admin_v_enroll_list',$queryadmin,true);	
		$this->load->view('common_template',$queryadmin);	
	}
	public function admin_v_m_attendance()
	{
		$queryadmin['msg']="";
		$queryadmin['main_menu']="atten";
		$queryadmin['sub_menu']="";
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$ver_id= array('2','2R','3','3R','4');
		$queryadmin['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)
		{
		$queryadmin['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
		$college_name_sel = $this->input->post('name');
		if($college_name_sel)
		{
			$queryadmin['batch_list']=$this->Publicmodel->princi_batch_period($college_name_sel);
			if($queryadmin['batch_list']){
			$queryadmin['sel_batch'] = $this->input->post('batch');
			if($queryadmin['sel_batch'])
			{
			$queryadmin['unit_list']= $this->Publicmodel->get_unit_from_batch($college_name_sel,$queryadmin['sel_batch']);
			$queryadmin['sel_unit']=$this->input->post('unit');
			if(empty($queryadmin['unit_list'])){
			 
				$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">UNIT IS NOT CREATED FOR  THIS COLLEGE </h4>';}
			elseif($queryadmin['sel_unit']){
				$queryadmin['sel'] = $this->input->post('get_data');
			if($this->input->post('get_data'))
			{
				if($queryadmin['sel'] == "Y" || $queryadmin['sel'] == "M")
				$queryadmin['year_db'] =$this->Publicmodel->get_mo_atten_year($college_name_sel,$queryadmin['sel_batch'],$queryadmin['sel_unit']);
				if($this->input->post())
				{
				$queryadmin['sel_year'] = $this->input->post('get_year') ;
				$queryadmin['sel_month']= $this->input->post('get_month');
				$queryadmin['sel_date']= $this->input->post('date');
				$detail_p= array(
				'college_id'=>$college_name_sel,
				'batch_period' =>$queryadmin['sel_batch'],
				'unit'=> $queryadmin['sel_unit'],
				'year'=> $this->input->post('get_year'),
				'month'=>$this->input->post('get_month'),
				'date'=>  date("Y-m-d", strtotime($this->input->post('date'))),
				);
				$queryadmin['month_view_data_assi'] = $this->Publicmodel->get_view_atten_fwd_prin($detail_p,"2");
				if($this->input->post('fwd_uni')&& !empty($queryadmin['month_view_data_assi']))
			    { 
			     $atten_id = array_column($queryadmin['month_view_data_assi'],'m_attendance_id');
			     $upd_fwd_p = $this->Publicmodel->fwd_prin_atten($atten_id,"3");
			   if($upd_fwd_p)
			  {
			    $queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO SO</h4>';
			  }
			}
			if($this->input->post('rejprincisubmit')&& !empty($queryadmin['month_view_data_assi']))
			{ 
				$atten_id = array_column($queryadmin['month_view_data_assi'],'m_attendance_id');
				$datarej=array(
					'ver_id'=>'2R',
					'remark'=>$this->input->post('remarktxt1'),
					);
				$upd_fwd_p = $this->Publicmodel->rej_prin_atten($atten_id,$datarej);
				if($upd_fwd_p)
				{
				 
				$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY ASSISTANT </h4>';
				}
			}
				$queryadmin['month_view_data_assi'] = $this->Publicmodel->get_view_atten_fwd_prin($detail_p,"2");
				$queryadmin['month_view_data_rej_assi'] = $this->Publicmodel->get_view_atten_fwd_prin($detail_p,"2R");
				$queryadmin['month_view_data_atten_fwduni'] = $this->Publicmodel->get_view_atten_fwd_prin($detail_p,"3");
				$queryadmin['month_view_data_atten_rejuni'] = $this->Publicmodel->get_view_atten_fwd_prin($detail_p,"3R");
				$queryadmin['month_view_data_atten_uni'] = $this->Publicmodel->get_view_atten_fwd_prin($detail_p,"4");
			}}
			}
			}
		}
		else
		{
			
			$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">MONTHLY ATTENDANCE HAS NOT YET GIVEN </h4>';
		}
		}
		}
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['adminspan3'] = $this->load->view('admin/admin_v_m_attendance',$queryadmin,true);	
		$this->load->view('common_template',$queryadmin);
	}
	public function fund_govt()
	{
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
	    $queryadmin['main_menu']="fund";
		$queryadmin['sub_menu']="fund_govt";
		if($this->input->post('sub_fund_gov'))
		{
			  $data_fund_gov=array(
			  'amount'=>$this->input->post('fund_gov'),
			  'account'=>$this->input->post('fund_acc'),
			  'year'=>date('Y'),
			  'created_date'=>date('Y-m-d H:i:s'),
			  'verification_id'=>"3",
			  'remarks'=>"",
			  'status'=>"active"
			  );
			  $ins = $this->Publicmodel->insert_fund_gov($data_fund_gov);
			  if($ins)
			  $queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO SO</h4>';
		}
		$queryadmin['fund_gov_data']=$this->Publicmodel->get_fund_gov();
		$queryadmin['fund_gov_data_yr']=$this->Publicmodel->get_fund_gov_year(date('Y'));
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['adminspan3'] = $this->load->view('admin/fund_govt',$queryadmin,true);	
		$this->load->view('common_template',$queryadmin);	
	}
	public function sanctioned_fund()
	{	$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['nss_college_type'] = $this->Publicmodel->get_college_type();
		$queryadmin['main_menu']="fund";
		$queryadmin['sub_menu']="sanct_fund";	
		$type = $this->input->post('type'); 
		if($type)		
			$queryadmin['college_name_sel'] = $this->Publicmodel->get_college_type_list($type);
		if($this->input->post('sanc_fund_submit'))
		{
			$unchk_list = $this->input->post('unchk');
			$unchk_list_array = explode("|",$unchk_list);
			$data_sanc = array(
			'sanc_amount'=> $this->input->post('amount_txt'),
			'colge_chk'=>$this->input->post('chk'),
			'colge_type'=>$type,
			);
			$chk_id =  $this->Publicmodel->chk_fund_sanc($data_sanc);
			if(!empty($chk_id))
			{//update section diff case
			$chked_status = array_column($chk_id, 'fund_status');
			//case 1 frm chked list if any is "inactive" then update batch is done
			if(in_array("inactive",$chked_status))
			{	
				$inactive_keys=array_keys($chked_status,"inactive");
				if($inactive_keys)
				{//update_batch
				$i = 0;
					foreach($inactive_keys as $val)
					{ 
						$data_fund_sanc_upd[$i] = array(
						'nss_fund_sanc_id' => $chk_id[$val]['nss_fund_sanc_id'],
						'amount_sanc' =>$this->input->post('amount_txt'), 
						'fund_status'=>'active',
						); $i++;
					}
					$fund_san_upd_id = $this->Publicmodel->update_fund_sanc_status($data_fund_sanc_upd);
					if($fund_san_upd_id)
					 $queryadmin['msg'] = 
					  '  <h4 style="color:#FF0000;font-weight:bold;">selected'.count($data_sanc['colge_chk']).' colleges has been saved from the current page</h4>';
					 //echo '<h4 style="color:#FF0000;font-weight:bold;">selected </h4>';
					 //. count($data_sanc['colge_chk']).' colleges has been saved from the current page</h4>';
				}
			}
			//case 2  from chked list, doesnot found in db then insertbatch is done
			if(count($data_sanc['colge_chk'])> count($chk_id))
			{
				$checkd_array = array_diff($data_sanc['colge_chk'],array_column($chk_id, 'fund_college_id'));
				if($checkd_array )
				{//batch_insertion
				$j =0; $data_ins = '';
				 for($i=0;$i<count($checkd_array);$i++)
				 {if($checkd_array && $checkd_array[$i])
				  {
					  $data_ins[$j] =  array(
									'fund_college_id'=> $checkd_array[$i],
									'fund_college_type'=>$type,
									'year'=>date('Y'),
									'amount_sanc'=>$data_sanc['sanc_amount'],
									'fund_status'=>'active',
									'created_date'=>date('Y-m-d H:i:s'),
								);
					$j++;
				  }
				 }
				  $ins_id_fund = $this->Publicmodel->insert_sanc_func($data_ins);
			    if($ins_id_fund)
				  $queryadmin['msg'] = 
					  '  <h4 style="color:#FF0000;font-weight:bold;">selected'.count($data_sanc['colge_chk']).' colleges has been saved from the current page</h4>';
				  // "selected ". count($data_sanc['colge_chk'])." colleges has been saved from the current page";
				}
			}
			//case 3 from uncheck list , found in db whose status is active then make it as inactive ( update batch is done)
			$data_chk_fund_sanc_active = array(
			'list'=>$unchk_list_array,
			'colge_type'=> $type,
			);
			$unchk_id =  $this->Publicmodel->chk_fund_sanc_active($data_chk_fund_sanc_active);
			if($unchk_id)
			{
				//update_batch
				$i = 0;
					foreach($unchk_id as $val)
					{ 
						$data_fund_sanc_upd_c[$i] = array(
						'nss_fund_sanc_id' => $val['nss_fund_sanc_id'],
						'fund_status'=>'inactive',
						); $i++;
					}
					$fund_san_upd_id_c = $this->Publicmodel->update_fund_sanc_status($data_fund_sanc_upd_c);
					if($fund_san_upd_id_c)
					  $queryadmin['msg'] = 
					  '  <h4 style="color:#FF0000;font-weight:bold;">selected'.count($data_sanc['colge_chk']).' colleges has been saved from the current page</h4>';
					 //$queryadmin['msg'] = "selected ". count($data_sanc['colge_chk'])." colleges has been saved from the current page";
			}
			}
			else
			{//batch_insertion
			 $j =0; $data_ins = '';
			  for($i=0;$i<count($data_sanc['colge_chk']);$i++)
			  {
				  if($data_sanc['colge_chk'] && $data_sanc['colge_chk'][$i])
				  {
					  $data_ins[$j] = array(
									'fund_college_id'=> $data_sanc['colge_chk'][$i],
									'fund_college_type'=>$type,
									'year'=>date('Y'),
									'amount_sanc'=>$data_sanc['sanc_amount'],
									'fund_status'=>'active',
									'created_date'=>date('Y-m-d H:i:s'),
								);
							$j++;
				  }
			  }
			  $ins_id_fund = $this->Publicmodel->insert_sanc_func($data_ins);
			  if($ins_id_fund)
				  $queryadmin['msg'] = 
					  '  <h4 style="color:#FF0000;font-weight:bold;">selected'.count($data_sanc['colge_chk']).' colleges has been saved from the current page</h4>';
				 // $queryadmin['msg'] = "selected ". count($data_sanc['colge_chk'])." colleges has been saved from the current page";
			}
		}
		$queryadmin['college_name_sel'] = $this->Publicmodel->get_college_type_list($type);
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['listspan'] = $this->load->view('admin/sanction_fund',$queryadmin,true);
		$queryadmin['adminspan3'] = $this->load->view('common_list_view',$queryadmin,true);	//template	
		$this->load->view('common_template',$queryadmin);//template
	}
	public function view_sanc_fund()
	{
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['main_menu']="fund";
		$queryadmin['sub_menu']="sanc_fund";
		$queryadmin['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$queryadmin['year_list'] = $this->Publicmodel->get_year_fund();
		$queryadmin['sel'] = array(
		'type'=>$this->input->post('type'),
		'year'=>$this->input->post('year'),
		);
		if(!empty($queryadmin['sel']))
		{
			$queryadmin['college_list'] = $this->Publicmodel->get_college_fund_sanc_list($queryadmin['sel']);
			//print_r($queryadmin['college_list']);exit;
			if($this->input->post('year') && $this->input->post('type') && empty($queryadmin['college_list']))  
			$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">NO  DATA FOUND </h4>';
			$nss_fund_sanc_id = $this->uri->segment(4);
			if(!empty($nss_fund_sanc_id ))
			{	
				$inactive_id = $this->Publicmodel->remove_fund_sanc_col($nss_fund_sanc_id);
				if($inactive_id)
				{
					$queryadmin['sel'] = array(
					'type'=>$this->uri->segment(6),
					'year'=>$this->uri->segment(5),
					);
				$queryadmin['college_list'] = $this->Publicmodel->get_college_fund_sanc_list($queryadmin['sel']);
				}
			}
		}
		if($this->input->post('sanc_fund_submit'))
		{
			$queryadmin['college_list'] = $this->Publicmodel->get_college_fund_sanc_list($queryadmin['sel']);
			$id_col = array_column($queryadmin['college_list'],'nss_fund_sanc_id');
			$data_fwd=array(
			'ver_id'=>'3',
			'remark'=>'',
			'ids'=>$id_col,
			);
			$up_fwd_so_sanc_fund = $this->Publicmodel->fwd_so_sanc_fund($data_fwd);
			if($up_fwd_so_sanc_fund)
			 
			$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESFULLY FORWARDED TO SO</h4>';
			$queryadmin['college_list'] = $this->Publicmodel->get_college_fund_sanc_list($queryadmin['sel']);
		}
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['listspan'] = $this->load->view('admin/view_sanction_fund',$queryadmin,true);
		$queryadmin['adminspan3'] = $this->load->view('common_list_view',$queryadmin,true);	//template	
		$this->load->view('common_template',$queryadmin);//template
	}
	public function view_fund()
	{	$queryadmin['msg']="";
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['main_menu']="fund";
		$queryadmin['sub_menu']="view_fund";
		$queryadmin['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)
		{
		$queryadmin['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
		$college_name_sel = $this->input->post('name');
		$queryadmin['college_id']=$college_name_sel;	
		if($college_name_sel)
		{
			$queryadmin['nss_fund_list']= $this->Publicmodel->get_fund_last5($college_name_sel);
		}
		}
		if($this->input->post('fwdassi')&&!empty($queryadmin['nss_fund_list']))
		{
			$upd_fwd_p = $this->Publicmodel->fwd_assi_fund($queryadmin['college_id'],"3");
			if($upd_fwd_p)
			{
			 
			$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO UNIVERSITY</h4>';
			}
		}
		if($this->input->post('rejprincisubmit')&& !empty($queryadmin['nss_fund_list']))
			{
			$datarej=array(
			'ver_id'=>'2R',
			'remark'=>$this->input->post('remarktxt1'),
			);
			$upd_fwd_p = $this->Publicmodel->rej_assi_fund($queryadmin['college_id'],$datarej);
			if($upd_fwd_p)
			{
			 
			$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY PRINCIPAL</h4>';
			}
			}
			if(isset($college_name_sel)){
		$queryadmin['nss_fund_list']= $this->Publicmodel->get_fund_last5($college_name_sel);
		}	
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['listspan'] = $this->load->view('admin/view_fund',$queryadmin,true);
		$queryadmin['adminspan3'] = $this->load->view('common_list_view',$queryadmin,true);	//template	
		$this->load->view('common_template',$queryadmin);//template
	}
	public function fund_print()
	{
		$queryadmin['msg']="";
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$b_year = $this->uri->segment(4);
		$b_colg = $this->uri->segment(5);
		$print = $b_year;
		if(isset($print))
		{
			$queryadmin['sel_yr'] = $print;
		}
		if($queryadmin['sel_yr'])
		{
			$queryadmin['fund_det'] = $this->Publicmodel->get_nss_fund($b_colg,$queryadmin['sel_yr']);
			$queryadmin['sanc_fund']= $this->Publicmodel->get_nss_fund_sanc($b_colg,date('Y'));
			$amount_spent = array_column($queryadmin['fund_det'], 'amount_spent');
			$queryadmin['amount_spent_sum'] = array_sum($amount_spent);
		    $queryadmin['bal'] = $queryadmin['sanc_fund']['amount_sanc'] - $queryadmin['amount_spent_sum'];
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
			$html = $this->load->view('po/fund_rep_print', $queryadmin, true);
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
	}
	public function monthly_report()
	{
		$queryadmin['msg']="";
		$queryadmin['main_menu']="month";
		$queryadmin['sub_menu']="";
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['view_type']=$this->input->post('view_type');
		if($queryadmin['view_type']=="ALL")
		{
			$queryadmin['get_yrs'] = $this->Publicmodel->get_yrs_monthly_report('');
			$queryadmin['year1'] = $this->input->post('year1');
		}elseif($queryadmin['view_type']=="COLGE")
		{
		$queryadmin['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)
		{
		$queryadmin['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
		$college_name_sel = $this->input->post('name');
		$queryadmin['sel_colge']=$college_name_sel;
		if($college_name_sel)
		{
			$queryadmin['batch_list']=$this->Publicmodel->princi_batch_period($college_name_sel);
			if($queryadmin['batch_list']){
			$queryadmin['sel_batch'] = $this->input->post('batch');
			if($queryadmin['sel_batch'])
			{
			$queryadmin['unit_list']= $this->Publicmodel->get_unit_from_batch($college_name_sel,$queryadmin['sel_batch']);
			$queryadmin['sel_unit']=$this->input->post('unit');
			if(empty($queryadmin['unit_list'])){
				 
				$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">UNIT IS NOT CREATED FOR  THIS COLLEGE</h4>';}
			elseif($queryadmin['sel_unit']){
				$queryadmin['get_yrs'] = $this->Publicmodel->get_yrs_monthly_report($college_name_sel);
			if($this->input->post('year'))
		   {
			 $queryadmin['year_sel'] = $this->input->post('year');
		   }
		//month selected
		if($this->input->post('month'))
		{
			if(empty($queryadmin['year_sel'] ))
			echo '<script>alert("SELECT YEAR");</script>';
			elseif(date('Y') == $this->input->post('year') && date('m')>=$this->input->post('month') )
			$flag_ok = '1';
			elseif(date('Y')!= $this->input->post('year'))
			$flag_ok = '1';
			else
			echo '<script>alert("SELECT MONTH LESS THAN CURRENT MONTH");</script>';
			if(isset($flag_ok))
			{
			 $queryadmin['month_sel_n']= $this->input->post('month');	
			 $queryadmin['month_sel']=date('F', mktime(0, 0, 0, $queryadmin['month_sel_n'], 10));
			 $data_fde = array(
				'college_id' => $college_name_sel,
				'nss_unit' => $queryadmin['sel_unit'],
				'batch_period' => $queryadmin['sel_batch'],
				'year' => $this->input->post('year'),
				'month' => $this->input->post('month'),
				);
			 $queryadmin['monthly_report_data'] = $this->Publicmodel->get_mothly_report($data_fde);
			}
			}
			if($this->input->post('fwdtoassi')&& isset($queryadmin['monthly_report_data'])&& !empty($queryadmin['monthly_report_data']))
			{
				$data_m_r = array(
				'college_id'=>$college_name_sel,
				'batch_period'=>$queryadmin['sel_batch'],
				'nss_unit'=>$queryadmin['sel_unit'],
				'month'=>$this->input->post('month'),
				'year'=> $this->input->post('year'),
				'verification_id'=>"3",
				);
				$up_mr=$this->Publicmodel->fwd_ass_mon_rep($data_m_r );
				if($up_mr)
				{ 
				$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">ACCEPTED BY SO</h4>';}
			}
			if($this->input->post('rejprincisubmit')&& isset($queryadmin['monthly_report_data'])&& !empty($queryadmin['monthly_report_data']))
			{
			$data_m_r = array(
				'college_id'=>$queryadmin['college_id'],
				'batch_period'=>$queryadmin['sel_batch'],
				'nss_unit'=>$queryadmin['sel_unit'],
				'month'=>$this->input->post('month'),
				'year'=> $this->input->post('year'),
				'verification_id'=>"2R",
				'remark'=>$this->input->post('remarktxt1'),
				);
				$up_mr=$this->Publicmodel->rej_ass_mon_rep($data_m_r );
				if($up_mr)
				{ 
				$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY SO</h4>';}
			}
			if(isset($data_fde))
						 $queryadmin['monthly_report_data'] = $this->Publicmodel->get_mothly_report($data_fde);
			}
			}
		}
		else
		{
		 
			$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">MONTHLY REPORT HAS NOT YET DONE</h4>';
		}
		}
		}
		}
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['listspan'] = $this->load->view('admin/monthly_report',$queryadmin,true);
		$queryadmin['adminspan3'] = $this->load->view('common_list_view',$queryadmin,true);	//template	
		$this->load->view('common_template',$queryadmin);
	}
	public function monthly_report_view_all()
	{
		$queryadmin['year'] = $this->uri->segment(4);
		$queryadmin['data_m_r'] = $this->Publicmodel->get_monthly_report_all($queryadmin['year']);
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
			$html = $this->load->view('Admin/monthly_report_view_all', $queryadmin, true);
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->SetFont('dejavusans', '', 10);
	 		ob_end_clean();
			$pdf->Output('monthly report.pdf', 'I');
	}
	public function monthly_report_view()
	{
		$url_string = $this->uri->segment(4);
		$url_decode = rawurldecode($url_string);
		$data_m_view= explode("|",$url_decode);
		if(count($data_m_view)=='4')//yrly
		{
			$queryadmin['yr_sel'] = $data_m_view[0];
			$queryadmin['college_id'] = $data_m_view[1];
			$queryadmin['batch_period'] = $data_m_view[2];
			$queryadmin['unit'] = $data_m_view[3];
		}
		elseif(count($data_m_view)=='5')//monthly
		{
			$queryadmin['yr_sel'] = $data_m_view[0];
			$month = $data_m_view[1];
			$queryadmin['college_id'] = $data_m_view[2];
			$queryadmin['batch_period'] = $data_m_view[3];
			$queryadmin['unit'] = $data_m_view[4];
		}
		if(!empty($month))
		{
		if($month)
		 $queryadmin['month_sel']=date('F', mktime(0, 0, 0, $month, 10));
		 $data = array(
				'college_id' => $queryadmin['college_id'],
				'nss_unit' => $queryadmin['unit'],
				'batch_period' => $queryadmin['batch_period'],
				'year' => $queryadmin['yr_sel'],
				'month' => $month,
				);
		 $queryadmin['monthly_rep_data'] = $this->Publicmodel->get_mothly_report($data);
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
			$html = $this->load->view('po/monthly_report_view', $queryadmin, true);
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->SetFont('dejavusans', '', 10);
	 		ob_end_clean();
			$pdf->Output('monthly report.pdf', 'I');
		}
		else
		{
			$data = array(
				'college_id' => $queryadmin['college_id'],
				'nss_unit' => $queryadmin['unit'],
				'batch_period' => $queryadmin['batch_period'],
				'year' => $queryadmin['yr_sel'],
				);
		$queryadmin['yr_rep_data'] = $this->Publicmodel->get_mothly_report($data);
		$queryadmin['months_in_array'] = array_unique(array_column($queryadmin['yr_rep_data'], 'month'));
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
			$html = $this->load->view('po/yrly_report_view', $queryadmin, true);
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->SetAlpha(1);
			$pdf->SetFont('dejavusans', '', 10);
	 		ob_end_clean();
			$pdf->Output('Yearly report.pdf', 'I');
			}
	}
	public function admin_audit_report()
	{
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['main_menu']="audit";
		$queryadmin['sub_menu']="";
		$queryadmin['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)		
			{
				$queryadmin['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
				$college_name_sel = $this->input->post('name');// echo $college_name_sel;exit;
				$queryadmin['college_id_sel']= $college_name_sel;
				
			}
		$queryadmin['year'] = $this->input->post('year');
		if($queryadmin['year'])
			{	
			$data_get_audit_year=array(
			'college_id'=>$college_name_sel,
			'year'=>$queryadmin['year'],
			);
		$queryadmin['audit_det']=$this->Publicmodel->get_audit_year($data_get_audit_year);
		if(empty($queryadmin['audit_det']))
		{
		 
		$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">AUDIT REPORT NOT YET GIVEN</h4>';
		}
		if($this->input->post('rejassiisubmit'))
		{
			$data_audit_admin=array(
			'remark'=>$this->input->post('remarktxt1'),
			'id'=>array_column($queryadmin['audit_det'],'nss_audit_id'),
			'ver_id'=>'3',
			'year'=>$queryadmin['year'],
			);
			$upd= $this->Publicmodel->audit_admin($data_audit_admin);
			if($upd)
			 
			$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY ASSISTANT</h4>';
			
		}
		elseif($this->input->post('fwdso'))
		{
			$data_audit_admin=array(
			'remark'=>'',
			'id'=>array_column($queryadmin['audit_det'],'nss_audit_id'),
			'ver_id'=>'3',
			'year'=>$queryadmin['year'],
			);
			$upd = $this->Publicmodel->audit_admin($data_audit_admin);
			if($upd)
			$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO SO</h4>';
		}
		$queryadmin['audit_det']=$this->Publicmodel->get_audit_year($data_get_audit_year);	
		}
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['listspan'] = $this->load->view('admin/admin_audit_report',$queryadmin,true);	
		$queryadmin['adminspan3'] = $this->load->view('common_list_view',$queryadmin,true);	//template
		$this->load->view('common_template',$queryadmin);
	}
	public function camp()
	{
		$queryadmin['msg']="";
		$queryadmin['main_menu']="camp";
		$queryadmin['sub_menu']="";
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$ver_id= array('2','2R','3','3R','4');
		$queryadmin['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)
		{
		$queryadmin['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
		$college_name_sel = $this->input->post('name');
		if($college_name_sel)
		{
			$queryadmin['batch_list']=$this->Publicmodel->princi_batch_period($college_name_sel);
			if(empty($queryadmin['batch_list']))			 
			$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">CAMP DETAILS HAVE NOT YET GIVEN</h4>';
			$queryadmin['sel_batch'] = $this->input->post('batch');
			if($queryadmin['sel_batch'])
			{
			$queryadmin['unit_list']= $this->Publicmodel->get_unit_from_batch($college_name_sel,$queryadmin['sel_batch']);
			$queryadmin['sel_unit']=$this->input->post('unit');
			
			if(empty($queryadmin['unit_list'])){
						 
						$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">UNIT IS NOT CREATED FOR THE THIS COLLEGE</h4>';}
					elseif($queryadmin['sel_unit']){
						if($this->input->post()){
			$ver_id=array("2","3","3R","4");
			$queryadmin['detail']= array(
			'college_id'=>$college_name_sel,
			'batch_period' =>$queryadmin['sel_batch'],
			'unit'=> $queryadmin['sel_unit'],	
			'sel_camp_type'=>$this->input->post('get_camp'),
			'veri_id'=>$ver_id,
			);
			$queryadmin['camp_detail'] = $this->Publicmodel->get_camp_date($queryadmin['detail']);
			if(isset($queryadmin['camp_detail'][0]['nss_camp_type']))
			$queryadmin['sub'] = 1;// show the table if value exist
			if($this->input->post('fwdtoassi')&& !empty($queryadmin['camp_detail']))
			{ 
			$id = $queryadmin['camp_detail'][0]['nss_camp_id'];
			$upd_fwd_p = $this->Publicmodel->fwd_prin_camp($id,"3");
			if($upd_fwd_p)
			{
			$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO SO</h4>';
			}
			}
			if($this->input->post('rejprincisubmit')&& !empty($queryadmin['camp_detail']))
			{ 
			$atten_id = $queryadmin['camp_detail'][0]['nss_camp_id'];
			$datarej=array(
			'ver_id'=>'2R',
			'remark'=>$this->input->post('remarktxt1'),
			);
			$upd_fwd_p = $this->Publicmodel->rej_prin_atten($atten_id,$datarej);
			if($upd_fwd_p)
			{
			 
			$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY ASSISTANT</h4>';
			}
			}
			$queryadmin['camp_detail'] = $this->Publicmodel->get_camp_date($queryadmin['detail']);
			}
			}}}}
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['adminspan3'] = $this->load->view('admin/camp',$queryadmin,true);	
		$this->load->view('common_template',$queryadmin);
	}
	public function eligibile_report()
	{
		$queryadmin['msg']="";
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['main_menu']="elig";
		$queryadmin['sub_menu']="";
		$queryadmin['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)
		{
		$queryadmin['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
		$college_name_sel = $this->input->post('name');
		if($college_name_sel)
		{
			$queryadmin['batch_list']=$this->Publicmodel->princi_batch_period($college_name_sel);
			if(empty($queryadmin['batch_list']))			 
			$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">ELIGIBLITY REPORT NOT YET GIVEN</h4>';
			$queryadmin['sel_batch'] = $this->input->post('batch');
			if($queryadmin['sel_batch'])
			{
			$queryadmin['unit_list']= $this->Publicmodel->get_unit_from_batch($college_name_sel,$queryadmin['sel_batch']);
			$queryadmin['sel_unit']=$this->input->post('unit');
			
			if(empty($queryadmin['unit_list'])){
				 
				$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">UNIT IS NOT CREATED FOR THE THIS COLLEGE</h4>';}
			elseif($queryadmin['sel_unit']){
			if($this->input->post('fwdassi'))
			{
				$data_eli_upd = array(
				'college_id'=>$college_name_sel,
				'batch_period'=>$queryadmin['sel_batch'],
				'nss_unit'=>$queryadmin['sel_unit'],
				'verification_id'=>'2',
				'chg_ver_id'=>'3',
				'remarks'=> '',
				);
				$upd_eli = $this->Publicmodel->fwd_prin_eli($data_eli_upd);
				if($upd_eli)
				$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">FORWARDED TO SO..</h4>';
			}
			elseif($this->input->post('rejassisubmit'))
			{
				$data_eli_upd = array(
							'college_id'=>$college_name_sel,
							'batch_period'=>$queryadmin['sel_batch'],
							'nss_unit'=>$queryadmin['sel_unit'],
							'verification_id'=>'2',
							'chg_ver_id'=>'2R',
							'remarks'=> $this->input->post('remarktxt1'),
							);
				$upd_eli = $this->Publicmodel->fwd_prin_eli($data_eli_upd);
				if($upd_eli) 
				$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY ASSISTANT</h4>';
				}
				}
				$ver_id = array("2","2R","3","4","3R");
				$queryadmin['eli_det'] = $this->Publicmodel->chk_elig_rep($college_name_sel,$queryadmin['sel_batch'],$queryadmin['sel_unit'],$ver_id);
			}
		}
		}
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['adminspan3'] = $this->load->view('admin/eligibile_report',$queryadmin,true);	
		$this->load->view('common_template',$queryadmin);
	}
	public function certi()
	{
		$queryadmin['msg']="";
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['main_menu']="certi";
		$queryadmin['sub_menu']="";
		$queryadmin['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)
		{
		$queryadmin['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
		$college_name_sel = $this->input->post('name');
		if($college_name_sel)
		{
			$queryadmin['batch_list']=$this->Publicmodel->princi_batch_period($college_name_sel);
			if(empty($queryadmin['batch_list']))  $queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">ELIGIBILTY REPORT IS NOT DEVELOPED</h4>';
			$queryadmin['sel_batch'] = $this->input->post('batch');
			if($queryadmin['sel_batch'])
			{
			$queryadmin['unit_list']= $this->Publicmodel->get_unit_from_batch($college_name_sel,$queryadmin['sel_batch']);
			$queryadmin['sel_unit']=$this->input->post('unit');
			
			if(empty($queryadmin['unit_list'])){
			  
			   $queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">UNIT IS NOT CREATED FOR THE THIS COLLEGE</h4>';}
			elseif($queryadmin['sel_unit']){
			if($this->input->post('certi_type'))
		    {		
			$queryadmin['certi_type'] = $this->input->post('certi_type');
			if($queryadmin['certi_type']=='V')
			{
				$queryadmin['eli_dat'] = $this->Publicmodel->elig_rep($college_name_sel,$queryadmin['sel_batch'],$queryadmin['sel_unit']);
			}
		   }
		  }
		 }
		}
		}
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['adminspan3'] = $this->load->view('admin/certi',$queryadmin,true);	
		$this->load->view('common_template',$queryadmin);
	}
	public function front_image()
	{
	    $queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['images'] =$this->Publicmodel->get_upload_activity("");
		if($this->input->post('sub_f_img'))
		{ 
			$chk_img = $this->input->post('chk');
			$img_upd = $this->Publicmodel->update_nss_front_photo($chk_img);
			$img_upd_not = $this->Publicmodel->update_nss_front_photo_not($chk_img);
			if($img_upd || $img_upd_not )
			{ 
			$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY DISPLAYED</h4>';
			$data_log=array(
							'assi_id'=>$this->session->userdata('user_id'),
							'assi_action'=>"6",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->assi_log_attempt($data_log);
			}
		}
		if($this->input->post('fwdso'))
		{
			$imag =$this->Publicmodel->get_upload_activity("");
			$id = count($imag) + 1;
			//upload section
			$path_website   = './upload/website/frontimage';
			if (!is_dir($path_website)) 
			{ //create the folder if it's not  exists
				mkdir($path_website, 0777, TRUE);}
				 $this->load->library('upload');
				  $number_of_files_uploaded = count($_FILES['txt4']['name']);
				   for ($i = 0; $i < $number_of_files_uploaded; $i++) :
				  			 $id++;
				   			$_FILES['userfile']['name']     = $_FILES['txt4']['name'][$i];
      						$_FILES['userfile']['type']     = $_FILES['txt4']['type'][$i];
      						$_FILES['userfile']['tmp_name'] = $_FILES['txt4']['tmp_name'][$i];
      						$_FILES['userfile']['error']    = $_FILES['txt4']['error'][$i];
     						$_FILES['userfile']['size']     = $_FILES['txt4']['size'][$i];
							$config = array(
        					'file_name'     => ($id),
        					'allowed_types' => 'jpg',
                			'max_size'      => 200,
                			'min_width'     => 700,
                			'min_height'    => 300,
							'max_width'     => 700,
							'max_height'    => 300,
							'overwrite'     => true,
							'upload_path'   => $path_website,
      						);
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload()) :
       						 $error = $this->upload->display_errors();
        					 $queryadmin['msg']=$error;
      						else :
       						 $final_files_data[] = $this->upload->data();
							 $data_f_image[$i] = array(
							 'photo_full_path'=>$path_website.'/'.$id.'.'.pathinfo($_FILES['txt4']['name'][$i], PATHINFO_EXTENSION),
							 'photo'=>$id.'.'.pathinfo($_FILES['txt4']['name'][$i], PATHINFO_EXTENSION),
							 'college_id'=>'mgu',
							 'checked'=>'1',
							 'created_date'=>date('Y-m-d H:i:s'),
							 'verification_id'=>'4',
							 );
							endif;
    						endfor;
							if(isset($data_f_image))
							{//print_r($data_f_image);exit;
							 $ins_id = $this->Publicmodel->insert_front_image($data_f_image);
							// print_r($ins_id);exit;
							$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO SO</h4>';
							$data_log=array(
							'assi_id'=>$this->session->userdata('user_id'),
							'assi_action'=>"5",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->assi_log_attempt($data_log);
							 redirect('/Admin/NssAdmin/front_image');
							}
		}
		$queryadmin['images'] =$this->Publicmodel->get_upload_activity("");
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['adminspan3'] = $this->load->view('admin/front_image',$queryadmin,true);		
		$this->load->view('common_template',$queryadmin);//template
	}
		public function notice()
	{  
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		if($this->input->post('submit_notice'))
		{
			$file_name = str_replace(' ','', $this->input->post('notice_id'));// dont remove the space between single codes
			$data_notice = array(
			'notice_no'=> $this->input->post('notice_id'),
			'heading'=>$this->input->post('head_content'),
			'upload'=>$_FILES['manual']['name'],
			'path'=>$file_name,
			'display'=>'Y',
			'verification_id'=>'3',
			'created_date'=>date('Y-m-d H:i:s'),
			'year'=>date('Y'),
			);
			if($this->session->flashdata('page_message')) $queryadmin['msg']=$this->session->flashdata('page_message');
			else $queryadmin['msg']='';
			$this->form_validation->set_error_delimiters('<span class="error_form_validation">', '</span>');
			$this->form_validation->set_rules('notice_id', 'Notice No:', 'required|regex_match[/^[^\\/:\*\?"<>\|]+$/]',array('required' => 'Please provide %s.','regex_match'=>'Invalid Notice No:.'));
			$this->form_validation->set_rules('head_content', 'Heading', 'required',array('required' => 'Please enter %s.'));
			if ($this->form_validation->run() === FALSE)						
			$queryadmin['msg']= "please fill the valid required fields ";						
			else{
				$pr_notice_id = $this->Publicmodel->get_notice_id($file_name);
			if(empty($pr_notice_id))
			{
			//upload notice section
			$path   = './upload/website/notice/';
			 if (!is_dir($path)) 
		      mkdir($path, 0777, TRUE);//create the folder if it's not  exists
		  	 $config = array(
                    'allowed_types' =>"pdf|PDF",
					'overwrite'     => TRUE,
                    'upload_path' => $path,
                    'max_size' => '50000',                    
                    'file_name' => $file_name,
                    'max_height' => "50000",
                    'max_width' => "50000",
                );
			 $this->load->library('upload');
		     $this->upload->initialize($config);
		  if($this->upload->do_upload('manual'))
		  {
			  $notice_id = $this->Publicmodel->insert_notice($data_notice);
			  if($notice_id){
			   
			  $queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESS</h4>';
			  $data_log=array(
							'assi_id'=>$this->session->userdata('user_id'),
							'assi_action'=>"7",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->assi_log_attempt($data_log);
			  }
			  }
		  else{
			$err = $this->upload->display_errors();
			$queryadmin['msg']=$err;}
			}
		else
			{
			 
			 $queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">NOTICE NO: ALREADY EXIST</h4>';
			}
		}
		}
		if($this->input->post('update_chek'))
		{
			$array_chkbox =  $this->input->post('chk'); 	
			//update
			$upd_id = $this->Publicmodel->update_notice($array_chkbox);
			if($upd_id)
			 {
			$queryadmin['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY UPDATED</h4>';
			$data_log=array(
							'assi_id'=>$this->session->userdata('user_id'),
							'assi_action'=>"8",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->assi_log_attempt($data_log);
			}
		}
		$data='';
		$queryadmin['notification_data']=$this->Publicmodel->get_notice($data);
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['listspan'] = $this->load->view('admin/notice',$queryadmin,true);
		$queryadmin['adminspan3'] = $this->load->view('common_list_view',$queryadmin,true);	//template	
		$this->load->view('common_template',$queryadmin);//template
	}
	public function lists()
	{
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['listspan'] = $this->load->view('admin/lists',$queryadmin,true);
		$queryadmin['adminspan3'] = $this->load->view('common_list_view',$queryadmin,true);	//template	
		$this->load->view('common_template',$queryadmin);//template
	}
	public function image()
	{
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['listspan'] = $this->load->view('admin/image',$queryadmin,true);
		$queryadmin['adminspan3'] = $this->load->view('common_list_view',$queryadmin,true);	//template	
		$this->load->view('common_template',$queryadmin);//template
	}
	public function logout()
	{	
	if($this->session->userdata('utype')=="po")
		{
		$data_log_po=array(
		'po_id'=>$this->session->userdata('user_id'),
		'po_action'=>"5",
		'done_ip'=>$_SERVER['REMOTE_ADDR'],
		'done_on'=>date('Y-m-d H:i:s'),
		);
		$log_id = $this->Publicmodel->po_log_attempt($data_log_po);
		}
		elseif($this->session->userdata('utype')=="assistant")
		{
		$data_log_assi=array(
		'assi_id'=>$this->session->userdata('user_id'),
		'assi_action'=>"14",
		'done_ip'=>$_SERVER['REMOTE_ADDR'],
		'done_on'=>date('Y-m-d H:i:s'),
		);
		$log_id = $this->Publicmodel->assi_log_attempt($data_log_assi);
		}
		elseif($this->session->userdata('utype')=="principal")
		{
		$data_log_prin=array(
		'princi_id'=>$this->session->userdata('user_id'),
		'princi_action'=>"10",
		'done_ip'=>$_SERVER['REMOTE_ADDR'],
		'done_on'=>date('Y-m-d H:i:s'),
		);
		$log_id = $this->Publicmodel->princi_log_attempt($data_log_prin);
		}
		elseif($this->session->userdata('utype')=="so")
		{
		$data_log_so=array(
		'so_id'=>$this->session->userdata('user_id'),
		'so_action'=>"15",
		'done_ip'=>$_SERVER['REMOTE_ADDR'],
		'done_on'=>date('Y-m-d H:i:s'),
		);
		$log_id = $this->Publicmodel->so_log_attempt($data_log_so);
		}
		$this->session->unset_userdata("collid");
		$this->session->unset_userdata("utype");
		$this->session->unset_userdata("reconluser");
		redirect(base_url().'Nsscontrol');
	} 
	function valid_doj($post_string)
		{
		$dateenter = date("d-m-Y", strtotime($post_string));
		if(!preg_match("/(^(((0[1-9]|1[0-9]|2[0-8])[-](0[1-9]|1[012]))|((29|30|31)[-](0[13578]|1[02]))|((29|30)[-](0[4,6,9]|11)))[-](19|[2-9][0-9])\d\d$)|(^29[-]02[-](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/", $dateenter))
		{			
			return false;
		}
		else
		{
			$currdate = date("d-m-Y");
			$datetime1 = new DateTime($dateenter);
			$datetime2 = new DateTime();
			$interval = $datetime1->diff($datetime2);
			$diff=$interval->format('%R%y');
			if($diff < 0 | ($dateenter == '01-01-1970') )
			{
			return false;
			}
			else
			{
			 return true;
			}
		  }
		}
		
		function valid_enroll_date_f($from_date)
		{ //echo"sds";exit;
		$f_date = date("Y-m-d", strtotime($from_date));
		if(!preg_match("/(^(((0[1-9]|1[0-9]|2[0-8])[-](0[1-9]|1[012]))|((29|30|31)[-](0[13578]|1[02]))|((29|30)[-](0[4,6,9]|11)))[-](19|[2-9][0-9])\d\d$)|(^29[-]02[-](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/", $from_date))
		{ 	echo"1";exit;return false; }
		elseif($f_date < date("Y-m-d"))
		{ 	// echo $from_date; echo date("Y-m-d");exit;
		return false;		}
		else{	 return true;}
		
		}
		
		function valid_enroll_date_t($to_date)
		{ //echo "s";exit;
		$t_date = date("Y-m-d", strtotime($to_date));
		if(!preg_match("/(^(((0[1-9]|1[0-9]|2[0-8])[-](0[1-9]|1[012]))|((29|30|31)[-](0[13578]|1[02]))|((29|30)[-](0[4,6,9]|11)))[-](19|[2-9][0-9])\d\d$)|(^29[-]02[-](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/", $to_date))
		{ 	return false; }
		elseif($to_date > date("Y-m-d"))
		{ 	return false;		}
		else{	 return true;}
		
		}
		
		function valid_enroll_date($post_string)
		{$dateenter = date("d-m-Y", strtotime($post_string));
		if(!preg_match("/(^(((0[1-9]|1[0-9]|2[0-8])[-](0[1-9]|1[012]))|((29|30|31)[-](0[13578]|1[02]))|((29|30)[-](0[4,6,9]|11)))[-](19|[2-9][0-9])\d\d$)|(^29[-]02[-](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/", $dateenter))
		{ 	return false; }
		else
		{
			$currdate = date("d-m-Y");
			$datetime1 = new DateTime($dateenter);
			$datetime2 = new DateTime(); 
			$interval = $datetime1->diff($datetime2);
			$diff=$interval->format('%R%y');
			$diff_day=$interval->format('%R%d');
			if ($diff_day <= 0)
			{
			if($diff = -0 | ($dateenter == '01-01-1970') )// from date should be of current year	
			return false;		
			else			
			 return true;
			}
			else
			return false;
		}
		}
		
		public function sendaccountdetailsemail($ins='')
	{
		$this->load->library('email');
		if($ins){
			$this->load->model('Publicmodel');
			$acnt_dtls	= $this->Publicmodel->getlogin_login_id($ins);
			
			$message="<h4>Dear ".$acnt_dtls['name'].",</h4><h4>Welcome to Mahatma Gandhi University Online National Service Scheme Portal.</h4>";
						$message=$message."<table border='1' cellspacing='0' cellpadding='10'><tr bgcolor='#099' color='white'><td align='center'><b>Your Login credentials are,</b></td></tr><tr><td>";
						$message=$message."<table cellspacing='10' cellpadding='0'>
									<tr><th align='left'>User Id</th><td>:</td><td>".$acnt_dtls['username']."</td></tr>
									<tr><th align='left'>Password</th><td>:</td><td>".$acnt_dtls['password']."</td></tr>
									<tr><th align='left'>Website</th><td>:</td><td>".base_url('Nsscontrol/index')."</td></tr>
									</table></td></tr></table>";
									
		$this->email->initialize($this->config->config['mailserv']);
		$this->email->from($this->config->config['mailserv']['smtp_user'], 'MGU NSS');
		//$list = array($acnt_dtls['username']);echo'aa';echo($acnt_dtls['username']);exit;
		$this->email->to($acnt_dtls['username']);
		$this->email->reply_to($this->config->config['mailserv']['smtp_user'], 'MGU NSS');
		$this->email->subject('User credentials for MGU NSS PORTAL');
		$this->email->message($message);
		//echo $this->email->print_debugger();
		//print_r($this->email->send());exit;
		if ($this->email->send())
		{	
		 $data_prin_log=array(
					'username'=>$acnt_dtls['username'],
					'status'=>"success",
					);
					$data_princi_log_id = $this->Publicmodel->mail_track($data_prin_log);
			return true;
		}
		else
		{//print_r($acnt_dtls);exit;
			  $data_prin_log=array(
					'username'=>$acnt_dtls['username'],
					'status'=>"fail",
					);
					//print_r($data_prin_log);exit;
					$data_princi_log_id = $this->Publicmodel->mail_track($data_prin_log);
			return false;
		}
		}

		
	}
}
