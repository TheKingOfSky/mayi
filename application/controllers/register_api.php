<?php
//@@ClassName:register_api
//@@Description:APP用户注册接口
//@@Type:API-Controller
//@@Anthor:titan
//@@Time:
class register_api extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	//@@FuncName:register
	//@@Description:注册数据
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function register()
	{
		//POST接收数据并给变量赋值
		$username = $this->input->get_post( 'username', TRUE );
		$password = $this->input->get_post( 'password', TRUE );

		//查检用户名是否是否的
		if( empty( $username ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 登录账号不能为空';
			exit( json_encode( $arr ) );
		}

		//检查用户名长度
		if( strlen( $username ) < 6 )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 登录账号过短';
			exit( json_encode( $arr ) );
		}

		//检查用户名是否存在
		if( $this->user_lib->username_isset( $username ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 用户已存在';
			exit( json_encode( $arr ) );
		}

		//查看输入的是手机号码还是邮箱
		if( ! is_phone( $username ) && ! is_email( $username ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 手机或邮箱格式不正确';
			exit( json_encode( $arr ) );
		}

		//按规则检查密码
		if( ! is_password( $password ) )

		//检查两次密码输入是否一致

		//将插入数据库，执行$this->_insert_user_data();返回是否成功
		
		//返回数据
	}

	//@@FancName:_insert_user_data
	//@@Description:数据入库
	//@@Open:private
	//@@Parameters:{"$arr":{"Type":"Array","IS_Null":"no","Description":"需要插入的数据"}}
	//@@Anthor:titan
	//@@Time:
	private function _insert_user_data( $arr )
	{
		//执行Model入库

		//返回是否成功
	}
}
?>
