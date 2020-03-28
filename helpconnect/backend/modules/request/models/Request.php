<?php

namespace backend\modules\request\models;

use backend\modules\item\models\Item;
use backend\modules\seeker\models\Seeker;
use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $request_id
 * @property int $seeker_id
 * @property string $request
 * @property string $created_at
 * @property string[] $items
 *
 * @property Seeker $seeker
 * @property RequestItem[] $requestItems
 * @property Item[] $itemRecords
 */
class Request extends \yii\db\ActiveRecord
{
    public $items;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seeker_id', 'request'], 'required'],
            [['seeker_id'], 'integer'],
            [['request'], 'string'],
            [['seeker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Seeker::className(), 'targetAttribute' => ['seeker_id' => 'seeker_id']],
            [['created_at', 'items'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'request_id' => 'ID',
            'seeker_id' => 'Търсещ помощ',
            'request' => 'Запитване',
            'items' => 'Артикули',
            'created_at' => 'Дата',
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        RequestItem::deleteAll(['request_id' => $this->request_id]);

        foreach ($this->items as $key => $val) {
            $item = Item::findOne(['item' => $val]);
            if (!$item) {
                $item = new Item();
                $item->item = $val;
                $item->save();

            }

            $requestItem = new RequestItem();
            $requestItem->request_id = $this->request_id;
            $requestItem->item = $val;
            $requestItem->save();
        }

    }

    /**
     * Gets query for [[Seeker]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeeker()
    {
        return $this->hasOne(Seeker::className(), ['seeker_id' => 'seeker_id']);
    }

    /**
     * Gets query for [[RequestItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestItems()
    {
        return $this->hasMany(RequestItem::className(), ['request_id' => 'request_id']);
    }

    /**
     * Gets query for [[ItemRecords]].
     *
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getItemRecords()
    {
        return $this->hasMany(Item::className(), ['item' => 'item'])->viaTable('request_item', ['request_id' => 'request_id']);
    }
}
