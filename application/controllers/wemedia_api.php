<?php
class wemedia_api extends App_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'wemedia_model' );
	}

	public function submit_wemedia()
	{
		$name = $this->input->get_post( 'name', TRUE );
		if( empty( $name ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 请输入你的姓名';
			exit( json_encode( $arr ) );
		}

		$sex = $this->input->get_post( 'sex', TRUE );
		if( empty( $sex ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 请确认你的性别';
			exit( json_encode( $arr ) );
		}

		$id_card = $this->input->get_post( 'id_card', TRUE );
		if( ! is_idcard( $id_card ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 身份证号格式不正确';
			exit( json_encode( $arr ) );
		}

		$email = $this->input->get_post( 'email', TRUE );
		if( ! is_email( $email ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 邮箱格式不正确';
			exit( json_encode( $arr ) );
		}

		$mobile = $this->input->get_post( 'mobile', TRUE );
		if( ! is_phone( $mobile ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 手机号码格式不正确';
			exit( json_encode( $arr ) );
		}
		//图片处理
		//$_FILE['idcard_img']

		$insert['truename'] = $name;
		$insert['sex'] = $sex;
		$insert['email'] = $email;
		$insert['mobile'] = $mobile;
		$insert['id_card'] = $id_card;
		
		if( $this->wemedia_model->insert( $insert ) )
		{
			$arr['code'] = 10010;
			$arr['message'] = '[success]';
			exit( json_encode( $arr ) );
		}
		else
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 数据错误';
		}
		
	}

	public function get_wemedia()
	{
		$page = $this->input->get_post( 'page', TRUE );
		if( empty( $page ) ) $page = 1;
		echo 111;
		$this->wemedia_model->set_step(9);
		echo 222;
		$this->wemedia_model->set_page( $page );
		$data = $this->wemedia_model->get_list();
		if( empty( $data ) )
		{
			$arr['code'] = 20010;
			$arr['msg'] = '[error] 数据为空';
			exit( json_encode( $arr ) );
		}

		$arr['code'] = 10010;
		$arr['message'] = '[success]';
		$arr['data'] = $data;
		exit( json_encode( $arr ) );
	}
}
?>
