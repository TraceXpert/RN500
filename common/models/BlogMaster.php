<?php

namespace common\models;

use Yii;
use common\CommonFunction;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "blog_master".
 *
 * @property int $id
 * @property string $reference_no
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property string $tags
 * @property int $category_id
 * @property string $conver_image_name
 * @property int $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BlogCategoryMaster $category
 * @property BlogTags[] $blogTags
 */
class BlogMaster extends \yii\db\ActiveRecord {

    public $coverImageFile;
    public $tagsList;

    const SCENARIO_ADD = "add-blog";

    public static function tableName() {
        return 'blog_master';
    }

    public function beforeSaveInit() {
        if ($this->isNewRecord) {
            $this->created_at = CommonFunction::currentTimestamp();
            $this->created_by = Yii::$app->user->id;
            $this->reference_no = $this->getUniqueReferenceNumber();
        }


        if (!empty($this->tagsList) && count($this->tagsList)) {
            $this->tags = implode(",", $this->tagsList);
        }
        $this->updated_at = CommonFunction::currentTimestamp();
        $this->updated_by = Yii::$app->user->id;
//        $this->conver_image_name = "123.png";
        return true;
    }

    public function rules() {
        return [
                [['reference_no', 'title', 'short_description', 'description', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'required'],
                [['category_id', 'status'], 'required', 'message' => 'Please select {attribute}.'],
                [['description', 'tags'], 'string'],
                [['category_id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'status'], 'integer'],
                [['reference_no'], 'string', 'max' => 50],
                [['title', 'short_description'], 'string', 'max' => 255],
                [['conver_image_name'], 'string', 'max' => 100],
                [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategoryMaster::className(), 'targetAttribute' => ['category_id' => 'id']],
                [['coverImageFile'], 'required', 'on' => self::SCENARIO_ADD],
                [['coverImageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
                [['coverImageFile', 'tags', 'tagsList'], 'safe'],
                [['reference_no', 'title', 'short_description', 'description', 'tags'], 'trim'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'reference_no' => 'Reference No',
            'title' => 'Title',
            'short_description' => 'Short Description',
            'description' => 'Description',
            'category_id' => 'Category',
            'conver_image_name' => 'Conver Image Name',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'statusText' => 'Status',
            'coverImageFile' => 'Cover Image',
            'tags' => 'Tags',
            'tagsList' => 'Tags',
        ];
    }

    public function saveCoverImage() {
        $isSaved = false;
        try {
            if (!empty($this->coverImageFile)) {
                $location = CommonFunction::getBlogsCoverImageBasePath();
                if (!file_exists($location)) {
                    FileHelper::createDirectory($location, 0777);
                }
                $this->conver_image_name = time() . "_" . Yii::$app->security->generateRandomString(10) . "." . $this->coverImageFile->getExtension();
                $isSaved = $this->coverImageFile->saveAs($location . "/" . $this->conver_image_name);
            }
        } catch (\Exception $ex) {
            $isSaved = false;
        } finally {
            return $isSaved;
        }
    }

    public function getCoverImageUrl() {
        $url = "";
        if ($this->conver_image_name) {
            if (file_exists(CommonFunction::getBlogsCoverImageBasePath() . "/" . $this->conver_image_name)) {
                $url = CommonFunction::getBlogsCoverImageBaseUrl() . "/" . $this->conver_image_name;
            }
        }
        return $url;
    }

    public function deleteCoverImage($file_name) {
        $isDeleted = false;
        try {
            if ($file_name !== '') {
                $location = CommonFunction::getBlogsCoverImageBasePath();
                if (file_exists($location) . "/" . $file_name) {
                    $isDeleted = FileHelper::unlink($location . "/" . $file_name);
                }
            }
        } catch (\Exception $ex) {
            $isDeleted = false;
        } finally {
            return $isDeleted;
        }
    }

    public function getUniqueReferenceNumber() {
        $code = CommonFunction::generateRandomString(15);
        $exits = self::find()->where(['reference_no' => $code])->one();
        if ($exits) {
            $this->getUniqueReferenceNumber();
        } else {
            return $code;
        }
    }

    public function getCategory() {
        return $this->hasOne(BlogCategoryMaster::className(), ['id' => 'category_id']);
    }

    public function getCategoryName() {
        $name = '';
        if ($this->category) {
            $name = $this->category->name;
        }
        return $name;
    }

    public function getStatusText() {
        $statusText = '';
        if (isset(Yii::$app->params['BLOG_CATEGORY_STATUS'][$this->status]) && !empty(Yii::$app->params['BLOG_CATEGORY_STATUS'][$this->status])) {
            $statusText = Yii::$app->params['BLOG_CATEGORY_STATUS'][$this->status];
        }
        return $statusText;
    }

    /**
     * Return tags list in array format
     */
    public function getTagsList() {
        $tags = '';
        if ($this->tags != '') {
            $tags = explode(",", $this->tags);
        }
        return $tags;
    }

}
