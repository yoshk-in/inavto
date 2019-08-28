<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%parts_categories}}`.
 */
class m190828_161928_add_position_column_to_parts_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('parts_categories', 'menu_title', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('parts_categories', 'menu_title');
    }
}
