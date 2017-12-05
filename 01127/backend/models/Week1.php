<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "week1".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $moren
 * @property string $is_bitian
 * @property string $rule
 * @property string $nums
 */
class Week1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'week1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'moren', 'rule'], 'string', 'max' => 20],
            [['is_bitian'], 'string', 'max' => 10],
            [['nums'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'moren' => 'Moren',
            'is_bitian' => 'Is Bitian',
            'rule' => 'Rule',
            'nums' => 'Nums',
        ];
    }
}
