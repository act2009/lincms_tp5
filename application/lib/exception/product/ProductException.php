<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/22
 * Time: 15:43
 */

namespace app\lib\exception\product;


use LinCmsTp5\exception\BaseException;

class ProductException extends BaseException
{
    public $code=404;
    public $msg='商品不存在';
    public $error_code='70002';

}