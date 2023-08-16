<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NssPrinci extends CI_Controller 
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
		$utype	= $this->session->userdata('utype');
		$HTTP_REF = isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:null;
		if(empty($login_id) || empty($utype) ) 
		redirect('/Nsscontrol');	
		else if(empty($HTTP_REF)) redirect('/Nsscontrol');
		$login_detail = $this->Publicmodel->getlogin_login_id($login_id);
		$prin_login_details = $this->Publicmodel->get_prin_login_details($login_detail['college_id']);
		$this->session->college_id = $login_detail['college_id'];
		$this->session->user_id = $login_detail['user_id'];
		$this->session->login_id = $login_detail['login_id'];
		$this->session->name = $login_detail['name'];
		$this->session->college_name = $prin_login_details['college_name'];
		$this->session->user_type = $login_detail['user_type'];
		$this->session->unit_list = $prin_login_details['nss_unit_id'];
		$this->session->batch_period = $prin_login_details['batch_period'];
    }
	public function index()
	{
		$upd_id="";   
		$queryprinci['main_menu']="home";
		$queryprinci['sub_menu']="";      
		$queryprinci['college_id'] = $this->session->userdata('college_id');
		$queryprinci['user_id'] = $this->session->userdata('user_id');
		$queryprinci['name'] = $this->session->userdata('name');
		$queryprinci['log_id'] = $this->session->userdata('login_id');
		$queryprinci['college_name'] = $this->session->userdata('college_name');
		$queryprinci['user_type'] = $this->session->userdata('user_type');
		$queryprinci['unit_list'] = $this->session->userdata('unit_list');
		$login_detail = $this->Publicmodel->getlogin_login_id($queryprinci['log_id']);
		if($login_detail['first_login']!="N")
		{
			if($this->input->post('sub'))
			{ 
			if(date("Y-m-d", strtotime($this->input->post('fdate')))!="1970-01-01") $f_date = date("Y-m-d", strtotime($this->input->post('fdate')));else $f_date = "";
				$queryprinci['data_prin'] = array(
				'college_id'=>$queryprinci['college_id'],
				'principal_name'=>$this->input->post('name'),
				'principal_email'=>$this->input->post('email'),
				'principal_contact'=>$this->input->post('contact'),
				'principal_address'=>$this->input->post('address'),
				'principal_pincode'=>$this->input->post('pin'),
				'principal_gender'=>$this->input->post('gen'),
				'from_date'=>$f_date,
				'to_date'=>'',
				);
				if($this->session->flashdata('page_message')) $queryprinci['msg']=$this->session->flashdata('page_message');
				else $queryprinci['msg']='';
				$this->form_validation->set_rules('name', 'Name ', 'required|regex_match[/^[a-zA-Z. ]*$/]',array('required' => 'Please provide %s.','regex_match'=>'Invalid Name.'));
			    $this->form_validation->set_rules('address', 'Address', 'trim|required',array('required' => 'Please provide a valid %s.'	));
			$this->form_validation->set_rules('pin', 'Pincode	', 'required|exact_length[6]|numeric',array('required' => 'Please enter %s.','min_length'=>'%s length should be 6'));
			$this->form_validation->set_rules('contact', 'Phone Number', 'required|min_length[10]|max_length[11]|regex_match[/[0-9]$/]',array('required' =>'Please enter %s','regex_match'=>'Please provide a valid %s.'));
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[nss_principal.principal_email]',array('required' => 'Please provide a valid %s.','is_unique'=>'This %s is already registered'));
			$this->form_validation->set_rules('fdate', 'From Date', 'trim|required|callback_valid_date',array('required' => 'Please provide a valid %s.','valid_date'=>'Invalid %s'));
			if ($this->form_validation->run() === FALSE)	
			{					
				
			$queryprinci['msg']='<h4 style="color:#FF0000;font-weight:bold;">PLEASE FILL CORRECT ENTRIES TO REMOVE BELOW ERRORS</h4>';
			$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
			$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
			$queryprinci['adminspan3'] = $this->load->view('princi/profile_submit',$queryprinci,true);	
			$this->load->view('common_template',$queryprinci);
			}					
			else
			{
			$ins_id=$this->Publicmodel->insert_princi($queryprinci['data_prin']);
			if($ins_id)
			{
				$data_login_upd=array(
				'user_id'=> $ins_id,
				'name'=>$this->input->post('name'),
				'first_login'=>"N",
				);
				$upd_id = $this->Publicmodel->login_upd_prin($data_login_upd,$queryprinci['log_id']);
				if($upd_id)
				{
				
					
			$queryprinci['msg']='<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY UPDATED YOUR PROFILE</h4>';
				$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
				$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
				$queryprinci['adminspan3'] = $this->load->view('po/po_body','',true);	
				$this->load->view('common_template',$queryprinci);
				}
				}
				}
			}
			if(empty($upd_id))
			{
			$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
			$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
			$queryprinci['adminspan3'] = $this->load->view('princi/profile_submit',$queryprinci,true);	
			$this->load->view('common_template',$queryprinci);	
			}
		}
		else
		{
			$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
			$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
			$queryprinci['adminspan3'] = $this->load->view('po/po_body','',true);	
			$this->load->view('common_template',$queryprinci);
		}
	}
	public function profile()
	{
		$queryprinci['main_menu']="profile";
		$queryprinci['sub_menu']=""; 
		$queryprinci['college_id'] = $this->session->userdata('college_id');
		$queryprinci['user_id'] = $this->session->userdata('user_id');
		$queryprinci['name'] = $this->session->userdata('name');
		$queryprinci['college_name'] = $this->session->userdata('college_name');
		$queryprinci['user_type'] = $this->session->userdata('user_type');
		if($queryprinci['user_type']=="principal")
		$queryprinci['princi_det'] = $this->Publicmodel->get_profile_princi($queryprinci['user_id']);
		$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
		$queryprinci['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$queryprinci['adminspan3'] = $this->load->view('profile',$queryprinci,true);
		$this->load->view('common_template',$queryprinci);
	}
	public function logout()
	{
		$this->session->userdata('college_id');
		$this->session->userdata('user_type');
		$this->session->unset_userdata('unit_list');
		$this->session->unset_userdata('college_name');
		$this->session->unset_userdata('name');
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('batch_period');
		redirect(base_url().'Nsscontrol');
	}
	 
	public function create_po()
	{
		$queryprinci['main_menu']="po";
		$queryprinci['sub_menu']="c_po"; 
		$queryprinci['princi_id']= $this->session->userdata('user_id');									
		$queryprinci['name'] =  $this->session->userdata('name');							
		$queryprinci['user_type']= $this->session->userdata('user_type'); 							
		$queryprinci['college_id']= $this->session->userdata('college_id'); 							
		$queryprinci['college_name']= $this->session->userdata('college_name'); 							
  		$queryprinci['unit_list']=  $this->session->userdata('unit_list');							
		$queryprinci['batch_period']=  $this->session->userdata('batch_period');							
		if (isset($_POST['submit5'])) 
		{	
		if(date("Y-m-d", strtotime($this->input->post('datepicker-12'))) == "1970-01-01")
		$f_date = ""; else $f_date=date("Y-m-d", strtotime($this->input->post('datepicker-12')));
		$queryprinci['data'] = array(
						'po_name'=>$this->input->post('txt1'),
						'po_gender'=>$this->input->post('radios'),						
						'po_address'=>$this->input->post('txt2'),
						'po_contact'=>$this->input->post('txt3'),						
						'po_pin'=>$this->input->post('txt5'),
						'po_email'=>$this->input->post('txt6'),
						'po_join_date'=>$f_date,
						'po_uploaded_img'=>'',
						'college_id'=>$queryprinci['college_id'],
						'po_status'=>'active',
						'created_date'=>date('Y-m-d H:i:s'),
		  );
		 if($this->session->flashdata('page_message')) $queryprinci['msg']=$this->session->flashdata('page_message');
		else $queryprinci['msg']='';
		$this->form_validation->set_error_delimiters('<span class="error_form_validation">', '</span>');
		$this->form_validation->set_rules('txt1', 'Name', 'required|regex_match[/^[a-zA-Z. ]*$/]',array('required' => 'Please provide %s.','regex_match'=>'Invalid Name.'));
		$this->form_validation->set_rules('txt2', 'Address', 'required',array('required' => 'Please select %s.'));
		$this->form_validation->set_rules('txt5', 'Pincode	', 'required|exact_length[6]|numeric',array('required' => 'Please enter %s.','min_length'=>'%s length should be 6'));
		$this->form_validation->set_rules('txt3', 'Phone Number', 'required|min_length[10]|max_length[11]|regex_match[/[0-9]$/]',array('required' =>'Please enter %s','regex_match'=>'Please provide a valid %s.'));
		$this->form_validation->set_rules('txt6', 'Email', 'required|valid_email|is_unique[nss_po.po_email]',array('required' => 'Please provide a valid %s.','is_unique'=>'This %s is already registered'));
		$this->form_validation->set_rules('datepicker-12', 'From Date', 'trim|required|callback_valid_date',array('required' => 'Please provide a valid %s.','valid_date'=>'Invalid %s'));				
		if ($this->form_validation->run() === FALSE)						
			$queryprinci['msg']= "please fill the required fields and enter valid data";						
		else{ 
		
			$ins =$this->Publicmodel->add_po($queryprinci['data']);
		
		 
			$datalogin =array(
						'college_id'=>$queryprinci['college_id'],
						'user_type'=>'po',						
						'username'=>$this->input->post('txt6'),
						'password'=>random_string('alnum', 8),
						'status'=>'active',
						'user_id'=>$ins,
						'name'=>$this->input->post('txt1'),
						'created_date'=>date('Y-m-d H:i:s'),
						);
		$ins = $this->Publicmodel->addlogin($datalogin);
		if($ins)
		{// mail sent + catch log action
				$send_email = $this->sendaccountdetailsemail($ins);
				//echo $send_email;exit;
				if($send_email =='true'){
			$queryprinci['msg']='<div class="w3-text-green">Saved successfully!!! Username and Password has sent it to entered Email Id.<div>';
					 $data_prin_log=array(
					'princi_id'=>$queryprinci['princi_id'],
					'princi_action'=>"12",
					'done_ip'=>$_SERVER['REMOTE_ADDR'],
					'done_on'=>date('Y-m-d H:i:s'),
					);
					$data_princi_log_id = $this->Publicmodel->princi_log_attempt($data_prin_log);	
				}
				else
				{
					 $data_prin_log=array(
					'princi_id'=>$queryprinci['princi_id'],
					'princi_action'=>"13",
					'done_ip'=>$_SERVER['REMOTE_ADDR'],
					'done_on'=>date('Y-m-d H:i:s'),
					);
					$data_princi_log_id = $this->Publicmodel->princi_log_attempt($data_prin_log);	
					
				}
			      $data_prin_log=array(
					'princi_id'=>$queryprinci['princi_id'],
					'princi_action'=>"2",
					'done_ip'=>$_SERVER['REMOTE_ADDR'],
					'done_on'=>date('Y-m-d H:i:s'),
					);
					$data_princi_log_id = $this->Publicmodel->princi_log_attempt($data_prin_log);
			}
			
		}}
		$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
		$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
		$queryprinci['adminspan3'] = $this->load->view('princi/create_po',$queryprinci,true);		
		$this->load->view('common_template',$queryprinci);	
	}

	public function view_po()
	{// used by princi, assistant,SO
	    $queryprinci['main_menu']="po";
		$queryprinci['sub_menu']="v_po"; 
		$queryprinci['princi_id']= $this->session->userdata('user_id');									
		$queryprinci['name'] =  $this->session->userdata('name');							
		$queryprinci['user_type']= $this->session->userdata('user_type'); 							
		$queryprinci['college_id']= $this->session->userdata('college_id'); 							
		$queryprinci['college_name']= $this->session->userdata('college_name'); 							
  		$queryprinci['unit_list']=  $this->session->userdata('unit_list');							
		$queryprinci['batch_period']=  $this->session->userdata('batch_period');
		if($queryprinci['user_type']=="principal"){
		$po_fetch_data = array(
		'college_id'=>$queryprinci['college_id'],
		'batch_period'=>$queryprinci['batch_period'],
		'unit'=>$queryprinci['unit_list'],
		);
		}elseif($queryprinci['user_type']=="assistant")
		{
		$po_fetch_data = array(
		'college_id'=>'',
		'batch_period'=>'',
		'unit'=>'',
		);
		}elseif($queryprinci['user_type']=="so")
		{
		$po_fetch_data = array(
		'college_id'=>'',
		'batch_period'=>'',
		'unit'=>'',
		);
		}
		$queryprinci['po_det']= $this->Publicmodel->get_po_detail_princi($po_fetch_data);
		$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
		$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
		$queryprinci['listspan'] = $this->load->view('princi/view_po',$queryprinci,true);	
		$queryprinci['adminspan3'] = $this->load->view('common_list_view',$queryprinci,true);	//template		
		$this->load->view('common_template',$queryprinci);	
	}
	public function view_po_form()
	{
		$queryprinci['main_menu']="po";
		$queryprinci['sub_menu']="v_po";
		if($this->input->get())
		{
				$queryprinci['princi_id']= $this->session->userdata('user_id');								
				$queryprinci['name'] =  $this->session->userdata('name');						
				$queryprinci['user_type']= $this->session->userdata('user_type'); 						
				$queryprinci['college_id']= $this->session->userdata('college_id'); 						
				$queryprinci['college_name']= $this->session->userdata('college_name'); 						
  				$queryprinci['unit_list']=  $this->session->userdata('unit_list');						
				$queryprinci['batch_period']=  $this->session->userdata('batch_period');						
			    $po_id = $this->input->get('po_id');
				$queryprinci['data'] =$this->Publicmodel->get_po_form($po_id);
				$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
				$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
				$queryprinci['adminspan3'] = $this->load->view('princi/princi_po_view_form',$queryprinci,true);		
				$this->load->view('common_template',$queryprinci);
		}
	}
	public function edit_po_form()
	{
		$queryprinci['main_menu']="po";
		$queryprinci['sub_menu']="v_po";
		if($this->input->get())
		{$po_id = $this->input->get('po_id');
		$queryprinci['data'] =$this->Publicmodel->get_po_form($po_id);
		}
		$queryprinci['princi_id']= $this->session->userdata('user_id');								
		$queryprinci['name'] =  $this->session->userdata('name');						
		$queryprinci['user_type']= $this->session->userdata('user_type'); 						
		$queryprinci['college_id']= $this->session->userdata('college_id'); 						
		$queryprinci['college_name']= $this->session->userdata('college_name'); 						
  		$queryprinci['unit_list']=  $this->session->userdata('unit_list');						
		$queryprinci['batch_period']=  $this->session->userdata('batch_period');						
				
		if($this->input->post('submit_edit_po'))
		{
		if($this->session->flashdata('page_message')) $queryprinci['msg']=$this->session->flashdata('page_message');
		else $queryprinci['msg']='';
		$this->form_validation->set_rules('txt1', 'Name', 'required|regex_match[/^[a-zA-Z. ]*$/]',array('required' => 'Please provide %s.','regex_match'=>'Invalid Name.'));
		$this->form_validation->set_rules('txt2', 'Address', 'required',array('required' => 'Please select %s.'));
		$this->form_validation->set_rules('txt5', 'Pincode	', 'required|exact_length[6]|numeric',array('required' => 'Please enter %s.','min_length'=>'%s length should be 6'));
		$this->form_validation->set_rules('txt3', 'Phone Number', 'required|min_length[10]|max_length[11]|regex_match[/[0-9]$/]',array('required' =>'Please enter %s','regex_match'=>'Please provide a valid %s.'));
		$this->form_validation->set_rules('datepicker-12', 'From Date', 'trim|required|callback_valid_date',array('required' => 'Please provide a valid %s.','valid_date'=>'Invalid %s'));		
		
			$queryprinci['edit_po_data'] = array(
			'po_id'=> $this->input->post('po_id'),
			'po_name'=>$this->input->post('txt1'),
			'po_gender'=>$this->input->post('radios'),
			'po_address'=>$this->input->post('txt2'),
			'po_contact'=>$this->input->post('txt3'),
			'po_pin'=>$this->input->post('txt5'),
			'po_join_date'=>  date("Y-m-d", strtotime($this->input->post('datepicker-12'))) ,
			);
			if ($this->form_validation->run() === FALSE)						
			$queryprinci['msg']= "please enter valid data";						
			else{
			$upd_id = $this->Publicmodel->update_po_data($queryprinci['edit_po_data']);
			$data_po = array(
			'name'=>$this->input->post('txt1'),
			);
			$upd_log_name = $this->Publicmodel->update_login_name($queryprinci['edit_po_data']['po_id'],$data_po);
			if($upd_id )
			{
			
			$queryprinci['msg']='<h4 style="color:#FF0000;font-weight:bold;">UPDATED SUCCESSFULLY</h4>';
			$queryprinci['msg_type']="msg_green";
			$data_prin_log=array(
					'princi_id'=>$queryprinci['princi_id'],
					'princi_action'=>"3",
					'done_ip'=>$_SERVER['REMOTE_ADDR'],
					'done_on'=>date('Y-m-d H:i:s'),
					);
					$data_princi_log_id = $this->Publicmodel->princi_log_attempt($data_prin_log);
			$queryprinci['data'] =$this->Publicmodel->get_po_form($queryprinci['edit_po_data']['po_id'] );
			}
			else
			{
			$queryprinci['msg']='<h4 style="color:#FF0000;font-weight:bold;">Failed Update!.Please try again</h4>';
			$queryprinci['msg_type']="msg_red";
				$queryprinci['data'] =$this->Publicmodel->get_po_form($queryprinci['edit_po_data']['po_id'] );
			}
			}
		}
		$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
		$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
		$queryprinci['adminspan3'] = $this->load->view('princi/princi_po_edit_form',$queryprinci,true);		
		$this->load->view('common_template',$queryprinci);
	}
	public function create_unit()
	{
		$queryprinci['main_menu']="unit";
		$queryprinci['sub_menu']="c_u"; 
		$queryprinci['princi_id']= $this->session->userdata('user_id');								
		$queryprinci['name'] =  $this->session->userdata('name');						
		$queryprinci['user_type']= $this->session->userdata('user_type'); 						
		$queryprinci['college_id']= $this->session->userdata('college_id'); 						
		$queryprinci['college_name']= $this->session->userdata('college_name'); 						
  		$queryprinci['unit_list']=  $this->session->userdata('unit_list');						
		$queryprinci['batch_period']=  $this->session->userdata('batch_period');			
		$queryprinci['data'] =$this->Publicmodel->get_po($queryprinci['college_id']);
		if(($this->input->post()))
		{	
		if($this->session->flashdata('page_message')) $queryprinci['msg']=$this->session->flashdata('page_message');
		else $queryprinci['msg']='';
		$this->form_validation->set_error_delimiters('<span class="error_form_validation">', '</span>');
		$this->form_validation->set_rules('txt3', 'Program Officer ID', 'required|is_unique[nss_unit.po_id]',array('required' => 'Please provide a valid %s.', 'is_unique'=>'This %s is already registered under a unit',));
		$this->form_validation->set_rules('fromdate', 'From Date', 'trim|required|callback_valid_date',array('required' => 'Please provide a valid %s.','valid_date'=>'Invalid %s'));
		$this->form_validation->set_rules('todate', 'To Date', 'trim|required|callback_valid_date',array('required' => 'Please provide a valid %s.','valid_date'=>'Invalid %s'));
		$this->form_validation->set_rules('batch', 'Batch', 'trim|required',array('required' => 'Please provide a valid %s.'));
		$data_num_units = array(
		'college_id'=>$queryprinci['college_id'] ,
		'batch_period'=> $this->input->post('batch'),
		);
		$num = ($this->Publicmodel->get_num_units($data_num_units))+1;
		$nss_unit_id = 'UNIT-'.$num;
		$unit_data = array(
								'college_id'=> $queryprinci['college_id'],
								'po_id' => $this->input->post('txt3'),
								'batch_period' => $this->input->post('batch'),
								'nss_unit_id'=> $nss_unit_id,
								'from_date' =>date("Y-m-d", strtotime($this->input->post('fromdate'))), 
								'to_date' => date("Y-m-d", strtotime($this->input->post('todate'))),
								'created_date' => date('Y-m-d H:i:s'),
								'status'=>'active',
			);
			if($unit_data['po_id'])
			{ $po_id = $unit_data['po_id'];
				$id = $this->Publicmodel->check_po($po_id);
				if($id)
				{ $correct = 1;}
				else
				{
				$correct=0;
				$queryprinci['msg']	= '<div class="red_msg">Enter Correct PO ID<div>'; 
				}
			}
			if (($this->form_validation->run() == FALSE ))
		    {
			$queryprinci['msg'] = '<div class="red_msg">ERROR in data submitted. Please clear the errors mentioned below  field.<div>'; 
		    }
		   else
		   {
		   if(date("Y-m-d", strtotime($this->input->post('fromdate'))) >= date("Y-m-d", strtotime($this->input->post('todate'))))
		  
		   $queryprinci['msg']='<h4 style="color:#FF0000;font-weight:bold;">FROM DATE SHOULD BE LESSER THAN TO DATE</h4>';
		   else
		   {
			 if($correct == 1)
			 {
			 	$upd=$this->input->get('upd');
				if($upd)
				{
					$upda =$this->Publicmodel->update_unit($unit_data);
					if($upda)
					{
						redirect(base_url('Princi/NssPrinci/current_unit?upda=1'));	
					}
				}
				else
				{
				$ins =$this->Publicmodel->add_unit($unit_data);
				if( $ins)
				{ 
				   
				   $queryprinci['msg']='<h4 style="color:#FF0000;font-weight:bold;">SUCCEFULLY ADDED!!!</h4>';
				  $data_prin_log=array(
					'princi_id'=>$queryprinci['princi_id'],
					'princi_action'=>"4",
					'done_ip'=>$_SERVER['REMOTE_ADDR'],
					'done_on'=>date('Y-m-d H:i:s'),
					);
					$data_princi_log_id = $this->Publicmodel->princi_log_attempt($data_prin_log);
				}
				}
			 }
			}}
		}
		elseif($this->input->post('submit6'))
		{
			$unit_data = array(
					'college_id'=>$queryprinci['college_id'],
					'unit_id'=>$this->input->post('uid'),
					'batch' => $this->input->post('b1'),
					'po_id' =>$this->input->post('id1')
			);
			$upd =$this->Publicmodel->update_unit($unit_data);
			if($upd)
			{ 
			$this->session->set_flashdata('upd',1);
			redirect(base_url('Princi/NssPrinci/current_unit'));
			}
		}
		$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
		$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
		$queryprinci['adminspan3'] = $this->load->view('princi/create_unit',$queryprinci,true);		
		$this->load->view('common_template',$queryprinci);
	}
	public function current_unit()
	{
		$queryprinci['main_menu']="unit";
		$queryprinci['sub_menu']="cu_u"; 
		$queryprinci['princi_id']= $this->session->userdata('user_id');								
		$queryprinci['name'] =  $this->session->userdata('name');						
		$queryprinci['user_type']= $this->session->userdata('user_type'); 						
		$queryprinci['college_id']= $this->session->userdata('college_id'); 						
		$queryprinci['college_name']= $this->session->userdata('college_name'); 						
  		$queryprinci['unit_list']=  $this->session->userdata('unit_list');						
		$queryprinci['batch_period']=  $this->session->userdata('batch_period');			
		$queryprinci['data'] =$this->Publicmodel->get_po($queryprinci['college_id']);
		$queryprinci['data'] =$this->Publicmodel->get_unit_po($queryprinci['college_id']);
		$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
		$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
		$queryprinci['adminspan3'] = $this->load->view('princi/current_unit',$queryprinci,true);		
		$this->load->view('common_template',$queryprinci);
	}
	public function edit_unit()
	{
		$queryprinci['main_menu']="unit";
		$queryprinci['sub_menu']="cu_u";
		$queryprinci['princi_id']= $this->session->userdata('user_id');								
		$queryprinci['name'] =  $this->session->userdata('name');						
		$queryprinci['user_type']= $this->session->userdata('user_type'); 						
		$queryprinci['college_id']= $this->session->userdata('college_id'); 						
		$queryprinci['college_name']= $this->session->userdata('college_name'); 						
  		$queryprinci['unit_list']=  $this->session->userdata('unit_list');						
		$queryprinci['batch_period']=  $this->session->userdata('batch_period');
		$unit_id_edit = $this->uri->segment(4);
		$queryprinci['unit_data']=$this->Publicmodel->get_unit_with_unitid($unit_id_edit);
		if($this->input->post('edit_submit'))
		{ 
			$queryprinci['upd_data'] = array(	'unit_id'=> $this->input->post('unitedit'),
								'college_id'=> $queryprinci['college_id'],
								'po_id' =>  $this->input->post('po_id_edit'),
								'from_date' =>date("Y-m-d", strtotime($this->input->post('from_date_edit'))), 
								'to_date' =>date("Y-m-d", strtotime($this->input->post('to_date_edit'))),
			);
			if($this->session->flashdata('page_message')) $queryprinci['msg']=$this->session->flashdata('page_message');
			else $queryprinci['msg']='';
			$this->form_validation->set_error_delimiters('<span class="error_form_validation">', '</span>');	
			$this->form_validation->set_rules('po_id_edit', 'PO ID', 'required|callback_is_existspo|is_unique[nss_unit.po_id]',array('required' => 'Please select  %s','is_existspo'=>'This is not a valid PO','is_unique'=>'This s already registred to another unit'));
			$this->form_validation->set_rules('from_date_edit', 'From date', 'required',array('required' => 'Please select  %s'));
			$this->form_validation->set_rules('to_date_edit', 'To Date', 'required',array('required' => 'Please select  %s'));
			if ($this->form_validation->run() === FALSE)						
			$queryprinci['msg']= "PLEASE FILL THE REQUIRED FIELDS";						
			else
			{
			 $upda =$this->Publicmodel->update_unit($queryprinci['upd_data']);
			if($upda)
			{
				$queryprinci['msg']	= '<div class="green_msg">Updated Successfully !<div>'; 
				$data_prin_log=array(
					'princi_id'=>$queryprinci['princi_id'],
					'princi_action'=>"5",
					'done_ip'=>$_SERVER['REMOTE_ADDR'],
					'done_on'=>date('Y-m-d H:i:s'),
					);
					$data_princi_log_id = $this->Publicmodel->princi_log_attempt($data_prin_log);
			}
			else
				$queryprinci['msg']	= '<div class="red_msg">No Changes Made<div>'; 
		    }
		}
		$queryprinci['unit_data']=$this->Publicmodel->get_unit_with_unitid($unit_id_edit);
		$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
		$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
		$queryprinci['adminspan3'] = $this->load->view('princi/edit_unit',$queryprinci,true);		
		$this->load->view('common_template',$queryprinci);
	}
	public function add_new_prin()
	{
		$queryprinci['princi_id']= $this->session->userdata('user_id');								
		$queryprinci['name'] =  $this->session->userdata('name');						
		$queryprinci['user_type']= $this->session->userdata('user_type'); 						
		$queryprinci['college_id']= $this->session->userdata('college_id'); 						
		$queryprinci['college_name']= $this->session->userdata('college_name');
		$queryprinci['princi_det'] = $this->Publicmodel->get_profile_princi($queryprinci['princi_id']);
		if($this->input->post('sub_next'))
		{
			$cur_prin_to_date = $this->input->post('curr_prin_to_date');
		if(empty($cur_prin_to_date))
		{
		$f_date=""; 
		}
		else
		$f_date=date("Y-m-d", strtotime($this->input->post('curr_prin_to_date')));
		$queryprinci['data_curr_prin'] = 
			array(
			'principal_id'=>$queryprinci['princi_id'],
			'to_date'=>$f_date,
			'status'=>"inactive",
			);
			if($this->session->flashdata('page_message')) 
			$queryprinci['msg']=$this->session->flashdata('page_message');
			else $queryprinci['msg']='';
			$this->form_validation->set_rules('to_date', 'TO DATE', 'trim|required|callback_valid_date',array('required' => 'PLEASE PROVIDE A VALID %s.','valid_date'=>'INVALID %s'));
			if ($this->form_validation->run() === FALSE)
			{				
			$queryprinci['msg']= "PLEASE FILL CORRECT ENTRIES TO REMOVE BELOW ERRORS";
			$queryprinci['adminspan3'] = $this->load->view('princi/princi_reliveing_date',$queryprinci,true);	
			}
			else	
			$queryprinci['adminspan3'] = $this->load->view('princi/add_new_prin',$queryprinci,true);
			}
		elseif($this->input->post('sub'))
		{
			$from_date_input = $this->input->post('from_date');
		if(empty($from_date_input ))
		$join_date ="";
		else
		$join_date = date("Y-m-d", strtotime($this->input->post('from_date')));
		$queryprinci['data_new_prin'] = array(
			'college_id'=>$queryprinci['college_id'],
			'principal_name'=>$this->input->post('prin_name'),
			'principal_email'=>$this->input->post('prin_email'),
			'principal_contact'=>$this->input->post('prin_contact'),
			'principal_address'=>$this->input->post('address'),
			'principal_pincode'=>$this->input->post('prin_pin'),
			'principal_gender'=>$this->input->post('gen'),
			'from_date'=> $join_date,
			'status'=>"active",
			);
			//print_r($queryprinci['data_new_prin']);exit;
			$to_date_input = $this->input->post('to_date');
			if(empty($to_date_input)) {
			$queryprinci['to_date']=  $this->input->post('to_date'); }
			else{ $queryprinci['to_date']= ""; }
			if($this->session->flashdata('page_message')) $queryprinci['msg']=$this->session->flashdata('page_message');
			else $queryprinci['msg']='';
			$this->form_validation->set_rules('prin_name', 'NAME ', 'required|regex_match[/^[a-zA-Z. ]*$/]',array('required' => 'Please provide %s.','regex_match'=>'INVALID NAME.'));
			$this->form_validation->set_rules('address', 'ADDRESS', 'trim|required',array('required' => 'Please provide a valid %s.'	));
			$this->form_validation->set_rules('prin_pin', 'Pincode	', 'required|exact_length[6]|numeric',array('required' => 'Please enter %s.','min_length'=>'%s length should be 6'));
			$this->form_validation->set_rules('prin_contact', 'Phone Number', 'required|min_length[10]|max_length[11]|regex_match[/[0-9]$/]',array('required' =>'Please enter %s','regex_match'=>'Please provide a valid %s.'));
			$this->form_validation->set_rules('prin_email', 'Email', 'required|valid_email|is_unique[nss_principal.principal_email]',array('required' => 'Please provide a valid %s.','is_unique'=>'This %s is already registered'));
			$this->form_validation->set_rules('from_date', 'From Date', 'trim|required|callback_valid_date',array('required' => 'Please provide a valid %s.','valid_date'=>'Invalid %s'));
		    if ($this->form_validation->run() === FALSE)
			{				
			$queryprinci['msg']= "please fill correct entries to remove below errors";
			$queryprinci['adminspan3'] = $this->load->view('princi/add_new_prin',$queryprinci,true);
			}
			else
			{
			$queryprinci['data_curr_prin'] = 
			array(
			'principal_id'=>$queryprinci['princi_id'],
			'to_date'=>$this->input->post('curr_prin_to_date'),
			'status'=>"inactive",
			);
			$upd_log = $this->Publicmodel->update_login($queryprinci['princi_id']);
			if($upd_log)
			{
			$upd_id = $this->Publicmodel->update_princi($queryprinci['data_curr_prin']);
			if($upd_id)
			{
				$ins_id = $this->Publicmodel->insert_princi($queryprinci['data_new_prin']);
				if($ins_id)
				 {
			        $colge_det = $this->Publicmodel->get_college_name($queryprinci['college_id']);
					$data_new_log=array(
					'college_id'=>$queryprinci['college_id'],
					'user_type'=>"principal",
					'username'=>$this->input->post('prin_email'),
					'password'=>random_string('alnum', 8),
					'status'=>'active',
					'name'=>$this->input->post('prin_name'),
					'user_id'=>$ins_id,
					'first_login'=>"N",
					'created_date'=>date('Y-m-d H:i:s'),
					);
					$ins_log = $this->Publicmodel->addlogin($data_new_log);
					if($ins_log)
					{
					$send_email = $this->sendaccountdetailsemail($ins_log);	
					
					 $queryprinci['msg']='<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY CREATED NEW PRINCIPAL.NOW YOU CAN LOGOUT!!!</h4>';
					$data_prin_log=array(
					'princi_id'=>$queryprinci['princi_id'],
					'princi_action'=>"11",
					'done_ip'=>$_SERVER['REMOTE_ADDR'],
					'done_on'=>date('Y-m-d H:i:s'),
					);
					$data_princi_log_id = $this->Publicmodel->princi_log_attempt($data_prin_log);
					}
					$queryprinci['logout_msg'] = 1;
					$queryprinci['adminspan3'] = $this->load->view('princi/princi_reliveing_date',$queryprinci,true);
			}
			}
			}
			else
			{
			$queryprinci['adminspan3'] = $this->load->view('princi/add_new_prin',$queryprinci,true);
			}
			}
			
    }
	else
	{
	$queryprinci['adminspan3'] = $this->load->view('princi/princi_reliveing_date',$queryprinci,true);
	}
		$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
		$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
		$this->load->view('common_template',$queryprinci);
	}
	public function view_enroll_list()
	{
	    $queryprinci['main_menu']="enroll";
		$queryprinci['sub_menu']=""; 
		$queryprinci['princi_id']= $this->session->userdata('user_id');								
		$queryprinci['name'] =  $this->session->userdata('name');						
		$queryprinci['user_type']= $this->session->userdata('user_type'); 						
		$queryprinci['college_id']= $this->session->userdata('college_id'); 						
		$queryprinci['college_name']= $this->session->userdata('college_name'); 						
		$queryprinci['batch_period']= $this->Publicmodel->princi_batch_period($queryprinci['college_id']);
		if($this->input->post('batch'))
		{
			$queryprinci['sel_batch']= $this->input->post('batch');
			$queryprinci['unit_det'] = $this->Publicmodel->get_unit_from_batch($queryprinci['college_id'],$queryprinci['sel_batch']);
			if($this->input->post('unit'))
			{
			$queryprinci['sel_unit'] = $this->input->post('unit');
			$ver_id_arr =array('1','1R','2','2R','3','3R','4');
			$data_pass=array(
			'nss_unit'=>$queryprinci['sel_unit'],
			'college_id'=>$queryprinci['college_id'],
			'ver_id'=>$ver_id_arr,
			'batch_period'=>$queryprinci['sel_batch'],
			);
			$queryprinci['enroll_list']= $this->Publicmodel->get_enroll_stud_detail($data_pass);
			$queryprinci['count_stud'] = count($queryprinci['enroll_list']);
			$nss_stud_id_list = array_column($queryprinci['enroll_list'],'nss_stud_id');
			if($this->input->post('enroll'))
		{
			$j =0; 
			foreach($nss_stud_id_list as $val)
			{  if($queryprinci['college_id']<10) $college_id = '00'.$queryprinci['college_id']; 
					elseif($queryprinci['college_id']<100) $college_id = '0'.$queryprinci['college_id'];
				$data_upd_enroll[$j] = array(
				'nss_stud_id' => $val,
				'nss_status' => 'active',
				'nss_enroll_id'=>'KL0500'.substr($queryprinci['sel_unit'],5).date('y').(($j+1) < 10 ?'0'.($j+1):($j+1)),// format KL05-UNIT NO-YEAR-sl.no eg:KL050011801(remove '-')
				); $j ++; 
			}
			$enroll_batch_upd_id = $this->Publicmodel->update_batch_nss_stud_enroll($data_upd_enroll);
			if($enroll_batch_upd_id){
			$queryprinci['msg']= '<h4 style="color:#186A3B;font-weight:bold;">STUDENTS ARE ENROLLED SUCCESSFULLY</h4>';
			
			$queryprinci['enroll_list']= $this->Publicmodel->get_enroll_stud_detail($data_pass);
			$queryprinci['count_stud'] = count($queryprinci['enroll_list']);
			}
		}
		if($this->input->post('fwdtoassi'))
		{
			$data_rej = array(
			'verification_id'=>'2',
			//'remarks'=>$this->input->post('remarktxt1'),
			);
			$upd_rej = $this->Publicmodel->princi_fwd($data_rej,$nss_stud_id_list);
			if($upd_rej){
			
			$queryprinci['msg']='<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO UNIVERSITY</h4>';
			$data_prin_log=array(
					'princi_id'=>$queryprinci['princi_id'],
					'princi_action'=>"6",
					'done_ip'=>$_SERVER['REMOTE_ADDR'],
					'done_on'=>date('Y-m-d H:i:s'),
					);
					$data_princi_log_id = $this->Publicmodel->princi_log_attempt($data_prin_log);
			}
		}
		elseif($this->input->post('rejprincisubmit'))
		{
			$data_rej = array(
			'verification_id'=>'1R',
			'remarks'=>$this->input->post('remarktxt1'),
			);
			$upd_rej = $this->Publicmodel->princi_rej($data_rej,$nss_stud_id_list);
			if($upd_rej){
			
			$queryprinci['msg']='<h4 style="color:#FF0000;font-weight:bold;">REJECTED AND FORWARDED TO PO</h4>';
			$data_prin_log=array(
					'princi_id'=>$queryprinci['princi_id'],
					'princi_action'=>"7",
					'done_ip'=>$_SERVER['REMOTE_ADDR'],
					'done_on'=>date('Y-m-d H:i:s'),
					);
					$data_princi_log_id = $this->Publicmodel->princi_log_attempt($data_prin_log);
			}
		}
		$queryprinci['enroll_list']= $this->Publicmodel->get_enroll_stud_detail($data_pass);	
		$queryprinci['count_stud'] = count($queryprinci['enroll_list']);
		}
		}
		$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
		$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
		$queryprinci['listspan'] = $this->load->view('princi/view_enroll_list',$queryprinci,true);
		$queryprinci['adminspan3'] = $this->load->view('common_list_view',$queryprinci,true);	//template	
		$this->load->view('common_template',$queryprinci);//template					
	}
	public function monthly_atten()
	{
	    $queryprinci['main_menu']="atten";
		$queryprinci['sub_menu']=""; 
		$queryprinci['princi_id']= $this->session->userdata('user_id');								
		$queryprinci['name'] =  $this->session->userdata('name');						
		$queryprinci['user_type']= $this->session->userdata('user_type'); 						
		$queryprinci['college_id']= $this->session->userdata('college_id'); 						
		$queryprinci['college_name']= $this->session->userdata('college_name'); 	
		$queryprinci['batch_period']= $this->Publicmodel->princi_batch_period($queryprinci['college_id']);
		if($this->input->post('batch'))
		{
			$queryprinci['sel_batch']= $this->input->post('batch');
			$queryprinci['unit_det'] = $this->Publicmodel->get_unit_from_batch($queryprinci['college_id'],$queryprinci['sel_batch']);
			if($this->input->post('unit'))
			{$queryprinci['sel_unit']=$this->input->post('unit');
			$queryprinci['sel'] = $this->input->post('get_data');
			if($this->input->post('get_data'))
			{
			if($queryprinci['sel'] == "Y" || $queryprinci['sel'] == "M")
				$queryprinci['year_db'] =$this->Publicmodel->get_mo_atten_year($queryprinci['college_id'],$queryprinci['sel_batch'],$queryprinci['sel_unit']);
				
				if($this->input->post())
				{
				$queryprinci['sel_year'] = $this->input->post('get_year') ;
				$queryprinci['sel_month']= $this->input->post('get_month');
				$queryprinci['sel_date']= $this->input->post('date');
				$detail_p= array(
				'college_id'=>$queryprinci['college_id'],
				'batch_period' =>$queryprinci['sel_batch'],
				'unit'=> $queryprinci['sel_unit'],
				'year'=> $this->input->post('get_year'),
				'month'=>$this->input->post('get_month'),

				'date'=>  date("Y-m-d", strtotime($this->input->post('date'))),
				
				);
				$queryprinci['month_view_data_fwd_prin'] = $this->Publicmodel->get_view_atten_fwd_prin($detail_p,"1");
				//print_r($queryprinci['month_view_data_fwd_prin']);exit;
				if(empty($queryprinci['month_view_data_fwd_prin']))$queryprinci['msg']='<h4 style="color:#FF0000;font-weight:bold;">NO DATA FOUND</h4>';
				if($this->input->post('fwd_uni')&& !empty($queryprinci['month_view_data_fwd_prin']))
			     {// echo'aa';exit;
			      $atten_id = array_column($queryprinci['month_view_data_fwd_prin'],'m_attendance_id');
			      $upd_fwd_p = $this->Publicmodel->fwd_prin_atten($atten_id,"2");
			      if($upd_fwd_p)
			      {
			      $queryprinci['msg']='<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO UNIVERSITY</h4>';
			      }
			      }
				if($this->input->post('rejprincisubmit')&& !empty($queryprinci['month_view_data_fwd_prin']))
				{
				$atten_id = array_column($queryprinci['month_view_data_fwd_prin'],'m_attendance_id');
				$datarej=array(
				'ver_id'=>'1R',
				'remark'=>$this->input->post('remarktxt1'),
				);
				$upd_fwd_p = $this->Publicmodel->rej_prin_atten($atten_id,$datarej);
				if($upd_fwd_p)
				{
				
				$queryprinci['msg']=
			 '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY PRINCIPAL</h4>';
				}
				}
				$queryprinci['month_view_data_fwd_prin'] = $this->Publicmodel->get_view_atten_fwd_prin($detail_p,"1");
				$ver_id = array("2","2R","3");
				$queryprinci['month_view_data_fwd_uni'] = $this->Publicmodel->get_view_atten_fwd_uni($detail_p,$ver_id );
				$queryprinci['month_view_data_atten_uni'] = $this->Publicmodel->get_view_atten_uni($detail_p,"4");
				}
			    }
			    }
		        }
		$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
		$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
		$queryprinci['listspan'] = $this->load->view('princi/monthly_atten',$queryprinci,true);
		$queryprinci['adminspan3'] = $this->load->view('common_list_view',$queryprinci,true);	//template	
		$this->load->view('common_template',$queryprinci);//template					
	}
	public function fund_report()
	{	$queryprinci['main_menu']="fund";
		$queryprinci['sub_menu']=""; 
		$queryprinci['princi_id']= $this->session->userdata('user_id');								
		$queryprinci['name'] =  $this->session->userdata('name');						
		$queryprinci['user_type']= $this->session->userdata('user_type'); 						
		$queryprinci['college_id']= $this->session->userdata('college_id'); 						
		$queryprinci['college_name']= $this->session->userdata('college_name'); 
		$queryprinci['nss_fund_list']= $this->Publicmodel->get_fund_last5($queryprinci['college_id']);
		if($this->input->post('b_sub'))
		{
			$b_year = $this->input->post('b_year');
			$this->fund_print($b_year);
		}
		if($this->input->post('fwdtoassi')&&!empty($queryprinci['nss_fund_list']))
		{
			$upd_fwd_p = $this->Publicmodel->fwd_prin_fund($queryprinci['college_id'],"2");
			if($upd_fwd_p)
			{
			$queryprinci['msg']='<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO UNIVERSITY</h4>';
			}
		}
		if($this->input->post('rejprincisubmit')&& !empty($queryprinci['nss_fund_list']))
		{ 
			$datarej=array(
			'ver_id'=>'1R',
			'remark'=>$this->input->post('remarktxt1'),
			);
			$upd_fwd_p = $this->Publicmodel->rej_prin_fund($queryprinci['college_id'],$datarej);
			if($upd_fwd_p)
			{
			//$queryprinci['msg']="REJECTED BY PRINCIPAL";
			$queryprinci['msg']=
			 '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY PRINCIPAL</h4>';
			}
		}
		$queryprinci['nss_fund_list']= $this->Publicmodel->get_fund_last5($queryprinci['college_id']);
		$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
		$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
		$queryprinci['listspan'] = $this->load->view('princi/fund_report',$queryprinci,true);
		$queryprinci['adminspan3'] = $this->load->view('common_list_view',$queryprinci,true);	//template	
		$this->load->view('common_template',$queryprinci);//template
	}
	public function fund_print($b_year)
	{
		$queryprinci['princi_id']= $this->session->userdata('user_id');								
		$queryprinci['name'] =  $this->session->userdata('name');						
		$queryprinci['user_type']= $this->session->userdata('user_type'); 						
		$queryprinci['college_id']= $this->session->userdata('college_id'); 						
		$queryprinci['college_name']= $this->session->userdata('college_name'); 
		$print = $b_year;
		if(isset($print))
		{
			$queryprinci['sel_yr'] = $print;
		}
		if($queryprinci['sel_yr'])
		{
			$queryprinci['fund_det'] = $this->Publicmodel->get_nss_fund($queryprinci['college_id'],$queryprinci['sel_yr']);
			$queryprinci['sanc_fund']= $this->Publicmodel->get_nss_fund_sanc($queryprinci['college_id'],date('Y'));
			$amount_spent = array_column($queryprinci['fund_det'], 'amount_spent');
			$queryprinci['amount_spent_sum'] = array_sum($amount_spent);
		    $queryprinci['bal'] = $queryprinci['sanc_fund']['amount_sanc'] - $queryprinci['amount_spent_sum'];
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
			$html = $this->load->view('po/fund_rep_print', $queryprinci, true);
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
	public function camp()
	{
	    $queryprinci['main_menu']="camp";
		$queryprinci['sub_menu']=""; 
		$queryprinci['princi_id']= $this->session->userdata('user_id');								
		$queryprinci['name'] =  $this->session->userdata('name');						
		$queryprinci['user_type']= $this->session->userdata('user_type'); 						
		$queryprinci['college_id']= $this->session->userdata('college_id'); 						
		$queryprinci['college_name']= $this->session->userdata('college_name'); 	
		$queryprinci['batch_period']= $this->Publicmodel->princi_batch_period($queryprinci['college_id']);
		if($this->input->post('batch'))
		{
			$queryprinci['sel_batch']= $this->input->post('batch');
			$queryprinci['unit_det'] = $this->Publicmodel->get_unit_from_batch($queryprinci['college_id'],$queryprinci['sel_batch']);
		if($this->input->post('unit'))
		{
		$queryprinci['sel_unit'] = $this->input->post('unit');
		if($this->input->post())
		{
			$ver_id=array("1","1R","2","3","4");
			$queryprinci['detail']= array(
			'college_id'=>$queryprinci['college_id'],
			'batch_period' =>$queryprinci['sel_batch'],
			'unit'=> $queryprinci['sel_unit'],	
			'sel_camp_type'=>$this->input->post('get_camp'),
			'veri_id'=>$ver_id,
			);
			$queryprinci['camp_detail'] = $this->Publicmodel->get_camp_date($queryprinci['detail']);
			if(empty($queryprinci['camp_detail']))
			$queryprinci['msg']= '<h4 style="color:#FF0000;font-weight:bold;">NO DATA FOUND</h4>';
			if(isset($queryprinci['camp_detail'][0]['nss_camp_type']))
			$queryprinci['sub'] = 1;// show the table if value exist
			if($this->input->post('fwdtoassi'))
			{ 
			$id = $queryprinci['camp_detail'][0]['nss_camp_id'];
			$upd_fwd_p = $this->Publicmodel->fwd_prin_camp($id,"2");
			if($upd_fwd_p)
			{
			$queryprinci['msg']='<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO UNIVERSITY</h4>';
			}
			}
			if($this->input->post('rejprincisubmit')&& !empty($queryprinci['camp_detail']))
			{ 
			$atten_id = $queryprinci['camp_detail'][0]['nss_camp_id'];
			$datarej=array(
			'ver_id'=>'1R',
			'remark'=>$this->input->post('remarktxt1'),
			);
			$upd_fwd_p = $this->Publicmodel->rej_prin_atten($atten_id,$datarej);
			if($upd_fwd_p)
			{
			
			$queryprinci['msg']= '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY PRINCIPAL</h4>';
			}
			}
			}
			}
			}
		$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
		$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
		$queryprinci['listspan'] = $this->load->view('princi/camp',$queryprinci,true);
		$queryprinci['adminspan3'] = $this->load->view('common_list_view',$queryprinci,true);	//template	
		$this->load->view('common_template',$queryprinci);//template
	}
	public function monthly_report()
	{
		$queryprinci['main_menu']="month";
		$queryprinci['sub_menu']=""; 
		$queryprinci['princi_id']= $this->session->userdata('user_id');								
		$queryprinci['name'] =  $this->session->userdata('name');						
		$queryprinci['user_type']= $this->session->userdata('user_type'); 						
		$queryprinci['college_id']= $this->session->userdata('college_id'); 						
		$queryprinci['college_name']= $this->session->userdata('college_name'); 	
		$queryprinci['batch_period']= $this->Publicmodel->princi_batch_period($queryprinci['college_id']);
		if($this->input->post('batch'))
		{
			$queryprinci['sel_batch']= $this->input->post('batch');
			$queryprinci['unit_det'] = $this->Publicmodel->get_unit_from_batch($queryprinci['college_id'],$queryprinci['sel_batch']);
			if($this->input->post('unit'))
		{
		$queryprinci['sel_unit'] = $this->input->post('unit');
		}
		$queryprinci['get_yrs'] = $this->Publicmodel->get_yrs_monthly_report($queryprinci['college_id']);
		if(empty($queryprinci['get_yrs']))
		
		$queryprinci['msg']= '<h4 style="color:#FF0000;font-weight:bold;">NO DATA FOUND</h4>';
		if($this->input->post('year'))
		{
			 $queryprinci['year_sel'] = $this->input->post('year');
		}
		//month selected
		if($this->input->post('month'))
		{
			if(empty($queryprinci['year_sel'] ))
			echo '<script>alert("SELECT YEAR");</script>';
			elseif(date('Y') == $this->input->post('year') && date('m')>=$this->input->post('month') )
			$flag_ok = '1';
			elseif(date('Y')!= $this->input->post('year'))
			$flag_ok = '1';
			else
			echo '<script>alert("SELECT MONTH LESS THAN CURRENT MONTH");</script>';
			if(isset($flag_ok)){
			 $queryprinci['month_sel_n']= $this->input->post('month');	
			 $queryprinci['month_sel']=date('F', mktime(0, 0, 0, $queryprinci['month_sel_n'], 10));
			 $data_fde = array(
				'college_id' => $queryprinci['college_id'],
				'nss_unit' => $queryprinci['sel_unit'],
				'batch_period' => $queryprinci['sel_batch'],
				'year' => $this->input->post('year'),
				'month' => $this->input->post('month'),
				);
			 $queryprinci['monthly_report_data'] = $this->Publicmodel->get_mothly_report($data_fde);
			}
			}
			if($this->input->post('fwdtoassi')&& isset($queryprinci['monthly_report_data'])&& !empty($queryprinci['monthly_report_data']))
			{
				$data_m_r = array(
				'college_id'=>$queryprinci['college_id'],
				'batch_period'=>$queryprinci['sel_batch'],
				'nss_unit'=>$queryprinci['sel_unit'],
				'month'=>$this->input->post('month'),
				'year'=> $this->input->post('year'),
				'verification_id'=>"2",
				);
				$up_mr=$this->Publicmodel->fwd_ass_mon_rep($data_m_r );
				if($up_mr)
				{
				$queryprinci['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESFULLY FORWARDED TO UNIVERSITY</h4>';}
			}
			if($this->input->post('rejprincisubmit')&& isset($queryprinci['monthly_report_data'])&& !empty($queryprinci['monthly_report_data']))
			{
			$data_m_r = array(
				'college_id'=>$queryprinci['college_id'],
				'batch_period'=>$queryprinci['sel_batch'],
				'nss_unit'=>$queryprinci['sel_unit'],
				'month'=>$this->input->post('month'),
				'year'=> $this->input->post('year'),
				'verification_id'=>"1R",
				'remark'=>$this->input->post('remarktxt1'),
				);
				$up_mr=$this->Publicmodel->rej_ass_mon_rep($data_m_r );
				if($up_mr)
				{
				
				$queryprinci['msg']= '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY PRINCIPAL</h4>';}
			}
			if(isset($data_fde))
			 $queryprinci['monthly_report_data'] = $this->Publicmodel->get_mothly_report($data_fde);
		}
		$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
		$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
		$queryprinci['listspan'] = $this->load->view('princi/monthly_report',$queryprinci,true);
		$queryprinci['adminspan3'] = $this->load->view('common_list_view',$queryprinci,true);	//template	
		$this->load->view('common_template',$queryprinci);//template
	}
	public function monthly_report_view()
	{
		$queryprinci['princi_id']= $this->session->userdata('user_id');								
		$queryprinci['name'] =  $this->session->userdata('name');						
		$queryprinci['user_type']= $this->session->userdata('user_type'); 						
		$queryprinci['college_id']= $this->session->userdata('college_id'); 						
		$queryprinci['college_name']= $this->session->userdata('college_name'); 
		$url_string = $this->uri->segment(4);
		$yr = substr($url_string, 0, 4);
		$month = substr($url_string, 4, 2);
		$queryprinci['yr_sel'] = $yr;
		if(!empty($month))
		{
		if($month)
		 $queryprinci['month_sel']=date('F', mktime(0, 0, 0, $month, 10));
		 $data = array(
				'college_id' => $queryprinci['college_id'],
				'year' => $yr,
				'month' => $month,
				);
		$queryprinci['monthly_rep_data'] = $this->Publicmodel->get_monthly_report_princi($data);
		$this->load->library('Pdf');
			$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
			$pdf->SetTitle('MONTHLY REPORT');
			$pdf->SetTopMargin(15);
			$pdf->setFooterMargin(15);
			$pdf->SetAuthor('Author');
			$pdf->SetDisplayMode('real', 'default');
			$pdf->setPrintHeader(false);
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			$pdf->AddPage();
			$html = $this->load->view('po/monthly_report_view', $queryprinci, true);
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->SetFont('dejavusans', '', 10);
	 		ob_end_clean();
			$pdf->Output('monthly report.pdf', 'I');
			}
			else
			{
				$data = array(
				'college_id' => $queryprinci['college_id'],
				'year' => $yr,
				);
			$queryprinci['yr_rep_data'] = $this->Publicmodel->get_monthly_report_princi($data);
			$queryprinci['months_in_array'] = array_unique(array_column($queryprinci['yr_rep_data'],'month'));
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
			$html = $this->load->view('po/yrly_report_view', $queryprinci, true);
			$pdf->writeHTML($html, true, false, true, false, '');
			$pdf->SetAlpha(1);
			$pdf->SetFont('dejavusans', '', 10);
	 		ob_end_clean();
			$pdf->Output('Yearly report.pdf', 'I');
		}
	}
	public function audit_report()
	{
		$queryprinci['main_menu']="audit";
		$queryprinci['sub_menu']=""; 
		$queryprinci['princi_id']= $this->session->userdata('user_id');								
		$queryprinci['name'] =  $this->session->userdata('name');						
		$queryprinci['user_type']= $this->session->userdata('user_type'); 						
		$queryprinci['college_id']= $this->session->userdata('college_id'); 						
		$queryprinci['college_name']= $this->session->userdata('college_name'); 
		$queryprinci['audit_detail']=$this->Publicmodel->get_audit_last5($queryprinci['college_id']);
		if($this->input->post('fwdtoassi')&& !empty($queryprinci['audit_detail']))
		{
			$audit_id = array_column($queryprinci['audit_detail'],'nss_audit_id');
			$upd_fwd_p = $this->Publicmodel->fwd_prin_audit($audit_id,"2");
			if($upd_fwd_p)
			{
			$queryprinci['msg']='<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO UNIVERSITY</h4>';
			}
		}
		if($this->input->post('rejprincisubmit')&& !empty($queryprinci['audit_detail']))
		{ 
			$audit_id = array_column($queryprinci['audit_detail'],'nss_audit_id');
			$datarej=array(
			'ver_id'=>'1R',
			'remark'=>$this->input->post('remarktxt1'),
			);
			$upd_fwd_p = $this->Publicmodel->rej_prin_audit($atten_id,$datarej);
			if($upd_fwd_p)
			{
			
			$queryprinci['msg']='<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY PRINCIPAL</h4>';
			}
			}
		$queryprinci['audit_detail']=$this->Publicmodel->get_audit_last5($queryprinci['college_id']);
		$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
		$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
		$queryprinci['listspan'] = $this->load->view('princi/audit_report',$queryprinci,true);
		$queryprinci['adminspan3'] = $this->load->view('common_list_view',$queryprinci,true);	//template	
		$this->load->view('common_template',$queryprinci);//template
	}
	public function eligibility_rep()
	{
		$queryprinci['main_menu']="eli";
		$queryprinci['sub_menu']=""; 
		$queryprinci['princi_id']= $this->session->userdata('user_id');								
		$queryprinci['name'] =  $this->session->userdata('name');						
		$queryprinci['user_type']= $this->session->userdata('user_type'); 						
		$queryprinci['college_id']= $this->session->userdata('college_id'); 						
		$queryprinci['college_name']= $this->session->userdata('college_name'); 	
		$queryprinci['batch_period']= $this->Publicmodel->princi_batch_period($queryprinci['college_id']);
		if($this->input->post('batch'))
		{
			$queryprinci['sel_batch']= $this->input->post('batch');
			$queryprinci['unit_det'] = $this->Publicmodel->get_unit_from_batch($queryprinci['college_id'],$queryprinci['sel_batch']);
		}
		if($this->input->post('unit'))
		{
			$queryprinci['sel_unit'] = $this->input->post('unit');
		}
		if(isset($queryprinci['sel_unit']) && isset($queryprinci['sel_batch']))
		{
		$queryprinci['stud_det']= array();
		if($this->input->post('fwd_uni'))
		{
			$data_eli_upd = array(
			'college_id'=>$queryprinci['college_id'],
			'batch_period'=>$queryprinci['sel_batch'],
			'nss_unit'=>$queryprinci['sel_unit'],
			'verification_id'=>'1',
			'chg_ver_id'=>'2',
			'remarks'=>'' ,
			);
			$upd_eli = $this->Publicmodel->fwd_prin_eli($data_eli_upd);
			if($upd_eli)
			$queryprinci['msg']='<h4 style="color:#FF0000;font-weight:bold;">FORWARDED TO UNIVERSITY</h4>';
		}
		if($this->input->post('rejprincisubmit'))
		{
			$data_eli_upd = array(
			'college_id'=>$queryprinci['college_id'],
			'batch_period'=>$queryprinci['sel_batch'],
			'nss_unit'=>$queryprinci['sel_unit'],
			'verification_id'=>'1',
			'chg_ver_id'=>'1R',
			'remarks'=>$this->input->post('remarktxt1'),
			);
			$upd_eli = $this->Publicmodel->fwd_prin_eli($data_eli_upd);
			if($upd_eli)
			$queryprinci['msg']='<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY PRINCIPAL</h4>';
			
		}
		$ver_id = array("1","1R","2","2R","3","4","3R");
		$queryprinci['eli_det'] = $this->Publicmodel->chk_elig_rep($queryprinci['college_id'],$queryprinci['sel_batch'],$queryprinci['sel_unit'],$ver_id);
		}
		$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
		$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
		$queryprinci['listspan'] = $this->load->view('princi/eligibility_report',$queryprinci,true);
		$queryprinci['adminspan3'] = $this->load->view('common_list_view',$queryprinci,true);	//template	
		$this->load->view('common_template',$queryprinci);//template
	}
	public function notification()
	{
		$queryprinci['princi_id']= $this->session->userdata('user_id');								
		$queryprinci['name'] =  $this->session->userdata('name');						
		$queryprinci['user_type']= $this->session->userdata('user_type'); 						
		$queryprinci['college_id']= $this->session->userdata('college_id'); 						
		$queryprinci['college_name']= $this->session->userdata('college_name'); 						
  		$queryprinci['unit_list']=  $this->session->userdata('unit_list');						
		$queryprinci['batch_period']=  $this->session->userdata('batch_period');
		$queryprinci['batch_det'] = array_unique(explode("|",$queryprinci['batch_period']));
		$queryprinci['unit_det'] = explode("|",$queryprinci['unit_list']);
		$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
		$queryprinci['adminspan2'] = $this->load->view('common_template_topbar',$queryprinci,true);	
		$queryprinci['listspan'] = $this->load->view('notification',$queryprinci,true);
		$queryprinci['adminspan3'] = $this->load->view('common_list_view',$queryprinci,true);	//template	
		$this->load->view('common_template',$queryprinci);//template
	}
	public function certi()// make it as draft of certificate not able to download
	{
		$queryprinci['main_menu']="certi";
		$queryprinci['sub_menu']=""; 
		$queryprinci['princi_id']= $this->session->userdata('user_id');								
		$queryprinci['name'] =  $this->session->userdata('name');						
		$queryprinci['user_type']= $this->session->userdata('user_type'); 						
		$queryprinci['college_id']= $this->session->userdata('college_id'); 						
		$queryprinci['college_name']= $this->session->userdata('college_name'); 	
		$queryprinci['batch_period']= $this->Publicmodel->princi_batch_period($queryprinci['college_id']);
		if($this->input->post('batch'))
		{
			$queryprinci['sel_batch']= $this->input->post('batch');
			$queryprinci['unit_det'] = $this->Publicmodel->get_unit_from_batch($queryprinci['college_id'],$queryprinci['sel_batch']);
			if($this->input->post('unit'))
			{
			$queryprinci['sel_unit'] = $this->input->post('unit');
			}
		if($this->input->post('certi_type'))
		{		
			$queryprinci['certi_type'] = $this->input->post('certi_type');
			if($queryprinci['certi_type']=='V')
			{
				$queryprinci['eli_dat'] = $this->Publicmodel->elig_rep($queryprinci['college_id'],$queryprinci['sel_batch'],$queryprinci['sel_unit']);
			}
		}
		}
		$queryprinci['adminspan1'] = $this->load->view('common_sidebar',$queryprinci,true);
		$queryprinci['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$queryprinci['adminspan3'] = $this->load->view('princi/certi',$queryprinci,true);	
		$this->load->view('common_template',$queryprinci);
	}
	//-------------------------------------------------------------EMAIL-----------------------------------------------------------------//

	public function sendaccountdetailsemail($ins='')
	{
		
	   
		$config = Array(
   'protocol' => 'smtp',
   'smtp_host' => 'ssl://smtp.googlemail.com',
   'smtp_port' => 465,
   'smtp_user' => 'donotreply.mgu.NSS@gmail.com',
   'smtp_pass' => 'NssMgu@2018',
   'mailtype'  => 'html', 
   'charset'   => 'iso-8859-1'
);
$this->load->library('email', $config);
	
		if($ins){
			$this->load->model('Publicmodel');
			$acnt_dtls	= $this->Publicmodel->getlogin_login_id($ins);
			//print_r($acnt_dtls);exit;
		}
		$message="<h4>Dear ".$acnt_dtls['name'].",</h4><h4>Welcome to Mahatma Gandhi University Online National Service Scheme Portal.</h4>";
						$message=$message."<table border='1' cellspacing='0' cellpadding='10'><tr bgcolor='#099' color='white'><td align='center'><b>Your Login credentials are,</b></td></tr><tr><td>";
						$message=$message."<table cellspacing='10' cellpadding='0'>
									<tr><th align='left'>User Id</th><td>:</td><td>".$acnt_dtls['username']."</td></tr>
									<tr><th align='left'>Password</th><td>:</td><td>".$acnt_dtls['password']."</td></tr>
									<tr><th align='left'>Website</th><td>:</td><td>".base_url('Nsscontrol/index')."</td></tr>
									</table></td></tr></table>";
									
		
		$to_email	= $acnt_dtls['username'];

       $from_email = "donotreply.mgu.NSS@gmail.com";
		 $this->email->from($from_email, 'MGU NSS'); 
        $this->email->to($to_email);
        $this->email->subject('User credentials for MGU NSS PORTAL'); 
        $this->email->message($message); 
       $this->email->set_newline("\r\n");
$result = $this->email->send();

		//$ci->email->send();
		if ($result)
		{
			 $data_prin_log=array(
					'username'=>$acnt_dtls['username'],
					'status'=>"success",
					);
					$data_princi_log_id = $this->Publicmodel->mail_track($data_prin_log);
		
			return true;
		}
		else
		{
			 $data_prin_log=array(
					'username'=>$acnt_dtls['username'],
					'status'=>"fail",
					);
					//print_r($data_prin_log);exit;
					$data_princi_log_id = $this->Publicmodel->mail_track($data_prin_log);
			return false;
		}
	}
	function valid_date($post_string)
	{
		if(!preg_match("/(^(((0[1-9]|1[0-9]|2[0-8])[-](0[1-9]|1[012]))|((29|30|31)[-](0[13578]|1[02]))|((29|30)[-](0[4,6,9]|11)))[-](19|[2-9][0-9])\d\d$)|(^29[-]02[-](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/", $post_string)){//!preg_match("/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/", $post_string)
			return false;
		}
		else return true;
	}
	function is_existspo($po_id)
	{ 
		$exist_id = $this->Publicmodel->check_po($po_id);
		if($exist_id)
		return true;
		else
		 return false;
	}
//------------------------------------------------------------------------------------------------------------------------------------//
}
