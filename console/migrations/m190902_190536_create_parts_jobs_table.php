<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%parts_jobs}}`.
 */
class m190902_190536_create_parts_jobs_table extends Migration
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
        
        $this->createTable('{{%parts_jobs}}', [
            'id' => $this->primaryKey(),
            'job_id' => $this->integer(5),
            'part_id' => $this->integer(5),
        ], $tableOptions);
        
        // creates index for column `job_id`
        $this->createIndex(
            'idx-parts_jobs-job_id',
            'parts_jobs',
            'job_id'
        );

        // add foreign key for table `jobs`
        $this->addForeignKey(
            'fk-parts_jobs-job_id',
            'parts_jobs',
            'job_id',
            'jobs',
            'id',
            'CASCADE'
        );
        
        // creates index for column `part_id`
        $this->createIndex(
            'idx-parts_jobs-part_id',
            'parts_jobs',
            'part_id'
        );

        // add foreign key for table `parts`
        $this->addForeignKey(
            'fk-parts_jobs-part_id',
            'parts_jobs',
            'part_id',
            'parts',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         // drops foreign key for table `parts`
        $this->dropForeignKey(
            'fk-parts_jobs-part_id',
            'parts_jobs'
        );

        // drops index for column `part_id`
        $this->dropIndex(
            'idx-parts_jobs-part_id',
            'parts_jobs'
        );
        
        // drops foreign key for table `jobs`
        $this->dropForeignKey(
            'fk-parts_jobs-job_id',
            'parts_jobs'
        );

        // drops index for column `job_id`
        $this->dropIndex(
            'idx-parts_jobs-job_id',
            'parts_jobs'
        );
        
        $this->dropTable('{{%parts_jobs}}');
    }
}
