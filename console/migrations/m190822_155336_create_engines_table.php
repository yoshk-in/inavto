<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%engines}}`.
 */
class m190822_155336_create_engines_table extends Migration
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
        
        $this->createTable('{{%engines}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull(),
            'alter_title' => $this->string(50)->notNull(),
            'generation_id' => $this->integer(5),
            'created' => $this->datetime()->notNull(),
            'modified' => $this->datetime()->notNull(),
        ], $tableOptions);
        
        // creates index for column `generation_id`
        $this->createIndex(
            'idx-engines-generation_id',
            'engines',
            'generation_id'
        );

        // add foreign key for table `generations`
        $this->addForeignKey(
            'fk-engines-generation_id',
            'engines',
            'generation_id',
            'generations',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         // drops foreign key for table `generations`
        $this->dropForeignKey(
            'fk-engines-generation_id',
            'engines'
        );

        // drops index for column `generation_id`
        $this->dropIndex(
            'idx-engines-generation_id',
            'engines'
        );
        
        $this->dropTable('{{%engines}}');
    }
}
