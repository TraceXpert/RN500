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
    .select2-container--krajee-bs4 .select2-selection--single{height: 50px;padding: .375rem 2rem;background: #FFFFFF;border-radius: 6px;box-shadow: none;color: #495057;}
    .select2-container--krajee-bs4 .select2-selection--single .select2-selection__rendered{padding: .375rem 2rem;}
    .button-wrapper {position: relative;}
    .button-wrapper span.label {position: relative;z-index: 0;display: inline-block;width: 150px;background: #1756a0;cursor: pointer;color: #fff;padding: 15px 0;text-transform:uppercase;font-size:12px;border-radius: 15px;text-align: center;}
    #licenses-document {display: inline-block;position: absolute;z-index: 1;width: 100%;height: 50px;top: 0;left: 0;opacity: 0;cursor: pointer;}
</style>
<div class="user-details-form">
    <?php
    $form = ActiveForm::begin([
                'id' => 'add-licenses',
                'options' => ['autocomplete' => 'off', 'enctype' => 'multipart/form-data']
    ]);
    ?>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'license_name')->dropDownList(Yii::$app->params['LICENSE_TYPE'], ['prompt' => 'Select Name']); ?>
        </div>
    </div>
    <div class="row mb-15">
        <div class="col-sm-12">
            <!--<label class="control-label" for="issuing_state">Issuing State</label>-->
            <ul class="optionlist">
                <?php
                $url = Url::to(['site/get-cities']);
                
                echo $form->field($model, 'issuing_state')->widget(Select2::classname(),[
                    'name' => 'issuing_state',
                    'value' => isset($model->issuing_state) && !empty($model->issuing_state) ? $model->issuing_state : '',
                    'data' => $selectedLocations,
                    'options' => [
                        'id' => 'issuing_state_location',
                        'placeholder' => 'Select Location...',
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
    <div class="row">
        <div class="col-sm-12">
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
            <?= $form->field($model, 'license_number')->textInput(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'issue_by')->textInput(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 filter-accordion mb-15">
            <?=
            $form->field($model, 'compact_states', [
                'template' => '<input type="checkbox" name="Licenses[compact_states]" id="two"><label for="two">Compact States</label>{error}'
            ])->checkbox();
            ?>
        </div>
    </div>
    <div class="row mb-15">
        <div class="col-sm-12">
            <label>Upload Document</label>
            <?= $form->field($model, 'document', ['template' => '<div class="button-wrapper"><span class="label">Upload Document</span>{input}</button>{error}'])->fileInput() ?>

            <?php if ($isRecordFlag) { ?>
                <?php if (!empty($model->document) && file_exists(CommonFunction::getLicensesBasePath() . "/" . $model->document)) { ?>
                    <a href="<?= $frontendDir . "/uploads/user-details/license/" . $model->document ?>" download><?= $model->document ?></a>
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
$compact_states = isset($model->compact_states) ? $model->compact_states : '';
if ($isRecordFlag) {
    $DeleteUrl = Yii::$app->urlManagerFrontend->createUrl(['user-details/delete-document?id=' . $model->id]);
}

$script = <<< JS
        
  var compact_states = '$compact_states';
   
  if(compact_states == '1'){
       $('#two').attr('checked',true);
  }

   
        $('#licenses-document').change(function() {
            var filename = $(this).val();
            var fullname = filename.slice(12,filename.length)
            $('#custom-text').html(fullname);
        });
  
  var click = 0;
  $(document).on("beforeSubmit", "#add-licenses", function () {
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
        
//                         $.pjax.reload({container: "#job-seeker", 'timeout': false});
//                         $(document).on("pjax:success", "#job-seeker", function (event) {
//                             $.pjax.reload({'container': '#res-messages', 'timeout': false});
//                         });
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
  
//var realFileBtn = document.getElementById("real-file-document");
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
