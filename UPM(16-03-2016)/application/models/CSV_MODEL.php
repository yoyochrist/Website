<?php
 
class CSV_MODEL extends CI_Model 
{
 
    function __construct() 
	{
        parent::__construct();
    }
 
    function get_document() 
	{     
        $query = $this->db->get('trdocument');
        if ($query->num_rows() > 0) 
		{
            return $query->result_array();
        } 
		else 
		{
            return FALSE;
        }
    }
 
    function insert_csv($data) 
	{
        $this->db->insert('trdocument', $data);
    }
}
/*END OF FILE*/
?>