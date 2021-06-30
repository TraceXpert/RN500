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
$otp_errors = $model->getErrors('otp');
$otp_error = '';
if (!empty($otp_errors)) {
    $otp_error = $otp_errors[0];
}
?>

<div class="signin-form text-center"> 
    <h1>Sign in</h1>
    <p>Sign in on the RN500 platform</p>

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
    echo $form->field($model, 'password', ['options' => ['class' => 'form-group has-feedback']])->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password'), 'readOnly' => $is_otp_sent])
    ?>

    <?php if ($is_otp_sent) { ?>
        <div class="text-left">
            <div class="row">
                <div class="col-md-8">
                    <p class="otp-text">We have sent an OTP to your registered email. </p>
                </div>
                <div class="col-md-4">
                    <a href="" class="float-right">Resend OTP</a>
                </div>
            </div>
        </div>


        <div class="form-group otp mt-2">
            <?php
            for ($i = 0; $i <= 5; $i++) {
                echo $form->field($model, "otp_digits[{$i}]", ['options' => ['class' => 'form-group']])->label(false)->textInput();
            }
            ?>
        </div>

        <?php if ($otp_error != '') { ?> 
            <p class="text-danger"> <?php echo $otp_error ?></p>
        <?php } ?>

        <?php
//        echo $form->field($model, "otp", ['options' => ['class' => 'form-group']])->label(false)->hiddenInput();
        ?>
    <?php } ?>

    <a href="<?= Yii::$app->urlManagerFrontend->createUrl("auth/request-password-reset"); ?>" class="text-right d-block mb-3">Fogot Password?</a>

    <!--<a href="" class="read-more contact-us d-block">Sign In</a>-->
    <?php echo Html::submitButton('Sign In', ['class' => 'read-more contact-us d-block w-100']) ?>

    <p class="create-link mt-3 mb-3">New User? <a href="<?= Yii::$app->urlManagerFrontend->createUrl("auth/register"); ?>">Create an Account</a></p>
    <?php ActiveForm::end(); ?>
</div>


