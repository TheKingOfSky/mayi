<?php
//@@ClassName:user_api
//@@Description:APP用户注册接口
//@@Type:API-Controller
//@@Anthor:titan
//@@Time:
class user_api extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	//@@FuncName:user_detail
	//@@Description:用户详情
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function user_detail()
	{
		//POST接收用户ID

		//Model获取数据

		//return数据
	}

	//@@FuncName:message
	//@@Description:留言
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function message()
	{
		//POST接收用户ID

		//POST接收留言内容
		//
		//判断内容是否为空
		//
		//不为空,执行过滤

		//Model获取数据

		//return数据
	}

	//@@FuncName:rewards
	//@@Description:打赏记录
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function rewards()
	{
		//POST接收用户ID
		
		//Model获取数据
		
		//return数据
	}

	//@@FuncName:submit_profile
	//@@Description:提交新闻人审核资料
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function submit_profile()
	{
		//POST接收数据

		//检查姓名
		
		//检查性别
		
		//检查身份证号
		
		//检查邮箱
		
		//检查手机
		
		//检查身份证照片
		
		//检查通过入库

		//return数据
	}

	//@@FuncName:search_list
	//@@Description:APP关键词搜索用户列表
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

	//@@FuncName:modify
	//@@Description:APP用户修改、设置个人信息
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function modify()
	{
		//POST接收数据

		//Model层更新数据

		//return数据
	}
}

?>
