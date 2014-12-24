<?php
class note_model extends CI_Model
{
	private $_step = 10;
	private $_start = 0;
	private $_table = 'note';
	private $_cmt_table = 'note_comments'; //评论表
	public function __construct()
	{
		parent::__construct();
	}

	public function insert_note( $data )
	{
		return $this->db->insert( $this->_table, $data );
	}

	public function get_note_list()
	{
		$this->db->order_by( 'create_time', 'DESC' );
		$this->db->limit( $this->_step, $this->_start );
		return $this->db->get('note')->result_array();
	}

	public function insert_comments( $data )
	{
		return $this->db->insert( $this->_cmt_table, $data );
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
