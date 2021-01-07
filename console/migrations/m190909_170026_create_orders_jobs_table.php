<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders_jobs}}`.
 */
class m190909_170026_create_orders_jobs_table extends Migration
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
        
        $this->createTable('{{%orders_jobs}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(5),
            'job_id' => $this->integer(5),
        ], $tableOptions);
        
        // creates index for column `order_id`
        $this->createIndex(
            'idx-orders_jobs-order_id',
            'orders_jobs',
            'order_id'
        );

        // add foreign key for table `orders`
        $this->addForeignKey(
            'fk-orders_jobs-order_id',
            'orders_jobs',
            'order_id',
            'orders',
            'id',
            'CASCADE'
        );
        
        // creates index for column `job_id`
        $this->createIndex(
            'idx-orders_jobs-job_id',
            'orders_jobs',
            'job_id'
        );

        // add foreign key for table `jobs`
        $this->addForeignKey(
            'fk-orders_jobs-job_id',
            'orders_jobs',
            'job_id',
            'jobs',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `jobs`
        $this->dropForeignKey(
            'fk-orders_jobs-job_id',
            'orders_jobs'
        );

        // drops index for column `job_id`
        $this->dropIndex(
            'idx-orders_jobs-job_id',
            'orders_jobs'
        );
        
        // drops foreign key for table `orders`
        $this->dropForeignKey(
            'fk-orders_jobs-order_id',
            'orders_jobs'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            'idx-orders_jobs-order_id',
            'orders_jobs'
        );
        
        $this->dropTable('{{%orders_jobs}}');
    }
}
