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
        <div class="newsletter-master-form">

            <?php
            $form = ActiveForm::begin(['id' => 'frm_newsletter',
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
                            // 'removeButtons' => 'Maximize,Image,Source,Table,About,Anchor,Link,Path,SpecialChar,PageBreak,HorizontalRule',
                            'removeButtons' => 'Image,About,Source,Anchor',
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

