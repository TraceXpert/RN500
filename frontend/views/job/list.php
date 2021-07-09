<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use kartik\icons\FontAwesomeAsset;
use common\CommonFunction;
use kartik\date\DatePicker;



?>
<!--<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h1>Track My Application</h1>
            </div>
        </div>

    </div>
</section>-->
<!-- Page Title End -->

<section class="about-us about-inner-block">
    <div class="container">

        
        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['job/post'])?>" class="read-more contact-us mb-3 mt-2 pull-right theme-primary-color theme-primary-border"> Post A New Job</a>
                
                <div class="table-design table-responsive">
                    <?php Pjax::begin(['id' => 'pjx_lead_posted', 'timeout' => false, 'enablePushState' => false]); ?>

                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'tableOptions' => ['class' => 'table table-bordered'],
                        'layout' => "<p>{summary}</p>\n{items}\n{pager}",
                        'summaryOptions' => ['class' => 'showing'],
                        'columns' => [
                                ['class' => 'yii\grid\SerialColumn',
                                'headerOptions' => ['style' => 'width:1%'],
                            ],
                                [
                                'attribute' => 'leadTitleWithRef',
                                'headerOptions' => ['style' => 'width:25%'],
                                'format' => 'raw',
                                'enableSorting' => false,
                                'value' => function($model) {
                                    return Html::a($model->leadTitleWithRef, Yii::$app->urlManager->createAbsoluteUrl(['/browse-jobs/view', 'id' => $model->reference_no]), ['target' => '_blank', 'data-pjax' => 0, 'class' => 'theme-primary-color']);
                                },
                                'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                            ],
                                [
                                'attribute' => 'start_date',
//                                'visible' => CommonFunction::isEmployer(),
                                'headerOptions' => ['style' => 'width:15%'],
                                'enableSorting' => false,
                                'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                'value' => function($model) {
                                    return CommonFunction::getAPIDateDisplayFormat($model->start_date);
                                },
                                'filter' => DatePicker::widget([
                                    'attribute' => 'start_date',
                                    'model' => $searchModel,
                                    'type' => DatePicker::TYPE_INPUT,
                                    'options' => ['readonly' => true],
                                    'pluginOptions' => [
                                        'clearBtn' => true,
                                        'autoclose' => true,
                                        'format' => Yii::$app->params['date.format.datepicker.js'],
                                    ]
                                ])
                            ],
                        ],
                    ]);
                    ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
$addRatingUrl = Yii::$app->urlManager->createAbsoluteUrl(['browse-jobs/set-rating']);
$script_new = <<<JS
//    function setRatingTo(leadId,rating){
//        $.ajax({
//            method: "POST",
//            url: '$addRatingUrl',
//            data: {leadId:leadId, rating: rating}
//        }).done(function( res ) {
//            $.pjax.reload({container:'#pjx_lead_posted', timeout:false, async:false})
//        });
//    }
JS;
$this->registerJS($script_new, 1);
?>