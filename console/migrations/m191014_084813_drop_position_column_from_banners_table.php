<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%banners}}`.
 */
class m191014_084813_drop_position_column_from_banners_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('banners', 'img_thumb');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('banners', 'img_thumb', $this->string());
    }
}
