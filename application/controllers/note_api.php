<?php

class note_api extends App_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'note_model' );
		$this->load->model( 'user_model' );
	}

	public function note_list()
	{
		$page = $this->input->get_post( 'page', TRUE );
		if( empty( $page ) )
		{
			$page = 1;
		}

		//先set_step,再set_page,在不set_step的情况下默认值是10;
		$this->note_model->set_step( 10 );//设置每页条数
		$this->note_model->set_page( $page );//设置页码
		$data = $this->note_model->get_note_list();
		if( $data )
		{
			foreach( $data as $k=>$v )
			{
				$data[$k]['userinfo'] = $this->user_model->get_user_base( $v['u_id'] );
			}
		}
		$arr['data'] = $data;
		$arr['code'] = 10010;
		$arr['message'] = '[success]';
		exit( json_encode( $arr ) );
	}

	public function send_note()
	{
		$u_id = $this->input->get_post( 'u_id', TRUE );
		$content = $this->input->get_post( 'content', TRUE );

		if( empty( $u_id ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 没有接收到用户ID';
			exit( json_encode( $arr ) );
		}
		
		if( empty( $content ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 内容不能为空';
			exit( json_encode( $arr ) );
		}

		$data['u_id'] = $u_id;
		$data['content'] = $content;
		$data['create_time'] = time();
		$result = $this->note_model->insert_note( $data );
		if( empty( $result ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 发送失败';
			exit( json_encode( $arr ) );
		}
		else
		{
			$arr['code'] = 10010;
			$arr['message'] = '[success]';
			exit( json_encode( $arr ) );
		}
	}

	public function send_comments()
	{
		$u_id = $this->input->get_post( 'u_id', TRUE );
		if( empty( $u_id ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 没有接收到用户ID';
			exit( json_encode( $arr ) );
		}

		$object_id = $this->input->get_post( 'object_id', TRUE );
		if( empty( $object_id ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 没有接收到帖子ID';
			exit( json_encode( $arr ) );
		}

		$content = $this->input->get_post( 'content', TRUE );
		if( empty( $content ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 内容为空';
			exit( json_encode( $arr ) );
		}

		$data['u_id'] = $u_id;
		$data['object_id'] = $object_id;
		$data['content'] = $content;
		$data['create_time'] = time();
		$result = $this->note_model->insert_comments( $data );
		if( empty( $result ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 发送失败';
			exit( json_encode( $arr ) );
		}
		else
		{
			//添加动态
			$arr['code'] = 10010;
			$arr['message'] ='[success]';
			exit( json_encode( $arr ) );
		}
	}
}

?>
