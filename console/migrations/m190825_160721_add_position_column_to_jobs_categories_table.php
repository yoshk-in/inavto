<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%jobs_categories}}`.
 */
class m190825_160721_add_position_column_to_jobs_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('jobs_categories', 'menu_title', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('jobs_categories', 'menu_title');
    }
}
