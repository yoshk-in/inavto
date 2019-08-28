<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%engines_jobs}}`.
 */
class m190827_133549_create_engines_jobs_table extends Migration
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
        
        $this->createTable('{{%engines_jobs}}', [
            'id' => $this->primaryKey(),
            'job_id' => $this->integer(5),
            'engine_id' => $this->integer(5),
        ], $tableOptions);
        
        // creates index for column `job_id`
        $this->createIndex(
            'idx-engines_jobs-job_id',
            'engines_jobs',
            'job_id'
        );

        // add foreign key for table `jobs`
        $this->addForeignKey(
            'fk-engines_jobs-job_id',
            'engines_jobs',
            'job_id',
            'jobs',
            'id',
            'CASCADE'
        );
        
        // creates index for column `engine_id`
        $this->createIndex(
            'idx-engines_jobs-engine_id',
            'engines_jobs',
            'engine_id'
        );

        // add foreign key for table `engines`
        $this->addForeignKey(
            'fk-engines_jobs-engine_id',
            'engines_jobs',
            'engine_id',
            'engines',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `engines`
        $this->dropForeignKey(
            'fk-engines_jobs-engine_id',
            'engines_jobs'
        );

        // drops index for column `engine_id`
        $this->dropIndex(
            'idx-engines_jobs-engine_id',
            'engines_jobs'
        );
        
        // drops foreign key for table `jobs`
        $this->dropForeignKey(
            'fk-engines_jobs-job_id',
            'engines_jobs'
        );

        // drops index for column `job_id`
        $this->dropIndex(
            'idx-engines_jobs-job_id',
            'engines_jobs'
        );
        
        $this->dropTable('{{%engines_jobs}}');
    }
}
