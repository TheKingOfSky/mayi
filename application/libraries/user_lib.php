<?php
class user_lib
{
	private $_ci;
	public function __construct()
	{
		$this->_ci = & get_instance();
		$this->_ci->load->model( 'user_model' );
	}
	
	public function user_isset( $username )
	{
		if( is_phone( $username ) )
		{
			if( $this->_ci->user_model->mobile_isset( $username ) )
			{
				return TRUE;	
			}
			else
			{
				return FALSE;
			}
		}

		if( is_email( $username ) )
		{
			if( $this->_ci->user_model->email_isset( $username ) )
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
	}
}
?>
