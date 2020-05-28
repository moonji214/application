<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Board extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
	}
	//게시판 리스트
	public function lists($board = '')
	{
		$contents = $this->load->view('/board/lists', array('current_board' => $board), TRUE);
		$this->load->view('/layout', array('contents' => $contents));
	}
	
	//글로벌에프엠 게시판
	public function my_lists($board = '')
	{
		$contents = $this->load->view('/board/my_lists', array('current_board' => $board), TRUE);
		$this->load->view('/layout', array('contents' => $contents));
	}
	
	// 게시판 조회 
	public function view($idx = 0)
	{
		$this->load->model('board_m', 'board');
		$board = $this->board->get(array('b_idx' => $idx));
		$contents = $this->load->view('/board/view', array('board' => $board), TRUE);
		$this->load->view('layout', array('contents' => $contents));
	}
	// 게시판 등록
	public function regist($board = '')
	{
		$contents = $this->load->view('/board/regist', array('current_board' => $board), TRUE);
		$this->load->view('/layout', array('contents' => $contents));
	}
	
	public function regist2($board = '')
	{
		$contents = $this->load->view('/admin/board/regist2_v', array('current_board' => $board), TRUE);
		$this->load->view('/admin/layout_v', array('contents' => $contents));
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */