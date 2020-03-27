<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m180614_104206_default_users
 */
class m180614_104206_default_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $webmaster = new User();
        $webmaster->username = 'webmaster';
        $webmaster->email = 'webmaster@example.com';
        $webmaster->id = '1';
        $webmaster->setPassword('pbhTUgX6tkMTCqjQ');
        $webmaster->generateAuthKey();
        $webmaster->status = User::STATUS_ACTIVE;
        $webmaster->save();


        $administrator = new User();
        $administrator->username = 'administrator';
        $administrator->email = 'administrator@example.com';
        $administrator->id = '2';
        $administrator->setPassword('aHzgjk8EW5Ku8UA4');
        $administrator->generateAuthKey();
        $administrator->status = User::STATUS_ACTIVE;
        $administrator->save();

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        User::findOne(1)->delete();
        User::findOne(2)->delete();
    }

}
