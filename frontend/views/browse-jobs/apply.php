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

        <div class="row">
            <div class="col-md-12">
                <div class="table-design table-responsive">
                    <?php Pjax::begin(['id' => 'pjx_xompany_branch_selection', 'enablePushState' => false, 'timeout' => false]); ?>

                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'tableOptions' => ['class' => 'table table-bordered'],
                        'summaryOptions' => ['class' => 'showing'],
                        'layout' => "<p>{summary}</p>\n{items}\n{pager}",
                        'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                'attribute' => 'company_name',
                                'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                            ],
                                [
                                'attribute' => 'branch_name',
                                'enableSorting' => false,
                                'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
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
</section>


<?php
$script_new = <<<JS
    function applyToThisbranch(url){
        Swal.fire({
        title: 'Confirm',
        text: "Are you sure, you want to apply this job?",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Apply'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                method: "POST",
                url: url,
            }).done(function( res ) {
                $.pjax.reload({container: '#res-messages', timeout:false, async: false});
                $.pjax.reload({container: '#pjx_xompany_branch_selection', timeout:false, async: false});
            });
        }
      })
    }
JS;
$this->registerJS($script_new, 3);
?>