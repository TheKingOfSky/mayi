<?php
class comment_model extends
{
	private $_start = 0;
	private $_step = 10;
	private $_table = 'comment';

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
