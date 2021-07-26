<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
use borales\extensions\phoneInput\PhoneInput;
use common\models\User;
use yii\widgets\DetailView;
use common\CommonFunction;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserDetails */
/* @var $form yii\widgets\ActiveForm */

?>

<section class="about-us about-inner-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 main-title">
                <h2 class="mb-4">Personal Information</h2>
            </div>
        </div>

        <div class="post-job">
            <?php
            $form = ActiveForm::begin([
                        "id" => "user-details",
                        'options' => ['enctype' => 'multipart/form-data','autocomplete' => 'off']
            ]);
            ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?=
                        $form->field($model, 'mobile_no')->widget(PhoneInput::className(), [
                            'jsOptions' => [
                                'preferredCountries' => ['us'],
                            ]
                        ]);
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->email, 'readonly' => true]) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $form->field($model, 'apt')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $form->field($model, 'street_no')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $form->field($model, 'street_address')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?=
                        $form->field($model, 'state')->widget(Select2::classname(), [
                            'data' => $states,
                            'options' => ['placeholder' => 'Select a province'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?=
                        $form->field($model, 'city')->widget(Select2::classname(), [
                            'data' => $city,
                            'options' => ['placeholder' => 'Select a city'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?= $form->field($model, 'zip_code')->textInput(['maxlength' => 5]) ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?php
                        echo $form->field($model, 'dob')->widget(DatePicker::classname(), [
                            'name' => 'dob',
                            'options' => ['placeholder' => $model->getAttributeLabel('dob'), 'readonly' => true],
                            'type' => DatePicker::TYPE_INPUT,
                            'pluginOptions' => [
                                'format' => 'dd-mm-yyyy',
                                'todayHighlight' => true,
                                'autoclose' => true,
                                'endDate' => "-0d"
                            ],
                            'pluginEvents' => [
                                "changeDate" => "function(e) {

                            }"
                            ]
                        ]);
                        ?>
                    </div>
                </div>
                <?php if (isset(Yii::$app->user->id) && !empty(Yii::$app->user->id) && Yii::$app->user->identity->type == User::TYPE_JOB_SEEKER) { ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= $form->field($model, 'ssn')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-md-6">
                    <div class="form-group">
                        <?=
                        $form->field($model, 'profile_pic', [
                            'template' => "<label for='real-file'>Upload Your Profile Picture</label><br/><input type='file' id='userdetails-profile_pic' name='UserDetails[profile_pic]' hidden='hidden'><button type='button' id='custom-button'>Choose File</button>{error}"])->fileInput()
                        ?>
                        <?php if (!empty($model->profile_pic) && file_exists(CommonFunction::getProfilePictureBasePath() . "/" . $model->profile_pic)) { ?>
                            <span id="custom-text"><?= $model->profile_pic ?></span>
                            <?php
                        } else {
                            echo '<span id="custom-text">No file selected.</span>';
                        }
                        ?>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo Html::submitButton('Submit', ['class' => 'read-more contact-us mb-3 mt-3']) ?>
                    </div>
                </div>

            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>
</section>
<?php if (isset($comppanyDetail) && !empty($comppanyDetail)) { ?>
    <section class="about-us about-inner-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 main-title">
                    <h3 class="mb-4">Company Details</h3>
                </div>
            </div>
            <div class="view-company">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        echo DetailView::widget([
                            'model' => $companyDetail,
                            'attributes' => [
                                'company_name',
                                'reference_no',
                                'company_email',
                                'company_mobile',
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<?php if (isset($branch) && !empty($branch)) { ?>
    <section class="about-us about-inner-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 main-title">
                    <h3 class="mb-4">Branch Details</h3>
                </div>
            </div>
            <div class="view-company">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        echo DetailView::widget([
                            'model' => $branch,
                            'attributes' => [
                                'branch_name',
                                [
                                    'label' => 'Company Name',
                                    'value' => (isset($branch->company) && !empty($branch->company_id)) ? $branch->company->company_name : '',
                                ],
                                'street_no',
                                'street_address',
                                'apt',
                                [
                                    'label' => 'city',
                                    'value' => (isset($model->city) && !empty($model->city)) ? $model->cityRef->city : "",
                                ],
                                'zip_code',
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<?php
$getCitiesUrl = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['user-details/get-cities']);
$script = <<< JS
   const realFileBtn = document.getElementById("userdetails-profile_pic");
            const customBtn = document.getElementById("custom-button");
            const customTxt = document.getElementById("custom-text");

            customBtn.addEventListener("click", function () {
                realFileBtn.click();
            });

            realFileBtn.addEventListener("change", function () {
                if (realFileBtn.value) {
                var filename = realFileBtn.value;
                if (filename.substring(3,11) == 'fakepath') {
                   filename = filename.substring(12);
               } // Remove c:\fake at beginning from localhost chrome
                    customTxt.innerHTML = filename;
                } else {
                    customTxt.innerHTML = "No file chosen, yet.";
                }
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
