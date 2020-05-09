<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%films}}`.
 */
class m200417_060416_create_films_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%films}}', [
            'id' => $this->primaryKey(),
            'title' => $this->text(),
            'description' => $this->text(),
            'genre' => $this->integer(),
            'date' => $this->date(),
            'country' => $this->text(),
            'img' => $this->text(),
            'operator' => $this->text(),
            'screenwriter' => $this->text(),
            'producer' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%films}}');
    }
}
