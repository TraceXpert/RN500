<?php

use common\CommonFunction;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use common\models\LeadRecruiterJobSeekerMapping;

$lead_id = $model->id;
?>
<!-- Page Title start -->
<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h1>Job Apply</h1>
            </div>
        </div>

    </div>
</section>
<!-- Page Title End -->


<section class="about-us about-inner-block">
    <div class="container">
        <!--        <div class="row align-items-center">
                    <div class="col-lg-12 main-title">
                        <h2 class="mb-4">Job Applied</h2>
                    </div>
                </div>-->

        <div class="row">
            <div class="col-md-12">
                <div class="table-design table-responsive">
                    <?php Pjax::begin(); ?>

                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'tableOptions' => ['class' => 'table table-bordered'],
                        'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                            'company_name',
                                [
                                'attribute' => 'branch_name',
                                'enableSorting' => false
                            ],
                                [
                                'class' => 'yii\grid\ActionColumn',
                                'contentOptions' => ['style' => 'width:5%;'],
                                'header' => 'Actions',
                                'template' => '{proceed}',
                                'buttons' => [
                                    //view button
                                    'proceed' => function ($url, $model) use ($lead_id) {
                                        if (!$model->is_already_applied) {
                                            $url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/apply-job', 'lead_id' => $lead_id, 'branch_id' => $model->id]);
                                            return Html::a('Proceed', 'javascript:void(0)', [
                                                        'onclick' => "applyToThisbranch('$url')",
                                                        'data-pjax' => 0,
                                                        'title' => Yii::t('app', 'Proceed'),
                                                        'class' => 'read-more',
                                            ]);
                                        } else {
                                            return Html::a('Applied', 'javascript:void(0)', [
                                                        'data-pjax' => 0,
                                                        'title' => Yii::t('app', 'Applied'),
                                                        'class' => 'already-applied',
                                            ]);
                                        }
                                    }
                                ],
                            ],
                        ],
                    ]);
                    ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>


    <?php
    $script_new = <<<JS
    function applyToThisbranch(url){
        
        swal("Are you sure, you want to apply this job?",{
            buttons: ["Cancel", "Yes!"],
        }).then((value) => {
            if(value){
                $('#overlay').show();
                $.ajax({
                    method: "POST",
                    url: url,
                }).done(function( res ) {
                    $('#overlay').hide();
                });
            }
        });
    }
JS;
    $this->registerJS($script_new, 3);
    ?>