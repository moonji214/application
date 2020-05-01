<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Board extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('form_validation');
		
		$this->load->model('/board_m', 'board');
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
	
	//湲�濡쒕쾶 �뿉�봽�뿞 寃뚯떆�뙋 由ъ뒪�듃
	public function lists2($board = '')
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
	
		$return = $this->board->lists2($data);
	
		echo json_encode($return);
	}
	
	// 게시판 입력 
	public function add()
	{
		$data = $this->input->post();
		
		if ( ! $this->form_validation->required($data['b_name']) ) {
			$return = array('result' => FALSE, 'message' => '작성자를 입력하세요.');
		} elseif ( ! $this->form_validation->required($data['b_subject']) ) {
			$return = array('result' => FALSE, 'message' => '제목을 입력하세요.');
		} elseif ( ! $this->form_validation->required($data['b_regdate']) ) {
		    $return = array('result' => FALSE, 'message' => '등록일을 입력하세요.');
		} elseif ( ! $this->form_validation->required($data['b_content']) ) {
			$return = array('result' => FALSE, 'message' => '내용을 입력하세요.');
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
							$title = '泥⑤��뙆�씪';
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
										echo json_encode(array('result' => FALSE, 'message' => $title . $key . '瑜� �뾽濡쒕뱶 �븷 �닔 �뾾�뒿�땲�떎.' . $this->upload->display_errors()));
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
	
	//게시글 수정 
	public function set()
	{
		$data = $this->input->post();
		
		
		if ( ! $this->form_validation->required($data['b_idx']) ) {
			$return = array('result' => FALSE, 'message' => '게시물 코드를 확인하세요.');
		}  elseif ( ! $this->form_validation->required($data['b_name']) ) {
			$return = array('result' => FALSE, 'message' => '작성자를 입려하세요.');
		} elseif ( ! $this->form_validation->required($data['b_subject']) ) {
			$return = array('result' => FALSE, 'message' => '제목을 입력하세요.');
		} elseif ( ! $this->form_validation->required($data['b_content']) ) {
			$return = array('result' => FALSE, 'message' => '내용을 확인하세요.');
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
							$title = '파일';
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
										echo json_encode(array('result' => FALSE, 'message' => $title . $key . '瑜� �뾽濡쒕뱶 �븷 �닔 �뾾�뒿�땲�떎.' . $this->upload->display_errors()));
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
	
	//湲�濡쒕쾶�뿉�봽�뿞 寃뚯떆�뙋 異붽�
	
	public function add2()
	{
		$data = $this->input->post();
		
		$data['b_gubun'] = ( ! empty($data['b_gubun']) ) ? $data['b_gubun'] : 'GLOBAL';
		
		if ( ! $this->form_validation->required($data['bc_code']) ) {
			$return = array('result' => FALSE, 'message' => '寃뚯떆�뙋 肄붾뱶媛� 議댁옱�븯吏� �븡�뒿�땲�떎');
		} elseif ( ! $this->form_validation->required($data['b_name']) ) {
			$return = array('result' => FALSE, 'message' => '�옉�꽦�옄瑜� �엯�젰�븯�떆湲� 諛붾엻�땲�떎');
		} elseif ( ! $this->form_validation->required($data['b_subject']) ) {
			$return = array('result' => FALSE, 'message' => '�젣紐⑹쓣 �엯�젰�븯�떆湲� 諛붾엻�땲�떎');
		} elseif ( ! $this->form_validation->required($data['b_content']) ) {
			$return = array('result' => FALSE, 'message' => '�궡�슜�쓣 �엯�젰�븯�떆湲� 諛붾엻�땲�떎');
		} else {
			if (!empty($data['strong'])) {
				$data['b_subject'] = '<strong>' . $data['b_subject'] . '</strong>';
			}
			if (!empty($data['color'])) {
				switch ($data['color']) {
					case 'r':
						$data['b_subject'] = '<font color="red">' . $data['b_subject'] . '</font>';
						break;
					case 'g':
						$data['b_subject'] = '<font color="green">' . $data['b_subject'] . '</font>';
						break;
					case 'b':
						$data['b_subject'] = '<font color="blue">' . $data['b_subject'] . '</font>';
						break;
				}
			}
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
							$title = '泥⑤��뙆�씪';
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
										echo json_encode(array('result' => FALSE, 'message' => $title . $key . '瑜� �뾽濡쒕뱶 �븷 �닔 �뾾�뒿�땲�떎.' . $this->upload->display_errors()));
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
			//$data['b_ipaddress'] = $this->input->ip_address();
				
			$return = $this->board->add2($data);
		}
	
		echo json_encode($return);
	}
	
	
	public function del()
	{
		$data = $this->input->post();
		
		if ( ! $this->form_validation->required($data['b_idx']) ) {
			$return = array('result' => FALSE, 'message' => '寃뚯떆臾� 肄붾뱶媛� 議댁옱�븯吏� �븡�뒿�땲�떎');
		} else {
			$return = $this->board->del($data);
		}
		
		echo json_encode($return);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */