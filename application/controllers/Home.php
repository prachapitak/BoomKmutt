<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//class Home extends CI_Controller {
	class Home extends CI_Controller {
	
	
	public function __construct() {
		parent::__construct();
		$this->load->model('Lang_Menu');
		$this->load->model('Lang_Model');
		$this->load->model('Query_Db');
		
	}

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['title']  = 'KMUTT';
		$data['getperson'] = $this->Query_Db->record($this->db->dbprefix.'person_count','id ="1"');
			
			
				$this->load->view('main/index',$data);	
				
				
		
		}
	
	
	public function deleteimg($imgname = NULL)
	{
		

		if($imgname){

			$path = './assets/wallpaperapprove/'.$imgname.'.jpg';
		//	$this->load->helper("file");
			unlink($path);
			echo $path;
			echo 'Image'.$imgname.'delete';

		}
		
		

	$this->load->view('main/deleteimage');
		
	}
	
	public function checklogin()
	{
		
		$something = $this->input->post('username');
		$data['title']  = $something;
		$data['vendorlogin'] = $something;
		$this->load->view('main/index',$data);	
		//$this->load->view('welcome_message');
	}
}
