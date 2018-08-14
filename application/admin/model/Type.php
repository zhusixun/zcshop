<?php

	/**
	 * 类型控制器
	 */
	
	//声明命名空间
	namespace app\admin\model;

	use think\Model;

	class Type extends Model
	{
		//添加到类型与属性中间表
		public function add_type_attr($id,$attr)
		{	
			$count = count($attr);
			if($count == 1){
				$attr_id = (int)$attr[0];
				$data = array(
					'type_id' => $id,
					'attr_id' => $attr_id,
				);
				//dump($data);exit;
				$row = db('type_attr')->insert($data);

				if(!$row){
					$this->error('选择相关属性有错误:(');
				}
			}else{
				//$array = [];
				foreach ($attr as $k => $v) {
					$attr_id = (int)$v;
					$data = array(
						'type_id' => $id,
						'attr_id' => $attr_id,
					);
					//dump($data);exit;
					$row = db('type_attr')->insert($data);
					if(!$row){
						$this->error('选择相关属性有错误:(');
					}
				}
			}
		}

		//删除对应类型ID的相关属性
		public function del_type_attr($attr)
		{
			$count = count($attr);
			//dump($count);exit;
			if($count == 0){
				return 1;
			}else if($count == 1){
				//dump($attr);exit;
				$type_attr = array_reduce($attr, 'array_merge', array());
				//dump($type_attr);exit;
				$type_attr_id = $type_attr['id'];
				$result = db('type_attr')->where(['id'=>$type_attr_id])->delete();
				if(!$result){
					$this->error = '删除类型失败:(';
					return false;
				}
				return 1;
			}else{
				$type_attr = array_reduce($attr, function ($result, $value) {
				    return array_merge($result, array_values($value));
				}, array());
				//dump($type_attr);exit;
				
				foreach ($type_attr as $k => $v) {
					//dump($v);
					$result = db('type_attr')->where(['id'=>$v])->delete();
					if(!$result){
						$this->error = '删除类型失败:(';
						return false;
					}
				}
				return 1;
			}
		}
	}