<?php
	
	/**
	 * 权限组控制器
	 */
	
	//声明命名空间
	namespace app\admin\controller;

	use think\Controller;
	use lib\Limit;

	class Gadmin extends Controller
	{
		//显示权限组列表
		public function index()
		{
			$info = db('gadmin')->select();
			$this->assign([
				'info' => $info,
			]);
			return $this->fetch();
		}
	}