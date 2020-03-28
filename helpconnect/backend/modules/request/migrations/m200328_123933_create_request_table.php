<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request}}`.
 */
class m200328_123933_create_request_table extends Migration
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

        $this->createTable('{{%request}}', [
            'request_id' => $this->primaryKey(),
            'seeker_id' => $this->integer()->notNull(),
            'request' => $this->text()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-request-seeker_id', '{{%request}}', 'seeker_id');
        $this->addForeignKey('fk-request-seeker_id', '{{%request}}', 'seeker_id', '{{%seeker}}', 'seeker_id', 'CASCADE', 'CASCADE');

        // permissions
        $auth = Yii::$app->authManager;
        $permission = $auth->createPermission('request');
        $auth->add($permission);
        $auth->addChild($auth->getRole('administrator'), $permission);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request}}');

        $auth = Yii::$app->authManager;
        $auth->remove($auth->getPermission('request'));
    }
}
