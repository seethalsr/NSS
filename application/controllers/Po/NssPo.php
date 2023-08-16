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
		$querypo['college_id']= $this->session->userdata('college_id');	
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
			$this->form_validation->set_rules('stud_no', 'No: of Volunteers (Max : 50/100) depending upond the college unit', 'numeric|required|less_than[101]',array('required' => 'Please Enter  %s'));
			if ($this->form_validation->run() === FALSE)						
			$querypo['msg']= "Please Enter No: of Volunteers (Max : 50/100) depending upon the college unit";						
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
			$this->form_validation->set_rules('name_'.$i, 'Name', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('admyear_'.$i, 'Admission Year', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('spl_'.$i, 'Specialisation display Name', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('gender_'.$i, 'Gender', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('cast_'.$i, 'Reservation', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('enrolled_date_'.$i, 'enroll date', 'required',array('required' => 'Please Enter  %s'));
			$this->form_validation->set_rules('enroll_end_'.$i, 'enroll end date', 'required',array('required' => 'Please Enter  %s'));
			
			if ($this->form_validation->run() === FALSE)
			{	
					
			$querypo['msg']= "PLEASE FILL THE REQUIRED FIELDS ( Mandatory fields are Name, Admission year, Name of the Programme with Specialisation/Major Subject,gender, Reservation, Enroll start date and end date)";		
			
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
		//print_r($querypo);exit;
		
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);
		$querypo['adminspan3'] = $this->load->view('po/stud_list',$querypo);	
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
		/*if($querypo['college_id']=='213')
		{
		print_r($querypo['stud_det']);exit;	
		}*/
		if($this->input->post('upd'))
		{
			
		//  print_r($this->input->post());
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
		  'splcamp'=> $this->input->post('splcamp'),
		  'tot_hr'=> $this->input->post('tot_hr'),
		  'enroll_end'=> date("Y-m-d", strtotime(  $this->input->post('end_enrolled_date'))),
		  'splcamp_start'=> date("Y-m-d", strtotime(  $this->input->post('spl_start'))), 
		  'splcamp_end'=> date("Y-m-d", strtotime(  $this->input->post('spl_end'))), 
		  'spl_desti'=> $this->input->post('spl_desti'),
		  'enrolled_date'=>date("Y-m-d", strtotime(  $this->input->post('start_enrolled_date'))),  
		  
		 
		  );
		  
		/* if($querypo['college_id']=='213')
		{
		print_r($upd_data);exit;	
		}*/
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
			$querypo['stud_det'] = $this->Publicmodel->get_stud_det($id);
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
			//���print_r($data_log);exit;
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
	
	public function edit_elig_final()
	{	$querypo['main_menu']="elig";
		$querypo['sub_menu']="edit_elig";
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['po_unit']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		
		$querypo['elig']=$this->Publicmodel->get_elig_finnnn($querypo['college_id'],$querypo['po_unit'],$querypo['batch_period']);
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
		
		$enroll_stud_p= $this->Publicmodel->get_enroll_stud_detail($data);
		}
		if(isset($enroll_stud_p))
		$enroll_stud_p_id = array_column($enroll_stud_p,'nss_stud_id');
		
		if(isset($querypo['enroll_list']))
		{// for the color scheme (blue)2= fwd to princi green)3,4,6 = fwd to uni (red)5= rej by uni  (red)7 = rej princi
			$querypo['check_veri'] = array_column($querypo['enroll_list'],'verification_id');
		}
			//template		
		$this->load->view('po/view_edit_elig',$querypo);	
	}
	
	public function edit_elig()
	{
		
			$querypo['main_menu']="elig";
	    $querypo['sub_menu']="create_elig";
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['unit']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		if($querypo['college_id']=='70')
			{echo'Wait for Some Time';print_r($this->input->post('save'));exit;
			}
			
		$querypo['elig']=$this->Publicmodel->get_elig($querypo['college_id'],$querypo['unit'],$querypo['batch_period']);
		if($this->input->post('save'))
		{
 			
			//print_r($this->input->post( ));exit;
			for($i=0;$i<$this->input->post('cc');$i++)
			{
				$data_update[$i]=array(
				'nss_stud_id'=> $this->input->post('nss_stud_id_'.$i),
				'account_id'=>$this->input->post('prn_'.$i),
				'admission_year'=>$this->input->post('admyear_'.$i),
				'account_student_name'=>$this->input->post('name_'.$i),
				'specialisation_id'=>$this->input->post('spl_'.$i),
				'gender'=>$this->input->post('gender_'.$i),
				'cast'=>$this->input->post('cast_'.$i),
				'enrolled_date'=> date("Y-m-d", strtotime( $this->input->post('enrolled_date_'.$i))) ,
				'mini1'=>$this->input->post('mini1_'.$i),
				'mini2'=>$this->input->post('mini2_'.$i),
				'splcamp'=>$this->input->post('splcamp_'.$i),
				'tot_hr'=>$this->input->post('tot_hr_'.$i),
				'enroll_end'=>date("Y-m-d", strtotime( $this->input->post('enroll_end_'.$i)))  ,
				'splcamp_start'=>date("Y-m-d", strtotime( $this->input->post('splcamp_start_'.$i)))   ,
				'splcamp_end'=>date("Y-m-d", strtotime( $this->input->post('splcamp_end_'.$i)))    ,
				'spl_desti'=>$this->input->post('spl_desti_'.$i),
				);
			}
			
			
			
			$this->Publicmodel->update_batch_eligedit($data_update);
		}
		$querypo['elig']=$this->Publicmodel->get_elig($querypo['college_id'],$querypo['unit'],$querypo['batch_period']);
		$this->load->view('po/edit_elig',$querypo);
	}
	
	public function view_elig()
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
		//prepare the elig report
		$this->Publicmodel->prepareelig($querypo['college_id'],$querypo['batch_period'],$querypo['unit'] );
		$querypo['eli_det']=$this->Publicmodel->get_elig_rep_certi($querypo['college_id'],$querypo['batch_period'],$querypo['unit'] );
		//echo'aaaa';exit;
		if($this->input->post('ver'))
		{//echo'aa';exit;
			$this->Publicmodel->update_verify_po($querypo['college_id'],$querypo['unit'],$querypo['batch_period']);
		}
		$querypo['eli_det']=$this->Publicmodel->get_elig_rep_certi($querypo['college_id'],$querypo['batch_period'],$querypo['unit'] );
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['adminspan3'] = $this->load->view('po/po_eligibility_rep',$querypo,true);	
		$this->load->view('common_template',$querypo);
		
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
		$this->Publicmodel->prepare_elig_rep($querypo['college_id'],$querypo['batch_period'],$querypo['unit']);
		
		$querypo['eli_det'] = $this->Publicmodel->get_elig_rep($querypo['college_id'],$querypo['batch_period'],$querypo['unit']);
		$querypo['adminspan1'] = $this->load->view('common_sidebar',$querypo,true);
		$querypo['adminspan2'] = $this->load->view('common_template_topbar','',true);	
		$querypo['adminspan3'] = $this->load->view('po/po_eligibility_rep_fin',$querypo,true);	
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
			//$seccode=$id*7;
		$code = md5($data['student_details']['nss_stud_id']*7) ; //exit;
	//print_r($data['student_details']['nss_enroll_id']);exit;
			// QRCODE,M : QR-CODE Medium error correction
		$pdf->SetFont("dejavusans", "", 10);
			//$pdf->write2DBarcode($code, 'QRCODE,M', 190, 06, 12, 12, $style, 'N');
			//$pdf->Text(20, 60, 'Security Code: '.$security_code);
			//$pdf->Text(20, 70, 'Certificate No.: '.$code);
			//QR code for verification . redirecting to site
			// QRCODE,M : QR-CODE Medium error correction
		$pdf->write2DBarcode(base_url().'VerifyCertificate/verify_certificate_view/'.$data['student_details']['nss_enroll_id'].'/'.$code, 'QRCODE,M', 250, 150, 25, 25, $style, 'N');
			//$pdf->write2DBarcode('www.google.com', 'QRCODE,M', 177, 260, 50, 50, $style, 'N');
		$pdf->Text(20, 190, 'NB: Authenticity of this document can be verified by scanning the QR code or can visit the following link :'. base_url("VerifyCertificate") );
    	$pdf->Output('certificate.pdf', 'I'); 
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
	public function elig_print()
	{
		$querypo['po_id'] = $this->session->userdata('user_id');
		$querypo['unit_list']   = $this->session->userdata('po_unit');
		$querypo['college_name']= $this->session->userdata('college_name');	
		$querypo['college_id']  = $this->session->userdata('college_id');	
		$querypo['name']        =  $this->session->userdata('name');
		$querypo['unit']   = $this->session->userdata('po_unit');
		$querypo['batch_period']   = $this->session->userdata('po_batch_period');
		$querypo['user_type']    = $this->session->userdata('user_type');
		
		$data['eli_det']=$this->Publicmodel->get_elig_rep_certi($querypo['college_id'],$querypo['batch_period'],'' );
		//print_r();exit;
		$this->load->library('Pdf');
			//$pdf = new Pdf('L', 'mm', array(200,97), true, 'UTF-8', false);
		$pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('Eligiblity Print ');
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
		//$pdf->SetAutoPageBreak(false, 0);
		$html = $this->load->view('po/elig_print', $data, true);
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
		//$pdf->Text($myX, $myY,"Mahatma Gandhi University"); 
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
			//$seccode=$id*7;
		//$code = md5($data['student_details']['nss_stud_id']*7) ; //exit;
	//print_r($data['student_details']['nss_enroll_id']);exit;
			// QRCODE,M : QR-CODE Medium error correction
		$pdf->SetFont("dejavusans", "", 10);
			//$pdf->write2DBarcode($code, 'QRCODE,M', 190, 06, 12, 12, $style, 'N');
			//$pdf->Text(20, 60, 'Security Code: '.$security_code);
			//$pdf->Text(20, 70, 'Certificate No.: '.$code);
			//QR code for verification . redirecting to site
			// QRCODE,M : QR-CODE Medium error correction
		//$pdf->write2DBarcode(base_url().'VerifyCertificate/verify_certificate_view/'.$data['student_details']['nss_enroll_id'].'/'.$code, 'QRCODE,M', 250, 150, 25, 25, $style, 'N');
			//$pdf->write2DBarcode('www.google.com', 'QRCODE,M', 177, 260, 50, 50, $style, 'N');
		//$pdf->Text(20, 190, 'NB: Authenticity of this document can be verified by scanning the QR code or can visit the following link :'. base_url("VerifyCertificate") );
    	$pdf->Output('certificate.pdf', 'I'); 
	
		
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
