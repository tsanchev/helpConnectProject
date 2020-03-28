<?php

namespace backend\modules\item\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "item".
 *
 * @property string $item
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item'], 'required'],
            [['item'], 'string', 'max' => 255],
            [['item'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item' => 'Артикул',
        ];
    }


    public static function getItems()
    {
        return ArrayHelper::map(self::find()->asArray()->all(), self::primaryKey()[0], 'item');
    }
}
