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
    .button-wrapper {position: relative;}
    .button-wrapper span.label {position: relative;z-index: 0;display: inline-block;width: 150px;background: #1756a0;cursor: pointer;color: #fff;padding: 15px 0;text-transform:uppercase;font-size:12px;border-radius: 15px;text-align: center;}
    #certifications-document {display: inline-block;position: absolute;z-index: 1;width: 100%;height: 50px;top: 0;left: 0;opacity: 0;cursor: pointer;}
</style>
<div class="user-details-form">
    <?php
    $form = ActiveForm::begin([
                'id' => 'add-certification-new',
                'options' => ['autocomplete' => 'off', 'enctype' => 'multipart/form-data'],
    ]);
    ?>
    <div class="row">
        <div class="col-sm-12">
            
             <?php
                    echo $form->field($model, 'certificate_name')->widget(Select2::classname(), [
                        'data' => $certificationList,
                        'options' => ['placeholder' => $model->getAttributeLabel('certificate_name')],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 radio-btn">
            <label>Certification Active</label>
            <?= $form->field($model, 'certification_active', ['template' => '<div class="form-group"><input type="radio" id="yes" class="is_active" name="Certifications[certification_active]" value="1"><label for="yes">Yes</label></div><div class="form-group"><input type="radio" id="no" name="Certifications[certification_active]" class="is_not_active" value="0"><label for="no">No</label></div>'])->radioList([]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 expiry_date" style="display:none;">
            <?php
            echo $form->field($model, 'expiry_date')->widget(DatePicker::classname(), [
                'name' => 'expiry_date',
//                'value' => date('d-M-Y'),
                'type' => DatePicker::TYPE_INPUT,
                'options' => ['placeholder' => $model->getAttributeLabel('expiry_date'), 'readonly' => true],
                'pluginOptions' => [
                    'format' => 'M-yyyy',
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
                $url = Url::to(['site/get-cities']);

                echo Select2::widget([
                    'name' => 'issuing_state',
                    'value' => isset($model->issuing_state) && !empty($model->issuing_state) ? $model->issuing_state : '',
                    'data' => $selectedLocations,
                    'options' => [
                        'id' => 'issuing_state_location',
                        'placeholder' => 'Select City...',
                        'multiple' => false,
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
            <label>Upload Document</label>
            <?php echo $form->field($model, 'document', ['template' => '<div class="button-wrapper"><span class="label">Upload Document</span>{input}</button>{error}'])->fileInput() ?>
            <?php //$form->field($model, 'document', ['template' => "<label for='real-file'>Upload Your Document</label><br/><input type='file' id='real-file-certification' hidden='hidden'><button type='button' id='custom-certification'>Choose File</button>"])->fileInput() ?>

            <?php if ($isRecordFlag) { ?>
                <?php if (!empty($model->document) && file_exists(CommonFunction::getCertificateBasePath() . "/" . $model->document)) { ?>
                    <a href="<?= $frontendDir . "/uploads/user-details/certification/" . $model->document ?>" download><?= $model->document ?></a>
                    <span id="custom-text"></span>
                <?php } ?>
            <?php } else { ?>
                <span id="custom-text">No file selected.</span>
            <?php } ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'read-more contact-us mb-3 mt-2 ml-3']) ?>
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
  
   
        $('#certifications-document').change(function() {
            var filename = $(this).val();
            var fullname = filename.slice(12,filename.length)
            $('#custom-text').html(fullname);
        });
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
