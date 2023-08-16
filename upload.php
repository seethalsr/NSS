<?php 
$datau= array(
				'fund_2_yr'=>($_FILES['txt4']['name']),
				);
					
		 		//upload section
		 		$path   = './uploaded_pdf/'.$college_id;
				 if (!is_dir($path)) 
		 		{ //create the folder if it's not  exists
				mkdir($path, 0755, TRUE);
		 		}
		 		$name = 'fund_2yr';
		 		$config = array(
                    'allowed_types' =>"pdf",
					'overwrite'     => TRUE,
                    'upload_path' => $path,
                    'max_size' => '5000',                    
                    'file_name' => $name,
                    'max_height' => "768",
                    'max_width' => "1050",

                );
				//print_r($config);exit;
				
				 $this->load->library('upload');
				 $this->upload->initialize($config);
		
					if($this->upload->do_upload('txt4'))
					{
						$upload_data = $this->upload->data();
					}
					else
					{
						$error = $this->upload->display_errors(); //print_r($error);exit;
						$querypo['msg']= $error ;			
					}
					if(isset($error))
					{// echo "sd";exit;
					}
					else{
					$datai = array(
						'college_id'=>$college_id,
						'po_id'=>$po_id,	
						'from_year'=> $prev_2yr,
						'to_year'=>	$prev_yr,				
						'fund_2_yr'=>($_FILES['txt4']['name']),
						'fund_2_yr_flag'=>1,
						'created_date'=>date('Y-m-d H:i:s'),	
					);	
					//print_r($datai);exit;
					$ins = $this->Publicmodel->insert_fund_upload($datai);
					if($ins)
					$querypo['msg']= "Successfully uploaded" ;
					$querypo['up'] = 1;
					}

?>