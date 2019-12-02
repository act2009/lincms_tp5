<?php
/**
 * Created by PhpStorm.
 * User: act2009
 * Date: 2019/12/2
 * Time: 10:23
 */


namespace app\api\model;


class Order extends BaseModel
{
    public $autoWriteTimestamp=true;
    protected $hidden=['delete_time'];
    // 告诉模型这个字段是json格式的数据
    protected $json=['snap_address', 'snap_items'];
    // 设置json数据返回时以数组格式返回
    protected $jsonAssoc=true;

    public static function getOrdersPaginate($params)
    {
        //new 一个查询条件空数组
//        $query=[];
        // 需要判断是否存在的参数名。
        $field = ['order_no', ['name', 'snap_address->name']];
        // 把需要判断的参数名数组和当前请求获取到的参数数组传递进去，返回构造好的数组查询条件
        $query = self::equalQuery($field, $params);
        //查询条件字段
        $query[] = ['create_time', 'between time', [$params['start'], $params['end']]];
        //判断是否传递了订单号查询条件
//        if(array_key_exists('name',$params)){
//            $query[]=['snap_address->name','=',$params['name']];
//        }
        // 判断是否传递按收货人姓名的查询条件
//        if (array_key_exists('name', $params)) {
//            $query[] = ['snap_address->name', '=', $params['name']];
//        }

        // paginate()方法用于根据url中的参数，计算查询要查询的开始位置和查询数量
        list($start,$count)=paginate();
        // 应用条件查询
        $orderList=self::where($query);
        // 调用模型的实例方法count计算该条件下会有多少条记录
        $totalNums=$orderList->count();
        // 调用模型的limit方法对记录进行分页并获取查询结果
        $orderList=$orderList->limit($start,$count)->order('create_time desc')->select();
        // 组装返回结果
        $result=[
            'collection'=>$orderList,
            'total_nums'=>$totalNums,
        ];

        return $result;
    }

}