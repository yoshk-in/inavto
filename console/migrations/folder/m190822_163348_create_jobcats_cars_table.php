<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jobcats_cars}}`.
 */
class m190822_163348_create_jobcats_cars_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%jobcats_cars}}', [
            'id' => $this->primaryKey(),
            'car_id' => $this->integer(5),
            'job_category_id' => $this->integer(5),
        ], $tableOptions);
        
        // creates index for column `car_id`
        $this->createIndex(
            'idx-jobcats_cars-car_id',
            'jobcats_cars',
            'car_id'
        );

        // add foreign key for table `cars`
        $this->addForeignKey(
            'fk-jobcats_cars-car_id',
            'jobcats_cars',
            'car_id',
            'cars',
            'id',
            'CASCADE'
        );
        
        // creates index for column `job_category_id`
        $this->createIndex(
            'idx-jobcats_cars-job_category_id',
            'jobcats_cars',
            'job_category_id'
        );

        // add foreign key for table `jobs_categories`
        $this->addForeignKey(
            'fk-jobcats_cars-job_category_id',
            'jobcats_cars',
            'job_category_id',
            'jobs_categories',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         // drops foreign key for table `jobs_categories`
        $this->dropForeignKey(
            'fk-jobcats_cars-job_category_id',
            'jobcats_cars'
        );

        // drops index for column `job_category_id`
        $this->dropIndex(
            'idx-jobcats_cars-job_category_id',
            'jobcats_cars'
        );
        
        // drops foreign key for table `cars`
        $this->dropForeignKey(
            'fk-jobcats_cars-car_id',
            'jobcats_cars'
        );

        // drops index for column `car_id`
        $this->dropIndex(
            'idx-jobcats_cars-car_id',
            'jobcats_cars'
        );
        
        $this->dropTable('{{%jobcats_cars}}');
    }
}
