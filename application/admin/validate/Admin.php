<?php

	/**
	 * 管理员验证器
	 */
	
	//声明命名空间
	namespace app\admin\validate;

	use think\Validate;

	class Admin extends Validate
	{
		protected $rule = [
			'admin_name'     => 'require|unique:admin|min:5',
			'admin_password' => 'require|min:6',
		];

		protected $message = [
			'admin_name.require'     => '用户名不能为空:(',
			'admin_name.unique'      => '用户名不能重复:(',
			'admin_name.min'         => '用户名长度至少为5位:(',
			'admin_password.require' => '密码不能为空:(',
			'admin_password.min'     => '密码长度至少为6位:(',
		];

		protected $scene = [
			'edit' => ['admin_name.require,min','admin_password'],
		];
	}