<?php
class comment_model extends CI_Model
{
	private $_start = 0;
	private $_step = 10;
	private $_table = 'comments';

	public function __construct()
	{
		parent::__construct();
	}

	public function get_news_comment( $news_id )
	{
		$this->db->where( 'news_id', $news_id );
		$this->db->limit( $this->_step, $this->_start );
		$this->db->order_by( 'createtime', 'desc' );
		return $this->db->get( $this->_table )->result_array();
	}

	public function insert_comment( $arr )
	{
		$this->db->insert( 'comment', $arr );
		return $this->db->insert_id();
	}

	public function get_my_sent_comment_list( $u_id )
	{
		$this->db->where( 'u_id', $u_id );
		$this->db->limit( $this->_step, $this->_start );
		$this->db->order_by( 'createtime', 'desc' );
		return $this->db->get( $this->_table )->result_array();
	}

	public function set_page( $page )
	{
		$this->_start = ( $page - 1 ) * $this->_step;
	}

	public function set_step( $step )
	{
		$this->_step = $step;
	}
}
?>
