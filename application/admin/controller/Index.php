<?php

	/**
	 * 后台首页控制器
	 */
	
	// 声明命名空间
	namespace app\admin\controller;

	use think\Controller;

	class Index extends Controller
	{
		public function index()
		{
			return $this->fetch();
		}

		public function top()
		{
			return $this->fetch();
		}

		public function main()
		{
			return $this->fetch();
		}

		public function menu()
		{
			return $this->fetch();
		}
	}