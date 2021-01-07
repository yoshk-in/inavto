<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%generations}}`.
 */
class m190827_131920_add_position_column_to_generations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('generations', 'alter_title', $this->string(10));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('generations', 'alter_title');
    }
}
