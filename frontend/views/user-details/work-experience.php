<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserDetails */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .mb-15{margin-bottom: 15px;}
    .optionlist{margin-left:-40px;}
    .select2-container--krajee-bs4 .select2-selection--single{
        height: 50px;
        padding: .375rem 2rem;
        background: #FFFFFF;
        border-radius: 6px;
        box-shadow: none;
        color: #495057;
    }
    .select2-container--krajee-bs4 .select2-selection--single .select2-selection__rendered{
        padding: .375rem 2rem;
    }
</style>
<div class="user-details-form">
    <?php
    $form = ActiveForm::begin([
                "id" => "work-experience-new",
                'options' => ['autocomplete' => 'off']
    ]);
    ?>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'discipline_id')->dropDownList($discipline); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'specialty')->dropDownList($speciality); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'employment_type')->dropDownList(Yii::$app->params['EMPLOYEMENT_TYPE']); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 filter-accordion mb-15">
            <?= $form->field($model, 'currently_working', ['template' => '<input type="checkbox" name="currently_working" id="one" class="is_active" value="1" ><label for="one">Currently Working</label>'])->checkbox(['id' => 'currently_working']); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php
            echo $form->field($model, 'start_date')->widget(DatePicker::classname(), [
                'name' => 'start_date',
                'value' => date('d-M-Y'),
                'type' => DatePicker::TYPE_INPUT,
                'options' => ['placeholder' => $model->getAttributeLabel('start_date'), 'readonly' => true],
                'pluginOptions' => [
                    'format' => 'mm-yyyy',
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'minViewMode' => 'months',
                    'startView' => 'year',
                ],
                'pluginEvents' => [
                    "changeDate" => "function(e) {
                                $('#workexperience-end_date').kvDatepicker({                  
                                    minViewMode : 'months',
                                    startView : 'year',
                                    autoclose : true,
                                    format : 'mm-yyyy'
                                });
                                $('#workexperience-end_date').kvDatepicker('setStartDate', e.date);
                            }"
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php
            echo $form->field($model, 'end_date')->widget(DatePicker::classname(), [
                'name' => 'end_date',
                'value' => date('d-M-Y'),
                'type' => DatePicker::TYPE_INPUT,
                'options' => ['placeholder' => $model->getAttributeLabel('end_date'), 'readonly' => true],
                'pluginOptions' => [
                    'format' => 'mm-yyyy',
                    'todayHighlight' => true,
                    'autoclose' => true,
                    'startDate' => date('d-m-Y'),
                    'minViewMode' => 'months',
                    'startView' => 'year',
                ],
                'pluginEvents' => [
                    "changeDate" => "function(e) {
                                $('#workexperience-start_date').kvDatepicker({                  
                                    minViewMode : 'months',
                                    startView : 'year',
                                    autoclose : true,
                                    format : 'mm-yyyy'
                                });
                                $('#workexperience-start_date').kvDatepicker('setEndDate', e.date);
                            }"
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'facility_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row mb-15">
        <div class="col-sm-12">
            <label class="control-label" for="city">City</label>
            <ul class="optionlist">
                <?php
                $url = Url::to(['browse-jobs/get-cities']);
                echo Select2::widget([
                    'name' => 'city',
                    'value' => isset($model->city) && !empty($model->city) ? $model->city : '',
                    'data' => $selectedLocations,
                    'options' => [
                        'id' => 'select_city',
                        'placeholder' => 'Select City',
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

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'read-more contact-us mb-3 mt-2']) ?>
        <button type="button" class="btn btn-secondary pop-up-close-button" data-dismiss="modal">Close</button>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$currently_working = isset($model->currently_working) ? $model->currently_working : '';

$script = <<< JS
  var currently_working = '$currently_working';
   
  if(currently_working == '1'){
      $('#workexperience-end_date').attr('disabled',true);
       $('.is_active').attr('checked',true);
        $('#workexperience-end_date').css('cursor','not-allowed');
  }      
        
  $('.field-currently_working input').change(function() {
        if($(this).is(":checked")) {
            $('#workexperience-end_date').val('');
            $('#workexperience-end_date').attr('disabled',true);
            $('#workexperience-end_date').css('cursor','not-allowed');
        } else {
            $('#workexperience-end_date').attr('disabled',false);
            $('#workexperience-end_date').removeAttr('style');
        }        
    });
        
  var click=0;
  $(document).on("beforeSubmit", "#work-experience-new", function () {
       if(click==0){
            ++click;
            var form = $(this);
             $.ajax({
                 url    : form.attr('action'),
                 type   : 'post',
                 dataType : 'json',
                 data   : form.serialize(),
                 success: function (response){
                     try{
                         if(!response.error){
                             $("#commonModal").modal('hide');
                             $.pjax.reload({container: "#job-seeker", timeout: false, async:false});
                             $.pjax.reload({'container': '#res-messages', timeout: false, async:false});
                            
//                             $.pjax.reload({container: "#job-seeker", timeout: 2000});
//                             $(document).on("pjax:success", "#job-seeker", function (event) {
//                                 $.pjax.reload({'container': '#res-messages', timeout: 2000});
//                             });
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
        
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>        




