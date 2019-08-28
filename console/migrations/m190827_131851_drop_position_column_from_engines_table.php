<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%engines}}`.
 */
class m190827_131851_drop_position_column_from_engines_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('engines', 'alter_title');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('engines', 'alter_title', $this->string(50));
    }
}
