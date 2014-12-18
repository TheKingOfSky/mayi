<?php

class message extends App_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'message_model' );
	}

	//@@FuncName:send_message
	//@@Description:发送留言
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function send_message()
	{
		//POST接收用户ID
		$u_id = $this->input->get_post( 'u_id', TRUE );
		$object_id = $this->input->get_post( 'object_id', TRUE );
		
		//POST接收留言内容
		$message = $this->input->get_post( 'message', TRUE );

		//判断内容是否为空
		if( empty( $message ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 留言内容不能为空';
			exit( json_encode( $arr ) );
		}

		//不为空,执行过滤

		//组织数据
		$data['u_id'] = $u_id;
		$data['object_id'] = $object_id;
		$data['message'] = $message;
		$data['create_time'] = time();

		//Model插入数据
		$insert_id = $this->message_model->create_new_message( $data );

		//return数据
		if( $insert_id )
		{
			$arr['code'] = 10010;
			$arr['message'] = '[success]';
			$arr['data'] = $insert_id;
			exit( json_encode( $arr ) );
		}
		else
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 数据错误';
			exit( json_encode( $arr ) );
		}
	}

	//@@FuncName:get_message
	//@@Description:获取用户留言
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function get_message()
	{
		//POST获取ID
		$u_id = $this->input->get_post( 'object_id', TRUE );
		//POST获取页码
		$page = $this->input->get_post( 'page', TRUE );
		if( empty( $page ) ) $page = 1;
		//设置页码
		//!!!先set_step设置每页显示个数再set_page设置页码
		$this->message_model->set_step( 10 );
		$this->message_model->set_page( $page );
		//MODEL获取数据
		$data = $this->message_model->get_message( $u_id );

		//判断数据是否为空
		if( empty( $data ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 数据为空';
			exit( json_encode( $arr ) );
		}

		foreach( $data as $k=>$v )
		{
			$data[$k]['userinfo'] = $this->user_model->get_user_base( $v['u_id'] );
		}

		//返回数据
		$arr['code'] = 10010;
		$arr['message'] = '[success]';
		$arr['data'] = $data;
		exit( json_encode( $arr ) );
	}
}

?>
