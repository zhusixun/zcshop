<?php

	/**
	 * 商品品牌控制器
	 */
	
	//声明命名空间
	namespace app\admin\controller;

	use think\Controller;
	use lib\Uploads;

	class Brand extends Controller
	{
		//显示商品品牌列表
		public function index()
		{	
			$id = input('id/d');
			//dump($id);exit;
			if($id != 0){
				$initial = chr($id);
				//dump($initial);exit;
				$info = db('brand')->alias('b')->field('b.*,c.gc_name')->join('goodsclass c','b.gc_id=c.gc_id','LEFT')->where(['brand_initial'=>$initial])->order('brand_sort asc')->paginate(10);
				$this->assign([
					'info' => $info,
				]);
				return $this->fetch();
			}else{
				//获取所有品牌信息
				$info = db('brand')->alias('b')->field('b.*,c.gc_name')->join('goodsclass c','b.gc_id=c.gc_id','LEFT')->order('brand_sort asc')->paginate(10);
				$this->assign([
					'info' => $info,
				]);
				return $this->fetch();
			}
		}

		//添加商品品牌
		public function add()
		{
			if(request()->isGet()){
				//获取到所有的分类
				$arrs = db('goodsclass')->select();
				$tree = model('Goodsclass')->get_tree($arrs);

				$this->assign([
					'tree' => $tree,
				]);
				return $this->fetch();
			}

			$data = input('post.');
			//dump($data);exit;

			$validate = validate('Brand');
			//dump($validate->check($data));exit;
			if(!$validate->check($data)){
				$this->error($validate->getError());
			}

			$name = 'brand_logo';
			$filePath = 'brand';
			$img = new Uploads;
			$image = $img->uploadFile($name,$filePath);
			$data['brand_logo'] = $image['thumb_img'];

			$result = db('brand')->insert($data);
			if($result){
				$this->success('添加品牌成功:)','brand/index');
			}else{
				$this->error('添加品牌失败:(');
			}
		}

		//删除品牌
		public function del()
		{
			$id = input('id');
			$result = db('brand')->where(['brand_id'=>$id])->delete();
			if($result){
				$this->success('删除品牌成功:)');
			}else{
				$this->error('删除品牌失败:(');
			}
		}

		//修改品牌信息
		public function edit()
		{
			if(request()->isGet()){
				$id = input('id');
				//获取到对应ID的品牌信息
				$info = db('brand')->where(['brand_id'=>$id])->find();
				//获取到所有分类信息
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
			//dump($_FILES['brand_logo']);exit;
			//dump($data);exit;

			$validate = validate('Brand');
			if(!$validate->scene('edit')->check($data)){
				$this->error($validate->getError());
			}

			//判断是否上传图片
			if($_FILES['brand_logo']['size']>0){
				$name = 'brand_logo';
				$filePath = 'brand';
				$img = new Uploads;
				$image = $img->uploadFile($name,$filePath);
				$data['brand_logo'] = $image['thumb_img'];
			}

			$result = db('brand')->where(['brand_id'=>$id])->update($data);
			if($result){
				$this->success('修改品牌信息成功:)','brand/index');
			}else{
				$this->error('修改品牌信息失败:(');
			}
		}
	}