<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lang_Model extends CI_Model {
	
	
	public function lang($lang)
	{
	
		
	switch ($lang) {

    case "en":
    $sessionlang = array('lang' => 'en');
	break;
	case "th":
    $sessionlang = array('lang' => 'lo');
    break;
    default:
    $sessionlang = array('lang' => 'en');
	
	
}



	 $this->session->set_userdata($sessionlang);
	

	
	}



	public function login($username ,$password){

		# code...
		$password = md5($password);

		//$condition = array('username' => $username ,
		//					'password' => $password);
		
		//$this->db->where($condition);

		$this->db->select('id,username,name,balance');
		$this->db->where('username', $username);
		$this->db->where('password', $password);

		$query = $this->db->get('users');

		$return['row']= $query->num_rows();
		$return['data']= $query->row();
		return $return;
		//var_dump($query->row());
		//var_dump($query->result());

		//echo $query->num_rows();
		//echo $this->db->last_query();

	}

}