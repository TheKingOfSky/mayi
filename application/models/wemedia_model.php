<?php

class wemedia_model extends CI_Model
{
	private $_step = 10;
	private $_start = 0;

	//数据表
	private $_table = 'we_media';
	private $_user_table = 'user';
	private $_upro_table = 'user_profile';

	public function __construct()
	{
		parent::__construct();
	}
/*
	public function insert( $arr )
	{
		$this->db->insert( $this->_upro_table, $arr );
		if( ! $this->db->insert_id() )
		{
			return FALSE;
		}
		return TRUE;
	}
*/

	public function get_list()
	{
		echo 444;
		/*
		$this->db->where( 'we_media', 1 );
		$this->db->limit( $this->_step, $this->_start );
		return $this->db->get( $this->_user_table )->result();
		 */
	}

	/*
	private function set_page( $page )
	{
		$this->_start = ( $page - 1 ) * $this->_step;
	}

	private function set_step( $step )
	{
		$this->_step = $step;
	}
	 */
}

?>
