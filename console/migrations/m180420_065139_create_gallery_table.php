<?php

use yii\db\Migration;

/**
 * Handles the creation of table `gallery`.
 * Has foreign keys to the tables:
 *
 * - `users`
 * - `gallery_type`
 */
class m180420_065139_create_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('gallery', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'gallery_type_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-gallery-user_id',
            'gallery',
            'user_id'
        );

        // add foreign key for table `users`
        $this->addForeignKey(
            'fk-gallery-user_id',
            'gallery',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );

        // creates index for column `gallery_type_id`
        $this->createIndex(
            'idx-gallery-gallery_type_id',
            'gallery',
            'gallery_type_id'
        );

        // add foreign key for table `gallery_type`
        $this->addForeignKey(
            'fk-gallery-gallery_type_id',
            'gallery',
            'gallery_type_id',
            'gallery_type',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `users`
        $this->dropForeignKey(
            'fk-gallery-user_id',
            'gallery'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-gallery-user_id',
            'gallery'
        );

        // drops foreign key for table `gallery_type`
        $this->dropForeignKey(
            'fk-gallery-gallery_type_id',
            'gallery'
        );

        // drops index for column `gallery_type_id`
        $this->dropIndex(
            'idx-gallery-gallery_type_id',
            'gallery'
        );

        $this->dropTable('gallery');
    }
}
