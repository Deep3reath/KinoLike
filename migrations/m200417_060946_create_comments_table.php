<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m200417_060946_create_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comments}}', [
            'id' => $this->primaryKey(),
            'text' => $this->string('16777'),
            'date' => $this->date(),
            'review' => $this->integer(),
            'type' => $this->integer(),
            'id_user' => $this->integer(),
            'id_film' => $this->integer()
        ]);
        $this->addForeignKey(
            'comments_id_user',
            'comments',
            'id_user',
            'user',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'comments_id_film',
            'comments',
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
        $this->dropForeignKey('comments_id_user', 'comments');
        $this->dropForeignKey('comments_id_film', 'comments');
        $this->dropTable('{{%comments}}');
    }
}
