<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\NewsletterMaster;
use common\CommonFunction;

$loggedInUser = Yii::$app->user->identity->id;
?>

<div class="card card-default color-palette-box">
    <div class="card-body">

        <?php if (CommonFunction::checkAccess('newsletter-create', $loggedInUser)) { ?>
            <div class="row">
                <div class="col-12">
                    <?= Html::a('Add New Newsletter', ['add'], ['class' => 'btn btn-primary float-right mb-3']) ?>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive-sm">

                    <?php
                    Pjax::begin([
                        'id' => 'pjx_newsletter_list',
                        'timeout' => false,
                        'enablePushState' => false
                    ]);
                    ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            [
                                'attribute' => 'title',
                                'format' => 'raw',
                                'filterInputOptions' => ['autocomplete' => 'off', 'class' => 'form-control'],
                                'value' => function($model) {
                                    return Html::a($model->title, Yii::$app->urlManager->createAbsoluteUrl(['newsletter/view', 'id' => $model->id]), ['data-pjax' => 0]);
                                }
                            ],
                            [
                                'headerOptions' => ['style' => 'width:12%'],
                                'attribute' => 'statusText',
                                'label' => 'Suspend',
                                'filter' => Html::activeDropDownList($searchModel, 'statusText', Yii::$app->params['NEWSLETTER_SUSPENDED'], ['class' => 'form-control', 'prompt' => 'All']),
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Actions',
                                'headerOptions' => ['style' => 'width:8%', 'class' => 'text-primary'],
                                'template' => '
                                <div class="btn-group">
                                    <span class="clickable p-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:18px">
                                        <i class="fa fa-bars text-primary" aria-hidden="true"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right" >
                                      {view}
                                      {update}
                                      {suspend}
                                    </div>
                                </div>',
                                'buttons' => [
                                    //view button
                                    'view' => function ($url, $model) {
                                        return Html::a('Detail View', $url, [
                                                    'data-pjax' => 0,
                                                    'title' => Yii::t('app', 'View'),
                                                    'class' => 'dropdown-item btn btn-primary',
                                        ]);
                                    },
                                    'update' => function ($url, $model) use ($loggedInUser) {
                                        if (CommonFunction::checkAccess("newsletter-update", $loggedInUser) || CommonFunction::checkAccess("newsletter-create", $loggedInUser)) {
                                            return Html::a('Update', $url, [
                                                        'data-pjax' => 0,
                                                        'title' => Yii::t('app', 'Update'),
                                                        'class' => 'dropdown-item  btn btn-primary',
                                            ]);
                                        }
                                    },
                                    'suspend' => function ($url, $model) use ($loggedInUser) {
                                        if (CommonFunction::checkAccess("newsletter-suspend", $loggedInUser) || CommonFunction::checkAccess("newsletter-update", $loggedInUser) || CommonFunction::checkAccess("newsletter-create", $loggedInUser)) {
                                            if ($model->status == NewsletterMaster::IS_SUSPENDED_YES) {
                                                $url = Yii::$app->urlManager->createAbsoluteUrl(['newsletter/suspend', 'id' => $model->id, 'status' => NewsletterMaster::IS_SUSPENDED_NO]);
                                                return Html::a('Remove suspension', 'javascript:void(0)', [
                                                            'data-url' => $url,
                                                            'data-pjax' => 0,
                                                            'data-confirm-text' => "Are you sure you want to remove suspension?",
                                                            'title' => Yii::t('app', 'Remove suspension'),
                                                            'class' => 'dropdown-item  btn btn-primary suspension',
                                                ]);
                                            } else if ($model->status == NewsletterMaster::IS_SUSPENDED_NO) {
                                                $url = Yii::$app->urlManager->createAbsoluteUrl(['newsletter/suspend', 'id' => $model->id, 'status' => NewsletterMaster::IS_SUSPENDED_YES]);
                                                return Html::a('Suspend', 'javascript:void(0)', [
                                                            'data-url' => $url,
                                                            'data-pjax' => 0,
                                                            'data-confirm-text' => "Are you sure you want to suspend?",
                                                            'title' => Yii::t('app', 'Suspend'),
                                                            'class' => 'dropdown-item  btn btn-primary suspension',
                                                ]);
                                            }
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
    <!-- /.card-body -->
</div>


<?php
$script = <<< JS
  
   $(document).on('click','.suspension',function(){
        if(confirm($(this).data('confirm-text'))){
            var state=$(this).val();
            $.ajax({
                method: 'POST',
                url: $(this).data('url'),
                success: function (response) {
    //                $('#userdetails-city').html(response);
                }
            });
        }
   });
JS;
$this->registerJs($script);
?>
