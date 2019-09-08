<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%parts_generations}}`.
 */
class m190830_123509_create_parts_generations_table extends Migration
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
        
        $this->createTable('{{%parts_generations}}', [
            'id' => $this->primaryKey(),
            'part_id' => $this->integer(5),
            'generation_id' => $this->integer(5),
        ], $tableOptions);
        
        // creates index for column `part_id`
        $this->createIndex(
            'idx-parts_generations-part_id',
            'parts_generations',
            'part_id'
        );

        // add foreign key for table `parts`
        $this->addForeignKey(
            'fk-parts_generations-part_id',
            'parts_generations',
            'part_id',
            'parts',
            'id',
            'CASCADE'
        );
        
        // creates index for column `generation_id`
        $this->createIndex(
            'idx-parts_generations-generation_id',
            'parts_generations',
            'generation_id'
        );

        // add foreign key for table `generations`
        $this->addForeignKey(
            'fk-parts_generations-generation_id',
            'parts_generations',
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
            'fk-parts_generations-generation_id',
            'parts_generations'
        );

        // drops index for column `generation_id`
        $this->dropIndex(
            'idx-parts_generations-generation_id',
            'parts_generations'
        );
        
        // drops foreign key for table `parts`
        $this->dropForeignKey(
            'fk-parts_generations-part_id',
            'parts_generations'
        );

        // drops index for column `part_id`
        $this->dropIndex(
            'idx-parts_generations-part_id',
            'parts_generations'
        );
        
        $this->dropTable('{{%parts_generations}}');
    }
}
