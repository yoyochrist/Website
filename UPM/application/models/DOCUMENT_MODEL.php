<?php
 
	class DOCUMENT_MODEL extends CI_Model 
	{
	 
		function __construct() 
		{
			parent::__construct();
		}
	 
		function get_document($num,$offset) 
		{
			$query = $this->db->get('trdocument',$num,$offset);
			if ($query->num_rows() > 0) 
			{
				return $query->result_array();
			} 
			else 
			{
				return FALSE;
			}
		}
		
		function get_document_code()
		{
			$query=$this->db->get('trdocument');
			
			if ($query->num_rows() > 0) 
			{
				return $query->result();
			}
		}
		
		function get_document_search($doc_code,$num,$offset) 
		{     
			$condition = "doc_code like " . "'%" . $doc_code . "%'";
			$this->db->select('*');
			$this->db->where($condition);
			$query = $this->db->get('trdocument',$num,$offset);
			
			if($query->num_rows() > 0)
			{
				return $query->result_array();
			}
			else
				return FALSE;
		}
		
		function get_lost_record($doc_code) 
		{     
			$condition = "doc_code like " . "'%" . $doc_code . "%'";
			$this->db->select('*');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get('trdocument');
			
			if($query->num_rows() > 0)
			{
				return TRUE;
			}
			else
				return FALSE;
		}

		function get_document_detail($doc_code) 
		{     
			$condition = "doc_code like " . "'%" . $doc_code . "%'";
			$this->db->select('*');
			$this->db->where($condition);
			$query = $this->db->get('trdocument');
			if($query->num_rows()==1)
			{
				return $query->row_array();
			}
			else if($query->num_rows() > 1)
			{
				return $query->result_array();
			}
			else
				return FALSE;
		}
		
		function get_dropdown_doc_levellist()
		{
			$this->db->from('msleveldocument');
			$this->db->order_by('leveldoc_order');
			$query = $this->db->get();
			
			return $query->result();
		}
		
		function get_dropdown_doc_typesort($doc_level)
		{
			$condition = "doc_level = " . "'" . $doc_level . "'";
			$this->db->from('mstypedocument');
			$this->db->join('trdocument','mstypedocument.typedoc_id = trdocument.doc_type');
			$this->db->where($condition);
			$query = $this->db->get();
			
			return $query->result();
		}
		
		function get_dropdown_doc_nosort($doc_type)
		{
			$condition = "doc_type = " . "'" . $doc_type . "'";
			$this->db->from('trdocument');
			$this->db->where($condition);
			$query = $this->db->get();	
			
			return $query->result();
		}

		function get_dropdown_doc_typelist()
		{
			$this->db->from('mstypedocument');
			$this->db->order_by('typedoc_id');
			$query = $this->db->get();
			
			return $query->result();
		}
	 
		function insert_document($data) 
		{
			$this->db->insert('trdocument', $data);
		}
		
		function update_document($doc_code, $data) 
		{
			$this->db->where('doc_code', $doc_code);
			$this->db->update('trdocument', $data);
		}
		
		function delete_document($doc_code, $doc_filename) 
		{
			$condition = "doc_code =" . "'" . $doc_code . "'";
			$this->db->where($condition);
			$this->db->delete('trdocument');
			$path = './pdf/'.$doc_filename;
			unlink($path);
		}

		function delete_file($doc_filename) 
		{
			$path = './pdf/'.$doc_filename;
			unlink($path);
		}
	}
?>