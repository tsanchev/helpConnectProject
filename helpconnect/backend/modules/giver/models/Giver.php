<?php

namespace backend\modules\giver\models;

use common\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "giver".
 *
 * @property int $giver_id
 * @property int $user_id
 * @property string $name
 * @property string|null $company
 * @property string $phone
 *
 * @property User $user
 */
class Giver extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'giver';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'phone',], 'required'],
            [['user_id'], 'integer'],
            [['name', 'company', 'phone'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'giver_id' => 'ID',
            'user.username' => 'Потребител',
            'name' => 'Име',
            'company' => 'Фирма',
            'phone' => 'Телефон',
        ];
    }

    /**
     * {@inheritdoc}
     */
//    public function beforeSave($insert) {
//        if($this->isNewRecord)
//        {
//            $this
//        }
//
//        return parent::beforeSave($insert);
//    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
