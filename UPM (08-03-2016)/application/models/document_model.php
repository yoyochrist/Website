<?php
 
	class document_model extends CI_Model 
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
			$this->db->from('mstypedocument');
			$this->db->order_by('typedoc_id');
			$query = $this->db->get();
			
			return $query->result();
		}
		
		function get_dropdown_doc_typelist()
		{
			$this->db->from('doctype_view');
			$this->db->order_by('doctype_id');
			$query = $this->db->get();
			
			return $query->result();
		}
		
		function get_dropdown_doc_type_response($doc_level)
		{
			$condition = "doc_level = " . "'" . $doc_level . "'";
			$this->db->from('trdocument');
			$this->db->join('doctype_view','doctype_view.doctype_id = trdocument.doc_type');
			$this->db->where($condition);
			$this->db->order_by('doc_type');
			$query = $this->db->get();
			
			return $query->result();
		}
		
		function get_dropdown_doc_no($doc_type)
		{
			$condition = "doc_type = " . "'" . $doc_type . "'";
			$this->db->from('trdocument');
			$this->db->order_by('doc_no');
			$this->db->where($condition);
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
		
		function delete_document($doc_code) 
		{
			$condition = "doc_code =" . "'" . $doc_code . "'";
			$this->db->where($condition);
			$this->db->delete('trdocument');
		}
	}
?>