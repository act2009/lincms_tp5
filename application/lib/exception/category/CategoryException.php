<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/20
 * Time: 11:19
 */

namespace app\lib\exception\category;


use LinCmsTp5\exception\BaseException;
use think\Exception;

class CategoryException extends BaseException
{
    public $code = 400;
    public $msg  = '商品分类接口异常';
    public $error_code = '70000';
}
