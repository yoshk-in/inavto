<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%parts_categories}}`.
 */
class m190822_182359_add_position_column_to_parts_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('parts_categories', 'car_id', $this->integer(5)->notNull());
        
        $this->createIndex(
            'idx-parts_categories-car_id',
            'parts_categories',
            'car_id'
        );

        // add foreign key for table `cars`
        $this->addForeignKey(
            'fk-parts_categories-car_id',
            'parts_categories',
            'car_id',
            'cars',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         // drops foreign key for table `cars`
        $this->dropForeignKey(
            'fk-parts_categories-car_id',
            'parts_categories'
        );

        // drops index for column `car_id`
        $this->dropIndex(
            'idx-parts_categories-car_id',
            'parts_categories'
        );
        
        $this->dropColumn('parts_categories', 'car_id');
    }
}
