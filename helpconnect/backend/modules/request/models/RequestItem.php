<?php

namespace backend\modules\request\models;

use backend\modules\item\models\Item;
use Yii;

/**
 * This is the model class for table "request_item".
 *
 * @property int $request_id
 * @property string $item
 *
 * @property Item $itemRecord
 * @property Request $request
 */
class RequestItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'item'], 'required'],
            [['request_id'], 'integer'],
            [['item'], 'string', 'max' => 255],
            [['request_id', 'item'], 'unique', 'targetAttribute' => ['request_id', 'item']],
            [['item'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item' => 'item']],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['request_id' => 'request_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'request_id' => 'Запитване',
            'item' => 'Артикул',
        ];
    }

    /**
     * Gets query for [[ItemRecord]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemRecord()
    {
        return $this->hasOne(Item::className(), ['item' => 'item']);
    }

    /**
     * Gets query for [[Request]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::className(), ['request_id' => 'request_id']);
    }
}
