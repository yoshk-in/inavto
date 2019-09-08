<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%parts_categories}}`.
 */
class m190904_171944_add_position_column_to_parts_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('parts_categories', 'in_menu', $this->smallInteger(2)->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('parts_categories', 'in_menu');
    }
}
