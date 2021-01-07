<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%banners_pages}}`.
 */
class m191013_155259_create_banners_pages_table extends Migration
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
        
        $this->createTable('{{%banners_pages}}', [
            'id' => $this->primaryKey(),
            'banner_id' => $this->integer(5),
            'page_id' => $this->integer(5),
        ], $tableOptions);
        
        // creates index for column `banner_id`
        $this->createIndex(
            'idx-banners_pages-banner_id',
            'banners_pages',
            'banner_id'
        );

        // add foreign key for table `banners`
        $this->addForeignKey(
            'fk-banners_pages-banner_id',
            'banners_pages',
            'banner_id',
            'banners',
            'id',
            'CASCADE'
        );
        
        // creates index for column `page_id`
        $this->createIndex(
            'idx-banners_pages-page_id',
            'banners_pages',
            'page_id'
        );

        // add foreign key for table `pages`
        $this->addForeignKey(
            'fk-banners_pages-page_id',
            'banners_pages',
            'page_id',
            'pages',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `pages`
        $this->dropForeignKey(
            'fk-banners_pages-page_id',
            'banners_pages'
        );

        // drops index for column `page_id`
        $this->dropIndex(
            'idx-banners_pages-page_id',
            'banners_pages'
        );
        
        // drops foreign key for table `banners`
        $this->dropForeignKey(
            'fk-banners_pages-banner_id',
            'banners_pages'
        );

        // drops index for column `banner_id`
        $this->dropIndex(
            'idx-banners_pages-banner_id',
            'banners_pages'
        );
        
        $this->dropTable('{{%banners_pages}}');
    }
}
