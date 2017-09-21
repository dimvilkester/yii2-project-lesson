<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * @author mr. Anderson
 */
class NewsSearch {

    /**
     * @param string $keyword
     * @return array
     */
    public static function simpleSearch($keyword) {
        // fix security issue (hometask)
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
        // fix security issue (hometask)
        $sql = "SELECT * "
                . "FROM news "
                . "WHERE "
                . "MATCH (content)"
                . "AGAINST ('$keyword') "
                . "LIMIT 20;";

        return Yii::$app->db->createCommand($sql)->queryAll();
    }

    /**
     * 
     * @param string $keyword
     * @return array
     * 
     * Чтобы использовать функцию sphinxSearch необходимо 
     * чтобы сама поисковая машина sphinx была запущенаю
     * 
     * Индексирование таблиц происходит в автомат. режиме через cron
     * (если поставитть ему такую задачу)
     */
    public static function sphinxSearch($keyword) {

        /**
         * 1. Делаем выборку из проиндексированной таблицы. Таблица отсортирована по 
         * рейтингу количества совпадений ключевых слов (OPTION ranker=WORDCOUNT).
         * 
         * На выходе получаем вложенный массив $dataId с id статей
         */
        $sql = "SELECT * FROM idx_news_content WHERE MATCH('$keyword') OPTION ranker=WORDCOUNT;";
        $dataId = Yii::$app->sphinx->createCommand($sql)->queryAll();

        /**
         * 2. Преобразуем массив $data к виду ['id' => 'id'] 
         */
        $ids = ArrayHelper::map($dataId, 'id', 'id');

        /**
         * 3. Делаем выборку из таблицы News по id из массива $ids
         * 
         * На выходе получаем отсортированный по возрастанию поля id вложенный массив $data
         * (специфика работы WHERE)
         */
        $dataIdSort = News::find()->where(['id' => $ids])->asArray()->all();

        /**
         * 4. Преобразуем массив $data к виду ['id' => 'id', 'title', 'content', 'status']
         */
        $data = ArrayHelper::index($dataIdSort, 'id');

        /**
         * 5. Для того чтобы статьи были отсортированы по рейтингу количества совпадений 
         * ключевых слов снова используем полученный раннее массив $ids с $id статей
         */
        $results = [];
        foreach ($ids as $element) {
            $results[] = [
                'id' => $element,
                'title' => $data[$element]['title'],
                'content' => $data[$element]['content'],
            ];
        }

        /**
         * 6. Возвращаем массив статей отсартированный по рейтингу количества совпадений ключевых слов
         */
        return $results;
    }

}
