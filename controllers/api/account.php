<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('form_validation');
		
		$this->load->model('/member_m', 'member');
	}
	
	public function login()
	{
		$data = $this->input->post();
		
		if ( ! $this->form_validation->required($data['id']) ) {
			$return = array('result' => FALSE, 'message' => '아이디를 입력하세요.');
		} elseif ( ! $this->form_validation->required($data['pw']) ) {
			$return = array('result' => FALSE, 'message' => '비밀번호를 입력하세요.');
		} else {
			$return = $this->member->login($data);
			if ( $return['result'] ) {
				$this->session->set_userdata($return);
			}
		}
		
		echo json_encode($return);
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		
		echo json_encode(array('result' => TRUE));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */