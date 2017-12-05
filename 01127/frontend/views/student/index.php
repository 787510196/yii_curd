<?php 

use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\LinkPager;//使用分页类
use DfaFilter\SensitiveHelper;//使用哪个dfa算法
// 获取感词库索引数组
$wordData = array(
    '你麻痹',
    '操你妈',
    '日',
    '草',
    'fuck',
    '他妈',
    '垃圾',
    '智障',
    '废物',
    '日狗',
    '脑残',
);

?>

 	<h2><a href="<?=Url::toRoute(['student/save'])?>">添加</a></h2>
 	<br/>
 欢迎<font color="red"><b><?=$username?></b></font>登录
 <a href="<?=Url::toRoute(['login/loginout'])?>">退出登录</a>
 <br/>
 总数据：<?=$count?>条
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<!--      <center> -->
     	<table border="1px">
     		<tr>
     			<td>id</td>
     			<td>名称</td>
     			<td>性别</td>
     			<td>年龄</td>
     			<td>爱好</td>
     			<td>发布者</td>
     			<td>操作</td>
     		</tr>
     		<?php 
           foreach($res as $val):

     		?>
     		<tr>
     			<td><?=$val['id']?></td>
     			<td><?=$filterContent = SensitiveHelper::init()->setTree($wordData)->replace(Html::encode($val['username']),'***')?></td>
     			<td><?=$val['sex'] == 1 ? '男' : '女'?></td>
     			<td><?=Html::encode($val['age'])?></td>
     			<td><?=Html::encode($val['hobby'])?></td>
     			<td><?=Html::encode($val['user'])?></td>
     			<td>
     			<a href="<?=Url::toRoute(['student/del','id'=>$val['id']])?>">删除</a>
     			|
     		    <a href="<?=Url::toRoute(['student/save','id'=>$val['id']])?>">修改</a>
     			</td>
     		</tr>
     		<?php
             endforeach;
     		?>
     	</table>
     	<?=LinkPager::widget(['pagination'=>$pagination])?>
     </center>
	
</body>
</html>