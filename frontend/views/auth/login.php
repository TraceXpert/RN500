<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

//use yii\widgets\ActiveForm;
//use yii\bootstrap\ActiveForm;

$is_otp_sent = $model->is_otp_sent;
?>

<div class="signin-form overflow-form justify-content-start text-center"> 
    <h1>Sign in</h1>
    <p>Sign in on the RN500 platform</p>
    <?php if (Yii::$app->session->hasFlash("success")) { ?>
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <?php echo Yii::$app->session->getFlash("success") ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>
    <?php
    $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => [
                    'autocomplete' => 'off',
                    'class' => 'w-100'
                ]
            ])
    ?>

    <?php
    echo $form->field($model, 'username', [
                'options' => ['class' => 'form-group has-feedback', 'autocomplete' => 'off']
            ])->label(false)
            ->textInput(['placeholder' => 'Email Id', 'readOnly' => $is_otp_sent])
    ?>

    <?php
    echo $form->field($model, 'password', [
                'template' => '<div class="password-field">{input}<span toggle="#password-field" class="fa fa-fw fa-eye-slash password-toggle-icon toggle-password"></span></div> {error}',
                'options' => ['class' => 'form-group has-feedback']
            ])->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password'), 'readOnly' => $is_otp_sent])
    ?>

    <?php if ($is_otp_sent) { ?>
        <div class="text-left">
            <div class="row">
                <div class="col-md-8">
                    <p class="otp-text">We have sent an OTP to your registered email. </p>
                </div>
                <div class="col-md-4">
                    <a href="javascript:void(0)" id="resend_otp" url="<?= Yii::$app->urlManagerFrontend->createAbsoluteUrl(['auth/resend-otp', 'email' => $model->username]) ?>" class="float-right">Resend OTP</a>
                </div>
            </div>
        </div>


        <div class="form-group otp mt-2 otp-input-wrapper">
            <?php
            echo $form->field($model, "otp", ['template' => "\n{input}\n<svg viewBox='0 0 240 1' xmlns='http://www.w3.org/2000/svg'><line x1='0' y1='0' x2='240' y2='0' stroke='#3e3e3e' stroke-width='2' stroke-dasharray='30,11' /></svg>\n{hint}\n{error}"])->label(false)->textInput(['class' => '', 'maxlength' => 6, "pattern" => "[0-9]*", "autocomplete" => "off"]);
            ?>
        </div>
    <?php } ?>

    <a href="<?= Yii::$app->urlManagerFrontend->createUrl("auth/request-password-reset"); ?>" class="text-right d-block mb-3">Fogot Password?</a>

    <!--<a href="" class="read-more contact-us d-block">Sign In</a>-->
    <?php echo Html::submitButton('Sign In', ['class' => 'read-more contact-us d-block w-100']) ?>

    <p class="create-link mt-3 mb-3">New User? <a href="<?= Yii::$app->urlManagerFrontend->createUrl("auth/register"); ?>">Create an Account</a></p>
    <?php ActiveForm::end(); ?>
</div>
<?php
$script = <<< JS

        
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
