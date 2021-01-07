<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%parts}}`.
 */
class m190822_160424_create_parts_table extends Migration
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
        
        $this->createTable('{{%parts}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'pc_id' => $this->integer(5),
            'car_id' => $this->integer(5),
            'engine_id' => $this->integer(5),
            'generation_id' => $this->integer(5),
            'brand_id' => $this->integer(5),
            'job_id' => $this->integer(5),
            'price' => $this->decimal(),
            'check' => $this->smallInteger(2)->defaultValue(1),
            'original' => $this->smallInteger(2)->defaultValue(1),
            'code' => $this->string(),
            'created' => $this->datetime()->notNull(),
            'modified' => $this->datetime()->notNull(),
        ], $tableOptions);
        
        // creates index for column `pc_id`
        $this->createIndex(
            'idx-parts-pc_id',
            'parts',
            'pc_id'
        );

        // add foreign key for table `parts_categories`
        $this->addForeignKey(
            'fk-parts-pc_id',
            'parts',
            'pc_id',
            'parts_categories',
            'id'
        );
        
        // creates index for column `car_id`
        $this->createIndex(
            'idx-parts-car_id',
            'parts',
            'car_id'
        );

        // add foreign key for table `cars`
        $this->addForeignKey(
            'fk-parts-car_id',
            'parts',
            'car_id',
            'cars',
            'id'
        );
        
        // creates index for column `engine_id`
        $this->createIndex(
            'idx-parts-engine_id',
            'parts',
            'engine_id'
        );

        // add foreign key for table `engines`
        $this->addForeignKey(
            'fk-parts-engine_id',
            'parts',
            'engine_id',
            'engines',
            'id'
        );
        
        // creates index for column `generation_id`
        $this->createIndex(
            'idx-parts-generation_id',
            'parts',
            'generation_id'
        );

        // add foreign key for table `generations`
        $this->addForeignKey(
            'fk-parts-generation_id',
            'parts',
            'generation_id',
            'generations',
            'id'
        );
        
        // creates index for column `brand_id`
        $this->createIndex(
            'idx-parts-brand_id',
            'parts',
            'brand_id'
        );

        // add foreign key for table `brands`
        $this->addForeignKey(
            'fk-parts-brand_id',
            'parts',
            'brand_id',
            'brands',
            'id'
        );
        
        // creates index for column `job_id`
        $this->createIndex(
            'idx-parts-job_id',
            'parts',
            'job_id'
        );

        // add foreign key for table `jobs`
        $this->addForeignKey(
            'fk-parts-job_id',
            'parts',
            'job_id',
            'jobs',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `jobs`
        $this->dropForeignKey(
            'fk-parts-job_id',
            'parts'
        );

        // drops index for column `job_id`
        $this->dropIndex(
            'idx-parts-job_id',
            'parts'
        );
        
        // drops foreign key for table `brands`
        $this->dropForeignKey(
            'fk-parts-brand_id',
            'parts'
        );

        // drops index for column `brand_id`
        $this->dropIndex(
            'idx-parts-brand_id',
            'parts'
        );
        
        // drops foreign key for table `generations`
        $this->dropForeignKey(
            'fk-parts-generation_id',
            'parts'
        );

        // drops index for column `generation_id`
        $this->dropIndex(
            'idx-parts-generation_id',
            'parts'
        );
        
        // drops foreign key for table `engines`
        $this->dropForeignKey(
            'fk-parts-engine_id',
            'parts'
        );

        // drops index for column `engine_id`
        $this->dropIndex(
            'idx-parts-engine_id',
            'parts'
        );
        
        // drops foreign key for table `cars`
        $this->dropForeignKey(
            'fk-parts-car_id',
            'parts'
        );

        // drops index for column `car_id`
        $this->dropIndex(
            'idx-parts-car_id',
            'parts'
        );
        
        // drops foreign key for table `parts_categories`
        $this->dropForeignKey(
            'fk-parts-pc_id',
            'parts'
        );

        // drops index for column `pc_id`
        $this->dropIndex(
            'idx-parts-pc_id',
            'parts'
        );
        
        $this->dropTable('{{%parts}}');
    }
}
