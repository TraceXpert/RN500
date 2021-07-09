<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
use borales\extensions\phoneInput\PhoneInput;
use common\models\User;
use common\CommonFunction;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserDetails */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .field-userdetails-street_address{margin-bottom: 5px;}
    .iti--allow-dropdown{width: 100%;}
    .optionlist{margin-left:-40px;}
    /*    .select2-container--krajee-bs4 .select2-selection--single{
            height: 50px;
            padding: .375rem 2rem;
            background: #FFFFFF;
            border-radius: 6px;
            box-shadow: none;
            color: #495057;
        }
        .select2-container--krajee-bs4 .select2-selection--single .select2-selection__rendered{
            padding: .375rem 2rem;
    
        }*/
    .field-userdetails-interest_level{width:200px;}
    .button-wrapper {position: relative;}
    .button-wrapper span.label {position: relative;z-index: 0;display: inline-block;width: 150px;background: #1756a0;cursor: pointer;color: #fff;padding: 10px 0;text-transform:uppercase;font-size:12px;border-radius: 15px;text-align: center;}
    #userdetails-profile_pic {display: inline-block;position: absolute;z-index: 1;width: 100%;height: 50px;top: 0;left: 0;opacity: 0;cursor: pointer;}
</style>
<div class="user-details-form">
    <?php
    $form = ActiveForm::begin([
                "id" => "user-details",
                'options' => ['autocomplete' => 'off']
    ]);
    ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'value' => Yii::$app->user->identity->email, 'readonly' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?=
            $form->field($model, 'mobile_no')->widget(PhoneInput::className(), [
                'jsOptions' => [
                    'preferredCountries' => ['us', 'in'],
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'looking_for')->textarea(['row' => 3]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'apt')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'street_no')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'street_address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <label class="control-label" for="city">City</label>
            <ul class="optionlist">
                <?php
                $url = Url::to(['browse-jobs/get-cities']);
                echo Select2::widget([
                    'name' => 'city',
                    'value' => isset($model->city) && !empty($model->city) ? $model->city : '',
                    'data' => $selectedLocations,
                    'options' => [
                        'id' => 'city',
                        'placeholder' => 'Select Location...',
                        'multiple' => false,
                        'class' => 'form-control select2-hidden-accessible'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 1,
                        'ajax' => [
                            'url' => $url,
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) {return {q:params.term, page:params.page || 1}; }'),
                            'cache' => true,
                        ],
                        'escapeMarkup' => new JsExpression('function (markup) {return markup; }'),
                        'templateResult' => new JsExpression('function(location) {return "<b>"+location.name+"</b>"; }'),
                        'templateSelection' => new JsExpression('function (location) {
                                if(location.selected==true){
                                    return location.text; 
                                }else{
                                    return location.name;
                                }
                            }'),
                    ],
                ]);
                ?>
            </ul>
        </div>
    </div>
    <div class="row">
        <?php if (isset(Yii::$app->user->id) && !empty(Yii::$app->user->id)) { ?>
            <?php if (Yii::$app->user->identity->type == User::TYPE_JOB_SEEKER) { ?>
                <div class="col-sm-6">
                    <?= $form->field($model, 'ssn')->textInput(['maxlength' => 4]) ?>
                </div>
            <?php } ?>
        <?php } ?>
        <div class="col-sm-6">

            <?php
            echo $form->field($model, 'dob')->widget(DatePicker::classname(), [
                'name' => 'dob',
                'options' => ['placeholder' => $model->getAttributeLabel('dob'), 'readonly' => true],
                'type' => DatePicker::TYPE_INPUT,
                'pluginOptions' => [
                    'format' => 'M-dd-yyyy',
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'endDate' => "-0d"
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?=
            $form->field($model, 'profile_pic', ['template' => "<label for='real-file'>Upload Your Profile Picture</label><br/><input type='file' id='userdetails-profile_pic' name='UserDetails[profile_pic]' hidden='hidden'><button type='button' id='custom-button'>Choose File</button>{error}"])->fileInput()
            ?>

            <?php if (!empty($model->profile_pic) && file_exists(CommonFunction::getProfilePictureBasePath() . "/" . $model->profile_pic)) { ?>
                <span id="custom-text"><?= $model->profile_pic ?></span>
            <?php } else { ?>
                <span id="custom-text">No file selected.</span>
            <?php } ?>   
        </div>
        <div class="col-sm-6">

            <?php if (Yii::$app->user->identity->type == User::TYPE_JOB_SEEKER) { ?>
                <?= $form->field($model, 'interest_level')->dropDownList(Yii::$app->params['INTERESTS_LEVEL']) ?>
            <?php } ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'read-more contact-us mb-3 mt-2']) ?>
        <button type="button" class="btn btn-secondary pop-up-close-button" data-dismiss="modal">Close</button>
    </div>


    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
        
$(document).on("beforeSubmit", "#user-details", function () {
        var form = $(this);
        var formData = new FormData(form[0]); 
        $.ajax({
            url    : form.attr('action'),
            type   : 'post',
            dataType : 'json',
            data   : formData,
            processData: false,
            contentType: false,
            success: function (response){
                try{
                    if(!response.error){
                        $("#commonModal").modal('hide');
        
                        $.pjax.reload({container: "#job-seeker", timeout: false, async:false});
                        $.pjax.reload({'container': '#res-messages', timeout: false, async:false});    
                        $.pjax.reload({'container': '#profile-picture-pjax', timeout: false, async:false});

                        getProfilePercentage();
                    }
                }catch(e){
                    $.pjax.reload({'container': '#res-messages', timeout: false});
                }
            },
            error  : function () 
            {
                console.log('internal server error');
            }
        });
        return false;
});
        
$('#userdetails-profile_pic').change(function() {
            var filename = $(this).val();
            var fullname = filename.slice(12,filename.length);
            console.log(fullname);
            $('#custom-text').html(fullname);
        });        
    
    var realFileBtn = document.getElementById("userdetails-profile_pic");
            var customBtn = document.getElementById("custom-button");
            var customTxt = document.getElementById("custom-text");
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
        
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>