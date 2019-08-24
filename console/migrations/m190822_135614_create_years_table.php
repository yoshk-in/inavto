<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%years}}`.
 */
class m190822_135614_create_years_table extends Migration
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
        
        $this->createTable('{{%years}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull(),
            'mileage' => $this->integer(7),
            'created' => $this->datetime()->notNull(),
            'modified' => $this->datetime()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%years}}');
    }
}
