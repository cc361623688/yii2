<?php
namespace frontend\controllers;

use common\models\CatModel;
use common\models\PostExtendsModel;
use frontend\controllers\base\BaseController;
use frontend\models\PostForm;
use frontend\models\LoginForm;
use Yii;
use  yii\web\Session;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;


//post controller

class PostController extends BaseController{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create','upload','ueditor'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['create','upload','ueditor'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['get','post'],
                ],
            ],
        ];
    }

    //picture upload
    public function actions()
    {
        return [
            'upload'=>[
                'class' => 'common\widgets\file_upload\UploadAction',     //这里扩展地址别写错
                'config' => [
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                ]
            ],
            'ueditor'=>[
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config'=>[
                    //上传图片配置
                    'imageUrlPrefix' => "", /* 图片访问路径前缀 */
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
                ]
            ],
            'ueditor'=>[
                'class' => 'common\widgets\tags\TagWidget',
                'config'=>[

                ]
            ]
        ];
    }
    //post list action
    public function actionIndex()
    {
        return $this->render('index');
    }
    //post detail
    public function actionView($id)
    {
        $postForm = new PostForm();

        $data = $postForm->getViewById($id);
        //post extend model
        $extendModel = new PostExtendsModel();
        $extendModel->upCounter(['post_id'=>$id],'browser',1);

        return $this->render('view',['data'=>$data]);
    }


    //create post
    public function actionCreate(){
        $postForm = new PostForm();

        //定义场景
        $postForm->setScenario(PostForm::SCENSRIOS_CREATE);

        if($postForm->load(Yii::$app->request->post()) && $postForm->validate()){
            if(!$postForm->create()){
                Yii::$app->session->setFlash('warning',$postForm->_lastError);
            }else{
                return $this->redirect(['post/view','id'=>$postForm->id]);
            }
        }

        //get all categories
        $catsModel = new CatModel();
        $cats = $catsModel->getAllCats();

        return $this->render('create',['model'=>$postForm,'cats'=>$cats]);
    }
}
