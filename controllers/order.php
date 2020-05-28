<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
	}
	
	// 주문 리스트 
	public function order_lists()
	{
	    $searchForm = $this->input->post();
	    
	    $this->load->model('/order_m', 'order');
	    
	    $searchForm['search_field1'] = ( ! empty($searchForm['search_field1']) ) ? $searchForm['search_field1'] : 'u_email';
	    $searchForm['search_field2'] = ( ! empty($searchForm['search_field2']) ) ? $searchForm['search_field2'] : 'u_name';
	    $searchForm['search_field3'] = ( ! empty($searchForm['search_field3']) ) ? $searchForm['search_field3'] : 'id';
	    $searchForm['search_field4'] = ( ! empty($searchForm['search_field4']) ) ? $searchForm['search_field4'] : 'u_phone';
	    $searchForm['search_word1'] = ( ! empty($searchForm['search_word1']) ) ? $searchForm['search_word1'] : '';
	    $searchForm['search_word2'] = ( ! empty($searchForm['search_word2']) ) ? $searchForm['search_word2'] : '';
	    $searchForm['search_word3'] = ( ! empty($searchForm['search_word3']) ) ? $searchForm['search_word3'] : '';
	    $searchForm['search_word4'] = ( ! empty($searchForm['search_word4']) ) ? $searchForm['search_word4'] : '';
	    
	    $request = $this->order->lists($searchForm);
	    
	    $searchForm['record_start'] = $request['record_start'];
	    $searchForm['record_count'] = $request['record_count'];
	    $searchForm['total_record'] = $request['total_record'];
	    $searchForm['total_page']   = $request['total_page'];
	    $searchForm['action_url']   = '/order/order_lists';
	    
	    $contents = $this->load->view('/order/order_lists', array('request' => $request, 'searchForm' => $searchForm), TRUE);
	    $contents .= $this->load->view('/pagelist/pagelist_v', '', TRUE);
	    
	    $this->load->view('/layout', array('contents' => $contents));
	}
	
	// 사용자 정보 조회 
	public function user_view($idx = 0)
	{   
	    $searchForm = $this->input->post();
	    
	    $this->load->model('/member_m', 'member');
	    $member = $this->member->get(array('idx' => $idx));
	    $contents = $this->load->view('/member/user_view', array('member' => $member, 'searchForm' => $searchForm), TRUE);
	    $this->load->view('/layout', array('contents' => $contents));
	}
	
	

}