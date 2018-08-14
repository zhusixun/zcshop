<?php

	/**
	 * 会员控制器
	 */
	
	//声明命名空间
	namespace app\admin\controller;

	use think\Controller;

	class Member extends Controller
	{
		//显示会员列表
		public function index()
		{
			$info = db('member')->select();
			$this->assign([
				'info' => $info,
			]);
			return $this->fetch();
		}
	}