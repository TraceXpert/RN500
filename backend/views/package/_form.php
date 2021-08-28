<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\Models\PackageMaster */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Package';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->isNewRecord ? "Create" : "Update";
?>
<div class="card card-default color-palette-box">
    <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-md-6 col-sm-12">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6 col-sm-12">
                <?= $form->field($model, 'status')->dropDownList([1 => 'Active', 2 => 'Inactive'], ['prompt' => 'Select']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6 col-sm-12">
                <?= $form->field($model, 'q1_price')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <?= $form->field($model, 'half_year_price')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6 col-sm-12">
                <?= $form->field($model, 'year_price')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <?=
                $form->field($model, 'description')->widget(CKEditor::className(), [
//                           'kcfinder' => true,
                    'options' => ['rows' => 4],
                    'clientOptions' => [
//                    'removeButtons' => 'Subscript,Superscript,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe',
                        'removeButtons' => 'Maximize,Image,Source,Table,About,Anchor,Link,Path,SpecialChar,PageBreak,HorizontalRule',
                    ],
                    'preset' => 'standard'
                ])
                ?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

