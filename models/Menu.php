<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property integer $parent
 * @property integer $isgroup
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent', 'isgroup'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['url'], 'string', 'max' => 256],
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
            'url' => 'Url',
            'parent' => 'Parent',
            'isgroup' => 'Isgroup',
        ];
    }

    public function getCountChild()
    {
        $arr = Menu::find()->select('count(*) as zn')->where(['parent' => $this->id])->asArray()->all();
        return $arr[0]['zn'];
    }
}
