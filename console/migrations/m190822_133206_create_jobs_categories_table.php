<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%jobs_categories}}`.
 */
class m190822_133206_create_jobs_categories_table extends Migration
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
        
        $this->createTable('{{%jobs_categories}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'alias' => $this->string(),
            'meta_title' => $this->string(),
            'body' => $this->text(),
            'parent' => $this->smallInteger(2)->defaultValue(0),
            'service' => $this->smallInteger(2)->defaultValue(1),
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
        $this->dropTable('{{%jobs_categories}}');
    }
}
