<?php

use marqu3s\itam\Module;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model marqu3s\itam\models\Monitoring */

$this->title = Module::t('app', 'New monitoring item');
$this->params['breadcrumbs'][] = ['label' => Module::t('menu', 'Monitoring'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monitor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>