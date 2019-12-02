<?php
/**
 * Created by PhpStorm.
 * User: act2009
 * Date: 2019/12/2
 * Time: 10:26
 */


namespace app\lib\exception\order;


use LinCmsTp5\exception\BaseException;

class OrderException extends BaseException
{
    public $code=404;
    public $msg='订单不存在';
    public $error_code='70002';

}