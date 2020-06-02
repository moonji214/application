<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conf extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('board_m', 'board');
	}
	//�Խ��� ����Ʈ
	public function menu($menu = '')
	{
		$contents = $this->load->view('/conf/menu', array('current' => $menu), TRUE);
		$this->load->view('/layout', array('contents' => $contents));
	}
	
	//�۷ι������� �Խ���
	public function my_lists($board = '')
	{
		$contents = $this->load->view('/board/my_lists', array('current_board' => $board), TRUE);
		$this->load->view('/layout', array('contents' => $contents));
	}
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */