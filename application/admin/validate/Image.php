<?php

	/**
	 * 相册验证器
	 */
	
	//声明命名空间
	namespace app\admin\validate;

	use think\Validate;

	class Image extends Validate
	{
		protected $rule = [
			'img_name' => 'require|unique:image',
		];

		protected $message = [
			'img_name.require' => '相册名称不能为空:(',
			'img_name.unique'  => '相册名称不能重复:(',
		];

		protected $scene = [
			'edit' => ['img_name.require'],
		];
	}