<?php

namespace frontend\models;

use Yii;

/**
 * @author mr. Anderson
 */
class NewsSearch {

    /**
     * @param string $keyword
     * @return array
     */
    public static function simpleSearch($keyword) {
        $sql = "SELECT * "
                . "FROM news "
                . "WHERE content "
                . "LIKE '%$keyword%' "
                . "LIMIT 20;";
       
        return Yii::$app->db->createCommand($sql)->queryAll();
    }
    
    /**
     * @param string $keyword
     * @return array
     */
    public static function fulltextSearch($keyword) {
        $sql = "SELECT * "
                . "FROM news "
                . "WHERE "
                . "MATCH (content)"
                . "AGAINST ('$keyword') "
                . "LIMIT 20;";
       
        return Yii::$app->db->createCommand($sql)->queryAll();       
    }

    public static function sphinxSearch() {
        
    }

}