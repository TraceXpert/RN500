<?php

//use Yii;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use common\CommonFunction;
use yii\helpers\Html;
$jsFormat = Yii::$app->params['date.format.datepicker.js'];

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!-- Page Title start -->
<!--<div class="pageTitle">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <h1 class="page-heading">Post Job</h1>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="breadCrumb"><a href="#.">Home</a> / <span>Post Job</span></div>
      </div>
    </div>
  </div>
</div>-->
<!-- Page Title End -->

<section class="about-us about-inner-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 main-title">
                <h2 class="mb-4">Job Information</h2>
            </div>
        </div>

        <div class="post-job">
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['autocomplete' => 'off']]) ?>
            <div class="row">
                <?php if (CommonFunction::isLoggedInUserDefaultBranch()) { ?>
                    <div class="col-md-6">
                        <?php
//                        echo $form->field($model, 'branch_id')->widget(Select2::classname(), [
//                            'data' => $branchList,
//                            'size' => Select2::LARGE,
//                            'options' => ['placeholder' => $model->getAttributeLabel('branch_id')],
//                            'pluginOptions' => [
//                                'allowClear' => true
//                            ],
//                        ]);
                        ?>
                        <?php echo $form->field($model, 'branch_id')->dropdownList($branchList, ['class' => 'form-control', 'prompt' => 'Select Location'])->label('Location'); ?>
                    </div>
                <?php } ?>

                <div class="col-md-6">
                    <?php echo $form->field($model, 'title')->textInput(['placeholder' => $model->getAttributeLabel('title'), 'maxlength' => true]); ?>
                </div>

                <div class="col-md-6">
                    <?php
                    echo $form->field($model, 'disciplines')->widget(Select2::classname(), [
                        'data' => $disciplinesList,
                        'options' => ['placeholder' => $model->getAttributeLabel('disciplines'), 'multiple' => true],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-6">
                    <?php
                    echo $form->field($model, 'benefits')->widget(Select2::classname(), [
                        'data' => $benefitList,
                        'options' => ['placeholder' => $model->getAttributeLabel('benefits'), 'multiple' => true],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-6">
                    <?php
                    echo $form->field($model, 'specialities')->widget(Select2::classname(), [
                        'data' => $specialityList,
                        'options' => ['placeholder' => $model->getAttributeLabel('specialities'), 'multiple' => true],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
                </div>

                <div class="col-md-6">
                    <?php
                    echo $form->field($model, 'emergency')->widget(Select2::classname(), [
                        'data' => $emergencyList,
                        'options' => ['placeholder' => $model->getAttributeLabel('Optional'), 'multiple' => true],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label('Urgent');
                    ?>
                </div>

                <div class="col-md-6">
                    <?php echo $form->field($model, 'jobseeker_payment')->textInput(['placeholder' => $model->getAttributeLabel('jobseeker_payment')]); ?>
                </div>

                <div class="col-md-6">
                    <?php echo $form->field($model, 'payment_type')->dropdownList(Yii::$app->params['job.payment_type'], ['class' => 'form-control', 'prompt' => 'Select ' . $model->getAttributeLabel('payment_type')]); ?>
                </div>

                <div class="col-md-6">
                    <?php echo $form->field($model, 'job_type')->dropdownList(Yii::$app->params['job.type'], ['class' => 'form-control', 'prompt' => 'Select ' . $model->getAttributeLabel('job_type')]); ?>
                </div>

                <div class="col-md-6">
                    <?php echo $form->field($model, 'shift')->dropdownList(Yii::$app->params['job.shift'], ['class' => 'form-control', 'prompt' => 'Select ' . $model->getAttributeLabel('shift')]); ?>
                </div>

                <div class="col-md-6">

                    <?php
                    echo $form->field($model, 'start_date')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => $model->getAttributeLabel('start_date'), 'readonly' => true],
                        'type' => DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'clearBtn' => true,
                            'format' => $jsFormat,
                            'autoclose' => true,
                            'startDate' => date('d-m-Y'),
                        ],
                        'pluginEvents' => [
                            "changeDate" => "function(e) {
                                                $('#leadmaster-end_date').kvDatepicker({
                                                    autoclose : true,
                                                    format : '$jsFormat'
                                                });
                                                $('#leadmaster-end_date').kvDatepicker('setStartDate', e.date);
                                            }"
                        ]
                    ]);
                    ?>
                </div>

                <div class="col-md-6">
                    <?php
                    echo $form->field($model, 'end_date')->widget(DatePicker::classname(), [
                        'options' => ['placeholder' => $model->getAttributeLabel('end_date'), 'readonly' => true],
                        'type' => DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                            'clearBtn' => true,
                            'autoclose' => true,
                            'format' => Yii::$app->params['date.format.datepicker.js'],
                        ],
                        'pluginEvents' => [
                            "changeDate" => "function(e) {
                                                $('#leadmaster-start_date').kvDatepicker({
                                                    autoclose : true,
                                                    format : '$jsFormat'
                                                });
                                                $('#leadmaster-start_date').kvDatepicker('setEndDate', e.date);
                                            }"
                        ]
                    ]);
                    ?>
                </div>

                <div class="col-md-6">
                    <?php echo $form->field($model, 'recruiter_commission')->textInput(['placeholder' => $model->getAttributeLabel('recruiter_commission')]); ?>
                </div>

                <div class="col-md-6">
                    <?php echo $form->field($model, 'recruiter_commission_type')->dropdownList(Yii::$app->params['RECRUITER_COMMISSION_TYPE'], ['class' => 'form-control', 'prompt' => 'Select ' . $model->getAttributeLabel('recruiter_commission_type')]); ?>
                </div>

                <div class="col-md-6">
                    <?php echo $form->field($model, 'recruiter_commission_mode')->dropdownList(Yii::$app->params['COMMISSION_MODE'], ['class' => 'form-control', 'prompt' => 'Select ' . $model->getAttributeLabel('recruiter_commission_mode')]); ?>
                </div>

                <div class="col-md-6">
                    <?php echo $form->field($model, 'street_no')->textInput(['placeholder' => $model->getAttributeLabel('street_no')]); ?>
                </div>

                <div class="col-md-6">
                    <?php echo $form->field($model, 'street_address')->textInput(['placeholder' => $model->getAttributeLabel('street_address')]); ?>
                </div>

                <div class="col-md-6">
                    <?php echo $form->field($model, 'apt')->textInput(['placeholder' => $model->getAttributeLabel('apt')]); ?>
                </div>

                <div class="col-md-6">
                    <?php echo $form->field($model, 'state')->dropdownList($states, ['class' => 'form-control', 'prompt' => 'Select ' . $model->getAttributeLabel('state')]); ?>
                </div>

                <div class="col-md-6">
                    <?php echo $form->field($model, 'city')->dropdownList($cities, ['class' => 'form-control', 'prompt' => 'Select ' . $model->getAttributeLabel('city')]); ?>
                </div>

                <div class="col-md-6">
                    <?php echo $form->field($model, 'zip_code')->textInput(['placeholder' => $model->getAttributeLabel('zip_code')]); ?>
                </div>
                <div class="col-md-6">
                    <?php echo $form->field($model, 'description')->textInput(['placeholder' => $model->getAttributeLabel('description')]); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?php echo Html::submitButton('Submit', ['class' => 'read-more contact-us mb-3 mt-2  w-100']) ?>
                    <!--                    <div class="form-group text-center">
                                            <a href="" class="read-more contact-us mb-3 mt-3 w-100">Post Job</a>
                                        </div>-->
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>
</section>




<?php
$getCitiesUrl = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['job/get-cities']);
$script = <<< JS
    $(document).on('change','#leadmaster-state',function(){
        var state=$(this).val();
        if(state){
            $.ajax({
                method: 'GET',
                url: '$getCitiesUrl',
                data: {'id':state},
                success: function (response) {
                    $('#leadmaster-city').html(response);
                }
            });
        }else{
            $('#leadmaster-city').html("");
            $('#leadmaster-city').val("");
        }
    });
JS;
$this->registerJs($script);
