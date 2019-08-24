<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%engines}}`.
 */
class m190822_154649_create_generations_table extends Migration
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
        
        $this->createTable('{{%generations}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull(),
            'car_id' => $this->integer(5),
            'created' => $this->datetime()->notNull(),
            'modified' => $this->datetime()->notNull(),
        ], $tableOptions);
        
        // creates index for column `car_id`
        $this->createIndex(
            'idx-generations-car_id',
            'generations',
            'car_id'
        );

        // add foreign key for table `cars`
        $this->addForeignKey(
            'fk-generations-car_id',
            'generations',
            'car_id',
            'cars',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `cars`
        $this->dropForeignKey(
            'fk-generations-car_id',
            'generations'
        );

        // drops index for column `car_id`
        $this->dropIndex(
            'idx-generations-car_id',
            'generations'
        );
        
        $this->dropTable('{{%generations}}');
    }
}
