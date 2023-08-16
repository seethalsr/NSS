<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NssSo extends CI_Controller 
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
		$this->session->name = $login_detail['username'];
		$this->session->college_id = $login_detail['college_id'];
		$this->session->user_type = $login_detail['user_type'];
    }
	public function index()
	{ 
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'M G UNIVERSITY';
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['adminspan3'] = $this->load->view('po/po_body','',true);	
		$this->load->view('common_template',$queryadmin);
	}
	public function verify_eli_list()
	{
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'M G UNIVERSITY';
		$queryso['main_menu']="eligso";
		$queryso['sub_menu']="";
		
		$queryadmin['enroll_list']=$this->Publicmodel->get_verified_elig_list();
		
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['adminspan3'] = $this->load->view('so/verify_eli_list','',true);	
		$this->load->view('common_template',$queryadmin);
		
	}
	public function so_manage()
	{
		$queryso['msg']="";
		$queryso['user_type'] = $this->session->userdata('user_type');
		$queryso['name']= $this->session->userdata('name');
		$queryso['college_name'] = 'M G UNIVERSITY';
		$queryso['get_data_manage'] = $this->Publicmodel->get_data_manage_enroll(date('Y'));
		if($queryso['get_data_manage'])
		{
			$queryso['verification_id'] = $queryso['get_data_manage']['verification_id'];
			if($this->input->post('accso'))
			{	$queryso['verification_id'] = 3;
				$remarks = '';
				$upd_id1 = $this->Publicmodel->upd_manage_enroll_date(date('Y'),$queryso['verification_id'],$remarks);
				$queryso['upd_id'] = 1;
			}
			elseif($this->input->post('rejsosubmit'))
			{	$queryso['verification_id'] = 4;
				$remarks = $this->input->post('remarktxt1');
				$upd_id = $this->Publicmodel->upd_manage_enroll_date(date('Y'),$queryso['verification_id'],$remarks);
			}
			elseif($this->input->post('extend'))
			{	$remarks = '';
				$ver_id = 'extend';
				$upd_id = $this->Publicmodel->upd_manage_enroll_date(date('Y'),$ver_id,$remarks);
				$queryso['get_data_manage'] = $this->Publicmodel->get_data_manage_enroll(date('Y'));
				if($queryso['get_data_manage'])
				$queryso['verification_id'] = $queryso['get_data_manage']['verification_id'];
			}
		}
		else
		{
			$queryso['verification_id'] = 0;
		}
		$queryso['adminspan1'] = $this->load->view('common_sidebar',$queryso,true);
		$queryso['adminspan2'] = $this->load->view('common_template_topbar',$queryso,true);	
		$queryso['adminspan3'] = $this->load->view('so/so_manage',$queryso,true);	
		$this->load->view('common_template',$queryso);	
	}
   public function so_v_enroll_list()
	{
		$queryso['msg']="";
		$queryso['user_type'] = $this->session->userdata('user_type');
		$queryso['name']= $this->session->userdata('name');
		$queryso['college_name'] = 'M G UNIVERSITY';
		$queryso['main_menu']="enroll";
		$ver_id= array('2R','3','3R','4');
		$queryso['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)
		{
		$queryso['college_name_sel'] = $this->Publicmodel->getlistcollege_dist($type);
		$college_name_sel = $this->input->post('name');
		if($college_name_sel)
		{
			$queryso['batch_list']=$this->Publicmodel->princi_batch_period($college_name_sel);
			if(empty($queryso['batch_list'])) $queryso['msg']="NO DATA FOUND";
			$queryso['sel_batch'] = $this->input->post('batch');
			if($queryso['sel_batch'])
			{
			$queryso['unit_list']= $this->Publicmodel->get_unit_from_batch($college_name_sel,$queryso['sel_batch']);
			$queryso['sel_unit']=$this->input->post('unit');
			if(empty($queryso['unit_list'])){
						$queryso['msg'] = "Unit is not created for the this College";}
					elseif($queryso['sel_unit']){
							$data_enroll_stud_det = array(
							'nss_unit'=>$queryso['sel_unit'],
							'college_id'=>$college_name_sel,
							'ver_id'=>$ver_id,
							'batch_period'=>$queryso['sel_batch'],
							);
							$queryso['enroll_list']= $this->Publicmodel->get_enroll_stud_detail($data_enroll_stud_det);
							$queryso['count_stud'] = count($queryso['enroll_list']);
			if($this->input->post('acc'))
			{
				if($queryso['enroll_list'])
				{
						$enroll_stud_p_id = array_column($queryso['enroll_list'],'nss_stud_id');
						$ver_id_prin = '3';
						$data_fwd_so=array(
						'college_id'=>$college_name_sel,
						'batch_period'=>$queryso['sel_batch'],
						'nss_enroll_unit'=>$queryso['sel_unit'],
						'verification_id'=>'4',
						);
						$fwd = $this->Publicmodel->fwd_to_so($data_fwd_so,$enroll_stud_p_id );
						if($fwd)
						{
						$data_upd_unit=array(
						'college_id'=>$college_name_sel,
						'batch_period'=>$queryso['sel_batch'],
						'nss_unit_id'=>$queryso['sel_unit'],
						'total_stud'=> count($enroll_stud_p_id),
						);
						$upd_unit = $this->Publicmodel->update_total_stud($data_upd_unit);
		 				$queryso['msg']= "Accepted by University ";
						$data_log=array(
							'so_id'=>$this->session->userdata('user_id'),
							'so_action'=>"2",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->so_log_attempt($data_log);
						
						$data_enroll_stud_det = array(
							'nss_unit'=>$queryso['sel_unit'],
							'college_id'=>$college_name_sel,
							'ver_id'=>$ver_id,
							'batch_period'=>$queryso['sel_batch'],
							);
						$queryso['enroll_list']= $this->Publicmodel->get_enroll_stud_detail($data_enroll_stud_det);
						$queryso['count_stud'] = count($queryso['enroll_list']);
						}
				}
			}
			elseif($this->input->post('rejsosubmit'))
			{
				$reson = $this->input->post('remarktxt1');
				$enroll_stud_p_id = array_column($queryso['enroll_list'],'nss_stud_id');
				$data_rej_assi=array(
				'college_id'=>$college_name_sel,
				'batch_period'=>$queryso['sel_batch'],
				'nss_enroll_unit'=>$queryso['sel_unit'],
				'verification_id'=>'3R',
				'nss_enroll_id'=>'',
				'remarks'=>$reson,
				);
				$upd_id_re = $this->Publicmodel->rej_assi($data_rej_assi,$enroll_stud_p_id);
				if($upd_id_re)
				{ 
				echo '<script>alert("Rejected by SO");</script>';
				$data_log=array(
							'so_id'=>$this->session->userdata('user_id'),
							'so_action'=>"11",
							'done_ip'=>$_SERVER['REMOTE_ADDR'],
							'done_on'=>date('Y-m-d H:i:s'),
							);
							$log_id = $this->Publicmodel->so_log_attempt($data_log);
				}
			}
			$queryso['enroll_list']= $this->Publicmodel->get_enroll_stud_detail($data_enroll_stud_det);
			$queryso['count_stud'] = count($queryso['enroll_list']);
		}
		}
		}
		}
		$queryso['adminspan1'] = $this->load->view('common_sidebar',$queryso,true);
		$queryso['adminspan2'] = $this->load->view('common_template_topbar',$queryso,true);	
		$queryso['adminspan3'] = $this->load->view('so/so_v_enroll_list',$queryso,true);	
		$this->load->view('common_template',$queryso);	
	}
	public function so_v_m_attendance()
	{
		$queryso['msg']="";
		$queryso['main_menu']="atten";
		$queryso['user_type'] = $this->session->userdata('user_type');
		$queryso['name']= $this->session->userdata('name');
		$queryso['college_name'] = 'M G UNIVERSITY';
		$ver_id= array('3','3R','4');
		$queryso['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)
		{
		$queryso['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
		$college_name_sel = $this->input->post('name');
		if($college_name_sel)
		{
			$queryso['batch_list']=$this->Publicmodel->princi_batch_period($college_name_sel);
			if(empty($queryso['batch_list'])) $queryso['msg']="NO DATA FOUND";
			$queryso['sel_batch'] = $this->input->post('batch');
			if($queryso['sel_batch'])
			{
			$queryso['unit_list']= $this->Publicmodel->get_unit_from_batch($college_name_sel,$queryso['sel_batch']);
			$queryso['sel_unit']=$this->input->post('unit');
			if(empty($queryso['unit_list'])){
				$queryso['msg'] = "Unit is not created for  this College";}
			elseif($queryso['sel_unit']){
				$queryso['sel'] = $this->input->post('get_data');
			if($this->input->post('get_data'))
			{
				if($queryso['sel'] == "Y" || $queryso['sel'] == "M")
				$queryso['year_db'] =$this->Publicmodel->get_mo_atten_year($college_name_sel,$queryso['sel_batch'],$queryso['sel_unit']);
				if($this->input->post())
				{
				$queryso['sel_year'] = $this->input->post('get_year') ;
				$queryso['sel_month']= $this->input->post('get_month');
				$queryso['sel_date']= $this->input->post('date');
				$detail_p= array(
				'college_id'=>$college_name_sel,
				'batch_period' =>$queryso['sel_batch'],
				'unit'=> $queryso['sel_unit'],
				'year'=> $this->input->post('get_year'),
				'month'=>$this->input->post('get_month'),
				'date'=>  date("Y-m-d", strtotime($this->input->post('date'))),
				);
				$queryso['month_view_data_uni'] = $this->Publicmodel->get_view_atten_fwd_prin($detail_p,"3");
			if($this->input->post('fwd_uni')&& !empty($queryso['month_view_data_uni']))
			{ 
			$atten_id = array_column($queryso['month_view_data_uni'],'m_attendance_id');
			$upd_fwd_p = $this->Publicmodel->fwd_prin_atten($atten_id,"4");
			if($upd_fwd_p)
			{
			
			$queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY ACCEPTED</h4>';
			}
			}
			if($this->input->post('rejprincisubmit')&& !empty($queryso['month_view_data_uni']))
			{ 
			$atten_id = array_column($queryso['month_view_data_uni'],'m_attendance_id');
			$datarej=array(
			'ver_id'=>'3R',
			'remark'=>$this->input->post('remarktxt1'),
			);
			$upd_fwd_p = $this->Publicmodel->rej_prin_atten($atten_id,$datarej);
			if($upd_fwd_p)
			{
			 
			$queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY ASSISTANT</h4>';
			}
			}
			$queryso['month_view_data_uni'] = $this->Publicmodel->get_view_atten_fwd_prin($detail_p,"3");
			$queryso['month_view_data_atten_rejuni'] = $this->Publicmodel->get_view_atten_fwd_prin($detail_p,"3R");
		    $queryso['month_view_data_atten_uni'] = $this->Publicmodel->get_view_atten_fwd_prin($detail_p,"4");
			}}
			}
			}
		}
		}
		$queryso['adminspan1'] = $this->load->view('common_sidebar',$queryso,true);
		$queryso['adminspan2'] = $this->load->view('common_template_topbar',$queryso,true);	
		$queryso['adminspan3'] = $this->load->view('so/so_v_m_attendance',$queryso,true);	
		$this->load->view('common_template',$queryso);
	}
	public function camp()
	{
		$queryso['msg']="";
		$queryso['user_type'] = $this->session->userdata('user_type');
		$queryso['main_menu']="camp";
		$queryso['name']= $this->session->userdata('name');
		$queryso['college_name'] = 'M G UNIVERSITY';
		$ver_id= array('2','2R','3','3R','4');
		$queryso['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)
		{
		$queryso['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
		$college_name_sel = $this->input->post('name');
		if($college_name_sel)
		{
			$queryso['batch_list']=$this->Publicmodel->princi_batch_period($college_name_sel);
			if(empty($queryso['batch_list']))  $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">NO DATA FOUND</h4>';
			$queryso['sel_batch'] = $this->input->post('batch');
			if($queryso['sel_batch'])
			{
			$queryso['unit_list']= $this->Publicmodel->get_unit_from_batch($college_name_sel,$queryso['sel_batch']);
			$queryso['sel_unit']=$this->input->post('unit');
			if(empty($queryso['unit_list'])){
				 $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">UNIT IS NOT CREATED FOR THE THIS COLLEGE</h4>';}
			elseif($queryso['sel_unit']){
			if($this->input->post()){
			$ver_id=array("3","3R","4");
			$queryso['detail']= array(
			'college_id'=>$college_name_sel,
			'batch_period' =>$queryso['sel_batch'],
			'unit'=> $queryso['sel_unit'],	
			'sel_camp_type'=>$this->input->post('get_camp'),
			'veri_id'=>$ver_id,
			);
			$queryso['camp_detail'] = $this->Publicmodel->get_camp_date($queryso['detail']);
			if(isset($queryso['camp_detail'][0]['nss_camp_type']))
			$queryso['sub'] = 1;// show the table if value exist
			if($this->input->post('fwdtoassi')&& !empty($queryso['camp_detail']))
			{ 
			$id = $queryso['camp_detail'][0]['nss_camp_id'];
			$upd_fwd_p = $this->Publicmodel->fwd_prin_camp($id,"4");
			if($upd_fwd_p)
			{
			 
			$queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY ACCEPTED BY SO</h4>';
			}
			}
			if($this->input->post('rejprincisubmit')&& !empty($queryso['camp_detail']))
			{ 
			$atten_id = $queryso['camp_detail'][0]['nss_camp_id'];
			$datarej=array(
			'ver_id'=>'3R',
			'remark'=>$this->input->post('remarktxt1'),
			);
			$upd_fwd_p = $this->Publicmodel->rej_prin_atten($atten_id,$datarej);
			if($upd_fwd_p)
			{
			 
			$queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY SO</h4>';
			}
			}
			$queryso['camp_detail'] = $this->Publicmodel->get_camp_date($queryso['detail']);
			}
		}}}}
		$queryso['adminspan1'] = $this->load->view('common_sidebar',$queryso,true);
		$queryso['adminspan2'] = $this->load->view('common_template_topbar',$queryso,true);	
		$queryso['adminspan3'] = $this->load->view('so/camp',$queryso,true);	
		$this->load->view('common_template',$queryso);
	}
	public function monthly_report()
	{
		$queryso['msg']="";
		$queryso['user_type'] = $this->session->userdata('user_type');
		$queryso['name']= $this->session->userdata('name');
		$queryso['college_name'] = 'M G UNIVERSITY';
		$queryso['main_menu']="month";
		$queryso['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)
		{
		$queryso['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
		$college_name_sel = $this->input->post('name');
		if($college_name_sel)
		{
			$queryso['batch_list']=$this->Publicmodel->princi_batch_period($college_name_sel);
			if(empty($queryso['batch_list'])) $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">NO DATA FOUND</h4>';
			$queryso['sel_batch'] = $this->input->post('batch');
			if($queryso['sel_batch'])
			{
			$queryso['unit_list']= $this->Publicmodel->get_unit_from_batch($college_name_sel,$queryso['sel_batch']);
			$queryso['sel_unit']=$this->input->post('unit');
			
			if(empty($queryso['unit_list']))
			{
			 $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">UNIT IS NOT CREATED FOR  THIS COLLEGE</h4>';}
			elseif($queryso['sel_unit'])
			{
			$queryso['get_yrs'] = $this->Publicmodel->get_yrs_monthly_report($college_name_sel);
			if($this->input->post('year'))
		    {
			 $queryso['year_sel'] = $this->input->post('year');
		   }
		//month selected
		if($this->input->post('month'))
		{
			if(empty($queryso['year_sel'] ))
			echo '<script>alert("SELECT YEAR");</script>';
			elseif(date('Y') == $this->input->post('year') && date('m')>=$this->input->post('month') )
			$flag_ok = '1';
			elseif(date('Y')!= $this->input->post('year'))
			$flag_ok = '1';
			else
			echo '<script>alert("SELECT MONTH LESS THAN CURRENT MONTH");</script>';
			if(isset($flag_ok)){
			 $queryso['month_sel_n']= $this->input->post('month');	
			 $queryso['month_sel']=date('F', mktime(0, 0, 0, $queryso['month_sel_n'], 10));
			 $data_fde = array(
				'college_id' => $college_name_sel,
				'nss_unit' => $queryso['sel_unit'],
				'batch_period' => $queryso['sel_batch'],
				'year' => $this->input->post('year'),
				'month' => $this->input->post('month'),
				);
			 $queryso['monthly_report_data'] = $this->Publicmodel->get_mothly_report($data_fde);
			}
			}
			if($this->input->post('fwdtoassi')&& isset($queryso['monthly_report_data'])&& !empty($queryso['monthly_report_data']))
			{
				$data_m_r = array(
				'college_id'=>$college_name_sel,
				'batch_period'=>$queryso['sel_batch'],
				'nss_unit'=>$queryso['sel_unit'],
				'month'=>$this->input->post('month'),
				'year'=> $this->input->post('year'),
				'verification_id'=>"4",
				);
				$up_mr=$this->Publicmodel->fwd_ass_mon_rep($data_m_r );
				if($up_mr)
				{ $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">ACCEPTED BY SO</h4>';}
			}
			if($this->input->post('rejprincisubmit')&& isset($queryso['monthly_report_data'])&& !empty($queryso['monthly_report_data']))
			{
			$data_m_r = array(
				'college_id'=>$queryso['college_id'],
				'batch_period'=>$queryso['sel_batch'],
				'nss_unit'=>$queryso['sel_unit'],
				'month'=>$this->input->post('month'),
				'year'=> $this->input->post('year'),
				'verification_id'=>"3R",
				'remark'=>$this->input->post('remarktxt1'),
				);
				$up_mr=$this->Publicmodel->rej_ass_mon_rep($data_m_r );
				if($up_mr)
				{ $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY SO</h4>';}
			}
			if(isset($data_fde))
						 $queryso['monthly_report_data'] = $this->Publicmodel->get_mothly_report($data_fde);
			}
		}
		}
		}
		$queryso['adminspan1'] = $this->load->view('common_sidebar',$queryso,true);
		$queryso['adminspan2'] = $this->load->view('common_template_topbar',$queryso,true);	
		$queryso['adminspan3'] = $this->load->view('so/monthly_report',$queryso,true);	
		$this->load->view('common_template',$queryso);
	}
	public function fund_report()
	{
		$queryso['user_type'] = $this->session->userdata('user_type');
		$queryso['name']= $this->session->userdata('name');
		$queryso['college_name'] = 'M G UNIVERSITY';
		$queryso['main_menu']="fund";
		$queryso['sub_menu']="fund_report";
		$queryso['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
	    if($type)
		{
		$queryso['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
		$college_name_sel = $this->input->post('name');
		$queryso['college_id']=$college_name_sel;
		if($college_name_sel)
		{	$queryso['nss_fund_list']= $this->Publicmodel->get_fund_last5($college_name_sel);
			if($this->input->post('fwdassi')&&!empty($queryso['nss_fund_list']))
		{
			$upd_fwd_p = $this->Publicmodel->fwd_assi_fund_so($queryso['college_id'],"4");
			if($upd_fwd_p)
			{
			 $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY FORWARDED TO UNIVERSITY</h4>';
			}
		}
		if($this->input->post('rejprincisubmit')&& !empty($queryso['nss_fund_list']))
		{ 
			$datarej=array(
			'ver_id'=>'3R',
			'remark'=>$this->input->post('remarktxt1'),
			);
			$upd_fwd_p = $this->Publicmodel->rej_assi_fund_so($queryso['college_id'],$datarej);
			if($upd_fwd_p)
			{
			 $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY PRINCIPAL</h4>';
			}
		}
		$queryso['nss_fund_list']= $this->Publicmodel->get_fund_last5($college_name_sel);	
		}
		}
		$queryso['adminspan1'] = $this->load->view('common_sidebar',$queryso,true);
		$queryso['adminspan2'] = $this->load->view('common_template_topbar',$queryso,true);	
		$queryso['adminspan3'] = $this->load->view('so/view_fund',$queryso,true);	
		$this->load->view('common_template',$queryso);
	}
	public function audit_report()
	{
		$queryso['user_type'] = $this->session->userdata('user_type');
		$queryso['name']= $this->session->userdata('name');
		$queryso['college_name'] = 'M G UNIVERSITY';
		$queryso['main_menu']="audit";
		$queryso['sub_menu']="";
		$queryso['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)		
		{
		   $queryso['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
		   $college_name_sel = $this->input->post('name');// echo $college_name_sel;exit;
		   $queryso['college_id_sel']= $college_name_sel;
		}
		$queryso['year'] = $this->input->post('year');
		if($queryso['year'])
		{	
			$data_get_audit_year=array(
			'college_id'=>$college_name_sel,
			'year'=>$queryso['year'],
			);
		$queryso['audit_det']=$this->Publicmodel->get_audit_year($data_get_audit_year);
		if(empty($queryso['audit_det']))  $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">NO DATA FOUND</h4>';
		if($this->input->post('rejassiisubmit'))
		{
			$data_audit_admin=array(
			'remark'=>$this->input->post('remarktxt1'),
			'id'=>array_column($queryso['audit_det'],'nss_audit_id'),
			'ver_id'=>'3R',
			'year'=>$queryso['year'],
			);
			$upd= $this->Publicmodel->audit_admin($data_audit_admin);
			if($upd)
			 $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY SO</h4>';
		}
		elseif($this->input->post('fwdso'))
		{
			$data_audit_admin=array(
			'remark'=>'',
			'id'=>array_column($queryso['audit_det'],'nss_audit_id'),
			'ver_id'=>'4',
			'year'=>$queryso['year'],
			);
			$upd = $this->Publicmodel->audit_admin($data_audit_admin);
			if($upd)
			 $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">ACCEPTED BY SO</h4>';
		}
		$queryso['audit_det']=$this->Publicmodel->get_audit_year($data_get_audit_year);	
		}
		$queryso['adminspan1'] = $this->load->view('common_sidebar',$queryso,true);
		$queryso['adminspan2'] = $this->load->view('common_template_topbar',$queryso,true);	
		$queryso['adminspan3'] = $this->load->view('so/audit_report',$queryso,true);	
		$this->load->view('common_template',$queryso);
	}
	public function fund_govt()
	{
		$queryso['msg']="";
		$queryso['main_menu']="fund";
		$queryso['sub_menu']="fund_govt";
		$queryso['user_type'] = $this->session->userdata('user_type');
		$queryso['name']= $this->session->userdata('name');
		$queryso['college_name'] = 'M G UNIVERSITY';
		$queryso['fund_gov_data']=$this->Publicmodel->get_fund_gov();
		$queryso['fund_gov_data_yr']=$this->Publicmodel->get_fund_gov_year(date('Y'));
		if($this->input->post('accso'))
		{
			$data_fund_gov = array(
			'ver_id'=>'4',
			'remarks'=>'',
			'id'=>$queryso['fund_gov_data_yr']['nss_fund_govt_id'],
			);
			$upd = $this->Publicmodel->update_fund_gov($data_fund_gov);
			if($upd)
			 $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY ACCEPTED BY SO</h4>';
		}
		elseif($this->input->post('rejso'))
		{
		$this->form_validation->set_rules('remarktxt1', 'rejection', 'required',array('required' => 'Please enter reason for %s.'));
		if ($this->form_validation->run() === FALSE)						
			 	$queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">PLEASE FILL THE REASON FOR REJECTION</h4>';					
		else
			{
			$data_fund_gov = array(
			'ver_id'=>'3R',
			'remarks'=>$this->input->post('remarktxt1'),
			'id'=>$queryso['fund_gov_data_yr']['nss_fund_govt_id'],
			);
			$upd = $this->Publicmodel->update_fund_gov($data_fund_gov);
			if($upd)
		 $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESSFULLY REJECTED BY SO</h4>';	}
		}
		$queryso['fund_gov_data']=$this->Publicmodel->get_fund_gov();
		$queryso['fund_gov_data_yr']=$this->Publicmodel->get_fund_gov_year(date('Y'));
		$queryso['adminspan1'] = $this->load->view('common_sidebar',$queryso,true);
		$queryso['adminspan2'] = $this->load->view('common_template_topbar',$queryso,true);	
		$queryso['adminspan3'] = $this->load->view('so/fund_govt',$queryso,true);	
		$this->load->view('common_template',$queryso);		
	}
	public function view_sanc_fund()
	{
		$queryso['main_menu']="fund";
		$queryso['sub_menu']="sanc_fund";
		$queryso['msg']="";
		$queryso['user_type'] = $this->session->userdata('user_type');
		$queryso['name']= $this->session->userdata('name');
		$queryso['college_name'] = 'M G UNIVERSITY';
		$queryso['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$queryso['year_list'] = $this->Publicmodel->get_year_fund();
		$queryso['sel'] = array(
		'type'=>$this->input->post('type'),
		'year'=>$this->input->post('year'),
		);
		if(!empty($queryso['sel']))
		{
			$queryso['college_list'] = $this->Publicmodel->get_college_fund_sanc_list($queryso['sel']);
			if(empty($queryso['college_list']))  $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">NO DATA FOUND</h4>';
			$nss_fund_sanc_id = $this->uri->segment(4);
			if(!empty($nss_fund_sanc_id ))
			{	
				$inactive_id = $this->Publicmodel->remove_fund_sanc_col($nss_fund_sanc_id);
				if($inactive_id)
				{
					$queryso['sel'] = array(
					'type'=>$this->uri->segment(6),
					'year'=>$this->uri->segment(5),
					);
				$queryso['college_list'] = $this->Publicmodel->get_college_fund_sanc_list($queryso['sel']);
				}
			}
		}
		if($this->input->post('sanc_fund_submit'))
		{
			$queryso['college_list'] = $this->Publicmodel->get_college_fund_sanc_list($queryso['sel']);
			$id_col = array_column($queryso['college_list'],'nss_fund_sanc_id');
			$data_fwd=array(
			'ver_id'=>'4',
			'remark'=>'',
			'ids'=>$id_col,
			);
			$up_fwd_so_sanc_fund = $this->Publicmodel->fwd_so_sanc_fund($data_fwd);
			if($up_fwd_so_sanc_fund)
			  $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESFULLY ACCEPTED BY SO</h4>';
			$queryso['college_list'] = $this->Publicmodel->get_college_fund_sanc_list($queryso['sel']);
		}
		elseif($this->input->post('rejassisubmit'))
		{
			$queryso['college_list'] = $this->Publicmodel->get_college_fund_sanc_list($queryso['sel']);
			$id_col = array_column($queryso['college_list'],'nss_fund_sanc_id');
			$data_fwd=array(
			'ver_id'=>'3R',
			'remark'=>$this->input->post('remarktxt1'),
			'ids'=>$id_col,
			);
			$up_fwd_so_sanc_fund = $this->Publicmodel->fwd_so_sanc_fund($data_fwd);
			if($up_fwd_so_sanc_fund)
			  $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">SUCCESFULLY REJECTED BY SO</h4>';
			$queryso['college_list'] = $this->Publicmodel->get_college_fund_sanc_list($queryso['sel']);
		}
		$queryso['adminspan1'] = $this->load->view('common_sidebar',$queryso,true);
		$queryso['adminspan2'] = $this->load->view('common_template_topbar',$queryso,true);	
		$queryso['listspan'] = $this->load->view('so/view_sanction_fund',$queryso,true);
		$queryso['adminspan3'] = $this->load->view('common_list_view',$queryso,true);	//template	
		$this->load->view('common_template',$queryso);//template
	}
	public function eligibility_rep()
	{
		$queryso['msg']="";
		$queryso['user_type'] = $this->session->userdata('user_type');
		$queryso['name']= $this->session->userdata('name');
		$queryso['college_name'] = 'M G UNIVERSITY';
		$queryso['main_menu']="elig";
		$queryso['sub_menu']="";
		$queryso['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)
		{
		$queryso['college_name_sel'] = $this->Publicmodel->getlistcollege_dist($type);
		$college_name_sel = $this->input->post('name');
		if($college_name_sel)
		{
			$queryso['batch_list']=$this->Publicmodel->princi_batch_period($college_name_sel);
			if(empty($queryso['batch_list']))   $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">NO DATA FOUND</h4>';
			$queryso['sel_batch'] = $this->input->post('batch');
			if($queryso['sel_batch'])
			{
			$queryso['unit_list']= $this->Publicmodel->get_unit_from_batch($college_name_sel,$queryso['sel_batch']);
			$queryso['sel_unit']=$this->input->post('unit');
			if(empty($queryso['unit_list'])){
				   $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">UNIT IS NOT CREATED FOR  THIS COLLEGE</h4>';}
			elseif($queryso['sel_unit']){
			
				$queryso['eli_det'] = $this->Publicmodel->get_elig_rep($college_name_sel,$queryso['sel_batch'],$queryso['sel_unit']);
				
					}
			}
		}
		}
		$queryso['adminspan1'] = $this->load->view('common_sidebar',$queryso,true);
		$queryso['adminspan2'] = $this->load->view('common_template_topbar',$queryso,true);	
		$queryso['adminspan3'] = $this->load->view('so/eligibile_report',$queryso,true);	
		$this->load->view('common_template',$queryso);
	}
	public function eligibility_rep_old()
	{
		$queryso['msg']="";
		$queryso['user_type'] = $this->session->userdata('user_type');
		$queryso['name']= $this->session->userdata('name');
		$queryso['college_name'] = 'M G UNIVERSITY';
		$queryso['main_menu']="elig";
		$queryso['sub_menu']="";
		$queryso['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)
		{
		$queryso['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
		$college_name_sel = $this->input->post('name');
		if($college_name_sel)
		{
			$queryso['batch_list']=$this->Publicmodel->princi_batch_period($college_name_sel);
			if(empty($queryso['batch_list']))   $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">NO DATA FOUND</h4>';
			$queryso['sel_batch'] = $this->input->post('batch');
			if($queryso['sel_batch'])
			{
			$queryso['unit_list']= $this->Publicmodel->get_unit_from_batch($college_name_sel,$queryso['sel_batch']);
			$queryso['sel_unit']=$this->input->post('unit');
			if(empty($queryso['unit_list'])){
				   $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">UNIT IS NOT CREATED FOR  THIS COLLEGE</h4>';}
			elseif($queryso['sel_unit']){
			$ver_id = array("2R","3","4","3R");
				$queryso['eli_det'] = $this->Publicmodel->chk_elig_rep($college_name_sel,$queryso['sel_batch'],$queryso['sel_unit'],$ver_id);
				if($this->input->post('fwdassi'))
				{
							$data_eli_upd = array(
							'college_id'=>$college_name_sel,
							'batch_period'=>$queryso['sel_batch'],
							'nss_unit'=>$queryso['sel_unit'],
							'verification_id'=>'3',
							'chg_ver_id'=>'4',
							'remarks'=> '',
							);
							$upd_eli = $this->Publicmodel->fwd_prin_eli($data_eli_upd);
							if($upd_eli)
							  $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">ACCEPTED BY UNIVERSITY</h4>';
							}
							elseif($this->input->post('rejassisubmit'))
							{
								$data_eli_upd = array(
							'college_id'=>$college_name_sel,
							'batch_period'=>$queryso['sel_batch'],
							'nss_unit'=>$queryso['sel_unit'],
							'verification_id'=>'2',
							'chg_ver_id'=>'2R',
							'remarks'=> $this->input->post('remarktxt1'),
							);
							$upd_eli = $this->Publicmodel->fwd_prin_eli($data_eli_upd);
							if($upd_eli)
							   $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">REJECTED BY SO</h4>';
							}
					}
			}
		}
		}
		$queryso['adminspan1'] = $this->load->view('common_sidebar',$queryso,true);
		$queryso['adminspan2'] = $this->load->view('common_template_topbar',$queryso,true);	
		$queryso['adminspan3'] = $this->load->view('so/eligibile_report',$queryso,true);	
		$this->load->view('common_template',$queryso);
	}
	
	public function nss_certi_pgm_view($unit='',$iss='')
	{	//print_r($this->input->post('nss'));exit;
	if(isset($iss)&&!empty($iss))
	{//$unit=$this->input->post('unit');
	//echo'iss'.$iss;echo $unit;exit;
	$this->Publicmodel->update_isse_certi($unit);
	$this->Publicmodel->issued($unit);
	redirect(base_url().'Admin/NssSo/verify_eli_list');
	}
	//$unitttt=$this->input->post('unit');
	//echo $unit;exit;
	$stud=$this->Publicmodel->get_stud_unit($unit);
	//print_r($stud);exit;
		$id=$this->Publicmodel->get_elig_rep_certi_studs($stud);
		//print_r($id);exit;
		//$id = $this->uri->segment(4);
		$data['student_details_arr'] = $this->Publicmodel->certi_new_ann($id);
		$this->load->view('po/nss_certi_view_ann',$data);
	
	}
    public function certi()
	{
		$queryso['msg']="";
		$queryso['user_type'] = $this->session->userdata('user_type');
		$queryso['name']= $this->session->userdata('name');
		$queryso['college_name'] = 'M G UNIVERSITY';
		$queryso['main_menu']="certi";
		$queryso['sub_menu']="";
		$queryso['nss_college_type'] = $this->Publicmodel->get_college_type();	
		$type = $this->input->post('type');
		if($type)
		{
		$queryso['college_name_sel'] = $this->Publicmodel->get_college_name1($type);
		$college_name_sel = $this->input->post('name');
		if($college_name_sel)
		{
			$queryso['batch_list']=$this->Publicmodel->princi_batch_period($college_name_sel);
			if(empty($queryso['batch_list']))  $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">NO DATA FOUND</h4>';
			$queryso['sel_batch'] = $this->input->post('batch');
			if($queryso['sel_batch'])
			{
			$queryso['unit_list']= $this->Publicmodel->get_unit_from_batch($college_name_sel,$queryso['sel_batch']);
			$queryso['sel_unit']=$this->input->post('unit');
			
			if(empty($queryso['unit_list'])){
						   $queryso['msg']= '<h4 style="color:#FF0000;font-weight:bold;">UNIT IS NOT CREATED FOR THE THIS COLLEGE</h4>';}
					elseif($queryso['sel_unit']){
						if($this->input->post('certi_type'))
		{		
			$queryso['certi_type'] = $this->input->post('certi_type');
			if($queryso['certi_type']=='V')
			{
				$queryso['eli_dat'] = $this->Publicmodel->get_elig_rep_certi($college_name_sel,$queryso['sel_batch'],$queryso['sel_unit']);
			}
		}
		}
		}
		}
		}
		$queryso['adminspan1'] = $this->load->view('common_sidebar',$queryso,true);
		$queryso['adminspan2'] = $this->load->view('common_template_topbar',$queryso,true);	
		$queryso['adminspan3'] = $this->load->view('so/certi',$queryso,true);	
		$this->load->view('common_template',$queryso);
	}
	public function logout()
	{
		$this->session->unset_userdata("collid");
		$this->session->unset_userdata("utype");
		$this->session->unset_userdata("reconluser");
		redirect(base_url().'Nsscontrol');
	} 
}
