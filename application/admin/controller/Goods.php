<?php
	
	/**
	 * 商品控制器
	 */
	
	//声明命名空间
	namespace app\admin\controller;

	use think\Controller;
	use lib\Uploads;

	class Goods extends Controller
	{
		//显示商品列表
		public function index()
		{
			$join = [
				['goodsclass c','g.gc_id=c.gc_id','LEFT'],
				['brand b','g.brand_id=b.brand_id','LEFT'],
			];

			$info = db('goods')->alias('g')->field('g.*,c.gc_name,b.brand_name')->join($join)->where(['is_del'=>1,'is_out'=>1,'is_check'=>1])->order('g.goods_id ASC')->paginate(5);
			//dump($info);exit;
			$this->assign([
				'info' => $info,
			]);

			return $this->fetch();
		}

		//添加商品
		public function add()
		{
			if(request()->isGet()){
				//获取所有分类信息和品牌信息
				$arrs = db('goodsclass')->select();
				$tree = model('Goodsclass')->get_tree($arrs);
				$brand = db('brand')->select();

				//获取所有类型信息以及相关属性信息
				$type = db('type')->select();

				//获取到所有相册信息
				$img = db('image')->field('img_id,img_name')->select();

				//渲染页面
				$this->assign([
					'tree'  => $tree,
					'brand' => $brand,
					'type'  => $type,
					'img'   => $img,
				]);
				return $this->fetch();
			}

			//接收数据
			$data = input('post.');
			//dump($data);
			//dump($_FILES['img_photo']);exit;
			
			//判断货号是否为空,为空赋予唯一字符串
			if(empty($data['goods_number'])){
				$data['goods_number'] = md5(uniqid());
			}

			$validate = validate('Goods');
			if(!$validate->check($data)){
				$this->error($validate->getError());
			}

			//判断是否上传图片
			if($_FILES['img_photo']['size']>0){
				$name= 'img_photo';
				$filePath = 'goods';
				$image = new Uploads;
				$img = $image->uploadFiles($name,$filePath);
				//dump($img);exit;
				$data['img_photo'] = $img['img'];
				$data['img_thumb'] = $img['thumb_img'];
			}

			$result = model('Goods')->add_goods($data);
			if($result !== false){
				$this->success('添加商品成功:)','goods/index');
			}else{
				$this->error(model('Goods')->getError());
			}
		}

		//根据ajax请求提交的参数输出html代码
		public function showAttr()
		{	
			$type_id = input('type_id',0,'intval');
			
			//查询到类型ID对应的属性ID以及属性值
			$data = db('type_attr')->alias('t')->field('a.*')->join('attribute a','t.attr_id=a.attr_id','LEFT')->where(['type_id'=>$type_id])->select();

			//调取模型获取属性
			$info = model('Goods')->getTypeAttr($data);
			//return dump($info);
			$this->assign([
				'info' => $info,
			]);
			return $this->fetch('goods/showAttr');
		}

		//删除商品(进入回收站)
		public function del()
		{
			$id = input('id');
			$result = db('goods')->where(['goods_id'=>$id])->setField(['is_del'=>0]);
			if($result){
				$this->success('删除商品成功:)');
			}else{
				$this->error('删除商品失败:(');
			}
		}

		//下架商品
		public function out_goods()
		{
			$id = input('id');
			$result = db('goods')->where(['goods_id'=>$id])->setField(['is_out'=>0]);
			if($result){
				$this->success('下架商品成功:)');
			}else{
				$this->error('下架商品失败:(');
			}
		}

		//编辑商品信息
		/*public function edit()
		{
			if(request()->isGet()){
				$id = input('id');
				$info = 
			}
		}*/

		//显示下架商品页面
		public function out()
		{
			$join = [
				['goodsclass c','g.gc_id=c.gc_id','LEFT'],
				['brand b','g.brand_id=b.brand_id','LEFT'],
			];

			$info = db('goods')->alias('g')->field('g.*,c.gc_name,b.brand_name')->join($join)->where(['is_del'=>1,'is_check'=>1,'is_out'=>0])->order('g.goods_id ASC')->paginate(5);
			//dump($info);exit;
			$this->assign([
				'info' => $info,
			]);

			return $this->fetch();
		}

		//编辑下架状态
		public function out_edit()
		{
			if(request()->isGet()){
				$id = input('id');
				$info = db('goods')->field('goods_name,is_out')->where(['goods_id'=>$id])->find();
				$this->assign([
					'info' => $info,
				]);
				return $this->fetch();
			}

			$data = input('post.');
			$result = db('goods')->where(['goods_name'=>$data['goods_name']])->setField(['is_out'=>$data['is_out']]);
			if($result){
				$this->success('更改状态成功:)','goods/out');
			}else{
				$this->error('更改状态失败:(');
			}
		}

		//显示审核页面
		public function check()
		{
			$join = [
				['goodsclass c','g.gc_id=c.gc_id','LEFT'],
				['brand b','g.brand_id=b.brand_id','LEFT'],
			];

			$info = db('goods')->alias('g')->field('g.*,c.gc_name,b.brand_name')->join($join)->where(['is_del'=>1,'is_out'=>1])->where('is_check','in',[0,2])->order('g.goods_id ASC')->paginate(5);
			//dump($info);exit;
			$this->assign([
				'info' => $info,
			]);

			return $this->fetch();
		}

		//编辑审核状态
		public function check_edit()
		{
			if(request()->isGet()){
				$id = input('id');
				$info = db('goods')->field('goods_name,is_check')->where(['goods_id'=>$id])->find();
				$this->assign([
					'info' => $info,
				]);
				return $this->fetch();
			}

			$data = input('post.');
			$result = db('goods')->where(['goods_name'=>$data['goods_name']])->setField(['is_check'=>$data['is_check']]);
			if($result){
				$this->success('更改状态成功:)','goods/check');
			}else{
				$this->error('更改状态失败:(');
			}
		}
		
		//显示回收站
		public function recycle()
		{
			$join = [
				['goodsclass c','g.gc_id=c.gc_id','LEFT'],
				['brand b','g.brand_id=b.brand_id','LEFT'],
			];

			$info = db('goods')->alias('g')->field('g.*,c.gc_name,b.brand_name')->join($join)->where(['is_del'=>0,'is_check'=>1])->order('g.goods_id ASC')->paginate(5);
			//dump($info);exit;
			$this->assign([
				'info' => $info,
			]);

			return $this->fetch();
		}

		//彻底删除商品信息
		public function recycle_del()
		{
			$id = input('id');
			$result = db('goods')->where(['goods_id'=>$id])->delete();
			if($result){
				$this->success('彻底删除商品信息成功:)');
			}else{
				$this->error('彻底删除商品信息失败:(');
			}
		}

		//从回收站里恢复商品
		public function recover()
		{
			$id = input('id');
			$result = db('goods')->where(['goods_id'=>$id])->setField(['is_del'=>1]);
			if($result){
				$this->success('恢复商品成功:)');
			}else{
				$this->error('恢复商品失败:(');
			}
		}
	}