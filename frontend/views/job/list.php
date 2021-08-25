<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use kartik\icons\FontAwesomeAsset;
use common\CommonFunction;
use kartik\date\DatePicker;
?>

<section class="about-us about-inner-block">
    <div class="container">


        <div class="row">
            <div class="col-md-12">
                <a href="<?php echo Yii::$app->urlManagerFrontend->createAbsoluteUrl(['job/post']) ?>" class="read-more contact-us mb-3 mt-2 pull-right theme-primary-color theme-primary-border"> Post A New Job</a>

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
                                'attribute' => 'branch_name',
                                    'label' =>'Location',
                                'visible'=> CommonFunction::isHoAdmin(Yii::$app->user->id),
                                'headerOptions' => ['style' => 'width:25%'],
                                'format' => 'raw',
                                'enableSorting' => false,
                                'value' => function($model) {
                                    return isset($model->branch->branch_name)? $model->branch->branch_name :'';
                                },
                                'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                            ],
                                [
                                'attribute' => 'leadTitleWithRef',
                                'headerOptions' => ['style' => 'width:25%'],
                                'format' => 'raw',
                                'enableSorting' => false,
                                'value' => function($model) {
                                    return Html::a($model->leadTitleWithRef, Yii::$app->urlManagerFrontend->createAbsoluteUrl(['/browse-jobs/view', 'id' => $model->reference_no]), ['target' => '_blank', 'data-pjax' => 0, 'class' => 'theme-primary-color']);
                                },
                                'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                            ],
                                [
                                'attribute' => 'start_date',
//                                'visible' => CommonFunction::isEmployer(),
                                'headerOptions' => ['style' => 'width:5%'],
                                'enableSorting' => false,
                                'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                'value' => function($model) {
                                    return CommonFunction::getAPIDateDisplayFormat($model->start_date, Yii::$app->params['date.format.display.php']);
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
                                [
                                'attribute' => 'end_date',
//                                'visible' => CommonFunction::isEmployer(),
                                'headerOptions' => ['style' => 'width:5%'],
                                'enableSorting' => false,
                                'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                'value' => function($model) {
                                    return CommonFunction::getAPIDateDisplayFormat($model->end_date, Yii::$app->params['date.format.display.php']);
                                },
                                'filter' => DatePicker::widget([
                                    'attribute' => 'end_date',
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
                                [
                                'attribute' => 'is_suspended',
//                                'visible' => CommonFunction::isEmployer(),
                                'label'=>'Is Suspended',
                                'headerOptions' => ['style' => 'width:2%'],
                                'enableSorting' => false,
                                'filterInputOptions' => ['autocomplete' => 'off',],
                                'value' => function($model) {
                                    return isset(Yii::$app->params['LEAD_SUSPENDED'][$model->is_suspended]) ? Yii::$app->params['LEAD_SUSPENDED'][$model->is_suspended] :"";
                                },
                                'filter' => Html::activeDropDownList($searchModel, 'is_suspended', Yii::$app->params['LEAD_SUSPENDED'], ['prompt'=>'All', 'class' => 'form-control'])
                            ],
                                [
                                'class' => 'yii\grid\ActionColumn',
                                'contentOptions' => ['style' => 'width:2%;'],
                                'header' => 'Actions',
                                'template' => '{edit} {reject}',
                                'buttons' => [
                                    'edit' => function ($url, $model) {
                                        $url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['job/post', 'ref' => $model->reference_no]);
                                        return Html::a('Edit', $url, [
                                                    'url' => $url,
                                                    'modal-title' => 'Approve',
                                                    'data-pjax' => 0,
                                                    'title' => Yii::t('app', 'Approve'),
                                                    'class' => 'btn theme-button-color lead-approve',
                                        ]);
                                    },
//                                    'reject' => function ($url, $model) {
//                                        $url = Yii::$app->urlManagerFrontend->createAbsoluteUrl(['leads-received/approval-form', 'lrj' => $model->id]);
//                                        return Html::a('Reject', 'javascript:void(0)', [
//                                                    'url' => $url,
//                                                    'modal-title' => 'Reject',
//                                                    'data-pjax' => 0,
//                                                    'title' => Yii::t('app', 'Reject'),
//                                                    'class' => 'btn btn-reject lead-reject',
//                                        ]);
//                                    }
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
