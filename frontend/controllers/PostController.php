<?php
namespace frontend\controllers;

use common\models\CatModel;
use frontend\controllers\base\BaseController;
use frontend\models\PostForm;
use frontend\models\LoginForm;
use Yii;
use  yii\web\Session;
//post controller

class PostController extends BaseController{
    //post list action
    public function actionIndex()
    {
        return $this->render('index');
    }


    //create post
    public function actionCreate(){
        //if is guest,please login
        if (\Yii::$app->user->isGuest) {

            $session = Yii::$app->session;
            $session->set('back_url', 'post/create');
            return Yii::$app->getResponse()->redirect(array('site/login'));
        }

        $model = new PostForm();

        //get all categories
        $catsModel = new CatModel();
        $cats = $catsModel->getAllCats();

        return $this->render('create',['model'=>$model,'cats'=>$cats]);
    }
}
