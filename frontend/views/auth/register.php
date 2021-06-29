<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use borales\extensions\phoneInput\PhoneInput;
?>

<div class="signin-form signup">
    <h1>Sign Up</h1>
    <p>Sign in on the RN500 platform</p>


    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#jobseeker">Jobseeker</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#employer">Employee</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#recruiter">Recruiter</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div id="jobseeker" class="container tab-pane active"><br>
            <div class="row jobseeker">

                <?php
                $form = ActiveForm::begin(['id' => 'candidate-form',
                            'options' => ['class' => 'w-100', 'autocomplete' => 'off']])
                ?>
                <?= Html::hiddenInput('type', 'candidate') ?>

                <?php
                echo $form->field($model, 'first_name')->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('first_name'), 'class' => 'form-control']);
                ?>

                <?php
                echo $form->field($model, 'last_name')->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('last_name'), 'class' => 'form-control']);
                ?>


                <?php
                echo $form->field($model, 'email')->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('email'), 'class' => 'form-control']);
                ?>

                <?php echo Html::submitButton('Sign Up', ['class' => 'read-more contact-us d-block w-100']) ?>
                <p class="create-link mt-3 mb-3">Already a Member? <a href="<?= Yii::$app->urlManagerFrontend->createUrl("auth/login"); ?>">Login Here</a>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>

        <div id="employer" class="container tab-pane fade employee mb-5 pb-5"><br>
            <div class="row">
                <div class="col-lg-12 pl-3 pl-lg-0">
                    <p class="form-title">Company Details</p>
                </div>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'employer-form', 'options' => ['autocomplete' => 'off']]) ?>

            <?= Html::hiddenInput('type', 'employer') ?>
            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <?= $form->field($companyMasterModel, 'company_name')->textInput(['maxlength' => true, 'placeholder' => $companyMasterModel->getAttributeLabel('company_name')])->label(false); ?>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <?= $form->field($companyMasterModel, 'company_email')->textInput(['maxlength' => true, 'placeholder' => 'Email Id'])->label(false); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <?=
                    $form->field($companyMasterModel, 'company_mobile')->widget(PhoneInput::className(), [
                        'options' => ['class' => 'form-control w-100'],
                        'jsOptions' => [
                            'preferredCountries' => ['us', 'in'],
                        ]
                    ])->label(false);
                    ?>
                </div>

                <div class="col-lg-6 pr-3 pr-lg-0">
                    <?= $form->field($companyMasterModel, 'employer_identification_number')->textInput(['maxlength' => true, 'placeholder' => $companyMasterModel->getAttributeLabel('employer_identification_number')])->label(false); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <?= $form->field($companyMasterModel, 'website_link')->textInput(['maxlength' => true, 'placeholder' => $companyMasterModel->getAttributeLabel('website_link')])->label(false); ?>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <?= $form->field($companyMasterModel, 'street_no')->textInput(['maxlength' => true, 'placeholder' => $companyMasterModel->getAttributeLabel('street_no')])->label(false); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <?= $form->field($companyMasterModel, 'street_address')->textInput(['maxlength' => true, 'placeholder' => $companyMasterModel->getAttributeLabel('street_address')])->label(false); ?>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <?= $form->field($companyMasterModel, 'apt')->textInput(['maxlength' => true, 'placeholder' => $companyMasterModel->getAttributeLabel('apt')])->label(false); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <?=
                    $form->field($companyMasterModel, 'state')->widget(Select2::classname(), [
                        'data' => $states,
                        'options' => ['placeholder' => 'Select a province'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false);
                    ?>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <?=
                    $form->field($companyMasterModel, 'city')->widget(Select2::classname(), [
                        'data' => $cities,
                        'options' => ['placeholder' => 'Select a city'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <?= $form->field($companyMasterModel, 'zip_code')->textInput(['maxlength' => 5, 'placeholder' => $companyMasterModel->getAttributeLabel('zip_code')])->label(false); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 pl-3 pl-lg-0">
                    <p class="form-title">Company Owner Details</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <?php
                    echo $form->field($employer, 'first_name', [
                                'options' => ['class' => 'form-group has-feedback'],
                                'inputTemplate' => '{input}',
                                'template' => '{input}{error}',
                            ])
                            ->label(false)
                            ->textInput(['placeholder' => $employer->getAttributeLabel('first_name')])
                    ?>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <?php
                    echo $form->field($employer, 'last_name', [
                                'options' => ['class' => 'form-group has-feedback'],
                                'inputTemplate' => '{input}',
                                'template' => '{input}{error}',
                            ])
                            ->label(false)
                            ->textInput(['placeholder' => $employer->getAttributeLabel('last_name')])
                    ?>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <?php
                    echo $form->field($employer, 'email', [
                                'options' => ['class' => 'form-group has-feedback'],
                                'inputTemplate' => '{input}',
                                'template' => '{input}{error}',
                            ])
                            ->label(false)
                            ->textInput(['placeholder' => 'Email Id'])
                    ?>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-8 offset-lg-2 pl-3 pl-lg-0">
                    <div class="text-center">
                        <?php echo Html::submitButton('Sign Up', ['class' => 'read-more contact-us d-block w-100']) ?>

                        <p class="create-link mt-3 mb-3">Already a Member? <a href="<?= Yii::$app->urlManagerFrontend->createUrl("auth/login"); ?>">Login Here</a>
                        </p>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>


        <div id="recruiter" class="container tab-pane fade mb-5 pb-5"><br>
            <div class="row">
                <div class="col-lg-12 pl-3 pl-lg-0">
                    <p class="form-title">Company Details</p>
                </div>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'recruiter-form', 'options' => ['autocomplete' => 'off', 'class' => 'w-100']]) ?>
            <?= Html::hiddenInput('type', 'recruiter') ?>
            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <?= $form->field($recruiterCompany, 'company_name')->textInput(['maxlength' => true, 'placeholder' => $companyMasterModel->getAttributeLabel('company_name')])->label(false); ?>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <?= $form->field($recruiterCompany, 'company_email')->textInput(['maxlength' => true, 'placeholder' => 'Email Id'])->label(false); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <?=
                    $form->field($recruiterCompany, 'mobile')->widget(PhoneInput::className(), [
                        'jsOptions' => [
                            'preferredCountries' => ['us', 'in'],
                        ]
                    ])->label(false);
                    ?>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <?= $form->field($recruiterCompany, 'employer_identification_number')->textInput(['maxlength' => true, 'placeholder' => $companyMasterModel->getAttributeLabel('employer_identification_number')])->label(false); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <?= $form->field($recruiterCompany, 'website_link')->textInput(['maxlength' => true, 'placeholder' => $companyMasterModel->getAttributeLabel('website_link')])->label(false); ?>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <?= $form->field($recruiterCompany, 'street_no')->textInput(['maxlength' => true, 'placeholder' => $companyMasterModel->getAttributeLabel('street_no')])->label(false); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <?= $form->field($recruiterCompany, 'street_address')->textInput(['maxlength' => true, 'placeholder' => $companyMasterModel->getAttributeLabel('street_address')])->label(false); ?>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <?= $form->field($recruiterCompany, 'apt')->textInput(['maxlength' => true, 'placeholder' => $companyMasterModel->getAttributeLabel('apt')])->label(false); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <?=
                    $form->field($recruiterCompany, 'state')->widget(Select2::classname(), [
                        'data' => $states,
                        'options' => ['placeholder' => 'Select a province'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false);
                    ?>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <?=
                    $form->field($recruiterCompany, 'city')->widget(Select2::classname(), [
                        'data' => $cities,
                        'options' => ['placeholder' => 'Select a city'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false);
                    ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <?= $form->field($recruiterCompany, 'zip_code')->textInput(['maxlength' => 5, 'placeholder' => $recruiterCompany->getAttributeLabel('zip_code')])->label(false); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 pl-3 pl-lg-0">
                    <p class="form-title">Company Owner Details</p>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <?php
                    echo $form->field($recruiter, 'first_name', [
                                'options' => ['class' => 'form-group has-feedback'],
                                'inputTemplate' => '{input}',
                                'template' => '{input}{error}',
                            ])
                            ->label(false)
                            ->textInput(['placeholder' => $recruiter->getAttributeLabel('first_name')])
                    ?>
                </div>
                <div class="col-lg-6 pr-3 pr-lg-0">
                    <?php
                    echo $form->field($recruiter, 'last_name', [
                                'options' => ['class' => 'form-group has-feedback'],
                                'inputTemplate' => '{input}',
                                'template' => '{input}{error}',
                            ])
                            ->label(false)
                            ->textInput(['placeholder' => $recruiter->getAttributeLabel('last_name')])
                    ?>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-6 pl-3 pl-lg-0">
                    <?php
                    echo $form->field($recruiter, 'email', [
                                'options' => ['class' => 'form-group has-feedback'],
                                'inputTemplate' => '{input}',
                                'template' => '{input}{error}',
                            ])
                            ->label(false)
                            ->textInput(['placeholder' => 'Email Id'])
                    ?>
                </div>
            </div>


            <div class="row mt-4">
                <div class="col-lg-8 offset-lg-2 pl-3 pl-lg-0">
                    <div class="text-center">
                        <?php echo Html::submitButton('Sign Up', ['class' => 'read-more contact-us d-block w-100']) ?>

                        <p class="create-link mt-3 mb-3">Already a Member? <a href="<?= Yii::$app->urlManagerFrontend->createUrl("auth/login"); ?>">Login Here</a>
                        </p>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


<?php
$getCitiesUrl = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['auth/get-cities']);
$script = <<< JS
   $(document).on('change','#companymaster-state',function(){
        var state=$(this).val();
       $.ajax({
                method: 'GET',
                url: '$getCitiesUrl',
                data: {'id':state},
                success: function (response) {
                    $('#companymaster-city').html(response);
                }
            });
   });
   $(document).on('change','#recruitercompanyform-state',function(){
        var state=$(this).val();
       $.ajax({
                method: 'GET',
                url: '$getCitiesUrl',
                data: {'id':state},
                success: function (response) {
                    $('#recruitercompanyform-city').html(response);
                }
            });
   });
   $(document).on('change','#userdetails-state',function(){
        var state=$(this).val();
       $.ajax({
                method: 'GET',
                url: '$getCitiesUrl',
                data: {'id':state},
                success: function (response) {
                    $('#userdetails-city').html(response);
                }
            });
   });
JS;
$this->registerJs($script);
