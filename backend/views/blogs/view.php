<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<div class="blog-master-view">
    <div class="card card-default color-palette-box">
        <div class="card-body">
            <p class="text-right">

                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

            </p>
            <div class="row">
                <div class="col-12">
                    <?=
                    DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'reference_no',
                            'title',
                            'short_description',
                            'description:ntext',
                            'categoryName',
                                [
                                'attribute' => 'conver_image_name',
                                'format' => 'raw',
                                'value' => ($model->getCoverImageUrl()) ? Html::a($model->conver_image_name, $model->getCoverImageUrl(), ['target' => '_blank']) : ''
                            ],
                                [
                                'attribute' => 'tags',
                                'value' => str_replace(",", " , ", $model->tags)
                                
                                
                            ],
                        ],
                    ])
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

