<?php

namespace backend\modules\seeker\models;

use common\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "seeker".
 *
 * @property int $seeker_id
 * @property int $user_id
 * @property string $name
 * @property string $phone
 * @property string $workplace
 * @property string $necessities
 *
 * @property User $user
 */
class Seeker extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seeker';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'phone', 'workplace'], 'required'],
            [['user_id'], 'integer'],
            [['necessities'], 'string'],
            [['name', 'phone', 'workplace'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'seeker_id' => 'ID',
            'user.username' => 'Потребител',
            'name' => 'Име',
            'phone' => 'Телефон',
            'workplace' => 'Месторабота',
            'necessities' => 'Необходимост от'
        ];
    }

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
