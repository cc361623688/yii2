<?php
namespace frontend\controllers\base;
use yii\web\Controller;


/**
 * base controller
 */
class BaseController extends Controller{

    public function beforeAction($action)
    {
        if(!parent::beforeAction($action)){
            return false;
        }
        return true;
    }
}