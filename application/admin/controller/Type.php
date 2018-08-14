<?php

	/**
	 * 商品类别控制器
	 */
	
	//声明命名空间
	namespace app\admin\controller;

	use think\Controller;

	class Type extends Controller
	{
		//显示类别列表
		public function index()
		{
			$info = db('type')->select();
			$this->assign([
				'info' => $info,
			]);
			return $this->fetch();
		}

		/**
		 * 添加类型
		 * 1.渲染页面
		 * 2.接收数据
		 * 3.先添加到类型表,后添加到类型与属性中间表
		 */
		public function add()
		{
			if(request()->isGet()){
				$attr = db('attribute')->select();
				$this->assign([
					'attr' => $attr,
				]);
				return $this->fetch();
			}

			// $data = input('post.');
			// dump($data);exit;
			//接收数据
			$type =	array(
				'type_name' => input('post.type_name'),
			);
			//dump($type);exit;
			$attr = input('post.attr_name/a');
			//dump($attr);exit;
			
			//验证器
			$validate = validate('Type');
			if(!$validate->check($type)){
				$this->error($validate->getError());
			}

			//过滤重复的选择
			$attr = array_unique($attr);

			//过滤空选择
			$list = [];
			foreach ($attr as $key => $value) {
				if($value != ''){
					$list[] = $value;
				}
			}
			$attr = $list;

			//添加到类型表
			$result = db('type')->insert($type);
			if($result){
				//查询到对应ID
				$type_id = db('type')->where(['type_name'=>$type['type_name']])->find();
				$id = $type_id['type_id'];
				//dump($id);exit;
				//添加到类型与属性中间表
				$type_attr = model('Type')->add_type_attr($id,$attr);
				$this->success('添加类型成功:)','type/index');
			}else{
				$this->error('添加类型失败:(');
			}

		}

		//删除类型以及相关属性
		public function del()
		{	
			//接收数据
			$id = input('id');
			//先删除type_attr表的数据
			$attr = db('type_attr')->field('id')->where(['type_id'=>$id])->select();
			$type_attr = model('Type')->del_type_attr($attr);
			if($type_attr === false){
				$this->error(model('Type')->getError());
			}

			$result = db('type')->where(['type_id'=>$id])->delete();
			if($result){
				$this->success('删除类型成功:)');
			}else{
				$this->error('删除类型失败:(');
			}
		}

		//修改类型以及相关属性
		public function edit()
		{
			if(request()->isGet()){
				$id = input('id');
				//查询到对应ID的类型数据
				$type = db('type')->where(['type_id'=>$id])->find();
				//dump($type);
				//查询到所有属性
				$attr = db('attribute')->select();
				//dump($attr);
				//查询到对应ID的相关属性
				$info = db('type_attr')->where(['type_id'=>$id])->select();
				//dump($info);exit;
				$this->assign([
					'info' => $info,
					'attr' => $attr,
					'type' => $type,
				]);
				return $this->fetch();
			}
		}
	}