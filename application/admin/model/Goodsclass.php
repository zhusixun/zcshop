<?php

	/**
	 * 商品分类模型
	 */
	
	//声明命名空间
	namespace app\admin\model;

	use think\Model;

	class Goodsclass extends Model
	{
		//获取商品分类及其子分类信息
		public function get_tree($items,$pid=0,$lev=0)
		{
		    static $tree = array();
		    foreach($items as $k => $v)
		    {
		        if($v['gc_parent_id'] == $pid){
		        	$v['lev'] = $lev;
		        	$tree[] = $v;
		        	$this->get_tree($items,$v['gc_id'],$lev+1);
		        }
		  	}
		    return $tree;
		}


		 //获取子栏目id
        public function childrenids($id)
        {
            $data=db('goodsclass')->field('gc_id,gc_parent_id')->select();
            return $this->_childrenids($data,$id);
        }

        private function _childrenids($data,$id)
        {
            static $arr=array();
            foreach ($data as $k => $v) {
                if($v['gc_parent_id']==$id){
                    $arr[]=$v['gc_id'];
                    $this->_childrenids($data,$v['gc_id']);
                }
            }
            return $arr;
        }
	}