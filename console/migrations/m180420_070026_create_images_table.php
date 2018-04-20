<?php

use yii\db\Migration;

/**
 * Handles the creation of table `images`.
 * Has foreign keys to the tables:
 *
 * - `gallery`
 */
class m180420_070026_create_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('images', [
            'id' => $this->primaryKey(),
            'gallery_id' => $this->integer()->notNull(),
            'imagename' => $this->string(255)->notNull(),
        ]);

        // creates index for column `gallery_id`
        $this->createIndex(
            'idx-images-gallery_id',
            'images',
            'gallery_id'
        );

        // add foreign key for table `gallery`
        $this->addForeignKey(
            'fk-images-gallery_id',
            'images',
            'gallery_id',
            'gallery',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `gallery`
        $this->dropForeignKey(
            'fk-images-gallery_id',
            'images'
        );

        // drops index for column `gallery_id`
        $this->dropIndex(
            'idx-images-gallery_id',
            'images'
        );

        $this->dropTable('images');
    }
}
