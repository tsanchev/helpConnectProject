<?php

use yii\db\Migration;

/**
 * Class m171209_100909_init_rbac
 */
class m171209_100909_init_rbac extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $webmaster = $auth->createRole('webmaster');
        $auth->add($webmaster);
        $auth->assign($webmaster, 1);

        $administrator = $auth->createRole('administrator');
        $auth->add($administrator);
        $auth->assign($administrator, 2);

        $auth->addChild($webmaster, $administrator);

        $adminBackend = $auth->createPermission('adminBackend');
        $adminBackend->description = 'Administrate backend';
        $auth->add($adminBackend);
        $auth->addChild($webmaster, $adminBackend);

        $accessBackend = $auth->createPermission('accessBackend');
        $accessBackend->description = 'Access backend';
        $auth->add($accessBackend);
        $auth->addChild($administrator, $accessBackend);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }
}
