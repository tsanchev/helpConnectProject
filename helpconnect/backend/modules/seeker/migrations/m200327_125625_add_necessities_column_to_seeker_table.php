<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%seeker}}`.
 */
class m200327_125625_add_necessities_column_to_seeker_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%seeker}}', 'necessities', $this->text()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%seeker}}', 'necessities');
    }
}
