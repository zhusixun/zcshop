<?php

	/**
	 * 商品模型
	 */
	
	//声明命名空间
	namespace app\admin\model;

	use think\Model;
	use lib\Uploads;

	class Goods extends Model
	{
		//根据类型ID获取属性信息
		public function getTypeAttr($data)
		{
			$count = count($data);
			if($count == 0){
				return false;
			}else{
				$list = [];
				foreach ($data as $key => $value) {
					$value['attr_values'] = explode(',',$value['attr_values']);
					$list[] = $value;
				}
				return $list;
			}
		}

		//添加商品
		public function add_goods($data)
		{	
			//dump($data);
			//将接收到的数据一一赋予数组
			$goods = array(
				'goods_name'           => $data['goods_name'],
				'goods_number'         => $data['goods_number'],
				'goods_inventory'      => $data['goods_inventory'],
				'goods_price'          => $data['goods_price'],
				'goods_body'           => $data['goods_body'],
				'goods_marketprice'    => $data['goods_marketprice'],
				'brand_id'             => $data['brand_id'],
				'gc_id' 			   => $data['gc_id'],
				'type_id'              => $data['type_id'],
				'goods_commend'        => $data['goods_commend'],
				'goods_promotion_type' => $data['goods_promotion_type'],
			);

			//添加到goods表
			$result = $this->save($goods);
			//查询出对应goods_id
			$goods_id = db('goods')->where(['goods_name'=>$goods['goods_name']])->find();
			$id = $goods_id['goods_id'];
			//dump($id);
			if(!$result){
				$this->error = '添加商品信息失败:(';
				return false;
			}
			
			//将接收到的数据一一赋予数组
			$attr_values = $data['attr_values'];

			$img_id = $data['img_id'];
			//dump($img_id);
			$image = array(
				'img_photo' => $data['img_photo'],
				'img_thumb' => $data['img_thumb'],
			);

			$goods_attr = $this->add_goods_attr($attr_values,$id);
			if($goods_attr === false){
				$this->error = '添加商品对应属性失败:(';
				return false;
			}

			$goods_image = $this->add_goods_iamge($image,$id,$img_id);
			if($goods_image === false){
				$this->error = '添加商品图片失败:(';
				return false;
			}
		}


		//添加商品对应属性
		protected function add_goods_attr($attr_values,$id)
		{
			//value值合并
			$list = [];
			foreach ($attr_values as $k => $v) {
				$v = implode(',',$v);
				$list[$k] = $v;
			}
			//dump($list);

			$data = [];
			foreach ($list as $key => $value) {
				$data[] = array(
					'goods_id' => $id,
					'attr_id' => $key,
					'attr_values' => $value,
				);
			}
			//dump($data);exit;
			
			//批量增加
			$result = db('goods_attr')->insertAll($data);
			if(!$result){
				return false;
			}
		}

		//添加商品相关图片
		protected function add_goods_iamge($image,$id,$img_id)
		{	
			//dump($id);
			$data = [];
			foreach ($image as $key => $value) {
				$value = implode(',',$value);
				$data[] = $value;
			}
			
			$info = array(
				'goods_id'  => $id,
				'img_photo' => $data[0],
				'img_thumb' => $data[1],
			);
			//dump($info);

			$result = db('image')->where(['img_id'=>$img_id])->update($info);
			//$a = db('image')->getLastSql();
			//dump($a);exit;
			if(!$result){
				return false;
			}
		}
	}
