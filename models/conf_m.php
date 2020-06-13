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

		
		$sql = 'SELECT m_seq, p_name, p_parent , p_type , p_no , p_depth FROM menu WHERE p_use=?  ';
		array_push($query, 'Y');
		
		if(! empty($data['search_column'])){
		    foreach ( $data['search_column'] as $key => $val ) {
		        $sql .= ' AND '.$data['search_column'][$key]['column'].' = \''.$data['search_column'][$key]['value'].'\' ';
		    }
		}
		
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
				$return['data'][$datacount]['p_no'] = $row->p_no;
				$return['data'][$datacount]['p_type'] = $row->p_type;
				$return['data'][$datacount]['p_depth'] = $row->p_depth;
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
	
	// 메뉴정보 가져오기
	public function menu_view($data = array())
	{
	    $sql = 'SELECT m_seq, p_name , p_use , p_no , p_depth , p_parent  ';
	    $sql .='   FROM menu WHERE m_seq =? ';
	    $query = $this->db->query($sql, $data);
	   
	    if ( ! empty($query) && $query->num_rows() > 0 ) {
	        $return = $query->row_array();
	        $return['result'] = TRUE;
	    } else {
	        $return = array('result' => FALSE, 'message' => '정보가 없습니다');
	    }
	    
	    return $return;
	}
	
    // 메뉴 저장 
	public function menu_save($data = array())
	{
	   
	   // 만약 수정이라면 
	   if (!empty($data['m_seq'])) {
	       $data = array(
	           'm_seq'     => $data['m_seq'],
	           'p_name'    => $data['p_name'],
	           'p_parent'  => $data['p_parent'],
	           'p_no'      => $data['p_no'],
	           'p_depth'   => $data['p_depth'],
	           'p_use'     => $data['p_use']
	       );
	       $this->db->where('m_seq', $data['m_seq']);
	       $query = $this->db->update('menu', $data);
	       
	       if (! empty($query)) {
	           $return = array('result' => TRUE);
	       } else {
	           $return = array('result' => FALSE, 'message' => '데이터베이스 오류');
	       }
	   // 그외에 신규 저장이라면      
	   } else {
	       $data = array(
	           'p_name'    => $data['p_name'],
	           'p_parent'  => $data['p_parent'],
	           'p_no'      => $data['p_no'],
	           'p_depth'   => $data['p_depth'],
	           'p_use'     => $data['p_use']
	       );
	       $query = $this->db->insert('menu', $data);
	       
	       if (! empty($query)) {
	           $return = array('result' => TRUE);
	       } else {
	           $return = array('result' => FALSE, 'message' => '데이터베이스 오류');
	       }
	   }
	    
	    
	    return $return;
	}
	
	// 프로그램 조회
	public function get_menu($data = array())
	{
	    $return = array();
	    $query = array();
	    $return['draw'] = $data['draw'];
	    $return['recordsTotal'] = $this->menu_cnt();
	    $return['recordsFiltered'] = $this->menu_cnt($data);
	    $datacount = 0;
	    
	    $sql = 'SELECT p_name , m_seq , p_no FROM menu WHERE p_use =\'Y\' ';
	    
	    if ( ! empty($data['search']) ) {
	        $sql .= ' AND (p_name LIKE ? OR p_parent LIKE ? )';
	        array_push($query, '%' . $data['search'] . '%', '%' . $data['search'] . '%' );
	    }
	    $sql .= ' ORDER BY  m_seq ASC ';
	    $sql .= ' LIMIT ?, ?';
	    array_push($query, (int)$data['start'], (int)$data['length']);
	    $query = $this->db->query($sql, $query);
	    
	    if ( ! empty($query) && $query->num_rows() > 0 ) {
	        foreach ($query->result() as $row)
	        {
	            $return['data'][$datacount]['DT_RowId'] = $row->m_seq;
	            $return['data'][$datacount]['no'] =  (++$data['start']);
	            $return['data'][$datacount]['p_name'] = $row->p_name;
	            $return['data'][$datacount]['p_no'] = $row->p_no;            
	            $datacount++;
	        }
	    } else {
	        $return['data'] = array();
	        $return['recordsFiltered'] = 0;
	    }
	    
	    return $return;
	}
	
	// 프로그램 가져오기 
	private function menu_cnt($data = array())
	{
	    $return = 0;
	    $query = array();
	    
	    $sql = 'SELECT COUNT(m_seq) as totalcount FROM menu WHERE p_use =\'Y\' ';
	    
	    if ( ! empty($data['search']) ) {
	        $sql .= ' AND (p_name LIKE ? OR p_parent LIKE ? )';
	        array_push($query, '%' . $data['search'] . '%', '%' . $data['search'] . '%' );
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