<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%messages}}`.
 */
class m190917_093711_create_messages_table extends Migration
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
        
        $this->createTable('{{%messages}}', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(50)->notNull(),
            'service_id' => $this->integer(2),
            'email' => $this->string(100),
            'avto' => $this->string(100),
            'message' => $this->string(),
            'created' => $this->datetime()->notNull(),
            'modified' => $this->datetime()->notNull(),
        ], $tableOptions);
        
        // creates index for column `service_id`
        $this->createIndex(
            'idx-messages-service_id',
            'messages',
            'service_id'
        );

        // add foreign key for table `services`
        $this->addForeignKey(
            'fk-messages-service_id',
            'messages',
            'service_id',
            'services',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `services`
        $this->dropForeignKey(
            'fk-messages-service_id',
            'messages'
        );

        // drops index for column `service_id`
        $this->dropIndex(
            'idx-messages-service_id',
            'messages'
        );
        
        $this->dropTable('{{%messages}}');
    }
}
