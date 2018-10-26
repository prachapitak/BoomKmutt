<?php

defined('BASEPATH') or exit('No direct script access allowed');

  class Users_model extends CI_Model
  {


    public function view_all_user(){
      $result = $this->db->get('rs_user_table');
      return $result->result();
    }

    public function create_user()
    {
      // $options = ['cost' => 13];
      // $encripted_pass = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options);
      // insert data to database
	      $data = array(
	        'first_name' => $this->input->post('first_name'),
	        'last_name'  => $this->input->post('last_name'),
	        'email'      => $this->input->post('email'),
	        'username'   => $this->input->post('username'),
	        'password'   => $this->input->post('password'),
	      );
      	$insert_data = $this->db->insert('rs_user_table', $data);
        return $insert_data;
    } // end function create_user

    public function login_user($username, $password)
    {

      $this->db->where( array('username' => $username ));
      $result = $this->db->get('rs_user_table');

      if(!empty($result->row()->password)){
          if($password == $result->row()->password){
             return $result->row()->user_id;
          }
          else{
            return FALSE;
          }
      }

      // if(!empty($result->row()->password)){
      //   $db_password = $result->row()->password;
      //   if (password_verify($password, $db_password)) {
      //       return $result->row()->user_id;
      //   } else {
      //       return FALSE;
      //   }
      // }
  } // END LOGIN USER

  public function delete_user($user_id){
    $this->db->where('user_id' , $user_id);
    $delete_user_table = $this->db->delete('rs_user_table');
    if ($this->db->last_query() ) {
        return TRUE;
    } else {
        return FALSE;
    }
  }

  public function logout(){
    // unset session function in CI
    $this->session->sess_destroy();
    redirect('base_url()');
  } // END LOGOUT

  public function edit_user($user_id)
  {
      $data = array(
          'first_name' => $this->input->post('first_name'),
          'last_name'  => $this->input->post('last_name'),
          'email'      => $this->input->post('email'),
          'password'   => $this->input->post('password'),
        );
      $this->db->set($data);
      $this->db->where('user_id' , $user_id );
      $update_post_table = $this->db->update('rs_user_table');

  }

  public function user_by_id($user_id){
      $user_by_id = $this->db->query("SELECT *
        FROM rs_user_table
        WHERE user_id = $user_id
      ");
      return  $user_by_id->row();
  }



}
