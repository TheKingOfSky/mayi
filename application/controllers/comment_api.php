<?php
//@@ClassName:comment_api
//@@Description:APP用户注册接口
//@@Type:API-Controller
//@@Anthor:titan
//@@Time:
class comment_api extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	//@@FuncName:news_comment_list
	//@@Description:新闻评论列表
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function news_comment_list()
	{
		//POST接收新闻ID
		//
		//Model层获取数据
		//
		//return数据
	}

	//@@FuncName:
	//@@Description:
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

	//@@FuncName:
	//@@Description:
	//@@Open:public
	//@@Parameters:
	//@@Anthor:titan
	//@@Time:
	public function send_comment()
	{
		//POST接收新闻ID和评论内容
		//
		//检查评论内容是否为空
		//
		//评论内容不为空,执行内容过滤
		//
		//检测@,有@的话插入@表
		//
		//获取用户ID
		//
		//Model层插入数据,并获得执行结果
		//
		//Model层插入动态
		//
		//return执行结果
	}
}

?>
