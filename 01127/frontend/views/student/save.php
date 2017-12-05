<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$session = Yii::$app->session;
 	//获取session
 	$username = $session->get('username');

?>

<?php $form=ActiveForm::begin();?>
<?=$form->field($model,'username')?>
<?=$form->field($model,'sex')->radioList(['0'=>'女','1'=>'男'])?>
<?=$form->field($model,'age')->dropDownList([18=>18,19=>19,20=>20,21=>21,22=>22,23=>23,24=>24,25=>25,26=>26,27=>27,28=>28],['prompt'=>'请选择'])?>
<?=$form->field($model,'hobby')->checkboxList(['篮球'=>'篮球','台球'=>'台球','揉揉球'=>'揉揉球'])?>
<?=Html::submitButton('提交',['class'=>'btn btn-primary'])?>
<?php $form->end();?>


