<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\forms\SearchForm */
/* @var $results frontend\models\NewsSearch */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\helpers\HighlightHelper;

$this->title = 'Search';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'keyword')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <?php if($results): ?>
                <?php foreach ($results as $item): ?>
                    <h1><?= $item['title'] ?></h1>
                    <p><?= HighlightHelper::process($model->keyword, $item['content']) ?></p>
                    <hr>
                <?php endforeach; ?>
            <?php endif; ?>      
        </div>
    </div>

    <div class="col-lg-12">
        <hr>
        <?php echo Html::a('Вернуться на главную', Url::home(), ['class' => 'btn btn-info']); ?>
    </div> 
</div>