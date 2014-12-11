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
		$login = $this->input->get->post( 'login', TRUE );
		if( empty( $login ) ) exit( json_encode( array( 'code'=>20010, 'message'=>'[error] 手机或邮箱不能为空' ) ) );

		//查看输入的是手机号码还是邮箱
		if( is_numeric( $login ) ) $mobile=$login;
		else $email=$login;

		if( ! empty( $mobile ) )
		{
			if( ! is_mobile( $mobile ) )
			{
				exit( json_encode( array( 'code'=>20010, 'message'=>'[error] 手机号码格式不正确' ) ) );
			}
		}

		if( ! empty( $email ) )
		{
			if( ! is_email( $email ) )
			{
				exit( json_encode( array( 'code'=>20010, 'message'=>'[error] 邮箱格式不正确' ) ) );
			}
		}

		//按规则检查手机号码或邮箱

		//按规则检查密码

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
