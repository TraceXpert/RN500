<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "advertisement".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $link_url
 * @property string|null $icon
 * @property int $location
 * @property string $is_active 0- Inactive, 1- Active	
 * @property string|null $active_from
 * @property string|null $active_to
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Advertisement extends \yii\db\ActiveRecord {

    const FILE_TYPE_IMAGE = 1;
    const FILE_TYPE_YOUTUBE_LINK = 2;
    const STATUS_ACTIVE_YES = 1;
    const STATUS_ACTIVE_NO = 0;

    public static function tableName() {
        return 'advertisement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['description', 'is_active', 'video_link', 'link_url'], 'string'],
            [['is_active', 'vendor_id', 'name', 'link_url', 'active_from', 'location'], 'required'],
            [['file_type'], 'integer'],
            [['link_url'], 'url'],
            [['name'], 'match', 'pattern' => '/^[a-zA-Z0-9 ]*$/', 'message' => 'Only number and alphabets allowed for {attribute} field'],
            [['description'], 'match', 'pattern' => '/^[a-zA-Z0-9 ,.]*$/', 'message' => 'Only number and alphabets allowed for {attribute} field'],
//            [['link_url','video_link'], 'match', 'pattern' => '/[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)?/', 'message' => 'Please Enter Valid Url For {attribute} field'],
            [['icon'], 'required', "message" => "Please select {attribute}.", 'when' => function($model) {
                    return $model->file_type != 2 && empty($model->icon);
                }, 'whenClient' => "function (attribute, value) {
                return ($('#type_1').is(':checked') && $('#image').val() == '');
            }"],
            [['video_link'], 'required', "message" => "Please Enter {attribute}.", 'when' => function($model) {
                    return $model->file_type != 1;
                }, 'whenClient' => "function (attribute, value) {
                return ($('#type_2').is(':checked'));
            }"],
            [['name', 'link_url', 'video_link', 'active_from', 'description', 'active_to', 'created_at', 'updated_at', 'created_by', 'updated_by', 'vendor_id'], 'safe'],
            [['name', 'icon'], 'string', 'max' => 255],
            [['location'], 'integer'],
            [['icon'], 'file', 'extensions' => ['jpg', 'png', 'jpeg'], 'checkExtensionByMimeType' => false, "wrongExtension" => "File type is not compatible. Please upload a PNG or JPG file."],
            [['name', 'description'], 'match', 'not' => true, 'pattern' => Yii::$app->params['NO_HTMLTAG_PATTERN'], 'message' => Yii::t('app', Yii::$app->params['HTMLTAG_ERR_MSG'])],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'vendor_id' => 'Vendor',
            'name' => 'Name',
            'description' => 'Description',
            'link_url' => 'Link Url',
            'icon' => 'Icon',
            'location' => 'City',
            'is_active' => 'Is Active',
            'active_from' => 'Active From',
            'active_to' => 'Active To',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getCity() {
        return $this->hasOne(Cities::className(), ['id' => 'location']);
    }

    public function getYoutubeEmbedUrl() {
        $url = '';
        if ($this->file_type == self::FILE_TYPE_YOUTUBE_LINK) {
            $url = $this->video_link;
            if (strpos($this->video_link, 'watch?v=') !== false) { // WATCHING URL COVERTS INTO EMBED
                $watchUrl = explode('?v=', $this->video_link);
                if (strpos($watchUrl[1], '&') !== false) {
                    $vUrl = explode('&', $watchUrl[1]);
                    $url = 'https://www.youtube.com/embed/' . $vUrl[0];
                } else {
                    $url = 'https://www.youtube.com/embed/' . $watchUrl[1];
                }
            }
        }
        return $url;
    }

    public function getYoutubeEmbedId() {
        $id = '';
        if ($this->file_type == self::FILE_TYPE_YOUTUBE_LINK) {
            $url = $this->video_link;
            if (strpos($this->video_link, 'watch?v=') !== false) { // WATCHING URL COVERTS INTO EMBED
                $watchUrl = explode('?v=', $this->video_link);
                if (strpos($watchUrl[1], '&') !== false) {
                    $vUrl = explode('&', $watchUrl[1]);
                    $id = "http://img.youtube.com/vi/" . $vUrl[0] . "/0.jpg";
                } else {
                    $id = "http://img.youtube.com/vi/" . $watchUrl[1] . "/0.jpg";
                }
            }
        }
        return $id;
    }

}
