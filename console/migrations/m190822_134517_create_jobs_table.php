<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jobs}}`.
 */
class m190822_134517_create_jobs_table extends Migration
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
        
        $this->createTable('{{%jobs}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'jc_id' => $this->integer(5),
            'price' => $this->decimal(),
            'recomended' => $this->smallInteger(2)->defaultValue(1),
            'created' => $this->datetime()->notNull(),
            'modified' => $this->datetime()->notNull(),
        ], $tableOptions);
        
        // creates index for column `jc_id`
        $this->createIndex(
            'idx-jobs-jc_id',
            'jobs',
            'jc_id'
        );

        // add foreign key for table `jobs_categories`
        $this->addForeignKey(
            'fk-jobs-jc_id',
            'jobs',
            'jc_id',
            'jobs_categories',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `jobs_categories`
        $this->dropForeignKey(
            'fk-jobs-jc_id',
            'jobs'
        );

        // drops index for column `jc_id`
        $this->dropIndex(
            'idx-jobs-jc_id',
            'jobs'
        );
        
        $this->dropTable('{{%jobs}}');
    }
}
