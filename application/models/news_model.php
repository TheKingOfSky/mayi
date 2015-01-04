<?php
class news_model extends CI_Model
{
	//private $page = 1;
	private $_start = 1;
	private $_step = 10;
	private $_table = 'news';
	private $_tag_table = 'tags_news';
	private $_mood_table = 'mood_news';
	private $_favorite_table = 'favorite';

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

	public function get_news_for_tag( $tag )
	{
		$this->db->select( $this->_table.'.*' );
		$this->db->limit( $this->_step, $this->_start );
		$this->db->from( $this->_table );
		$this->db->join( $this->_tag_table, $this->_table.'.id = '.$this->_tag_table.'.news_id' );
		$this->db->order_by( $this->_table.'.createtime', 'DESC' );
		$this->db->where( $this->_tag_table.'.tag_id', $tag );
		return $this->db->get()->result_array();
	}

	public function get_news_for_mood( $mood_id )
	{
		$this->db->select( $this->_table.'.*' );
		$this->db->limit( $this->_step, $this->_start );
		$this->db->from( $this->_table );
		$this->db->join( $this->_mood_table, $this->_table.'.id = '.$this->_mood_table.'.news_id' );
		$this->db->order_by( $this->_table.'.createtime', 'DESC' );
		$this->db->where( $this->_mood_table.'.mood_id', $mood_id );
		return $this->db->get()->result_array();
	}

	public function get_user_news_list( $u_id )
	{
		$this->db->where( 'u_id', $u_id );
		$this->db->limit( $this->_step, $this->_start );
		return $this->db->get( $this->_table )->result_array();
	}

	public function get_user_favorite_list( $u_id )
	{
		$this->db->select( $this->_table.'.*' );
		$this->db->limit( $this->_step, $this->_start );
		$this->db->from( $this->_table );
		$this->db->join( $this->_favorite_table, $this->_table.'.id = '.$this->_favorite_table.'.object_id' );
		$this->db->order_by( $this->_table.'.createtime', 'DESC' );
		$this->db->where( $this->_favorite_table.'.u_id', $u_id );
		return $this->db->get()->result_array();
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
