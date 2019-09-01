<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%parts_engines}}`.
 */
class m190830_141010_create_parts_engines_table extends Migration
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
        
        $this->createTable('{{%parts_engines}}', [
            'id' => $this->primaryKey(),
            'part_id' => $this->integer(5),
            'engine_id' => $this->integer(5),
        ], $tableOptions);
        
        // creates index for column `part_id`
        $this->createIndex(
            'idx-parts_engines-part_id',
            'parts_engines',
            'part_id'
        );

        // add foreign key for table `parts`
        $this->addForeignKey(
            'fk-parts_engines-part_id',
            'parts_engines',
            'part_id',
            'parts',
            'id',
            'CASCADE'
        );
        
        // creates index for column `engine_id`
        $this->createIndex(
            'idx-parts_engines-generation_id',
            'parts_engines',
            'engine_id'
        );

        // add foreign key for table `engines`
        $this->addForeignKey(
            'fk-parts_engines-generation_id',
            'parts_engines',
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
            'fk-parts_engines-engine_id',
            'parts_engines'
        );

        // drops index for column `engine_id`
        $this->dropIndex(
            'idx-parts_engines-engine_id',
            'parts_engines'
        );
        
        // drops foreign key for table `parts`
        $this->dropForeignKey(
            'fk-parts_engines-part_id',
            'parts_engines'
        );

        // drops index for column `part_id`
        $this->dropIndex(
            'idx-parts_engines-part_id',
            'parts_engines'
        );
        
        $this->dropTable('{{%parts_engines}}');
    }
}
