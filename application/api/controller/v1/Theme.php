<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/25
 * Time: 9:47
 */

namespace app\api\controller\v1;

use app\api\model\Theme as ThemeModel;
use app\api\model\ThemeProduct;
use app\lib\exception\theme\ThemeException;
use think\Exception;
use think\facade\Hook;
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

    /**
     * @auth('删除精选主题','精选主题管理')
     * @param('ids','待删除的主题id数组','require|array|min:1')
     */
    public function delTheme()
    {
        $ids=Request::delete('ids');
        $res=ThemeModel::delTheme($ids);
        if(!$res){
            throw new ThemeException(['msg' => '精选主题删除失败']);
        }
        // 记录本次行为的日志
        Hook::listen('logger', '删除了id为' . implode(',', $ids) . '的精选主题');

        return writeJson(201,[],'精选主题删除成功！');

    }

    /**
     * 更新精选主题信息
     * @validate('ThemeForm.edit')
     */
    public function updateThemeInfo($id)
    {
        $themeInfo=Request::patch();
        $theme=ThemeModel::get($id);
        if(!$theme){
            throw new ThemeException(['msg' => '指定的主题不存在']);
        }
        $theme->save($themeInfo);
        return writeJson(201, [], '精选主题基础信息更新成功！');
    }


    /**
     * 移除精选主题关联商品
     * @param('id','精选主题id','require|number')
     * @param('products','商品id列表','require|array|min:1')
     */

    public function removeThemeProduct($id)
    {
        $products = Request::post('products');
        $theme = ThemeModel::get($id);
        if (!$theme) {
            throw new ThemeException(['msg' => '指定的主题不存在']);
        }
        $theme->products()->detach($products);

        return writeJson(201, [], '精选专题删除商品成功');


    }

    /**
     * 新增精选主题关联商品
     * @param('id','精选主题id','require|number')
     * @param('products','商品id列表','require|array|min:1')
     */

    public function addThemeProduct($id)
    {
        $products = Request::post('products');
        $theme = ThemeModel::get($id);
        if (!$theme) {
            throw new ThemeException(['msg' => '指定的主题不存在']);
        }
        $theme->products()->saveAll($products);

        return writeJson(201, [], '精选专题新增商品成功');
    }




}