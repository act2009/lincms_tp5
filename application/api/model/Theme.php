<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/25
 * Time: 9:48
 */

namespace app\api\model;


use think\Db;
use think\Exception;
use think\model\concern\SoftDelete;

class Theme extends BaseModel
{
    use SoftDelete;
    protected $hidden=['delete_time','head_img_id','topic_img_id','update_time'];

    //关联img表，外键在image表-所以如果在theme里关联image，使用belongsTo
    public function topicImg()
    {
        return $this->belongsTo('Image','topic_img_id','id');
    }

    public function headImg()
    {
        return $this->belongsTo('Image','head_img_id','id');
    }

    /*
     * 关联product模型以及中间表，查询product数据
     * 使用belongsToMany 多对多('要关联的模型','中间表名称','中间表中关联模型的外键','当前模型id在中间表使用的对应的键名');
     * */
    public function products()
    {
        return $this->belongsToMany('Product','theme_product','product_id','theme_id');

    }

    /**
     * @param $ids
     * @return bool
     */
    public function delTheme($ids){
        Db::startTrans();
        try {
            //软删除传来的theme id
            self::destroy($ids);//硬删除中间表(theme_product)中的记录
            foreach ($ids as $id) {
                ThemeProduct::where('theme_id', '=', $id)->delete();
            }
            Db::commit();
            return true;
        }
        catch (Exception $e) {
            Db::rollback();
            return false;
        }

    }



}