<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap4\ActiveForm;
use borales\extensions\phoneInput\PhoneInput;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserDetails */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .iti--allow-dropdown{width: 100%;}
    .select2-container--krajee-bs4 .select2-selection--single{
        height: 50px;
        padding: .375rem 2rem;
        background: #FFFFFF;
        border-radius: 6px;
        box-shadow: none;
        color: #495057;
    }
    .select2-container--krajee-bs4 .select2-selection--single .select2-selection__rendered{
        padding: .375rem 2rem;
    }
</style>
<div class="user-details-form">
    <?php
    $form = ActiveForm::begin([
                'id' => 'add-reference',
                'options' => ['autocomplete' => 'off']
    ]);
    ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'first_name')->textInput(); ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'last_name')->textInput(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'email')->textInput(); ?>
        </div>

        <div class="col-md-6">
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
        <div class="col-md-6">
            <?= $form->field($model, 'title')->dropDownList(Yii::$app->params['REFERENCE_TYPE']) ?>
        </div>

        <div class="col-md-6">
            <?= $form->field($model, 'relation')->textInput() ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo Html::submitButton('Submit', ['class' => 'read-more contact-us mb-3 mt-2']) ?>
        <button type="button" class="btn btn-secondary pop-up-close-button" data-dismiss="modal">Close</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
var click = 0;
$(document).on("beforeSubmit", "#add-reference", function () {
    if(click==0){
        ++click;
        var form = $(this);
        $.ajax({
            url    : form.attr('action'),
            type   : 'post',
            dataType : 'json',
            data   : form.serialize(),
            success: function (response){
                try{
                    if(!response.error){
                        $("#commonModal").modal('hide');
                        $.pjax.reload({container: "#job-seeker", timeout: false, async:false});
                        $.pjax.reload({'container': '#res-messages', timeout: false, async:false});
        
//                        $.pjax.reload({container: "#job-seeker", timeout: 2000});
//                        $(document).on("pjax:success", "#job-seeker", function (event) {
//                            $.pjax.reload({'container': '#res-messages', timeout: 2000});
//                        });
                        getProfilePercentage();
                    }
                }catch(e){
                    $.pjax.reload({'container': '#res-messages', timeout: 2000});
                }
            },
            error  : function () 
            {
                console.log('internal server error');
            }
        });
        return false;
     }
});  
        
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>
