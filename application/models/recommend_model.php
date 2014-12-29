<?php

class recommend_model extends CI_Model
{
	private $_table = 'recommend';
	private $_news_table = 'news';
	public function __construct()
	{
		parent::__construct();
	}

	public function get_app_index_recommend()
	{
		$this->db->select( $this->_news_table.'.*' );
		$this->db->from( $this->_table );
		$this->db->join( $this->_news_table, $this->_news_table.'.id = ' . $this->_table . '.object_id' );
		$this->db->where( $this->_table.'.object_type', 'app' );
		$this->db->where( $this->_table.'.position', 'index' );
		$this->db->limit(3);
		return $this->db->get()->result();
		
	}
}

?>
