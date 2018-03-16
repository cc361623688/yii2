<?php
namespace frontend\widgets\post;
use common\models\PostModel;
use frontend\models\PostForm;
use yii\base\Widget;
use Yii;
use yii\data\Pagination;
use yii\helpers\Url;

//文章列表组件

class PostWidget extends Widget{
    //post list title
    public $title = '';
    //display number of list
    public $limit = 6;
    //whether display more post
    public $more = true;
    //是否显示分页
    public $page = false;


    public function run()
    {
        $curPage = Yii::$app->request->get('page',1);

        //查询条件
        $condition = ['=','is_valid',PostModel::IS_VALID];
        $res = PostForm::getList($condition,$curPage,$this->limit);

        //var_dump($res);die();

        $result['title']= $this->title ? $this->title :'最新文章';
        $result['more']= Url::to('post/index');
        $result['body']= $res['data']?$res['data']:[];
        //
        if($this->page){
            $pages = new Pagination(['totalCount'=>$res['count'],'pageSize'=>$res['pageSize']]);
            $result['page'] = $pages;
        }

        return $this->render('index',['data'=>$result]);
    }


}

