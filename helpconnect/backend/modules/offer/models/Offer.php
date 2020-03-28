<?php

namespace backend\modules\offer\models;

use backend\modules\giver\models\Giver;
use backend\modules\item\models\Item;
use Yii;

/**
 * This is the model class for table "offer".
 *
 * @property int $offer_id
 * @property int $giver_id
 * @property string $offer
 * @property string $created_at
 * @property string[] $items
 *
 * @property Giver $giver
 * @property OfferItem[] $offerItems
 * @property Item[] $itemRecords
 */
class Offer extends \yii\db\ActiveRecord
{
    public $items;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['giver_id', 'offer'], 'required'],
            [['giver_id'], 'integer'],
            [['offer'], 'string'],
            [['giver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Giver::className(), 'targetAttribute' => ['giver_id' => 'giver_id']],
            [['created_at', 'items'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'offer_id' => 'ID',
            'giver_id' => 'Предлагащ помощ',
            'offer' => 'Предложение',
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

        OfferItem::deleteAll(['offer_id' => $this->offer_id]);

        foreach ($this->items as $key => $val) {
            $item = Item::findOne(['item' => $val]);
            if (!$item) {
                $item = new Item();
                $item->item = $val;
                $item->save();

            }

            $offerItem = new OfferItem();
            $offerItem->offer_id = $this->offer_id;
            $offerItem->item = $val;
            $offerItem->save();
        }

    }

    /**
     * Gets query for [[Giver]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGiver()
    {
        return $this->hasOne(Giver::className(), ['giver_id' => 'giver_id']);
    }

    /**
     * Gets query for [[OfferItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOfferItems()
    {
        return $this->hasMany(OfferItem::className(), ['offer_id' => 'offer_id']);
    }

    /**
     * Gets query for [[ItemRecords]].
     *
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getItemRecords()
    {
        return $this->hasMany(Item::className(), ['item' => 'item'])->viaTable('offer_item', ['offer_id' => 'offer_id']);
    }
}
