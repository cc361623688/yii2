<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language'=>'zh-CN',
    'modules' => [],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\AdminModel',
            'enableAutoLogin' => true,
        ],
        'urlManager'=>[
            'showScriptName'=>false,
            'enablePrettyUrl'=>true,
            'rules'=>[],
            //'suffix'=>'.html',
        ],
        'i18n'=>['translations'=>[
            '*'=>[
                'class'=>'yii\i18n\PhpMessageSource',
                //'basePtah'=>'/messages',
                'fileMap'=>[
                    'common'=>'common.php'
                ]
            ]
           ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
