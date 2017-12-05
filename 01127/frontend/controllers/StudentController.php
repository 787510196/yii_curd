<?php
namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use frontend\models\Student;
//使用分页类
use yii\data\Pagination;
header("content-type:text/html;charset=utf8");	
class StudentController extends Controller{

  //展示页面
 public function actionIndex()
 {  
 	$session = Yii::$app->session;
 	//获取session
 	$username = $session->get('username');
  if(!$username)
   {
    echo "<script>alert('请先登录'),location.href='?r=login/log'</script>";die;
   }  
  
   $model=new Student();
   $count=$model->find()->count();
   $Pagination=new pagination([
       'defaultPageSize'=>5, //每页显示
       'totalCount'=>$count  //获取数据总条数
   	]);

   $res=$model->find()->offset($Pagination->offset)->limit($Pagination->limit)->asArray()->all();//查找全部数据

   return $this->render('index',['res'=>$res,'pagination'=>$Pagination,'count'=>$count,'username'=>$username]);

 }
 
 //添加and修改  在一个页面里（逻辑！）
 public function actionSave()
 {  
    //判断是否登录，不登录无法添加修改
 	$session = Yii::$app->session;
 	if(!$session->get('username'))
 	 {
 	 	echo "<script>alert('请先登录'),location.href='?r=login/log'</script>";die;
 	 }	
     $model = new Student();
    if($model->load(Yii::$app->request->post())&&$model->validate())//接值了进这个方法,没接值进入else方法进行接值
    {   //判断接值了且传了一个id值那就是修改（判断是新增还是修改）
    	if($id=Yii::$app->request->get('id'))
    	{
    		$model=$model->findOne($id); //查询传过来那条id的数据

    		$post=Yii::$app->request->post('Student'); //接修改完成后的表单数据

    		$model->username=$post['username'];   //重新对model依次赋值修改
    		$model->sex=$post['sex'];
    		$model->age=$post['age'];
    		$model->hobby=implode(',',$post['hobby']);
    		$model->user=$session->get('username');
    	}
    	else
    	{  
    	   //新增
    	   $model->hobby=implode(',',$model->hobby);//将数组变为字符串
    	   $model->user=$session->get('username');	
    	}

    	$res=$model->save(); //如果是new 的话那save就是新增  如果是find查询的话那就是修改。

    	if($res)
    	{
    		return $this->redirect(['student/index']);
    	}
    }
    else
    {   //判断是否接了一个id值，接了的话就是修改,这是给修改页赋默认值
    	if($id=Yii::$app->request->get('id'))
    	{
    		$model=$model->findOne($id);  //查询当前数据 赋给$model,下面传的$model就有数据了 
    		$model->hobby=explode(',',$model->hobby);//将字符串类型转换为数组，为了实现默认选中
    	}
    	return $this->render('save',['model'=>$model]);//这个model是实例化好的那个model小部件使用
    }


 }
 
 //删除
  public function actionDel()
  { 
  	$model=new Student();
    $id=Yii::$app->request->get('id');
    $res=$model->deleteAll('id=:id',[':id'=>$id]);
    if($res){
    	return $this->redirect(['student/index']);
    }

  }
  
  //修改默认值界面(这里修改和新增写在一个方法里面了)
  public function actionUpdate()
  { 
  	 $model = new Student();
    if($model->load(Yii::$app->request->post())&&$model->validate())//判断接值了进这个方法，没接值进入else方法
    {
    	// print_r(Yii::$app->request->post());die;
    	$model->hobby=implode(',',$model->hobby);
    	$res=$model->save();
    	if($res)
    	{
    		return $this->redirect(['student/index','添加成功']);
    	}
    }
    else
    {
    	if($id=Yii::$app->request->get('id'))
    	{
    		$model=$model->findOne($id);
    		$model->hobby=explode(',',$model->hobby);
    	}
    	return $this->render('add',['model'=>$model]);
    }

  }
}