<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%giver}}`.
 */
class m200328_163120_drop_services_column_from_giver_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%giver}}', 'services');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%giver}}', 'services', $this->string()->notNull());
    }
}
