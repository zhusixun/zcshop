<?php

	/**
	 * 品牌验证器
	 */
	
	//声明命名空间
	namespace app\admin\validate;

	use think\Validate;

	class Brand extends Validate
	{
		protected $rule = [
			'brand_name'    => 'require|unique:brand',
			'brand_sort'	=> 'number|between:0,255',
			'brand_initial' => 'alpha',
		];

		protected $message = [
			'brand_name.require'  => '品牌名称不能为空:(',
			'brand_name.unique'   => '品牌名称不能重复:(',
			'brand_sort.number'   => '排序必须为数字:(',
			'brand_sort.between'  => '排序在0到255之间:(',
			'brand_initial.alpha' => '品牌首字母必须为字母:('
		];

		protected $scene = [
			'edit'  => ['brand_name'=>'require','brand_sort','brand_initial'],
		];
	}