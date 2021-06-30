<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "api_log".
 *
 * @property int $id
 * @property string $url
 * @property string $request
 * @property string $response
 * @property int $created_at
 */
class ApiLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'api_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'request', 'response', 'created_at'], 'required'],
            [['url', 'request', 'response'], 'string'],
            [['created_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'request' => 'Request',
            'response' => 'Response',
            'created_at' => 'Created At',
        ];
    }
}
