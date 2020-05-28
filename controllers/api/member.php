<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('form_validation');
		
		$this->load->model('/member_m', 'member');
	}
	
	// 리스트 
	public function lists($board = '')
	{
		$tmp['columns'] = $this->input->post('columns');
		$tmp['search'] = $this->input->post('search');
		
		if ( ! empty($tmp['search']['value']) && $tmp['search'] !== '' ) {
			$data['search'] = $tmp['search']['value'];
		}
		
		$tmp['order'] = $this->input->post('order');
		if ( ! empty($tmp['order']) ) {
			foreach ( $tmp['order'] as $key => $val ) {
				$subtmp['columns'][] = $tmp['columns'][$val['column']]['name'] . ' ' . $val['dir'];
			}
		}
		
		$data['board'] = $board;
		$data['order'] = implode(', ', $subtmp['columns']);
		$data['draw'] = $this->input->post('draw');
		$data['start'] = $this->input->post('start');
		$data['length'] = $this->input->post('length');
		
		$return = $this->board->lists($data);
		
		echo json_encode($return);
	}
	
	// 사용자 정보 수정 
	public function set()
	{
	    $data = $this->input->post();
	    
	    if ( ! $this->form_validation->required($data['idx']) ) {
	        $return = array('result' => FALSE, 'message' => '회원 코드가 존재하지 않습니다');
	    } elseif ( ! $this->form_validation->required($data['id']) ) {
	        $return = array('result' => FALSE, 'message' => '아이디를 입력하세요');
	    } elseif ( ! $this->form_validation->required($data['u_name']) ) {
	        $return = array('result' => FALSE, 'message' => '이름을 입력하세요');
	    } elseif ( ! $this->form_validation->required($data['u_phone']) ) {
	        $return = array('result' => FALSE, 'message' => '휴대폰번호를 입력하세요');
	    } elseif ( ! $this->form_validation->valid_email($data['u_email']) ) {
	        $return = array('result' => FALSE, 'message' => '이메일주소를 확인 하세요');
	    } else {
	        $return = $this->member->set($data);
	    }
	    
	    echo json_encode($return);
	}
	
	// 사용자정보 삭제 
	public function del()
	{
		$data = $this->input->post();
		
		if ( ! $this->form_validation->required($data['idx']) ) {
			$return = array('result' => FALSE, 'message' => '회원 코드가 존재하지 않습니다');
		} else {
		    $return = $this->member->del($data);
		}
		
		echo json_encode($return);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */