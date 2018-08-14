<?php

	/**
	 * 积分管理控制器
	 */
	
	//声明命名空间
	namespace app\admin\controller;

	use think\Controller;

	class Points extends Controller
	{
		//显示积分管理
		public function index()
		{
			$info = db('pointslog')->paginate(20);
			$this->assign([
				'info' => $info,
			]);
			return $this->fetch();
		}

		//设置积分规则明细
		public function check()
		{
			if(request()->isGet()){
				//查询带所有会员的会员ID和会员名
				$member = db('member')->field('member_id,member_name')->select();
				$this->assign([
					'member' => $member,
				]);
				return $this->fetch();
			}

			//接收数据
			$data = input('post.');
			// dump($data);exit;

			//获取对应ID的会员名
			$member_name = db('member')->field('member_name')->where(['member_id'=>$data['pl_member_id']])->find();
			//dump($member_name);exit;
			$data['pl_member_name'] = $member_name['member_name'];

			//获取操作的管理员的ID和名称

			$result = db('pointslog')->insert($data);
			if($result){
				$this->success('积分调整成功:)','points/index');
			}else{
				$this->error('积分调整失败:(');
			}
		}
	}