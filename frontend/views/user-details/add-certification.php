<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
use common\CommonFunction;

$frontendDir = yii\helpers\Url::base(true);
?>
<style>
    .mb-15{margin-bottom: 15px;}
    .optionlist{margin-left:-40px;}
</style>
<div class="user-details-form">
    <?php
    $form = ActiveForm::begin([
                'id' => 'add-certification-new',
                'options' => ['autocomplete' => 'off','enctype' => 'multipart/form-data'],
    ]);
    ?>
    <div class="row">
        <div class="col-sm-12">
             <?= $form->field($model, 'certificate_name')->dropDownList(Yii::$app->params['CERTIFICATION_TYPE']); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 radio-btn">
            <label>Certification Active</label>
            <?= $form->field($model, 'certification_active' ,['template' => '<div class="form-group"><input type="radio" id="yes" name="Certifications[certification_active]" value="1"><label for="yes">Yes</label></div><div class="form-group"><input type="radio" id="no" name="Certifications[certification_active]" class="is_not_active" value="0"><label for="no">No</label></div>'])->radioList([]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 expiry_date" style="display:none;">
            <?php
            echo $form->field($model, 'expiry_date')->widget(DatePicker::classname(), [
                'name' => 'expiry_date',
                'value' => date('d-M-Y'),
                'type' => DatePicker::TYPE_INPUT,
                'options' => ['placeholder' => $model->getAttributeLabel('expiry_date'), 'readonly' => true],
                'pluginOptions' => [
                    'format' => 'mm-yyyy',
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'minViewMode' => 'months',
                    'startView' => 'year',
                ],
                'pluginEvents' => [
                    "changeDate" => "function(e) {

                            }"
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'issue_by')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label class="control-label" for="issuing_state">Issuing State</label>
            <ul class="optionlist">
                <?php
                $url = Url::to(['browse-jobs/get-cities']);
                
                echo Select2::widget([
                    'name' => 'issuing_state',
                    'value' => array_keys($selectedLocations),
                    'initValueText' => array_values($selectedLocations),
                    'options' => [
                        'id' => 'issuing_state_location',
                        'placeholder' => 'Select City...',
                        'multiple' => true,
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
    <div class="row mb-15">
        <div class="col-sm-12">
            <?php echo $form->field($model, 'document')->fileInput() ?>
            <?php //$form->field($model, 'document', ['template' => "<label for='real-file'>Upload Your Document</label><br/><input type='file' id='real-file-certification' hidden='hidden'><button type='button' id='custom-certification'>Choose File</button>"])->fileInput()?>
            
            <?php if ($isRecordFlag) { ?>
                <?php if (!empty($model->document) && file_exists(CommonFunction::getCertificateBasePath() . "/" . $model->document)) { ?>
                    <a href="<?= $frontendDir . "/uploads/user-details/certification/" . $model->document ?>" download><?= $model->document ?></a>
                    <span id="custom-text-certification"></span>
                <?php } else { ?>
                    <span id="custom-text-certification">No file selected.</span>
                <?php } ?>
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
$DeleteUrl = '';

if ($isRecordFlag) {
    $DeleteUrl = Yii::$app->urlManagerFrontend->createUrl(['user-details/delete-document?id=' . $model->id]);
}

$script = <<< JS
  var is_active = '$model->certification_active';
  console.log(is_active);      

  if(is_active == '1'){
      $('.expiry_date').show();
      $('.is_active').attr('checked',true);  
  }
  
  if(is_active == '0'){
      $('.is_not_active').attr('checked',true);  
  } 
        
        
  var click = 0;
  $(document).on("beforeSubmit", "#add-certification-new", function () {
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
                 try{
                     if(!response.error){
                         $("#commonModal").modal('hide');
                         $.pjax.reload({container: "#job-seeker", timeout: false, async:false});
                         $.pjax.reload({'container': '#res-messages', timeout: false, async:false});
 
                         getProfilePercentage();
                     }
                 }catch(e){
                     $.pjax.reload({'container': '#res-messages', 'timeout': false});
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
     
$(document).on('click','.field-certifications-certification_active input',function(){
        var value = $(this).val();
       console.log($(this).val());
        
        if(value == '1'){
            $('.expiry_date').show();
        } else {
             $('.expiry_date').hide();
        }
   });        
  
//            const realFileBtn = document.getElementById("real-file-certification");
//            const customBtn = document.getElementById("custom-certification");
//            const customTxt = document.getElementById("custom-text-certification");
//
////            if(customBtn){
//                customBtn.addEventListener("click", function () {
//                    realFileBtn.click();
//                });
////            }
////             if(realFileBtn){
//                realFileBtn.addEventListener("change", function () {
//                    if (realFileBtn.value) {
//                    var filename = realFileBtn.value;
//                    if (filename.substring(3,11) == 'fakepath') {
//                       filename = filename.substring(12);
//                   } // Remove c:\fake at beginning from localhost chrome
//                        customTxt.innerHTML = filename;
//                    } else {
//                        customTxt.innerHTML = "No file chosen, yet.";
//                    }
//                }); 
////             }
        
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>
