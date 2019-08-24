<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%jobs_categories}}`.
 */
class m190822_181936_add_position_column_to_jobs_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('jobs_categories', 'car_id', $this->integer(5)->notNull());
        
        $this->createIndex(
            'idx-jobs_categories-car_id',
            'jobs_categories',
            'car_id'
        );

        // add foreign key for table `cars`
        $this->addForeignKey(
            'fk-jobs_categories-car_id',
            'jobs_categories',
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
            'fk-jobs_categories-car_id',
            'jobs_categories'
        );

        // drops index for column `car_id`
        $this->dropIndex(
            'idx-jobs_categories-car_id',
            'jobs_categories'
        );
        
        $this->dropColumn('jobs_categories', 'car_id');
    }
}
