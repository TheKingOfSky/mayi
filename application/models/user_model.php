<?php
class user_model extends CI_Model
{
	private $_table = 'user';

	public function __construct()
	{
		parent::__construct();
	}

	public function create_new_user( $arr )
	{
		$this->db->insert( 'user', $arr );
		if( ! $this->db->insert_id() )
		{
			return FALSE;
		}
		
		return $this->db->insert_id();
	}

	public function get_user_base( $u_id )
	{
		$this->db->where( 'id', $u_id );
		$result = $this->db->get( 'user' )->row();
		return $result;
	}

	public function get_user_profile( $u_id )
	{
		$this->db->where( 'u_id', $u_id );
		$result = $this->db->get( 'user_profile' )->result_array();
		return $result;
		
	}

	public function username_isset( $username )
	{
		$this->db->where( 'email', $username );
		$this->db->or_where( 'mobile', $username );
		return $this->db->get( $this->_table )->row();
	}
}
?>
