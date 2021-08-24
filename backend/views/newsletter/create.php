<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NewsletterMaster */

$this->title = Yii::t('app', 'Create Newsletter Master');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Newsletter Masters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="newsletter-master-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
