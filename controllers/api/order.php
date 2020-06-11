<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('form_validation');
		
		$this->load->model('/order_m', 'order');
	}
	
	// ff
	public function lists($board = '')
	{
	    echo "test";
	    exit;
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
		
		$return = $this->conf->lists($data);
		
		echo json_encode($return);
	}
	
	// 메뉴정보 가져오기 
	public function menu_view($m_seq=0)
	{
	    $data['m_seq'] = $m_seq;
	    $return = $this->conf->menu_view($data);
	    
	    echo json_encode($return);
	}
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */