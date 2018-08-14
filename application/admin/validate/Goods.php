<?php

	/**
	 * 商品验证器
	 */
	
	//声明命名空间
	namespace app\admin\validate;

	use think\Validate;

	class Goods extends Validate
	{
		protected $rule = [
			'goods_name'   		=> 'require|unique:goods',
			'goods_number' 		=> 'unique:goods',
			'goods_price'  		=> 'number',
			'goods_marketprice' => 'number',
			'goods_body'   		=> 'require'
		];

		protected $message = [
			'goods_name.require'       => '商品名称不能为空:(',
			'goods_name.unique'        => '商品名称不能重复:(',
			'goods_number.unique' 	   => '商品货号不能重复:(',
			'goods_price.number'  	   => '商品价格必须为数字:(',
			'goods_marketprice.number' => '市场价格必须为数字:(',
			'goods_body.require'       => '商品描述不能为空:(',
		];

		protected $scene = [
			'edit'  => ['brand_name'=>'require','brand_number','goods_price','goods_marketprice','goods_body'],
		];
	}