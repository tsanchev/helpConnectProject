<?php

namespace backend\modules\offer\models;

use backend\modules\item\models\Item;
use Yii;

/**
 * This is the model class for table "offer_item".
 *
 * @property int $offer_id
 * @property string $item
 *
 * @property Item $itemRecord
 * @property Offer $offer
 */
class OfferItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'offer_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['offer_id', 'item'], 'required'],
            [['offer_id'], 'integer'],
            [['item'], 'string', 'max' => 255],
            [['offer_id', 'item'], 'unique', 'targetAttribute' => ['offer_id', 'item']],
            [['item'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item' => 'item']],
            [['offer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Offer::className(), 'targetAttribute' => ['offer_id' => 'offer_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'offer_id' => 'Предложение',
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
     * Gets query for [[Offer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOffer()
    {
        return $this->hasOne(Offer::className(), ['offer_id' => 'offer_id']);
    }
}
