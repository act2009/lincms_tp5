<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/24
 * Time: 13:16
 */

namespace app\api\validate\banner;


use LinCmsTp5\validate\BaseValidate;

class BannerForm extends BaseValidate
{

    protected $rule=[
        'name'=>'require',
        'description'=>'require',
        'items'=>'require|array|min:1',
    ];

    protected $message = [
        'name' => '轮播图名称不能为空',
        'description' => '轮播图描述不能为空',
        'items.require' => '轮播图元素不能为空',
        'items.array' => '轮播图元素的值必须为数组'
    ];

}