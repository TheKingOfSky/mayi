<?php
//@@ClassName:login_api
//@@Description:APP用户登录接口
//@@Type:API-Controller
//@@Anthor:titan
//@@Time:
class login_api extends App_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	//@@FuncName:log_in
	//@@Description:接收登录数据
	//@@Open:public
	//@@Parameters:None
	//@@Anthor:titan
	//@@Time:
	public function log_in()
	{
		//POST接收数据并赋值
		$username = $this->input->get_post( 'username', TRUE );
		$password = $this->input->get_post( 'password', TRUE );

		//检查用户名是否符合规则
		if( empty( $username ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 用户名为空';
			exit( json_encode( $arr ) );
		}

		if( strlen( $username ) < 6 )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 输入账号过短';
			exit( json_encode( $arr ) );
		}

		if( ! is_phone( $username ) && ! is_email( $username ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 您输入的不是一个电话或邮箱';
			exit( json_encode( $arr ) );
		}
		
		//检查用户名否存在
		if( ! $this->user_lib->username_isset( $username ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 用户不存在';
			exit( json_encode( $arr ) );
		}

		//检查密码是否符合规则
		if( empty( $password ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 密码为空';
			exit( json_encode( $arr ) );
		}
		
		if( strlen( $username ) < 6 )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 密码过短';
			exit( json_encode( $arr ) );
		}

		//用$this->_check_login检测登陆的用户名、密码是否匹配
		$user = $this->_check_login( $username, $password );

		//返回是否登录成功，如果登录成功返回用户数据
		if( empty( $user ) )
		{
			$arr['code'] = 20010;
			$arr['message'] = '[error] 密码错误';
			exit( json_encode( $arr ) );
		}

		$arr['code'] = 10010;
		$arr['message'] = '[success]';
		json_encode( json_encode( $arr ) );
	}

	//@@FuncName:_check_login
	//@@Description:验证登录信息
	//@@Open:private
	//@@Parameters:{"$username":{"Type":"string","IS_Null":"no","Description":"登录用户名,可以是电话号码或Email"},"$password":{"Type":"string","IS_Null":"no","Description":"登录密码"}}
	//@@Anthor:titan
	//@@Time:
	private function _check_login( $username, $password )
	{
		//根据用户名取出用户数据
		$user = $this->user_model->get_user();
		//验证用户名和密码是否匹配
		if( $user['password'] == encode_password( $password ) ) return $user;
		//如果匹配失败返回false,如果匹配成功返回用户信息
		return FALSE;
	}
}
?>
