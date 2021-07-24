<?php

namespace common\models;

use Yii;
use common\CommonFunction;

class ReferralRecipients extends yii\base\Model {

    public $to_name;
    public $to_email;

    public function rules() {
        return [
                [['to_name', 'to_email'], 'safe'],
                [['to_name', 'to_email'], 'string', 'max' => 255],
                [['to_name', 'to_email'], 'trim'],
                [['to_name', 'to_email'], 'required'],
                [['to_email'], 'email'],
                [['to_name'], 'match', 'not' => true, 'pattern' => Yii::$app->params['NO_HTMLTAG_PATTERN'], 'message' => Yii::t('app', Yii::$app->params['HTMLTAG_ERR_MSG'])],
        ];
    }

    public function attributeLabels() {
        return [
            'to_name' => 'Recipient Name',
            'to_email' => 'Recipient Email',
        ];
    }

    public static function createMultiple($modelClass, $multipleModels = []) {
        $model = new $modelClass;
        $formName = $model->formName();
        $post = Yii::$app->request->post($formName);
        $models = [];

        if (!empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                    $models[] = $multipleModels[$item['id']];
                } else {
                    $models[] = new $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }

}
