<?php 

class action_model extends CI_Model
{
	private $_table = 'action';
	private $_step = 10;
	private $_start = 0;

	public function __construct()
	{
		parent::__construct();
	}

	public function get_record( $u_id )
	{
		$this->db->where( 'u_id', $u_id );
		$this->db->limit( $this->_step, $this->_start );
		return $this->db->get( 'action' )->result_array();
	}

	public function create_read_record( $u_id, $object_id, $action )
	{
		$data['u_id'] = $u_id;
		$data['object_id'] = $object_id;
		$data['action'] = $action;
		$data['object_type'] = '[read-news]';
		$data['action_time'] = time();
		return $this->db->insert( 'action', $data );
	}

	public function get_read_record( $u_id )
	{
		$this->db->where( 'u_id', $u_id );
		$this->db->where( 'object_type', '[read-news]' );
		$this->db->limit( $this->_step, $this->_start );
		return $this->db->get( 'action' )->result_array();
	}

	public function create_favorite_record( $u_id, $object_id, $action )
	{
		$data['u_id'] = $u_id;
		$data['object_id'] = $object_id;
		$data['action'] = $action;
		$data['object_type'] = '[favorite-news]';
		$data['action_time'] = time();
		return $this->db->insert( 'action', $data );
	}

	public function get_favorite_record( $u_id )
	{
		$this->db->where( 'u_id', $u_id );
		$this->db->where( 'object_type', '[favorite-news]' );
		$this->db->limit( $this->_step, $this->_start );
		return $this->db->get( 'action' )->result_array();
	}

	public function create_comment_record( $u_id, $object_id, $action )
	{
		$data['u_id'] = $u_id;
		$data['object_id'] = $object_id;
		$data['action'] = $action;
		$data['object_type'] = '[comment-news]';
		$data['action_time'] = time();
		return $this->db->insert( 'action', $data );
	}

	public function get_comment_record( $u_id )
	{
		$this->db->where( 'u_id', $u_id );
		$this->db->where( 'object_type', '[comment-news]' );
		$this->db->limit( $this->_step, $this->_start );
		return $this->db->get( 'action' )->result_array();
	}

	public function create_rewards_record( $u_id, $object_id, $action )
	{
		$data['u_id'] = $u_id;
		$data['object_id'] = $object_id;
		$data['action'] = $action;
		$data['object_type'] = '[rewards-user]';
		$data['action_time'] = time();
		return $this->db->insert( 'action', $data );
	}

	public function get_rewards_record( $u_id )
	{
		$this->db->where( 'u_id', $u_id );
		$this->db->where( 'object_type', '[rewards-news]' );
		$this->db->limit( $this->_step, $this->_start );
		return $this->db->get( 'action' )->result_array();
	}

	public function set_page( $page )
	{
		$this->_start = ( $page - 1 )*$this->_step;
	}

	public function set_step( $step )
	{
		$this->_step = $step;
	}
}

?>
