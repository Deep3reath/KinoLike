<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%viewed}}`.
 */
class m200417_072412_create_viewed_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%viewed}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer(),
            'id_film' => $this->integer()
        ]);

        $this->addForeignKey(
            'viewed_id_user',
            'viewed',
            'id_user',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'viewed_id_film',
            'viewed',
            'id_film',
            'films',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('viewed_id_role', 'viewed');
        $this->dropForeignKey('viewed_id_role', 'viewed');
        $this->dropTable('{{%viewed}}');
    }
}
