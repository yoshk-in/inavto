<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%jobs_categories}}`.
 */
class m190904_171727_add_position_column_to_jobs_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('jobs_categories', 'in_menu', $this->smallInteger(2)->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('jobs_categories', 'in_menu');
    }
}
