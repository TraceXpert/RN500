<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use common\models\LeadRecruiterJobSeekerMapping;
use kartik\icons\FontAwesomeAsset;
use kartik\rating\StarRating;

FontAwesomeAsset::register($this);
?>
<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h1>Track My Application</h1>
            </div>
        </div>

    </div>
</section>
<!-- Page Title End -->

<section class="about-us about-inner-block">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="table-design table-responsive">
                    <?php Pjax::begin(['id' => 'pjx_my_application', 'timeout' => false, 'enablePushState' => false]); ?>

                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'tableOptions' => ['class' => 'table table-bordered'],
                        'layout' => "<p>{summary}</p>\n{items}\n{pager}",
                        'summaryOptions' => ['class' => 'showing'],
                        'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                'attribute' => 'leadTitleWithRef',
                                'format' => 'raw',
                                'enableSorting' => false,
                                'value' => function($model) {
                                    return Html::a($model->leadTitleWithRef, Yii::$app->urlManager->createAbsoluteUrl(['/browse-jobs/view', 'id' => $model->lead->reference_no]), ['target' => '_blank', 'data-pjax' => 0, 'class' => 'theme-primary-color']);
                                },
                                'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                            ],
                                [
                                'attribute' => 'cityName',
                                'enableSorting' => false,
                                'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                            ],
                                [
                                'attribute' => 'recruiterComapnyWithBranch',
                                'enableSorting' => false,
                                'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                            ],
                                [
                                'attribute' => 'statusText',
                                'enableSorting' => false,
                                'filter' => Html::activeDropDownList($searchModel, 'statusText', LeadRecruiterJobSeekerMapping::getStatusList(), ['prompt' => 'All', 'class' => 'form-control']),
                                'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                            ],
                                [
                                'attribute' => 'rating',
                                'format' => 'raw',
                                'enableSorting' => false,
                                'value' => function($model) {

                                    return StarRating::widget([
                                                'name' => 'rating',
                                                'value' => $model->rating,
                                                'pluginOptions' => [
                                                    'filledStar' => '&#x2605;',
                                                    'emptyStar' => '&#x2606;',
                                                    'showCaption' => false,
                                                    'showClear' => false
                                                ],
                                                'pluginEvents' => [
                                                    'rating:change' => "function(event, value, caption) {
                                                                setRatingTo('$model->lead_id',value);
                                                        }",
                                                ],
                                    ]);
                                },
                                'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
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
    function setRatingTo(leadId,rating){
        $.ajax({
            method: "POST",
            url: '$addRatingUrl',
            data: {leadId:leadId, rating: rating}
        }).done(function( res ) {
            $.pjax.reload({container:'#pjx_my_application', timeout:false, async:false})
        });
    }
JS;
$this->registerJS($script_new, 1);
?>