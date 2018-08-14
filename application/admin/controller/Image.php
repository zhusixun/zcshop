<?php

	/**
	 * 商品相册控制器
	 */
	
	//声明命名空间
	namespace app\admin\controller;

	use think\Controller;
	use lib\Uploads;

	class Image extends Controller
	{
		//显示相册首页
		public function index()
		{
			$info = db('image')->alias('i')->field('i.*,g.goods_name')->join('goods g','i.goods_id=g.goods_id','LEFT')->paginate(10);
			$this->assign([
				'info' => $info,
			]);
			return $this->fetch();
		}

		//添加相册信息
		public function add()
		{
			if(request()->isGet()){
				return $this->fetch();
			}

			//接收数据
			$data = input('post.');

			$validate = validate('Image');
			if(!$validate->check($data)){
				$this->error($validate->getError());
			}

			$name = 'img_logo';
			$filePath = 'images';
			$img = new Uploads;
			$image = $img->uploadFile($name,$filePath);
			$data['img_logo'] = $image['thumb_img'];

			$result = db('image')->insert($data);
			if($result){
				$this->success('添加相册成功:)','image/index');
			}else{
				$this->error('添加相册失败:(');
			}
		}

		//删除相册
		public function del()
		{
			$id = input('id');
			$result = db('image')->where(['img_id'=>$id])->delete();
			if($result){
				$this->success('删除相册成功:)');
			}else{
				$this->error('删除相册失败:(');
			}
		}

		//修改相册信息
		public function edit()
		{
			if(request()->isGet()){
				$id = input('id');
				$info = db('image')->where(['img_id'=>$id])->find();
				$this->assign([
					'info'  => $info,
				]);
				return $this->fetch();
			}

			$data = input('post.');
			//dump($data);exit;
			$id = input('id');

			$validate = validate('Image');
			if(!$validate->scene('edit')->check($data)){
				$this->error($validate->getError());
			}

			//判断是否上传图片
			if($_FILES['img_logo']['size']>0){
				$name = 'img_logo';
				$filePath = 'images';
				$img = new Uploads;
				$image = $img->uploadFile($name,$filePath);
				$data['img_logo'] = $image['thumb_img'];
			}

			$result = db('image')->where(['img_id'=>$id])->update($data);
			if($result){
				$this->success('修改相册成功:)','image/index');
			}else{
				$this->error('修改相册失败:(');
			}
		}

		//查看图片
		public function see(){
			$id = input('id');
			$info = db('image')->field('img_id,img_thumb')->where(['img_id'=>$id])->find();
			//dump($info);exit;

			$list = model('Image')->img_thumb($info);
			//dump($list);exit;
			$this->assign([
				'list' => $list,
			]);
			return $this->fetch();
		}

		//删除图片
		public function remove()
		{
			$id = input('id');
			$info = input('img_thumb');
			/*echo $id;
			echo $info;*/
			$img = db('image')->field('img_thumb')->where(['img_id'=>$id])->find();
			$data = model('Image')->img_update($img,$info);
			//dump($data);
			$data = implode(',',$data);
			//dump($data);

			//更新img_thumb字段值
			$result = db('image')->where(['img_id'=>$id])->setField(['img_thumb'=>$data]);
			if($result){
				$this->success('删除图片成功:)');
			}else{
				$this->error('删除图片失败:(');
			}
		}

		public function image_add()
		{
			if(request()->isGet()){
				return $this->fetch('image/add');
			}

			//接收数据
			$data = input('post.');

			$validate = validate('Image');
			if(!$validate->check($data)){
				$this->error($validate->getError());
			}

			$name = 'img_logo';
			$filePath = 'images';
			$img = new Uploads;
			$image = $img->uploadFile($name,$filePath);
			$data['img_logo'] = $image['thumb_img'];

			$result = db('image')->insert($data);
			if($result){
				$this->success('添加相册成功:)','goods/add');
			}else{
				$this->error('添加相册失败:(');
			}
		}
	}