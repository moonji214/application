<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conf extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('form_validation');
		
		$this->load->model('/conf_m', 'conf');
	}
	
	// 由ъ뒪�듃 
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
	
	// 寃뚯떆�뙋 �엯�젰 
	public function add()
	{
		$data = $this->input->post();
		
		if ( ! $this->form_validation->required($data['b_name']) ) {
			$return = array('result' => FALSE, 'message' => '�옉�꽦�옄瑜� �엯�젰�븯�꽭�슂.');
		} elseif ( ! $this->form_validation->required($data['b_subject']) ) {
			$return = array('result' => FALSE, 'message' => '�젣紐⑹쓣 �엯�젰�븯�꽭�슂.');
		} elseif ( ! $this->form_validation->required($data['b_regdate']) ) {
		    $return = array('result' => FALSE, 'message' => '�벑濡앹씪�쓣 �엯�젰�븯�꽭�슂.');
		} elseif ( ! $this->form_validation->required($data['b_content']) ) {
			$return = array('result' => FALSE, 'message' => '�궡�슜�쓣 �엯�젰�븯�꽭�슂.');
		} else {
			
			$data['b_files'] = array();
			if ( ! empty($_FILES['b_files']) ) {
				$this->load->library('upload');
				$config['upload_path'] = './uploads/board_' . $data['bc_code'];
				$config['encrypt_name'] = TRUE;
				
				if ( ! is_dir($config['upload_path']) ) {
					mkdir($config['upload_path'], 0777);
				}
				
				$files = $_FILES;
				foreach ( $_FILES as $key => $val ) {
					switch ( $key ) {
						case 'b_files' :
							//$config['allowed_types'] = 'zip|pdf|ppt|gif|jpg|png';
							$config['allowed_types'] = '*';
							$title = '筌ｂ뫀占쏙옙�솁占쎌뵬';
							break;
					}
					
					$this->upload->initialize($config);
					
					switch ( $key ) {
						case 'b_files' :
							foreach ( $_FILES['b_files']['name'] as $key => $val ) {
								if ( ! empty($val) ) {
									$_FILES['b_files']['name'] = $files['b_files']['name'][$key];
									$_FILES['b_files']['type'] = $files['b_files']['type'][$key];
									$_FILES['b_files']['tmp_name'] = $files['b_files']['tmp_name'][$key];
									$_FILES['b_files']['error'] = $files['b_files']['error'][$key];
									$_FILES['b_files']['size'] = $files['b_files']['size'][$key];
									
									if ( ! $this->upload->do_upload('b_files') ) {
										echo json_encode(array('result' => FALSE, 'message' => $title . $key . '�몴占� 占쎈씜嚥≪뮆諭� 占쎈막 占쎈땾 占쎈씨占쎈뮸占쎈빍占쎈뼄.' . $this->upload->display_errors()));
										exit;
									} else {
										$tmp = $this->upload->data();
										$data['b_files'][$key]['original_name'] = $tmp['orig_name'];
										$data['b_files'][$key]['name'] = $tmp['file_name'];
										$data['b_files'][$key]['size'] = $tmp['file_size'];
										$data['b_files'][$key]['ext'] = $tmp['file_ext'];
									}
								}
							}
							break;
					}
				}
			}
			$data['b_files'] = serialize($data['b_files']);
			
			$return = $this->board->add($data);
		}
		
		echo json_encode($return);
	}
	
	//寃뚯떆湲� �닔�젙 
	public function set()
	{
		$data = $this->input->post();
		
		
		if ( ! $this->form_validation->required($data['b_idx']) ) {
			$return = array('result' => FALSE, 'message' => '寃뚯떆臾� 肄붾뱶瑜� �솗�씤�븯�꽭�슂.');
		}  elseif ( ! $this->form_validation->required($data['b_name']) ) {
			$return = array('result' => FALSE, 'message' => '�옉�꽦�옄瑜� �엯�젮�븯�꽭�슂.');
		} elseif ( ! $this->form_validation->required($data['b_subject']) ) {
			$return = array('result' => FALSE, 'message' => '�젣紐⑹쓣 �엯�젰�븯�꽭�슂.');
		} elseif ( ! $this->form_validation->required($data['b_content']) ) {
			$return = array('result' => FALSE, 'message' => '�궡�슜�쓣 �솗�씤�븯�꽭�슂.');
		} else {
			
			
			$data['b_files'] = array();
			if ( ! empty($_FILES['b_files']) ) {
				$this->load->library('upload');
				$config['upload_path'] = './uploads/board_' . $data['bc_code'];
				$config['encrypt_name'] = TRUE;
				
				if ( ! is_dir($config['upload_path']) ) {
					mkdir($config['upload_path'], 0777);
				}
				
				$files = $_FILES;
				foreach ( $_FILES as $key => $val ) {
					switch ( $key ) {
						case 'b_files' :
							//$config['allowed_types'] = 'zip|pdf|ppt|gif|jpg|png';
							$config['allowed_types'] = '*';
							$title = '�뙆�씪';
							break;
					}
					
					$this->upload->initialize($config);
					
					switch ( $key ) {
						case 'b_files' :
							foreach ( $_FILES['b_files']['name'] as $key => $val ) {
								if ( ! empty($val) ) {
									$_FILES['b_files']['name'] = $files['b_files']['name'][$key];
									$_FILES['b_files']['type'] = $files['b_files']['type'][$key];
									$_FILES['b_files']['tmp_name'] = $files['b_files']['tmp_name'][$key];
									$_FILES['b_files']['error'] = $files['b_files']['error'][$key];
									$_FILES['b_files']['size'] = $files['b_files']['size'][$key];
									
									if ( ! $this->upload->do_upload('b_files') ) {
										echo json_encode(array('result' => FALSE, 'message' => $title . $key . '�몴占� 占쎈씜嚥≪뮆諭� 占쎈막 占쎈땾 占쎈씨占쎈뮸占쎈빍占쎈뼄.' . $this->upload->display_errors()));
										exit;
									} else {
										$tmp = $this->upload->data();
										$data['b_files'][$key]['original_name'] = $tmp['orig_name'];
										$data['b_files'][$key]['name'] = $tmp['file_name'];
										$data['b_files'][$key]['size'] = $tmp['file_size'];
										$data['b_files'][$key]['ext'] = $tmp['file_ext'];
									}
								}
							}
							break;
					}
				}
			}

			$tmp = $this->board->get(array('b_idx' => $data['b_idx']));
			
			//$newfiles = $data['b_files'];
			//$oldfiles = $tmp['b_files'];
			
			if ( ! empty($data['b_filedel']) ) {
				foreach ( $data['b_filedel'] as $key => $val ) {
					unlink('./uploads/board_' . $data['bc_code'] . '/' . $oldfiles[$val]['name']);
					unset($oldfiles[$val]);
				}
				$oldfiles = array_values($oldfiles);
			}

			if ( ! empty($oldfiles) ) {
				foreach ( $newfiles as $key => $val ) {
					array_push ($oldfiles, $val);
				}

				$data['b_files'] = serialize($oldfiles);
			} else {
				//$data['b_files'] = serialize($newfiles);
			}
			$return = $this->board->set($data);
		}
		
		echo json_encode($return);
	}
	
	//疫뀐옙嚥≪뮆苡띰옙肉됵옙遊쏙옙肉� 野껊슣�뻻占쎈솇 �빊遺쏙옙
	
	
	
	
	public function del()
	{
		$data = $this->input->post();
		
		if ( ! $this->form_validation->required($data['b_idx']) ) {
			$return = array('result' => FALSE, 'message' => '寃뚯떆湲� 肄붾뱶媛� �뾾�뒿�땲�떎.');
		} else {
			$return = $this->board->del($data);
		}
		
		echo json_encode($return);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */