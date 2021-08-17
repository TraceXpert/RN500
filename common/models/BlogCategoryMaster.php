<?php

namespace common\models;

use Yii;
use common\CommonFunction;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "blog_category_master".
 *
 * @property int $id
 * @property string $name
 * @property int $status 0: Inactive, 1 :Active
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BlogMaster[] $blogMasters
 */
class BlogCategoryMaster extends \yii\db\ActiveRecord {

    const STATUS_ACTIVE = '1';
    const STATUS_IN_ACTIVE = '0';

    public function beforeSaveInit() {
        if ($this->isNewRecord) {
            $this->created_at = CommonFunction::currentTimestamp();
            $this->created_by = Yii::$app->user->id;
        }
        $this->updated_at = CommonFunction::currentTimestamp();
        $this->updated_by = Yii::$app->user->id;
        return true;
    }

    public static function tableName() {
        return 'blog_category_master';
    }

    public function rules() {
        return [
                [['name', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'required'],
                [['status'], 'required', 'message' => 'Please select {attribute}.'],
                [['status', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
                [['name'], 'string', 'max' => 255],
                [['name'], 'safe'],
                [['name'], 'trim'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getBlogMasters() {
        return $this->hasMany(BlogMaster::className(), ['category_id' => 'id']);
    }

    public function getBlogMastersCnt() {
        return $this->hasMany(BlogMaster::className(), ['category_id' => 'id'])->count();
    }

    public function getStatusText() {
        $statusText = '';
        if (isset(Yii::$app->params['BLOG_CATEGORY_STATUS'][$this->status]) && !empty(Yii::$app->params['BLOG_CATEGORY_STATUS'][$this->status])) {
            $statusText = Yii::$app->params['BLOG_CATEGORY_STATUS'][$this->status];
        }
        return $statusText;
    }

    public static function getBlogCategories($activeOnly = true) {
        $query = BlogCategoryMaster::find();
        if ($activeOnly) {
            $query->andWhere(['status' => BlogCategoryMaster::STATUS_ACTIVE]);
        }
        return ArrayHelper::map($query->all(), 'id', 'name');
    }

}
