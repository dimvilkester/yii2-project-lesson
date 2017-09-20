<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use Faker\Factory;

class ExampleController extends Controller {

    public function actionGenerate() {


        /* @var $faker Faker\Generator */
        $faker = Factory::create();

        for ($j = 0; $j < 100; $j++) {

            $news = [];

            for ($i = 0; $i < 100; $i++) {
                $news[] = [
                    $faker->text(rand(30, 45)),
                    $faker->text(rand(1000, 2000)),
                    rand(0, 1)
                ];
            }
            Yii::$app->db->createCommand()->batchInsert('news', ['title', 'content', 'status'], $news)->execute();
            unset($news);
        }
        
        die('stop');
    }

}
