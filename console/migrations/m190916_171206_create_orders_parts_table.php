<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders_parts}}`.
 */
class m190916_171206_create_orders_parts_table extends Migration
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
        
        $this->createTable('{{%orders_parts}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(5),
            'part_id' => $this->integer(5),
        ], $tableOptions);
        
        // creates index for column `order_id`
        $this->createIndex(
            'idx-orders_parts-order_id',
            'orders_parts',
            'order_id'
        );

        // add foreign key for table `orders`
        $this->addForeignKey(
            'fk-orders_parts-order_id',
            'orders_parts',
            'order_id',
            'orders',
            'id',
            'CASCADE'
        );
        
        // creates index for column `part_id`
        $this->createIndex(
            'idx-orders_parts-part_id',
            'orders_parts',
            'part_id'
        );

        // add foreign key for table `parts`
        $this->addForeignKey(
            'fk-orders_parts-part_id',
            'orders_parts',
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
            'fk-orders_parts-part_id',
            'orders_parts'
        );

        // drops index for column `part_id`
        $this->dropIndex(
            'idx-orders_parts-part_id',
            'orders_parts'
        );
        
        // drops foreign key for table `orders`
        $this->dropForeignKey(
            'fk-orders_parts-order_id',
            'orders_parts'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            'idx-orders_parts-order_id',
            'orders_parts'
        );
        
        $this->dropTable('{{%orders_parts}}');
    }
}
