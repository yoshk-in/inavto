<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%parts}}`.
 */
class m191012_062629_add_position_column_to_parts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('parts', 'oem', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('parts', 'oem');
    }
}
