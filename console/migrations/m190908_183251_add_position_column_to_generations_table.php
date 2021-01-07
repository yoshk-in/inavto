<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%generations}}`.
 */
class m190908_183251_add_position_column_to_generations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('generations', 'start', $this->smallInteger(5));
        $this->addColumn('generations', 'end', $this->smallInteger(5));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('generations', 'end');
        $this->dropColumn('generations', 'start');
    }
}
