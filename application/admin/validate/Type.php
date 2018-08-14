<?php

	/**
	 * 类别验证器
	 */
	
	//声明命名空间
	namespace app\admin\validate;

	use think\Validate;

	class Type extends Validate
	{
		protected $rule = [
			'type_name' => 'require|unique:type',
		];

		protected $message = [
			'type_name.require' => '类别名称不能为空:(',
			'type_name.unique'  => '类别名称不能重复:(',
		];

		protected $scene = [
			'edit' => ['type_name.require'],
		];
	}