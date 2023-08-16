<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NssAdministrator extends CI_Controller 
{
	public function __construct() 
	{
        parent::__construct();
		$this->load->library('session');
		$this->load->library('Excel');
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
	
	public function upload()
	{
		$queryadmin['main_menu']= 'upload';
		$queryadmin['sub_menu']= "";
		$queryadmin['user_type'] = $this->session->userdata('user_type');
		$queryadmin['name']= $this->session->userdata('name');
		$queryadmin['college_name'] = 'KANNUR UNIVERSITY';
		if($this->input->post('upload'))
		{	 
			      if($_FILES['file1']['name'])
				 {
					$name = $_FILES["file1"]["name"];
					$tmp = explode('.', $name);
        			$ext = end($tmp);
					if($ext!="xlsx")
					{
						 $data['alert_msg']=' <div class="alert alert-danger">
						                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                               <strong>Invalid File !  </strong>   Upload .xlsx file only!!!.....
											</div>';
					}
				   else
				    { 
				
		 		 		//$crd_date          = $this->input->post('cdate');
		   		 		//$mon_yr            = explode('/',$crd_date);
        				$configUpload['upload_path'] = './uploads/excel/';
                		$configUpload['allowed_types'] = 'xls|xlsx|csv';
                 		$configUpload['max_size'] = '9000';
                 		$this->load->library('upload', $configUpload);
                		$this->upload->do_upload('file1');	
        	     		$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
        				$file_name = $upload_data['file_name']; //uploded file name
				 		$extension=$upload_data['file_ext'];    // uploded file extension
				 		
         		 		$objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007   
        		 		//Set to read only
        		 		$objReader->setReadDataOnly(true); 
        		 		// Number of sheet in excel file
        		 		//Load excel file
						$objPHPExcel=$objReader->load('./uploads/excel/'.$file_name);		 
        				$totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel     
		 				$totalcols=$objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();   //Count Numbe of column avalable in excel      
 	    		 		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($totalcols);
		  				$sheet = $objPHPExcel->getSheet(0);
        				$objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
       		            //loop from first data untill last data
				 		$h1=$objWorksheet->getCellByColumnAndRow(0,1)->getValue();
						$h2=$objWorksheet->getCellByColumnAndRow(1,1)->getValue();
				 		$h3=$objWorksheet->getCellByColumnAndRow(2,1)->getValue();
						$h4=$objWorksheet->getCellByColumnAndRow(3,1)->getValue(); 
						$h5=$objWorksheet->getCellByColumnAndRow(4,1)->getValue();
				 		$h6=$objWorksheet->getCellByColumnAndRow(5,1)->getValue();
						$h7=$objWorksheet->getCellByColumnAndRow(6,1)->getValue(); 
						$h8=$objWorksheet->getCellByColumnAndRow(7,1)->getValue();
				 		$h9=$objWorksheet->getCellByColumnAndRow(8,1)->getValue();
						$h10=$objWorksheet->getCellByColumnAndRow(9,1)->getValue(); 
						$h11=$objWorksheet->getCellByColumnAndRow(10,1)->getValue();
				 		$h12=$objWorksheet->getCellByColumnAndRow(11,1)->getValue();
						$h13=$objWorksheet->getCellByColumnAndRow(12,1)->getValue(); 
						$h14=$objWorksheet->getCellByColumnAndRow(13,1)->getValue();
				 		$h15=$objWorksheet->getCellByColumnAndRow(14,1)->getValue();
						$h16=$objWorksheet->getCellByColumnAndRow(15,1)->getValue(); 
						$h17=$objWorksheet->getCellByColumnAndRow(16,1)->getValue();
						$h18=$objWorksheet->getCellByColumnAndRow(17,1)->getValue();
					
						//echo $h17;exit;
				 		 
						//echo $h1."==".$h2."==".$h3;exit;
		 				if($h1=='College')
	    		 		{ 
			  				 $inc=0;		   
							 for($i=2;$i<=$totalrows;$i++)
            				 {
								 $ddddate= PHPExcel_Style_NumberFormat::toFormattedString($objWorksheet->getCellByColumnAndRow(11,$i)->getValue(),"YYYY-MM-DD");
								$ins_excel[$inc]=array(
								'college'     => $objWorksheet->getCellByColumnAndRow(0,$i)->getValue(),
								'college_address'    =>  $objWorksheet->getCellByColumnAndRow(1,$i)->getValue(),
								'college_district'     => $objWorksheet->getCellByColumnAndRow(2,$i)->getValue(),
								'college_pincode'    =>  $objWorksheet->getCellByColumnAndRow(3,$i)->getValue(),
								'college_email'     => $objWorksheet->getCellByColumnAndRow(4,$i)->getValue(),
								'college_contact_no1'    =>  $objWorksheet->getCellByColumnAndRow(5,$i)->getValue(),
								'college_contact_no2'     => $objWorksheet->getCellByColumnAndRow(6,$i)->getValue(),
								'course'    =>  $objWorksheet->getCellByColumnAndRow(7,$i)->getValue(),
								'register_number'     => $objWorksheet->getCellByColumnAndRow(8,$i)->getValue(),
								'name'    =>  $objWorksheet->getCellByColumnAndRow(9,$i)->getValue(),
								'gender'     => $objWorksheet->getCellByColumnAndRow(10,$i)->getValue(),
								'dob'    =>   $ddddate,
								'religion'     => $objWorksheet->getCellByColumnAndRow(12,$i)->getValue(),
								'caste'    =>  $objWorksheet->getCellByColumnAndRow(13,$i)->getValue(),
								'reservation'     => $objWorksheet->getCellByColumnAndRow(14,$i)->getValue(),
								'nationality'    =>  $objWorksheet->getCellByColumnAndRow(15,$i)->getValue(),
								'address'     => $objWorksheet->getCellByColumnAndRow(16,$i)->getValue(),
								'contactno'    =>  $objWorksheet->getCellByColumnAndRow(17,$i)->getValue(),
								); 
							
								$inc++;
			         		 }//End For
								//print_r($ins_excel);exit;
							$ins=$this->Publicmodel->Add_mastertable($ins_excel);
							
				            if($ins){
					        	
				    	    }						 
		              }//END HEADING
		           else
		              {
				        echo"sd";exit;
			           }
             		  unlink('././uploads/excel/'.$file_name); //File Deleted After uploading in database .			 
                   }}
			 
		}
		
		$queryadmin['adminspan1'] = $this->load->view('common_sidebar',$queryadmin,true);
		$queryadmin['adminspan2'] = $this->load->view('common_template_topbar',$queryadmin,true);	
		$queryadmin['adminspan3'] = $this->load->view('administrator/upload','',true);	
		$this->load->view('common_template',$queryadmin);
	}
	

}
