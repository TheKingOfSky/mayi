<?php
class news_model extends CI_Model
{
	//private $page = 1;
	private $_start = 1;
	private $_step = 10;
	private $_table = 'news';
	function __construct()
	{
		parent::__construct();
	}

	public function get_index_list( $select = '*' )
	{
		$this->db->select( $select );
		$this->db->limit( $this->_step, $this->_start );
		$this->db->order_by( 'createtime', 'desc' );
		return $this->db->get( $this->_table )->result_array();
	}

	public function get_news_detail( $id )
	{
		$this->db->where( 'id', $id );
		return $this->db->get( $this->_table )->result_array();
	}

	//@@设置页数
	//@@titan
	public function set_page( $page )
	{
		$this->_start = ($page-1)*$this->_step;
	}

	public function clear_page()
	{
		$this->_start = 1;
	}

	//@@设置每页显示数量
	//@@titan
	public function set_step( $step )
	{
		$this->_step = $step;
	}

	//@@设置每页显示数量为默值
	public function clear_step()
	{
		$this->_step = 10;
	}
}
?>
