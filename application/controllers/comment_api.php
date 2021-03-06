<?php
//@@ClassName:comment_api
//@@Description:APP用户注册接口
//@@Type:API-Controller
//@@Anthor:titan
//@@Time:
class comment_api extends App_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'comment_model' );
		$this->load->model( 'user_model' );
	}
	
	//@@FuncName:news_comment_list
	//@@Description:新闻评论列表
	//@@Open:public
	//@@Parameters:
	//@@Anthor:titan
	//@@Time:
	public function news_comment_list()
	{
		//POST接收新闻ID
		$news_id = $this->input->get_post( 'news_id', TRUE );
		$page = $this->input->get_post('page', TRUE);
		if( empty( $page ) ) $page = 1;
		if( empty( $news_id ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 没有接收新闻ID';
			
			exit( json_encode( $arr ) );
		}

		//Model层获取数据
		$this->comment_model->set_step( 10 );
		$this->comment_model->set_page( $page );
		$data = $this->comment_model->get_news_comment( $news_id );

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
			
		//return数据
		$arr['code'] = 10010;
		$arr['message'] = '[success]';
		$arr['data'] = $data;
		exit( json_encode( $arr ) );
	}

	//@@FuncName: at_comment_list
	//@@Description: 获取@自己的评论
	//@@Open:public
	//@@Parameters:
	//@@Anthor:titan
	//@@Time:
	public function at_comment_list()
	{
		//POST接收用户ID
		//
		//Model层获取数据
		//
		//return数据
	}

	//@@FuncName: send_comment
	//@@Description: 发送评论
	//@@Open:public
	//@@Parameters: {'u_id':'用户ID', 'news_id':'新闻ID', 'comment':'评论内容', 'p_id':'父ID'}
	//@@Anthor:titan
	//@@Time:
	public function send_comment()
	{
		//POST接收新闻ID和评论内容
		$u_id = $this->input->get_post( 'u_id', TRUE );
		$news_id = $this->input->get_post( 'news_id', TRUE );
		$comment = $this->input->get_post( 'comment', TRUE );
		$p_id = $this->input->get_post( 'p_id', TRUE );
		//检查评论内容是否为空
		if( empty( $u_id ) OR empty( $news_id ) OR empty( $comment ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 接收数据不全';
			exit( json_encode( $arr ) );
		}

		
		//评论内容不为空,执行内容过滤

		//整合数据
		$arr['createtime'] = time();
		$arr['u_id'] = $u_id;
		$arr['news_id'] = $news_id;
		$arr['content'] = $comment;
		$arr['p_id'] = $p_id;
		
		//检测@,有@的话插入@表
		
		//Model层插入数据,并获得执行结果
		$result = $this->comment_model->insert_comment( $arr );
		//Model层插入动态
		
		//return执行结果
		if( empty( $result ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 数据错误';
			exit( json_encode( $arr ) );
		}

		//写入动态
		$this->load->model( 'news_model' );
		$news = $this->news_model->get_news_detail( $news_id );
		$this->load->library( 'user_lib' );
		$action = $this->user_lib->get_username_for_id( $u_id ).'对《'. $news[0]['title'] .'》做出了评论: '. $content;
		$this->action_model->create_comment_record( $u_id, $news_id, $action );

		$arr['code'] = 10010;
		$arr['message'] = '[success]';
		exit( json_encode( $arr ) );
	}

	//@@FuncName: zan_comment
	//@@Description: 赞评论
	//@@Open:public
	//@@Parameters: None
	//@@Anthor:titan
	//@@Time:
	public function zan_comment()
	{
		$comment_id = $this->input->get_post( 'comment_id', TRUE );
		if( ! $this->comment_model->comment_isset( $comment_id ) )
		{
			$arr['message'] = '[error] 评论不存在';
			$arr['code'] = 20010;
			exit( json_encode( $arr ) );
		}

		if( ! $this->comment_model->zan( $comment_id ) )
		{
			$arr['message'] = '[error] 操作失败';
			$arr['code'] = 20010;
			exit( json_encode( $arr ) );
		}

		$arr['message'] = '[success]';
		$arr['code'] = 10010;
		exit( json_encode( $arr ) );
	}

	//@@FuncName: my_sent_comment
	//@@Description: 我发表的评论列表
	//@@Open:public
	//@@Parameters: None
	//@@Anthor:titan
	//@@Time:
	public function my_sent_comment()
	{
		$u_id = $this->input->get_post( 'u_id', TRUE );
		if( empty( $u_id ) )
		{
			$arr['message'] = '[error] 没有接收到用户ID';
			$arr['code'] = 20010;
			exit( json_encode( $arr ) );
		}

		$page = $this->input->get_post( 'page', TRUE );
		if( empty( $page ) )
		{
			$page = 1;	
		}

		$this->comment_model->set_step( 10 );
		$this->comment_model->set_page( $page );
		$arr['data'] = $this->comment_model->get_my_sent_comment_list( $u_id );
		$arr['message'] = '[success]';
		$arr['code'] = 10010;
		exit( json_encode( $arr ) );
		
	}
}

?>
