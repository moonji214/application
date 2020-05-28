<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
      
    
    
	/*public function index()
	{
	    $contents = $this->load->view('/board/lists', array('contents' => "1"), TRUE);
	   
	    $this->load->view('layout' , array('contents' => $contents));
	}*/
	
	public function __construct()
	{
	    parent::__construct();
	    
	    if ( $this->session->userdata('u_admin') == 'Y' ) {
	        //header('Location:/admin/dashboard');
	        header('Location:/board/lists');
	        
	        die();
	    }
	}
	
	public function index()
	{
	    $this->load->view('/login_v');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */