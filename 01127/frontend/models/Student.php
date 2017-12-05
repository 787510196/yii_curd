<?php

namespace frontend\models;
use yii\db\ActiveRecord;

class Student extends ActiveRecord{

  public function rules()
  {

  	return 
  	[

  	[['username','sex','age','hobby'],'required','message'=>'{attribute}不能为空！']

  	]; 
  }

}