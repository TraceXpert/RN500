<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "banner".
 *
 * @property int $id
 * @property string $headline
 * @property int $status 1:active 0: inactive
 * @property int $created_at
 * @property int $updated_at
 */
class Banner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['headline', 'created_at', 'updated_at'], 'required'],
            [['headline'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['headline'], 'match', 'not' => true, 'pattern' => Yii::$app->params['NO_HTMLTAG_PATTERN'], 'message' => Yii::t('app', Yii::$app->params['HTMLTAG_ERR_MSG'])],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'headline' => 'Headline',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
