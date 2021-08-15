<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\BlogMaster */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .s2-togall-select,.s2-togall-unselect{
        display: none;
    }
</style>
<div class="card card-default color-palette-box">
    <div class="card-body">
        <div class="blog-master-form">

            <?php
            $form = ActiveForm::begin(['id' => 'frm_blogs',
                        'options' => ['autocomplete' => 'off']
            ]);
            ?>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <?= $form->field($model, 'short_description')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <?=
                    $form->field($model, 'tagsList')->widget(Select2::classname(), [
                        'data' => [],
                        'options' => ['placeholder' => 'Add ' . $model->getAttributeLabel('tags'), 'multiple' => true],
                        'pluginOptions' => [
                            'tags' => true,
                            'tokenSeparators' => [',', ' '],
                            'maximumInputLength' => 50
                        ],
//                        'toggleAllSettings' => [
//                            'selectLabel' => '<i class="fas fa-check-circle"></i> Tag All',
//                            'unselectLabel' => '<i class="fas fa-times-circle"></i> Untag All',
//                            'selectOptions' => ['class' => 'text-success'],
//                            'unselectOptions' => ['class' => 'text-danger'],
//                        ],
                    ]);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => 'Select ' . $model->getAttributeLabel('category_id')]) ?>
                </div>
                <div class="col-md-6 col-sm-12">
                    <?= $form->field($model, 'status')->dropDownList(Yii::$app->params['BLOG_CATEGORY_STATUS'], ['prompt' => 'Select ' . $model->getAttributeLabel('status')]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <?= $form->field($model, 'coverImageFile')->fileInput(['class' => 'mt-4']) ?>
                </div>
            </div>



            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-secondary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

