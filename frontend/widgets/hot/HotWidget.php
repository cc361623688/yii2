<?php
namespace frontend\widgets\hot;

use common\models\PostExtendsModel;
use common\models\PostModel;
use yii\base\Widget;
use yii\db\Query;
use yii\helpers\Url;
use Yii;

class HotWidget extends Widget{
    //文章列表的标题
    public $title = '';
    //显示条数
    public $limit = 5;
    // 是否显示更多
    public $more = true;

    public function run()
    {
        $result  = (new Query())->select('p.id,p.title,e.post_id,e.browser')
                 ->from(['e'=>PostExtendsModel::tableName()])
                 ->join('LEFT JOIN',['p'=>PostModel::tableName()],'e.post_id = p.id')
                 ->where('p.is_valid ='.PostModel::IS_VALID)
                 ->orderBy(['browser'=>SORT_DESC,'id'=>SORT_DESC])
                 ->limit($this->limit)
                // ->asArray()
                 ->all();
        $data['title'] = $this->title ? $this->title : '热门浏览';
        $data['more'] = Url::to(['post/index','sort'=>'hot']);
        $data['body'] = $result;


        return $this->render('index',['data'=>$data]);

    }
}