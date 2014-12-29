<?php 

class recommend_api extends App_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'recommend_model' );
	}

	public function get_index_recommend()
	{
		$data = $this->recommend_model->get_app_index_recommend();
		$arr['code'] = 10010;
		$arr['message'] = '[success]';
		$arr['data'] = $data;
		exit( json_encode( $arr ) );
	}
}

?>
