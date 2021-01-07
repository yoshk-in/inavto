<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%years_jobs}}`.
 */
class m190822_140148_create_years_jobs_table extends Migration
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
        
        $this->createTable('{{%years_jobs}}', [
            'id' => $this->primaryKey(),
            'job_id' => $this->integer(5),
            'year_id' => $this->integer(5),
        ], $tableOptions);
        
        // creates index for column `job_id`
        $this->createIndex(
            'idx-years_jobs-job_id',
            'years_jobs',
            'job_id'
        );

        // add foreign key for table `jobs`
        $this->addForeignKey(
            'fk-years_jobs-job_id',
            'years_jobs',
            'job_id',
            'jobs',
            'id',
            'CASCADE'
        );
        
        // creates index for column `year_id`
        $this->createIndex(
            'idx-years_jobs-year_id',
            'years_jobs',
            'year_id'
        );

        // add foreign key for table `years`
        $this->addForeignKey(
            'fk-years_jobs-year_id',
            'years_jobs',
            'year_id',
            'years',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         // drops foreign key for table `years`
        $this->dropForeignKey(
            'fk-years_jobs-year_id',
            'years_jobs'
        );

        // drops index for column `year_id`
        $this->dropIndex(
            'idx-years_jobs-year_id',
            'years_jobs'
        );
        
        // drops foreign key for table `jobs`
        $this->dropForeignKey(
            'fk-years_jobs-job_id',
            'years_jobs'
        );

        // drops index for column `job_id`
        $this->dropIndex(
            'idx-years_jobs-job_id',
            'years_jobs'
        );
        
        $this->dropTable('{{%years_jobs}}');
    }
}
