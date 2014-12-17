<?php
//@@ClassName:user_api
//@@Description:APP用户注册接口
//@@Type:API-Controller
//@@Anthor:titan
//@@Time:
class user_api extends App_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model( 'user_model' );
	}

	//@@FuncName:user_info
	//@@Description:用户详情
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function user_info()
	{
		//POST接收用户ID
		$u_id = $this->input->get_post( 'u_id', TRUE );
		
		//Model获取数据
		$user = $this->user_model->get_user_base( $u_id );
		if( ! $user )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 用户不存在';
			exit( json_encode( $arr ) );
		}
		else
		{
			$data['base'] = $user;
		}

		$profile = $this->user_model->get_user_profile( $u_id );
		$( $profile )
		{
			$data['profile'] = $profile;
		}
		else
		{
			$data['profile'] = false;
		}

		//return数据
		$arr['code'] = 10010;
		$arr['message'] = '[success]';
		$arr['data'] = $data;
		exit( json_encode( $arr ) );
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
