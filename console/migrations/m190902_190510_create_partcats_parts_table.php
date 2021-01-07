<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%partcats_parts}}`.
 */
class m190902_190510_create_partcats_parts_table extends Migration
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
        
        $this->createTable('{{%partcats_parts}}', [
            'id' => $this->primaryKey(),
            'part_id' => $this->integer(5),
            'part_category_id' => $this->integer(5),
        ], $tableOptions);
        
        // creates index for column `part_id`
        $this->createIndex(
            'idx-partcats_parts-part_id',
            'partcats_parts',
            'part_id'
        );

        // add foreign key for table `parts`
        $this->addForeignKey(
            'fk-partcats_parts-part_id',
            'partcats_parts',
            'part_id',
            'parts',
            'id',
            'CASCADE'
        );
        
        // creates index for column `part_category_id`
        $this->createIndex(
            'idx-partcats_parts-part_category_id',
            'partcats_parts',
            'part_category_id'
        );

        // add foreign key for table `parts_categories`
        $this->addForeignKey(
            'fk-partcats_parts-part_category_id',
            'partcats_parts',
            'part_category_id',
            'parts_categories',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         // drops foreign key for table `parts_categories`
        $this->dropForeignKey(
            'fk-partcats_parts-part_category_id',
            'partcats_parts'
        );

        // drops index for column `part_category_id`
        $this->dropIndex(
            'idx-partcats_parts-part_category_id',
            'partcats_parts'
        );
        
        // drops foreign key for table `parts`
        $this->dropForeignKey(
            'fk-partcats_parts-part_id',
            'partcats_parts'
        );

        // drops index for column `part_id`
        $this->dropIndex(
            'idx-partcats_parts-part_id',
            'partcats_parts'
        );
        
        $this->dropTable('{{%partcats_parts}}');
    }
}
