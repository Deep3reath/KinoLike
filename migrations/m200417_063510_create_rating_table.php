<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rating}}`.
 */
class m200417_063510_create_rating_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rating}}', [
            'id' => $this->primaryKey(),
            'num' => $this->integer(),
            'id_user' => $this->integer(),
            'id_film' => $this->integer(),
        ]);

        $this->addForeignKey(
            'rating_id_user',
            'rating',
            'id_user',
            'user',
            'id',
            'CASCADE'
        );

            $this->addForeignKey(
            'rating_id_film',
            'rating',
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
        $this->dropForeignKey('rating_id_user', 'rating');
        $this->dropForeignKey('rating_id_film', 'rating');
        $this->dropTable('{{%rating}}');
    }
}
