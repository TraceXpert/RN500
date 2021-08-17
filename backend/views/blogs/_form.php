<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use dosamigos\ckeditor\CKEditor;
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
                    <!--<? $form->field($model, 'description')->textarea(['rows' => 6]) ?>-->
                    <?=
                    $form->field($model, 'description')->widget(CKEditor::className(), [
                        'options' => ['rows' => 4],
                        'clientOptions' => [
                            'removeButtons' => 'Maximize,Image,Source,Table,About,Anchor,Link,Path,SpecialChar,PageBreak,HorizontalRule',
                        ],
                        'preset' => 'standard'
                    ])
                    ?>
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
                    ]);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <?= $form->field($model, 'category_id')->dropDownList($categories, ['prompt' => 'Select ' . $model->getAttributeLabel('category_id')]) ?>
                </div>
                <div class="col-md-6 col-sm-12">
                    <?= $form->field($model, 'status')->dropDownList(Yii::$app->params['BLOG_SUSPENDED'])->label("Suspend") ?>
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

