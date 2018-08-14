<?php
	
	/**
	 * 经验值管理模型
	 */
	
	//声明命名空间
	namespace app\admin\model;

	use think\Model;

	class Exppoints extends Model
	{
		public function ex_update($info,$arr)
		{
			//判断是否修改login的值
			if($arr[0]['add_exppoints'] != $info[0]['add_exppoints']){
				$login = db('exppoints_rule')->where(['explog_stage'=>$arr[0]['explog_stage']])->update($arr[0]);
				if(!$login){
					$this->error = '修改失败:(';
					return false;
				}
			}else if($arr[1]['add_exppoints'] != $info[1]['add_exppoints']){
				$login = db('exppoints_rule')->where(['explog_stage'=>$arr[1]['explog_stage']])->update($arr[1]);
				if(!$login){
					$this->error = '修改失败:(';
					return false;
				}
			}else if($arr[2]['add_exppoints'] != $info[2]['add_exppoints']){
				$login = db('exppoints_rule')->where(['explog_stage'=>$arr[2]['explog_stage']])->update($arr[2]);
				if(!$login){
					$this->error = '修改失败:(';
					return false;
				}
			}else if($arr[3]['add_exppoints'] != $info[3]['add_exppoints']){
				$login = db('exppoints_rule')->where(['explog_stage'=>$arr[3]['explog_stage']])->update($arr[3]);
				if(!$login){
					$this->error = '修改失败:(';
					return false;
				}
			}else{
				$this->error = '请不要玩弄我,谢谢:(';
				return false;
			}
		}

		public function grade_update($info,$arr)
		{
			//判断是否修改login的值
			if($arr[0]['grade_points'] != $info[0]['grade_points']){
				$login = db('member_grade')->where(['grade_name'=>$arr[0]['grade_name']])->update($arr[0]);
				if(!$login){
					$this->error = '修改失败:(';
					return false;
				}
			}else if($arr[1]['grade_points'] != $info[1]['grade_points']){
				$login = db('member_grade')->where(['grade_name'=>$arr[1]['grade_name']])->update($arr[1]);
				if(!$login){
					$this->error = '修改失败:(';
					return false;
				}
			}else if($arr[2]['grade_points'] != $info[2]['grade_points']){
				$login = db('member_grade')->where(['grade_name'=>$arr[2]['grade_name']])->update($arr[2]);
				if(!$login){
					$this->error = '修改失败:(';
					return false;
				}
			}else if($arr[3]['grade_points'] != $info[3]['grade_points']){
				$login = db('member_grade')->where(['grade_name'=>$arr[3]['grade_name']])->update($arr[3]);
				if(!$login){
					$this->error = '修改失败:(';
					return false;
				}
			}else if($arr[4]['grade_points'] != $info[4]['grade_points']){
				$login = db('member_grade')->where(['grade_name'=>$arr[4]['grade_name']])->update($arr[4]);
				if(!$login){
					$this->error = '修改失败:(';
					return false;
				}
			}else if($arr[5]['grade_points'] != $info[5]['grade_points']){
				$login = db('member_grade')->where(['grade_name'=>$arr[5]['grade_name']])->update($arr[5]);
				if(!$login){
					$this->error = '修改失败:(';
					return false;
				}
			}else if($arr[6]['grade_points'] != $info[6]['grade_points']){
				$login = db('member_grade')->where(['grade_name'=>$arr[6]['grade_name']])->update($arr[6]);
				if(!$login){
					$this->error = '修改失败:(';
					return false;
				}
			}else if($arr[7]['grade_points'] != $info[7]['grade_points']){
				$login = db('member_grade')->where(['grade_name'=>$arr[7]['grade_name']])->update($arr[7]);
				if(!$login){
					$this->error = '修改失败:(';
					return false;
				}
			}else if($arr[8]['grade_points'] != $info[8]['grade_points']){
				$login = db('member_grade')->where(['grade_name'=>$arr[8]['grade_name']])->update($arr[8]);
				if(!$login){
					$this->error = '修改失败:(';
					return false;
				}
			}else if($arr[9]['grade_points'] != $info[9]['grade_points']){
				$login = db('member_grade')->where(['grade_name'=>$arr[9]['grade_name']])->update($arr[9]);
				if(!$login){
					$this->error = '修改失败:(';
					return false;
				}
			}else if($arr[10]['grade_points'] != $info[10]['grade_points']){
				$login = db('member_grade')->where(['grade_name'=>$arr[10]['grade_name']])->update($arr[10]);
				if(!$login){
					$this->error = '修改失败:(';
					return false;
				}
			}else{
				$this->error = '请不要玩弄我,谢谢:(';
				return false;
			}
		}
	}