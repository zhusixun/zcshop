<?php

	/**
	 * 商品相册模型
	 */
	
	//声明命名空间
	namespace app\admin\model;

	use think\Model;

	class Image extends Model
	{
		public function img_thumb($info)
		{
			$list = [];
			$info['img_thumb'] = explode(',',$info['img_thumb']);
			$list[] = $info;
			//dump($list);exit;
			return $list;
		}

		public function img_update($img,$info)
		{
			//return $list;
			$data = $this->img_thumb($img);
			//return $data;
			$arr = $data[0]['img_thumb'];
			//return $arr;
			
			$images = explode(',',$info);
			//return $images;

			foreach ($images as $key => $value) {
				if(in_array($value,$arr)){
					$arr = array_diff($arr,[$value]);
					//return $arr;
				}
			}
			return $arr;
		}
	}