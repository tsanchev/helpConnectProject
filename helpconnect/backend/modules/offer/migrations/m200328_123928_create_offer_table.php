<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%offer}}`.
 */
class m200328_123928_create_offer_table extends Migration
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

        $this->createTable('{{%offer}}', [
            'offer_id' => $this->primaryKey(),
            'giver_id' => $this->integer()->notNull(),
            'offer' => $this->text()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-offer-giver_id', '{{%offer}}', 'giver_id');
        $this->addForeignKey('fk-offer-giver_id', '{{%offer}}', 'giver_id', '{{%giver}}', 'giver_id', 'CASCADE', 'CASCADE');

        // permissions
        $auth = Yii::$app->authManager;
        $permission = $auth->createPermission('offer');
        $auth->add($permission);
        $auth->addChild($auth->getRole('administrator'), $permission);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%offer}}');

        $auth = Yii::$app->authManager;
        $auth->remove($auth->getPermission('offer'));
    }
}
