<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/25
 * Time: 9:47
 */

namespace app\api\controller\v1;

use app\api\model\Theme as ThemeModel;
use app\lib\exception\theme\ThemeException;
use think\Exception;
use think\facade\Request;

class Theme
{
    public function getSimpleList()
    {

        $result=ThemeModel::with('topicImg,headImg')->select();
        if($result->isEmpty()){
            throw new ThemeException([
                'msg'=>'没有查询到主题内容'
            ]);
        }
        return $result;
    }

    /**
     * 查询指定主题详情
     * @param('id','精选主题id','require|number')
     */
    public function getThemeById($id)
    {
        $theme=ThemeModel::with('topicImg,headImg,products')->get($id);
        return $theme;
    }

    /**
     * 新增精选主题
     * @validate('ThemeForm')
     * @throws ThemeException
     */
    public function addTheme()
    {
        $params=Request::post();
        $theme=ThemeModel::create($params,true);
        if($theme->isEmpty()){
            throw new ThemeException([
                'msg'=>'精选主题新增失败'
            ]);
        }

        return writeJson(201,['id'=>$theme->id],'精选主题新增成功！');

    }


    public function delTheme()
    {
        $ids=Request::delete('ids');




        return writeJson(9999,[],'删除精选主题成功',70003);

    }






}