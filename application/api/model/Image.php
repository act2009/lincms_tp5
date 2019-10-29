<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/24
 * Time: 9:50
 */

namespace app\api\model;


use think\Model;

class Image extends BaseModel
{
    protected $hidden=['delete_time','from'];
    //获取器
    public function getUrlAttr($value,$data)
    {
       return $this->prefixImgUrl($value,$data);

    }

}