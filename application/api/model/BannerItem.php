<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/23
 * Time: 17:31
 */

namespace app\api\model;


use think\Model;
use think\model\concern\SoftDelete;

class BannerItem extends BaseModel
{
    use SoftDelete;
    protected $hidden=['delete_time','from'];
    //关联Image表
    public function img(){
        return $this->belongsTo('Image','img_id','id');
    }
}