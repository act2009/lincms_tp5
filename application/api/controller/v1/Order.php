<?php
/**
 * Created by PhpStorm.
 * User: act2009
 * Date: 2019/12/2
 * Time: 10:21
 */


namespace app\api\controller\v1;


use app\lib\exception\order\OrderException;
use think\facade\Request;
use app\api\model\Order as OrderModel;

class Order
{

    public function getOrders()
    {
        $params=Request::get();
        $order=OrderModel::getOrdersPaginate($params);
        if($order['total_nums']===0){
            throw  new OrderException([
                'code'=>404,
                'msg'=>'未查询到相关订单',
                'error_code'=>70007,
            ]);
        }
        return $order;
    }


}