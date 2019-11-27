<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/22
 * Time: 16:30
 */

namespace app\api\model;


use think\model\concern\SoftDelete;

class ProductImage extends BaseModel
{
    use SoftDelete;
    protected $hidden = ['delete_time', 'product_id'];

    //关联模型
    public function img()
    {
       return $this->belongsTo('Image', 'img_id');
    }


}