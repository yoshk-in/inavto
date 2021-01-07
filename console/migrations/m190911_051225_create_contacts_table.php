<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contacts}}`.
 */
class m190911_051225_create_contacts_table extends Migration
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
        
        $this->createTable('{{%contacts}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'service_id' => $this->integer(5),
            'type' => $this->smallInteger(2),
            'created' => $this->datetime()->notNull(),
            'modified' => $this->datetime()->notNull(),
        ], $tableOptions);
        
        // creates index for column `service_id`
        $this->createIndex(
            'idx-contacts-service_id',
            'contacts',
            'service_id'
        );

        // add foreign key for table `services`
        $this->addForeignKey(
            'fk-contacts-service_id',
            'contacts',
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
            'fk-contacts-service_id',
            'contacts'
        );

        // drops index for column `service_id`
        $this->dropIndex(
            'idx-contacts-service_id',
            'contacts'
        );
        
        $this->dropTable('{{%contacts}}');
    }
}
