<?php

namespace frontend\models\forms;

use Yii;
use yii\base\Model;
use frontend\models\NewsSearch;

/**
 * @author mr. Anderson
 */
class SearchForm extends Model {

    public $keyword;

    /**
     * @return array parametrs
     */
    public function rules() {

        return [
                [['keyword'], 'trim'],
                [['keyword'], 'required'],
                [['keyword'], 'string', 'min' => 3],
        ];
    }

    /**
     * @return array parametrs
     */
    public function attributeLabels() {
        return [
            'keyword' => 'Ключевое слово',
        ];
    }
    
    /**
     * @return array
     */
    public function search () {
        if ($this->validate()) {
            return NewsSearch::fulltextSearch($this->keyword);
        }
    }

}
