<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class VerifyCertificate extends CI_Controller{
	public function __construct(){
        parent::__construct();
		$this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->helper('captcha');
		$this->load->model('Publicmodel');
    }
	//verification of certficate by authority
	public function index(){
		 	
		
		if($this->input->post()){
			$this->form_validation->set_error_delimiters('<div class="errormsg">', '</div>');
			$this->form_validation->set_rules('certificate_no', 'Enrollment No', 'required', array('required'=>'Please provide %s'));
			if ($this->form_validation->run() === FALSE) {
			}
			else{ 
				$enroll		= $this->input->post('certificate_no');
				 //print_r($enroll);exit;
				if($result_value=$this->Publicmodel->get_stud_certi_new($enroll)){ 	
							
					redirect('VerifyCertificate/verify_certificate_view/'.$this->input->post('certificate_no'));				
				}
				else{
					$this->session->set_flashdata('error_msg', '<div class="errormsg">Please provide correct data.</div>');	
				}
			}
		}
		if($this->session->flashdata('error_msg')) $data['error_msg22']= $this->session->flashdata('error_msg');
			
		$this->load->view('po/verify_Appln');//template
	}
	public function verify_certificate_view($appln_no='',$code=''){
		//echo'aa';exit; 
	 $result_value=$this->Publicmodel->get_stud_certi_new($appln_no);
	// print_r($result_value);exit;
	 $data['result_value']=$result_value;
		if($appln_no!=''&& $code!='' ){
			$enroll			= $appln_no;
			
			$security_code_db =md5($result_value['nss_stud_id']*7); 
			//echo $result_value['enroll_no'];echo'//';echo $security_code_db;echo'//';echo $code;exit;
			//print_r($security_code_db) ;exit;
			if($security_code_db  == $code){ 
				/*				list the display details verified by etc */
				$result_value=$this->Publicmodel->get_stud_certi_new($appln_no);
	 $data['result_value']=$result_value;
				$this->load->view('po/certificate_verificatin_template',$data);//template
				
			}
			else{echo 'Certificate is not valid.';exit;
				$data['details'] = 1;
				$this->session->set_flashdata('error_msg', '<div class="errormsg">Certificate is not valid.</div>');	
				
			}
		}
		else
		{
		$this->load->view('po/certificate_verificatin_template',$data); 
		}
		//print_r($data);exit;
		
		 
		  
		 
		 
		 
	}
	
	
}
?>