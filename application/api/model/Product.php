<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/25
 * Time: 10:52
 */

namespace app\api\model;


use think\Model;

class Product extends BaseModel
{
    //获取器：获取mian_img_url字段的值
    public function getMainImgUrlAttr($value,$data)
    {
       return $this->prefixImgUrl($value,$data);
    }
}