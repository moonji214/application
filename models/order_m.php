<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function login($data = array())
	{
		$sql = 'SELECT u_id, u_name, u_password, u_tel, u_phone, u_email, u_post, u_address1, u_company_info ,u_admin, u_post FROM gb_members WHERE u_id=? AND u_password=?';
		$query = $this->db->query($sql, array($data['u_id'], $data['u_password']));
		
		if ( ! empty($query) && $query->num_rows() > 0 ) {
			$return = $query->row_array();
			if ( $return['u_admin'] == 'Y' ) {
				$return['result'] = TRUE;
			} else {
				$return = array('result' => FALSE, 'message' => '愿�由ъ옄 怨꾩젙�씠 �븘�떃�땲�떎');
			}
		} else {
			$return = array('result' => FALSE, 'message' => '�궗�슜�옄 怨꾩젙�씠 議댁옱�븯吏� �븡�뒿�땲�떎');
		}
		
		return $return;
	}
	
//  vue.js 테스트 
	public function vue_test($data = array())
	{
	    $datacount = 0;
	    $this->db->select('b_subject, b_name , b_idx');
	    $query = $this->db->get('board_notice');
	    
	    if ( ! empty($query) && $query->num_rows() > 0 ) {
	        /*foreach ($query->result_array() as $row)
	        {
	            $return = $row['b_subject'];
	            $return = $row['b_name'];
	            $return = $row['b_idx'];
	        }*/
	      //  $return = $query->result_array();
	      //  $return = (array) $return;
	        $return = $query->row_array();
	    } else {
	        $return = array() ;
	    }
	    //$return = json_encode($return);
	 //  echo "<pre>";
	   // print_r($return);
	  // exit;
	    return $return;
	}
	
// 사용자 정보 수정 	
	public function set($data = array())
	{
	    
	    $data = array(
	        'idx' => $data['idx'],
	        'u_name' => $data['u_name'],
	        'u_email' => $data['u_email'],
	        'u_phone' => $data['u_phone'],
	        'u_delete' => $data['u_delete']
	    );
	    
	    $this->db->where('idx', $data['idx']);
	    $query = $this->db->update('tb_member', $data);
	      	
		if (! empty($query)) {
			$return = array('result' => TRUE);
		} else {
			$return = array('result' => FALSE, 'message' => '데이터베이스 오류');
		}
		
		return $return;
	}
