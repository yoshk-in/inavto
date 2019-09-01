<?php

use yii\db\Migration;

/**
 * Class m190901_144602_create
 */
class m190901_144602_create_jobs_generations_table extends Migration
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
        
        $this->createTable('{{%jobs_generations}}', [
            'id' => $this->primaryKey(),
            'job_id' => $this->integer(5),
            'generation_id' => $this->integer(5),
        ], $tableOptions);
        
        // creates index for column `job_id`
        $this->createIndex(
            'idx-jobs_generations-job_id',
            'jobs_generations',
            'job_id'
        );

        // add foreign key for table `jobs`
        $this->addForeignKey(
            'fk-jobs_generations-job_id',
            'jobs_generations',
            'job_id',
            'jobs',
            'id',
            'CASCADE'
        );
        
        // creates index for column `generation_id`
        $this->createIndex(
            'idx-jobs_generations-generation_id',
            'jobs_generations',
            'generation_id'
        );

        // add foreign key for table `generations`
        $this->addForeignKey(
            'fk-jobs_generations-generation_id',
            'jobs_generations',
            'generation_id',
            'generations',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `generations`
        $this->dropForeignKey(
            'fk-jobs_generations-generation_id',
            'jobs_generations'
        );

        // drops index for column `generation_id`
        $this->dropIndex(
            'idx-jobs_generations-generation_id',
            'jobs_generations'
        );
        
        // drops foreign key for table `jobs`
        $this->dropForeignKey(
            'fk-jobs_generations-job_id',
            'jobs_generations'
        );

        // drops index for column `job_id`
        $this->dropIndex(
            'idx-jobs_generations-job_id',
            'jobs_generations'
        );
        
        $this->dropTable('{{%jobs_generations}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190901_144602_create cannot be reverted.\n";

        return false;
    }
    */
}
