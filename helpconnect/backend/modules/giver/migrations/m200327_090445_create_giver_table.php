<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%giver}}`.
 */
class m200327_090445_create_giver_table extends Migration
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

        $this->createTable('{{%giver}}', [
            'giver_id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'company' => $this->string(),
            'phone' => $this->string()->notNull(),
            'services' => $this->text()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-giver-user_id', '{{%giver}}', 'user_id');
        $this->addForeignKey('fk-giver-user_id', '{{%giver}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        // permissions
        $auth = Yii::$app->authManager;
        $permission = $auth->createPermission('giver');
        $auth->add($permission);
        $auth->addChild($auth->getRole('administrator'), $permission);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%giver}}');

        $auth = Yii::$app->authManager;
        $auth->remove($auth->getPermission('giver'));
    }
}
