<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/20
 * Time: 14:13
 */

namespace app\api\validate\category;


use LinCmsTp5\validate\BaseValidate;

class CategoryForm extends BaseValidate
{
    protected $rule=[
        'name' => 'require|chsDash',
        'description' => 'require|chsDash',
        'topic_img_id' => 'require|number',
    ];

    /**
     * 声明一个名叫edit的场景
     */

    public function sceneEdit()
    {
        return $this->append('id', 'require|number')->remove('description', 'require');
    }

}