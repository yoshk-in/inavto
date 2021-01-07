<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jobcats_jobs}}`.
 */
class m190822_163835_create_jobcats_jobs_table extends Migration
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
        
        $this->createTable('{{%jobcats_jobs}}', [
            'id' => $this->primaryKey(),
            'job_id' => $this->integer(5),
            'job_category_id' => $this->integer(5),
        ], $tableOptions);
        
        // creates index for column `job_id`
        $this->createIndex(
            'idx-jobcats_jobs-job_id',
            'jobcats_jobs',
            'job_id'
        );

        // add foreign key for table `jobs`
        $this->addForeignKey(
            'fk-jobcats_jobs-job_id',
            'jobcats_jobs',
            'job_id',
            'jobs',
            'id',
            'CASCADE'
        );
        
        // creates index for column `job_category_id`
        $this->createIndex(
            'idx-jobcats_jobs-job_category_id',
            'jobcats_jobs',
            'job_category_id'
        );

        // add foreign key for table `jobs_categories`
        $this->addForeignKey(
            'fk-jobcats_jobs-job_category_id',
            'jobcats_jobs',
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
            'fk-jobcats_jobs-job_category_id',
            'jobcats_jobs'
        );

        // drops index for column `job_category_id`
        $this->dropIndex(
            'idx-jobcats_jobs-job_category_id',
            'jobcats_jobs'
        );
        
        // drops foreign key for table `jobs`
        $this->dropForeignKey(
            'fk-jobcats_jobs-job_id',
            'jobcats_jobs'
        );

        // drops index for column `job_id`
        $this->dropIndex(
            'idx-jobcats_jobs-job_id',
            'jobcats_jobs'
        );
        
        $this->dropTable('{{%jobcats_jobs}}');
    }
}
