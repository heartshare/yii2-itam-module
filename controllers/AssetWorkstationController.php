<?php

namespace marqu3s\itam\controllers;

use marqu3s\itam\models\AssetWorkstation;
use marqu3s\itam\models\Group;
use marqu3s\itam\models\OfficeSuite;
use marqu3s\itam\models\Os;
use marqu3s\itam\Module;
use yii\helpers\ArrayHelper;

/**
 * AssetWorkstationController implements the CRUD actions for AssetWorkstation model.
 */
class AssetWorkstationController extends BaseCrudController
{
    public function __construct($id, Module $module, array $config = [])
    {
        # Configure the assetType
        $this->assetType = 'AssetWorkstation';

        # Configure the GridView columns
        $this->gridDataColumns = [
            [
                'attribute' => 'hostname',
                'value' => 'asset.hostname'
            ],
            [
                'attribute' => 'id_os',
                'headerOptions' => [
                    'class' => 'hidden-xs'
                ],
                'contentOptions' => [
                    'class' => 'hidden-xs'
                ],
                'value' => 'os.name',
                'filter' => ArrayHelper::map(Os::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),
                'filterOptions' => [
                    'class' => 'hidden-xs'
                ],
            ],
            [
                'attribute' => 'id_office_suite',
                'headerOptions' => [
                    'class' => 'hidden-xs'
                ],
                'contentOptions' => [
                    'class' => 'hidden-xs'
                ],
                'value' => 'officeSuite.name',
                'filter' => ArrayHelper::map(OfficeSuite::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),
                'filterOptions' => [
                    'class' => 'hidden-xs'
                ],
            ],
            [
                'attribute' => 'ipMacAddress',
                'headerOptions' => [
                    'class' => 'hidden-xs'
                ],
                'contentOptions' => [
                    'class' => 'hidden-xs'
                ],
                'format' => 'html',
                'value' => function (AssetWorkstation $model) {
                    $ip = empty($model->asset->ip_address) ? Module::t('app', 'Dynamic IP') : $model->asset->ip_address;
                    return $ip . '<br><small>' . $model->asset->mac_address . '</small>';
                },
                'filterOptions' => [
                    'class' => 'hidden-xs'
                ],
            ],
            [
                'attribute' => 'group',
                'headerOptions' => [
                    'class' => 'hidden-xs'
                ],
                'contentOptions' => [
                    'class' => 'hidden-xs'
                ],
                'format' => 'html',
                'value' => function (AssetWorkstation $model) {
                    if (empty($model->asset->groups)) return null;
                    $str = '';
                    foreach ($model->asset->groups as $group) {
                        $str .= $group->name . '<br>';
                    }
                    return $str;
                },
                'filter' => ArrayHelper::map(Group::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),
                'filterOptions' => [
                    'class' => 'hidden-xs'
                ],
            ],
            /*[
                'attribute' => 'brandAndModel',
                'format' => 'html',
                'value' => function ($model) {
                    if (empty($model->asset->brand) && empty($model->asset->model)) return null;
                    return $model->asset->brand . '<br><small>' . $model->asset->model . '</small>';
                }
            ],
            [
                'attribute' => 'serviceTag',
                'value' => 'asset.service_tag'
            ],*/
            [
                'attribute' => 'locationName',
                'headerOptions' => [
                    'class' => 'hidden-xs'
                ],
                'contentOptions' => [
                    'class' => 'hidden-xs'
                ],
                'format' => 'html',
                'value' => function (AssetWorkstation $model) {
                    return $model->asset->location->name . '<br><small>' . $model->asset->room . '</small>';
                },
                'filterOptions' => [
                    'class' => 'hidden-xs'
                ],
            ],
            'user',
        ];

        # Always call the parent constructor method!
        parent::__construct($id, $module, $config);
    }
}
