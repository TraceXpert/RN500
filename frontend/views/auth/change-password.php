<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\date\DatePicker;

$is_otp_sent = $model->is_otp_sent;
?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="signin-form text-center h-auto mt-0">
                    <h1 class="mb-4 pb-2">Change Password</h1>                        
                    <?php
                    $form = ActiveForm::begin(['options' => [
                                    'class' => 'w-100'
                    ]]);
                    ?>
                    <?= $form->field($model, 'password', ['template' => '<div class="password-field">{input}<span toggle="#password-field" class="fa fa-fw fa-eye password-toggle-icon toggle-password"></span></div> {error}',])->label(false)->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
                    <?= $form->field($model, 'new_password', ['template' => '<div class="password-field">{input}<span toggle="#password-field" class="fa fa-fw fa-eye password-toggle-icon toggle-password"></span></div> {error}',])->label(false)->passwordInput(['placeholder' => $model->getAttributeLabel('new_password')]) ?>
                    <?= $form->field($model, 'confirm_password', ['template' => '<div class="password-field">{input}<span toggle="#password-field" class="fa fa-fw fa-eye password-toggle-icon toggle-password"></span></div> {error}',])->label(false)->passwordInput(['placeholder' => $model->getAttributeLabel('confirm_password')]) ?>
                    <?php if ($is_otp_sent) { ?>
                        <div class="text-left">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="otp-text">We have sent an OTP to your registered email. </p>
                                </div>
                                <div class="col-md-4">
                                    <a href="javascript:void(0)" id="resend_otp" url="<?= Yii::$app->urlManagerFrontend->createAbsoluteUrl(['auth/resend-otp', 'email' => Yii::$app->user->identity->email]) ?>" class="float-right">Resend OTP</a>
                                </div>
                            </div>
                        </div>


                        <div class="form-group otp mt-2 otp-input-wrapper">
                            <?php
                            echo $form->field($model, "otp", ['template' => "\n{input}\n<svg viewBox='0 0 240 1' xmlns='http://www.w3.org/2000/svg'><line x1='0' y1='0' x2='240' y2='0' stroke='#3e3e3e' stroke-width='2' stroke-dasharray='30,11' /></svg>\n{hint}\n{error}"])->label(false)->textInput(['class' => '', 'maxlength' => 6, "pattern" => "[0-9]*", "autocomplete" => "off"]);
                            ?>
                        </div>
                    <?php } ?>

                    <?= Html::submitButton('Change Password', ['class' => 'read-more contact-us d-block']) ?>         
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$script = <<< JS
        $(document).on('click', '#p1', function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    
    var input = $("#changepasswordform-password");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
        $(document).on('click', '#p2', function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    
    var input = $("#changepasswordform-new_password");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
        $(document).on('click', '#p3', function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    
    var input = $("#changepasswordform-confirm_password");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});
$(document).on('click', '#resend_otp', function() {
        var action=$(this).attr('url');
        $.ajax({
            url    : action,
            type   : 'post',
            success: function (response){
                var res=JSON.parse(response);
                $('.message').html(res.msg);        
                $('.message').css("display","block");        
            },
        });
  });
JS;
$this->registerJs($script);
