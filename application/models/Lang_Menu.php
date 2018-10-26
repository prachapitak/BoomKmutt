<?php
defined('BASEPATH') OR exit('No direct script access allowed');




class Lang_Menu extends CI_Model {

	private $table_name = 'wtc_cdaily_model'; 
	private $joined_table_name_1 = ''; 
	private $joined_on_1 = ''; 
	private $default_order_by = 'cmodel_id ASC'; 
	private $default_limit_start = 0; 
	private $default_limit_end = 100; 

	public function __construct()
	{
		parent::__construct();
	}
	
	
	public function menuweb()
	{
		
	 
	 $tbl 	  = $this->db->dbprefix.'product_type';
	 
	 $menutbl = $this->db->dbprefix.'menu_web';
	 $menuwhere  = 'menu_st =1';
	 $menuorder  = 'menu_no ASC';
	 
	 $menuall = $this->result($menutbl ,$menuwhere,'0','',$menuorder);
	 
	 $menuabout = $this->get2($menutbl ,'menu_id = 1');
	 $data['menuabout'] = $menuabout;	
	 
	 $menuabout2 = $this->get2($menutbl ,'menu_id = 2');
	 $data['menuabout2'] = $menuabout2;	
	 
	 $menucolor = $this->get2($menutbl ,'menu_id = 2');
	 $data['menucolor'] = $menucolor;
	 
	 $menuproduct = $this->get2($menutbl ,'menu_id = 3');
	 $data['menuproduct'] = $menuproduct;
	 
	 $menuproducttype = $this->result($this->db->dbprefix.'product_type','type_st = 1','0','','type_no ASC');
	 
	 
	 $certslide = $this->result($this->db->dbprefix.'cert','cert_st = 1','0','','cert_no ASC');
	 $data['certslide'] = $certslide;	
	 
	 $data['menuproducttype'] = $menuproducttype;	
	 
	 $menuinspiration = $this->get2($menutbl ,'menu_id = 4');
	 $data['menuinspiration'] = $menuinspiration;
	 
	 $menunew = $this->get2($menutbl ,'menu_id = 5');
	 $data['menunew'] = $menunew;
	 
	 $menudealer = $this->get2($menutbl ,'menu_id = 6');
	 $data['menudealer'] = $menudealer;
	 
	 
	 $data['menuall'] = $menuall;	
	 $data['title']  = 'TOA INDONESIA | No.1 Brand in Thailand!! ';
	 
	
	  $footer = $this->get2($this->db->dbprefix.'setup','setup_id = 4');
	 $data['footer'] = $footer;
	 
	  $headersocial = $this->get2($this->db->dbprefix.'setup','setup_id = 4');
	 $data['headersocial'] = $headersocial;
	 
		return $data;
	
		
	
		//$this->load->view('welcome_message');
	}
	
	
	

	public function insert($data = NULL)
	{
		$this->db->insert($this->table_name, $data);
	}

