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
		$insert_id = $this->message_model->create_new_message( $result );

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

	public function get_message()
	{
		
	}
}

?>
