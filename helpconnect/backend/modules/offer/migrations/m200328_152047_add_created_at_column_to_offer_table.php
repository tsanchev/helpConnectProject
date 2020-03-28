<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%offer}}`.
 */
class m200328_152047_add_created_at_column_to_offer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%offer}}', 'created_at', $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%offer}}', 'created_at');
    }
}
