<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/20
 * Time: 10:51
 */

namespace app\api\model;


use think\model\concern\SoftDelete;

class Category extends BaseModel
{
    use SoftDelete;

    protected $hidden=['delete_time','update_time','create_time','topic_img_id'];

    public function img()
    {
        return $this->belongsTo('Image','topic_img_id','id');

    }

}