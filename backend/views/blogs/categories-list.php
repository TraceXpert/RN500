<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\CommonFunction;

$loggedInUser = Yii::$app->user->identity->id;
?>
<div class="card card-default color-palette-box">
    <div class="card-body">

        <?php if (CommonFunction::checkAccess('blog-create', $loggedInUser) || CommonFunction::checkAccess('blog-update', $loggedInUser)) { ?>
            <div class="row">
                <div class="col-12">
                    <?= Html::a('Add New Category', ['category-add'], ['class' => 'btn btn-primary float-right']) ?>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive-sm">

                    <?php Pjax::begin(['id' => 'pjx_blog_categories', 'enablePushState' => false, 'timeout' => false]); ?>

                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                                [
                                'attribute' => 'name',
                                'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                            ],
                                [
                                'headerOptions' => ['style' => 'width:12%'],
                                'attribute' => 'status',
                                'filter' => Html::activeDropDownList($searchModel, 'status', Yii::$app->params['BLOG_CATEGORY_STATUS'], ['class' => 'form-control', 'prompt' => 'All']),
                                'filterOptions' => ['autocomplete' => 'off'],
                                'value' => function($model) {
                                    return $model->getStatusText();
                                }
                            ],
                                [
                                'class' => 'yii\grid\ActionColumn',
                                'visible'=>(CommonFunction::checkAccess('blog-create', $loggedInUser) || CommonFunction::checkAccess('blog-update', $loggedInUser)),
                                'header' => 'Actions',
                                'headerOptions' => ['style' => 'width:8%', 'class' => 'text-primary'],
                                'template' => '
                                <div class="btn-group">
                                    <span class="clickable p-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:18px">
                                        <i class="fa fa-bars text-primary" aria-hidden="true"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right" >
                                      {update}
                                    </div>
                              </div>
                ',
                                'buttons' => [
                                    'update' => function ($url, $model) use ($loggedInUser) {
                                        if (CommonFunction::checkAccess('blog-create', $loggedInUser) || CommonFunction::checkAccess('blog-update', $loggedInUser)) {
                                            $url = Yii::$app->urlManagerAdmin->createAbsoluteUrl(['blogs/category-update', 'id' => $model->id]);
                                            return Html::a('Update', $url, [
                                                        'data-pjax' => 0,
                                                        'title' => Yii::t('app', 'Update'),
                                                        'class' => 'dropdown-item  btn btn-primary',
                                            ]);
                                        }
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
    </div>
</div>



