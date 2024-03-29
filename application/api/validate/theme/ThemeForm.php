<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/29
 * Time: 18:29
 */

namespace app\api\validate\theme;




use LinCmsTp5\validate\BaseValidate;

class ThemeForm extends BaseValidate
{

    protected $rule=[
        'name'=>'require|chsDash',
        'description'=>'require|chsDash',
        'topic_img_id'=>'require|number',
        'head_img_id'=>'require|number',

    ];

     public function sceneEdit()
     {
         return $this
             ->remove('description', 'require')
             ->remove('topic_img_id', 'require')
             ->remove('head_img_id', 'require');

     }
}
