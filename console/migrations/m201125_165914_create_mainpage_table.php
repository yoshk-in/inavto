<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%mainpage}}`.
 */
class m201125_165914_create_mainpage_table extends Migration
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

        $this->createTable('{{%mainpage}}', [
            'id' => $this->primaryKey(),
            'banner_id' => $this->integer(5)
        ], $tableOptions);

        $this->createIndex(
            'idx-mainpage-banner_id',
            'mainpage',
            'banner_id'
        );

        $this->addForeignKey(
            'fk-mainpage-banner_id',
            'mainpage',
            'banner_id',
            'banners',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `banners`
        $this->dropForeignKey(
            'fk-mainpage-banner_id',
            'mainpage'
        );

        // drops index for column `banner_id`
        $this->dropIndex(
            'idx-mainpage-banner_id',
            'mainpage'
        );

        $this->dropTable('{{%mainpage}}');
    }
}
