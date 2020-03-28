<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%offer_item}}`.
 */
class m200328_123951_create_offer_item_table extends Migration
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

        $this->createTable('{{%offer_item}}', [
            'offer_id' => $this->integer()->notNull(),
            'item' => $this->string()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('{{%pk-offer_item-offer_id-item}}', '{{%offer_item}}', ['offer_id','item',]);

        $this->createIndex('idx-offer_item-offer_id', '{{%offer_item}}', 'offer_id');
        $this->addForeignKey('fk-offer_item-offer_id', '{{%offer_item}}', 'offer_id', '{{%offer}}', 'offer_id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-offer_item-item', '{{%offer_item}}', 'item');
        $this->addForeignKey('fk-offer_item-item', '{{%offer_item}}', 'item', '{{%item}}', 'item', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%offer_item}}');
    }
}
