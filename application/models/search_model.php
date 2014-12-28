<?php

class search_model extends CI_Model
{
	private $_user_table = 'user';
	private $_news_table = 'news';
	public function __construct()
	{
		parent::__construct();
	}

	public function get_list( $key )
	{
		$this->db->like( 'nickname', $key );
		$arr['user'] = $this->db->get( $this->_user_table )->result();

		$this->db->like( 'title', $key );
		$arr['news'] = $this->db->get( $this->_news_table )->result();
		return $arr;
	}
}

?>
