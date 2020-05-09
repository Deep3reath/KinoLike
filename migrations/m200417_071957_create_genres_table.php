<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%genres}}`.
 */
class m200417_071957_create_genres_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%genres}}', [
            'id' => $this->primaryKey(),
            'title' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%genres}}');
    }
}
