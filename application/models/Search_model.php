<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Search_model extends CI_Model {

    public function get_results($search_term='default')
    {
        // Use the Active Record class for safer queries.
        $this->db->select('*');
        $this->db->from('wtc_cprop_model');
        $this->db->like('cmodel_name_en',$search_term);

        // Execute the query.
        $query = $this->db->get();

        // Return the results.
        return $query->result_array();
    }

}