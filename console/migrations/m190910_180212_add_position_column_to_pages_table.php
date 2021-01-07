<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%pages}}`.
 */
class m190910_180212_add_position_column_to_pages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('pages', 'menu', $this->smallInteger(2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('pages', 'menu');
    }
}
