<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favorites}}`.
 */
class m200417_072729_create_favorites_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%favorites}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer(),
            'id_film' => $this->integer()
        ]);

        $this->addForeignKey(
            'favorites_id_user',
            'favorites',
            'id_user',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'favorites_id_film',
            'favorites',
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
        $this->dropForeignKey('favorites_id_role', 'favorites');
        $this->dropForeignKey('favorites_id_role', 'favorites');
        $this->dropTable('{{%favorites}}');
    }
}
