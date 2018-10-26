<?php
defined('BASEPATH') OR exit('No direct script access allowed');




class Query_Db extends CI_Model {

	private $table_name = 'wtc_cdaily_model'; 
	private $joined_table_name_1 = ''; 
	private $joined_on_1 = ''; 
	private $default_order_by = ''; 
	private $default_limit_start = 0; 
	private $default_limit_end = 100; 

	public function __construct()
	{
		parent::__construct();
	}
	
	

	/*public function insert($data = NULL)
	{
		$this->db->insert($this->table_name, $data);
	}*/
	
	
	public function insert($table,$data = NULL)
	{
		$this->db->insert($table, $data);
	}


	public function update($where = NULL, $data = NULL)
	{
		if($where !== NULL)
			$this->db->where($where);
		$this->db->update($this->table_name, $data);
	}
	
	
	public function update2($table,$where = NULL, $data = NULL)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
			
	}
	
	public function delete2($table,$where = NULL)
	{
		if($where !== NULL)
			$this->db->where($where);
			$this->db->delete($table);
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
	
	
	public function record($table=NULL,$where = NULL,$orderby = NULL)
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