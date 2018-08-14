<?php
	
	/**
	 * 商品属性控制器
	 */
	
	//声明命名空间
	namespace app\admin\controller;

	use think\Controller;

	class Attribute extends Controller
	{
	   //显示商品属性列表
	   public function index()
	   {
	   		$info = db('attribute')->select();
	   		$this->assign([
	   			'info' => $info,
	   		]);
	   		return $this->fetch();
	   }

	   //添加商品属性
	   public function add()
	   {
		   	if(request()->isPost()){
		   		$data = input('post.');

		   		$validate = validate('Attribute');
		   		if(!$validate->check($data)){
		   			$this->error($validate->getError());
		   		}

		   		$result = db('attribute')->insert($data);
		   		if($result){
		   			$this->success('添加属性成功:)','attribute/index');
		   		}else{
		   			$this->error('添加属性失败:(');
		   		}
		   	}
		   	return $this->fetch();
	   }

	   //删除商品属性
	   public function del()
	   {
	   		$id = input('id');
	   		$result = db('attribute')->where(['attr_id'=>$id])->delete();
	   		if($result){
	   			$this->success('删除属性成功:)');
	   		}else{
	   			$this->error('删除属性失败:(');
	   		}
	   }

	   //修改商品属性
	   public function edit()
	   {
	   		if(request()->isGet()){
	   			$id = input('id');
	   			$info = db('attribute')->where(['attr_id'=>$id])->find();

	   			$this->assign([
	   				'info' => $info,
	   			]);
	   			return $this->fetch();
	   		}

	   		$data = input('post.');
	   		$id = input('id');

	   		$validate = validate('Attribute');
	   		if(!$validate->scene('edit')->check($data)){
	   			$this->error($validate->getError());
	   		}

	   		$result = db('attribute')->where(['attr_id'=>$id])->update($data);
	   		if($result){
	   			$this->success('修改属性成功:)','attribute/index');
	   		}else{
	   			$this->error('修改属性失败:(');
	   		}
	   }

	   public function attr()
	   {
	   		if(request()->isGet()){
	   			return $this->fetch('attribute/add');
	   		}

	   		$data = input('post.');

	   		$validate = validate('Attribute');
	   		if(!$validate->check($data)){
	   			$this->error($validate->getError());
	   		}

	   		$result = db('attribute')->insert($data);
	   		if($result){
	   			$this->success('添加属性成功:)','type/add');
	   		}else{
	   			$this->error('添加属性失败:(');
	   		}
	   }
	}