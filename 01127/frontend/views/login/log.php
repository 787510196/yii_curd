<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\LoginForm */
$this->title = '登录';
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>Please fill out the following fields to login:</p>

<?php $form = ActiveForm::begin(['action'=>'?r=login/log']); ?>
    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password') ?>
    <?= Html::submitButton('登录') ?>
    <a href="<?=Url::toRoute(['login/zhuce'])?>">注册</a>
<?php ActiveForm::end(); ?>
