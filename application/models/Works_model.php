<?php

defined('BASEPATH') or exit('No direct script access allowed');

  class Works_model extends CI_Model
  {
      public function view_all_work()
      {
          $result = $this->db->get('rs_job_table');

          return $result->result();
      }

      public function create_work()
      {
          // Input post data content to rs_post_table specifically thai language
        $data_work_table = array(
        'work_title'       => $this->db->escape_str($this->input->post('work_title')),
        'work_content'     => $this->db->escape_str($this->input->post('work_content')),
        'work_department'   => $this->db->escape_str($this->input->post('work_department')),
        );

            $insert_work_table = $this->db->insert('rs_job_table', $data_work_table , TRUE);

            if ($this->db->last_query()) {
                return TRUE;
            } else {
                return FALSE;
            }
      } // end function create_work



      public function edit_work($work_id)
      {
        $data_work_table = array(
          'work_title'       => $this->db->escape_str($this->input->post('work_title')),
          'work_content'     => $this->db->escape_str($this->input->post('work_content')),
          'work_department'   => $this->db->escape_str($this->input->post('work_department')),
        );
        $this->db->set($data_work_table);
        $this->db->where('work_id' , $work_id);
        $update_work_id = $this->db->update('rs_job_table');

      }

        public function delete_work($work_id){
        $this->db->where('work_id' , $work_id);
        $delete_job_table = $this->db->delete('rs_job_table');
        if ($this->db->last_query() ) {
            return TRUE;
        } else {
            return FALSE;
        }
      } // end delete_work function




      public function work_by_id($work_id){
          $this->db->where('work_id' , $work_id);
          $work_by_id = $this->db->get('rs_job_table');
          return  $work_by_id->row();
      }





  }//end model
