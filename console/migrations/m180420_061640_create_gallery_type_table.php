<?php

use yii\db\Migration;

/**
 * Handles the creation of table `gallery_type`.
 */
class m180420_061640_create_gallery_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('gallery_type', [
            'id' => $this->primaryKey(),
            'galler_type_name' => $this->string(50)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('gallery_type');
    }
}
