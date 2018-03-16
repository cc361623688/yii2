<?php
namespace frontend\widgets\banner;

use yii\base\Widget;
use Yii;


class BannerWidget extends Widget{
    public  $items =[];

    public function init(){
        if(empty($this->items)){
            $this->items = [
                ['label'=>'demo1','img_url'=>'/statics/images/banner/slide1.png','url'=>['site/index'],'html'=>'图片1','active'=>'active'],
                ['label'=>'demo2','img_url'=>'/statics/images/banner/slide2.png','url'=>['site/index'],'html'=>'图片2','active'=>''],
                ['label'=>'demo3','img_url'=>'/statics/images/banner/slide3.png','url'=>['site/index'],'html'=>'图片3','active'=>''],
            ];
        }
    }

    public function run()
    {
        $data['items'] = $this->items;
        return $this->render('index',['data'=>$data]);
    }


}