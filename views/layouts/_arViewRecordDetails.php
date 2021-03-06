<?php
/**
 * Created by PhpStorm.
 * User: joao
 * Date: 29/04/17
 * Time: 14:53
 */

use marqu3s\itam\Module;
use yii\widgets\DetailView;

/** @var $model \yii\db\ActiveRecord */
?>
<h2><?= Module::t('app', 'Record Details') ?></h2>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'created_at:datetime', // creation date formatted as datetime
        [
            'attribute' => 'created_by',
            'visible' => $this->context->module->rbacAuthorization
        ],
        'updated_at:datetime', // update date formatted as datetime
        [
            'attribute' => 'updated_by',
            'visible' => $this->context->module->rbacAuthorization
        ],
    ],
]) ?>
