<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'RN500';
?>


<div class="signin-form text-center">
    <h1>Reset Password</h1>
    <?php $form = ActiveForm::begin(['id' => 'reset-password-form', 'options' => ['autocomplete' => 'off', 'class' => 'w-100']]) ?>

    <div class="form-group mb-4">
        <?php
        echo $form->field($model, 'password', [
            'options' => ['class' => 'form-group has-feedback', 'autofocus' => true,],
            'inputTemplate' => '{input}',
            'template' => '<div class="password-field">{input}<span toggle="#password-field" class="fa fa-fw fa-eye password-toggle-icon toggle-password"></span></div> {error}',
        ])->label(false)->passwordInput(['placeholder' => $model->getAttributeLabel('password'),])
        ?>
    </div>

    <div class="form-group mb-4">
        <?php
        echo $form->field($model, 'confirm_password', [
            'options' => ['class' => 'form-group has-feedback', 'autofocus' => true,],
            'inputTemplate' => '{input}',
            'template' => '<div class="password-field">{input}<span toggle="#password-field" class="fa fa-fw fa-eye password-toggle-icon toggle-password"></span></div> {error}',
        ])->label(false)->passwordInput(['placeholder' => $model->getAttributeLabel('confirm_password'),])
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'read-more contact-us d-block w-100']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
