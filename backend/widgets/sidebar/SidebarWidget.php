<?php
namespace backend\widgets\sidebar;

/**
 * 后台siderbar插件
 */
use Yii;
use yii\base\Widget;
use yii\widgets\Menu;

class SidebarWidget extends Menu
{
    public $submenuTemplate = "\n<ul class=\"children\">\n{items}\n</ul>\n";

    public $options = ['class'=>'nav nav-pills nav-stacked nav-quirk'];

    public $activateParents = true;

    public function init()
    {
        $this->items = [
            ['label' =>'<i class="fa fa-dashboard"></i><span>'.Yii::t('common','Dashboard').'</span>','url'=>['site/index']],
            ['label' =>'<a href=""><i class="fa fa-th-list"></i><span>'.Yii::t('common','Content management').'</span></a>','options'=>['class'=>'nav-parent'],'items'=>[
                ['label'=>Yii::t('common','Post').Yii::t('common','Management'),'url'=>['post/index'],
                    'items'=>[
                        ['label'=>Yii::t('common','Create').Yii::t('common','Post'),'url'=>['post/create'],'visible'=>false],
                        ['label'=>Yii::t('common','Update').Yii::t('common','Post'),'url'=>['post/update'],'visible'=>false],
                        ['label'=>Yii::t('common','Post').Yii::t('common','Detail'),'url'=>['post/view'],'visible'=>false],
                    ]
                ],
                ['label'=>Yii::t('common','Category').Yii::t('common','Management'),'url'=>['cat/index'],'items'=>[
                    ['label'=>Yii::t('common','Create').Yii::t('common','Category'),'url'=>['cat/create'],'visible'=>false],
                    ['label'=>Yii::t('common','Update').Yii::t('common','Category'),'url'=>['cat/update'],'visible'=>false],
                    ['label'=>Yii::t('common','Category').Yii::t('common','Detail'),'url'=>['cat/view'],'visible'=>false],
                ]
                ],
                ['label'=>Yii::t('common','Tag').Yii::t('common','Management'),'url'=>['tag/index'],'items'=>[
                    ['label'=>Yii::t('common','Create').Yii::t('common','Tag'),'url'=>['tag/create'],'visible'=>false],
                    ['label'=>Yii::t('common','Update').Yii::t('common','Tag'),'url'=>['tag/update'],'visible'=>false],
                    ['label'=>Yii::t('common','Tag').Yii::t('common','Detail'),'url'=>['tag/view'],'visible'=>false],
                    ]
                ],
            ]
            ],
            ['label' =>'<a href=""><i class="fa fa-user"></i><span>'.Yii::t('common','Member').Yii::t('common','Management').'</span></a>','options'=>['class'=>'nav-parent'],
                'items'=>[
                    ['label'=>Yii::t('common','Member').Yii::t('common','Information'),'url'=>['user/index'],
                    'items'=>[
                         ['label'=>Yii::t('common','Update').Yii::t('common','Member'),'url'=>['user/update'],'visible'=>false],
                         ['label'=>Yii::t('common','Member').Yii::t('common','Detail'),'url'=>['user/view'],'visible'=>false],
                       ]
                    ],
                ]
            ],
        ];
    }

    /**
     * Normalizes the [[items]] property to remove invisible items and activate certain items.
     * @param array $items the items to be normalized.
     * @param boolean $active whether there is an active child menu item.
     * @return array the normalized menu items
     */
    protected function normalizeItems($items, &$active)
    {
        foreach ($items as $i => $item) {
            if (!isset($item['label'])) {
                $item['label'] = '';
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $items[$i]['label'] = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $hasActiveChild = false;
            if (isset($item['items'])) {
                $items[$i]['items'] = $this->normalizeItems($item['items'], $hasActiveChild);
                if (empty($items[$i]['items']) && $this->hideEmptyItems) {
                    unset($items[$i]['items']);
                    if (!isset($item['url'])) {
                        unset($items[$i]);
                        continue;
                    }
                }
            }
            if (!isset($item['active'])) {
                if ($this->activateParents && $hasActiveChild || $this->activateItems && $this->isItemActive($item)) {
                    $active = $items[$i]['active'] = true;
                } else {
                    $items[$i]['active'] = false;
                }
            } elseif ($item['active']) {
                $active = true;
            }

            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
                continue;
            }
        }

        return array_values($items);
    }
}