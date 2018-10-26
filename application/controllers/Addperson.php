<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//class Home extends CI_Controller {
	class Addperson extends CI_Controller {
	
	
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
			$get_person = $this->Query_Db->record($this->db->dbprefix.'person_count','id ="1"');
	
	$new_person = $get_person->val+1;
	
	$updateperson = $this->Query_Db->update2($this->db->dbprefix.'person_count','id ="1"',array( 'val' => $new_person));
		$res = json_encode(array('status' => '200','message' => 'add person successfully. '));
			echo $res;
		exit;			
				
		
		}
		
		
	public function Admin()
	{
		$data['title']  = 'KMUTT';
		$data['getperson'] = $this->Query_Db->record($this->db->dbprefix.'person_count','id ="1"');
			
			
				$this->load->view('main/indexadmin',$data);	
				
				
		
		}
		
	
		
	public function checknow()
	{
			
		$get_person = $this->Query_Db->record($this->db->dbprefix.'person_count','id ="1"');
	
	
	
		$newval = ($get_person->val/$get_person->maxval)*100;
		
		$res = json_encode(array('status' => '200','total' => $get_person->val,'total2' => $newval,'total3' => $get_person->maxval));
			echo $res;
		exit;			
				
		
		}
		
	public function resetperson($val= NULL)
	{
		
		
		$resetperson = $this->Query_Db->update2($this->db->dbprefix.'person_count','id ="1"',array( 'val' => '0'));
	
		$res = json_encode(array('status' => '200','message'=>'Reset Success','total' => 0));
			echo $res;
			exit;
			
				
				
		
		}
		
		
	public function setperson($val= NULL)
	{
		if(is_numeric($val) && !empty($val)){
			
			$resetperson = $this->Query_Db->update2($this->db->dbprefix.'person_count','id ="1"',array( 'val' => $val));
	
		
		
		//$put_po  = $this->Query_Db->insert($this->db->dbprefix.'po',$data_put_po );
		$res = json_encode(array('status' => '200','message'=>'Update Success','total' => $val));
			echo $res;
			exit;
			//	$this->load->view('main/index',$data);	
			
			}else{
				
				$res = json_encode(array('status' => '200','message'=>'Update Fail'));
			echo $res;
			exit;
			
				}
		
		
				
				
		
		}
		
		
	public function setmaxperson($val= NULL)
	{
		if(is_numeric($val) && !empty($val)){
			
			$resetperson = $this->Query_Db->update2($this->db->dbprefix.'person_count','id ="1"',array( 'maxval' => $val));
	
		
		
		//$put_po  = $this->Query_Db->insert($this->db->dbprefix.'po',$data_put_po );
		$res = json_encode(array('status' => '200','message'=>'Update Success','total' => $val));
			echo $res;
			exit;
			//	$this->load->view('main/index',$data);	
			
			}else{
				
				$res = json_encode(array('status' => '200','message'=>'Update Fail'));
			echo $res;
			exit;
			
				}
		
		
				
				
		
		}
		
		
	public function settitle($val= NULL)
	{
		if(!empty($val)){
			
			
			
			$resetperson = $this->Query_Db->update2($this->db->dbprefix.'person_count','id ="1"',array( 'title' => urldecode($val)));
	
		
		
		//$put_po  = $this->Query_Db->insert($this->db->dbprefix.'po',$data_put_po );
		$res = json_encode(array('status' => '200','message'=>'Update Success','title' => urldecode($val)));
			echo $res;
			exit;
			//	$this->load->view('main/index',$data);	
			
			}else{
				
				$res = json_encode(array('status' => '200','message'=>'Update Fail'));
			echo $res;
			exit;
			
				}
		
		
				
				
		
		}
		
		public function setfooter($val= NULL)
	{
		if(!empty($val)){
			
			
			
			$resetperson = $this->Query_Db->update2($this->db->dbprefix.'person_count','id ="1"',array( 'footer' => urldecode($val)));
	
		
		
		//$put_po  = $this->Query_Db->insert($this->db->dbprefix.'po',$data_put_po );
		$res = json_encode(array('status' => '200','message'=>'Update Success','footer' => urldecode($val)));
			echo $res;
			exit;
			//	$this->load->view('main/index',$data);	
			
			}else{
				
				$res = json_encode(array('status' => '200','message'=>'Update Fail'));
			echo $res;
			exit;
			
				}
		
		
				
				
		
		}
	
	
}
