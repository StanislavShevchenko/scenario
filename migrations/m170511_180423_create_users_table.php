<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m170511_180423_create_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('users', [
            'id'        => $this->primaryKey(),
            'login'     => $this->string(100)->notNull()->unique(),
            'password'  => $this->string(255)->notNull(),
            'email'     => $this->string(255)->notNull(),
            'name'      => $this->string(255)->notNull(),
            'last_nama' => $this->string(255)->notNull(),
            'second_name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('users');
    }
}
