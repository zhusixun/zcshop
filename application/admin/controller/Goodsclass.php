<?php
	
	/**
	 * 商品分类控制器
	 */
	
	//声明命名空间
	namespace app\admin\controller;

	use think\Controller;

	class Goodsclass extends Controller
	{
		//显示商品分类列表
		public function index(){
			//获取到所有分类及其子分类信息
			$arrs = db('goodsclass')->select();
			$tree = model('Goodsclass')->get_tree($arrs);
			$this->assign([
				'tree' => $tree,
			]);
			return $this->fetch();
		}

		//添加商品分类
		public function add()
		{
			if(request()->isGet()){
				//获取到所有分类及其子分类信息
				$arrs = db('goodsclass')->select();
				$tree = model('Goodsclass')->get_tree($arrs);
				$this->assign([
					'tree' => $tree,
				]);
				return $this->fetch();
			}

			$data = input('post.');

			$validate = validate('Goodsclass');
			if(!$validate->check($data)){
				$this->error($validate->getError());
			}

			$result = db('goodsclass')->insert($data);
			if($result){
				$this->success('添加商品分类成功:)','goodsclass/index');
			}else{
				$this->error('添加商品分类失败:(');
			}
		}

		//删除商品分类
		public function del()
		{
			$id = input('id');
			$sonId = model('Goodsclass')->childrenids($id);
			$sonId[] = (int)$id;
			$result = db('goodsclass')->delete($sonId);
	        if($result){
                $this->success('删除商品分类成功:)');
            }else{
                $this->error('删除商品分类失败:(');
            }
		}

		//修改商品分类
		public function edit()
		{
			if(request()->isGet()){
				$id = input('id');
				$info = db('goodsclass')->where(['gc_id'=>$id])->find();
				$arrs = db('goodsclass')->select();
				$tree = model('Goodsclass')->get_tree($arrs);
				$this->assign([
					'info' => $info,
					'tree' => $tree,
				]);
				return $this->fetch();
			}

			$data = input('post.');
			$id = input('id');
			//dump($id);exit;

			$validate = validate('Goodsclass');
			if(!$validate->scene('edit')->check($data)){
				$this->error($validate->getError());
			}
			//dump($data);die;
			//父ID不能为自身
			if($data['gc_parent_id'] == $id){
				$this->error('上级分类设置错误:(');
			}

			//父ID为自己的子类的子分类
			$sonId = model('Goodsclass')->childrenids($id);
			//dump($sonId);exit;
			if(in_array($data['gc_parent_id'],$sonId,true)){
				//echo 1;die;
				$this->error('上级分类设置错误:(');
			}
			//dump($id);
			//dump($data);die;
			$result = db('goodsclass')->where(['gc_id'=>$id])->update($data);
			if($result){
                $this->success('修改商品分类成功:)','goodsclass/index');
            }else{
                $this->error('修改商品分类失败:(');
            }
		}
	}