<?php

	/**
	 * 管理员控制器
	 */
	
	//声明命名空间
	namespace app\admin\Controller;

	use think\Controller;

	class Admin extends Controller
	{
		//显示管理员列表
		public function index()
		{
			$info = db('admin')->alias('a')->field('a.*,g.gname')->join('gadmin g','a.admin_gid=g.gid','LEFT')->select();
			$this->assign([
				'info' => $info,
			]);
			return $this->fetch();
		}

		//添加管理员信息
		public function add()
		{
			if(request()->isGet()){
				//获取所有权限组名称
				$gname = db('gadmin')->field('gid,gname')->select();
				$this->assign([
					'gname' => $gname,
				]);
				return $this->fetch();
			}

			//dump(input('post.'));exit;
			//接收数据
			$username = input('post.admin_name');
			$password = input('post.admin_password');
			$again_password = input('post.admin_again_password');
			$gid = input('post.gid');

			//判断两次输入的密码是否相同
			if($password !== $again_password){
				$this->error('两次输入的密码不一致:(');
			}

			$data = array(
				'admin_name'     => $username,
				'admin_password' => $password,
				'admin_gid'      => $gid,
			);

			//验证器
			$validate = validate('Admin');
			if(!$validate->check($data)){
				$this->error($validate->getError());
			}

			$data['admin_password'] = md5($data['admin_password']);

			$result = db('admin')->insert($data);
			if($result){
				$this->success('添加管理员信息成功:)','admin/index');
			}else{
				$this->error('添加管理员信息失败:(');
			}
		}

		//删除管理员
		public function del()
		{
			$id = input('id');
			$result = db('admin')->where(['admin_id'=>$id])->delete();
			if($result){
				$this->success('删除管理员成功:)');
			}else{
				$this->error('删除管理员失败:(');
			}
		}

		//修改管理员信息
		public function edit()
		{
			if(request()->isGet()){
				$id = input('id');
				//查询相关ID的管理员信息以及所有权限组
				$info = db('admin')->where(['admin_id'=>$id])->find();
				$gname = db('gadmin')->field('gid,gname')->select();
				$this->assign([
					'info'  => $info,
					'gname' => $gname,
				]);
				return $this->fetch();
			}

			//接收数据
			$username = input('post.admin_name');
			$password = input('post.admin_password');
			$again_password = input('post.admin_again_password');
			$gid = input('post.gid');
			$id = input('id');
			//dump($gid);exit;

			//判断两次输入的密码是否相同
			if(!empty($password)){
				if($password !== $again_password){
					$this->error('两次输入的密码不一致:(');
				}

				$data = array(
					'admin_name'     => $username,
					'admin_password' => $password,
					'admin_gid'      => $gid,
				);

				$validate = validate('Admin');
				if(!$validate->scene('edit')->check($data)){
					$this->error($validate->getError());
				}

				$data['admin_password'] = md5($data['admin_password']);

			}else{
				$data = array(
					'admin_name'     => $username,
					'admin_gid'      => $gid,
				);

				//自定义验证器
				$rule = [
	                ['admin_name', 'require|min:5', '用户名为必填:(|用户名长度至少为5位:('],
	            ];
	            $validate = new \think\Validate($rule);
	            if (!$validate->check($data)) {
	                $this->error($validate->getError());
	            }
			}

			$result = db('admin')->where(['admin_id'=>$id])->update($data);
			if($result){
				$this->success('修改管理员信息成功:)','admin/index');
			}else{
				$this->error('修改管理员信息失败:(');
			}
		}
	}