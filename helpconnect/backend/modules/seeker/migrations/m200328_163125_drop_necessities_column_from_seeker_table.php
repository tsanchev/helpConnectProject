<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%seeker}}`.
 */
class m200328_163125_drop_necessities_column_from_seeker_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%seeker}}', 'necessities');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%seeker}}', 'necessities', $this->string()->notNull());
    }
}
