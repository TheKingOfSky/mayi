<?php

class message_model extends CI_Model
{
	private $_table = 'message';
	private $_start = 0;
	private $_step = 10;

	public function __construct()
	{
		parent::__construct();
	}

	public function create_new_message( $data )
	{
		$this->db->insert( $_table, $data );
		return $this->db->insert_id();
	}

	public function get_message( $u_id )
	{
		$this->db->where( 'object_id', $u_id );
		$this->db->limit( $this->_step, $this->_start );
		return $this->db->get( 'message' )->result_array();
	}

	public function set_step( $step )
	{
		$this->_step = $step;
	}

	public function set_page( $page )
	{
		$this->_start = ( $page - 1 ) * $this->_step;
	}
	
}

?>
