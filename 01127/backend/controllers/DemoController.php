<?php 
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Week1;

class DemoController extends Controller{
  
  public $enableCsrfValidation = false;//防csrf
  public $layout = false; //去除框架样式

 public function actionIndex(){
   //首先查询出来表数据结构
   $res = \Yii::$app->db->createCommand('select * from week1');
   $res = $res->queryAll();
   return $this->render('index',['res'=>$res]);

 }

 public function actionAdd(){
    $model=new Week1();
    if(Yii::$app->request->post()){
        //接值
        $post=Yii::$app->request->post();
        $model->name=$post['name'];
        $model->type=$post['type'];
        $model->moren=$post['moren'];
        $model->is_bitian=$post['is_bitian'];
        $model->rule=$post['rule'];
        $model->nums=$post['nums'];
        $res=$model->save();
        if($res)
        {
        	return $this->redirect(['demo/index']);
        }
     
    }else{

    	return $this->render('add');
    }
}
  //删除
  public function actionDelete()
  {
  	 $model=new Week1();
  	 $id=Yii::$app->request->get('id');
  	 $res=$model->deleteAll('id=:id',[':id'=>$id]);
  	 if($res)
  	 {
  	 	echo"<script>alert('删除成功'),location.href='?r=demo/index'</script>";
  	 }
  }

  //修改
  public function actionUpdate()
  {
  	$model=new Week1();
  	$id=Yii::$app->request->get('id');
  	//查询单条福默认值
    $res=$model->findOne($id);
 
    return $this->render('update',['res'=>$res]);
  
  }
  //修改
  public function actionUp()
  {
     $model=new Week1();
     //接修改过来的值
     $post=Yii::$app->request->post();
     $model=$model->findOne($post['id']);
     
     $model->name=$post['name'];
     $model->type=$post['type'];
     $model->moren=$post['moren'];
     $model->is_bitian=$post['is_bitian'];
     $model->rule=$post['rule'];
     $model->nums=$post['nums'];


     $res=$model->save();
     if($res)
     {
     	echo"<script>alert('修改成功'),location.href='?r=demo/index'</script>";
     }


  }
 


}