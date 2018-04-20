<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m180420_061206_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string(50)->notNull(),
            'lastname' => $this->string(50)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
