<?php

	/**
	 * 属性验证器
	 */
	
	//声明命名空间
	namespace app\admin\validate;

	use think\Validate;

	class Attribute extends Validate
	{
		protected $rule = [
			'attr_name'   => 'require|unique:attribute',
			'attr_values' => 'max:255',
		];

		protected $message = [
			'attr_name.require' => '商品属性名称不能为空:(',
			'attr_name.unique'  => '商品属性名称不能重复:(',
			'attr_values.max'   => '商品值不能超过255个字符:(',
		];

		protected $scene = [
			'edit' => ['attr_name.require','attr_values.max'],
		];
	}