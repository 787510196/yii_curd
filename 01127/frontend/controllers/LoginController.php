<?php 
namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use frontend\models\User;
use yii\db\query;//query 查询类
header("content-type:text/html;charset=utf8");
class LoginController extends Controller{

 //登录界面 and 验证
 public function actionLog()
 {
    $model=new User();
     if(Yii::$app->request->post())
     {	
        //首先接值过来
        $list=Yii::$app->request->post('User');
        //查询出数据库
        $query=new Query();
        $res=$query->select(['username','password'])
        ->from('user')
        ->where(['username'=>$list['username'],'password'=>$list['password']])
        ->one();

          if($res)
          {   //登陆成功开启session
          		$session = Yii::$app->session;
          		$session->open();
          		$session->set('username',$list['username']);//赋值
          		return $this->redirect(['student/index']);die;
           }
           else
           {
           	echo "<script>alert('账号或密码错误'),location.href='?r=login/log'</script>";die;
           	//return $this->redirect(['login/log']);die;
           }
     }
     else
     {
        return $this->render('log',['model'=>$model]);	
     }
 	
 }

   //注册
   public function actionZhuce()
   {
   	  echo "注册中，，，";
   }
   //退出登录
   public function actionLoginout()
   {
     $session = Yii::$app->session;
     //$session->remove('username');
     unset($session['username']);
     return $this->redirect(['login/log']);

   }
}




