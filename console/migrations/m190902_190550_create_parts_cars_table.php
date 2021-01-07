<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%parts_cars}}`.
 */
class m190902_190550_create_parts_cars_table extends Migration
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
        
        $this->createTable('{{%parts_cars}}', [
            'id' => $this->primaryKey(),
            'car_id' => $this->integer(5),
            'part_id' => $this->integer(5),
        ], $tableOptions);
        
        // creates index for column `car_id`
        $this->createIndex(
            'idx-parts_cars-car_id',
            'parts_cars',
            'car_id'
        );

        // add foreign key for table `cars`
        $this->addForeignKey(
            'fk-parts_cars-car_id',
            'parts_cars',
            'car_id',
            'cars',
            'id',
            'CASCADE'
        );
        
        // creates index for column `part_id`
        $this->createIndex(
            'idx-parts_cars-part_id',
            'parts_cars',
            'part_id'
        );

        // add foreign key for table `parts`
        $this->addForeignKey(
            'fk-parts_cars-part_id',
            'parts_cars',
            'part_id',
            'parts',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         // drops foreign key for table `parts`
        $this->dropForeignKey(
            'fk-parts_cars-part_id',
            'parts_cars'
        );

        // drops index for column `part_id`
        $this->dropIndex(
            'idx-parts_cars-part_id',
            'parts_cars'
        );
        
        // drops foreign key for table `cars`
        $this->dropForeignKey(
            'fk-parts_cars-car_id',
            'parts_cars'
        );

        // drops index for column `car_id`
        $this->dropIndex(
            'idx-parts_cars-car_id',
            'parts_cars'
        );
        
        $this->dropTable('{{%parts_cars}}');
    }
}
