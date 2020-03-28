<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request_item}}`.
 */
class m200328_124002_create_request_item_table extends Migration
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

        $this->createTable('{{%request_item}}', [
            'request_id' => $this->integer()->notNull(),
            'item' => $this->string()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-request_item-request_id-item}}', '{{%request_item}}', ['request_id','item',]);

        $this->createIndex('idx-request_item-request_id', '{{%request_item}}', 'request_id');
        $this->addForeignKey('fk-request_item-request_id', '{{%request_item}}', 'request_id', '{{%request}}', 'request_id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-request_item-item', '{{%request_item}}', 'item');
        $this->addForeignKey('fk-request_item-item', '{{%request_item}}', 'item', '{{%item}}', 'item', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request_item}}');
    }
}
