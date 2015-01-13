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
		$this->load->model( 'action_model' );
	}

	//@@FuncName:user_action
	//@@Description:获取用户动态
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function user_action()
	{
		//@@POST接收用户ID
		$u_id = $this->input->get_post( 'u_id', TRUE );
		if( empty( $u_id ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 没有接收到用户ID u_id';
			exit( json_encode( $arr ) );
		}

		$page = $this->input->get_post( 'page', TRUE );
		if( empty( $page ) )
		{
			$page = 1;
		}

		//Model层获取数据
		$this->action_model->set_step( 10 );
		$this->action_model->set_page( $page );
		$arr['data'] = $this->action_model->get_record( $u_id );
		$arr['code'] = 10010;
		$arr['message'] = '[success]';
		//return数据
		exit( json_encode( $arr ) );
	}

	//@@FuncName:user_read_record
	//@@Description:获取用户阅读记录
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function user_read_record()
	{
		//@@POST接收用户ID
		$u_id = $this->input->get_post( 'u_id', TRUE );
		if( empty( $u_id ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 没有接收到用户ID u_id';
			exit( json_encode( $arr ) );
		}

		$page = $this->input->get_post( 'page', TRUE );
		if( empty( $page ) )
		{
			$page = 1;
		}

		//Model层获取数据
		$this->action_model->set_step( 10 );
		$this->action_model->set_page( $page );
		$arr['data'] = $this->action_model->get_read_record( $u_id );
		$arr['code'] = 10010;
		$arr['message'] = '[success]';
		//return数据
		exit( json_encode( $arr ) );
	}

	//@@FuncName:user_favorite_record
	//@@Description:获取用户收藏记录
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function user_favorite_record()
	{
		//@@POST接收用户ID
		$u_id = $this->input->get_post( 'u_id', TRUE );
		if( empty( $u_id ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 没有接收到用户ID u_id';
			exit( json_encode( $arr ) );
		}

		$page = $this->input->get_post( 'page', TRUE );
		if( empty( $page ) )
		{
			$page = 1;
		}

		//Model层获取数据
		$this->action_model->set_step( 10 );
		$this->action_model->set_page( $page );
		$arr['data'] = $this->action_model->get_favorite_record( $u_id );
		$arr['code'] = 10010;
		$arr['message'] = '[success]';
		//return数据
		exit( json_encode( $arr ) );
	}

	//@@FuncName:user_comment_record
	//@@Description:获取用户收藏记录
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function user_comment_record()
	{
		//@@POST接收用户ID
		$u_id = $this->input->get_post( 'u_id', TRUE );
		if( empty( $u_id ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 没有接收到用户ID u_id';
			exit( json_encode( $arr ) );
		}

		$page = $this->input->get_post( 'page', TRUE );
		if( empty( $page ) )
		{
			$page = 1;
		}

		//Model层获取数据
		$this->action_model->set_step( 10 );
		$this->action_model->set_page( $page );
		$arr['data'] = $this->action_model->get_comment_record( $u_id );
		$arr['code'] = 10010;
		$arr['message'] = '[success]';
		//return数据
		exit( json_encode( $arr ) );
	}

	//@@FuncName:favorite_news
	//@@Description:收藏新闻
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

		$news = $this->news_model->get_news_detail( $news_id );
		$this->load->library( 'user_lib' );
		$action = $this->user_lib->get_username_for_id( $u_id ) . '收藏了《'. $news[0]['title'] .'》';
		$this->action_model->create_favorite_record( $u_id, $news_id, $action );
		
		$arr['message'] = '[success]';
		$arr['code'] = 10010;
		exit( json_encode( $arr ) );
	}

	//@@FuncName:mood_to_news
	//@@Description:设置新闻心情
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
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

	//@@FuncName: rewards
	//@@Description:打赏
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function rewards()
	{
		$u_id = $this->input->get_post( 'u_id', TRUE );
		if( empty( $u_id ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 没有接收到用户ID u_id';
			exit( json_encode( $arr ) );
		}

		$object_id = $this->input->get_post( 'object_id', TRUE );
		if( empty( $object_id ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 没有接收到打赏目标ID object_id';
			exit( json_encode( $arr ) );
		}

		$goods_id = $this->input->get_post( 'goods_id', TRUE );
		if( empty( $goods_id ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 没有接收到打赏物品ID goods_id';
			exit( json_encode( $arr ) );
		}

		$data['u_id'] = $u_id;
		$data['object_id'] = $object_id;
		$data['goods_id'] = $goods_id;
		$data['rewards_time'] = time();
		
		$this->load->model( 'rewards_model' );
		if( ! $this->rewards_model->insert( $data ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 打赏失败';
			exit( json_encode( $arr ) );
		}

		$this->load->model( 'goods_model' );
		$this->load->library( 'user_lib' );
		$goods = $this->goods_model->get_goods_for_id( $goods_id );
		$action = $this->user_lib->get_username_for_id( $u_id ) . '送出一个' . $goods . '给' . $this->user_lib->get_username_for_id( $object_id );
		$this->action_model->create_rewards_record( $u_id, $object_id, $action );

		$arr['code'] = 10010;
		$arr['message'] = '[success]';
		exit( json_encode( $arr ) );
	}
}
?>
