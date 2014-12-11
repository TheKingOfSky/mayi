<?php
//@@ClassName:login_api
//@@Description:APP用户登录接口
//@@Type:API-Controller
//@@Anthor:titan
//@@Time:
class login_api extends MY_Controller
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

		//检查用户名是否符合规则

		//检查密码是否符合规则

		//用$this->_check_login检测登陆的用户名、密码是否匹配

		//返回是否登录成功，如果登录成功返回用户数据
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

		//验证用户名和密码是否匹配

		//如果匹配失败返回false,如果匹配成功返回用户信息
	}
}


?>
