<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%roles}}`.
 */
class m200417_054721_create_roles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%roles}}', [
            'id' => $this->primaryKey(),
            'role' => $this->text()
        ]);
        $this->insert('{{%roles}}', ['role' => 'admin']);
        $this->insert('{{%roles}}', ['role' => 'moderator']);
        $this->insert('{{%roles}}', ['role' => 'superuser']);
        $this->insert('{{%roles}}', ['role' => 'user']);
        $this->insert('{{%roles}}', ['role' => 'banned']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%roles}}');
    }
}
