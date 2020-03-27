<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%seeker}}`.
 */
class m200327_090450_create_seeker_table extends Migration
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

        $this->createTable('{{%seeker}}', [
            'seeker_id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'workplace' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-seeker-user_id', '{{%seeker}}', 'user_id');
        $this->addForeignKey('fk-seeker-user_id', '{{%seeker}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        // permissions
        $auth = Yii::$app->authManager;
        $permission = $auth->createPermission('seeker');
        $auth->add($permission);
        $auth->addChild($auth->getRole('administrator'), $permission);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%seeker}}');

        $auth = Yii::$app->authManager;
        $auth->remove($auth->getPermission('seeker'));
    }
}
