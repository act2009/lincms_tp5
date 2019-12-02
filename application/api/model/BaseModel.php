<?php
/**
 * Created by PhpStorm.
 * User: 沁塵
 * Date: 2019/2/19
 * Time: 11:22
 */

namespace app\api\model;


use think\Model;

class BaseModel extends Model
{

    // 我们要获取url这个字段,获取默认接收两个参数
    // $value是当前这条记录里url字段的值
    // $data是当前记录的完整数据
    protected function prefixImgUrl($value,$data){
        $finalUrl=$value;
        // 根据表的注释，1来自本地，2来自公网
        if($data['from']==config('setting.from_local')){// 如果来自本地，把本机的存放图片目录的域名地址跟$value拼接
            // 这里我们把本机的存放图片目录的域名地址写到了一个配置文件里。
            // 后续我们可能换了域名或者目录，又或者有其他来源渠道，以配置文件的形式这样以后只需改配置文件而不必改动代码
           $finalUrl=config('setting.img_prefix').$value;
        }
        // 这里如果from不是来自本地，那么存储的会是一个完整的公网访问地址，无需处理
        // 返回处理后的url
        return $finalUrl;

    }

    /**
     * 构造条件为相等的数组查询条件
     * @param $field 要检索的参数名数组
     * @param $params 前端提交过来的所有GET参数数组
     * @return array 构造好后的查询条件
     */
    public static function equalQuery($field, $params)
    {

        $query = [];
        foreach ($field as $value) {
            if (is_array($value)) {
                if (array_key_exists($value[0], $params)) {
                    $query[] = [$value[1], '=', $params[$value[0]]];
                }
            } else {
                if (array_key_exists($value, $params)) {
                    $query[] = [$value, '=', $params[$value]];
                }
            }
        }
        return $query;
    }

    /**
     * @param $startField 开始时间的参数名
     * @param $endField 结束时间的参数名
     * @param $params  前端提交过来的所有GET参数数组
     * @param string $dbField 要查询的表字段名，默认是create_time
     * @return array
     */

    public static function betweenTimeQuery($startField,$endField,$params,$dbField = 'create_time')
    {


    }



}