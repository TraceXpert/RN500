<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\User;

$form = ActiveForm::begin(['id' => 'approval-form']);
?>
<?= $form->field($model, 'comment')->textarea(['rows' => 3, 'maxlength' => true]) ?>

<div class="form-group">
    <?= Html::button('Cancel', ['class' => 'btn btn-secondary', 'id' => "close", 'data-dismiss' => "modal"]) ?>
    <?php echo Html::submitButton($model->status == User::STATUS_APPROVED ? 'Approve' : 'Reject', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>