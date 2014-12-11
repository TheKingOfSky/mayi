<?php
//@@ClassName:news_api
//@@Description:APP获取新闻接口
//@@Type:API-Contrller
//@@Anthor:titan
//@@Time:
class news_api extends App_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('news_model');
	}
	
	//@@FuncName:index_list
	//@@Description:APP首页列表
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function index_list()
	{
		//POST获取页数
		$page = $this->input->get_post('page', TRUE);
		if( empty( $page ) ) $page = 1;
		
		//用Model层获取list
		$this->news_model->set_step( 10 );
		$this->news_model->set_page( $page );
		$arr['data'] = $this->news_model->get_index_list( 'id,title,face' );

		if( $arr['data'] )
		{
			$arr['code'] = 10010;
			$arr['message'] = '[success]';
		}
		else
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 数据为空或数据错误';
		}
		
		exit( json_encode( $arr ) );
		
		//return数据
	}

	//@@FuncName:class_list
	//@@Description:APP分类列表
	//@@Open:public
	//@@Parameter:None
	//@@Anthor:titan
	//@@Time:
	public function class_list()
	{
		//POST接收分类ID

		//用Model层获取list

		//return数据
	}

	//@@FuncName:user_list
	//@@Description:APP小编所发新闻列表
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function user_list()
	{
		//POST接收小编ID

		//Model层获取list

		//return数据
	}

	//@@FuncName:search_list
	//@@Description:APP关键词搜索新闻列表
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function search_list()
	{
		//POST接收关键字

		//Model层获取list

		//return数据
	}

	//@@FuncName:favorite_list
	//@@Description:APP用户收藏新闻列表
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function favorite_list()
	{
		//POST接收用户ID

		//Model层获取list

		//return数据
	}

	//@@FuncName:read_list
	//@@Description:APP用户已读新闻列表
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function read_list()
	{
		//POST接收用户ID
		
		//Model层获取list
		
		//return数据
	}

	//@@FuncName:about_list
	//@@Description:APP相关新闻列表
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function about_list()
	{
		//POST接收该新闻ID

		//算法获取get数据条件

		//Model层获取list
		
		//return数据
	}

	//@@FuncName:mood_list
	//@@Description:APP心情相关新闻列表
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function mood_list()
	{
		//POST接收心情ID

		//Model层获取list
		
		//return数据
	}

	//@@FuncName:news_detail
	//@@Description:APP新闻详情
	//@@Open;public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function news_detail()
	{
		//POST接收新闻ID
		$id = $this->input->get_post( 'id', TRUE );
		if( empty( $id ) ) exit( json_encode( array( 'code'=>20010, 'message'=>'[error] 未接收到新闻ID' ) ) );

		//Model层获取新闻详情
		$arr['data'] = $this->news_model->get_news_detail( $id );

		//return数据
		if( empty( $arr['data'] ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 所取数据不存在';
		}
		else
		{
			$arr['code'] = 10010;
			$arr['message'] = '[success]';
		}

		exit( json_encode( $arr ) );
	}

}
?>