//  사용자 정보 삭제	
	public function del($data = array())
	{
	    $data = array(
	        'u_delete' => 'Y',
	        'idx' => $data['idx']
	    );
	    
	    $this->db->where('idx', $data['idx']);
	    $query =  $this->db->update('tb_member', $data);
	    
	    if (! empty($query)) {
			$return = array('result' => TRUE);
		} else {
			$return = array('result' => FALSE, 'message' => '데이터베이스 오류');
		}
		
		return $return;
	}
	
	
	
	// Only Excel
	public function excel_lists()
	{
		$query = array();
		$sql =  'SELECT u_id, u_password, u_name, u_birthday, u_tel, u_phone, u_email, u_question, ';
		$sql .= 'u_answer, u_company, u_department, u_title, u_company_tel, u_company_fax, u_company_email, ';
		$sql .= 'u_pay_email, u_company_post, u_company_address1, u_company_address2, u_admin, u_regdate ';
		$sql .= 'FROM bs_members where u_delete = \'N\' ';		
		
		$query = $this->db->query($sql, $query);
	
		$return['count'] = 0;
		if ( ! empty($query) && $query->num_rows() > 0 ) {
				
			foreach ( $query->result() as $row ) {
				$return['list'][$return['count']]['u_id'] = $row->u_id;
				$return['list'][$return['count']]['u_password'] = $row->u_password;
				$return['list'][$return['count']]['u_name'] = $row->u_name;
				$return['list'][$return['count']]['u_birthday'] = $row->u_birthday;
				$return['list'][$return['count']]['u_tel'] = $row->u_tel;
				$return['list'][$return['count']]['u_phone'] = $row->u_phone;
				$return['list'][$return['count']]['u_email'] = $row->u_email;
				$return['list'][$return['count']]['u_question'] = $row->u_question;
				$return['list'][$return['count']]['u_answer'] = $row->u_answer;
				$return['list'][$return['count']]['u_company'] = $row->u_company; 
				$return['list'][$return['count']]['u_department'] = $row->u_department;
				$return['list'][$return['count']]['u_company_tel'] = $row->u_company_tel;
				$return['list'][$return['count']]['u_company_fax'] = $row->u_company_fax;
				$return['list'][$return['count']]['u_company_email'] = $row->u_company_email;
				$return['list'][$return['count']]['u_pay_email'] = $row->u_pay_email;
				$return['list'][$return['count']]['u_company_post'] = $row->u_company_post;
				$return['list'][$return['count']]['u_company_address1'] = $row->u_company_address1;
				$return['list'][$return['count']]['u_company_address2'] = $row->u_company_address2;
				$return['list'][$return['count']]['u_admin'] = $row->u_admin;
				$return['list'][$return['count']]['u_regdate'] = date('Y/m/d H:i:s', $row->u_regdate);				
				$return['count']++;
			}
		}
	
		return $return;
	}
	
	// 사용자 리스트 
	public function lists($data = array())
	{
		$return = array();
		$query = array();
		$record_count = 10; //레코드개수
		if(!empty($data['record_start'])){
			$record_start = (int)$data['record_start'];
		}else{
			$record_start = 0;
		}
	
		$return['record_start'] = $record_start;
		$return['record_count'] = $record_count;
		$return['total_record'] = $this->cnt_gen($data);
		$return['total_page'] = (int)($return['total_record']/$record_count);
		if((int)$return['total_record'] % $record_count){
			$return['total_page']++;
		}
		$datacount = 0;
	
		$sql = 'SELECT idx, id, pw, u_name, u_email ,u_phone , u_delete FROM tb_member where id is not null AND u_delete= \'N\' ';
		if ( ( ! empty($data['search_field1']) ) && ( ! empty($data['search_word1']) ) ) {
			$sql .= ' and '.$data['search_field1'].' LIKE ?';
			array_push($query, '%' . $data['search_word1'] . '%');
	
		}
		if ( ( ! empty($data['search_field2']) ) && ( ! empty($data['search_word2']) ) ) {
			$sql .= ' and '.$data['search_field2'].' LIKE ?';
			array_push($query, '%' . $data['search_word2'] . '%');
	
		}
		if ( ( ! empty($data['search_field3']) ) && ( ! empty($data['search_word3']) ) ) {
			$sql .= ' and '.$data['search_field3'].' LIKE ?';
			array_push($query, '%' . $data['search_word3'] . '%');
	
		}
		if ( ( ! empty($data['search_field4']) ) && ( ! empty($data['search_word4']) ) ) {
			$sql .= ' and '.$data['search_field4'].' LIKE ?';
			array_push($query, '%' . $data['search_word4'] . '%');
	
		}
		$sql .= ' ORDER BY idx DESC';
		$sql .= ' LIMIT ?, ?';
		array_push($query, $record_start, $record_count);
	
		$query = $this->db->query($sql, $query);
		if ( ! empty($query) && $query->num_rows() > 0 ) {
			foreach ($query->result() as $row)
			{
			    $return['data'][$datacount]['idx'] = $row->idx;
				$return['data'][$datacount]['id'] = $row->id;
				$return['data'][$datacount]['pw'] = $row->pw;
				$return['data'][$datacount]['u_name'] = $row->u_name;
				$return['data'][$datacount]['u_phone'] = $row->u_phone;
				$return['data'][$datacount]['u_email'] = $row->u_email;
				$return['data'][$datacount]['u_delete'] = $row->u_delete;
				$datacount++;
			}
		} else {
			$return['data'] = array();
			$return['recordsFiltered'] = 0;
		}
	
		return $return;
	}
	
	private function cnt_gen($data = array())
	{
		$return = 0;
		$query = array();
	
		$sql = 'SELECT COUNT(idx) as totalcount FROM tb_member where id is not null AND u_delete= \'N\' ';	
		if ( ( ! empty($data['search_field1']) ) && ( ! empty($data['search_word1']) ) ) {
			$sql .= ' and '.$data['search_field1'].' LIKE ?';
			array_push($query, '%' . $data['search_word1'] . '%');
	
		}
		if ( ( ! empty($data['search_field2']) ) && ( ! empty($data['search_word2']) ) ) {
			$sql .= ' and '.$data['search_field2'].' LIKE ?';
			array_push($query, '%' . $data['search_word2'] . '%');
	
		}
		if ( ( ! empty($data['search_field3']) ) && ( ! empty($data['search_word3']) ) ) {
			$sql .= ' and '.$data['search_field3'].' LIKE ?';
			array_push($query, '%' . $data['search_word3'] . '%');
	
		}
		if ( ( ! empty($data['search_field4']) ) && ( ! empty($data['search_word4']) ) ) {
			$sql .= ' and '.$data['search_field4'].' LIKE ?';
			array_push($query, '%' . $data['search_word4'] . '%');
	
		}
	
		$query = $this->db->query($sql, $query);
	
		if ( ! empty($query) ) {
			$row = $query->row();
			$return = $row->totalcount;
		}
	
		return $return;
	}
	
	
	public function secedelists($data = array())
	{
		$return = array();
		$query = array();
		$return['draw'] = $data['draw'];
		$return['recordsTotal'] = $this->secedecnt();
		$return['recordsFiltered'] = $this->secedecnt($data);
		$datacount = 0;

		$sql = 'SELECT u_idx, u_id, u_name, u_company_info, u_goods , u_gubun  FROM gb_members WHERE u_delete=\'Y\' ';
		
		if ( ! empty($data['search']) ) {
			$sql .= ' AND (u_id LIKE ? OR u_name LIKE ? OR u_company_info LIKE ?)';
			array_push($query, '%' . $data['search'] . '%', '%' . $data['search'] . '%', '%' . $data['search'] . '%');
		}
		if ( ! empty($data['order']) ) {
			$sql .= ' ORDER BY ' . $data['order'];
		} else {
			$sql .= ' ORDER BY u_idx DESC';
		}
		$sql .= ' LIMIT ?, ?';
		array_push($query, (int)$data['start'], (int)$data['length']);
		$query = $this->db->query($sql, $query);
		
		if ( ! empty($query) && $query->num_rows() > 0 ) {
			foreach ($query->result() as $row)
			{
				$return['data'][$datacount]['DT_RowId'] = $row->u_idx;
				$return['data'][$datacount]['no'] = ++$data['start'];
				$return['data'][$datacount]['u_id'] = $row->u_id;
				$return['data'][$datacount]['u_name'] = $row->u_name;
				$return['data'][$datacount]['u_company_info'] = $row->u_company_info;
				$return['data'][$datacount]['u_goods'] = $row->u_goods;
				$return['data'][$datacount]['u_gubun'] = $row->u_gubun;
				$datacount++;
			}
		} else {
			$return['data'] = array();
			$return['recordsFiltered'] = 0;
		}
		
		return $return;
	}
	
	private function secedecnt($data = array())
	{
		$return = 0;
		$query = array();
		
		$sql = 'SELECT COUNT(u_idx) as totalcount FROM gb_members WHERE u_delete=\'Y\'';
		
		if ( ! empty($data['search']) ) {
			$sql .= ' AND (u_id LIKE ? OR u_name LIKE ? OR u_company_info LIKE ?)';
			array_push($query, '%' . $data['search'] . '%', '%' . $data['search'] . '%', '%' . $data['search'] . '%');
		}
		
		$query = $this->db->query($sql, $query);
		
		if ( ! empty($query) ) {
			$row = $query->row();
			$return = $row->totalcount;
		}
		
		return $return;
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */