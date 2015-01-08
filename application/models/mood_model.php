<?php

class mood_model extends CI_Model
{
	private $_table = 'mood';
	private $_mood_news_table = 'mood_news';
	public function __construct()
	{
		parent::__construct();
	}

	public function get_list()
	{
		return $this->db->get( $this->_table )->result();
	}

	public function mood_isset( $news_id, $mood_id )
	{
		return $this->db->where( array( 'news_id'=>$news_id, 'mood_id'=>$mood_id ) )->get( $this->_mood_news_table )->row();
	}

	public function update_mood_news( $news_id, $mood_id )
	{
		$this->db->where( array( 'news_id'=>$news_id, 'mood_id'=>$mood_id ) );
		$this->db->set( 'num', 'num+1', FALSE );
		$this->db->update( $this->_mood_news_table );
		return $this->db->affected_rows();
	}

	public function insert_mood_news( $news_id, $mood_id )
	{
		$arr['news_id'] = $news_id;
		$arr['mood_id'] = $mood_id;
		return $this->db->insert( $this->_mood_news_table, $arr );
	}
}

?>
