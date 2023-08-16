<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Rankmodel extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function get_coll_cou()//checked
	{
	    $this->db->select('*');
        $this->db->from('ugcap_college_course_map');
		$this->db->where('college_course_status','active');		
		//$this->db->where('college_id','9');		
		$query = $this->db->get();
    	return $query->result_array();	
	}
	public function get_students($col,$cou)
	{
		$this->db->select('account_id, option_registration_order, account_student_category, course_id, option_registration_college_id,index_id');
		$this->db->where(array('option_registration_college_id'=>$col,'course_id'=>$cou,'status'=>'active'));		 
		$this->db->from('temp_table_for_ranking_final');
		//$this->db->order_by('new_mark asc');
		//$this->db->limit($limit);
		$query = $this->db->get();//echo $this->db->last_query();exit;
		return $query->result_array();
	}
	public function get_students_cat($col,$cou,$cat)
	{
		$this->db->select('account_id, option_registration_order, account_student_category, course_id, option_registration_college_id,index_id');
		$this->db->where(array('option_registration_college_id'=>$col,'course_id'=>$cou,'status'=>'active','account_student_category'=>$cat));		 
		$this->db->from('temp_table_for_ranking_final');
		//$this->db->order_by('new_mark asc');
		//$this->db->limit($limit);
		$query = $this->db->get();//echo $this->db->last_query();exit;
		return $query->result_array();
	}
	
	public function get_aloted_seat($coll,$cou,$res)
	{
		
		$this->db->select('count(*) as alloted');
		$this->db->where(array('college_id' => $coll,'course_id'=>$cou,'reservation_id'=>$res));	
		$where="status='alloted' or status='admitted '";
		 $this->db->where($where);
		 $this->db->from('ranking_rank_master');	
		//$this->db->from('ranking_rank_master_count28666');		
		$query = $this->db->get();// echo "<br>". $this->db->last_query();//exit;
		return $query->row_array();
	}
	
	public function get_curnt_option($student)
	{
		$this->db->select('college_id,course_id,rank,status,reservation_id,option_no');
		$where="status='alloted' or status='admitted '";
		 $this->db->where('student_id',$student);
		 $this->db->where($where);
		//$this->db->from('ranking_rank_master_count28666');				
		 $this->db->from('ranking_rank_master');
		 $query = $this->db->get();// echo $this->db->last_query();exit;
		return $query->row_array();	
	}
	
	public function get_maxrank($college,$course,$res_type)
	{
		$this->db->select('max(rank) as rank');
		$this->db->where(array('college_id' => $college,'course_id'=>$course,'reservation_id'=>$res_type));	
		$where="status='alloted' or status='admitted '";
		 $this->db->where($where);
		 $this->db->from('ranking_rank_master');	
		 $query = $this->db->get();// echo $this->db->last_query();exit;
		return $query->row_array();
	}
	public function insert_student($data)
	{
		//echo $students."aaa".$college."aaaa".$course."aaaa".$res_type."aaa".$option."aaaa".$rank;exit;
		$ins=$this->db->insert('ranking_rank_master', $data);
		if($ins) return $this->db->insert_id();
		else return 0;
		
	}
	
	public function get_index($student,$course)
	{
		$this->db->select('index_id');
		$this->db->where(array('student_id' => $student,'course_id'=>$course));
		 $this->db->from('ranking_index_marks_master');	
		 $query = $this->db->get();// echo $this->db->last_query();exit;
		return $query->row_array();
	}
	public function delete_student($college,$course,$status,$optionNo,$student)
	{
			//echo $student."aaa".$college."aaaa".$course."aaaa".$optionNo."aaa".$status."aaaa";exit;
			//echo $status;exit;
			if($status=='alloted')
			{
				//echo "if";exit;
				  $this->db->where(array('college_id' => $college,'course_id'=>$course,'option_no'=>$optionNo,'student_id'=>$student));	
				  $this->db->delete('ranking_rank_master');// echo $this->db->last_query();exit;
				  return $this->db->affected_rows();
			}
			else if($status=='admitted')
			{// echo"else";exit;
				$this->db->set('status','higher_opt');
				  $this->db->where(array('college_id' => $college,'course_id'=>$course,'option_no'=>$optionNo,'student_id'=>$student));	
				  $this->db->update('ranking_rank_master');//echo $this->db->last_query();exit;
                  return $this->db->affected_rows();
			}
	}
	
	public function update_rank_prev($college,$course,$rank,$res)
	{
		$sql="UPDATE `ranking_rank_master` SET rank=rank-1 WHERE `college_id` = ".$college." AND `course_id` = ".$course." AND `reservation_id` = ".$res." AND `rank` > ".$rank." AND `status` = 'alloted' or `status` = 'admitted '";
		$query=$this->db->query($sql);//echo $this->db->last_query();exit;
		return 1;
		
	}
	
	public function update_temp_table($student,$optn_no)
	{
		$sql="UPDATE `temp_table_for_ranking_final` SET status='inactive' WHERE `account_id` = ".$student." AND `option_registration_order` > ".$optn_no;
		$query=$this->db->query($sql);//echo $this->db->last_query();exit;
		return 1;
		
	}
	public function update_temp_table_admit($student,$optn_no)
	{
		$sql="UPDATE `temp_table_for_ranking_final` SET status='admit' WHERE `account_id` = ".$student." AND `option_registration_order` = ".$optn_no;
		$query=$this->db->query($sql);//echo $this->db->last_query();exit;
		return 1;
		
	}
	
	public function get_colg_couse($col,$cos)//checked
	{
	    $this->db->select('*');
        $this->db->from('ugcap_college_course_map');
		$this->db->where('college_course_status','active');	
		$this->db->where('college_id',$col);	
		$this->db->where('specialisation_id',$cos);		
		$query = $this->db->get();
    	return $query->row_array();	
	}
	
	public function get_rem_totseats($coll,$cou)
	{
		
		$this->db->select('count(*) as alloted');
		$this->db->where(array('college_id' => $coll,'course_id'=>$cou));	
		$where="status='alloted' or status='admitted '";
		 $this->db->where($where);
		 $this->db->from('ranking_rank_master');	
		//$this->db->from('ranking_rank_master_count28666');		
		$query = $this->db->get(); //echo  $this->db->last_query();//exit;
		$alot= $query->row_array();
	//	echo $alot['alloted'];//exit;
		
		$this->db->select('sum(seats_general+seats_ezhava_thiyya_billava+seats_muslim+seats_latin_catholics+seats_obx+seats_obh+seats_bpl+seats_sc+seats_st+seats_oec+seats_sebc) as seats_total');
        $this->db->from('ugcap_college_course_map');
		$this->db->where('college_course_status','active');	
		$this->db->where('college_id',$coll);	
		$this->db->where('specialisation_id',$cou);		
		$query = $this->db->get();//echo  $this->db->last_query();exit;
    	$tot= $query->row_array();
		//echo $tot['seats_total'];exit;	
		$rem=$tot['seats_total']-$alot['alloted'];
		//echo $rem;exit;
		return $rem;
		
	}
	
	
	
	
}// end of public model