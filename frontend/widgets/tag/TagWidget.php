<?php
namespace frontend\widgets\tag;
use common\models\TagModel;
use Yii;
use yii\bootstrap\Widget;


class TagWidget extends Widget{
    public $title = '';

    public $limit = 10;


    public function run()
    {
        $res = TagModel::find()->orderBy(['post_num'=>SORT_DESC])
             ->limit($this->limit)
             ->all();

        $data['title'] = $this->title ? : '标签云';
        $data['body'] = $res ?: $data;

        return $this->render('index',['data'=>$data]);
    }

}