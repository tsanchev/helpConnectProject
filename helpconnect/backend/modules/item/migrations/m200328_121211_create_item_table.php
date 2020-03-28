<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item}}`.
 */
class m200328_121211_create_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%item}}', [
            'item' => $this->string()->notNull(),

        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-item-item}}', '{{%item}}', 'item');

        // permissions
        $auth = Yii::$app->authManager;
        $permission = $auth->createPermission('item');
        $auth->add($permission);
        $auth->addChild($auth->getRole('administrator'), $permission);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item}}');

        $auth = Yii::$app->authManager;
        $auth->remove($auth->getPermission('item'));
    }
}
