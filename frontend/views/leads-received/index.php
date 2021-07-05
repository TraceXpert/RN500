<?php

use common\CommonFunction;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use common\models\LeadRecruiterJobSeekerMapping;
use kartik\date\DatePicker;
?>
<section class="inner-banner">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <h1>Applications Received</h1>
            </div>
        </div>

    </div>
</section>

<div class="well-lg"></div>
<section class="about-us about-inner-block leads-tab">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#tab-pending" role="tab" aria-controls="nav-home" aria-selected="true" onClick="reload('pjx_pending')">Pending</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#tab-inprogress" role="tab" aria-controls="nav-profile" aria-selected="false" onClick="reload('pjx_inprogress')">In-progress</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#tab_selected" role="tab" aria-controls="nav-profile" aria-selected="false" onClick="reload('pjx_selected')">Approved</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#tab_rejected" role="tab" aria-controls="nav-profile" aria-selected="false" onClick="reload('pjx_rejected')">Rejected</a>

                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="tab-pending" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="margin-top-20"></div>
                        <div class="table-design table-responsive">

                            <?php Pjax::begin(['id' => 'pjx_pending', 'timeout' => false, 'enablePushState' => false]); ?>
                            <?=
                            GridView::widget([
                                'dataProvider' => $dataProviderPending,
                                'id' => 'grdvw_pending',
                                'tableOptions' => ['class' => 'table table-bordered'],
                                'summaryOptions' => ['class' => 'showing'],
                                'layout' => "<p>{summary}</p>\n{items}\n{pager}",
                                'filterModel' => $searchModelPending,
                                'columns' => [
                                        ['class' => 'yii\grid\SerialColumn',
                                        'headerOptions' => ['style' => 'width:5px']
                                    ],
                                        [
                                        'attribute' => 'leadTitleWithRef',
                                        'value' => function($model) {
                                            return Html::a($model->leadTitleWithRef, Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/browse-jobs/recruiter-view', 'id' => $model->lead_id]), ['data-pjax' => '0', 'target' => '_blank']);
                                        },
                                        'format' => 'raw',
                                        'enableSorting' => false,
                                        'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                    ],
                                        [
                                        'attribute' => 'jobSeekerName',
                                        'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                        'format' => 'raw',
                                        'enableSorting' => false,
                                        'value' => function($model) {
                                            return Html::a($model->jobSeekerName, Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/profile/user-summary', 'ref' => $model->jobSeeker->details->unique_id]), ['data-pjax' => 0, 'target' => '_blank']);
                                        }
                                    ],
                                        [
                                        'attribute' => 'rec_joining_date',
                                        'visible' => CommonFunction::isEmployer(),
                                        'headerOptions' => ['style' => 'width:15%'],
                                        'enableSorting' => false,
                                        'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                        'value' => function($model) {
                                            return ($model->rec_joining_date != '') ? date("d-M-Y", strtotime($model->rec_joining_date)) : '';
                                        },
                                        'filter' => DatePicker::widget([
                                            'attribute' => 'rec_joining_date',
                                            'model' => $searchModelPending,
                                            'type' => DatePicker::TYPE_INPUT,
                                            'options' => ['readonly' => true],
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'dd-M-yyyy',
                                            ]
                                        ])
                                    ],
                                        [
                                        'attribute' => 'cityName',
                                        'enableSorting' => false,
                                        'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                    ],
                                        [
                                        'class' => 'yii\grid\ActionColumn',
                                        'contentOptions' => ['style' => 'width:250px;'],
                                        'header' => 'Actions',
                                        'template' => '{approve} {reject}',
                                        'buttons' => [
                                            'approve' => function ($url, $model) {
                                                $url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['leads-received/approval-form', 'lrj' => $model->id, 'status' => LeadRecruiterJobSeekerMapping::STATUS_APPROVED]);
                                                return Html::a('Approve', 'javascript:void(0)', [
                                                            'url' => $url,
                                                            'modal-title' => 'Approve',
                                                            'data-pjax' => 0,
                                                            'title' => Yii::t('app', 'Approve'),
                                                            'class' => 'btn theme-button-color lead-approve',
                                                ]);
                                            },
                                            'reject' => function ($url, $model) {
                                                $url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['leads-received/approval-form', 'lrj' => $model->id, 'status' => LeadRecruiterJobSeekerMapping::STATUS_REJECTED]);
                                                return Html::a('Reject', 'javascript:void(0)', [
                                                            'url' => $url,
                                                            'modal-title' => 'Reject',
                                                            'data-pjax' => 0,
                                                            'title' => Yii::t('app', 'Reject'),
                                                            'class' => 'btn btn-reject lead-reject',
                                                ]);
                                            }
                                        ],
                                    ],
                                ],
                            ]);
                            ?>

                            <?php Pjax::end() ?>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab-inprogress" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="margin-top-20"></div>
                        <div class="table-design table-responsive">
                            <?php Pjax::begin(['id' => 'pjx_inprogress', 'timeout' => false, 'enablePushState' => false]); ?>
                            <?=
                            GridView::widget([
                                'dataProvider' => $dataProviderInprogress,
                                'id' => 'grdvw_inprogress',
                                'tableOptions' => ['class' => 'table table-bordered'],
                                'summaryOptions' => ['class' => 'showing'],
                                'layout' => "<p>{summary}</p>\n{items}\n{pager}",
                                'filterModel' => $searchModelInprogress,
                                'columns' => [
                                        ['class' => 'yii\grid\SerialColumn',
                                        'headerOptions' => ['style' => 'width:5px']
                                    ],
                                        [
                                        'attribute' => 'leadTitleWithRef',
                                        'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                        'value' => function($model) {
                                            return Html::a($model->leadTitleWithRef, Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/browse-jobs/recruiter-view', 'id' => $model->lead_id]), ['data-pjax' => '0', 'target' => '_blank']);
                                        },
                                        'format' => 'raw',
                                        'enableSorting' => false,
                                        'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                    ],
                                        [
                                        'attribute' => 'jobSeekerName',
                                        'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                        'format' => 'raw',
                                        'enableSorting' => false,
                                        'value' => function($model) {
                                            return Html::a($model->jobSeekerName, Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/profile/user-summary', 'ref' => $model->jobSeeker->details->unique_id]), ['data-pjax' => 0, 'target' => '_blank']);
                                        }
                                    ],
                                        [
                                        'attribute' => 'rec_joining_date',
                                        'visible' => CommonFunction::isRecruiter(),
                                        'headerOptions' => ['style' => 'width:15%'],
                                        'enableSorting' => false,
                                        'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                        'value' => function($model) {
                                            return ($model->rec_joining_date != '') ? date("d-M-Y", strtotime($model->rec_joining_date)) : '';
                                        },
                                        'filter' => DatePicker::widget([
                                            'attribute' => 'rec_joining_date',
                                            'model' => $searchModelInprogress,
                                            'type' => DatePicker::TYPE_INPUT,
                                            'options' => ['readonly' => true],
                                            'pluginOptions' => [
                                                'id' => 'rec_joining_inprogress',
                                                'name' => 'rec_joining_inprogress',
                                                'autoclose' => true,
                                                'format' => 'dd-M-yyyy',
                                            ]
                                        ])
                                    ],
                                        [
                                        'attribute' => 'cityName',
                                        'enableSorting' => false,
                                        'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                    ],
//                                                    [
//                                                    'class' => 'yii\grid\ActionColumn',
//                                                    'contentOptions' => ['style' => 'width:180px;'],
//                                                    'header' => 'Actions',
//                                                    'template' => '{approve} {reject}',
//                                                    'buttons' => [
//                                                        'approve' => function ($url, $model) {
//                                                            return Html::a('Approve', 'javascript:void(0)', [
//                                                                        'data-pjax' => 0,
//                                                                        'title' => Yii::t('app', 'View'),
//                                                                        'class' => 'btn btn-theme-dark',
//                                                            ]);
//                                                        },
//                                                        'reject' => function ($url, $model) {
//                                                            $url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/approval-from-recruiter', 'lrj' => $model->id, 'status' => LeadRecruiterJobSeekerMapping::STATUS_REJECTED]);
//                                                            return Html::a('Reject', 'javascript:void(0)', [
//                                                                        'data-pjax' => 0,
//                                                                        'title' => Yii::t('app', 'View'),
//                                                                        'class' => 'btn btn-danger',
//                                                            ]);
//                                                        }
//                                                    ],
//                                                ],
                                ],
                            ]);
                            ?>
                            <?php Pjax::end() ?>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab_selected" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="margin-top-20"></div>
                        <div class="table-design table-responsive">
                            <?php Pjax::begin(['id' => 'pjx_selected', 'timeout' => false, 'enablePushState' => false]); ?>
                            <?=
                            GridView::widget([
                                'dataProvider' => $dataProviderSelected,
                                'filterModel' => $searchModelSelected,
                                'tableOptions' => ['class' => 'table table-bordered'],
                                'summaryOptions' => ['class' => 'showing'],
                                'layout' => "<p>{summary}</p>\n{items}\n{pager}",
                                'id' => 'grdvw_selected',
                                'columns' => [
                                        ['class' => 'yii\grid\SerialColumn',
                                        'headerOptions' => ['style' => 'width:5px']
                                    ],
                                        [
                                        'attribute' => 'leadTitleWithRef',
                                        'value' => function($model) {
                                            return Html::a($model->leadTitleWithRef, Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/browse-jobs/recruiter-view', 'id' => $model->lead_id]), ['data-pjax' => '0', 'target' => '_blank']);
                                        },
                                        'format' => 'raw',
                                        'enableSorting' => false,
                                        'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                    ],
                                        [
                                        'attribute' => 'rec_joining_date',
                                        'format' => 'html',
                                        'headerOptions' => ['style' => 'width:15%'],
                                        'enableSorting' => false,
                                        'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                        'value' => function($model) {
                                            return ($model->rec_joining_date != '') ? date("d-M-Y", strtotime($model->rec_joining_date)) : '';
                                        },
                                        'filter' => DatePicker::widget([
                                            'attribute' => 'rec_joining_date_selected',
                                            'model' => $searchModelSelected,
                                            'type' => DatePicker::TYPE_INPUT,
                                            'options' => ['readonly' => true],
                                            'pluginOptions' => [
                                                'autoclose' => true,
                                                'format' => 'dd-M-yyyy',
                                            ]
                                        ])
                                    ],
                                        [
                                        'attribute' => 'jobSeekerName',
                                        'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                        'format' => 'raw',
                                        'enableSorting' => false,
                                        'value' => function($model) {
                                            return Html::a($model->jobSeekerName, Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/profile/user-summary', 'ref' => $model->jobSeeker->details->unique_id]), ['data-pjax' => 0, 'target' => '_blank']);
                                        }
                                    ],
                                        [
                                        'attribute' => 'cityName',
                                        'enableSorting' => false,
                                        'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                    ],
//                                                    [
//                                                    'class' => 'yii\grid\ActionColumn',
//                                                    'contentOptions' => ['style' => 'width:180px;'],
//                                                    'header' => 'Actions',
//                                                    'template' => '{approve} {reject}',
//                                                    'buttons' => [
//                                                        'approve' => function ($url, $model) {
//                                                            return Html::a('Approve', 'javascript:void(0)', [
//                                                                        'data-pjax' => 0,
//                                                                        'title' => Yii::t('app', 'View'),
//                                                                        'class' => 'btn btn-theme-dark',
//                                                            ]);
//                                                        },
//                                                        'reject' => function ($url, $model) {
//                                                            $url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/approval-from-recruiter', 'lrj' => $model->id, 'status' => LeadRecruiterJobSeekerMapping::STATUS_REJECTED]);
//                                                            return Html::a('Reject', 'javascript:void(0)', [
//                                                                        'data-pjax' => 0,
//                                                                        'title' => Yii::t('app', 'View'),
//                                                                        'class' => 'btn btn-danger',
//                                                            ]);
//                                                        }
//                                                    ],
//                                                ],
                                ],
                            ]);
                            ?>

                            <?php Pjax::end() ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_rejected" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="margin-top-20"></div>
                        <div class="table-design table-responsive">
                            <?php Pjax::begin(['id' => 'pjx_rejected', 'timeout' => false, 'enablePushState' => false]); ?>
                            <?=
                            GridView::widget([
                                'dataProvider' => $dataProviderRejected,
                                'filterModel' => $searchModelRejected,
                                'tableOptions' => ['class' => 'table table-bordered'],
                                'summaryOptions' => ['class' => 'showing'],
                                'layout' => "<p>{summary}</p>\n{items}\n{pager}",
                                'id' => 'grdvw_rejected',
                                'columns' => [
                                        ['class' => 'yii\grid\SerialColumn',
                                        'headerOptions' => ['style' => 'width:5px']
                                    ],
                                        [
                                        'attribute' => 'leadTitleWithRef',
                                        'value' => function($model) {
                                            return Html::a($model->leadTitleWithRef, Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/browse-jobs/recruiter-view', 'id' => $model->lead_id]), ['data-pjax' => '0', 'target' => '_blank']);
                                        },
                                        'format' => 'raw',
                                        'enableSorting' => false,
                                        'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                    ],
                                        [
                                        'attribute' => 'jobSeekerName',
                                        'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                        'format' => 'raw',
                                        'enableSorting' => false,
                                        'value' => function($model) {
                                            return Html::a($model->jobSeekerName, Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/profile/user-summary', 'ref' => $model->jobSeeker->details->unique_id]), ['data-pjax' => 0, 'target' => '_blank']);
                                        }
                                    ],
                                        [
                                        'attribute' => 'cityName',
                                        'enableSorting' => false,
                                        'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                    ],
//                                                    [
//                                                    'class' => 'yii\grid\ActionColumn',
//                                                    'contentOptions' => ['style' => 'width:180px;'],
//                                                    'header' => 'Actions',
//                                                    'template' => '{approve} {reject}',
//                                                    'buttons' => [
//                                                        'approve' => function ($url, $model) {
//                                                            return Html::a('Approve', 'javascript:void(0)', [
//                                                                        'data-pjax' => 0,
//                                                                        'title' => Yii::t('app', 'View'),
//                                                                        'class' => 'btn btn-theme-dark',
//                                                            ]);
//                                                        },
//                                                        'reject' => function ($url, $model) {
//                                                            $url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['browse-jobs/approval-from-recruiter', 'lrj' => $model->id, 'status' => LeadRecruiterJobSeekerMapping::STATUS_REJECTED]);
//                                                            return Html::a('Reject', 'javascript:void(0)', [
//                                                                        'data-pjax' => 0,
//                                                                        'title' => Yii::t('app', 'View'),
//                                                                        'class' => 'btn btn-danger',
//                                                            ]);
//                                                        }
//                                                    ],
//                                                ],
                                ],
                            ]);
                            ?>
                            <?php Pjax::end() ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>





<?php
$script_new = <<<JS
    $(document).on("click", ".lead-approve, .lead-reject", function() {
        $(".modal-title").text($(this).attr('modal-title'));
        $("#commonModal").modal('show').find("#modalContent").load($(this).attr('url'));
        
    });
    
    function reload(id){
            $.pjax.reload({container:'#'+id, timeout:false, async:false});
    }
// reload('pjx_pending');
JS;
$this->registerJS($script_new, 3);
?>