	public function update($where = NULL, $data = NULL)
	{
		if($where !== NULL)
			$this->db->where($where);
		$this->db->update($this->table_name, $data);
	}
	
	
	public function update2($table = NULL,$where = NULL, $data = NULL)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
			
	}

	public function delete($where = NULL)
	{
		if($where !== NULL)
			$this->db->where($where);
		$this->db->delete($this->table_name);
	}

	public function existing($where = NULL){
		$this->db->select('id');
		$this->db->from($this->table_name);
		
		if($where !== NULL)
			$this->db->where($where);
		else 
			return FALSE;

		$this->db->limit(1);
		
		$record = $this->db->get();

		if($record->num_rows() > 0){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function all($start = NULL, $end = NULL, $order_by = NULL)
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		
		if($order_by !== NULL)
			$this->db->order_by($order_by);
		else
			$this->db->order_by($this->default_order_by);

		if($start !== NULL && $end !== NULL)
			$this->db->limit($end, $start);
		else
			$this->db->limit($this->default_limit_end, $this->default_limit_start);
		
		$records = $this->db->get();

		if($records->num_rows() > 0){
			return $records->result();
		}else{
			return NULL;
		}
	}

	public function find($where = NULL, $start = NULL, $end = NULL, $order_by = NULL)
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		
		if($where !== NULL)
			$this->db->where($where);

		if($order_by !== NULL)
			$this->db->order_by($order_by);
		else
			$this->db->order_by($this->default_order_by);

		if($start !== NULL && $end !== NULL)
			$this->db->limit($end, $start);
		else
			$this->db->limit($this->default_limit_end, $this->default_limit_start);
		
		$records = $this->db->get();

		if($records->num_rows() > 0){
			return $records->result();
		}else{
			return NULL;
		}
	}
	
	
	public function result($table= NULL, $where = NULL, $start = NULL, $end = NULL, $order_by = NULL)
	{
		$this->db->select('*');
		$this->db->from($table);
		
		if($where !== NULL)
			$this->db->where($where);

		if($order_by !== NULL)
			$this->db->order_by($order_by);
		else
			$this->db->order_by($this->default_order_by);

		if($start !== NULL && $end !== NULL)
			$this->db->limit($end, $start);
		else
			$this->db->limit($this->default_limit_end, $this->default_limit_start);
		
		$records = $this->db->get();

		if($records->num_rows() > 0){
			return $records->result();
		}else{
			return NULL;
		}
	}
	
	
		public function find3($table= NULL, $where = NULL, $start = NULL, $end = NULL, $order_by = NULL)
	{
		$this->db->select('cmodel_id,
cmodel_st,
cmodel_stsell,
cmodel_type1,
cmodel_type2,
cmodel_name_en,
cmodel_name_th,
cmodel_name_ru,
cmodel_name_ch,
cmodel_re1_en,
cmodel_re1_th,
cmodel_re1_ru,
cmodel_re1_ch,
cmodel_price_en,
cmodel_price_th,
cmodel_price_ru,
cmodel_price_ch,
cmodel_re2_en,
cmodel_re2_th,
cmodel_re2_ru,
cmodel_re2_ch,
cmodel_date,
cmodel_built,
cmodel_lsize,
cmodel_area,
cmodel_bedr,
cmodel_bathr,
cmodel_beds,
cmodel_garage,
cmodel_ame_en,
cmodel_ame_th,
cmodel_ame_ru,
cmodel_ame_ch,
cmodel_space_en,
cmodel_space_th,
cmodel_space_ru,
cmodel_space_ch,
cmodel_lat,
cmodel_long,
cmodel_urlf,
cmodel_code,
cmodel_mtype1,
cmodel_mtype2,
cmodel_mtype3,
cmodel_mtype4,
cmodel_tag,
cmodel_view,
cmodel_showhome,
cmodel_so_title,
cmodel_so_des,
');
		$this->db->from($table);
		
		if($where !== NULL)
			$this->db->where($where);

		if($order_by !== NULL)
			$this->db->order_by($order_by);
		else
			$this->db->order_by($this->default_order_by);

		if($start !== NULL && $end !== NULL)
			$this->db->limit($end, $start);
		else
			$this->db->limit($this->default_limit_end, $this->default_limit_start);
		
		$records = $this->db->get();

		if($records->num_rows() > 0){
			return $records->result();
		}else{
			return NULL;
		}
	}

	public function get($where = NULL)
	{
		$this->db->select('*');
		$this->db->from($this->table_name);
		
		if($where !== NULL)
			$this->db->where($where);
		else 
			return NULL;

		$this->db->limit(1);
		
		$record = $this->db->get();

		if($record->num_rows() > 0){
			return $record->row();
		}else{
			return NULL;
		}
	}
	
	
	public function get2($table=NULL,$where = NULL)
	{
		$this->db->select('*');
		$this->db->from($table);
		
		if($where !== NULL)
			$this->db->where($where);
		else 
			return NULL;

		$this->db->limit(1);
		
		$record = $this->db->get();

		if($record->num_rows() > 0){
			return $record->row();
		}else{
			return NULL;
		}
	}
	
	
	

	public function sum($field = FALSE, $where = FALSE)
	{
	    if($where){
	     	$this->db->where($where);
	    }
	    $this->db->select_sum($field);
	    $record = $this->db->get($this->table_name);
	    if($record->num_rows() > 0){
	    	return $record->row();
	    }
	}

	public function _all($start = NULL, $end = NULL, $order_by = NULL)
	{
		$this->db->select('t.*, u.id as user_id, u.balance as user_balance');
		$this->db->from($this->table_name . ' t');
		$this->db->join($this->joined_table_name_1 . ' u', $this->joined_on_1, 'left');
		
		if($order_by !== NULL)
			$this->db->order_by($order_by);
		else
			$this->db->order_by($this->default_order_by);

		if($start !== NULL && $end !== NULL)
			$this->db->limit($end, $start);
		else
			$this->db->limit($this->default_limit_end, $this->default_limit_start);
		
		$records = $this->db->get();

		if($records->num_rows() > 0){
			return $records->result();
		}else{
			return NULL;
		}
	}

	public function _find($where = NULL, $start = NULL, $end = NULL, $order_by = NULL)
	{
		$this->db->select('t.*, u.id as user_id, u.balance as user_balance');
		$this->db->from($this->table_name . ' t');
		$this->db->join($this->joined_table_name_1 . ' u', $this->joined_on_1, 'left');
		
		if($where !== NULL)
			$this->db->where($where);

		if($order_by !== NULL)
			$this->db->order_by($order_by);
		else
			$this->db->order_by($this->default_order_by);

		if($start !== NULL && $end !== NULL)
			$this->db->limit($end, $start);
		else
			$this->db->limit($this->default_limit_end, $this->default_limit_start);
		
		$records = $this->db->get();

		if($records->num_rows() > 0){
			return $records->result();
		}else{
			return NULL;
		}
	}

	public function _get($where = NULL)
	{
		$this->db->select('t.*, u.id as user_id, u.balance as user_balance');
		$this->db->from($this->table_name . ' t');
		$this->db->join($this->joined_table_name_1 . ' u', $this->joined_on_1, 'left');
		
		if($where !== NULL)
			$this->db->where($where);
		else 
			return NULL;

		$this->db->limit(1);
		
		$record = $this->db->get();

		if($record->num_rows() > 0){
			return $record->row();
		}else{
			return NULL;
		}
	}
}