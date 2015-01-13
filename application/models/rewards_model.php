<?php

class rewards_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insert( $data )
	{
		return $this->db->insert( 'rewards', $data );
	}
}

?>
