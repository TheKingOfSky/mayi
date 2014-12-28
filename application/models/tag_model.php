<?php

class tag_model extends CI_Model
{
	private $_table = 'tags';

	public function __construct()
	{
		parent::__construct();
	}

	public function get_list()
	{
		return $this->db->get( $this->_table )->result();
	}
}

?>
