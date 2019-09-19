<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%messages}}`.
 */
class m190919_160726_add_position_column_to_messages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('messages', 'flag', $this->smallInteger(2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('messages', 'flag');
    }
}
