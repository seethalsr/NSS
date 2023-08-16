<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rank_sar extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 public function __construct() 
	{
		//echo'aa';exit;
        parent::__construct();
		$this->load->library('session');
		//$this->load->library('Excel');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->helper('string');
        //$this->load->helper('captcha');
        $this->load->model('Rankmodel');	
		ini_set('max_execution_time',0);
		ini_set('memory_limit', '-1');	
		date_default_timezone_set('Asia/Kolkata');
$timestamp = date("Y-m-d H:i:s");		
$colg_cos_update=array();	

$this->colg_cos_update=array();
		
    }
	
	
	
	public function index()
	{
		ini_set('max_execution_time',0);
		ini_set('memory_limit', '-1');
		//$qq="ww";
		//$this->colg_cos_update=array(1);
        //print_r( $this->colg_cos_update);exit;
		$del_coll_cou=array();
		//get college course active one
		echo "<br>Start".date("Y-m-d H:i:s");
		$colg_cou=$this->Rankmodel->get_coll_cou();
		for($i=0;$i<count($colg_cou);$i++)
		{
			//print_r($colg_cou);exit;
			echo "<br>College : ".$colg_cou[$i]['college_id']."  Course : ".$colg_cou[$i]['specialisation_id'];
			$this->generate_rank_colg_cos($colg_cou[$i]['college_id'],$colg_cou[$i]['specialisation_id'],8);
			$this->generate_rank_colg_cos_cat($colg_cou[$i]['college_id'],$colg_cou[$i]['specialisation_id'],1);
			$this->generate_rank_colg_cos_cat($colg_cou[$i]['college_id'],$colg_cou[$i]['specialisation_id'],2);
			$this->generate_rank_colg_cos_cat($colg_cou[$i]['college_id'],$colg_cou[$i]['specialisation_id'],3);
			$this->generate_rank_colg_cos_cat($colg_cou[$i]['college_id'],$colg_cou[$i]['specialisation_id'],4);
			$this->generate_rank_colg_cos_cat($colg_cou[$i]['college_id'],$colg_cou[$i]['specialisation_id'],5);
			$this->generate_rank_colg_cos_cat($colg_cou[$i]['college_id'],$colg_cou[$i]['specialisation_id'],6);
			$this->generate_rank_colg_cos_cat($colg_cou[$i]['college_id'],$colg_cou[$i]['specialisation_id'],7);
			$this->generate_rank_colg_cos_cat($colg_cou[$i]['college_id'],$colg_cou[$i]['specialisation_id'],9);
			$this->generate_rank_colg_cos_cat($colg_cou[$i]['college_id'],$colg_cou[$i]['specialisation_id'],10);
			$this->generate_rank_colg_cos_cat($colg_cou[$i]['college_id'],$colg_cou[$i]['specialisation_id'],12);
			
			
	    }
		
		/*echo "<br>Hash set count :  ".count($this->colg_cos_update);
		//print_r($this->colg_cos_update);
		foreach($this->colg_cos_update as $x=>$x_val)
		{
			print_r($x_val);
			$college_cos=explode(',',$x_val);
			print_r($college_cos);
			$col_id=$college_cos[0];
			$cos_id=$college_cos[1];
			$cat=$college_cos[2];
			
			unset($this->colg_cos_update[$x]);
			echo "<br>Hash Colg---".$col_id."Cours---".$cos_id;//exit;
			if($cat==8)
			$this->generate_rank_colg_cos($col_id,$cos_id,$cat);
			else
			 $this->generate_rank_colg_cos_cat($col_id,$cos_id,$cat);
			
			
		}*/
		//print_r($del_coll_cou);exit;
		echo "<br>success".date("Y-m-d H:i:s");
		
	}
		
	
	public function  generate_rank_colg_cos($college,$course,$gen)
	{
		
		$gen=8;
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time',0);
		//echo $college.$course;exit;
		
		//$rem_seats=$this->get_rem_seats($college,$course,$gen);
		//if($rem_seats>0)
		
		$students=$this->Rankmodel->get_students($college,$course);
		//print_r($students);exit;
		for($i=0;$i<count($students);$i++)
		{
			
			$insert=0;
			$rem_seats=$this->get_rem_seats($college,$course,$gen);
			if($rem_seats==0)
			 return;
			//echo "<br>Rem Seat of ".$college." ".$course." ".$gen." ".$rem_seats;//exit;
			if($rem_seats>0)
			{
				$insert=1;
				$res_type=$gen;
			}
			
			if($insert==1)
			{
				//echo "<br>Insert=1";
				$student_id=$students[$i]['account_id'];
				$prev_optn_details=$this->Rankmodel->get_curnt_option($students[$i]['account_id']);
				//echo "stud=".$student_id;
				//print_r($prev_optn_details);exit;
				$cunt_optn=$students[$i]['option_registration_order'];
				//$index=$this->Rankmodel->get_index($students[$i]['account_id'],$course);
				$index_id=$students[$i]['index_id'];
				if(empty($prev_optn_details))
				{
					$r=$this->Rankmodel->get_maxrank($college,$course,$res_type);
					if(empty($r['rank']))
				    {
					   $r=0;
				    }
				    $rank=$r['rank']+1;
					$data_ins=array(
					'index_id'=>$index_id,
					'option_no'=>$cunt_optn,
					'rank'=>$rank,
					'college_id'=>$college,
					'status'=>'alloted',
					'reservation_id'=>$res_type,
					'student_id'=>$student_id,
					'course_id'=>$course,
					);
					$ins_id=$this->Rankmodel->insert_student($data_ins);
					$this->Rankmodel->update_temp_table_admit($student_id,$cunt_optn);
					$this->Rankmodel->update_temp_table($student_id,$cunt_optn);
					if($ins_id)
					 echo "<br>Inserted".date("Y-m-d H:i:s");
				}
				else if($prev_optn_details['option_no']>$cunt_optn)
				{
					//echo "else".$student_id;exit;
					$val=$prev_optn_details['college_id'].','.$prev_optn_details['course_id'].','.$prev_optn_details['reservation_id'];	
					array_push($this->colg_cos_update,$val);	
					$this->colg_cos_update=array_unique($this->colg_cos_update);
					echo "Hash Push---";
					//print_r($this->colg_cos_update);
					
					$this->Rankmodel->delete_student($prev_optn_details['college_id'],$prev_optn_details['course_id'],$prev_optn_details['status'],$prev_optn_details['option_no'],$student_id);
					$r=$this->Rankmodel->get_maxrank($college,$course,$res_type);
					if(empty($r['rank']))
				    {
					   $r=0;
				    }
				    $rank=$r['rank']+1;
					
					//Update rank mof previous
					$this->Rankmodel->update_rank_prev($prev_optn_details['college_id'],$prev_optn_details['course_id'],$prev_optn_details['rank'],$prev_optn_details['reservation_id']);
					$data_ins=array(
					'index_id'=>$index_id,
					'option_no'=>$cunt_optn,
					'rank'=>$rank,
					'college_id'=>$college,
					'status'=>'alloted',
					'reservation_id'=>$res_type,
					'student_id'=>$student_id,
					'course_id'=>$course,
					);
					$ins_id=$this->Rankmodel->insert_student($data_ins);
					$this->Rankmodel->update_temp_table($student_id,$cunt_optn);
					if($ins_id)
					 echo "<br>Inserted".date("Y-m-d H:i:s");
					
				}
				else if(($prev_optn_details['option_no']==$cunt_optn)&&($res_type==$gen))
				{
				    if($prev_optn_details['reservation_id']!=8)
				    {
					   $val=$prev_optn_details['college_id'].','.$prev_optn_details['course_id'].','.$prev_optn_details['reservation_id'];	
					   
					   array_push($this->colg_cos_update,$val);	
					   $this->colg_cos_update=array_unique($this->colg_cos_update);
					   $this->Rankmodel->delete_student($prev_optn_details['college_id'],$prev_optn_details['course_id'],$prev_optn_details['status'],$prev_optn_details['option_no'],$student_id);
					$r=$this->Rankmodel->get_maxrank($college,$course,$res_type);
					if(empty($r['rank']))
				    {
					   $r=0;
				    }
				    $rank=$r['rank']+1;
					
					//Update rank mof previous
					$this->Rankmodel->update_rank_prev($prev_optn_details['college_id'],$prev_optn_details['course_id'],$prev_optn_details['rank'],$prev_optn_details['reservation_id']);
					$data_ins=array(
					'index_id'=>$index_id,
					'option_no'=>$cunt_optn,
					'rank'=>$rank,
					'college_id'=>$college,
					'status'=>'alloted',
					'reservation_id'=>$res_type,
					'student_id'=>$student_id,
					'course_id'=>$course,
					);
					$ins_id=$this->Rankmodel->insert_student($data_ins);
					$this->Rankmodel->update_temp_table($student_id,$cunt_optn);
					if($ins_id)
					 echo "<br>Inserted".date("Y-m-d H:i:s");
					
				   }
				}
			}
			
			
		}
		//echo "<br>Hash set count :  ".count($this->colg_cos_update);
		//print_r($this->colg_cos_update);
		foreach($this->colg_cos_update as $x=>$x_val)
		{
		//	print_r($x_val);
			$college_cos=explode(',',$x_val);
			//print_r($college_cos);
			$col_id=$college_cos[0];
			$cos_id=$college_cos[1];
			$cat=$college_cos[2];
			
			unset($this->colg_cos_update[$x]);
			echo "<br>Hash Colg---".$col_id."Cours---".$cos_id;//exit;
			if($cat==8)
			$this->generate_rank_colg_cos($col_id,$cos_id,$cat);
			else
			 $this->generate_rank_colg_cos_cat($col_id,$cos_id,$cat);
			
			
		}
		
	}
	
	public function  generate_rank_colg_cos_cat($college,$course,$cat)
	{
		
		
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time',0);
		//echo $college.$course;exit;
		
		//$rem_seats=$this->get_rem_seats($college,$course,$gen);
		//if($rem_seats>0)
		
		$students=$this->Rankmodel->get_students_cat($college,$course,$cat);
		//print_r($students);exit;
		for($i=0;$i<count($students);$i++)
		{
			
			$insert=0;
			
			
				$res=$students[$i]['account_student_category'];
				//echo $res;//exit;
				
					$rem_seats=$this->get_rem_seats($college,$course,$res);
					if($rem_seats==0)
					  return;
    			//	echo "<br>Rem Cat Seat of ".$college." ".$course." ".$res." ".$rem_seats;//exit;
					if($rem_seats>0)
					{
						//echo "in";
						$insert=1;
				        $res_type=$res;
					}
				
				
			
			
			if($insert==1)
			{
				//echo "<br>Insert=1";
				$student_id=$students[$i]['account_id'];
				$prev_optn_details=$this->Rankmodel->get_curnt_option($students[$i]['account_id']);
				//echo "stud=".$student_id;
				//print_r($prev_optn_details);exit;
				$cunt_optn=$students[$i]['option_registration_order'];
				//$index=$this->Rankmodel->get_index($students[$i]['account_id'],$course);
				$index_id=$students[$i]['index_id'];
				if(empty($prev_optn_details))
				{
					$r=$this->Rankmodel->get_maxrank($college,$course,$res_type);
					if(empty($r['rank']))
				    {
					   $r=0;
				    }
				    $rank=$r['rank']+1;
					$data_ins=array(
					'index_id'=>$index_id,
					'option_no'=>$cunt_optn,
					'rank'=>$rank,
					'college_id'=>$college,
					'status'=>'alloted',
					'reservation_id'=>$res_type,
					'student_id'=>$student_id,
					'course_id'=>$course,
					);
					$ins_id=$this->Rankmodel->insert_student($data_ins);
					$this->Rankmodel->update_temp_table($student_id,$cunt_optn);
					if($ins_id)
					 echo "<br>Inserted".date("Y-m-d H:i:s");
				}
				else if($prev_optn_details['option_no']>$cunt_optn)
				{
					//echo "else".$student_id;exit;
					$val=$prev_optn_details['college_id'].','.$prev_optn_details['course_id'].','.$prev_optn_details['reservation_id'];		
					array_push($this->colg_cos_update,$val);	
					$this->colg_cos_update=array_unique($this->colg_cos_update);
					echo "Hash Push---";
					//print_r($this->colg_cos_update);
					
					$this->Rankmodel->delete_student($prev_optn_details['college_id'],$prev_optn_details['course_id'],$prev_optn_details['status'],$prev_optn_details['option_no'],$student_id);
					$r=$this->Rankmodel->get_maxrank($college,$course,$res_type);
					if(empty($r['rank']))
				    {
					   $r=0;
				    }
				    $rank=$r['rank']+1;
					
					//Update rank mof previous
					$this->Rankmodel->update_rank_prev($prev_optn_details['college_id'],$prev_optn_details['course_id'],$prev_optn_details['rank'],$prev_optn_details['reservation_id']);
					$data_ins=array(
					'index_id'=>$index_id,
					'option_no'=>$cunt_optn,
					'rank'=>$rank,
					'college_id'=>$college,
					'status'=>'alloted',
					'reservation_id'=>$res_type,
					'student_id'=>$student_id,
					'course_id'=>$course,
					);
					$ins_id=$this->Rankmodel->insert_student($data_ins);
					$this->Rankmodel->update_temp_table($student_id,$cunt_optn);
					if($ins_id)
					 echo "<br>Inserted".date("Y-m-d H:i:s");
					
				}
				else if(($prev_optn_details['option_no']==$cunt_optn)&&($res_type==8))
				{
				    if($prev_optn_details['reservation_id']!=8)
				    {
					   $val=$prev_optn_details['college_id'].','.$prev_optn_details['course_id'].','.$prev_optn_details['reservation_id'];	
					   
					   array_push($this->colg_cos_update,$val);	
					   $this->colg_cos_update=array_unique($this->colg_cos_update);
					   $this->Rankmodel->delete_student($prev_optn_details['college_id'],$prev_optn_details['course_id'],$prev_optn_details['status'],$prev_optn_details['option_no'],$student_id);
					$r=$this->Rankmodel->get_maxrank($college,$course,$res_type);
					if(empty($r['rank']))
				    {
					   $r=0;
				    }
				    $rank=$r['rank']+1;
					
					//Update rank mof previous
					$this->Rankmodel->update_rank_prev($prev_optn_details['college_id'],$prev_optn_details['course_id'],$prev_optn_details['rank'],$prev_optn_details['reservation_id']);
					$data_ins=array(
					'index_id'=>$index_id,
					'option_no'=>$cunt_optn,
					'rank'=>$rank,
					'college_id'=>$college,
					'status'=>'alloted',
					'reservation_id'=>$res_type,
					'student_id'=>$student_id,
					'course_id'=>$course,
					);
					$ins_id=$this->Rankmodel->insert_student($data_ins);
					$this->Rankmodel->update_temp_table($student_id,$cunt_optn);
					if($ins_id)
					 echo "<br>Inserted".date("Y-m-d H:i:s");
					
				   }
				}
			}
			
			
		}
		//echo "<br>Hash set count :  ".count($this->colg_cos_update);
		//print_r($this->colg_cos_update);
		foreach($this->colg_cos_update as $x=>$x_val)
		{
			//print_r($x_val);
			$college_cos=explode(',',$x_val);
			//print_r($college_cos);
			$col_id=$college_cos[0];
			$cos_id=$college_cos[1];
			$cat=$college_cos[2];
			
			unset($this->colg_cos_update[$x]);
			echo "<br>Hash Colg---".$col_id."Cours---".$cos_id;//exit;
			if($cat==8)
			$this->generate_rank_colg_cos($col_id,$cos_id,$cat);
			else
			 $this->generate_rank_colg_cos_cat($col_id,$cos_id,$cat);
			
			
		}
	
	}
	
	public function  get_rem_seats($college,$course,$res)
	{
		ini_set('max_execution_time',0);
		$aloted_seat=0;
		$aloted_seat=$this->Rankmodel->get_aloted_seat($college,$course,$res);
		//print_r($aloted_seat);
		
		/*if($aloted_seat['alloted']==0)
		{
			//echo "if".$aloted_seat['alloted'];exit;
			return 1;
		}
		else
		{*/
			//echo $aloted_seat['alloted'];exit;
			$col_cos=$this->Rankmodel->get_colg_couse($college,$course);
			//print_r($col_cos);exit;
			if($res==1)
			  $tot_seat=$col_cos['seats_ezhava_thiyya_billava'];
			elseif($res==2)  
			  $tot_seat=$col_cos['seats_muslim'];
			elseif($res==3)  
			  $tot_seat=$col_cos['seats_latin_catholics'];  
			elseif($res==4)  
			  $tot_seat=$col_cos['seats_obx'];
			elseif($res==5)  
			  $tot_seat=$col_cos['seats_obh'];  
		    elseif($res==6)  
			  $tot_seat=$col_cos['seats_sc'];
			elseif($res==7)  
			  $tot_seat=$col_cos['seats_st'];  
		    elseif($res==8)  
			  $tot_seat=$col_cos['seats_general'];
			elseif($res==9)  
			  $tot_seat=$col_cos['seats_bpl'];  
		    elseif($res==10)  
			  $tot_seat=$col_cos['seats_oec'];
			elseif($res==12)  
			  $tot_seat=$col_cos['seats_sebc'];  
			
			$rem_seats=  $tot_seat-$aloted_seat['alloted'];
			//echo "<br>Rem seat in fn:".$rem_seats;//exit;
			return $rem_seats;
		  
		//}
		
		
	}
	
	
}
