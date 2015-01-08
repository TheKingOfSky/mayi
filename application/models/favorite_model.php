<?php

class favorite_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function favorite( $data )
	{
		$this->db->insert( 'favorite', $data );
		return $this->db->insert_id();
	}

	public function favorite_isset( $u_id, $object_id )
	{
		$this->db->where( 'u_id', $u_id );
		$this->db->where( 'object_id', $object_id );
		return $this->db->get( 'favorite' )->row();
	}
}

?>
