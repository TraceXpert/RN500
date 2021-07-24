<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

$maxLimit = Yii::$app->params['ALLOWED_MAX_RECEIPIENTS_LEAD_SHARE'];
$actionUrl = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/refer-to-friend-post', 'lead_id' => $model->lead_id]);
?>

<div class="referral-form">

    <div class="row">
        <div class="col-md-12 mb-3">
            <?php $form = ActiveForm::begin(['id' => 'referral_form', 'options' => ['autocomplete' => 'off'], 'action' => $actionUrl]); ?>
            <?php echo $form->field($model, 'lead_id')->hiddenInput()->label(false) ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <?php echo $form->field($model, 'from_name')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('from_name')]) ?>
                </div>

                <div class="col-md-6 mb-3">
                    <?php echo $form->field($model, 'from_email')->textInput(['maxlength' => true, 'placeholder' => $model->getAttributeLabel('from_email')]) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <?php echo $form->field($model, 'description')->textarea(['rows' => 4, 'maxlength' => true, 'placeholder' => $model->getAttributeLabel('description')]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <?php
                    DynamicFormWidget::begin([
                        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                        'widgetBody' => '.container-items', // required: css class selector
                        'widgetItem' => '.item', // required: css class
                        'limit' => $maxLimit, // the maximum times, an element can be cloned (default 999)
                        'min' => 1, // 0 or 1 (default 1)
                        'insertButton' => '.add-item', // css class
                        'deleteButton' => '.remove-item', // css class
                        'model' => $modelsRecipient[0],
                        'formId' => 'referral_form',
                        'formFields' => [
                            'to_name',
                            'to_email',
                        ]
                    ]);
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <button type="button" class="read-more contact-us mb-3 mt-2 pull-right add-item btn-xs"><i class="fa fa-plus"></i> Add Recipient</button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body container-items"><!-- widgetContainer -->
                            <?php foreach ($modelsRecipient as $index => $modelRecipient): ?>
                                <div class="item panel panel-default"><!-- widgetBody -->
                                    <div class="panel-heading">
                                        <label class="panel-title-address">Recipient: <?php echo ($index + 1) ?></label>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-sm-12 col-md-5 ">
                                                <?= $form->field($modelRecipient, "[{$index}]to_name")->textInput(['maxlength' => true, 'placeholder' => $modelRecipient->getAttributeLabel('to_name')])->label(false) ?>
                                            </div>
                                            <div class="col-sm-12 col-md-6 ">
                                                <?= $form->field($modelRecipient, "[{$index}]to_email")->textInput(['maxlength' => true, 'placeholder' => $modelRecipient->getAttributeLabel('to_email')])->label(false) ?>
                                            </div>
                                            <div class="col-sm-12 col-md-1 ">
                                                <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                                            </div>
                                        </div><!-- end:row -->


                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php DynamicFormWidget::end(); ?>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12 mb-3">
                    <?php echo Html::submitButton('Submit', ['class' => 'read-more contact-us mb-3 mt-2']) ?>
                    <button type="button" class="btn btn-secondary pop-up-close-button" data-dismiss="modal">Close</button>
                </div>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>



<?php
$script_dynamic_form = <<<JS
$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    $(".dynamicform_wrapper .panel-title-address").each(function(index) {
        $(this).html("Recipient: " + (index + 1))
    });
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    $(".dynamicform_wrapper .panel-title-address").each(function(index) {
        $(this).html("Recipient: " + (index + 1))
    });
});


$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("Are you sure you want to delete this recipient?")) {
        return false;
    }
    return true;
});


$(".dynamicform_wrapper").on("limitReached", function(e, item) {
     Swal.fire({
        title: "Info",
        text: "You cannot add more than $maxLimit recipients at a time.",
        icon: "info",
        showCancelButton: false,
        confirmButtonText: "OK"
      }).then((result) => {
        
      })
});

JS;
$this->registerJS($script_dynamic_form, 3);


$script_new = <<<JS
        
$(document).ready(function() {
    $(document).off('submit').on('submit','form#referral_form',function(e){
        e.preventDefault();
        e.returnValue = false;
        var form = $(this);
        if (form.find('.has-error').length > 0) { 
            return false;
        } else {
            var ajaxRequest = $.post(form.attr('action'), form.serialize(), function(data) {
            }).always(function() {
                $("#commonModal").modal('hide');
                $.pjax.reload({container: '#res-messages', timeout:false, async: false});
            });
        }
    })
})
JS;
$this->registerJS($script_new, 3);
?>