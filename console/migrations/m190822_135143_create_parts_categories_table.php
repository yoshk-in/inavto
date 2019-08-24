<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%parts_categories}}`.
 */
class m190822_135143_create_parts_categories_table extends Migration
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
        
        $this->createTable('{{%parts_categories}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'meta_title' => $this->string(),
            'alias' => $this->string(),
            'body' => $this->text(),
            'parent' => $this->smallInteger(2)->defaultValue(0),
            'description' => $this->text(),
            'keywords' => $this->text(),
            'created' => $this->datetime()->notNull(),
            'modified' => $this->datetime()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%parts_categories}}');
    }
}
