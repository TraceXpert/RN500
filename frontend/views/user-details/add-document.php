<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use common\CommonFunction;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserDetails */
/* @var $form yii\widgets\ActiveForm */
$frontendDir = yii\helpers\Url::base(true);
?>

<div class="user-details-form">
    <?php
    $form = ActiveForm::begin([
                'id' => 'add-document-new',
                'options' => ['autocomplete' => 'off','enctype' => 'multipart/form-data']
    ]);
    ?>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'document_type')->dropDownList(Yii::$app->params['DOCUMENT_TYPE']); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php echo $form->field($model, 'path')->fileInput()->label('document') ?>
            <?php // echo $form->field($model, 'path', [ 'template' => "<label for='real-file'>Upload Your Document</label><br/><input type='file' id='real-file' hidden='hidden'><button type='button' id='custom-button'>Choose File</button>"])->fileInput() ?>
            <?php if ($isRecordFlag) { ?>
                <?php if (!empty($model->path) && file_exists(CommonFunction::getDocumentBasePath() . "/" . $model->path)) { ?>
                    <a href="<?= $frontendDir . "/uploads/user-details/license/" . $model->path ?>" download><?= $model->path ?></a>
                    <span id="custom-text"></span>
                <?php } ?>
            <?php } else { ?>
                <!--<span id="custom-text">No file selected.</span>-->
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
  var click = 0;      
  $(document).on("beforeSubmit", "#add-document-new", function () {
    if(click == 0){ 
        ++click;    
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
                console.log(response);
                 try{
                     if(!response.error){
                         $("#commonModal").modal('hide');
                         $.pjax.reload({container: "#job-seeker", timeout: false, async:false});
                         $.pjax.reload({'container': '#res-messages', timeout: false, async:false});
        
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
        
//var realFileBtn = document.getElementById("real-file");
//            var customBtn = document.getElementById("custom-button");
//            var customTxt = document.getElementById("custom-text");
//
//            customBtn.addEventListener("click", function () {
//                realFileBtn.click();
//            });
//
//            realFileBtn.addEventListener("change", function () {
//                if (realFileBtn.value) {
//                var filename = realFileBtn.value;
//                if (filename.substring(3,11) == 'fakepath') {
//                   filename = filename.substring(12);
//               } // Remove c:\fake at beginning from localhost chrome
//                    customTxt.innerHTML = filename;
//                } else {
//                    customTxt.innerHTML = "No file chosen, yet.";
//                }
//            });        
     
 
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>
