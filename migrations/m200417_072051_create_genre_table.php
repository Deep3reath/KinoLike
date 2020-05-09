<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%genre}}`.
 */
class m200417_072051_create_genre_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%genre}}', [
            'id' => $this->primaryKey(),
            'id_genres' => $this->integer(),
            'id_film' => $this->integer()
        ]);

        $this->addForeignKey(
            'genre_id_film',
            'genre',
            'id_film',
            'films',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'genre_id_genres',
            'genre',
            'id_genres',
            'genres',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('genre_id_film', 'genre');
        $this->dropForeignKey('genre_id_genres', 'genre');
        $this->dropTable('{{%genre}}');
    }
}
