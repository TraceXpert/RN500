<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="card card-default color-palette-box">
    <div class="card-body">
        <div class="blog-master-form">

            <?php $form = ActiveForm::begin(['id' => 'frm_blog_category']); ?>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <?= $form->field($model, 'status')->dropDownList(Yii::$app->params['BLOG_CATEGORY_STATUS'], ['prompt' => 'Select ' . $model->getAttributeLabel('status')]) ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Cancel', ['categories'], ['class' => 'btn btn-secondary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
