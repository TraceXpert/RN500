<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="card card-default color-palette-box">
    <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <?= $form->field($model, 'headline')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6 col-sm-12">
                <?= $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'Inactive']) ?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>