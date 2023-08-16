<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nsscontrol extends CI_Controller {
	 public function __construct()
	{
		parent::__construct(); 
		// Your own constructor code
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('string');
		$this->load->model('Publicmodel');
		$this->load->library('Mathcaptcha');
		$config_captcha = array(
		'operation'=>'random',
		'question_format'=>'numeric',
		'answer_format'=>'numeric',
		);
		$this->mathcaptcha->init($config_captcha);
	}
	
	 
	
		public function index()	
	{	
		$this->load->model('Publicmodel');
		$query['dataact']	= $this->Publicmodel->get_upload_activity("y");
		$display = 'X';
		$query['notice_detail'] = $this->Publicmodel->get_notice($display);
		$query['web_content'] = $this->Publicmodel->get_so_acpt_web();
		$query['captcha'] = $this->mathcaptcha->get_question();
        $data['span'] = $this->load->view('homes',$query,true);
		$this->load->view('template1',$data);
	}
	
	public function forgot_pwd()
	{
		if($this->input->post())
		{
			if($this->session->flashdata('page_message')) 
			$query['msg']=$this->session->flashdata('page_message');
			else $query['msg']='';
			$this->form_validation->set_error_delimiters('<span class="error_form_validation">', '</span>');
			$this->form_validation->set_rules('usrname', 'username', 'required|callback_valid_uname',array('required' => 'Please provide %s.','valid_uname'=>'Invalid %s'));
			if ($this->form_validation->run() === FALSE)
			{ 
			$data['msg']="Please enter valid username";	
			$query['dataact']	= $this->Publicmodel->get_upload_activity("y");
			$display = 'X';
			$query['notice_detail'] = $this->Publicmodel->get_notice($display);
			$query['web_content'] = $this->Publicmodel->get_so_acpt_web();
			$query['captcha'] = $this->mathcaptcha->get_question();
        	$data['span'] = $this->load->view('homes',$query,true);
			$this->load->view('template1',$data);
			}
			else
			{
			$query['username']= $this->input->post('usrname');
			$login_data_user = $this->Publicmodel->check_username($query['username']);
			
			$data_login=array(
			'password'=>random_string('alnum', 8),
			);
			$upd_pwd_id = $this->Publicmodel->update_login_pwd($data_login,$login_data_user['login_id']);
			if($upd_pwd_id)
			{//mail sent with new password
			
			$send_email = $this->sendaccountdetailsemail($upd_pwd_id);
				//echo $send_email;exit;
			
			 if($login_data_user['user_type']=="po")
			 {
			
			if($send_email =='true'){
					$query['msg']='<div class="w3-text-green">Saved successfully!!! Username and Password has sent it to entered Email Id.<div>';
					 $data_po_log=array(
					'po_id'=>$login_data_user['user_id'],
					'po_action'=>"8",
					'done_ip'=>$_SERVER['REMOTE_ADDR'],
					'done_on'=>date('Y-m-d H:i:s'),
					);
					$data_po_log_id = $this->Publicmodel->po_log_attempt($data_po_log);
				}
				else
				{
					$query['msg']='<div class="w3-text-red">Mail could not  be sent<div>';
					 $data_po_log=array(
					'po_id'=>$login_data_user['user_id'],
					'po_action'=>"9",
					'done_ip'=>$_SERVER['REMOTE_ADDR'],
					'done_on'=>date('Y-m-d H:i:s'),
					);
					$data_po_log_id = $this->Publicmodel->po_log_attempt($data_po_log);
					
				}
				
				
			$data_log=array(
			'po_id'=>$login_data_user['user_id'],
			'po_action'=>"7",
			'done_ip'=>$_SERVER['REMOTE_ADDR'],
			'done_on'=>date('Y-m-d H:i:s'),
			);
			//€€€print_r($data_log);exit;
			$log_id = $this->Publicmodel->po_log_attempt($data_log); 
			 }
			 elseif($login_data_user['user_type']=="principal")
			 {
				 if($send_email =='true'){
					$query['msg']='<div class="w3-text-green">Saved successfully!!! Username and Password has sent it to entered Email Id.<div>';
					 $data_princi_log=array(
					'princi_id'=>$login_data_user['user_id'],
					'princi_action'=>"15",
					'done_ip'=>$_SERVER['REMOTE_ADDR'],
					'done_on'=>date('Y-m-d H:i:s'),
					);
					$data_princi_log_id = $this->Publicmodel->princi_log_attempt($data_princi_log);
				}
				else
				{
					$query['msg']='<div class="w3-text-red">Mail could not  be sent<div>';
					 $data_princi_log=array(
					'princi_id'=>$login_data_user['user_id'],
					'princi_action'=>"16",
					'done_ip'=>$_SERVER['REMOTE_ADDR'],
					'done_on'=>date('Y-m-d H:i:s'),
					);
					$data_princi_log_id = $this->Publicmodel->princi_log_attempt($data_princi_log);
					
				}
				
				 $data_prin_log=array(
					'princi_id'=>$login_data_user['user_id'],
					'princi_action'=>"14",
					'done_ip'=>$_SERVER['REMOTE_ADDR'],
					'done_on'=>date('Y-m-d H:i:s'),
					);
					$data_princi_log_id = $this->Publicmodel->princi_log_attempt($data_prin_log);
			 }
			 elseif($login_data_user['user_type']=="assistant")
			 {
				 $data_assi_log_attempt=array(
				'assi_id'=>'0',
				'assi_action'=>"17",
				'done_ip'=>$_SERVER['REMOTE_ADDR'],
				'done_on'=>date('Y-m-d H:i:s'),
				);
				$ins_attempt_id = $this->Publicmodel->assi_log_attempt($data_assi_log_attempt);
				
			 }
			 elseif($login_data_user['user_type']=="so")
			 {
				 if($send_email =='true'){
					$query['msg']='<div class="w3-text-green">Saved successfully!!! Username and Password has sent it to entered Email Id.<div>';
					 $data_so_log=array(
					'so_id'=>$login_data_user['user_id'],
					'so_action'=>"19",
					'done_ip'=>$_SERVER['REMOTE_ADDR'],
					'done_on'=>date('Y-m-d H:i:s'),
					);
					$data_so_log_id = $this->Publicmodel->so_log_attempt($data_so_log);
				}
				else
				{
					$query['msg']='<div class="w3-text-red">Mail could not  be sent<div>';
					 $data_so_log=array(
					'so_id'=>$login_data_user['user_id'],
					'so_action'=>"20",
					'done_ip'=>$_SERVER['REMOTE_ADDR'],
					'done_on'=>date('Y-m-d H:i:s'),
					);
					$data_so_log_id = $this->Publicmodel->so_log_attempt($data_so_log);
					
				}
				
				 $data_so_log_attempt=array(
				'so_id'=>0,
				'so_action'=>"18",
				'done_ip'=>$_SERVER['REMOTE_ADDR'],
				'done_on'=>date('Y-m-d H:i:s'),
				);
				$ins_attempt_id = $this->Publicmodel->so_log_attempt($data_so_log_attempt);
			 }
			}
			
			redirect('/Admin/NssAdmin/index');
			}
		}
		
	}
	public function account_create()	
	{	$query='';
		if($this->input->post())
		{
			 $query['dis']=$this->input->post('dis');
		 $this->load->model('Publicmodel');		
		 $query['college_list']=$this->Publicmodel->getlistcollege_dist($query['dis']);
		 
		 if($this->session->flashdata('page_message')) $query['msg']=$this->session->flashdata('page_message');
				else $query['msg']='';
				$this->form_validation->set_rules('coll', 'College Name ', 'required',array('required' => 'Please provide %s.'));
			    $this->form_validation->set_rules('email', 'Email id', 'trim|required',array('required' => 'Please provide a valid %s.'	));
			 
			 
			if ($this->form_validation->run() === FALSE)	
			{
			}
			else
			{ 
			
			$get_user_exist=$this->Publicmodel->chk_username($this->input->post('email'),$this->input->post('coll'));
			
			if($get_user_exist)
			{ 
				$query['msg']='<div style="color:#ff8080;"><strong>Warning!</strong>Credential already sent to mail id &nbsp'. $get_user_exist['username'].' . Please check spam folder of registred mail!.</div>';
				
			}
			
			else{
				if($this->input->post('coll')==94)
				{
					$query['msg1']='<div style="color:#fff;"><strong>Attention!</strong>Cannot sent content to '. $get_user_exist['username'].' . Please use another email id!.</div>';
					}
				
			$upd_id=$this->Publicmodel->upd_password($this->input->post('email'),'nss'.$this->input->post('coll'),$this->input->post('coll'));
			if($upd_id)
			{ 
				$send_email = $this->sendaccountdetailsemail($this->input->post('email'),'nss'.$this->input->post('coll'));
				if($send_email)
				{
					$query['msg']='<div style="color:#008000;"> Username and Password sent to registered Email Id</div>';
				}
				else
				{
					$query['msg']='<div style="color:#008000;"> Error!! Check the email id </div>';
				}
				
			}
			
			}
			}
		 
		 
		 
		 
		 
		}else
		{
			$this->load->model('Publicmodel');		
		 $query['college_list']=$this->Publicmodel->getlistcollege_dist('null');
		}
		
		 
        $data['span'] = $this->load->view('account_create',$query,true);
		$this->load->view('template1',$data);
	}
	
	public function aim()
	{	$data['span'] = $this->load->view('aim','',true);	
		$this->load->view('template1',$data);
	}
	
	public function pgm()
	{$data['span'] = $this->load->view('pgm','',true);	
		$this->load->view('template1',$data);
	}
	public function acti()
	{$data['span'] = $this->load->view('acti','',true);	
	$this->load->view('template1',$data);
	}
	public function sp()
	{$data['span'] = $this->load->view('sp','',true);	
		$this->load->view('template1',$data);
	}
	
	
	
	
	public function login()
	{ //echo "sd";exit;	
		if($this->input->post())
		{ 
			$uname = $this->input->post('uname');
			$pwd = $this->input->post('psw');
			
			$querylogin = $this->Publicmodel->getlogin($uname,$pwd);
			
			$this->form_validation->set_rules('math_captcha', 'Math CAPTCHA', 'required|callback__check_math_captcha');
			if ($this->form_validation->run() == FALSE)
        	{
						
				$data_login_error['captcha'] = $this->mathcaptcha->get_question();
				$data_login_error['dataact']	= $this->Publicmodel->get_upload_activity("y");	
			  	$data_login_error['login_error'] = 'wronge captcha';
				
				$data_login_attempt = array(
			'user_id'=>$uname,
			'password'=>$pwd,
			'captcha_entered'=>$this->input->post('math_captcha'),
			'actual_captcha'=>$data_login_error['captcha'] ,
			'user_ip '=>$_SERVER['REMOTE_ADDR'],
			'status'=>"fail"
			);
			
			$ins = $this->Publicmodel->add_login_attempt($data_login_attempt);
						 
			  	$data['span'] = $this->load->view('homes',$data_login_error,true);			 	
			  	$this->load->view('template1',$data);	
        	}
        	else
        	{	//echo ($this->input->post('math_captcha'));exit;
				$data_login_attempt = array(
			'user_id'=>$uname,
			'password'=>$pwd,
			'captcha_entered'=>$this->input->post('math_captcha'),
			'actual_captcha'=> $this->mathcaptcha->get_question(),
			'user_ip '=>$_SERVER['REMOTE_ADDR'],
			'status'=>"success"
			);
			//print_r($data_login_attempt);exit;
			$ins = $this->Publicmodel->add_login_attempt($data_login_attempt);	
			    if($querylogin['status']=='active')
				{    
					$this->session->login_id = $querylogin['login_id'];					
					$this->session->utype = $querylogin['user_type'];
					
					if($querylogin['user_type']=='assistant') // assistant login user login
					{
						redirect('/Admin/NssAdmin/index');
					}
					elseif($querylogin['user_type']=='principal') // Prinicipal login user login
					{ 
						
						redirect('/Princi/NssPrinci/index');
					}
					elseif($querylogin['user_type']=='po') // PO login user login
					{
						$unit_exist = $this->Publicmodel->get_unit_with_poid($querylogin['user_id']);
						if($unit_exist)
						{redirect('/Po/NssPo/index');}
						else
						{
						$data_login_error['login_error'] ="Currently you have not assigned to any Unit by the Principal";
						
						
						$data_login_error['captcha'] = $this->mathcaptcha->get_question();
			  			$data_login_error['dataact']	= $this->Publicmodel->get_upload_activity("y");	
						$data_login_attempt = array(
						'user_id'=>$uname,
						'password'=>$pwd,
						'captcha_entered'=>$this->input->post('math_captcha'),
						'actual_captcha'=>$data_login_error['captcha'] ,
						'user_ip '=>$_SERVER['REMOTE_ADDR'],
						'status'=>"fail"
						);
			
			  			$data['span'] = $this->load->view('homes',$data_login_error,true);			 	
						$this->load->view('template1',$data);
						}
					}
					elseif($querylogin['user_type']=='so')
					{ 
						redirect('/Admin/NssSo/index');
					}
					elseif($querylogin['user_type']=='admin') // Prinicipal login user login
					{ 
						
						redirect('/Admin/NssAdministrator/index');
					}
				}
			else
				{
				$data_login_error['captcha'] = $this->mathcaptcha->get_question();
			  	$data_login_error['dataact']	= $this->Publicmodel->get_upload_activity("y");	
			  	$data_login_error['login_error'] = 'Username and Password you have entered is incorrect';	
				$data_login_attempt = array(
			'user_id'=>$uname,
			'password'=>$pwd,
			'captcha_entered'=>$this->input->post('math_captcha'),
			'actual_captcha'=>$data_login_error['captcha'] ,
			'user_ip '=>$_SERVER['REMOTE_ADDR'],
			'status'=>"fail"
			);
			
			//$ins = $this->Publicmodel->add_login_attempt($data_login_attempt);		 
			  	$data['span'] = $this->load->view('homes',$data_login_error,true);			 	
			  	$this->load->view('template1',$data);
				}
			}
			
			
		}
		else
		{
			redirect(base_url().'Nsscontrol/index');
		}
	}
	
	function _check_math_captcha($str)
	{
		
    if ($this->mathcaptcha->check_answer($str))
    {
        return TRUE;
    }
    else
    {
        $this->form_validation->set_message('_check_math_captcha', 'Enter a valid math captcha response.');
        return FALSE;
    }
	}
	
	public function college_list()
	{
		$this->load->model('Publicmodel');		
		$query['college_list'] = $this->Publicmodel->getlistcollege();
		if($query['college_list'])
		{
			$data['span'] = $this->load->view('college_list',$query,true);	
			$this->load->view('template1',$data);
		}
	}
	public function college_list11() 
	{
		$this->load->model('Publicmodel');		
		$query['college_list'] = $this->Publicmodel->getlistcollege();
		if($query['college_list'])
		{
			$data['span'] = $this->load->view('college_list11',$query,true);	
			$this->load->view('template1',$data);
		}
	}
	public function list_po()
	{
		$this->load->model('Publicmodel');		
		$query['po_list'] = $this->Publicmodel->get_po('');
		//if($query['po_list'])
		//{
			$data['span'] = $this->load->view('list_po',$query,true);	
			$this->load->view('template1',$data);
		//}
	}

	
	public function blood_bank()
	{ 
		$this->load->model('Publicmodel');	
		if($this->input->post('blood'))	
		{
		$blood_group = $this->input->post('blood'); 
		$query['blood_list'] = $this->Publicmodel->get_blood_bank($blood_group);
		$data['span'] = $this->load->view('blood_bank',$query,true);	
		$this->load->view('template1',$data);
		}
		else
		{$query['blood_list'] = '';
		    $data['span'] = $this->load->view('blood_bank',$query,true);	
			$this->load->view('template1',$data);
		}
	}
	
	public function about()	
	{	$data_menu['about_link'] = "";
		if ($this->input->get('link_id'))
		  $data_menu['about_link']= $this->input->get('link_id');
		$data['span'] = $this->load->view('about',$data_menu,true);
		$this->load->view('template1',$data);
	}
	
	public function download()
	{
		$data['span'] = $this->load->view('download','',true);	
		$this->load->view('template1',$data);
	}
	
	public function faq()	
	{	
		$data['faq_data']= $this->Publicmodel->get_faq();
		//print_r($data['faq_data']);exit;
		$data['span'] = $this->load->view('faq',$data,true);	
		$this->load->view('template1',$data);
	}
	public function awards()	
	{	
		//$data['faq_data']= $this->Publicmodel->get_faq();
		//print_r($data['faq_data']);exit;
		$data['span'] = $this->load->view('awards','',true);	
		$this->load->view('template1',$data);
	}
	
	public function gallery()	
	{	
	    $data['span'] = $this->load->view('gallery','',true);	
		$this->load->view('template1',$data);
	}
	
	public function sc()
	{
		$data['span'] = $this->load->view('sc','',true);	
		$this->load->view('template1',$data);
	}
	
	public function contact()	
	{			
		$data['span'] = $this->load->view('contact','',true);	
		$this->load->view('template1',$data);
	}

	public function valid_uname($uname)
	{
		$check_id = $this->Publicmodel->check_username($uname);
		if($check_id)
		return true;
		else
		return false;
	}
		public function sendaccountdetailsemail($us,$pa)
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
	
		 
		$message="<h4>Dear ".$us.",</h4><h4>Welcome to Mahatma Gandhi University Online National Service Scheme Portal.</h4>";
						$message=$message."<table border='1' cellspacing='0' cellpadding='10'><tr bgcolor='#099' color='white'><td align='center'><b>Your Login credentials are,</b></td></tr><tr><td>";
						$message=$message."<table cellspacing='10' cellpadding='0'>
									<tr><th align='left'>User Id</th><td>:</td><td>".$us."</td></tr>
									<tr><th align='left'>Password</th><td>:</td><td>".$pa."</td></tr>
									<tr><th align='left'>Website</th><td>:</td><td>".base_url('Nsscontrol/index')."</td></tr>
									</table></td></tr></table>";
									
		
		$to_email	= $us;

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
					'username'=>$us,
					'status'=>"success",
					);
					$data_princi_log_id = $this->Publicmodel->mail_track($data_prin_log);
		
			return true;
		}
		else
		{
			 $data_prin_log=array(
					'username'=>$us,
					'status'=>"fail",
					);
					//print_r($data_prin_log);exit;
					$data_princi_log_id = $this->Publicmodel->mail_track($data_prin_log);
			return false;
		}
	}

	
}
