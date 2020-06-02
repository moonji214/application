<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conf_m extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	// 메뉴 리스트 쿼리 
	public function lists($data = array())
	{
		$return = array();
		$query = array();
		$return['draw'] = $data['draw'];
		$return['recordsTotal'] = $this->cnt(array('board' => $data['board']));
		$return['recordsFiltered'] = $this->cnt($data);
		$datacount = 0;

		$sql = 'SELECT m_seq, p_name, p_parent , p_type FROM menu WHERE p_use=?  ';
		array_push($query, 'Y');
		
		if ( ! empty($data['search']) ) {
			$sql .= ' AND (p_name LIKE ? OR p_parent LIKE ?)';
			array_push($query, '%' . $data['search'] . '%', '%' . $data['search'] . '%');
		}
		if ( ! empty($data['order']) ) {
			$sql .= ' ORDER BY ' . $data['order'];
		} else {
			$sql .= ' ORDER BY m_seq DESC';
		}
		$sql .= ' LIMIT ?, ?';
		array_push($query, (int)$data['start'], (int)$data['length']);
		$query = $this->db->query($sql, $query);
		
		if ( ! empty($query) && $query->num_rows() > 0 ) {
			foreach ($query->result() as $row)
			{
			    $return['data'][$datacount]['DT_RowId'] = $row->m_seq;
				$return['data'][$datacount]['no'] = ++$data['start'];
				$return['data'][$datacount]['p_name'] = $row->p_name;
				$return['data'][$datacount]['p_parent'] = $row->p_parent;	
				$return['data'][$datacount]['p_type'] = $row->p_type;
				$datacount++;
			}
		} else {
			$return['data'] = array();
			$return['recordsFiltered'] = 0;
		}
		
		return $return;
	}
	
	//메뉴 리스트 카운트 
	private function cnt($data = array())
	{
		$return = 0;
		$query = array();
		
		$sql = 'SELECT COUNT(m_seq) as totalcount FROM menu WHERE p_use=? ';
		array_push($query, 'Y');
		
		if ( ! empty($data['search']) ) {
			$sql .= ' AND (p_name LIKE ? OR p_parent LIKE ?)';
			array_push($query, '%' . $data['search'] . '%', '%' . $data['search'] . '%');
		}
		
		$query = $this->db->query($sql, $query);
		
		if ( ! empty($query) ) {
			$row = $query->row();
			$return = $row->totalcount;
		}
		
		return $return;
	}
	

	// 게시판 입력 저장
	public function add($data = array())
	{
	    $data = array(
	        'b_subject' => $data['b_subject'] ,
	        'b_regdate' => $data['b_regdate'],
	        'b_content' => $data['b_content'] ,
	        'b_phone' => $data['b_phone'] ,
	        'b_display' => 'Y' ,
	        'b_name' => $data['b_name']
	    );
	    
	    $query = $this->db->insert('board_notice', $data);
	    
		//$sql = 'INSERT INTO gb_board_notice ( b_subject, b_regdate , b_content, b_name, b_phone, b_email, b_files,bc_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
		
	    if (! empty($query)) {
			$return = array('result' => TRUE);
		} else {
			$return = array('result' => FALSE, 'message' => '데이터베이스 오류');
		}
		
		return $return;
	}
	
	// 게시판 수정
	public function set($data = array())
	{
	    $data = array(
	        'b_idx' => $data['b_idx'],
	        'b_name' => $data['b_name'],
	        'b_phone' => $data['b_phone'],
	        'b_subject' => $data['b_subject'],
	        'b_content' => $data['b_content']
	    );
	    
	    $this->db->where('b_idx', $data['b_idx']);
	    $query = $this->db->update('board_notice', $data);
		
	    if (! empty($query)) {
			$return = array('result' => TRUE);
		} else {
			$return = array('result' => FALSE, 'message' => '데이터베이스 오류');
		}
		
		return $return;
	}
	
	// 게시판 조회
	public function get($data = array())
	{
	    
	    $this->db->select('b_idx,  b_name, b_phone , b_subject, b_content, b_regdate');
	    $query = $this->db->get_where('board_notice', array('b_idx' => $data['b_idx']));
		
		if ( ! empty($query) && $query->num_rows() > 0 ) {
			$return = $query->row_array();
			$return['b_regdate'] = date('Y-m-d', strtotime( $return['b_regdate'] ));
			//$return['b_files'] = unserialize($return['b_files']);
		} else {
			$return = array() ;
		}
		
		return $return;
	}
	
	//게시판 삭제처리 
	public function del($data = array())
	{
	    
	    $data = array(
	        'b_display' => 'N',
	        'b_idx' => $data['b_idx']
	    );
	    
	    $this->db->where('b_idx', $data['b_idx']);
	    $query =  $this->db->update('board_notice', $data);
		
	    if (! empty($query)) {
			$return = array('result' => TRUE);
		} else {
			$return = array('result' => FALSE, 'message' => '데이버테이스 오류');
		}
		
		return $return;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */