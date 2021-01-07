<?php

use yii\db\Migration;

/**
 * Class m190827_165111_update_position_column_from_years_table
 */
class m190827_165111_update_position_column_from_years_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('years', 'title');
        $this->addColumn('years', 'title', $this->smallInteger(2)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->addColumn('years', 'title', $this->smallInteger(2)->notNull());
       $this->dropColumn('years', 'title');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190827_165111_update_position_column_from_years_table cannot be reverted.\n";

        return false;
    }
    */
}
