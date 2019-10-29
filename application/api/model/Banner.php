<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/23
 * Time: 17:31
 */

namespace app\api\model;


use app\lib\exception\banner\BannerException;
use think\Db;
use think\Model;
use think\model\concern\SoftDelete;

class Banner extends BaseModel
{
    use SoftDelete;
    protected $hidden=['delete_time','from'];

    //关联banner_item表
    public function items()
    {
       return $this->hasMany('BannerItem','banner_id','id');
    }

    public static function add($params)
    {
        //启动事务
        Db::startTrans();
        try {
            $banner = self::create($params, true);//新增数据，第二次参数为true表示

            $banner->items()->saveAll($params['items']);//调用关联模型，实现关联写入；saveAll()方法用于批量新增数据
            Db::commit();
        } catch (\Exception $e) {
            Db::rollback();
            throw new BannerException([
                'msg'=>'新增轮播图异常',
                'error_code'=>70001,
            ]);
        }

    }


}