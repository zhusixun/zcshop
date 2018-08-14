<?php

	/**
	 * 商品分类验证器
	 */
	
	//声明命名空间
	namespace app\admin\validate;

	use think\Validate;

	class Goodsclass extends Validate
	{
		protected $rule = [
			'gc_name' => 'require|unique:goodsclass',
		];

		protected $message = [
			'gc_name.require' => '商品分类不能为空:(',
			'gc_name.unique'  => '商品分类不能重复:(',
		];

		protected $scene = [
			'edit' => ['gc_name'=>'require'],
		];
	}