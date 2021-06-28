<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'RN500';
?>

<div class="signin-form text-center">
    <h1>Forgot Password</h1>
    <p>Please fill out your registered email, a link to reset password will be sent.</p>

    <?php $form = ActiveForm::begin(['id' => 'password-reset-form', 'options' => ['autocomplete' => 'off', 'class' => 'w-100']]) ?>

    <div class="form-group mb-4">
        <?php
        echo $form->field($model, 'email', [
            'options' => ['class' => 'form-group has-feedback', 'autofocus' => true,],
            'inputTemplate' => '{input}',
            'template' => '{input}{error}',
        ])->label(false)->textInput(['placeholder' => $model->getAttributeLabel('email'),])
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Reset Password', ['class' => 'read-more contact-us d-block w-100']) ?>
    </div>

    <p class="create-link mt-3 mb-3">I Remembered My Password. <a href="<?= Yii::$app->urlManagerFrontend->createUrl("auth/login"); ?>">Login</a></p>
    <?php ActiveForm::end(); ?>
</div>