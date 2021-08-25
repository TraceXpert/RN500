<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BlogMaster;

class BlogMasterSearch extends BlogMaster {

    public $categoryName;
    public $statusText;

    public function rules() {
        return [
                [['categoryName', 'title', 'statusText'], 'safe'],
                [['categoryName', 'title', 'statusText'], 'trim'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params) {
        $query = BlogMaster::find()->alias("blog")->joinWith(['category as category']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => [
                    'title',
                    'statusText' => [
                        'asc' => ['blog.status' => SORT_ASC],
                        'desc' => ['blog.status' => SORT_DESC]
                    ],
                    'categoryName' => [
                        'asc' => ['category.name' => SORT_ASC],
                        'desc' => ['category.name' => SORT_DESC]
                    ]
                ]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        if ($this->statusText != '') {
            $query->andFilterWhere(['blog.status' => $this->statusText]);
        }
        if ($this->categoryName != '') {
            $query->andFilterWhere(['LIKE', 'category.name', $this->categoryName]);
        }
        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }

}
