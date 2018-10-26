<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Blogpage_model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function record_count() {
        return $this->db->count_all("wtc_news");
    }
	
	
	 public function record_count2() {
        return $this->db->count_all("wtc_homedesign");
    }

    public function fetch_news($limit, $start) {
        $this->db->limit($limit, $start);
		$this->db->order_by('news_date', 'DESC');
        $query = $this->db->get_where("wtc_news",array('news_status' => '1'));

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
			//echo phpinfo();
			
            return $data;
        }
        return false;
   }
   
    public function fetch_news2($limit, $start) {
        $this->db->limit($limit, $start);
		$this->db->order_by('news_date', 'DESC');
        $query = $this->db->get_where("wtc_homedesign",array('news_status' => '1'));

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
			//echo phpinfo();
			
            return $data;
        }
        return false;
   }
}
