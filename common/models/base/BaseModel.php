<?php

namespace common\models\base;


//base model

use yii\db\ActiveRecord;

class BaseModel extends \yii\db\ActiveRecord{
    //获取分页数据
    public function getPages($query,$curPage=1,$pageSize=10,$search = null)
    {
        if($search){
           $query = $query->andFilterWhere($search);
        }
        $data['count'] = $query->count();
        if(!$data['count']){
            return ['count'=>0,'curPage'=>$curPage,'pageSize'=>$pageSize,
                'start'=>0,
                'end'=>0,
                'data'=>[]
            ];
        }

        //超过实际页数，不取输入的当前页$curPage,取最大页数
        $curPage = (ceil($data['count']/$pageSize < $curPage)) ?
            ceil($data['count']/$pageSize) : $curPage;


        //当前页
        $data['curPage'] = $curPage;
        //每页条数
        $data['pageSize'] = $pageSize;
        //起始页和结束页
        $data['start'] = ($curPage-1)*$pageSize +1;

        $data['end'] = ceil($data['count']/$pageSize)==$curPage ?
            $data['count'] : $curPage.$pageSize;

        //data 数据
        $data['data'] = $query->offset(($curPage-1)*$pageSize)
                      ->limit($pageSize)
                      ->asArray()
                      ->all();
        return $data;
    }


}