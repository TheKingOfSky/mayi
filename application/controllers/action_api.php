<?php
//@@ClassName:action_api
//@@Description:APP个人动态接口
//@@Type:API-Controller
//@@Anthor:titan
//@@Time:
class action_api extends App_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	//@@FuncName:user_action
	//@@Description:
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function user_action()
	{
		//@@POST接收用户ID
		//
		//Model层获取数据
		//
		//return数据
	}

	//@@FuncName:favorite_news
	//@@Description:
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function favorite_news()
	{
		$news_id = $this->input->get_post( 'news_id', TRUE );
		if( empty( $news_id ) )
		{
			$arr['message'] = '[error] 没有接收到新闻ID';
			$arr['code'] = 20010;
			exit( json_encode( $arr ) );
		}

		$this->load->model( 'news_model' );
		if( ! $this->news_model->news_isset( $news_id ) )
		{
			$arr['message'] = '[error] 新闻不存在';
			$arr['code'] = 20010;
			exit( json_encode( $arr ) );
		}

		$u_id = $this->input->get_post( 'u_id', TRUE );
		if( empty( $u_id ) )
		{
			$arr['message'] = '[error] 没有接收到用户ID';
			$arr['code'] = 20010;
			exit( json_encode( $arr ) );
		}

		$this->load->model( 'favorite_model' );
		if( $this->favorite_model->favorite_isset( $u_id, $news_id ) )
		{
			$arr['message'] = '[error] 已收藏过该新闻';
			$arr['code'] = 20010;
			exit( json_encode( $arr ) );
		}

		$data['object_id'] = $news_id;
		$data['u_id'] = $u_id;
		$data['favorite_time'] = time();

		if( ! $this->favorite_model->favorite( $data ) )
		{
			$arr['message'] = '[error] 收藏失败';
			$arr['code'] = 20010;
			exit( json_encode( $arr ) );
		}
		
		$arr['message'] = '[success]';
		$arr['code'] = 10010;
		exit( json_encode( $arr ) );
	}

	public function mood_to_news()
	{
		$this->input->get_post( 'u_id', TRUE );

		$news_id = $this->input->get_post( 'news_id', TRUE );
		if( empty( $news_id ) )
		{
			$arr['message'] = '[error] 没有接收到news_id新闻ID';
			$arr['code'] = 20010;
			exit( json_encode( $arr ) );
		}

		$mood_id = $this->input->get_post( 'mood_id', TRUE );
		if( empty( $mood_id ) )
		{
			$arr['message'] = '[error] 没有接收到mood_id心情ID';
			$arr['code'] = 20010;
			exit( json_encode( $arr ) );
		}

		$this->load->model( 'mood_model' );
		if( $this->mood_model->mood_isset( $news_id, $mood_id ) )
		{
			$result = $this->mood_model->update_mood_news( $news_id, $mood_id );
			if( empty( $result ) )
			{
				$arr['message'] = '[error] 发表心情失败';
				$arr['code'] = 20010;
				exit( json_encode( $arr ) );
			}

			$arr['message'] = '[success]';
			$arr['code'] = 10010;
			exit( json_encode( $arr ) );
		}
		else
		{
			$result = $this->mood_model->insert_mood_news( $news_id, $mood_id );
			if( empty( $result ) )
			{
				$arr['message'] = '[error] 发表心情失败';
				$arr['code'] = 20010;
				exit( json_encode( $arr ) );
			}
			$arr['message'] = '[success]';
			$arr['code'] = 10010;
			exit( json_encode( $arr ) );
		}

		$arr['message'] = '[error] 异常错误';
		$arr['code'] = 20010;
		exit( json_encode( $arr ) );
	}
}
?>
