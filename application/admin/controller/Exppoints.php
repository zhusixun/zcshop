<?php

	/**
	 * 经验值管理控制器
	 */
	
	//声明命名空间
	namespace app\admin\controller;

	use think\Controller;

	class Exppoints extends Controller
	{
		//经验值管理页面
		public function index()
		{
			$info = db('exppointslog')->alias('e')->field('e.*,r.explog_stage,add_exppoints,explog_desc')->join('exppoints_rule r','e.ex_rule_id=r.id','LEFT')->paginate(20);
			$this->assign([
				'info' => $info,
			]);
			return $this->fetch();
		}

		//经验值增减规则明细并修改规则
		public function rule()
		{
			if(request()->isGet()){
				$info = db('exppoints_rule')->field('explog_stage,add_exppoints')->select();
				//dump($info);exit;
				$this->assign([
					'info' => $info,
				]);
				return $this->fetch();
			}

			//接收数据
			$data = input('post.');
			//dump($data);
			$arr = [];
			foreach ($data as $key => $value) {
				$array = array(
					'explog_stage' => $key,
					'add_exppoints' => $value,
				);
				$arr[] = $array;
			}
			//查询数据表所有数据,并转换格式
			$info = db('exppoints_rule')->field('explog_stage,add_exppoints')->select();

			$result = model('Exppoints')->ex_update($info,$arr);
			if($result === false){
				$this->error(model('Exppoints')->getError());
			}else{
				$this->success('修改成功:)');
			}
		}

		//显示设置会员级别
		public function grade()
		{
			if(request()->isGet()){
				$info = db('member_grade')->field('grade_name,grade_points')->select();
				//dump($info);exit;
				$this->assign([
					'info' => $info,
				]);
				return $this->fetch();
			}

			//接收数据
			$data = input('post.');
			//dump($data);
			$arr = [];
			foreach ($data as $key => $value) {
				$array = array(
					'grade_name'   => $key,
					'grade_points' => $value,
				);
				$arr[] = $array;
			}
			//查询数据表所有数据,并转换格式
			$info = db('member_grade')->field('grade_name,grade_points')->select();

			$result = model('Exppoints')->grade_update($info,$arr);
			if($result === false){
				$this->error(model('Exppoints')->getError());
			}else{
				$this->success('修改成功:)');
			}
		}
	}