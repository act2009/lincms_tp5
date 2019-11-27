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
    public $autoWriteTimestamp=true;
    protected $hidden= ['delete_time', 'create_time', 'update_time', 'from'];

    //获取器：获取mian_img_url字段的值
    public function getMainImgUrlAttr($value,$data)
    {
       return $this->prefixImgUrl($value,$data);
    }

    //
    public static function getProductsPaginate($params)
    {
        $product=[];
        // 判断是否传递了product_name参数，如果有，构造一个查询条件，按商品名称模糊查询
        if(array_key_exists('product_name',$params)){
            $product[]=['name', 'like', "%".$params['product_name']."%"];
        }

        // paginate()方法用于根据url中count和page的参数，计算查询要查询的开始位置和查询数量
        list($start,$count)=paginate();
        // 拿到应用查询条件后的模型实例
        $productList=self::where($product);

        // 调用模型的实例方法count计算该条件下会有多少条记录
        $totalNums=$productList->count();
        // 调用模型的limit方法对记录进行分页并获取查询结果
        $productList=$productList->limit($start,$count)->with('category,image.img,property')
            ->order('create_time desc')->select();
        // 组装返回结果，这里与lin-cms风格保持一致
        $result=[
            // 查询结果
            'collection' =>$productList,
            // 总记录数
            'total_nums' =>$totalNums
        ];
        return $result;

    }

    //关联模型
    public function category()
    {
        return $this->belongsTo('Category','category_id');
    }

    public function image()
    {
        // 一对多
        // product_image表中有order字段用于图片显示排序
        return $this->hasMany('ProductImage')->order('order');
    }

    public function property()
    {
        return $this->hasMany('ProductProperty','product_id');
    }
}