<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\date\DatePicker;
use common\CommonFunction;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdvertisementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$location = [0 => 'Ahemdabad', 1 => 'Mumbai'];
$status = [0 => 'No', 1 => 'Yes'];

$this->title = 'Advertisements';
$this->params['breadcrumbs'][] = $this->title;
$jsFormat = Yii::$app->params['date.format.datepicker.js'];
?>

<div class="card card-default color-palette-box">
    <div class="card-body">

        <div class="col-12">
            <?= Html::a('Create Advertisement', ['create'], ['class' => 'btn btn-primary float-right']) ?>

            <div class="table table-responsive pt-3">
                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>

                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                        'name',
                        'description:ntext',
                        'link_url:url',
                            [
                            'attribute' => 'is_active',
                            'value' => function ($model) use ($status) {
                                return isset($model->is_active) ? $status[$model->is_active] : '';
                            },
                            'filter' => \yii\bootstrap\Html::activeDropDownList($searchModel, 'is_active', ['' => 'All', '1' => 'Yes', '2' => 'No'], ['class' => 'form-control'])
                        ],
                            [
                            'attribute' => 'active_from',
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'width:15%;'],
                            'filter' => DatePicker::widget([
                                'model' => $searchModel,
                                'attribute' => 'active_from',
                                'options' => ["style" => "cursor:pointer", 'readonly' => true],
                                'layout' => '<div class="input-group-prepend"></div>
                            {picker}
                            <div class="input-group-append"></div>
                            {input}
                            <div class="input-group-append"></div>
                            {remove}',
                                'pluginOptions' => [
                                    'autoclose' => true,
                                    'todayHighlight' => true,
                                    'format' => $jsFormat,
                                ]
                            ]),
                            'value' => function ($model) {
//                                return date('M-d-Y', strtotime($model->active_from));
                                return CommonFunction::getAPIDateDisplayFormat($model->active_from, Yii::$app->params['date.format.display.php']);
                            },
                        ],
                            [
                            'attribute' => 'active_to',
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'width:15%;'],
                            'filter' => DatePicker::widget([
                                'model' => $searchModel,
                                'attribute' => 'active_to',
                                'options' => ["style" => "cursor:pointer", 'readonly' => true],
                                'layout' => '<div class="input-group-prepend"></div>
                            {picker}
                            <div class="input-group-append"></div>
                            {input}
                            <div class="input-group-append"></div>
                            {remove}',
                                'pluginOptions' => [
                                    'autoclose' => true,
//                                'startDate' => date(),
//                                'endDate' => "0d",
                                    'todayHighlight' => true,
                                    'format' => $jsFormat,
                                ]
                            ]),
                            'value' => function ($model) {
                                return CommonFunction::getAPIDateDisplayFormat($model->active_to, Yii::$app->params['date.format.display.php']);
                            },
                        ],
                            [
                            'class' => 'yii\grid\ActionColumn',
                            'contentOptions' => ['style' => 'width:10%;'],
                            'header' => 'Actions',
                            'template' => '{view} {update}',
                            'buttons' => [
                                //view button
                                'view' => function ($url, $model) {
                                    return Html::a('<span class="fa fa-eye"></span>', $url, [
                                                'data-pjax' => 0,
                                                'title' => Yii::t('app', 'View'),
                                                'class' => 'btn btn-primary btn-xs',
                                    ]);
                                },
                                'update' => function ($url, $model) {
                                    return Html::a('<span class="fa fa-edit"></span>', $url, [
                                                'data-pjax' => 0,
                                                'title' => Yii::t('app', 'Update'),
                                                'class' => 'btn btn-primary btn-xs',
                                    ]);
                                },
                            ],
                        ],
                    ],
                ]);
                ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
