<?php 
/* eligible report generation query :
update nss_stud set elig='Y' where tot_hr>=240 and splcamp='YES' and (mini1 ='YES' or mini2 ='YES')
 and enrolled_date like '2017%'and  enroll_end like '2019%';

*/

/* certificate verification 

INSERT INTO cert_verify_2017_2019 (nss_stud_id, enroll_no, prn, name, college_name, course, nss_batch, nss_unit, verified_by, verified_on, verified_desig, status)
select a.nss_stud_id,a.nss_enroll_id,a.account_id,a.account_student_name,b.college_name_for_gradecard,a.specialisation_id,a.batch_period,
 a.nss_enroll_unit,'XYZ','2019-03-01 00:00:00','NSS PROGRAMME CO-ORDINATOR','active' from nss_stud as a
inner join nss_college as b
on a.college_id = b.college_id
;

*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Publicmodel extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function get_upload_activity($data)//checked
	{
	    $this->db->select('*');
        $this->db->from('nss_photo_activity');
		if($data == "y")
		$this->db->where('checked',1);
		$this->db->where('college_id','mgu');
		$query = $this->db->get();
    	return $query->result_array();	
	}
	public function Add_mastertable($data)
	{
		$ins = $this->db->insert_batch('nss_from_cap',$data);
  		return $this->db->insert_id();
	}
	
	
	
	public function update_nss_front_photo($data)//checked
	{
		$this->db->where_in('photo_activity_id',$data);	
		$this->db->set('checked',1,FALSE);
		$this->db->update('nss_photo_activity');
        return $this->db->affected_rows(); 
	}
	public function update_nss_front_photo_not($data)//checked
	{
		$this->db->where_not_in('photo_activity_id',$data);
		$this->db->set('checked',0,FALSE);
		$this->db->update('nss_photo_activity');
		 return $this->db->affected_rows();
	}
	public function insert_front_image($data)
	{
		$ins = $this->db->insert_batch('nss_photo_activity',$data);
  		return $this->db->insert_id();
	}
	public function get_stud_det($id)
	{
		$this->db->select('*')
          	 ->from('nss_stud')
    		 ->where('nss_stud_id',$id);
  		$query = $this->db->get();
     	return $query->row_array();
	}
	public function get_stud_certi($id)
	{
  		$this->db->select('STUD.account_student_name,STUD.nss_enroll_id,COU.specialisation_display_name,COL.college_name_for_gradecard,UNIT.from_date,UNIT.to_date,CAMP.fromdate,CAMP.todate,CAMP.nss_camp_desti,ELI.total_hr');
  		$this->db->where('STUD.nss_stud_id', $id  );
  		$this->db->where('STUD.nss_status', 'active'  );
  		$this->db->where('COL.college_status', 'active'  );
  		$this->db->where('COU.specialisation_status', 'active'  );
  		$this->db->where('UNIT.status', 'active'  );
  		$this->db->from('nss_stud STUD');
  		$this->db->join('nss_college COL', 'STUD.college_id=COL.college_id',  'inner');
  		$this->db->join('nss_college_course_map COUMAP', 'COL.college_id=COUMAP.college_id',  'inner');
  		$this->db->join('nss_course_map COU', 'COUMAP.course_id=COU.course_id',  'inner');
  		$this->db->join('nss_unit UNIT', 'STUD.college_id=UNIT.college_id AND STUD.batch_period = UNIT.batch_period AND STUD.nss_enroll_unit=UNIT.nss_unit_id ',  'inner');
  		$this->db->join('nss_camp CAMP', 'STUD.college_id=CAMP.college_id AND STUD.batch_period = CAMP.batch_period AND STUD.nss_enroll_unit=CAMP.nss_unit AND CAMP.nss_camp_type="spl" ',  'inner');
  		$this->db->join('nss_elig_rep ELI', 'STUD.nss_stud_id=ELI.nss_stud_id',  'inner');
 		$query = $this->db->get();
        return $query->row_array();
	}
	public function add_login_attempt($data)
	{
		$ins = $this->db->insert('nss_login_attempts',$data);
  		return $this->db->insert_id();
	}
	public function get_ver_final($college_id,$unit_id,$batch)
	{
     	$query = $this->db->get_where('nss_stud', array('college_id' => $college_id,'nss_enroll_unit'=> $unit_id,'batch_period'=> $batch,'verification_id'=>'8'));
  		return $query->row_array(); 
	}
	public function getlogin($uname,$pwd)
	{ 
		$query = $this->db->get_where('nss_login',array('username'=>$uname,'password'=>$pwd));
		return $query->row_array();	
	}
	public function fwd_prin_eli($data)
	{
		$data_upd=array('verification_id'=>$data['chg_ver_id'],'remarks'=>$data['remarks']);
		$this->db->where('college_id',$data['college_id']);
		$this->db->where('batch_period',$data['batch_period']);
		$this->db->where('nss_unit',$data['nss_unit']);
		$this->db->update('nss_elig_rep',$data_upd);
     	return $this->db->affected_rows(); 
	}
	public function get_prin_login_details($college_id)
	{
  		$this->db->select('GROUP_CONCAT(UNI.nss_unit_id SEPARATOR "|") as nss_unit_id,GROUP_CONCAT(UNI.batch_period SEPARATOR "|") as batch_period,COL.college_name');
		$this->db->where('COL.college_id', $college_id  );
		$this->db->where('COL.college_status', 'active'  );
		$this->db->where('(UNI.status = "active" or UNI.status IS NULL)'  );
  		$this->db->from('nss_college COL');
		$this->db->join('nss_unit UNI', 'COL.college_id=UNI.college_id',  'left');
  		$query = $this->db->get();//echo $this->db->last_query();exit;
        return $query->row_array();
	}
	public function po_log_attempt($data)
	{
		$ins = $this->db->insert('nss_po_log',$data);
  		return $this->db->insert_id();
    }
	public function princi_log_attempt($data)
	{
		$ins = $this->db->insert('nss_princi_log',$data);
  		return $this->db->insert_id();
    }
	public function assi_log_attempt($data)
	{
		$ins = $this->db->insert('nss_assi_log',$data);
  		return $this->db->insert_id();
    }
	public function so_log_attempt($data)
	{
		$ins = $this->db->insert('nss_so_log',$data);
  		return $this->db->insert_id();
    }
	public function get_po_login_details($login_id)
	{
  		$this->db->select('LOG.college_id,LOG.user_type,LOG.name,LOG.user_id,COL.college_name,UNI.nss_unit_id,UNI.batch_period,UNI.unit_id');
  		$this->db->where('LOG.status', 'active'  );
		$this->db->where('LOG.login_id', $login_id  );
		$this->db->where('COL.college_status', 'active'  );
		$this->db->where('(UNI.status="active" or UNI.status IS NULL)'  );
  		$this->db->from('nss_login LOG');
		$this->db->join('nss_college COL', 'LOG.college_id=COL.college_id',  'inner');
		$this->db->join('nss_unit UNI', '(COL.college_id=UNI.college_id or UNI.college_id IS NULL) AND (UNI.po_id = LOG.user_id or UNI.po_id IS NULL)',  'left');
  		$query = $this->db->get();
        return $query->result_array();
	}
	public function getlogin_login_id($login_id)
	{
		$query = $this->db->get_where('nss_login',array('login_id'=>$login_id));
 		return $query->row_array(); 
	}
	public function addlogin($data)
	{
		$ins = $this->db->insert('nss_login',$data);
		return $this->db->insert_id();
	}
	public function get_login_count()
	{
		$query =  $this->db->select('login_id')->order_by('login_id',"desc")->limit(1)->get('nss_login');
		return $query->row_array(); 
	}
	public function mail_track($data)
	{ //print_r($data);exit;
		$ins = $this->db->insert('nss_mail_track_create_princi',$data);
  			return $this->db->insert_id();
	}
	public function addlogin_batch($data)
	{
		$ins = $this->db->insert_batch('nss_login',$data);
  		return $this->db->insert_id();
	}
	public function get_fund_gov_year($yr)
	{
		 $this->db->select('*')
          	  ->from('nss_fund_from_govt')
    		  ->where('year',$yr);
  		$query = $this->db->get();
     	return $query->row_array();
	}
	public function getlistcollege()
	{
		$this->db->select('*')
          	  ->from('nss_college')
    		  ->where('college_status','active')
			  ->order_by('college_district', 'asc')
			  ->order_by('college_name', 'asc');
  		$query = $this->db->get();
     	return $query->result_array();
	}
	public function getlistcollege_dist($dis)
	{
		if($dis<>'null')
		$this->db->where('college_district',$dis);
		
		
		$this->db->select('college_id,college_name')
          	  ->from('nss_college')
    		  ->where('college_status','active')			  
			  ->order_by('college_name', 'asc');
  		$query = $this->db->get();
     	return $query->result_array();
	}
	public function get_fund_gov()
	{
		$this->db->select('*')
          	  ->from('nss_fund_from_govt')
    		  ->where('status','active');
  		$query = $this->db->get();
     	return $query->result_array();
	}
	public function insert_fund_gov($data)
	{
		$ins = $this->db->insert('nss_fund_from_govt',$data);
  		return $this->db->insert_id();
	}
	public function update_fund_gov($data)
	{
		$data1=array( 'verification_id'=>$data['ver_id'],'remarks'=>$data['remarks'] );
 		$this->db->where('nss_fund_govt_id',$data['id']);
 		$this->db->update('nss_fund_from_govt',$data1); 
 		return $this->db->affected_rows(); 
	}
	public function upd_mon_rep_fwd($data,$ver_id)
	{
		$data1=array( 'verification_id'=>$ver_id );
  		$this->db->where_in('nss_monthly_report_id',$data);
  		$this->db->update('nss_monthly_report',$data1); 
  		return $this->db->affected_rows(); 
	}
	public function get_college_name($college_id)
	{
		$query = $this->db->get_where('nss_college',array('college_id'=>$college_id ,'college_status'=>'active'));	
		return $query->row_array();
	}
	public function get_colge_email($college_id)
	{
		$this->db->select('college_email,college_id')
          	 ->from('nss_college')
    		 ->where_in('college_id',$college_id);
  		$query = $this->db->get();
     	return $query->result_array();
	}
	public function get_college_type_list($type)
	{//used in nssadmin-sanctioned_fund
		$this->db->select('COL.college_id,COL.college_name_for_gradecard,COL.college_address,COL.college_type,COL.college_email,CONCAT(CONCAT(COL.college_contact_no," / "),COL.college_contact_no2) as college_contact_no,FUND.nss_fund_sanc_id,FUND.fund_college_id,FUND.fund_status');
   		$this->db->where('COL.nss_college_type', $type  );
  		$this->db->where('COL.college_status','active');
		$this->db->where('((FUND.fund_status="inactive" AND FUND.year='.date('Y').' )or FUND.nss_fund_sanc_id IS NULL)');
   		$this->db->from(' nss_college COL');
    	$this->db->join('nss_fund_sanc FUND', 'COL.college_id=FUND.fund_college_id' ,  'left');
    	$query = $this->db->get();
		return $query->result_array();
	}
	public function fwd_so_sanc_fund($data)
	{
		$data1=array( 'verification_id'=>$data['ver_id'],'remark'=>$data['remark'] );
		$this->db->where_in('nss_fund_sanc_id',$data['ids']);
		$this->db->update('nss_fund_sanc',$data1); 
 		return $this->db->affected_rows(); 
	}
	public function get_college_fund_sanc_list($data)
	{//used in nssadmin-view_sanc_fund
	//print_r($data);exit;
		$this->db->select('COL.college_id,COL.college_name_for_gradecard,COL.college_address,COL.college_type,COL.college_email,CONCAT(CONCAT(COL.college_contact_no," / "),COL.college_contact_no2) as college_contact_no,FUND.nss_fund_sanc_id,FUND.fund_college_id,FUND.year,FUND.amount_sanc,FUND.fund_status,FUND.verification_id,FUND.remark');
   		$this->db->where('FUND.fund_college_type', $data['type']  );
  		$this->db->where('COL.college_status','active');
		$this->db->where('FUND.fund_status="active" ');
		$this->db->where('FUND.year', $data['year']);
   		$this->db->from(' nss_college COL');
    	$this->db->join('nss_fund_sanc FUND', 'COL.college_id=FUND.fund_college_id' ,  'inner');
    	$query = $this->db->get();//echo $this->db->last_query();exit;
		return $query->result_array();	
	}
	public function remove_fund_sanc_col($nss_fund_sanc_id)
	{
		$data1=array( 'fund_status'=>'inactive' );
 		$this->db->where('nss_fund_sanc_id',$nss_fund_sanc_id);
 		$this->db->update('nss_fund_sanc',$data1); 
  		return $this->db->affected_rows(); 
	}
	public function get_year_fund()
	{//used in nssadmin-view_sanc_fund  
		$this->db->distinct(); 
		$this->db->select('year');
        $this->db->from('nss_fund_sanc');
    	$this->db->where('fund_status','active');
 		$query = $this->db->get();
     	return $query->result_array();
	}
	public function chk_fund_sanc($data)
	{
	    $this->db->select('*')
               ->from('nss_fund_sanc')
               ->where_in('fund_college_id ',$data['colge_chk'])
			   ->where('fund_college_type',$data['colge_type'])
			   ->where('year',date('Y'));
 	    $query = $this->db->get();
        return $query->result_array();
	}
	public function update_fund_sanc_status($data)
	{
		$uid = $this->db->update_batch('nss_fund_sanc',$data,'nss_fund_sanc_id');
		if($uid)
		return TRUE; 
		else
		return FALSE;
	}
	public function chk_fund_sanc_active($data)
	{
		$this->db->select('*')
               ->from('nss_fund_sanc')
               ->where_in('fund_college_id ',$data['list'])
			   ->where('fund_college_type',$data['colge_type'])
			   ->where('year',date('Y'))
			   ->where('fund_status','active');
 	    $query = $this->db->get();
        return $query->result_array();
	}
	public function get_blood_bank($blood)
	{
		$this->db->select('STUD.blood_group,STUD.account_student_name,STUD.donate,STUD.nss_stud_id,STUD.nss_enroll_unit,STUD.college_id,PO.po_name,PO.po_contact');
		$this->db->where('STUD.blood_group', $blood  );
		$this->db->from('nss_unit UNIT');
		$this->db->join('nss_po PO', 'PO.po_id=UNIT.po_id',  'inner');
		$this->db->join('nss_stud STUD', 'STUD.nss_enroll_unit=UNIT.nss_unit_id',  'inner');
		$this->db->group_by('STUD.nss_stud_id');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
		return $query->result_array();
	}
	public function add_po($data)
	{
		$ins=$this->db->insert('nss_po',$data);
		return $this->db->insert_id();
	}
	public function get_po($colge_id)
	{
		$this->db->select('PO.po_id,PO.po_name,PO.po_gender,PO.po_address,PO.po_contact,PO.po_pin,PO.po_email,PO.po_join_date,PO.po_uploaded_img,PO.college_id,PO.po_status,UNIT.unit_id,UNIT.nss_unit_id,UNIT.batch_period,UNIT.from_date,UNIT.to_date,UNIT.total_stud,COL.college_name');
		if(isset($colge_id)&& !empty($colge_id))
		$this->db->where('PO.college_id',$colge_id);
		$this->db->where('PO.po_status = "active"');
		$this->db->from('nss_po PO');
		$this->db->join('nss_unit UNIT', 'UNIT.po_id=PO.po_id',  'left');
		$this->db->join('nss_college COL','COL.college_id=PO.college_id','left');
		$query = $this->db->get();
     	return $query->result_array();
	}
	public function get_po_detail($data)
	{	
		 $this->db->select('*');
         $this->db->from('nss_po');
		 if($data['college_id'])
    	 $this->db->where('college_id',$data['college_id']);
		 if($data['batch_period']){
		 $batch_period = explode("|",$data['batch_period']);	
    	 $this->db->where_in('batch_period',$batch_period);}
		 if($data['unit']){
		 $unit = explode("|",$data['unit']);	 
    	 $this->db->where_in('nss_unit_id',$unit);}
  		 $query = $this->db->get();
     	 return $query->result_array();
	}
	public function get_po_detail_princi($data)
	{//left join nss_po and nss_unit
		$this->db->select('PO.po_id,PO.po_name,PO.po_gender,PO.po_address,PO.po_contact,PO.po_pin,PO.po_email,PO.po_join_date,PO.po_uploaded_img,PO.college_id,PO.po_status,UNIT.unit_id,UNIT.nss_unit_id,UNIT.batch_period,UNIT.from_date,UNIT.to_date,UNIT.total_stud');
		$this->db->where('PO.college_id',$data['college_id']);
		$this->db->where('PO.po_status = "active"');
		$this->db->from('nss_po PO');
		$this->db->join('nss_unit UNIT', 'UNIT.po_id=PO.po_id',  'left');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
     	return $query->result_array();
	}
	public function update_po_data($data)
	{
		
 		$this->db->where('po_id',$data['po_id']);
  		$this->db->update('nss_po',$data); 
  		return $this->db->affected_rows();
	}
	public function check_po($po_id)
	{
		 $query = $this->db->get_where('nss_po', array('po_id' => $po_id,'po_status'=> 'active'));
		 return $query->row_array();
	}
	public function get_po_inactive($colge_id,$chk)
	{
		$this->db->where_in('po_id',$chk);
	    $query = $this->db->get_where('nss_po', array('college_id' => $colge_id,'po_status'=> 'inactive'));
		return $query->result_array();		
	}
	public function get_po_form($po_id)
	{ 
	    $query = $this->db->get_where('nss_po', array('po_id' => $po_id));
		return $query->row_array();		
	}
	public function update_po($chks)
	{
	 	$data1=array( 'po_status'=>'inactive' );
	 	$this->db->where_in('po_id',$chks);
	 	$this->db->update('nss_po',$data1);	
	 	return $this->db->affected_rows();	
	}
	public function updatelogin($chks)
	{
		$data1=array('status'=>'inactive');
	 	$this->db->where_in('username',$chks);
		$this->db->update('nss_login',$data1);
		return $this->db->affected_rows();		 
	}
	public function update_login_pwd($data,$id)
	{
		$this->db->where_in('login_id',$id);
		$this->db->update('nss_login',$data);
		return $this->db->affected_rows();
	}
	
	public function update_login_name($user_id,$data)
	{
		$this->db->where('user_id',$user_id);
	 	$this->db->update('nss_login',$data);
	 	return $this->db->affected_rows();
	}
	public function login_upd_prin($data,$id)
	{
	 	$this->db->where('login_id',$id);
		$this->db->update('nss_login',$data);
	 	return $this->db->affected_rows();		 
	}
	public function update_login($data)
	{
		$data1=array('status'=>'inactive');
	 	$this->db->where('user_id',$data);
	 	$this->db->update('nss_login',$data1);
	 	//echo $this->db->last_query();exit;
		return $this->db->affected_rows();		
	}
	public function add_unit($data)
	{ 
		$ins=$this->db->insert('nss_unit',$data);
		return $this->db->insert_id();
	}
	public function update_unit($data)
	{
	 	$this->db->where('unit_id',$data['unit_id']);
	 	$this->db->update('nss_unit',$data);	
	 	return $this->db->affected_rows();	
	}
	public function get_unit_with_unitid($unit_id)
	{ 
	    $this->db->select('*')
        	 ->from('nss_unit')
			 ->where('unit_id',$unit_id);
		$query = $this->db->get();
		return $query->row_array();	
	}
	public function get_unit($colge_id)
	{ 
		$cur_year = date('Y');
		$after2yr = date('Y') + 2;
		$period = $cur_year.'-'.$after2yr; 
	    $this->db->select('*')
        	 ->from('nss_unit')
			 ->where('college_id',$colge_id)
			 ->where('batch_period',$period );
		$query = $this->db->get();
		return $query->result_array();	
	}
	public function get_unit_po($colge_id)
	{ //to get the po name as well as unit details from nss unit table
	    $status = 'active';
		$this->db->select('UNIT.unit_id,UNIT.nss_unit_id,UNIT.batch_period,UNIT.po_id,UNIT.from_date,UNIT.to_date,UNIT.total_stud,PO.po_name,UNIT.status');
		$this->db->where('UNIT.college_id', $colge_id  );
		$this->db->where('PO.po_status', $status  );
		$this->db->from('nss_unit UNIT');
		$this->db->join('nss_po PO', 'UNIT.po_id=PO.po_id',  'inner');
		 $this->db->order_by('PO.po_id', 'asc');
		$query = $this->db->get();
        return $query->result_array();
	}
	public function get_profile_po($po_id)
	{
  		$this->db->select('PO.po_id,PO.po_name,PO.po_gender,PO.po_address,PO.po_contact,PO.po_pin,PO.po_email,PO.po_join_date,PO.po_uploaded_img,PO.college_id,UNIT.nss_unit_id,UNIT.batch_period,PO.po_status,UNIT.total_stud,UNIT.from_date,UNIT.to_date');
  		$this->db->where('PO.po_id', $po_id  );
  		$this->db->where('PO.po_status','active'  );
		$this->db->from('nss_po PO');
  		$this->db->join('nss_unit UNIT', 'UNIT.po_id=PO.po_id',  'left');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
        return $query->row_array();
	}
	public function get_profile_princi($princi_id)
	{
  		$this->db->select('PRINCI.principal_id,PRINCI.principal_email,PRINCI.principal_name,PRINCI.principal_contact,PRINCI.from_date,group_concat( UNIT.nss_unit_id)unit,group_concat(UNIT.batch_period)batch_period,group_concat(UNIT.total_stud)total_stud');
  		$this->db->where('PRINCI.principal_id', $princi_id  );
  		$this->db->where('PRINCI.status','active'  );
		$this->db->from('nss_principal PRINCI');
  		$this->db->join('nss_unit UNIT', 'UNIT.college_id=PRINCI.college_id AND UNIT.status="active"',  'left');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
        return $query->row_array();
	}
	public function insert_monthly_report($data)
	{
		$ins = $this->db->insert('nss_monthly_report',$data);
  		return $this->db->insert_id();
	}
	public function update_monthly_report($data)
	{
		$data1=array( 'heading'=>$data['heading'], 'content'=>$data['content'],'image'=>$data['image'] );
  		$this->db->where('college_id',$data['college_id']);
  		$this->db->where('nss_unit',$data['nss_unit']);
  		$this->db->where('batch_period',$data['batch_period']);
  		$this->db->where('year',$data['year']);
  		$this->db->where('month',$data['month']);
  		$this->db->where('from_date',$data['from_date']);
  		$this->db->where('to_date',$data['to_date']);
		$this->db->update('nss_monthly_report',$data1); 
  		return $this->db->affected_rows(); 
	}
	public function get_monthly_report_all($year1)
	{
  		$this->db->select('MR.nss_unit,MR.batch_period,MR.year,MR.month,MR.from_date,MR.to_date,MR.heading,MR.content,MR.image,COL.college_name_for_gradecard,COL.college_id');
 		$this->db->where('MR.year', $year1 );
 		$this->db->where('MR.status','active'  );
 		$this->db->from('nss_monthly_report MR');
  		$this->db->join('nss_college COL', 'MR.college_id=COL.college_id',  'inner');
   		$this->db->order_by('COL.college_name_for_gradecard', 'asc');
  		$query = $this->db->get();
    	return $query->result_array();
	}
	public function get_yrs_monthly_report($college_id)
	{
		$this->db->select('year');
		$this->db->distinct('year');
		if(!empty($college_id))
		$this->db->where('college_id',$college_id);
		$query = $this->db->get('nss_monthly_report');		
		return $query->result_array();
	}
	public function get_monthly_report_princi($data_chk)
	{
		if((isset($data_chk['month'])))
		{
		$query = $this->db->get_where('nss_monthly_report',array('college_id'=>$data_chk['college_id'],'year'=>$data_chk['year'],'month'=>$data_chk['month']));
		return $query->result_array(); 
		}else
		{
		$query = $this->db->get_where('nss_monthly_report',array('college_id'=>$data_chk['college_id'],'year'=>$data_chk['year']));
		return $query->result_array(); 
		}
	}
	public function get_mothly_report($data_chk)
	{
		if((isset($data_chk['from_date']))&&(isset($data_chk['to_date'])))
		{
		$query = $this->db->get_where('nss_monthly_report',array('college_id'=>$data_chk['college_id'],'nss_unit'=>$data_chk['nss_unit'],
		'batch_period'=>$data_chk['batch_period'],'year'=>$data_chk['year'],'month'=>$data_chk['month'],'from_date'=>$data_chk['from_date'],
		'to_date'=>$data_chk['to_date']
		));
		return $query->result_array(); 
		}elseif(isset($data_chk['month'])&&(isset($data_chk['nss_unit']))){
		$query = $this->db->get_where('nss_monthly_report',array('college_id'=>$data_chk['college_id'],'nss_unit'=>$data_chk['nss_unit'],
		'batch_period'=>$data_chk['batch_period'],'year'=>$data_chk['year'],'month'=>$data_chk['month']
		));	
		return $query->result_array(); 
		}
		else
		{
		 $this->db->select('*')
          		  ->from('nss_monthly_report')
    			  ->where('college_id',$data_chk['college_id'])
				  ->where('nss_unit',$data_chk['nss_unit'])
				  ->where('batch_period',$data_chk['batch_period'])
				  ->where('year',$data_chk['year'])
				  ->order_by('month', 'asc')
				  ->order_by('from_date', 'asc');
				  
  		$query = $this->db->get();
		return $query->result_array();
		}
	}
	public function insert_monthly_fund_upload($data)
	{
		$ins = $this->db->insert('nss_monthly_fund',$data);
		return $this->db->insert_id();
	}
	public function insert_sanc_func($data)
	{
		$ins = $this->db->insert_batch('nss_fund_sanc',$data);
  		return $this->db->insert_id();
	}
	public function get_monthly_upload($college_id)
	{
		$this->db->select('*')
        	 ->from('nss_monthly_fund')
			 ->where('nss_college_id',$college_id);
		$query = $this->db->get();
    	return $query->result_array();
	}
	public function get_num_units($data)
	{//nssprinci-create_unit
		$this->db->where('college_id', $data['college_id']);
		$this->db->where('batch_period', $data['batch_period']);
		$this->db->where('status','active');
		$this->db->from('nss_unit');
		$cnt = $this->db->count_all_results();
		return $cnt;
	}
	public function get_audit_last5($college_id)
	{	
		$this->db->select('*')
              ->from('nss_audit')
   			  ->where('college_id',$college_id)
			  ->order_by('year','desc')
			  ->limit(5);
  		$query = $this->db->get();
    	return $query->result_array();	
	}
	public function audit_admin($data)
	{
		if($data['remark']!="")
		$data1=array( 'verification_id'=>$data['ver_id'] ,'remarks'=>$data['remark']);
		else
		$data1=array( 'verification_id'=>$data['ver_id'],'remarks'=>'');
		if($data['year']=="ALL")
		$this->db->where_in('nss_audit_id',$data['id']);
		else
  		$this->db->where('nss_audit_id',$data['id'][0]);
		$this->db->update('nss_audit',$data1); 
  		return $this->db->affected_rows();
	}
	public function get_audit_year($data)
	{
		$this->db->select('*');
        $this->db->from('nss_audit');
   		$this->db->where('college_id',$data['college_id']);
		if($data['year']!="ALL")
		$this->db->where('year',$data['year']);
		$this->db->order_by('year','desc');
  		$query = $this->db->get();
    	return $query->result_array();
	}
	public function get_fund_last5($college_id)
	{	
		 $this->db->select('*')
              ->from('nss_fund')
   			  ->where('college_id',$college_id)
			  ->order_by('year','desc')
			  ->group_by('year')
			  ->limit(5);
  		$query = $this->db->get();
    	return $query->result_array();	
	}
	public function ins_audit($data)
	{
		$ins = $this->db->insert('nss_audit',$data);
  		return $this->db->insert_id();
	}
	public function get_student()
	{
		$query = $this->db->get_where('nss_stud',array('student_status'=>'active'));	
		return $query->result_array();
	}
	public function get_college_code()
	{
		$query = $this->db->select('*')->from('nss_college')
       						->where("college_code LIKE 'X%'")->get();
		return $query->result_array();	
	}
	public function insert_new_college($data)
	{
		$ins = $this->db->insert('nss_college',$data);
		return $this->db->insert_id();
	}	
	public function insert_princi($datap)
	{
		$ins = $this->db->insert('nss_principal',$datap);
		return $this->db->insert_id();
	}
	public function insertcsv($data)
	{
	 	$query = $this->db->insert('nss_college', $data);
     	return TRUE;
	}
	public function insertcsvstud($data)
	{
	 	$query = $this->db->insert('nss_stud', $data);
     	return TRUE;
	}
	public function get_princi($college_id)
	{
		 $this->db->select('*')
        	 ->from('nss_college')
			 ->where('college_id',$college_id);
		$query = $this->db->get();
    	return $query->result_array();	
	}
	public function get_princi_college($college_id)
	{
		$this->db->select('COL.college_code,COL.college_name,
		PRI.principal_id,PRI.principal_name,PRI.principal_contact,PRI.principal_address,PRI.principal_email,PRI.from_date,PRI.to_date');
		$this->db->where('COL.college_id', $college_id );
		$this->db->where( 'PRI.status','active' );
		$this->db->where( 'COL.college_status','active' );
		$this->db->from('nss_college COL');
		$this->db->join('nss_principal PRI','COL.college_id = PRI.college_id','inner');
		$this->db->order_by('PRI.from_date', 'asc');
		$query = $this->db->get();
        return $query->result_array();
	}
	// monthly attendance + nss stud
	public function get_monthly_nss_stud($college_id,$unit,$nss_stud_list,$batch_period)
	{	
  		$this->db->where_in('nss_stud_id',$nss_stud_list);
    	$query = $this->db->get_where('nss_stud', array('college_id' => $college_id,'nss_enroll_unit'=> $unit,'batch_period'=>$batch_period));
  		return $query->result_array(); 
	}
	//enroll id from nss_stud_id
	public function get_enroll_from_stud_id($data)
	{	$this->db->select('nss_enroll_id,nss_stud_id');
		$this->db->where_in('nss_stud_id',$data);
		$this->db->order_by("nss_stud_id", "dsc");
        $query = $this->db->get_where('nss_stud');
  		return $query->result_array(); 
	}
	public function update_monthly_atten($dataupd,$m_id)
	{	
		$this->db->where('m_attendance_id',$m_id);
  		$this->db->update('nss_m_attendance',$dataupd); 
  		return $this->db->affected_rows(); 
	}
	public function remove_map_atten($mid,$data)
	{
	    $this ->db-> where_in('nss_stud_id', $data);
		$this->db->where('monthly_id',$mid);
        $this -> db -> delete('nss_map_monthlyatten_stud');
		 if($this->db->affected_rows()>0)
   		{	return true;
		}
 		 else
  		{	 return false;}
	}
	public function remove_map_camp($cid,$data)
	{
	    $this ->db-> where_in('nss_stud_id', $data);
		$this->db->where('nss_camp_id',$cid);
        $this -> db -> delete('nss_map_camp');
		 if($this->db->affected_rows()>0)
   		{	return true;
		}
 		 else
  		{	 return false;
		}
	}
	public function insert_camp($data)
	{
		$ins = $this->db->insert('nss_camp',$data);
  		return $this->db->insert_id();
	}
	public function insert_monthly_atten($data)
	{
		$ins = $this->db->insert('nss_m_attendance',$data);
  		return $this->db->insert_id();
	}
	public function insert_map_monthly($data)
	{
		$ins = $this->db->insert_batch('nss_map_monthlyatten_stud',$data);
  		return $this->db->insert_id();
	}
	public function insert_map_camp($data)
	{
		$ins = $this->db->insert_batch('nss_map_camp',$data);
  		return $this->db->insert_id();
	}
	//stud+ course specialisation ( monthly attendance purpose)
	public function get_enroll_stud_course($college_id,$unit,$batch_period)
	{
  		$this->db->select('STUD.nss_stud_id,STUD.account_id,STUD.nss_enroll_id,STUD.current_semester,STUD.admission_year,STUD.account_student_name,STUD.college_id,COURSE.specialisation_display_name');
  		$this->db->where('STUD.college_id', $college_id);
  		$this->db->where('STUD.nss_enroll_unit',$unit);
		$this->db->where('STUD.batch_period',$batch_period);
  		$this->db->where('STUD.student_status','active');
  		$this->db->where('COURSE.specialisation_status', 'active'  );
  		$this->db->from('nss_stud STUD');
  		$this->db->join('nss_course_map COURSE', 'STUD.specialisation_id=COURSE.specialisation_id',  'inner');
   		$this->db->order_by('STUD.account_student_name', 'asc');
  		$query = $this->db->get();
  		return $query->result_array();
	}
	public function chk_elig_rep($college,$batch_period,$unit,$ver_id)
	{
      
		
		 $this->db->select('*');
          $this->db->from('nss_elig_rep');
    $this->db->where('college_id',$college);
	$this->db->where('nss_unit',$unit);
		$this->db->where('batch_period',$batch_period);
		$this->db->where_in('verification_id',$ver_id);
	
	
  $query = $this->db->get();
     return $query->result_array();
	}
	public function elig_rep($college,$batch_period,$unit)
	{
     	$query = $this->db->get_where('nss_elig_rep', array('college_id' => $college,'nss_unit'=> $unit,'batch_period'=>$batch_period,'eligibile '=>'Y'));
     	return $query->result_array(); 
	}
	// join nss_college + nss_stud + nss_course_map + nss_camp + nss_map_camp + nss_map_monthlyatten_stud + nss_m_attendance
	public function get_data_for_elig_rep1($college,$batch_period,$unit)
	{
		/*$this->db->select('sum(camp.hour_camp)');
		$this->db->from('nss_camp  camp');
		$this->db->join('nss_map_camp  map_camp','camp.nss_camp_id = map_camp.nss_camp_id ','INNER');
		$this->db->where('map_camp.nss_stud_id','stud.nss_stud_id');
		$subQuery1 =  $this->db->get_compiled_select();
		$this->db->select( 'group_concat(camp.nss_camp_type)');
		$this->db->from('nss_camp  camp');
		$this->db->join('nss_map_camp  map_camp','camp.nss_camp_id = map_camp.nss_camp_id ','INNER');
		$this->db->where('map_camp.nss_stud_id','stud.nss_stud_id');
		$subQuery2 =  $this->db->get_compiled_select();
		$this->db->select('col.college_id,stud.nss_stud_id,stud.account_student_name,stud.nss_enroll_unit,stud.nss_enroll_id,cou.specialisation_display_name,
		map_atten.monthly_id,sum(atten.hours),('.$subQuery1.'),('.$subQuery2.')');
		$this->db->from('nss_college AS col');
		$this->db->join('nss_stud AS stud', 'col.college_id = stud.college_id', 'INNER');
		$this->db->join('nss_course_map AS cou', 'stud.specialisation_id = cou.specialisation_id', 'INNER');
		$this->db->join('nss_map_monthlyatten_stud AS map_atten', 'map_atten.nss_stud_id = stud.nss_stud_id', 'left');
		$this->db->join('nss_m_attendance AS atten', 'map_atten.monthly_id = atten.m_attendance_id', 'left');*/
	/*	$this->db->where('col.college_id',$college);
		$this->db->where('stud.nss_enroll_unit',$unit);
		$this->db->where('stud.batch_period',$batch_period);
		$this->db->where('stud.nss_status','active');
		$this->db->where('cou.specialisation_status','active');
		$this->db->where('stud.nss_enroll_id <> ');
		$this->db->group_by('stud.nss_stud_id'); 
		$this->db->order_by('stud.nss_stud_id', 'asc');*/
		//$query = $this->db->get();
		$query = $this->db->query('SELECT `col`.`college_id`,`stud`.`nss_stud_id`,`stud`.`account_student_name`,
`stud`.`nss_enroll_unit`,`stud`.`nss_enroll_id`,`cou`.`specialisation_display_name`,
`map_atten`.`monthly_id`, sum(`atten`.`hours`)atten_hour,( SELECT sum(`camp`.`hour_camp`) 
from nss_camp camp join nss_map_camp map_camp on camp.nss_camp_id = map_camp.nss_camp_id 
 where map_camp.nss_stud_id = stud.nss_stud_id) hour_camp,( select GROUP_CONCAT(`camp`.`nss_camp_type`) 
from nss_camp camp join nss_map_camp map_camp on camp.nss_camp_id = map_camp.nss_camp_id where map_camp.nss_stud_id = stud.nss_stud_id ) camp_type 
from nss_college col join nss_stud stud ON col.college_id = stud.college_id 
join nss_course_map cou ON stud.specialisation_id = cou.specialisation_id 
left join nss_map_monthlyatten_stud map_atten on map_atten.nss_stud_id = stud.nss_stud_id 
left join nss_m_attendance atten on map_atten.monthly_id = atten.m_attendance_id WHERE col.college_id = '. $college.' 
AND stud.nss_status = "active" AND stud.verification_id = "4" AND atten.verification_id = "4" AND stud.nss_enroll_unit <> "" AND stud.nss_enroll_id <> "" 
and cou.specialisation_status = "active" GROUP by stud.nss_stud_id
order by nss_stud_id');
// echo $this->db->last_query();exit;
	//	$query = $this->db->get();
        return $query->result_array();
	}
	public function insert_elig_rep($data)
	{
		$ins = $this->db->insert_batch('nss_elig_rep',$data);
		return $this->db->insert_id();
	}
	public function get_elig_college_stud_data($batch_period)
	{// join nss_college + nss_stud + nss_course_map + nss_camp + nss_map_camp + nss_map_monthlyatten_stud + nss_m_attendance
  		$this->db->select('COL.college_id,COL.college_type,
		STUD.nss_stud_id,STUD.account_student_name,STUD.nss_enroll_unit,STUD.nss_enroll_id
		,STUD.batch_period,SPL.specialisation_display_name,CMP.nss_cmp_type,CMP.hour_camp,ATTEN.hours');
  		$this->db->where('STUD.nss_status', 'active'  );
  		$this->db->where('STUD.batch_period', $batch_period);
		$this->db->where('CMP.batch_period', $batch_period);
		$this->db->where('ATTEN.batch_period', $batch_period);
  		$this->db->from('nss_college COL');
  		$this->db->join('nss_stud STUD', 'COL.college_id=STUD.college_id',  'inner');
		$this->db->join('nss_course_map SPL', 'STUD.specialisation_id = SPL.specialisation_id',  'inner');
		$this->db->join('nss_camp CMP', 'CMP.college_id = COL.college_id',  'inner');
		$this->db->join('nss_map_camp MAPCAMP', 'MAPCAMP.nss_camp_id = CMP.nss_camp_id',  'inner');
		$this->db->join('nss_map_camp MAPCAMP', 'MAPCAMP.nss_stud_id = STUD.nss_stud_id',  'inner');
		$this->db->join('nss_m_attendance ATTEN', 'ATTEN.college_id = COL.college_id',  'inner');
		$this->db->join('nss_map_monthlyatten_stud MAPATTEN', 'MAPATTEN.monthly_id = ATTEN.m_attendance_id',  'inner');
		$this->db->join('nss_map_monthlyatten_stud MAPATTEN', 'MAPATTEN.nss_stud_id = STUD.nss_stud_id',  'inner');
  		$this->db->order_by('COL.college_id', 'asc');
		$this->db->order_by('STUD.nss_stud_id', 'asc');
 		$query = $this->db->get();
        return $query->result_array();
	}
	//chk eligible report generted for the academic yr
	public function get_elgi_acc_yr($batch_period)
	{
		$this->db->select('college_id')
          	  ->from('nss_elig_rep')
              ->where('batch_period',$batch_period);
        $query = $this->db->get();
        return $query->row_array();
	}
	public function get_college_type()
	{
		$this->db->select('nss_college_type');
		$this->db->distinct();
		$query = $this->db->get('nss_college');		
		return $query->result_array();
	}
	public function get_college_name1($type)
	{
		$this->db->select('*')		
			 ->where('nss_college_type',$type);
		$query = $this->db->get('nss_college');		
		return $query->result_array();
	}
	 
	
	public function get_college_name_wo_princi($type)
	{
  		$this->db->select('COL.college_id,COL.college_name,COL.college_name_for_gradecard,COL.college_address,COL.college_pincode,COL.college_type,COL.college_email,COL.college_contact_no,COL.college_contact_no2,COL.college_fax');
 		$this->db->from('nss_college COL');
  		$this->db->join('nss_login LOG ', 'COL.college_id=LOG.college_id',  'left');
  		$this->db->where('LOG.login_id IS NULL', null,false  );
		$this->db->where('COL.nss_college_type ',$type);
		$this->db->where('COL.college_status ','active');
  		$query = $this->db->get();//echo $this->db->last_query();exit;
  		return $query->result_array();
	}
	public function princi_det_join()
	{
		$this->db->select('LOG.college_id,COL.college_name,COL.nss_college_type,PRIN.principal_name,PRIN.from_date,PRIN.to_date,PRIN.principal_id');
 		$this->db->from('nss_login LOG');
  		$this->db->join('nss_principal PRIN ', 'LOG.college_id=PRIN.college_id',  'left');
  		$this->db->where('LOG.user_type', 'principal'  );
		$this->db->where('(PRIN.status="active" or PRIN.status IS NULL)');
		$this->db->where('LOG.status', 'active'  );
		$this->db->where('COL.college_status ','active');
		$this->db->join('nss_college COL ', 'COL.college_id=LOG.college_id',  'inner');
  		$query = $this->db->get();
  		return $query->result_array();
	}
	public function prin_his($colge_id)
	{
		$this->db->select('*');
 		$this->db->from('nss_principal ');
		$this->db->where('college_id', $colge_id  );
		$this->db->order_by('from_date','desc');
  		$query = $this->db->get();
  		return $query->result_array();
	}
	public function update_princi($datae)
	{
		$data1=array( 'to_date'=>$datae['to_date'],'status'=>$datae['status'] );
	 	$this->db->where('principal_id',$datae['principal_id']);
	 	$this->db->update('nss_principal',$data1);	
	 	return $this->db->affected_rows();	
	}
	public function get_unit_with_poid($po_id)
	{
		$query = $this->db->get_where('nss_unit',array('po_id'=>$po_id));
		return $query->row_array();
	}
	public function get_course_spl($colge_id)
	{ 	
		$this->db->select('COU.specialisation_display_name');
		$this->db->where('MAP.college_id', $colge_id );
		$this->db->where( 'MAP.status','active' );
		$this->db->from('nss_college_course_map MAP');
		$this->db->join('nss_course_map COU', 'MAP.course_id=COU.course_id',  'right');
		$this->db->order_by('COU.course_id', 'asc');
		$query = $this->db->get();
        return $query->result_array();
	}
	public function get_stream_name($map_id)
	{
		$this->db->get_where('nss_course_map',array('specialisation_name'=>$map_id));
		return $query->result_array();
	}
	public function get_stud_list($spec_name,$year,$college_id)
	{
		$this->db->select('*');
		$this->db->where('COU.specialisation_display_name', $spec_name);
		$this->db->where('STUD.admission_year', $year);
		$this->db->where('STUD.college_id', $college_id);
		$this->db->from('nss_course_map COU');
		$this->db->join('nss_stud STUD', 'COU.specialisation_id=STUD.specialisation_id', 'inner');
	    $this->db->order_by('STUD.nss_stud_id', 'asc');
		$query = $this->db->get();
		//echo $this->db->last_query();exit;
        return $query->result_array();
	}
	public function get_enrolled_list($unit, $college_id, $batch)
	{
		$query = $this->db->get_where('nss_stud',array('nss_enroll_unit'=>$unit,'college_id'=>$college_id,'batch_period'=>$batch));		
		return $query->result_array();
	}
		
// make this into singe function start*********************************************//	
	public function update_nss_stud($upd_data)
	{
		$data1=array( 
		'account_id'=>$upd_data['account_id'],
		'admission_year' => $upd_data['admission_year'],
		'account_student_name'=>$upd_data['account_student_name'],
		'specialisation_id'=>$upd_data['specialisation_id'],	
		'account_student_mobileno'=>$upd_data['account_student_mobileno'],
		'gender' => $upd_data['gender'],
		'cast'=>$upd_data['cast'],
		'blood_group'=>$upd_data['blood_group'],
		'donate'=>$upd_data['donate'],
		'mini1'=>$upd_data['mini1'],
		'mini2'=>$upd_data['mini2'],
		'splcamp'=>$upd_data['splcamp'],
		'tot_hr'=>$upd_data['tot_hr'],
		'enroll_end'=>$upd_data['enroll_end'],
		'splcamp_start'=>$upd_data['splcamp_start'],
		'splcamp_end'=>$upd_data['splcamp_end'],
		'spl_desti'=>$upd_data['spl_desti'],
		'enrolled_date'=>$upd_data['enrolled_date'] 
		 );
  		$this->db->where('nss_stud_id',$upd_data['nss_stud_id']);
		$this->db->update('nss_stud',$data1); 
		 
		return $this->db->affected_rows();
	}
	public function update_nss_stud_rej_rem($reson,$nss_stud_id,$ver_id)
	{
		$data1=array('remarks'=>$reson,'verification_id'=>$ver_id);
  		$this->db->where_in('nss_stud_id',$nss_stud_id);
		$this->db->update('nss_stud',$data1); 
		return $this->db->affected_rows();
	}
	public function update_nss_stud_enroll($nss_stud_new,$unit,$batch_period,$unit_id )
	{	
		$data=array('nss_enroll_unit'=>$unit,'batch_period'=>$batch_period,'enrolled_date'=>date('Y-m-d H:i:s'),'verification_id'=>'0','nss_unit_id'=>$unit_id);
		$this->db->where_in('nss_stud_id',$nss_stud_new);
		$this->db->update('nss_stud',$data);	
		return $this->db->affected_rows();
	}
	public function update_total_stud($data)
	{
	$data_up = array('total_stud'=>$data['total_stud']);
	$this->db->where('batch_period',$data['batch_period']);
	$this->db->where('nss_unit_id',$data['nss_unit_id']);
	$this->db->where('college_id',$data['college_id']);
	$this->db->update('nss_unit',$data_up);
	return $this->db->affected_rows();
	}
	
	public function remove_nss_stud_enroll($nss_stud_new)
	{	
		$data=array('nss_enroll_unit'=>'','enrolled_date'=>'','verification_id'=>'','batch_period'=>'','nss_unit_id'=>'');
		$this->db->where_in('nss_stud_id',$nss_stud_new);
		$this->db->update('nss_stud',$data);	
		return $this->db->affected_rows();
	}
	public function fwd_or_rej($nss_stud,$ver_id)
	{	
		$data=array('verification_id'=>$ver_id);
		$this->db->where_in('nss_stud_id',$nss_stud);
		$this->db->update('nss_stud',$data);	//echo $this->db->last_query();exit;
		return $this->db->affected_rows();
	}
	public function fwd_to_so($data,$nss_stud)
	{   $this->db->where_in('nss_stud_id',$nss_stud);
		$this->db->where('college_id',$data['college_id']);
		$this->db->where('batch_period',$data['batch_period']);
		$this->db->where('nss_enroll_unit',$data['nss_enroll_unit']);
		$this->db->update('nss_stud',$data);	//echo $this->db->last_query();exit;
		return $this->db->affected_rows();
	
	}
	public function rej_assi($data,$nss_stud_id)
	{
	    $this->db->where_in('nss_stud_id',$nss_stud_id);
		$this->db->where('college_id',$data['college_id']);
		$this->db->where('batch_period',$data['batch_period']);
		$this->db->where('nss_enroll_unit',$data['nss_enroll_unit']);
		$this->db->update('nss_stud',$data);	//echo $this->db->last_query();exit;
		return $this->db->affected_rows();
	}
	public function get_fwd_rej_list($data)
	{
		$this->db->select('*');
		$this->db->from('nss_fwd_rej_list');
		$this->db->like('track', $data);
		return $this->db->get()->result_array();
	}
	public function fwd_rej_list($data_track)
	{
		$ins = $this->db->insert('nss_fwd_rej_list',$data_track);
 		return $this->db->insert_id();
	}
	public function princi_batch_period($colge_id)
	{
		$this->db->distinct();
  		$this->db->select('batch_period');
  		$this->db->where('college_id',$colge_id);
  		$this->db->where('status','active');
  		$this->db->order_by('batch_period','desc');
  		$query = $this->db->get('nss_unit');
  		return $query->result_array(); 
	}
	public function get_unit_from_batch($college_id,$batch)
	{
	 	$this->db->select('nss_unit_id');
  		$this->db->where('college_id',$college_id);
 		$this->db->where('batch_period',$batch);
  		$this->db->where('status','active');
  		$query = $this->db->get('nss_unit');
  		return $query->result_array();
	}
	public function princi_react($nss_stud,$data1)
	{
		if($data1['radio_val']=="A")	
			$val=3;
		elseif($data1['radio_val']=="R") $val=1;
		$data=array('fwd_princi_date'=>date('Y-m-d H:i:s'),'verification_id'=>$val,'remarks'=>$data1['remarks']);
		$this->db->where_in('nss_stud_id',$nss_stud);
		$this->db->update('nss_stud',$data);	
		return $this->db->affected_rows();
	}
	public function princi_fwd($data,$nss_stud_id_list)
	{	$this->db->where_in('nss_stud_id',$nss_stud_id_list);
  		$this->db->update('nss_stud',$data); 
		return $this->db->affected_rows();	 
	}
	public function princi_rej($data,$nss_stud_id_list)
	{
  		$this->db->where_in('nss_stud_id',$nss_stud_id_list);
  		$this->db->update('nss_stud',$data); 
		return $this->db->affected_rows(); 
	}
	public function fwd_assi($data)
	{
		$data1=array( 'verification_id'=>'2' );
  		$this->db->where_in('nss_stud_id',$data);
  		$this->db->update('nss_stud',$data1); 
  		return $this->db->affected_rows(); 
	}
	public function add_msg($message, $nickname, $guid)
	{
		$data = array(
			'nss_msg'	=> $message,
			'nss_nickname'	=> $nickname,
			'nss_guid'		=> $guid,
		);
		$query = $this->db->insert('nss_chat', $data);
		return $query->result_array();
	}
	public function check_username($uname)
	{
		$query = $this->db->get_where('nss_login',array('username'=>$uname));
  		return $query->row_array(); 
	}
	
	public function get_messages($timestamp)
	{
		$this->db->where('timestamp >', $timestamp);
		$this->db->order_by('timestamp', 'DESC');
		$this->db->limit(10); 
		$query = $this->db->get('nss_chat');
		return array_reverse($query->result_array());
	}
	public function get_enroll_stud_detail($data)
	{
		 $this->db->select('*');
         $this->db->from('nss_stud');
         $this->db->where('college_id',$data['college_id']);
		 $this->db->where('batch_period',$data['batch_period']);
		 $this->db->where('nss_enroll_unit',$data['nss_unit']);
		 $this->db->where_in('verification_id',$data['ver_id']);
         $query = $this->db->get();
         return $query->result_array();
	}
	public function get_unit_po_with_poid($po_id)
	{// to get unit id of alloted po_id
		$query = $this->db->get_where('nss_unit',array('po_id'=>$po_id));
		return $query->row_array();	
	}
	public function get_fwd_uni($unit)
	{
		$query = $this->db->get_where('nss_stud',array('verification_id'=>3));
		return $query->row_array();	
	}
	public function insert_m_attendance($data)
	{	
		$ins = $this->db->insert_batch('nss_m_attendance',$data);
		return $this->db->insert_id();
	}
	public function get_monthly_attendance_month($college_id, $unit,$month,$batch_period,$year)
	{ 
		// inner join month attendance and mid
  		$this->db->select('month,activity_desc,date,hours,image,verification_id,m_attendance_id');
        $this->db->from('nss_m_attendance');
        $this->db->where('college_id',$college_id);
		$this->db->where('nss_unit_id',$unit);
		if($month)
		$this->db->where('month',$month);
		$this->db->where('batch_period',$batch_period);
		$this->db->where('year',$year);
 		$query = $this->db->get();
    	return $query->result_array();
	}
	public function get_monthlystud_name($m_id)
	{
		$this->db->select('MATTEN.nss_stud_id,MATTEN.nss_enroll_id,MATTEN.monthly_id,STUD.account_student_name');
   		$this->db->where_in('MATTEN.monthly_id',$m_id);
   		$this->db->from('nss_map_monthlyatten_stud MATTEN');
    	$this->db->join('nss_stud STUD', 'MATTEN.nss_stud_id=STUD.nss_stud_id',  'inner');
    	$query = $this->db->get();
		return $query->result_array();
	}
	// join attendance + map attendnace
	public function get_monthly_attendance_date($college_id, $unit,$date,$batch_period,$year)
	{	$date1 = date("Y-m-d", strtotime($date));
  		$this->db->select('ATTEN.college_id,ATTEN.m_attendance_id,ATTEN.nss_unit_id,ATTEN.activity_desc,ATTEN.hours,ATTEN.image,MATTEN.nss_stud_id,MATTEN.nss_enroll_id');
 		$this->db->where('ATTEN.college_id', $college_id  );
		$this->db->where('ATTEN.nss_unit_id', $unit);
		$this->db->where('ATTEN.date', $date1);
		$this->db->where('ATTEN.batch_period', $batch_period);
		$this->db->where('ATTEN.year', $year  );
 		$this->db->from('nss_m_attendance ATTEN');
  		$this->db->join('nss_map_monthlyatten_stud MATTEN', 'MATTEN.monthly_id=ATTEN.m_attendance_id',  'inner');
  		$query = $this->db->get();
        return $query->result_array();
	}
	// attendance
	public function get_view_atten_initial($detail)
	{	 $ver_id = array("0","1R","3R");
		 $this->db->select('* ');
         $this->db->from('nss_m_attendance');
         $this->db->where('college_id',$detail['college_id']);
		 $this->db->where('nss_unit_id',$detail['unit']);
		 $this->db->where('batch_period',$detail['batch_period']);
		 if((!empty($detail['date']))&& ($detail['date']<>'1970-01-01'))
		 $this->db->where('date', $detail['date']);
		 if(!empty($detail['month']))
		 $this->db->where('month', $detail['month']);
		 if(!empty($detail['year']))
		 $this->db->where('year', $detail['year']);	
		 $this->db->where_in('verification_id',$ver_id);
         $query = $this->db->get();
         return $query->result_array();
	}
	public function get_view_atten_fwd_prin($detail,$ver_id)
	{
		 $this->db->select('* ');
         $this->db->from('nss_m_attendance');
         $this->db->where('college_id',$detail['college_id']);
		 $this->db->where('nss_unit_id',$detail['unit']);
		 $this->db->where('batch_period',$detail['batch_period']);
		 if((!empty($detail['date']))&& ($detail['date']<>'1970-01-01'))
		 $this->db->where('date', $detail['date']);
		 if(!empty($detail['month']))
		 $this->db->where('month', $detail['month']);
		 if(!empty($detail['year']))
		 $this->db->where('year', $detail['year']);	
		 $this->db->where('verification_id',$ver_id);
         $query = $this->db->get();//echo $this->db->last_query();exit;
         return $query->result_array();
	}
	public function get_view_atten_fwd_uni($detail,$ver_id)
	{
		 $this->db->select('* ');
         $this->db->from('nss_m_attendance');
         $this->db->where('college_id',$detail['college_id']);
		 $this->db->where('nss_unit_id',$detail['unit']);
		 $this->db->where('batch_period',$detail['batch_period']);
		 if((!empty($detail['date']))&& ($detail['date']<>'1970-01-01'))
		 $this->db->where('date', $detail['date']);
		 if(!empty($detail['month']))
		 $this->db->where('month', $detail['month']);
		 if(!empty($detail['year']))
		 $this->db->where('year', $detail['year']);	
		 $this->db->where_in('verification_id',$ver_id);
         $query = $this->db->get();
         return $query->result_array();
	}
	public function get_view_atten_uni($detail,$ver_id)
	{
		 $this->db->select('* ');
         $this->db->from('nss_m_attendance');
         $this->db->where('college_id',$detail['college_id']);
		 $this->db->where('nss_unit_id',$detail['unit']);
		 $this->db->where('batch_period',$detail['batch_period']);
		 if((!empty($detail['date']))&& ($detail['date']<>'1970-01-01'))
		 $this->db->where('date', $detail['date']);
		 if(!empty($detail['month']))
		 $this->db->where('month', $detail['month']);
		 if(!empty($detail['year']))
		 $this->db->where('year', $detail['year']);	
		 $this->db->where('verification_id',$ver_id);
         $query = $this->db->get();
         return $query->result_array();
	}
	public function fwd_prin_atten($ids,$ver_id)
	{
		$data1=array( 'verification_id'=>$ver_id );
  		$this->db->where_in('m_attendance_id',$ids);
  		$this->db->update('nss_m_attendance',$data1); 
  		return $this->db->affected_rows();
	}
	public function fwd_prin_camp($ids,$ver_id)
	{
		$data1=array( 'verification_id'=>$ver_id );
  		$this->db->where('nss_camp_id',$ids);
  		$this->db->update('nss_camp',$data1); //echo $this->db->last_query();exit;
  		return $this->db->affected_rows();
	}
	public function fwd_prin_fund($ids,$ver_id)
	{
		$data1=array( 'verification_id'=>$ver_id );
  		$this->db->where('college_id',$ids);
		$this->db->where('verification_id','1');
  		$this->db->update('nss_fund',$data1); 
  		return $this->db->affected_rows();
	}
	public function fwd_assi_fund($ids,$ver_id)
	{
		$data1=array( 'verification_id'=>$ver_id );
  		$this->db->where('college_id',$ids);
		$this->db->where('verification_id','2');
  		$this->db->update('nss_fund',$data1); 
  		return $this->db->affected_rows();
	}
	public function fwd_assi_fund_so($ids,$ver_id)
	{
		$data1=array( 'verification_id'=>$ver_id );
  		$this->db->where('college_id',$ids);
		$this->db->where('verification_id','3');
  		$this->db->update('nss_fund',$data1); 
  		return $this->db->affected_rows();
	}
	public function fwd_prin_audit($ids,$ver_id)
	{
		$data1=array( 'verification_id'=>$ver_id );
  		$this->db->where_in('nss_audit_id',$ids);
  		$this->db->update('nss_audit',$data1); 
  		return $this->db->affected_rows();
	}
	public function fwd_ass_mon_rep($data)
	{
		$data1=array( 'verification_id'=>$data['verification_id']);
  		$this->db->where('college_id',$data['college_id']);
		$this->db->where('month',$data['month']);
		$this->db->where('batch_period',$data['batch_period']);
		$this->db->where('nss_unit',$data['nss_unit']);
		$this->db->where('year',$data['year']);
  		$this->db->update('nss_monthly_report',$data1); 
  		return $this->db->affected_rows();
	}
	public function rej_ass_mon_rep($data)
	{
		$data1=array( 'verification_id'=>$data['verification_id'],'remarks'=>$data['remark'] );
  		$this->db->where('college_id',$data['college_id']);
		$this->db->where('month',$data['month']);
		$this->db->where('batch_period',$data['batch_period']);
		$this->db->where('nss_unit',$data['nss_unit']);
		$this->db->where('year',$data['year']);
  		$this->db->update('nss_monthly_report',$data1); 
  		return $this->db->affected_rows();
	}
	public function rej_prin_atten($ids,$data)
	{
		$data1=array( 'verification_id'=>$data['ver_id'],'remarks'=>$data['remark'] );
  		$this->db->where_in('m_attendance_id',$ids);
  		$this->db->update('nss_m_attendance',$data1); 
  		return $this->db->affected_rows();
	}
	public function rej_prin_fund($ids,$data)
	{
		$data1=array( 'verification_id'=>$data['ver_id'],'remarks'=>$data['remark'] );
  		$this->db->where('college_id',$ids);
		$this->db->where('verification_id','1');
  		$this->db->update('nss_m_attendance',$data1); 
  		return $this->db->affected_rows();
	}
	public function rej_assi_fund($ids,$data)
	{
		$data1=array( 'verification_id'=>$data['ver_id'],'remarks'=>$data['remark'] );
  		$this->db->where('college_id',$ids);
		$this->db->where('verification_id','2');
  		$this->db->update('nss_m_attendance',$data1); 
  		return $this->db->affected_rows();
	}
	public function rej_assi_fund_so($ids,$data)
	{
		$data1=array( 'verification_id'=>$data['ver_id'],'remarks'=>$data['remark'] );
  		$this->db->where('college_id',$ids);
		$this->db->where('verification_id','3');
  		$this->db->update('nss_m_attendance',$data1); 
  		return $this->db->affected_rows();
	}
	public function rej_prin_audit($ids,$data)
	{
		$data1=array( 'verification_id'=>$data['ver_id'],'remarks'=>$data['remark'] );
  		$this->db->where_in('nss_audit_id',$ids);
  		$this->db->update('nss_audit',$data1); 
  		return $this->db->affected_rows();
	}
	public function rej_prin_camp($ids,$data)
	{
		$data1=array( 'verification_id'=>$data['ver_id'],'remark'=>$data['remark'] );
  		$this->db->where('nss_camp_id',$ids);
  		$this->db->update('nss_camp',$data1); 
  		return $this->db->affected_rows();
	}
	//join  map_attendance + nss_stud
	public function get_view_atten_stud($monthly_id)
	{
		$this->db->select('MATTEN.nss_stud_id,MATTEN.nss_enroll_id,STUD.account_student_name');
		$this->db->where('MATTEN.monthly_id', $monthly_id);	
		$this->db->from('nss_map_monthlyatten_stud MATTEN');	
		$this->db->join('nss_stud STUD', 'MATTEN.nss_stud_id=STUD.nss_stud_id',  'inner');
		$query = $this->db->get();
        return $query->result_array();
	}
	public function get_camp_exist($cmp,$college_id,$batch_period,$nss_unit,$start_date,$to_date)
	{
		$this->db->select('*');
        $this->db->from('nss_camp');
		$this->db->where('college_id',$college_id);
		$this->db->where('batch_period',$batch_period);
		$this->db->where('nss_unit',$nss_unit);
    	$this->db->where('nss_camp_type',$cmp);
		if($start_date)
		$this->db->where('fromdate',$start_date);
		if($to_date)
		$this->db->where('todate',$to_date);
 	    $query = $this->db->get();
     	return $query->result_array();
	}
	// join camp + map camp
	public function get_camp_date($detail)
	{	$this->db->select('*');
          $this->db->from('nss_camp');
		  $this->db->where('college_id',$detail['college_id']);
		  $this->db->where('batch_period',$detail['batch_period']);
		 $this->db->where('nss_unit',$detail['unit']);
		 $this->db->where_in('verification_id',$detail['veri_id']);
		 if(isset($detail['sel_camp_type']))
    	  $this->db->where('nss_camp_type',$detail['sel_camp_type']);
		$query = $this->db->get();
        return $query->result_array();
	}
	public function get_camp_parti($camp_id)
	{
	 	$this->db->select('CAMP.nss_enroll_id,STUD.account_id,STUD.account_student_name,STUD.gender,STUD.cast');
		$this->db->where('CAMP.nss_camp_id', $camp_id);	
		$this->db->from('nss_map_camp CAMP');	
		$this->db->join('nss_stud STUD', 'CAMP.nss_stud_id=STUD.nss_stud_id',  'inner');
		$query = $this->db->get();
        return $query->result_array();
	}
	public function get_camp_image($camp_id)
	{
	    $this->db->select('*');
		$this->db->where('nss_camp_id', $camp_id);	
		$this->db->from('nss_camp CAMP');	
		$query = $this->db->get();
        return $query->row_array();
	}
	public function camp_fwd_princi($camp_id,$ver_id)
	{
		$data1=array( 'verification_id'=>$ver_id );
  		$this->db->where('nss_camp_id',$camp_id);
  		$this->db->update('nss_camp',$data1); 
  		return $this->db->affected_rows(); 
	}
	public function get_monthly_attendance($colege_id,$batch_period,$unit)
	{
     	$query = $this->db->get_where('nss_m_attendance', array('college_id' => $colege_id,'nss_unit_id'=> $unit));
  		return $query->result_array(); 
	}
	public function get_mo_atten_year($college_id,$batch_period,$unit)
	{
		$this->db->distinct();
  		$this->db->select('year');
  		$this->db->where('college_id',$college_id);
  		$this->db->where('batch_period',$batch_period);
  		$this->db->where('nss_unit_id',$unit);
  		$query = $this->db->get('nss_m_attendance');
  		return $query->result_array(); 
	}
	public function get_batch_periods($college_id)
	{
		$this->db->distinct();
  		$this->db->select('batch_period');
  		$this->db->where('college_id',$college_id);
  		$query = $this->db->get('nss_camp');
  		return $query->result_array(); 
	}
	public function get_stud_enroll_id($list,$college_id,$unit)
	{	
  		$this->db->select('STUD.nss_stud_id,STUD.admission_year,STUD.current_semester,STUD.account_student_name,STUD.account_student_email,STUD.account_student_mobileno,STUD.nss_enroll_unit,ENROLL.nss_stud_enroll_id');
		$this->db->where('ENROLL.nss_college_id',$college_id);
		$this->db->where('ENROLL.nss_unit_id',$unit);
		$this->db->where_in('STUD.nss_stud_id',$list);
		$this->db->where_in('ENROLL.nss_stud_id',$list);
  		$this->db->from('nss_stud STUD');
  		$this->db->join('nss_stud_enroll ENROLL', 'STUD.nss_stud_id=ENROLL.nss_stud_id',  'inner');
 		$query = $this->db->get();
        return $query->result_array();
	}
	public function update_batch_nss_stud_enroll($data_upd_enroll)
	{
	    $uid = $this->db->update_batch('nss_stud',$data_upd_enroll,'nss_stud_id'); 
		if($uid) {
			return TRUE; 
		}else {
			return FALSE;
		}
	}
	public function check_enroll_id_stud($list,$college_id,$unit)
	{
		 $this->db->select('*')
              ->from('nss_stud_enroll')
			  ->where('nss_college_id',$college_id)
			  ->where('nss_unit_id',$unit)
              ->where_in('nss_stud_id',$list);
  		 $query = $this->db->get();
     	 return $query->result_array();
	}
	public function insert_batch_enroll_id($data)
	{
		$ins = $this->db->insert_batch('nss_stud_enroll',$data);
		return $this->db->insert_id();
	}
	public function get_m_attendance($data)
	{	
		$this->db->where_in('nss_stud_id',$data);
		$this->db->where('year',date('Y'));
		$query = $this->db->get('nss_m_attendance');
		return $query->result_array();
	}
	public function get_admin_m_attendance($colge_id,$batch,$unit_id)
	{
		$this->db->select('*');
		$this->db->where('STUD.college_id', $colge_id );
		$this->db->where('STUD.batch_period', $batch );
		$this->db->where('ATT.college_id', $colge_id );
		$this->db->where( 'STUD.nss_enroll_unit',$unit_id );
		$this->db->where( 'ATT.nss_unit_id',$unit_id );
		$this->db->from('nss_stud STUD');
		$this->db->join('nss_m_attendance ATT', ' STUD.college_id=ATT.college_id AND STUD.batch_period=ATT.batch_period AND STUD.nss_enroll_unit=ATT.nss_unit_id',  'join');
		$query = $this->db->get();
        return $query->result_array();
	}
	public function get_fund_upload($college_id)
	{
		$query = $this->db->get_where('nss_fund_upload',array('college_id'=>$college_id));
		return $query->result_array();	
	}
	public function insert_fund_upload($data)
	{
		$ins = $this->db->insert('nss_fund_upload',$data);
		return $this->db->insert_id();
	}
	public function update_fund_upload($college_id, $role)
	{	//verification_id = 0 ; uploaded by po:: verfication_id = 1; fwd to princi :: verification id = 2; fwd to admin
		if($role=="po"){
		$data=array('verification_id'=>'1','acc_rej'=>'');
		$this->db->where_in('college_id',$college_id);
		$this->db->update('nss_fund_upload',$data);	
		return $this->db->affected_rows();
		}
		elseif($role=="princi"){
		$data=array('verification_id'=>'2','acc_rej'=>'A');
		$this->db->where_in('college_id',$college_id);
		$this->db->update('nss_fund_upload',$data);	
		return $this->db->affected_rows();	
		}
		elseif($role==""){
		$data=array('verification_id'=>'0','acc_rej'=>'R');
		$this->db->where_in('college_id',$college_id);
		$this->db->update('nss_fund_upload',$data);	
		return $this->db->affected_rows();	
		}
		elseif($role=="assi"){
		$data=array('verification_id'=>'3','acc_rej'=>'A');
		$this->db->where_in('college_id',$college_id);
		$this->db->update('nss_fund_upload',$data);	
		return $this->db->affected_rows();	
		}
	}
	public function get_nss_fund($college_id,$prev_year)
	{ 
		$query = $this->db->get_where('nss_fund',array('college_id'=>$college_id,'year'=>$prev_year));
  		return $query->result_array(); 
	}
	public function get_nss_fund_yrs($college_id)
	{
		$this->db->distinct();
		$this->db->select('year');
		$this->db->where('college_id',$college_id);
		$query = $this->db->get('nss_fund');
		return $query->result_array(); 
	}
	public function insert_nss_fund($data)
	{
		$ins = $this->db->insert_batch('nss_fund',$data);
        return $this->db->insert_id();
	}
	public function upload_data_fund($data)
	{
		$ins = $this->db->insert('nss_fund',$data);
  		return $this->db->insert_id();
	}
	public function upd_fund_rep($id)
	{
		$data1=array( 'verification_id'=>'1' );
  		$this->db->where_in('nss_fund_id',$id);
  		$this->db->update('nss_fund',$data1); 
  		return $this->db->affected_rows(); 
	}
	public function get_nss_fund_sanc($college_id,$year)
	{
		 $query = $this->db->get_where('nss_fund_sanc',array('fund_college_id'=>$college_id,'year'=>$year));
     	 return $query->row_array();
	}
	public function ins_manage_enroll_date($data_manage)
	{ 
		$ins = $this->db->insert('nss_manage_enroll_date',$data_manage);
  		return $this->db->insert_id();
	}
	public function get_data_manage_enroll($date)
	{
		$this->db->select('*')
          	  ->from('nss_manage_enroll_date')
              ->where('year',$date)
			  ->where("to_date >",date('Y-m-d'),FALSE);
        $query = $this->db->get();
        return $query->row_array();
	}
	public function upd_manage_enroll_date($year,$ver_id,$remarks)
	{	
		if($ver_id !='extend'){
		$data1=array( 'verification_id'=>$ver_id , 'remarks' => $remarks);
 		$this->db->where('year',$year);
  		$this->db->update('nss_manage_enroll_date',$data1); 
  		return $this->db->affected_rows(); }
		else{
		$data1=array( 'to_date'=>$remarks , 'extended' => $year);
 		$this->db->where('year',date('Y'));
  		$this->db->update('nss_manage_enroll_date',$data1); 
  		return $this->db->affected_rows();
		}
	}
	public function update_enroll_date($data)
	{
  		$this->db->where('year',$data['year']);
  		$this->db->update('nss_manage_enroll_date',$data); 
  		return $this->db->affected_rows(); 
	}
	public function get_web_content()
	{
		$query = $this->db->order_by('created_date',"desc")
		->limit(1)
		->get('nss_web_content');
        return $query->row_array();
	}
	public function get_so_acpt_web()
	{
		$query = $this->db->order_by('created_date',"desc")
		->limit(1)
		->where('verification_id','4')
		->get('nss_web_content');
        return $query->row_array();
	}
	public function upd_web_content($data)
	{
  		$this->db->update('nss_web_content',$data); 
  		return $this->db->affected_rows(); 
	}
	public function ins_web_content($data)
	{
		$ins = $this->db->insert('nss_web_content',$data);
  		return $this->db->insert_id();
	}
	public function get_faq_data($ver_id)
	{
		$this->db->select('*');
        $this->db->from('nss_faq');
		if($ver_id=="process")
		{
        $this->db->where('verification_id !=','4');
		}
         $query = $this->db->get();
         return $query->row_array();
	}	
	public function get_faq()
	{
		$this->db->select('*');
        $this->db->from('nss_faq');
		$this->db->where('verification_id','4');
		$query = $this->db->get();
        return $query->result_array();
	}
	public function ins_faq_data($data)
	{
		$ins = $this->db->insert('nss_faq',$data);
  		return $this->db->insert_id();
	}
	public function upd_faq($faq_id,$data)
	{
  		$this->db->where('nss_faq_id',$faq_id);
  		$this->db->update('nss_faq',$data); 
  		return $this->db->affected_rows();
	}
	public function insert_notice($data)
	{
		$ins = $this->db->insert('nss_notice_board',$data);
  		return $this->db->insert_id();
	}
	public function get_notice_id($id)
	{
		$this->db->select('*')
             ->from('nss_notice_board')
             ->where('path',$id);
        $query = $this->db->get();
        return $query->row_array();
	}
	public function get_notice($data)
	{
		$this->db->select('*')
          	 ->from('nss_notice_board')
    		 ->where('year',date('Y'));
		if($data=='X')
		$this->db->where('display','Y');	 
		$this->db->order_by("created_date", "desc");
 		$query = $this->db->get();
     	return $query->result_array();
	}
	public function update_notice($chk)
	{
		$data1=array( 'display'=>'Y' );$data2=array( 'display'=>'N' );
 		$this->db->where_in('notice_no',$chk);
  		$this->db->update('nss_notice_board',$data1); 
		$this->db->where_not_in('notice_no',$chk);
		$this->db->update('nss_notice_board',$data2);
  	    return $this->db->affected_rows(); 
	}
	public function get_project($data)
	{
		$this->db->select('*')
          	->from('nss_project');
		if(!empty($data['date']))
    	$this->db->where('created_date',$data['date']);
		if(!empty($data['year']))
		$this->db->where('year',$data['year']);
  		$query = $this->db->get();
        return $query->result_array();
	}
	public function ins_proj($data)
	{
		$ins = $this->db->insert('nss_project',$data);
  		return $this->db->insert_id();
	}
	public function insert_totstud($stud_no,$unit_id)
	{
		$this->db->where('unit_id',$unit_id);	
		$this->db->set('total_stud',$stud_no,FALSE);
		$this->db->update('nss_unit');
		
        return $this->db->affected_rows(); 	
	}
	public function insert_stud($data)
	{
		$ins = $this->db->insert_batch('nss_stud',$data);
  		return $this->db->insert_id();
	}
	public function get_strtend_no($col,$unit)
	{
	$this->db->select('count(nss_stud_id) as counts')
          	->from('nss_stud');
			$this->db->where('college_id',$col);
				$this->db->where('nss_enroll_unit',$unit);
				$query = $this->db->get();
				$arr=$query->row_array();
        return $arr['counts'];
	
	}
	public function get_total_stud($unitid)
	{
	$this->db->select('total_stud')
          	->from('nss_unit');
			$this->db->where('unit_id',$unitid);
				//$this->db->where('nss_enroll_unit',$unit);
				$query = $this->db->get();
				$arr=$query->row_array();
        return $arr['total_stud'];
	}
	public function get_elig_rep($col,$batch,$unit)
	{
		$this->db->select('nss_stud_id,account_id,account_student_name,specialisation_id,nss_enroll_unit,nss_enroll_id,batch_period,mini1,mini2,splcamp,tot_hr,elig')
          	->from('nss_stud');
			$this->db->where('college_id',$col);
			$this->db->where('batch_period',$batch);
			$this->db->where('nss_enroll_unit',$unit);
			$query = $this->db->get(); 
            return $query->result_array();
	}
	public function get_elig_rep_certi($col,$batch,$unit)
	{
		$this->db->select('nss_stud_id,account_id,account_student_name,specialisation_id,nss_enroll_unit,nss_enroll_id,batch_period,mini1,mini2,splcamp,tot_hr,elig')
          	->from('nss_stud');
			$this->db->where('college_id',$col);
			$this->db->where('batch_period',$batch);
			$this->db->where('nss_enroll_unit',$unit);
			$this->db->where('elig','Y');
			$query = $this->db->get(); 
            return $query->result_array();
	}
	public function certi_new($id)
	{
		
			
			
			$this->db->select('STUD.nss_stud_id,STUD.account_id,STUD.account_student_name,STUD.specialisation_id,STUD.nss_enroll_unit,STUD.nss_enroll_id,STUD.batch_period,STUD.mini1,STUD.mini2,
			STUD.splcamp,STUD.tot_hr,STUD.elig,COL.college_name_for_gradecard, STUD.enroll_end, STUD.splcamp_start, STUD.splcamp_end, STUD.spl_desti,STUD.enrolled_date,STUD.iss_on');
  		$this->db->where_in('STUD.nss_stud_id',$id); 
  		$this->db->from('nss_stud STUD');
		$this->db->join('nss_college COL', 'STUD.college_id=COL.college_id',  'inner');
		 
  		$query = $this->db->get();
        return $query->row_array();
	}
	
	public function get_stud_certi_new($enroll)
	{
		$this->db->select('*')
          	->from('cert_verify_2017_2019');
			$this->db->where('enroll_no',$enroll); 
			$query = $this->db->get(); //echo $this->db->last_query();exit;
            return $query->row_array();
	}
	public function upd_password($us,$pa,$coll)
	{
		$this->db->where('status','active');	
		$this->db->where('college_id',$coll);
		$this->db->set('username',$us,true);
		$this->db->set('password',$pa,true);
		$this->db->update('nss_login');//echo $this->db->last_query();exit;
		//echo $this->db->affected_rows();exit;
        return $this->db->affected_rows(); 
		
	}
	public function chk_username($user,$col)
	{
		
		$this->db->select('*')
          	->from('nss_login');
			$this->db->where('username IS NOT NULL'); 
			$this->db->where('password IS NOT NULL'); 
			$this->db->where('user_type','principal');
			$this->db->where('status','active');
			$this->db->where('college_id',$col);
			$query = $this->db->get();//echo $this->db->last_query();exit;
			//print_r( $query->row_array());exit;
            return $query->row_array();
	}
	public function check_unit_id($unit,$col,$batch)
	{
		$this->db->select('*')
          	->from('nss_unit');
			$this->db->where('college_id',$col); 
			$this->db->where('status','active'); 
			$this->db->where('batch_period',$batch);
			$this->db->where('nss_unit_id',$unit);
			
			$query = $this->db->get();//echo $this->db->last_query();exit;
			//print_r( $query->row_array());exit;
            return $query->row_array();
	}
	 
}// end of public model