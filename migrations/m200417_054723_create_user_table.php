<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m200417_054723_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'email' =>$this->string('63'),
            'name' =>$this->string('63'),
            'username' =>$this->string('31'),
            'password' =>$this->string('63'),
            'avatar' => $this->text()->null(),
            'id_role' =>$this->integer(),
        ]);
        $this->addForeignKey(
            'user_id_role',
            'user',
            'id_role',
            'roles',
            'id',
            'CASCADE'
        );
        $this->insert('{{%user}}', [
            'id_role' => 1,
            'email' => 'admin@email.example',
            'name' => 'Админ',
            'username' => 'admin',
            'password'=>md5('admin'),
            'avatar'=>'admin.png'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('user_id_role', 'user');
        $this->dropTable('{{%user}}');
    }
}
