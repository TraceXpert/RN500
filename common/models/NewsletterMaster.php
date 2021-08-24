<?php

namespace common\models;

use Yii;
use common\CommonFunction;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "newsletter_master".
 *
 * @property int $id
 * @property string $reference_no
 * @property string $title
 * @property string $short_description
 * @property string $description
 * @property string|null $conver_image_name
 * @property string $tags
 * @property int $status 0:Non-Suspended, 1:Suspended
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 */
class NewsletterMaster extends \yii\db\ActiveRecord {

    public $coverImageFile;
    public $tagsList;

    const IS_SUSPENDED_YES = "1";
    const IS_SUSPENDED_NO = "0";
    const SCENARIO_ADD = "add-newsletter";
    const SCENARIO_SUSPEND = "suspend-newsletter";

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'newsletter_master';
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
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['reference_no', 'title', 'short_description', 'description', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'required'],
            [['status'], 'required', 'message' => 'Please select {attribute}.'],
            [['description', 'tags'], 'string'],
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'status'], 'integer'],
            [['reference_no'], 'string', 'max' => 50],
            [['short_description'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 65],
            [['conver_image_name'], 'string', 'max' => 100],
            [['coverImageFile'], 'required', 'on' => self::SCENARIO_ADD],
            [['status'], 'required', 'on' => self::SCENARIO_SUSPEND],
            [['coverImageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['coverImageFile', 'tags', 'tagsList'], 'safe'],
            [['reference_no', 'title', 'short_description', 'description', 'tags'], 'trim'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'reference_no' => Yii::t('app', 'Reference No'),
            'title' => Yii::t('app', 'Title'),
            'short_description' => Yii::t('app', 'Short Description'),
            'description' => Yii::t('app', 'Description'),
            'conver_image_name' => Yii::t('app', 'Conver Image Name'),
            'tags' => Yii::t('app', 'Tags'),
            'status' => Yii::t('app', 'Status'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function saveCoverImage() {
        $isSaved = false;
        try {
            if (!empty($this->coverImageFile)) {
                $location = CommonFunction::getNewsletterCoverImageBasePath();
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
            if (file_exists(CommonFunction::getNewsletterCoverImageBasePath() . "/" . $this->conver_image_name)) {
                $url = CommonFunction::getNewsletterCoverImageBaseUrl() . "/" . $this->conver_image_name;
            }
        }
        return $url;
    }

    public function deleteCoverImage($file_name) {
        $isDeleted = false;
        try {
            if ($file_name !== '') {
                $location = CommonFunction::getNewsletterCoverImageBasePath();
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
    
    public function getStatusText() {
        $statusText = '';
        if (isset(Yii::$app->params['NEWSLETTER_SUSPENDED'][$this->status]) && !empty(Yii::$app->params['NEWSLETTER_SUSPENDED'][$this->status])) {
            $statusText = Yii::$app->params['NEWSLETTER_SUSPENDED'][$this->status];
        }
        return $statusText;
    }

    /**
     * Return tags list in array format
     */
    public function getTagsList() {
        $tags = [];
        if ($this->tags != '') {
            $tags = explode(",", $this->tags);
        }
        return $tags;
    }

    public function getCreatedBy() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getCreatedByName() {
        $name = "";
        if (!empty($this->createdBy)) {
            $name = $this->createdBy->getFullName();
        }
        return $name;
    }

    public function getCreatedByEmail() {
        $name = "";
        if (!empty($this->createdBy)) {
            $name = $this->createdBy->email;
        }
        return $name;
    }

    public function getDetailUrl() {
        return Yii::$app->urlManagerFrontend->createAbsoluteUrl(['newsletter/detail', 'reference_no' => $this->reference_no]);
    }

}
